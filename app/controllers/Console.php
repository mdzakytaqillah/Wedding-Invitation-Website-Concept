<?php
class Console extends Controller {
    # START Main Console Page
    public function index(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        $data['id'] = $_SESSION['idAkun'];
        $data['roleRank'] = $_SESSION['roleRank'];
        $data['event'] = $this->model('event_model')->getEvent();
        $data['adminCount'] = $this->model('akun_model')->adminCounter();
        $data['inviterCount'] = $this->model('akun_model')->inviterCounter();
        $data['messageCount'] = $this->model('message_model')->getMessageCount();
        $data['ApprovedMessage'] = $this->model('message_model')->getMessageApproved();
        $data['NotApprovedMessage'] = $this->model('message_model')->getMessageNotApproved();
        $data['PrivateMessage'] = $this->model('message_model')->getPrivateMessage();
        $data['RejectedMessage'] = $this->model('message_model')->getMessageRejected();
        $person = $this->model('akun_model')->getAkunbyID($_SESSION['idAkun']);
        $data['name'] = $person['Name'];
        $data['tanggalakad'] = !empty($data['event']['marriageDate']) ? Helper::tanggalText($data['event']['marriageDate']) : null;
        $data['tanggalresepsi'] = !empty($data['event']['receptionDate']) ? Helper::tanggalText($data['event']['receptionDate']) : null;
        $data['waktuakad'] = !empty($data['event']['marriageStart']) ? Helper::waktuText($data['event']['marriageStart'], $data['event']['marriageEnd'], $data['event']['timezone']) : null;
        $data['wakturesepsi'] = !empty($data['event']['receptionStart']) ? Helper::waktuText($data['event']['receptionStart'], $data['event']['receptionEnd'], $data['event']['timezone']) : null;
        $data['title'] = 'Console';
        $this->view('frame/header', $data);
        $this->view('console/index', $data);
        $this->view('frame/footer', $data);
    }

