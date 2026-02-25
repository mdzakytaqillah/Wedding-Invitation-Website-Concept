<?php
class Home extends Controller {
    public function index($id = null){
        if($id){
            $guest = $this->model('guest_model')->getTamuByGuestCode($id);
            if($guest){
                $data['guestCode'] = $guest['guestCode'];
                $data['guestID'] = $guest['guestID'];
                $data['guestPrefix'] = $guest['prefix'];
                $data['guestName'] = $guest['guestName'];
                $data['guestSuffix'] = $guest['suffix'];
                $data['share'] = $this->model('media_model')->getMediaAccess($guest['groupID'], $guest['guestID']);
            } else {
                header('Location: ' . BASEURL);
                exit;
            }
        }
        $data['event'] = $this->model('event_model')->getEvent();
        $cover = $this->model('media_model')->getCoverPage();
        $data['coverpath'] = !empty($cover['fileName']) && file_exists('img/gallery/' . $cover['fileName']) ? BASEURL . '/img/gallery/' . $cover['fileName'] : 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80';
        $youtube = $this->model('media_model')->getYouTube();
        if(!empty($youtube)){
            $data['YTvideoID'] = Helper::getYouTubeID($youtube['fileLink']);
        }
        $data['story'] = $this->model('event_model')->getStory();
        $data['envelope'] = $this->model('event_model')->getEnvelope();
        $data['tanggalakad'] = !empty($data['event']['marriageDate']) ? Helper::tanggalText($data['event']['marriageDate']) : null;
        $data['tanggalresepsi'] = !empty($data['event']['receptionDate']) ? Helper::tanggalText($data['event']['receptionDate']) : null;
        $data['waktuakad'] = !empty($data['event']['marriageStart']) ? Helper::waktuText($data['event']['marriageStart'], $data['event']['marriageEnd'], $data['event']['timezone']) : null;
        $data['wakturesepsi'] = !empty($data['event']['receptionStart']) ? Helper::waktuText($data['event']['receptionStart'], $data['event']['receptionEnd'], $data['event']['timezone']) : null;
        $data['iso8601akad'] = !empty($data['event']['marriageDate']) ? Helper::ISO8601Timestamp($data['event']['marriageDate'], $data['event']['marriageStart'], $data['event']['timezone']) : null;
        $data['iso8601resepsi'] = !empty($data['event']['receptionDate']) ? Helper::ISO8601Timestamp($data['event']['receptionDate'], $data['event']['receptionStart'], $data['event']['timezone']) : null;
        $locakad = !empty($data['event']['marriageGMaps']) ? $data['event']['marriageGMaps'] : null;
        $locresepsi = !empty($data['event']['receptionGMaps']) ? $data['event']['receptionGMaps'] : null;
        $data['locakad'] = Helper::urlnormalize($locakad);
        $data['locresepsi'] = Helper::urlnormalize($locresepsi);
        $data['gallery'] = $this->model('media_model')->getGallery();
        $data['ucapan'] = $this->model('message_model')->displayMessage();
        if(!empty($data['event'])){
            $this->view('home/index', $data);
        } else {
            header('Location: ' . BASEURL . '/console');
            exit;
        }
    }

    public function sendMessage(){
        if($this->model('message_model')->newMessage($_POST)){
            if(!empty($_POST['guestCode'])){
                header('Location: ' . BASEURL . '/' . $_POST['guestCode'] . '#message-section');
            }else{
                header('Location: ' . BASEURL . '#message-section');
            }
            alert('Ucapan berhasil dikirim!');
            exit;
        }else{
            header('Location: ' . BASEURL);
            alert('Terjadi kesalahan saat mengirim ucapan. Silakan coba lagi.');
            exit;
        }
    }
}