  <div class="bodyy">  
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/console/editEvent" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-bottom: 90px;">
          <input type="hidden" name="eventID" value="<?= $data['event']['eventID']; ?>">
          <div class="row">
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="maleName" name="maleName" placeholder="Nama Panggilan Pria" 
                            value="<?= $data['event']['maleName']; ?>" required>
                      <label for="maleName">Nama Panggilan Mempelai Pria</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="maleFullname" name="maleFullname" placeholder="Nama Lengkap Pria" 
                            value="<?= $data['event']['maleFullname']; ?>" required>
                      <label for="maleFullname">Nama Lengkap Mempelai Pria</label>
                  </div>
              </div>
          </div>

          <div class="row">
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="femaleName" name="femaleName" placeholder="Nama Panggilan Wanita" 
                            value="<?= $data['event']['femaleName']; ?>" required>
                      <label for="femaleName">Nama Panggilan Mempelai Wanita</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" id="femaleFullname" name="femaleFullname" placeholder="Nama Lengkap Wanita" 
                            value="<?= $data['event']['femaleFullname']; ?>" required>
                      <label for="femaleFullname">Nama Lengkap Mempelai Wanita</label>
                  </div>
              </div>
          </div>

          <div class="row">
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="marriageDate" value="<?= $data['event']['marriageDate'] ?? ''; ?>">
                    <label>Tanggal Pernikahan</label>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="marriageStart" value="<?= $data['event']['marriageStart'] ?? ''; ?>">
                            <label>Jam Mulai</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="marriageEnd" value="<?= $data['event']['marriageEnd'] ?? ''; ?>">
                            <label>Jam Selesai</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" name="receptionDate" value="<?= $data['event']['receptionDate'] ?? ''; ?>">
                    <label>Tanggal Resepsi</label>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="receptionStart" value="<?= $data['event']['receptionStart'] ?? ''; ?>">
                            <label>Jam Mulai</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <input type="time" class="form-control" name="receptionEnd" value="<?= $data['event']['receptionEnd'] ?? ''; ?>">
                            <label>Jam Selesai</label>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="form-floating mb-3">
              <select class="form-select" name="timezone">
                <option value="WIB" <?= (isset($data['event']['timezone']) && $data['event']['timezone'] == 'WIB') ? 'selected' : ''; ?>>WIB (Waktu Indonesia Barat)</option>
                <option value="WITA" <?= (isset($data['event']['timezone']) && $data['event']['timezone'] == 'WITA') ? 'selected' : ''; ?>>WITA (Waktu Indonesia Tengah)</option>
                <option value="WIT" <?= (isset($data['event']['timezone']) && $data['event']['timezone'] == 'WIT') ? 'selected' : ''; ?>>WIT (Waktu Indonesia Timur)</option>
              </select>
              <label>Zona Waktu</label>
            </div>
          </div>

          <div class="row">
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="marriageLocation" value="<?= $data['event']['marriageLocation']; ?>">
                      <label>Lokasi Pernikahan</label>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="marriageGMaps" value="<?= $data['event']['marriageGMaps']; ?>">
                      <label>Google Maps Pernikahan (URL)</label>
                  </div>
              </div>
              <div class="col-md">
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="receptionLocation" value="<?= $data['event']['receptionLocation']; ?>">
                      <label>Lokasi Resepsi</label>
                  </div>
                  <div class="form-floating mb-3">
                      <input type="text" class="form-control" name="receptionGMaps" value="<?= $data['event']['receptionGMaps']; ?>">
                      <label>Google Maps Resepsi (URL)</label>
                  </div>
              </div>
          </div>

          <hr class="my-4">
          <h4 class="mb-3">Love Story</h4>
          <div id="story-container">
              <?php foreach($data['stories'] as $story) : ?>
              <div class="row story-item mb-3">
                  <div class="col-md-4">
                      <div class="form-floating">
                          <input type="text" class="form-control" name="storyTitle[]" value="<?= $story['title']; ?>">
                          <label>Judul Cerita</label>
                      </div>
                  </div>
                  <div class="col-md-7">
                      <div class="form-floating">
                          <textarea class="form-control" name="storyDescription[]" style="height: 100px"><?= $story['description']; ?></textarea>
                          <label>Deskripsi Cerita</label>
                      </div>
                  </div>
                  <div class="col-md-1 d-flex align-items-center">
                      <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                  </div>
              </div>
              <?php endforeach; ?>
          </div>
          <button type="button" class="btn btn-secondary btn-sm mb-4" id="add-story">+ Tambah Cerita</button>

          <hr class="my-4">
          <h4 class="mb-3">Digital Envelope</h4>
          <div id="envelope-container">
              <?php foreach($data['envelopes'] as $env) : ?>
              <div class="row envelope-item mb-3">
                  <div class="col-md-2">
                      <select class="form-select py-3" name="envelopeType[]" onchange="changeList(this)">
                          <option value="Bank" <?= ($env['type'] == 'Bank') ? 'selected' : ''; ?>>Bank</option>
                          <option value="E-Wallet" <?= ($env['type'] == 'E-Wallet') ? 'selected' : ''; ?>>E-Wallet</option>
                      </select>
                  </div>
                  <div class="col-md-2">
                      <input type="text" class="form-control py-3" name="envelopeCompany[]" list="<?= ($env['type'] == 'Bank') ? 'bankList' : 'ewalletList'; ?>" placeholder="Nama Bank/App" value="<?= $env['company']; ?>">
                  </div>
                  <div class="col-md-4">
                      <input type="text" class="form-control py-3" name="envelopeNumber[]" placeholder="Nomor Rekening/E-Wallet" value="<?= $env['number']; ?>">
                  </div>
                  <div class="col-md-3">
                      <input type="text" class="form-control py-3" name="envelopeName[]" placeholder="Nama Penerima" value="<?= $env['name']; ?>">
                  </div>
                  <div class="col-md-1 d-flex align-items-center">
                      <button type="button" class="btn btn-danger btn-sm remove-row">X</button>
                  </div>
              </div>
              <?php endforeach; ?>
          </div>
          <button type="button" class="btn btn-secondary btn-sm" id="add-envelope">+ Tambah Rekening</button>

          <datalist id="bankList">
                <option value="BCA">BCA (Bank Central Asia)</option>
                <option value="Mandiri">Mandiri (Bank Mandiri)</option>
                <option value="BNI">BNI (Bank Negara Indonesia)</option>
                <option value="BRI">BRI (Bank Rakyat Indonesia)</option>
                <option value="BSI">BSI (Bank Syariah Indonesia)</option>
                <option value="BTN">BTN (Bank Tabungan Negara)</option>
                <option value="DBS">DBS Bank</option>
                <option value="Jago">Bank Jago</option>
                <option value="SeaBank">SeaBank</option>
            </datalist>

            <datalist id="ewalletList">
                <option value="GoPay">GoPay</option>
                <option value="Dana">Dana</option>
                <option value="LinkAja">LinkAja</option>
                <option value="ShopeePay">ShopeePay</option>
            </datalist>

          <div class="mt-5 text-center">
              <button type="submit" class="btn btn-success btn-lg px-5">Perbarui Data Acara</button>
              <a href="<?= BASEURL; ?>/console" class="btn btn-outline-secondary btn-lg">Batal</a>
          </div>
        </div>
    </form>
    <script>
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-row')) {
            const row = e.target.closest('.row');
            if (row.parentNode.querySelectorAll('.row').length > 1) {
                row.remove();
            } else {
                alert('Minimal harus ada satu baris data!');
            }
        }
    });

    document.getElementById('add-story').addEventListener('click', function() {
        const container = document.getElementById('story-container');
        const newRow = `
        <div class="row story-item mb-3">
            <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" name="storyTitle[]"><label>Judul Cerita</label></div></div>
            <div class="col-md-7"><div class="form-floating"><textarea class="form-control" name="storyDescription[]" style="height: 100px"></textarea><label>Deskripsi Cerita</label></div></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>
        </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
    });

    document.getElementById('add-envelope').addEventListener('click', function() {
        const container = document.getElementById('envelope-container');
        const newRow = `
        <div class="row envelope-item mb-3">
            <div class="col-md-2"><select class="form-select py-3" name="envelopeType[]" onchange="changeList(this)"><option value="Bank">Bank</option><option value="E-Wallet">E-Wallet</option></select></div>
            <div class="col-md-2"><input type="text" class="form-control py-3" name="envelopeCompany[]" list="bankList" placeholder="Nama Bank/App"></div>
            <div class="col-md-4"><input type="text" class="form-control py-3" name="envelopeNumber[]" placeholder="Nomor Rekening/E-Wallet"></div>
            <div class="col-md-3"><input type="text" class="form-control py-3" name="envelopeName[]" placeholder="Nama Penerima"></div>
            <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>
        </div>`;
        container.insertAdjacentHTML('beforeend', newRow);
    });

    // Fungsi untuk mengganti datalist berdasarkan pilihan Type
    function changeList(element) {
        // Cari input text 'envelopeCompany' yang berada di baris yang sama
        const row = element.closest('.envelope-item');
        const inputCompany = row.querySelector('input[name="envelopeCompany[]"]');
        const inputNumber = row.querySelector('input[name="envelopeNumber[]"]');
        
        if (element.value === 'Bank') {
            inputCompany.setAttribute('list', 'bankList');
            inputCompany.setAttribute('placeholder', 'Nama Bank');
            inputNumber.setAttribute('placeholder', 'Nomor Rekening');
        } else {
            inputCompany.setAttribute('list', 'ewalletList');
            inputCompany.setAttribute('placeholder', 'Nama App');
            inputNumber.setAttribute('placeholder', 'Nomor E-Wallet');
        }
        // Kosongkan nilai jika tipe diganti agar user memilih ulang (opsional)
        inputCompany.value = ''; 
        inputNumber.value = '';
    };
    </script>
  </div>