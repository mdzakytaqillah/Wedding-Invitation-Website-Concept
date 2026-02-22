<?php

class media_model {
    private $media = 'media';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getMedia(){
        $this->db->query('SELECT * FROM ' . $this->media);
        return $this->db->resultSet();
    }

    public function getCoverPage(){
        $this->db->query('SELECT * FROM ' . $this->media . ' WHERE category = "Cover" LIMIT 1');
        return $this->db->resultSingle();
    }

    public function setCoverPage($data, $gambar){
        $namefile = $gambar['imgcover']['name'];
        $sizefile = $gambar['imgcover']['size'];
        $error = $gambar['imgcover']['error'];
        $tmpfile = $gambar['imgcover']['tmp_name'];

        if($error === 4){
            Flasher::setFlash('Gambar tidak ditemukan', 'warning');
            return 0;
            exit;
        }

        $typeallowed = ['jpg', 'jpeg', 'png'];
        $extfile = explode('.', $namefile);
        $extfile = strtolower(end($extfile));
        if(!in_array($extfile, $typeallowed)){
            Flasher::setFlash('File ' . $extfile . ' tidak diizinkan', 'danger');
            return 0;
            exit;
        }

        $sizelimit = 4194304;
        if($sizefile > $sizelimit){
            Flasher::setFlash('Ukuran Gambar Terlalu Besar', 'warning');
            return 0;
            exit;
        }

        $imgname = uniqid();
        $imgname .= '.';
        $imgname .= $extfile;
        move_uploaded_file($tmpfile, 'img/' . $imgname);

        $cover = $this->getCoverPage();
        if(!empty($cover)){
            $oldimgpath = 'img/' . $cover['fileName'];
            $query = "UPDATE " . $this->media . " SET fileName = :fileName WHERE category = 'Cover' AND mediaID = :id";
            $this->db->query($query);
            $this->db->bind('id', $cover['mediaID']);
            return 1;
        }else{
            $query = "INSERT INTO " . $this->media . " VALUES ('', :eventID, :fileName, :fileLink, :category)";
            $this->db->query($query);
            $this->db->bind('eventID', $data['eventID']);
            $this->db->bind('category', 'Cover');
            $this->db->bind('fileLink', NULL);
        }
        $this->db->bind('fileName', $imgname);
        $this->db->execute();
        if(isset($oldimgpath) && file_exists($oldimgpath)){
            unlink($oldimgpath);
        }
        return 1;
    }
}