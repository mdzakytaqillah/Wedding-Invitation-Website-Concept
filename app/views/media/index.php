<div class="bodyy">
    <div class="row mb-3">
        <div class="col-md-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>

    <div class="d-flex align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0"><i class="bi bi-images me-2 text-gold"></i>Kelola Media</h3>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden">
                <div class="position-relative">
                    <img src="<?= $data['coverpath'] ?>" alt="cover" class="card-img-top" style="height: 180px; object-fit: cover;">
                    <div class="position-absolute top-0 end-0 m-2">
                        <span class="badge bg-gold">Hero Cover</span>
                    </div>
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="fw-bold">Cover Utama</h5>
                    <p class="text-muted small">Foto ini akan muncul pertama kali saat tamu membuka undangan.</p>
                    <div class="mt-auto d-flex gap-2">
                        <button type="button" class="btn btn-sm btn-outline-dark w-100" data-bs-toggle="modal" data-bs-target="#modalCover">
                            <?= empty($data['cover']) ? 'Masukkan Cover' : 'Ganti Cover' ?>
                        </button>
                        <button onclick="confirm('Hapus cover?') ? location.href='<?= BASEURL; ?>/console/resetcover' : '';" 
                                style="<?= empty($data['cover']) ? 'display:none;' : '' ?>" 
                                class="btn btn-sm btn-danger"><i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column">
                    <div class="text-gold mb-2"><i class="bi bi-grid-3x3-gap-fill fs-1"></i></div>
                    <h5 class="fw-bold">Galeri Foto</h5>
                    <p class="text-muted small">Koleksi momen indah dalam bentuk kolase di halaman utama.</p>
                    <p class="fw-bold small mb-3">Total: <span class="text-gold"><?= isset($data['gallery']) ? count($data['gallery']) : 0 ?> Foto</span></p>
                    <div class="mt-auto d-flex gap-2">
                        <a href="<?= BASEURL; ?>/console/inputgallery" class="btn btn-sm btn-dark w-100">Tambah Foto</a>
                        <a href="<?= BASEURL; ?>/console/gallery" class="btn btn-sm btn-outline-dark w-100">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex flex-column border-start border-danger border-4">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div class="text-danger"><i class="bi bi-youtube fs-1"></i></div>
                        <?php if(!empty($data['youtube'])): ?>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">Aktif</span>
                        <?php endif; ?>
                    </div>
                    
                    <h5 class="fw-bold">Video YouTube</h5>
                    <p class="text-muted small">Sematkan video pre-wedding atau momen spesial kamu langsung dari YouTube di halaman undangan.</p>

                    <?php if(!empty($data['youtube'])): ?>
                        <div class="mb-3 rounded overflow-hidden shadow-sm" style="aspect-ratio: 16/9;">
                            <iframe width="100%" height="100%" 
                                    src="https://www.youtube.com/embed/<?= $data['YTvideoID']; ?>" 
                                    frameborder="0" allowfullscreen></iframe>
                        </div>
                    <?php endif; ?>

                    <div class="mt-auto">
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-danger w-100" data-bs-toggle="modal" data-bs-target="#modalYoutube">
                                <?= empty($data['youtube']) ? 'Konfigurasi Video' : 'Ganti Video' ?>
                            </button>
                            <button onclick="confirm('Apakah Anda yakin ingin menghapus video ini?') ? location.href='<?= BASEURL; ?>/console/resetyoutube' : '';" 
                                style="<?= empty($data['youtube']) ? 'display:none;' : '' ?>" 
                                class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold text-dark mb-0">Media Sharing</h4>
            <a href="<?= BASEURL; ?>/console/inputshare" class="btn btn-gold btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Sharing</a>
        </div>
        
        <?php foreach($data['share'] as $share): ?>
            <?php if(!empty($share)): ?>
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="bg-stone-50 p-2 rounded-circle me-3"><i class="bi bi-link-45deg text-gold"></i></div>
                                <div>
                                    <h6 class="mb-0 fw-bold"><?= $share['fileName']; ?></h6>
                                    <a href="<?= !empty($share['fileLink']) ? $share['fileLink'] : '#'; ?>" target="_blank" class="text-gold small">Buka Tautan <i class="bi bi-box-arrow-up-right ms-1"></i></a>
                                </div>
                            </div>
                            <a href="<?= BASEURL; ?>/console/deletemedia/<?= $share['mediaID']; ?>" onclick="return confirm('Hapus media ini?')" class="btn btn-link text-dark p-0"><i class="bi bi-trash me-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>

    <div class="modal fade" id="modalCover" tabindex="-1" aria-labelledby="modalCoverLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 bg-stone-50">
                    <h5 class="modal-title fw-bold" id="modalCoverLabel"><i class="bi bi-image text-gold me-2"></i>Upload Foto Cover</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= BASEURL ?>/console/updatecover" method="post" enctype="multipart/form-data" id="formCover">
                    <div class="modal-body py-4 text-center">
                        <input type="hidden" name="eventID" value="<?= $data['eventID']; ?>">
                        
                        <div class="mb-3 p-4 border border-dashed rounded bg-light">
                            <i class="bi bi-cloud-arrow-up text-gold fs-1 d-block mb-2"></i>
                            <label for="imgcover" class="form-label fw-bold">Pilih File Cover</label>
                            <input type="file" name="imgcover" id="imgcover" class="form-control" required>
                            <div class="mt-3 small text-muted">
                                <span class="d-block">Format: JPG, JPEG, PNG</span>
                                <span class="d-block">Maksimal: 4MB</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gold px-4">Simpan Cover</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalYoutube" tabindex="-1" aria-labelledby="modalYoutubeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header border-0 bg-stone-50">
                    <h5 class="modal-title fw-bold" id="modalYoutubeLabel"><i class="bi bi-youtube text-danger me-2"></i>Link Video YouTube</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formYoutube" action="<?= BASEURL; ?>/console/updateyoutube" method="POST">
                    <div class="modal-body py-4">
                        <input type="hidden" name="eventID" value="<?= $data['eventID']; ?>">
                        <div class="mb-3">
                            <label for="youtube_url" class="form-label fw-bold">Masukkan URL Video</label>
                            <input type="text" name="youtube_url" id="youtube_url" 
                                class="form-control" placeholder="Contoh: https://www.youtube.com/watch?v=..." 
                                required>
                            <div id="urlFeedback" class="invalid-feedback">
                                Format link YouTube tidak valid. Pastikan link berasal dari youtube.com atau youtu.be.
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-link text-muted text-decoration-none" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" id="btnSimpanYoutube" class="btn btn-gold px-4">Simpan Video</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.getElementById('imgcover').addEventListener('change', function() {
        const file = this.files[0];
        const maxSize = 4 * 1024 * 1024; // 4MB
        
        if (file) {
            // Cek ukuran file
            if (file.size > maxSize) {
                alert('Ukuran file terlalu besar! Maksimal adalah 4MB.');
                this.value = ''; // Reset input
            }
            
            // Cek ekstensi file
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
            if (!allowedExtensions.exec(this.value)) {
                alert('Format file tidak diizinkan! Gunakan JPG, JPEG, atau PNG.');
                this.value = '';
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('formYoutube');
        const input = document.getElementById('youtube_url');
        const feedback = document.getElementById('urlFeedback');
        
        // Regex YouTube Universal
        const youtubeRegex = /^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/;

        // Fungsi Validasi
        function validateYoutube() {
            const url = input.value.trim();
            
            if (url === "") {
                input.classList.remove('is-invalid', 'is-valid');
                return false;
            }

            if (youtubeRegex.test(url)) {
                // JIKA VALID
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                return true;
            } else {
                // JIKA TIDAK VALID
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
                return false;
            }
        }

        // Cek setiap kali user mengetik
        input.addEventListener('input', validateYoutube);

        // Blokir submit jika tidak valid
        form.addEventListener('submit', function(e) {
            if (!validateYoutube()) {
                e.preventDefault();
                input.focus();
            }
        });
    });
    </script>
</div>