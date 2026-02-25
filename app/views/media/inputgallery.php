<div class="bodyy container py-5">
    <div class="row">
        <div class="col-md-12">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h4 class="fw-bold mb-4 text-center">Upload Foto Gallery</h4>
            
            <form action="<?= BASEURL ?>/console/newgallery" method="post" enctype="multipart/form-data">
                <input type="hidden" name="eventID" value="<?= $data['eventID']; ?>">
                
                <div id="gallery-container" class="row g-4"> 
                    <div class="col-md-4 gallery-item">
                        <div class="card border-0 shadow-sm p-4 h-100 position-relative">
                            <div class="position-absolute top-0 end-0 m-2">
                                <button type="button" class="btn btn-danger btn-sm remove-col" title="Hapus Slot">
                                    <i class="bi bi-x"></i>
                                </button>
                            </div>
                            <div class="text-center p-3 border-dashed rounded bg-light h-100 d-flex flex-column justify-content-center">
                                <i class="bi bi-cloud-arrow-up text-gold fs-1"></i>
                                <label class="form-label d-block mt-2 fw-bold small">Pilih File Gambar</label>
                                <input type="file" name="imggallery[]" class="form-control form-control-sm" multiple>
                                <div class="mt-3 x-small text-muted">
                                    <span class="d-block">Format: JPG, JPEG, PNG</span>
                                    <span class="d-block">Maks: 4MB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-5">
                    <button type="button" class="btn btn-outline-secondary border-dashed mb-2" id="add-col">
                        <i class="bi bi-plus-circle me-1"></i> Tambah Slot Foto
                    </button>
                    <button type="submit" class="btn btn-gold py-2 shadow-sm">
                        <i class="bi bi-check2-all me-1"></i> Simpan Koleksi Gallery
                    </button>
                    <a href="<?= BASEURL; ?>/console/media" class="btn btn-link text-muted text-decoration-none small">Batalkan & Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('click', function (e) {
        // Fungsi Hapus Kolom (Event Delegation)
        if (e.target.closest('.remove-col')) {
            const container = document.getElementById('gallery-container');
            const col = e.target.closest('.col-md-4');
            
            // Sisakan minimal 1 kolom
            if (container.querySelectorAll('.col-md-4').length > 1) {
                col.remove();
            } else {
                alert('Minimal harus ada satu slot foto!');
            }
        }
    });

    // Tambah Kolom Baru (Horizontal Grid)
    document.getElementById('add-col').addEventListener('click', function() {
        const container = document.getElementById('gallery-container');
        const newCol = `
        <div class="col-md-4 gallery-item">
            <div class="card border-0 shadow-sm p-4 h-100 position-relative">
                <div class="position-absolute top-0 end-0 m-2">
                    <button type="button" class="btn btn-danger btn-sm remove-col"><i class="bi bi-x"></i></button>
                </div>
                <div class="text-center p-3 border-dashed rounded bg-light h-100 d-flex flex-column justify-content-center">
                    <i class="bi bi-cloud-arrow-up text-gold fs-1"></i>
                    <label class="form-label d-block mt-2 fw-bold small">Pilih File Gambar</label>
                    <input type="file" name="imggallery[]" class="form-control form-control-sm" multiple>
                    <div class="mt-3 x-small text-muted">
                        <span class="d-block">Format: JPG, JPEG, PNG</span>
                        <span class="d-block">Maks: 4MB</span>
                    </div>
                </div>
            </div>
        </div>`;
        container.insertAdjacentHTML('beforeend', newCol);
    });

    // Validasi Format dan Ukuran File untuk Gallery
    document.getElementById('gallery-container').addEventListener('change', function(e) {
        // Pastikan yang berubah adalah input file gallery
        if (e.target.type === 'file' && e.target.name === 'imggallery[]') {
            const files = e.target.files;
            const maxSize = 4 * 1024 * 1024; // 4MB
            const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i; // Format yang diizinkan

            // Karena input bisa multiple, cek satu per satu
            for (let i = 0; i < files.length; i++) {
                const file = files[i];

                // 1. Cek Ukuran File
                if (file.size > maxSize) {
                    alert('File "' + file.name + '" terlalu besar! Maksimal ukuran adalah 4MB.');
                    e.target.value = ''; // Reset input jika gagal
                    return;
                }

                // 2. Cek Ekstensi/Format File
                if (!allowedExtensions.exec(file.name)) {
                    alert('Format file "' + file.name + '" tidak diizinkan! Gunakan JPG, JPEG, atau PNG.');
                    e.target.value = ''; // Reset input jika gagal
                    return;
                }
            }
        }
    });
</script>

<style>
    .border-dashed {
        border: 2px dashed #dee2e6 !important;
    }
    .x-small {
        font-size: 0.75rem;
    }
    .btn-gold {
        background-color: #C5A059;
        color: white;
    }
    .btn-gold:hover {
        background-color: #b38f4d;
        color: white;
    }
</style>