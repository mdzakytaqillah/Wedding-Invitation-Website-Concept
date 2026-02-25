<div class="bodyy container py-5">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <?php Flasher::flash(); ?>
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-shield-lock me-2 text-gold"></i>Kelola Multi-Akses Media</h4>
                    <button type="button" class="btn btn-gold btn-sm" id="add-share">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Media
                    </button>
                </div>
                
                <form action="<?= BASEURL ?>/console/newsharing" method="post">
                    <input type="hidden" name="eventID" value="<?= $data['eventID']; ?>">
                    <div id="share-container">
                        </div>

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-gold px-5 py-2 shadow-sm">Simpan Pengaturan Akses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<template id="share-template">
    <div class="share-item bg-light p-4 rounded-3 mb-4 border-start border-gold border-4 shadow-sm position-relative">
        <button type="button" class="btn btn-danger btn-sm remove-share position-absolute top-0 end-0 m-2"><i class="bi bi-x"></i></button>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="small fw-bold mb-1">Nama Folder/Media</label>
                <input type="text" name="shareName[INDEX][]" class="form-control" placeholder="Contoh: Foto Akad Nikah" required>
            </div>
            <div class="col-md-8">
                <label class="small fw-bold mb-1">Link Google Drive</label>
                <input type="url" name="shareLink[INDEX][]" class="form-control" placeholder="https://drive.google.com/..." required>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold mb-1">Tipe Akses</label>
                <select name="isPublic[INDEX][]" class="form-select access-type" onchange="toggleAccessFields(this)">
                    <option value="1">Publik (Semua Tamu)</option>
                    <option value="0">Terbatas (Grup / Tamu Tertentu)</option>
                </select>
            </div>
            <div class="col-md-4 access-restricted d-none">
                <label class="small fw-bold mb-1">Pilih Grup</label>
                <div class="checkbox-container border rounded bg-white p-3 shadow-inner" style="max-height: 150px; overflow-y: auto;">
                    <?php foreach($data['groups'] as $group) : ?>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox" name="groupID[INDEX][]" value="<?= $group['groupID']; ?>" id="group-INDEX-<?= $group['groupID']; ?>">
                        <label class="form-check-label small" for="group-INDEX-<?= $group['groupID']; ?>">
                            <?= $group['groupName']; ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-5 access-restricted d-none">
                <label class="small fw-bold mb-1">Pilih Tamu</label>
                <div class="checkbox-container border rounded bg-white p-3 shadow-inner" style="max-height: 150px; overflow-y: auto;">
                    <?php foreach($data['guests'] as $guest) : ?>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="checkbox" name="guestID[INDEX][]" value="<?= $guest['guestID']; ?>" id="guest-INDEX-<?= $guest['guestID']; ?>">
                        <label class="form-check-label small" for="guest-INDEX-<?= $guest['guestID']; ?>">
                            <?= $guest['guestName']; ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    let rowIdx = 0;

    function toggleAccessFields(selectElement) {
        const parentItem = selectElement.closest('.share-item');
        const restrictedFields = parentItem.querySelectorAll('.access-restricted');
        if (selectElement.value === "0") {
            restrictedFields.forEach(el => el.classList.remove('d-none'));
        } else {
            // Uncheck semua checkbox jika akses diubah kembali ke publik agar data bersih
            parentItem.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            restrictedFields.forEach(el => el.classList.add('d-none'));
        }
    }

    function addRow() {
        const container = document.getElementById('share-container');
        const template = document.getElementById('share-template').innerHTML;
        
        // Ganti INDEX untuk name dan id (id harus unik agar label berfungsi)
        const newRow = template.replace(/INDEX/g, rowIdx);
        container.insertAdjacentHTML('beforeend', newRow);
        rowIdx++;
    }

    document.addEventListener('DOMContentLoaded', addRow);
    document.getElementById('add-share').addEventListener('click', addRow);

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-share')) {
            const items = document.querySelectorAll('.share-item');
            if (items.length > 1) {
                e.target.closest('.share-item').remove();
            } else {
                alert('Minimal harus ada satu baris media!');
            }
        }
    });
</script>

<style>
    .checkbox-container::-webkit-scrollbar {
        width: 6px;
    }
    .checkbox-container::-webkit-scrollbar-thumb {
        background-color: #C5A059;
        border-radius: 10px;
    }
    .checkbox-container::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .shadow-inner {
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
    }
</style>