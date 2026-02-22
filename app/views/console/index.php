  <div class="bodyy">  
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <div class="accneed">
        <h3 class="fw-bold mb-3">Selamat datang, <?= $data['name']; ?>!</h3>
        <div class="row" style="margin: 26px 0;">
          <div class="col-md-6">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= isset($data['event']['maleName']) && isset($data['event']['femaleName']) ? $data['event']['maleName'] . ' & ' . $data['event']['femaleName'] : 'Event tidak tersedia'; ?></h5>
                <p class="card-text"><?= isset($data['event']['receptionDate']) && !empty($data['event']['receptionDate']) ? $data['tanggalresepsi'] : 'Tanggal tidak tersedia'; ?> <?= isset($data['wakturesepsi']) ? $data['wakturesepsi'] : ''; ?></p>
                <a href="<?= BASEURL; ?>/console/event" class="card-link"><?= !empty($data['event']) ? 'Edit' : 'Masukkan'; ?> Data Acara</a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Turut Mengelola</h5>
                <p class="card-text"><?= $data['adminCount']['count']; ?> Orang</p>
                <a href="<?= BASEURL; ?>/console/signup/1" class="card-link">Tambah Pengelola</a>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title">Turut Mengundang</h5>
                <p class="card-text"><?= $data['inviterCount']['count']; ?> Orang</p>
                <a href="<?= BASEURL; ?>/console/signup/2" class="card-link">Tambah Pengundang</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row my-4" style="<?= $data['messageCount']['total'] == 0 ? 'display: none;' : '' ?>">
          <div class="col-12">
            <h3 class="fw-bold mb-3"><i class="bi bi-chat-left-heart me-2 text-gold"></i>Moderasi Ucapan & Pesan</h3>
        
            <?php if (!empty($data['NotApprovedMessage'])): ?>
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-warning bg-opacity-10 border-0 py-3">
                    <h5 class="card-title mb-0 text-warning-emphasis fw-bold">
                        <i class="bi bi-hourglass-split me-2"></i>Menunggu Persetujuan
                        <span class="badge rounded-pill bg-warning ms-2"><?= count($data['NotApprovedMessage']); ?></span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php foreach ($data['NotApprovedMessage'] as $message): ?>
                            <div class="list-group-item p-3 border-bottom">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="me-auto">
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($message['guestName']); ?></div>
                                        <div class="text-muted small italic mt-1">
                                            "<?= nl2br(htmlspecialchars($message['messageContent'])); ?>"
                                        </div>
                                    </div>
                                    
                                    <form method="POST" action="<?= BASEURL; ?>/console/approveMessage" 
                                          style="<?= $_SESSION['roleRank'] > 1 || $message['publish'] == 0 ? 'display: none;' : '' ?>">
                                        <input type="hidden" name="messageID" value="<?= $message['messageID']; ?>">
                                        <button type="submit" class="btn btn-sm btn-success shadow-sm px-3">
                                            <i class="bi bi-check2-circle me-1"></i>Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="<?= BASEURL; ?>/console/rejectMessage" 
                                          style="<?= $_SESSION['roleRank'] > 1 || $message['publish'] == 0 ? 'display: none;' : '' ?>">
                                        <input type="hidden" name="messageID" value="<?= $message['messageID']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger shadow-sm px-3">
                                            <i class="bi bi-x-circle me-1"></i>Tolak
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['PrivateMessage'])): ?>
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <h5 class="card-title mb-0 text-info-emphasis fw-bold">
                      Pesan Privat
                      <span class="badge rounded-pill bg-info ms-2"><?= count($data['PrivateMessage']); ?></span>
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($data['PrivateMessage'] as $message): ?>
                        <div class="list-group-item p-3 border-start border-info border-4">
                            <div class="fw-bold"><?= htmlspecialchars($message['guestName']); ?></div>
                            <div class="text-muted small italic">"<?= nl2br(htmlspecialchars($message['messageContent'])); ?>"</div>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['ApprovedMessage'])): ?>
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                    <h5 class="card-title mb-0 text-success-emphasis fw-bold">
                        <i class="bi bi-check-all me-2"></i>Pesan Terbit
                        <span class="badge rounded-pill bg-success ms-2"><?= count($data['ApprovedMessage']); ?></span>
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        <?php foreach ($data['ApprovedMessage'] as $message): ?>
                            <div class="list-group-item p-3 border-bottom bg-light bg-opacity-25">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="rounded-circle bg-success bg-opacity-10 p-2">
                                            <i class="bi bi-chat-quote text-success"></i>
                                        </div>
                                    </div>
                                    <div class="ms-3">
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($message['guestName']); ?></div>
                                        <div class="text-muted small mt-1">
                                            <?= nl2br(htmlspecialchars($message['messageContent'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
              </div>
            <?php endif; ?>

            <?php if (!empty($data['RejectedMessage'])): ?>
              <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-danger bg-opacity-10 border-0 py-3">
                    <h5 class="card-title mb-0 text-danger-emphasis fw-bold">
                      Pesan Ditolak
                      <span class="badge rounded-pill bg-danger ms-2"><?= count($data['RejectedMessage']); ?></span>
                    </h5>
                </div>
                <div class="list-group list-group-flush">
                    <?php foreach ($data['RejectedMessage'] as $message): ?>
                        <div class="list-group-item p-3 border-start border-danger border-4">
                            <div class="fw-bold"><?= htmlspecialchars($message['guestName']); ?></div>
                            <div class="text-muted small italic">"<?= nl2br(htmlspecialchars($message['messageContent'])); ?>"</div>
                        </div>
                    <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
    </div>
  </div>      
<script>
if(<?= !isset($_SESSION['login']) || $_SESSION['idAkun'] != $data['id']?>){
  var elements = document.getElementsByClassName("accneed");
  for (var i = 0; i < elements.length; i++) {
      elements[i].style.display = "none";
  }
}
</script>