<?php

class event_model {
    private $event = 'event';
    private $story = 'story';
    private $envelope = 'envelope';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getEvent(){
        $this->db->query('SELECT * FROM ' . $this->event . ' LIMIT 1');
        return $this->db->resultSingle();
    }

    public function getPhoto(){
        $this->db->query('SELECT malePhoto, femalePhoto FROM ' . $this->event . ' LIMIT 1');
        return $this->db->resultSingle();
    }

    public function getStory(){
        $this->db->query('SELECT * FROM ' . $this->story);
        return $this->db->resultSet();
    }

    public function getEnvelope(){
        $this->db->query('SELECT * FROM ' . $this->envelope);
        return $this->db->resultSet();
    }

    public function newEvent($data, $gambar){
        $namefileMale = $gambar['malePhoto']['name'];
        $sizefileMale = $gambar['malePhoto']['size'];
        $errorMale = $gambar['malePhoto']['error'];
        $tmpfileMale = $gambar['malePhoto']['tmp_name'];

        $namefileFemale = $gambar['femalePhoto']['name'];
        $sizefileFemale = $gambar['femalePhoto']['size'];
        $errorFemale = $gambar['femalePhoto']['error'];
        $tmpfileFemale = $gambar['femalePhoto']['tmp_name'];

        $typeallowed = ['jpg', 'jpeg', 'png'];
        $sizelimit = 4194304;
        
        if($errorMale === 4){
            $imgMaleName = null;
        }else{
            $extfileMale = explode('.', $namefileMale);
            $extfileMale = strtolower(end($extfileMale));
            if(!in_array($extfileMale, $typeallowed)){
                Flasher::setFlash('File ' . $extfileMale . ' tidak diizinkan', 'danger');
                return 0;
                exit;
            }

            if($sizefileMale > $sizelimit){
                Flasher::setFlash('Ukuran Gambar Mempelai Pria Terlalu Besar', 'warning');
                return 0;
                exit;
            }

            $imgMaleName = uniqid();
            $imgMaleName .= '.';
            $imgMaleName .= $extfileMale;
            move_uploaded_file($tmpfileMale, 'img/gallery/' . $imgMaleName);
        }

        if($errorFemale === 4){
            $imgFemaleName = null;
        }else{
            $extfileFemale = explode('.', $namefileFemale);
            $extfileFemale = strtolower(end($extfileFemale));
            if(!in_array($extfileFemale, $typeallowed)){
                Flasher::setFlash('File ' . $extfileFemale . ' tidak diizinkan', 'danger');
                return 0;
                exit;
            }
            
            if($sizefileFemale > $sizelimit){
                Flasher::setFlash('Ukuran Gambar Mempelai Wanita Terlalu Besar', 'warning');
                return 0;
                exit;
            }
            
            $imgFemaleName = uniqid();
            $imgFemaleName .= '.';
            $imgFemaleName .= $extfileFemale;
            move_uploaded_file($tmpfileFemale, 'img/gallery/' . $imgFemaleName);
        }

        empty($data['maleInstagram']) ? $data['maleInstagram'] = null : $data['maleInstagram'] = $data['maleInstagram'];
        empty($data['maleFather']) ? $data['maleFather'] = null : $data['maleFather'] = $data['maleFather'];
        empty($data['maleMother']) ? $data['maleMother'] = null : $data['maleMother'] = $data['maleMother'];
        empty($data['femaleInstagram']) ? $data['femaleInstagram'] = null : $data['femaleInstagram'] = $data['femaleInstagram'];
        empty($data['femaleFather']) ? $data['femaleFather'] = null : $data['femaleFather'] = $data['femaleFather'];
        empty($data['femaleMother']) ? $data['femaleMother'] = null : $data['femaleMother'] = $data['femaleMother'];
        empty($data['marriageDate']) ? $data['marriageDate'] = null : $data['marriageDate'] = $data['marriageDate'];
        empty($data['receptionDate']) ? $data['receptionDate'] = null : $data['receptionDate'] = $data['receptionDate'];
        empty($data['marriageStart']) ? $data['marriageStart'] = null : $data['marriageStart'] = $data['marriageStart'];
        empty($data['marriageEnd']) ? $data['marriageEnd'] = null : $data['marriageEnd'] = $data['marriageEnd'];
        empty($data['receptionStart']) ? $data['receptionStart'] = null : $data['receptionStart'] = $data['receptionStart'];
        empty($data['receptionEnd']) ? $data['receptionEnd'] = null : $data['receptionEnd'] = $data['receptionEnd'];
        empty($data['timezone']) ? $data['timezone'] = 'WIB' : $data['timezone'] = $data['timezone'];

        $query = "INSERT INTO " . $this->event . " VALUES ('', :maleName, :maleFullname, :malePhoto, :maleInstagram, :maleFather, :maleMother, :femaleName, :femaleFullname, :femalePhoto, :femaleInstagram, :femaleFather, :femaleMother, :marriageDate, :marriageStart, :marriageEnd, :receptionDate, :receptionStart, :receptionEnd, :timezone, :marriageLocation, :marriageGMaps, :receptionLocation, :receptionGMaps)";
        $this->db->query($query);
        $this->db->bind('maleName', $data['maleName']);
        $this->db->bind('maleFullname', $data['maleFullname']);
        $this->db->bind('malePhoto', $imgMaleName);
        $this->db->bind('maleInstagram', $data['maleInstagram']);
        $this->db->bind('maleFather', $data['maleFather']);
        $this->db->bind('maleMother', $data['maleMother']);
        $this->db->bind('femaleName', $data['femaleName']);
        $this->db->bind('femaleFullname', $data['femaleFullname']);
        $this->db->bind('femalePhoto', $imgFemaleName);
        $this->db->bind('femaleInstagram', $data['femaleInstagram']);
        $this->db->bind('femaleFather', $data['femaleFather']);
        $this->db->bind('femaleMother', $data['femaleMother']);
        $this->db->bind('marriageDate', $data['marriageDate']);
        $this->db->bind('marriageStart', $data['marriageStart']);
        $this->db->bind('marriageEnd', $data['marriageEnd']);
        $this->db->bind('receptionDate', $data['receptionDate']);
        $this->db->bind('receptionStart', $data['receptionStart']);
        $this->db->bind('receptionEnd', $data['receptionEnd']);
        $this->db->bind('timezone', $data['timezone']);
        $this->db->bind('marriageLocation', $data['marriageLocation']);
        $this->db->bind('marriageGMaps', $data['marriageGMaps']);
        $this->db->bind('receptionLocation', $data['receptionLocation']);
        $this->db->bind('receptionGMaps', $data['receptionGMaps']);
        $this->db->execute();

        $eventID = $this->db->lastInsertId();

        for($storyCount = 0; $storyCount < count($data['storyTitle']); $storyCount++){
            $query = "INSERT INTO " . $this->story . " VALUES (:no, :eventID, :title, :description)";
            $this->db->query($query);
            $this->db->bind('no', $storyCount + 1);
            $this->db->bind('eventID', $eventID);
            $this->db->bind('title', $data['storyTitle'][$storyCount]);
            $this->db->bind('description', $data['storyDescription'][$storyCount]);
            $this->db->execute();
        }

        for($envelopeCount = 0; $envelopeCount < count($data['envelopeName']); $envelopeCount++){
            $query = "INSERT INTO " . $this->envelope . " VALUES ('', :eventID, :type, :company, :number, :name)";
            $this->db->query($query);
            $this->db->bind('eventID', $eventID);
            $this->db->bind('type', $data['envelopeType'][$envelopeCount]);
            $this->db->bind('company', $data['envelopeCompany'][$envelopeCount]);
            $this->db->bind('number', $data['envelopeNumber'][$envelopeCount]);
            $this->db->bind('name', $data['envelopeName'][$envelopeCount]);
            $this->db->execute();
        }

        return 1;
    }