    public function event(){
        $data['title'] = 'Event';
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola acara', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $event = $this->model('event_model')->getEvent();
        $viewPage = empty($event) ? 'createevent' : 'editevent';
        if($event){
            $data['event'] = $event;
            $data['stories'] = $this->model('event_model')->getStory($data['event']['eventID']);
            $data['envelopes'] = $this->model('event_model')->getEnvelope($data['event']['eventID']);
        }
        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }
        $this->view('frame/header', $data);
        $this->view('console/' . $viewPage, $data);
        $this->view('frame/footer', $data);
    }
    # END Main Console Page

    # START Media Console Page
    public function media(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $data['title'] = 'Media';
        $event = $this->model('event_model')->getEvent();
        if(!empty($event)){
            $data['eventID'] = $event['eventID'];
        } else {
            if($_SESSION['roleRank'] > 1){
                Flasher::setFlash('Data acara belum dimuat, hubungi pengelola', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }else if($_SESSION['roleRank'] <= 1) {
                Flasher::setFlash('Anda harus memuat data acara terlebih dahulu', 'warning');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
        }
        $data['cover'] = $this->model('media_model')->getCoverPage();
        $data['coverpath'] = !empty($data['cover']['fileName']) && file_exists('img/gallery/' . $data['cover']['fileName']) ? BASEURL . '/img/gallery/' . $data['cover']['fileName'] : 'https://images.unsplash.com/photo-1519741497674-611481863552?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80';
        $data['gallery'] = $this->model('media_model')->getGallery();
        $data['youtube'] = $this->model('media_model')->getYouTube();
        if(!empty($data['youtube'])){
            $data['YTvideoID'] = Helper::getYouTubeID($data['youtube']['fileLink']);
        }
        $data['share'] = $this->model('media_model')->getMediaSharing();
        $this->view('frame/header', $data);
        $this->view('media/index', $data);
        $this->view('frame/footer', $data);
    }

    public function gallery(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $data['title'] = 'Gallery';
        $data['gallery'] = $this->model('media_model')->getGallery();
        $this->view('frame/header', $data);
        $this->view('media/gallery', $data);
        $this->view('frame/footer', $data);
    }

    public function inputgallery(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $data['title'] = 'Input Gallery';
        $event = $this->model('event_model')->getEvent();
        if(empty($event)){
            if($_SESSION['roleRank'] > 1){
                Flasher::setFlash('Data acara belum dimuat, hubungi pengelola', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }else if($_SESSION['roleRank'] <= 1) {
                Flasher::setFlash('Anda harus memuat data acara terlebih dahulu', 'warning');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
            exit;
        }
        $data['eventID'] = $event['eventID'];
        $this->view('frame/header', $data);
        $this->view('media/inputgallery', $data);
        $this->view('frame/footer', $data);
    }

    public function inputshare(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $data['title'] = 'Input Media Sharing';
        $data['groups'] = $this->model('guest_model')->getGroupList();
        $data['guests'] = $this->model('guest_model')->getTamuWithGroupName();
        $event = $this->model('event_model')->getEvent();
        if(empty($event)){
            if($_SESSION['roleRank'] > 1){
                Flasher::setFlash('Data acara belum dimuat, hubungi pengelola', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }else if($_SESSION['roleRank'] <= 1) {
                Flasher::setFlash('Anda harus memuat data acara terlebih dahulu', 'warning');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
            exit;
        }
        $data['eventID'] = $event['eventID'];
        $this->view('frame/header', $data);
        $this->view('media/inputshare', $data);
        $this->view('frame/footer', $data);
    }
    # END Media Console Page

    # START Guest Console Page
    public function tamu(){
        $data['title'] = 'Tamu';
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }

        $keyword = $_POST['keyword'] ?? '';
        $groupID = $_POST['groupID'] ?? '';
        $addedBy = $_POST['addedBy'] ?? '';
        
        if(!empty($keyword) || !empty($groupID) || !empty($addedBy)) {
            $data['filter'] = [
                'keyword' => $keyword,
                'groupID' => $groupID,
                'addedBy' => $addedBy
            ];
        }

        $data['grup'] = $this->model('guest_model')->getGroupWithGuestsCount();
        $data['tamu'] = $this->model('guest_model')->getTamuFiltered($keyword, $groupID, $addedBy);
        $data['jumlahTamu'] = $this->model('guest_model')->getTamuCount();
        $this->view('frame/header', $data);
        $this->view('tamu/index', $data);
        $this->view('frame/footer', $data);
    }

    public function newGroup(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }

        $event = $this->model('event_model')->getEvent();
        if(empty($event)){
            if($_SESSION['roleRank'] > 1){
                Flasher::setFlash('Data acara belum dimuat, hubungi pengelola', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }else if($_SESSION['roleRank'] <= 1) {
                Flasher::setFlash('Anda harus memuat data acara terlebih dahulu', 'warning');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
            exit;
        }
        $data['value']['eventID'] = $event['eventID'];

        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }
        
        $data['title'] = 'Buat Grup Tamu';
        $this->view('frame/header', $data);
        $this->view('tamu/newgroup', $data);
        $this->view('frame/footer', $data);
    }

    public function editGroup($groupId){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        
        $data['title'] = 'Edit Grup Tamu';
        $data['value'] = $this->model('guest_model')->getGroupById($groupId);
        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }

        $this->view('frame/header', $data);
        $this->view('tamu/editgroup', $data);
        $this->view('frame/footer', $data);
    }

    public function newGuest($groupId = null){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }

        $event = $this->model('event_model')->getEvent();
        if(empty($event)){
            if($_SESSION['roleRank'] > 1){
                Flasher::setFlash('Data acara belum dimuat, hubungi pengelola', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }else if($_SESSION['roleRank'] <= 1) {
                Flasher::setFlash('Anda harus memuat data acara terlebih dahulu', 'warning');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
            exit;
        }
        $data['value']['eventID'] = $event['eventID'];
        $data['groupList'] = $this->model('guest_model')->getGroupList();

        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }
        if(isset($groupId)){
            $data['value']['groupID'] = $groupId;
        }
        
        $data['title'] = 'Tambah Tamu';
        $this->view('frame/header', $data);
        $this->view('tamu/newguest', $data);
        $this->view('frame/footer', $data);
    }

    public function editGuest($guestId){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        
        $data['title'] = 'Edit Tamu';
        $data['value'] = $this->model('guest_model')->getTamuById($guestId);
        if(isset($_SESSION['formtemp'])){
            $data['value'] = $_SESSION['formtemp'];
            $_SESSION['formtemp'] = '';
            unset($_SESSION['formtemp']);
        }
        $data['groupList'] = $this->model('guest_model')->getGroupList();

        $this->view('frame/header', $data);
        $this->view('tamu/editguest', $data);
        $this->view('frame/footer', $data);
    }
    # END Guest Console Page

    # START Page Akun
    public function login(){
        if(isset($_SESSION['login'])){
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        $data['title'] = 'Login Akun';
        $this->view('console/login', $data);
    }

    public function signup($selectedrole = null){
        if(isset($_SESSION['login'])){
            if($_SESSION['roleRank'] <= 1){
                $data['selectedRole'] = $selectedrole;
                $data['title'] = 'Registrasi Akun';
                $this->view('console/daftar', $data);
            } else {
                Flasher::setFlash('Anda tidak memiliki akses untuk membuat akun', 'warning');
                header('Location: ' . BASEURL . '/console');
                exit;
            }
        } else {
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
    }
    # END Page Akun

    # START Akun Function
    public function logout(){
        $_SESSION['login'] = '';
        $_SESSION['idAkun'] = '';
        unset($_SESSION['login']);
        unset($_SESSION['idAkun']);
        header('Location: ' . BASEURL . '/console/login');
        exit;
    }

    public function addAkun(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        } else if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk membuat akun', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('akun_model')->newAkun($_POST) > 0){
            Flasher::setFlash('Akun berhasil didaftarkan', 'success');
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/signup');
            exit;
        }
    }

    public function checkAkun(){
        if($this->model('akun_model')->loginAkun($_POST) > 0){
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
    }
    # END Akun Function

    # START Event Function
    public function newEvent(){
        if(!isset($_SESSION['login']) || $_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk membuat data acara', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if(!empty($this->model('event_model')->getEvent())){
            Flasher::setFlash('Data acara sudah ada', 'warning');
            header('Location: ' . BASEURL . '/console/event');
            exit;
        }
        if (isset($_POST['envelopeNumber'])) {
            foreach ($_POST['envelopeNumber'] as $key => $value) {
                $cleanNumber = preg_replace('/[^0-9]/', '', $value);
                $_POST['envelopeNumber'][$key] = (string)$cleanNumber;
            }
        }
        if(!empty($_POST['marriageGMaps'])){
            if(Helper::urlvalidate('Google Maps', $_POST['marriageGMaps']) === false){
                Flasher::setFlash('Format link Google Maps lokasi Akad Nikah tidak valid. Pastikan link berasal dari Google Maps.', 'danger');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
        }
        if(!empty($_POST['receptionGMaps'])){
            if(Helper::urlvalidate('Google Maps', $_POST['receptionGMaps']) === false){
                Flasher::setFlash('Format link Google Maps lokasi Resepsi tidak valid. Pastikan link berasal dari Google Maps.', 'danger');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
        }
        if($this->model('event_model')->newEvent($_POST, $_FILES) > 0){
            Flasher::setFlash('Data acara berhasil disimpan', 'success');
            if(isset($_SESSION['formtemp'])){
                $_SESSION['formtemp'] = '';
                unset($_SESSION['formtemp']);
            }
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            $_SESSION['formtemp'] = $_POST;
            header('Location: ' . BASEURL . '/console/event');
            exit;
        }
    }

    public function editEvent(){
        if(!isset($_SESSION['login']) || $_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengedit data acara', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if(empty($this->model('event_model')->getEvent())){
            Flasher::setFlash('Data acara belum ada', 'warning');
            header('Location: ' . BASEURL . '/console/event');
            exit;
        }
        $data['value'] = $this->model('event_model')->getEvent();
        if (isset($_POST['envelopeNumber'])) {
            foreach ($_POST['envelopeNumber'] as $key => $value) {
                $cleanNumber = preg_replace('/[^0-9]/', '', $value);
                $_POST['envelopeNumber'][$key] = (string)$cleanNumber;
            }
        }
        if(!empty($_POST['marriageGMaps'])){
            if(Helper::urlvalidate('Google Maps', $_POST['marriageGMaps']) === false){
                Flasher::setFlash('Format link Google Maps lokasi Akad Nikah tidak valid. Pastikan link berasal dari Google Maps.', 'danger');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
        }
        if(!empty($_POST['receptionGMaps'])){
            if(Helper::urlvalidate('Google Maps', $_POST['receptionGMaps']) === false){
                Flasher::setFlash('Format link Google Maps lokasi Resepsi tidak valid. Pastikan link berasal dari Google Maps.', 'danger');
                header('Location: ' . BASEURL . '/console/event');
                exit;
            }
        }
        if($this->model('event_model')->editEvent($_POST, $_FILES) > 0){
            Flasher::setFlash('Data acara berhasil diubah', 'success');
            if(isset($_SESSION['formtemp'])){
                $_SESSION['formtemp'] = '';
                unset($_SESSION['formtemp']);
            }
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            $_SESSION['formtemp'] = $_POST;
            header('Location: ' . BASEURL . '/console/event');
            exit;
        }
    }
    # END Event Function

    # START Guest Function
    public function addgroup(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($this->model('guest_model')->addGroup($_POST) > 0){
            Flasher::setFlash('Grup tamu berhasil ditambahkan', 'success');
            if(isset($_SESSION['formtemp'])){
                $_SESSION['formtemp'] = '';
                unset($_SESSION['formtemp']);
            }
            header('Location: ' . BASEURL . '/console/tamu');
            exit;
        }else{
            $_SESSION['formtemp'] = $_POST;
            header('Location: ' . BASEURL . '/console/newGroup');
            exit;
        }
    }

    public function updateGroup(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }else {
            $group  = $this->model('guest_model')->getGroupById($_POST['groupID']);
            if(empty($group)){
                Flasher::setFlash('Grup tamu tidak ditemukan', 'warning');
                header('Location: ' . BASEURL . '/console/tamu');
                exit;
            }else if($group['addBy'] != $_SESSION['idAkun']) {
                Flasher::setFlash('Anda tidak memiliki akses untuk mengedit grup tamu ini', 'warning');
                header('Location: ' . BASEURL . '/console/tamu');
                exit;
            }else {
                if($this->model('guest_model')->updateGroup($_POST) > 0){
                    Flasher::setFlash('Grup tamu berhasil diubah', 'success');
                    if(isset($_SESSION['formtemp'])){
                        $_SESSION['formtemp'] = '';
                        unset($_SESSION['formtemp']);
                    }
                    header('Location: ' . BASEURL . '/console/tamu');
                    exit;
                }else{
                    $_SESSION['formtemp'] = $_POST;
                    header('Location: ' . BASEURL . '/console/editGroup/' . $_POST['groupID']);
                    exit;
                }
            }
        }
    }

    public function deleteGroup($id) {
        $groupName = $_POST['groupNameConfirm'];
        $typedPhrase = $_POST['phraseConfirmation'];
        
        $requiredPhrase = Helper::userconserned('grup', $groupName);

        if ($typedPhrase !== $requiredPhrase) {
            Flasher::setFlash('Konfirmasi gagal. Frase yang diketik tidak sesuai.', 'danger');
            header('Location: ' . BASEURL . '/console/tamu');
            exit;
        }

        if ($this->model('guest_model')->deleteGroup($id) > 0) {
            Flasher::setFlash('Grup dan seluruh tamu di dalamnya berhasil dihapus.', 'success');
        } else {
            Flasher::setFlash('Gagal menghapus grup. Anda mungkin tidak memiliki akses.', 'danger');
        }
        
        header('Location: ' . BASEURL . '/console/tamu');
        exit;
    }

    public function addguest(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($this->model('guest_model')->addGuest($_POST) > 0){
            Flasher::setFlash('Tamu berhasil ditambahkan', 'success');
            $codechecking = $this->model('guest_model')->isCodeTaken($_POST['guestCode']);
            if(empty($_POST['guestCode'])) {
                Flasher::setFlash('Kode tamu kosong, otomatis menggunakan kode unik baru', 'warning');
            }
            if($codechecking) {
                Flasher::setFlash('Kode tamu sudah digunakan, otomatis menggunakan kode unik baru', 'warning');
            }
            if(isset($_SESSION['formtemp'])){
                $_SESSION['formtemp'] = '';
                unset($_SESSION['formtemp']);
            }
            header('Location: ' . BASEURL . '/console/tamu');
            exit;
        }else{
            $_SESSION['formtemp'] = $_POST;
            header('Location: ' . BASEURL . '/console/newGuest/' . $_POST['groupID']);
            exit;
        }
    }

    public function updateGuest(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }else {
            $guest = $this->model('guest_model')->getTamuById($_POST['guestID']);
            $group  = $this->model('guest_model')->getGroupById($guest['groupID']);
            if($group['addBy'] != $_SESSION['idAkun']) {
                Flasher::setFlash('Anda tidak memiliki akses untuk mengedit tamu ini', 'warning');
                header('Location: ' . BASEURL . '/console/tamu');
                exit;
            }else if(empty($guest)){
                Flasher::setFlash('Tamu tidak ditemukan', 'warning');
                header('Location: ' . BASEURL . '/console/tamu');
                exit;
            }else {
                if($this->model('guest_model')->updateGuest($_POST) > 0){
                    Flasher::setFlash('Tamu berhasil diubah', 'success');
                    $codechecking = $this->model('guest_model')->isCodeTaken($_POST['guestCode'], $_POST['guestID']);
                    if(empty($_POST['guestCode'])) {
                        Flasher::setFlash('Kode tamu kosong, otomatis menggunakan kode unik baru', 'warning');
                    }
                    if($codechecking) {
                        Flasher::setFlash('Kode tamu sudah digunakan, otomatis menggunakan kode unik baru', 'warning');
                    }
                    if(isset($_SESSION['formtemp'])){
                        $_SESSION['formtemp'] = '';
                        unset($_SESSION['formtemp']);
                    }
                    header('Location: ' . BASEURL . '/console/tamu');
                    exit;
                }else{
                    $_SESSION['formtemp'] = $_POST;
                    header('Location: ' . BASEURL . '/console/editGuest/' . $_POST['guestID']);
                    exit;
                }
            }
        }
    }
    # END Guest Function

    # START Message Function
    public function approveMessage(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk menyetujui pesan', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('message_model')->approveMessage($_POST['messageID']) > 0){
            Flasher::setFlash('Pesan berhasil disetujui', 'success');
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console');
            exit;
        }
    }

    public function rejectMessage(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk menolak pesan', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('message_model')->rejectMessage($_POST['messageID']) > 0){
            Flasher::setFlash('Pesan berhasil ditolak', 'success');
            header('Location: ' . BASEURL . '/console');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console');
            exit;
        }
    }
    # END Message Function

    # START Media Function
    public function updatecover(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengatur cover page', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->setCoverPage($_POST, $_FILES) > 0){
            Flasher::setFlash('Cover page berhasil diunggah', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    public function resetcover(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengatur cover page', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->resetCoverPage() > 0){
            Flasher::setFlash('Cover page berhasil direset', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    

    public function newgallery(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola gallery', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->setGallery($_POST, $_FILES) > 0){
            Flasher::setFlash('Gallery berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    public function deletegallery($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola gallery', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->removeGallery($id) > 0){
            Flasher::setFlash('Gallery berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/console/gallery');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/gallery');
            exit;
        }
    }

    public function updateyoutube(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if(Helper::urlvalidate('YouTube', $_POST['youtube_url'])){
            if($this->model('media_model')->updateYouTube($_POST) > 0){
                Flasher::setFlash('Link YouTube berhasil diperbarui', 'success');
                header('Location: ' . BASEURL . '/console/media');
                exit;
            }else{
                header('Location: ' . BASEURL . '/console/media');
                exit;
            }
        }else{
            Flasher::setFlash('Format link YouTube tidak valid. Pastikan link berasal dari youtube.com atau youtu.be.', 'danger');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    public function resetyoutube(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->resetYouTubeLink() > 0){
            Flasher::setFlash('Video YouTube berhasil direset', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    public function newsharing(){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->setMediaSharing($_POST) > 0){
            Flasher::setFlash('Media sharing berhasil ditambahkan', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }

    public function deletemedia($id){
        if(!isset($_SESSION['login'])){
            Flasher::setFlash('Anda harus login terlebih dahulu', 'warning');
            header('Location: ' . BASEURL . '/console/login');
            exit;
        }
        if($_SESSION['roleRank'] > 1){
            Flasher::setFlash('Anda tidak memiliki akses untuk mengelola media', 'warning');
            header('Location: ' . BASEURL . '/console');
            exit;
        }
        if($this->model('media_model')->delete($id) > 0){
            Flasher::setFlash('Media berhasil dihapus', 'success');
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }else{
            header('Location: ' . BASEURL . '/console/media');
            exit;
        }
    }
    # END Media Function
}