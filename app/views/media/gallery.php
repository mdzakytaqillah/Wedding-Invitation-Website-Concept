<div class="bodyy">
    <div class="row mb-3">
        <div class="col-md-6"><?php Flasher::flash(); ?></div>
    </div>
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">Daftar Galeri</h3>
            <a href="<?= BASEURL; ?>/console/media" class="text-muted small text-decoration-none"><i class="bi bi-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
        <a href="<?= BASEURL; ?>/console/inputgallery" class="btn btn-gold px-4">Upload Foto Baru</a>
    </div>

    <div class="row">
        <?php foreach($data['gallery'] as $gallery): ?>
        <div class="col-6 col-md-3 mb-4">
            <div class="card border-0 shadow-sm position-relative group">
                <img src="<?= BASEURL ?>/img/gallery/<?= $gallery['fileName'] ?>" class="card-img-top rounded shadow-sm" style="height: 200px; object-fit: cover;">
                <div class="card-body p-2 text-center">
                    <a href="<?= BASEURL; ?>/console/deletegallery/<?= $gallery['mediaID'] ?>" 
                       onclick="return confirm('Hapus foto ini dari galeri?')"
                       class="btn btn-sm btn-outline-danger w-100 border-0">
                       <i class="bi bi-trash me-1"></i>Hapus
                    </a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if(empty($data['gallery'])): ?>
        <div class="col-12 py-5 text-center">
            <i class="bi bi-image-fill text-muted display-1"></i>
            <p class="text-muted mt-3">Belum ada koleksi foto di galeri Anda.</p>
        </div>
        <?php endif; ?>
    </div>
</div>