    public function editEvent($data, $gambar){
        $namefileMale = $gambar['malePhoto']['name'];
        $sizefileMale = $gambar['malePhoto']['size'];
        $errorMale = $gambar['malePhoto']['error'];
        $tmpfileMale = $gambar['malePhoto']['tmp_name'];

        $namefileFemale = $gambar['femalePhoto']['name'];
        $sizefileFemale = $gambar['femalePhoto']['size'];
        $errorFemale = $gambar['femalePhoto']['error'];
        $tmpfileFemale = $gambar['femalePhoto']['tmp_name'];
        
        $typeallowed = ['jpg', 'jpeg', 'png'];
        $sizelimit = 4194304;
        $photo = $this->getPhoto();
        
        if($errorMale === 4){
            $imgMaleName = $photo['malePhoto'];
        }else{
            $extfileMale = explode('.', $namefileMale);
            $extfileMale = strtolower(end($extfileMale));
            if(!in_array($extfileMale, $typeallowed)){
                Flasher::setFlash('File ' . $extfileMale . ' tidak diizinkan', 'danger');
                return 0;
                exit;
            }

            if($sizefileMale > $sizelimit){
                Flasher::setFlash('Ukuran Gambar Mempelai Pria Terlalu Besar', 'warning');
                return 0;
                exit;
            }

            $imgMaleName = uniqid();
            $imgMaleName .= '.';
            $imgMaleName .= $extfileMale;
            move_uploaded_file($tmpfileMale, 'img/gallery/' . $imgMaleName);

            if(!empty($photo['malePhoto'])){
                $oldimgpathMale = 'img/gallery/' . $photo['malePhoto'];
            }
        }

        if($errorFemale === 4){
            $imgFemaleName = $photo['femalePhoto'];
        }else{
            $extfileFemale = explode('.', $namefileFemale);
            $extfileFemale = strtolower(end($extfileFemale));
            if(!in_array($extfileFemale, $typeallowed)){
                Flasher::setFlash('File ' . $extfileFemale . ' tidak diizinkan', 'danger');
                return 0;
                exit;
            }
            
            if($sizefileFemale > $sizelimit){
                Flasher::setFlash('Ukuran Gambar Mempelai Wanita Terlalu Besar', 'warning');
                return 0;
                exit;
            }
            
            $imgFemaleName = uniqid();
            $imgFemaleName .= '.';
            $imgFemaleName .= $extfileFemale;
            move_uploaded_file($tmpfileFemale, 'img/gallery/' . $imgFemaleName);

            if(!empty($photo['femalePhoto'])){
                $oldimgpathFemale = 'img/gallery/' . $photo['femalePhoto'];
            }
        }

        empty($data['maleInstagram']) ? $data['maleInstagram'] = null : $data['maleInstagram'] = $data['maleInstagram'];
        empty($data['maleFather']) ? $data['maleFather'] = null : $data['maleFather'] = $data['maleFather'];
        empty($data['maleMother']) ? $data['maleMother'] = null : $data['maleMother'] = $data['maleMother'];
        empty($data['femaleInstagram']) ? $data['femaleInstagram'] = null : $data['femaleInstagram'] = $data['femaleInstagram'];
        empty($data['femaleFather']) ? $data['femaleFather'] = null : $data['femaleFather'] = $data['femaleFather'];
        empty($data['femaleMother']) ? $data['femaleMother'] = null : $data['femaleMother'] = $data['femaleMother'];
        empty($data['marriageDate']) ? $data['marriageDate'] = null : $data['marriageDate'] = $data['marriageDate'];
        empty($data['receptionDate']) ? $data['receptionDate'] = null : $data['receptionDate'] = $data['receptionDate'];
        empty($data['marriageStart']) ? $data['marriageStart'] = null : $data['marriageStart'] = $data['marriageStart'];
        empty($data['marriageEnd']) ? $data['marriageEnd'] = null : $data['marriageEnd'] = $data['marriageEnd'];
        empty($data['receptionStart']) ? $data['receptionStart'] = null : $data['receptionStart'] = $data['receptionStart'];
        empty($data['receptionEnd']) ? $data['receptionEnd'] = null : $data['receptionEnd'] = $data['receptionEnd'];
        empty($data['timezone']) ? $data['timezone'] = 'WIB' : $data['timezone'] = $data['timezone'];

        $query = "UPDATE " . $this->event . " SET maleName = :maleName, maleFullname = :maleFullname, malePhoto = :malePhoto, maleInstagram = :maleInstagram, maleFather = :maleFather, maleMother = :maleMother, femaleName = :femaleName, femaleFullname = :femaleFullname, femalePhoto = :femalePhoto, femaleInstagram = :femaleInstagram, femaleFather = :femaleFather, femaleMother = :femaleMother, marriageDate = :marriageDate,  marriageStart = :marriageStart, marriageEnd = :marriageEnd, receptionDate = :receptionDate, receptionStart = :receptionStart, receptionEnd = :receptionEnd, timezone = :timezone, marriageLocation = :marriageLocation, marriageGMaps = :marriageGMaps, receptionLocation = :receptionLocation, receptionGMaps = :receptionGMaps WHERE eventID = :eventID";
        $this->db->query($query);
        $this->db->bind('eventID', $data['eventID']);
        $this->db->bind('maleName', $data['maleName']);
        $this->db->bind('maleFullname', $data['maleFullname']);
        $this->db->bind('malePhoto', $imgMaleName);
        $this->db->bind('maleInstagram', $data['maleInstagram']);
        $this->db->bind('maleFather', $data['maleFather']);
        $this->db->bind('maleMother', $data['maleMother']);
        $this->db->bind('femaleName', $data['femaleName']);
        $this->db->bind('femaleFullname', $data['femaleFullname']);
        $this->db->bind('femalePhoto', $imgFemaleName);
        $this->db->bind('femaleInstagram', $data['femaleInstagram']);
        $this->db->bind('femaleFather', $data['femaleFather']);
        $this->db->bind('femaleMother', $data['femaleMother']);
        $this->db->bind('marriageDate', $data['marriageDate']);
        $this->db->bind('marriageStart', $data['marriageStart']);
        $this->db->bind('marriageEnd', $data['marriageEnd']);
        $this->db->bind('receptionDate', $data['receptionDate']);
        $this->db->bind('receptionStart', $data['receptionStart']);
        $this->db->bind('receptionEnd', $data['receptionEnd']);
        $this->db->bind('timezone', $data['timezone']);
        $this->db->bind('marriageLocation', $data['marriageLocation']);
        $this->db->bind('marriageGMaps', $data['marriageGMaps']);
        $this->db->bind('receptionLocation', $data['receptionLocation']);
        $this->db->bind('receptionGMaps', $data['receptionGMaps']);
        $this->db->execute();

        if($imgMaleName != $photo['malePhoto']){
            if(isset($oldimgpathMale) && file_exists($oldimgpathMale)){
                unlink($oldimgpathMale);
            }
        }
        if($imgFemaleName != $photo['femalePhoto']){
            if(isset($oldimgpathFemale) && file_exists($oldimgpathFemale)){
                unlink($oldimgpathFemale);
            }
        }

        $eventID = $data['eventID'];

        $this->db->query("DELETE FROM " . $this->story . " WHERE eventID = :eventID");
        $this->db->bind('eventID', $eventID);
        $this->db->execute();

        $this->db->query("DELETE FROM " . $this->envelope . " WHERE eventID = :eventID");
        $this->db->bind('eventID', $eventID);
        $this->db->execute();

        for($storyCount = 0; $storyCount < count($data['storyTitle']); $storyCount++){
            $query = "INSERT INTO " . $this->story . " VALUES (:no, :eventID, :title, :description)";
            $this->db->query($query);
            $this->db->bind('no', $storyCount + 1);
            $this->db->bind('eventID', $eventID);
            $this->db->bind('title', $data['storyTitle'][$storyCount]);
            $this->db->bind('description', $data['storyDescription'][$storyCount]);
            $this->db->execute();
        }

        for($envelopeCount = 0; $envelopeCount < count($data['envelopeName']); $envelopeCount++){
            $query = "INSERT INTO " . $this->envelope . " VALUES ('', :eventID, :type, :company, :number, :name)";
            $this->db->query($query);
            $this->db->bind('eventID', $eventID);
            $this->db->bind('type', $data['envelopeType'][$envelopeCount]);
            $this->db->bind('company', $data['envelopeCompany'][$envelopeCount]);
            $this->db->bind('number', $data['envelopeNumber'][$envelopeCount]);
            $this->db->bind('name', $data['envelopeName'][$envelopeCount]);
            $this->db->execute();
        }

        return 1;
    }
}