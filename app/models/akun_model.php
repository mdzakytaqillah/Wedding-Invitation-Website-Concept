<?php

class akun_model {
    private $table = 'users';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getAkun(){
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getAkunbyID($id){
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE usersID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function searchUser($name){
        $this->db->query('SELECT usersID, Name FROM ' . $this->table . ' WHERE Name LIKE :name');
        $this->db->bind('name', "%$name%");
        return $this->db->resultSet();
        exit;
    }

    public function getUsername($id){
        $this->db->query('SELECT Username FROM ' . $this->table . ' WHERE usersID=:id');
        $this->db->bind('id', $id);
        return $this->db->resultSingle();
    }

    public function adminCounter(){
        $this->db->query('SELECT COUNT(*) AS count FROM ' . $this->table . ' WHERE roleRank<1');
        return $this->db->resultSingle();
    }

    public function inviterCounter(){
        $this->db->query('SELECT COUNT(*) AS count FROM ' . $this->table . ' WHERE roleRank=2');
        return $this->db->resultSingle();
    }

    public function newAkun($data){
        $username = strtolower(stripslashes($data['username']));
        $password = $data['password'];
        $password2 = $data['password2'];
        $roleRank = $data['roleRank'];

        $this->db->query('SELECT Username FROM ' . $this->table . ' WHERE Username =:username');
        $this->db->bind('username', $username);
        if($this->db->resultSingle() > 0){
            Flasher::setFlash('Username sudah ada', 'warning');
            return 0;
            exit;
        }

        if($password !== $password2){
            Flasher::setFlash('Konfirmasi Password tidak sesuai', 'warning');
            return 0;
            exit;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table . " VALUES ('', :nama, :username, :password, :roleRank)";
        $this->db->query($query);
        $this->db->bind('nama', $data['name']);
        $this->db->bind('username', $username);
        $this->db->bind('password', $password);
        $this->db->bind('roleRank', $roleRank);

        $this->db->execute();

        return 1;
        // return $this->db->rowCount();
    }

    public function loginAkun($data){
        $username = strtolower(stripslashes($data['username']));
        $password = $data['password'];
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE Username =:username');
        $this->db->bind('username', $username);
        if($this->db->resultSingle() > 0){
            $row = $this->db->resultSingle();
            if(password_verify($password, $row['Password'])){
                $_SESSION['login'] = true;
                $_SESSION['idAkun'] = $row['usersID'];
                $_SESSION['roleRank'] = $row['roleRank'];
                return 1;
                exit;
            } else {
                Flasher::setFlash('Password salah', 'warning');
                return 0;
                exit;
            }
        } else {
            Flasher::setFlash('Akun tidak ditemukan', 'warning');
            return 0;
            exit;
        }
    }
}