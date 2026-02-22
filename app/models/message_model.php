<?php

class message_model {
    private $message = 'message';
    private $tamu = 'guest';
    private $grup = 'socialgroup';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getMessage(){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('SELECT * FROM ' . $this->message);
        return $this->db->resultSet();
    }

    public function getMessageCount(){
        $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->message);
        return $this->db->resultSingle();
    }

    public function getMessageApproved(){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('SELECT * FROM ' . $this->message . ' WHERE approveBy IS NOT NULL AND publish > 0');
        return $this->db->resultSet();
    }

    public function getMessageNotApproved(){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('SELECT * FROM ' . $this->message . ' WHERE approveBy IS NULL AND publish > 0');
        return $this->db->resultSet();
    }

    public function getPrivateMessage(){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('SELECT * FROM ' . $this->message . ' WHERE approveBy IS NULL AND publish = 0');
        return $this->db->resultSet();
    }

    public function getMessageRejected(){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('SELECT * FROM ' . $this->message . ' WHERE publish = -1');
        return $this->db->resultSet();
    }

    public function displayMessage(){
        $query = 'SELECT m.guestDisplayName, m.messageContent, m.publish, g.groupName 
              FROM ' . $this->message . ' m 
              LEFT JOIN ' . $this->tamu . ' t ON m.guestID = t.guestID 
              LEFT JOIN ' . $this->grup . ' g ON t.groupID = g.groupID 
              WHERE m.publish > 0 AND m.approveBy IS NOT NULL 
              ORDER BY m.messageID ASC';
        $this->db->query($query);
        return $this->db->resultSet();
    }

    private function getPublishStatus($id){
        $this->db->query('SELECT publish FROM ' . $this->message . ' WHERE messageID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function approveMessage($id){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $publishcheck = $this->getPublishStatus($id);
        if($publishcheck['publish'] == 0){
            Flasher::setFlash('Pesan ini tidak dapat dipublikasikan karena pengirim memilih untuk tidak mempublikasikannya.', 'warning');
            return 0;
            exit;
        }else if($publishcheck['publish'] == 1){
            $this->db->query('UPDATE ' . $this->message . ' SET guestDisplayName=:guestDisplayName, approveBy=:adminID WHERE messageID=:id');
            $this->db->bind('guestDisplayName', 'Anonim');
        }else if($publishcheck['publish'] == 2){
            $this->db->query('UPDATE ' . $this->message . ' SET approveBy=:adminID WHERE messageID=:id');
        }else{
            Flasher::setFlash('Terdapat kesalahan pada pesan.', 'danger');
            return 0;
            exit;
        }
        $this->db->bind('adminID', $_SESSION['idAkun']);
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }

    public function rejectMessage($id){
        if(!isset($_SESSION['idAkun'])){
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $this->db->query('UPDATE ' . $this->message . ' SET publish=-1 WHERE messageID=:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }

    public function newMessage($data){
        if($data['publish'] == 1){
            $data['guestDisplayName'] = 'Anonim';
        }else if($data['publish'] == 2){
            $data['guestDisplayName'] = $data['guestName'];
        }else{
            $data['guestDisplayName'] = null;
        }
        
        $query = "INSERT INTO " . $this->message . " VALUES ('', :guestID, :guestName, :guestDisplayName, :messageContent, :publish, NULL)";
        $this->db->query($query);
        $this->db->bind('guestID', !empty($data['guestID']) ? $data['guestID'] : null);
        $this->db->bind('guestName', $data['guestName']);
        $this->db->bind('guestDisplayName', $data['guestDisplayName']);
        $this->db->bind('messageContent', $data['messageContent']);
        $this->db->bind('publish', $data['publish']);
        $this->db->execute();
        return 1;
    }
}