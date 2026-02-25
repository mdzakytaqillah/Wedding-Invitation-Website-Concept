<?php

class media_model {
    private $media = 'media';
    private $access = 'canaccess';
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

    public function getGallery(){
        $this->db->query('SELECT * FROM ' . $this->media . ' WHERE category = "Gallery"');
        return $this->db->resultSet();
    }

    public function getYouTube(){
        $this->db->query('SELECT * FROM ' . $this->media . ' WHERE category = "YouTube" LIMIT 1');
        return $this->db->resultSingle();
    }

    public function getMediaSharing(){
        $this->db->query('SELECT * FROM ' . $this->media . ' WHERE category = "Media Sharing"');
        return $this->db->resultSet();
    }

    public function getMediaAccess($groupID, $guestID){
        $query = 'SELECT x.mediaID, m.fileName, m.fileLink 
                FROM ' . $this->access . ' x 
                LEFT JOIN ' . $this->media . ' m ON x.mediaID = m.mediaID 
                WHERE x.groupID = :groupID OR x.guestID = :guestID OR x.isPublic = 1 
                GROUP BY mediaID';
        $this->db->query($query);
        $this->db->bind('groupID', $groupID);
        $this->db->bind('guestID', $guestID);
        return $this->db->resultSet();
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
        move_uploaded_file($tmpfile, 'img/gallery/' . $imgname);

        $cover = $this->getCoverPage();
        if(!empty($cover)){
            $oldimgpath = 'img/gallery/' . $cover['fileName'];
            $query = "UPDATE " . $this->media . " SET fileName = :fileName WHERE category = 'Cover' AND mediaID = :id";
            $this->db->query($query);
            $this->db->bind('id', $cover['mediaID']);
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

    public function resetCoverPage(){
        $cover = $this->getCoverPage();
        if(!empty($cover)){
            $oldimgpath = 'img/gallery/' . $cover['fileName'];
            $query = "DELETE FROM " . $this->media . " WHERE category = 'Cover' AND mediaID = :id";
            $this->db->query($query);
            $this->db->bind('id', $cover['mediaID']);
            $this->db->execute();
            if(file_exists($oldimgpath)){
                unlink($oldimgpath);
            }
            return 1;
        }else{
            Flasher::setFlash('Gambar tidak ditemukan', 'warning');
            return 0;
            exit;
        }
    }

    public function setGallery($data, $gambar){
        for($x = 0; $x < count($gambar['imggallery']['name']); $x++){
            $namefile = $gambar['imggallery']['name'][$x];
            $sizefile = $gambar['imggallery']['size'][$x];
            $error = $gambar['imggallery']['error'][$x];
            $tmpfile = $gambar['imggallery']['tmp_name'][$x];

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
            move_uploaded_file($tmpfile, 'img/gallery/' . $imgname);

            $query = "INSERT INTO " . $this->media . " VALUES ('', :eventID, :fileName, :fileLink, :category)";
            $this->db->query($query);
            $this->db->bind('eventID', $data['eventID']);
            $this->db->bind('fileName', $imgname);
            $this->db->bind('fileLink', NULL);
            $this->db->bind('category', 'Gallery');
            $this->db->execute();
        }
        return 1;
    }

    public function removeGallery($id){
        $query = "SELECT fileName FROM " . $this->media . " WHERE mediaID = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $result = $this->db->resultSingle();
        if(!empty($result)){
            $query = "DELETE FROM " . $this->media . " WHERE mediaID = :id";
            $this->db->query($query);
            $this->db->bind('id', $id);
            $this->db->execute();
            unlink('img/gallery/' . $result['fileName']);
            return 1;
        }else{
            Flasher::setFlash('Gambar tidak ditemukan', 'warning');
            return 0;
            exit;
        }
    }

    public function updateYouTube($data){
        if(empty($data['youtube_url'])){
            Flasher::setFlash('URL tidak boleh kosong', 'warning');
            return 0;
            exit;
        }

        if(Helper::urlvalidate('YouTube', $data['youtube_url'])){
            $youtube = $this->getYouTube();
            if(empty($youtube)){
                $query = "INSERT INTO " . $this->media . " VALUES ('', :eventID, NULL, :fileLink, 'YouTube')";
                $this->db->query($query);
                $this->db->bind('eventID', $data['eventID']);
            }else{
                $query = "UPDATE " . $this->media . " SET fileLink = :fileLink WHERE category = 'YouTube' AND mediaID = :id";
                $this->db->query($query);
                $this->db->bind('id', $youtube['mediaID']);
            }
            $url = Helper::urlnormalize($data['youtube_url']);
            $this->db->bind('fileLink', $url);
            $this->db->execute();
            return 1;
        }else{
            Flasher::setFlash('URL tidak valid. Pastikan link berasal dari youtube.com atau youtu.be', 'danger');
            return 0;
            exit;
        }
    }

    public function resetYouTubeLink(){
        $youtube = $this->getYouTube();
        if(!empty($youtube)){
            $query = "DELETE FROM " . $this->media . " WHERE category = 'YouTube' AND mediaID = :id";
            $this->db->query($query);
            $this->db->bind('id', $youtube['mediaID']);
            $this->db->execute();
            return 1;
        }else{
            Flasher::setFlash('Video tidak ditemukan', 'warning');
            return 0;
            exit;
        }
    }

    public function setMediaSharing($data){
        for($i = 0; $i < count($data['shareLink']); $i++){
            if(empty($data['shareLink'][$i][0])){
                continue;
            }
            $query = "INSERT INTO " . $this->media . " VALUES ('', :eventID, :fileName, :fileLink, 'Media Sharing')";
            $this->db->query($query);
            $this->db->bind('eventID', $data['eventID']);
            $this->db->bind('fileName', $data['shareName'][$i][0]);
            $this->db->bind('fileLink', Helper::urlnormalize($data['shareLink'][$i][0]));
            $this->db->execute();

            $mediaID = $this->db->lastInsertId();
            if($data['isPublic'][$i][0] == 0){
                for($m = 0; $m < count($data['shareLink']); $m++){
                    if(empty($data['groupID'][$i][$m])){
                        continue;
                    }
                    $query = "INSERT INTO " . $this->access . " VALUES (:mediaID, :groupID, NULL, :isPublic)";
                    $this->db->query($query);
                    $this->db->bind('mediaID', $mediaID);
                    $this->db->bind('groupID', $data['groupID'][$i][$m]);
                    $this->db->bind('isPublic', 0);
                    $this->db->execute();
                }
                for($k = 0; $k < count($data['shareLink']); $k++){
                    if(empty($data['guestID'][$i][$k])){
                        continue;
                    }
                    $query = "INSERT INTO " . $this->access . " VALUES (:mediaID, NULL, :guestID, :isPublic)";
                    $this->db->query($query);
                    $this->db->bind('mediaID', $mediaID);
                    $this->db->bind('guestID', $data['guestID'][$i][$k]);
                    $this->db->bind('isPublic', 0);
                    $this->db->execute();
                }
            }else{
                $query = "INSERT INTO " . $this->access . " VALUES (:mediaID, NULL, NULL, :isPublic)";
                $this->db->query($query);
                $this->db->bind('mediaID', $mediaID);
                $this->db->bind('isPublic', 1);
                $this->db->execute();
            }
        }
        return 1;
    }

    public function delete($id){
        $this->db->query('DELETE FROM ' . $this->media . ' WHERE mediaID = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return 1;
    }
}