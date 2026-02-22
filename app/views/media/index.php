<div class="bodyy">
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <img src="<?= BASEURL ?>/img/gallery/<?= $data['cover']['fileName'] ?>" alt="cover" class="img-fluid mb-3">
                    <h5 class="card-title">Cover</h5>
                    <p class="card-text">Foto cover acara yang akan ditampilkan pada halaman utama.</p>
                    <a href="<?= BASEURL; ?>/console/inputcover" class="card-link"><?= empty($data['cover']) ? 'Masukkan Cover' : 'Edit Cover' ?></a>
                </div>
            </div>
        </div>
    </div>
</div>