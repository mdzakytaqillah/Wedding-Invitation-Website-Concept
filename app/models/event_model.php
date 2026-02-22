<?php

class event_model {
    private $event = 'event';
    private $story = 'story';
    private $envelope = 'envelope';
    private $media = 'media';
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getEvent(){
        $this->db->query('SELECT * FROM ' . $this->event . ' LIMIT 1');
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

    public function getMedia(){
        $this->db->query('SELECT * FROM ' . $this->media);
        return $this->db->resultSet();
    }

    public function newEvent($data){
        $query = "INSERT INTO " . $this->event . " VALUES ('', :maleName, :maleFullname, :femaleName, :femaleFullname, :marriageDate, :marriageStart, :marriageEnd, :receptionDate, :receptionStart, :receptionEnd, :timezone, :marriageLocation, :marriageGMaps, :receptionLocation, :receptionGMaps)";
        $this->db->query($query);
        $this->db->bind('maleName', $data['maleName']);
        $this->db->bind('maleFullname', $data['maleFullname']);
        $this->db->bind('femaleName', $data['femaleName']);
        $this->db->bind('femaleFullname', $data['femaleFullname']);
        empty($data['marriageDate']) ? $data['marriageDate'] = null : $data['marriageDate'] = $data['marriageDate'];
        empty($data['receptionDate']) ? $data['receptionDate'] = null : $data['receptionDate'] = $data['receptionDate'];
        empty($data['marriageStart']) ? $data['marriageStart'] = null : $data['marriageStart'] = $data['marriageStart'];
        empty($data['marriageEnd']) ? $data['marriageEnd'] = null : $data['marriageEnd'] = $data['marriageEnd'];
        empty($data['receptionStart']) ? $data['receptionStart'] = null : $data['receptionStart'] = $data['receptionStart'];
        empty($data['receptionEnd']) ? $data['receptionEnd'] = null : $data['receptionEnd'] = $data['receptionEnd'];
        empty($data['timezone']) ? $data['timezone'] = 'WIB' : $data['timezone'] = $data['timezone'];
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

    public function editEvent($data){
        $query = "UPDATE " . $this->event . " SET maleName = :maleName, maleFullname = :maleFullname, femaleName = :femaleName, femaleFullname = :femaleFullname, marriageDate = :marriageDate,  marriageStart = :marriageStart, marriageEnd = :marriageEnd, receptionDate = :receptionDate, receptionStart = :receptionStart, receptionEnd = :receptionEnd, timezone = :timezone, marriageLocation = :marriageLocation, marriageGMaps = :marriageGMaps, receptionLocation = :receptionLocation, receptionGMaps = :receptionGMaps WHERE eventID = :eventID";
        $this->db->query($query);
        $this->db->bind('eventID', $data['eventID']);
        $this->db->bind('maleName', $data['maleName']);
        $this->db->bind('maleFullname', $data['maleFullname']);
        $this->db->bind('femaleName', $data['femaleName']);
        $this->db->bind('femaleFullname', $data['femaleFullname']);
        empty($data['marriageDate']) ? $data['marriageDate'] = null : $data['marriageDate'] = $data['marriageDate'];
        empty($data['receptionDate']) ? $data['receptionDate'] = null : $data['receptionDate'] = $data['receptionDate'];
        empty($data['marriageStart']) ? $data['marriageStart'] = null : $data['marriageStart'] = $data['marriageStart'];
        empty($data['marriageEnd']) ? $data['marriageEnd'] = null : $data['marriageEnd'] = $data['marriageEnd'];
        empty($data['receptionStart']) ? $data['receptionStart'] = null : $data['receptionStart'] = $data['receptionStart'];
        empty($data['receptionEnd']) ? $data['receptionEnd'] = null : $data['receptionEnd'] = $data['receptionEnd'];
        empty($data['timezone']) ? $data['timezone'] = 'WIB' : $data['timezone'] = $data['timezone'];
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