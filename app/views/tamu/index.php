<div class="bodyy">
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div>
        <?php if (!isset($data['grup']) || empty($data['grup'])): ?>
            <p>Anda belum menambahkan grup tamu</p>
            <a href="<?= BASEURL ?>/console/newGroup" class="btn btn-primary">Tambah Grup Tamu</a>
        <?php else: ?>
            <div class="row" style="margin: 26px 0;">
                <div class="col-md-2"><h3>Grup Tamu</h3></div>
                <div class="col-md-4"><a href="<?= BASEURL ?>/console/newGroup" class="btn btn-primary">Tambah Grup Tamu</a></div>
            </div>
            <?php foreach ($data['grup'] as $grup): ?>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm overflow-hidden">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title fw-bold text-primary"><?= $grup['groupName']; ?></h5>
                                <span class="badge bg-info text-dark rounded-pill"><?= $grup['guestCount']; ?> Tamu</span>
                            </div>
                            <p class="card-text small text-muted mb-3">
                                <i class="bi bi-person-circle me-1"></i> Oleh: <?= $grup['inviterName']; ?>
                            </p>
                            
                            <div class="d-flex gap-2 border-top pt-3">
                                <a href="<?= BASEURL ?>/console/newGuest/<?= $grup['groupID']; ?>" class="btn btn-sm btn-outline-primary flex-grow-1">Tambah Tamu</a>
                                <a href="<?= BASEURL ?>/console/editGroup/<?= $grup['groupID']; ?>" class="btn btn-sm btn-light"><i class="bi bi-pencil-square"></i></a>
                                
                                <?php if ($grup['addBy'] == $_SESSION['idAkun']): ?>
                                    <button class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteGroup<?= $grup['groupID']; ?>">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteGroup<?= $grup['groupID']; ?>" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0">
                            <div class="modal-header bg-danger text-white">
                                <h5 class="modal-title">Konfirmasi Penghapusan Permanen</h5>
                            </div>
                            <form action="<?= BASEURL ?>/console/deleteGroup/<?= $grup['groupID']; ?>" method="POST">
                                <div class="modal-body text-center p-4">
                                    <p>Menghapus grup <strong><?= $grup['groupName']; ?></strong> akan menghapus <strong>semua tamu</strong> di dalamnya!</p>
                                    <p class="text-muted small">Silakan ketik kalimat di bawah ini secara manual:</p>
                                    <div class="alert alert-secondary py-2 fw-bold user-select-none target-phrase" id="target-<?= $grup['groupID']; ?>">
                                        <?= Helper::userconserned('grup', $grup['groupName']); ?>
                                    </div>
                                    <input type="hidden" name="groupNameConfirm" value="<?= $grup['groupName']; ?>">
                                    <input type="text" class="form-control text-center input-confirmation" 
                                           id="input-<?= $grup['groupID']; ?>" 
                                           name="phraseConfirmation" 
                                           placeholder="Ketik di sini..." 
                                           autocomplete="off" 
                                           onpaste="return false;" 
                                           oncontextmenu="return false;">
                                </div>
                                <div class="modal-footer bg-light border-0">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger btn-confirm-delete" id="btn-<?= $grup['groupID']; ?>">
                                        Ya, Hapus Semuanya
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <hr class="my-3">
            <?php if (empty($data['jumlahTamu']['COUNT(*)'])): ?>
                <p>Anda belum menambahkan tamu</p>
                <a href="<?= BASEURL ?>/console/newGuest" class="btn btn-primary">Tambah Tamu</a>
            <?php else: ?>
                <div class="row" style="margin: 26px 0;">
                    <div class="col-md-2"><h3>Tamu</h3></div>
                    <div class="col-md-4"><a href="<?= BASEURL ?>/console/newGuest" class="btn btn-primary">Tambah Tamu</a></div>
                </div>
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body bg-light">
                        <form action="<?= BASEURL ?>/console/tamu" method="POST">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <input type="text" name="keyword" class="form-control" 
                                        placeholder="Cari Nama atau Kode..." 
                                        value="<?= $data['filter']['keyword'] ?? ''; ?>">
                                </div>
                                
                                <div class="col-md-3">
                                    <select name="groupID" class="form-select">
                                        <option value="">-- Semua Grup --</option>
                                        <?php foreach($data['grup'] as $g) : ?>
                                            <option value="<?= $g['groupID']; ?>" 
                                                <?= (isset($data['filter']['groupID']) && $data['filter']['groupID'] == $g['groupID']) ? 'selected' : ''; ?>>
                                                <?= $g['groupName']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-3">
                                    <select name="addedBy" class="form-select">
                                        <option value="">-- Semua Penginput --</option>
                                        <option value="<?= $_SESSION['idAkun']; ?>" 
                                            <?= (isset($data['filter']['addedBy']) && $data['filter']['addedBy'] == $_SESSION['idAkun']) ? 'selected' : ''; ?>>
                                            Hanya Inputan Saya
                                        </option>
                                    </select>
                                </div>
                                
                                <div class="col-md-3 d-flex gap-2">
                                    <button type="submit" name="search" class="btn btn-primary flex-grow-1">
                                        <i class="bi bi-search me-1"></i> Cari
                                    </button>
                                    <a href="<?= BASEURL ?>/console/tamu" class="btn btn-outline-secondary">
                                        <i class="bi bi-arrow-clockwise"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card border-0 shadow-sm overflow-hidden" id="tamu-table-container">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-3">Nama Tamu</th>
                                    <th>Grup</th>
                                    <th>Kode Unik</th>
                                    <th>Input Oleh</th>
                                    <th class="text-end pe-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="tamu-tbody">
                            <?php foreach ($data['tamu'] as $tamu): ?>
                                <tr>
                                    <td class="ps-3">
                                        <span class="fw-bold">
                                            <?= !empty($tamu['prefix']) ? $tamu['prefix'] . ' ' : ''; ?><?= $tamu['guestName']; ?><?= !empty($tamu['suffix']) ? ', ' . $tamu['suffix'] : ''; ?>
                                        </span>
                                    </td>
                                    <td><span class="badge bg-secondary opacity-75"><?= $tamu['groupName']; ?></span></td>
                                    <td><code class="text-primary fw-bold"><?= $tamu['guestCode']; ?></code></td>
                                    <td><small class="text-muted"><?= $tamu['inviterName']; ?></small></td>
                                    <td class="text-end pe-3">
                                        <a onclick="copyToClipboard('<?= BASEURL ?>/<?= $tamu['guestCode']; ?>')" class="btn btn-sm btn-light">
                                            <i class="bi bi-copy"></i> Copy
                                        </a>
                                        <a href="<?= BASEURL ?>/console/editGuest/<?= $tamu['guestID']; ?>" class="btn btn-sm btn-light">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(
            () => {
                alert("Link berhasil disalin!");
            },
            () => {
                alert("Gagal menyalin.");
            },
            );
        }
    </script>
</div>