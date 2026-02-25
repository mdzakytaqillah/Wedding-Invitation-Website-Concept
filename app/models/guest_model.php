<?php

class guest_model {
    private $group = 'socialgroup';
    private $tamu = 'guest';
    private $pengundang = 'users';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getGroup(){
        $this->db->query('SELECT * FROM ' . $this->group);
        return $this->db->resultSet();
    }

    public function getGroupList(){
        $this->db->query('SELECT groupID, groupName FROM ' . $this->group . ' ORDER BY groupName ASC');
        return $this->db->resultSet();
    }

    public function getGroupWithGuestsCount(){
        $this->db->query('SELECT g.groupID, g.groupName, g.addBy, u.Name as inviterName, COUNT(t.guestID) AS guestCount FROM ' . $this->group . ' g LEFT JOIN ' . $this->tamu . ' t ON g.groupID = t.groupID LEFT JOIN ' . $this->pengundang . ' u ON g.addBy = u.usersID GROUP BY g.groupID');
        return $this->db->resultSet();
    }

    public function getGroupById($id){
        $this->db->query('SELECT * FROM ' . $this->group . ' WHERE groupID = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function getTamu(){
        $this->db->query('SELECT * FROM ' . $this->tamu);
        return $this->db->resultSet();
    }

    public function getTamuCount(){
        $this->db->query('SELECT COUNT(*) FROM ' . $this->tamu);
        return $this->db->resultSingle();
    }

    public function getTamuWithGroupName(){
        $this->db->query('SELECT t.*, g.groupName, u.Name as inviterName FROM ' . $this->tamu . ' t LEFT JOIN ' . $this->group . ' g ON t.groupID = g.groupID LEFT JOIN ' . $this->pengundang . ' u ON t.addBy = u.usersID GROUP BY t.guestID');
        return $this->db->resultSet();
    }

    public function getTamuById($id){
        $this->db->query('SELECT * FROM ' . $this->tamu . ' WHERE guestID = :id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function getTamuByGuestCode($code){
        $query = 'SELECT t.*, g.groupID, g.groupName FROM ' . $this->tamu . ' t LEFT JOIN ' . $this->group . ' g ON t.groupID = g.groupID WHERE t.guestCode = :code';
        $this->db->query($query);
        $this->db->bind('code', $code);
        return $this->db->resultSingle();
    }

    public function getTamuFiltered($keyword = '', $groupID = '', $addedBy = '') {
        $query = 'SELECT t.*, g.groupName, u.Name AS inviterName 
                FROM ' . $this->tamu . ' t 
                LEFT JOIN ' . $this->group . ' g ON t.groupID = g.groupID 
                LEFT JOIN ' . $this->pengundang . ' u ON t.addBy = u.usersID 
                WHERE 1=1';

        if (!empty($keyword)) {
            $query .= ' AND (t.guestName LIKE :keyword OR t.guestCode LIKE :keyword)';
        }
        if (!empty($groupID)) {
            $query .= ' AND t.groupID = :groupID';
        }
        if (!empty($addedBy)) {
            $query .= ' AND t.addBy = :addedBy';
        }

        $this->db->query($query);

        if (!empty($keyword)) $this->db->bind('keyword', "%$keyword%");
        if (!empty($groupID)) $this->db->bind('groupID', $groupID);
        if (!empty($addedBy)) $this->db->bind('addedBy', $addedBy);

        return $this->db->resultSet();
    }

    public function addGroup($data){
        $query = "INSERT INTO " . $this->group . " VALUES ('', :eventID, :groupName, :addBy)";
        $this->db->query($query);
        $this->db->bind('eventID', $data['eventID']);
        $this->db->bind('groupName', $data['groupName']);
        $this->db->bind('addBy', $_SESSION['idAkun']);
        $this->db->execute();
        return 1;
    }

    public function updateGroup($data){
        $query = "UPDATE " . $this->group . " SET groupName = :groupName WHERE groupID = :groupID";
        $this->db->query($query);
        $this->db->bind('groupName', $data['groupName']);
        $this->db->bind('groupID', $data['groupID']);
        $this->db->execute();
        return 1;
    }

    public function deleteGroup($groupID) {
        $this->db->query("DELETE FROM " . $this->group . " WHERE groupID = :groupID AND addBy = :userID");
        $this->db->bind('groupID', $groupID);
        $this->db->bind('userID', $_SESSION['idAkun']);
        
        $this->db->execute();
        return 1;
    }

    public function isCodeTaken($code, $guestID = 0) {
        $this->db->query("SELECT guestID FROM " . $this->tamu . " WHERE guestCode = :code AND guestID != :id");
        $this->db->bind('code', $code);
        $this->db->bind('id', $guestID);
        return $this->db->resultSingle();
    }

    private function generateRandomCode($name) {
        $words = preg_split("/\s+/", $name);
        $initials = "";
        foreach ($words as $w) {
            $initials .= $w[0];
        }
        return $initials . "-" . strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 4));
    }

    public function addGuest($data){
        while(empty($data['guestCode']) || $this->isCodeTaken($data['guestCode'])) {
            unset($data['guestCode']);
            $data['guestCode'] = $this->generateRandomCode($data['guestName']);
        }
        $data['guestCode'] = strtoupper($data['guestCode']);
        $query = "INSERT INTO " . $this->tamu . " VALUES ('', :eventID, :groupID, :prefix, :guestName, :suffix, :guestCode, :addBy)";
        $this->db->query($query);
        $this->db->bind('eventID', $data['eventID']);
        $this->db->bind('groupID', $data['groupID']);
        $this->db->bind('prefix', $data['prefix']);
        $this->db->bind('guestName', $data['guestName']);
        $this->db->bind('suffix', $data['suffix']);
        $this->db->bind('guestCode', $data['guestCode']);
        $this->db->bind('addBy', $_SESSION['idAkun']);
        $this->db->execute();
        return 1;
    }

    public function updateGuest($data){
        while(empty($data['guestCode']) || $this->isCodeTaken($data['guestCode'], $data['guestID'])) {
            unset($data['guestCode']);
            $data['guestCode'] = $this->generateRandomCode($data['guestName']);
        }
        $data['guestCode'] = strtoupper($data['guestCode']);
        $query = "UPDATE " . $this->tamu . " SET groupID = :groupID, prefix = :prefix, guestName = :guestName, suffix = :suffix, guestCode = :guestCode WHERE guestID = :guestID";
        $this->db->query($query);
        $this->db->bind('groupID', $data['groupID']);
        $this->db->bind('prefix', $data['prefix']);
        $this->db->bind('guestName', $data['guestName']);
        $this->db->bind('suffix', $data['suffix']);
        $this->db->bind('guestCode', $data['guestCode']);
        $this->db->bind('guestID', $data['guestID']);
        $this->db->execute();
        return 1;
    }
}