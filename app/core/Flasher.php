<?php
class Flasher{
    public static function setFlash($pesan, $tipe){
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'tipe' => $tipe
        ];
    }

    public static function flash(){
        if(isset($_SESSION['flash'])){
            $pesan = $_SESSION['flash']['pesan'];
            $tipe = $_SESSION['flash']['tipe'];

            // JIKA TIPE SUCCESS: Gunakan SweetAlert2
            if ($tipe == 'success') {
                echo "
                <script>
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: '$pesan',
                        showConfirmButton: false,
                        timer: 2000,
                        showCloseButton: true,
                        allowOutsideClick: true
                    });
                </script>";
            } 
            // JIKA BUKAN SUCCESS: Gunakan Bootstrap Alert standar
            else {
                echo '<div class="alert alert-' . $_SESSION['flash']['tipe'] . ' alert-dismissible fade show" role="alert">
                        ' . $_SESSION['flash']['pesan'] . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
            }
            unset($_SESSION['flash']);
        }
    }
}