  <div class="bodyy">  
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/console/newevent" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-bottom: 90px;">
            <div class="row mt-4">
                <h5 class="fw-bold mb-3 text-gold"><i class="bi bi-gender-male me-2"></i>Detail Mempelai Pria</h5>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="maleName" name="maleName" placeholder="Nama Panggilan Mempelai Pria" value="<?php echo isset($data['value']['maleName']) ? $data['value']['maleName'] : ''; ?>" required>
                            <label for="maleName">Nama Panggilan Mempelai Pria</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="maleFullname" name="maleFullname" placeholder="Nama Lengkap Mempelai Pria" value="<?php echo isset($data['value']['maleFullname']) ? $data['value']['maleFullname'] : ''; ?>" required>
                            <label for="maleFullname">Nama Lengkap Mempelai Pria</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3 text-center">
                        <label class="small fw-bold d-block mb-2">Foto Pria</label>
                        <input type="file" name="malePhoto" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="maleInstagram" placeholder="Instagram" value="<?php echo isset($data['value']['maleInstagram']) ? $data['value']['maleInstagram'] : ''; ?>">
                            <label>Username Instagram (tanpa @)</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="maleFather" placeholder="Nama Ayah" value="<?php echo isset($data['value']['maleFather']) ? $data['value']['maleFather'] : ''; ?>">
                            <label>Nama Ayah Pria</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="maleMother" placeholder="Nama Ibu" value="<?php echo isset($data['value']['maleMother']) ? $data['value']['maleMother'] : ''; ?>">
                            <label>Nama Ibu Pria</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 border-gold opacity-25">
            <div class="row">
                <h5 class="fw-bold mb-3 text-gold"><i class="bi bi-gender-female me-2"></i>Detail Mempelai Wanita</h5>
                <div class="row">
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="femaleName" name="femaleName" placeholder="Nama Panggilan Mempelai Wanita" value="<?php echo isset($data['value']['femaleName']) ? $data['value']['femaleName'] : ''; ?>" required>
                            <label for="femaleName">Nama Panggilan Mempelai Wanita</label>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="femaleFullname" name="femaleFullname" placeholder="Nama Lengkap Mempelai Wanita" value="<?php echo isset($data['value']['femaleFullname']) ? $data['value']['femaleFullname'] : ''; ?>" required>
                            <label for="femaleFullname">Nama Lengkap Mempelai Wanita</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3 text-center">
                        <label class="small fw-bold d-block mb-2">Foto Wanita</label>
                        <input type="file" name="femalePhoto" class="form-control form-control-sm">
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="femaleInstagram" placeholder="Instagram" value="<?php echo isset($data['value']['femaleInstagram']) ? $data['value']['femaleInstagram'] : ''; ?>">
                            <label>Username Instagram (tanpa @)</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="femaleFather" placeholder="Nama Ayah" value="<?php echo isset($data['value']['femaleFather']) ? $data['value']['femaleFather'] : ''; ?>">
                            <label>Nama Ayah Wanita</label>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="femaleMother" placeholder="Nama Ibu" value="<?php echo isset($data['value']['femaleMother']) ? $data['value']['femaleMother'] : ''; ?>">
                            <label>Nama Ibu Wanita</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="marriageDate" name="marriageDate" placeholder="Tanggal Pernikahan" value="<?php echo isset($data['value']['marriageDate']) ? $data['value']['marriageDate'] : ''; ?>">
                        <label for="marriageDate">Tanggal Pernikahan</label>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" name="marriageStart" value="<?php echo isset($data['value']['marriageStart']) ? $data['value']['marriageStart'] : ''; ?>">
                                <label>Jam Mulai</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" name="marriageEnd" value="<?php echo isset($data['value']['marriageEnd']) ? $data['value']['marriageEnd'] : ''; ?>">
                                <label>Jam Selesai</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="receptionDate" name="receptionDate" placeholder="Tanggal Resepsi" value="<?php echo isset($data['value']['receptionDate']) ? $data['value']['receptionDate'] : ''; ?>">
                        <label for="receptionDate">Tanggal Resepsi</label>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" name="receptionStart" value="<?php echo isset($data['value']['receptionStart']) ? $data['value']['receptionStart'] : ''; ?>">
                                <label>Jam Mulai</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-floating mb-3">
                                <input type="time" class="form-control" name="receptionEnd" value="<?php echo isset($data['value']['receptionEnd']) ? $data['value']['receptionEnd'] : ''; ?>">
                                <label>Jam Selesai</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-floating mb-3">
                    <select class="form-select" name="timezone">
                        <option value="WIB" <?= (isset($data['value']['timezone']) && $data['value']['timezone'] == 'WIB') ? 'selected' : ''; ?>>WIB (Waktu Indonesia Barat)</option>
                        <option value="WITA" <?= (isset($data['value']['timezone']) && $data['value']['timezone'] == 'WITA') ? 'selected' : ''; ?>>WITA (Waktu Indonesia Tengah)</option>
                        <option value="WIT" <?= (isset($data['value']['timezone']) && $data['value']['timezone'] == 'WIT') ? 'selected' : ''; ?>>WIT (Waktu Indonesia Timur)</option>
                    </select>
                    <label>Zona Waktu</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="marriageLocation" name="marriageLocation" placeholder="Lokasi Pernikahan" value="<?php echo isset($data['value']['marriageLocation']) ? $data['value']['marriageLocation'] : ''; ?>">
                        <label for="marriageLocation">Lokasi Pernikahan</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="marriageGMaps" name="marriageGMaps" placeholder="Google Maps Pernikahan" value="<?php echo isset($data['value']['marriageGMaps']) ? $data['value']['marriageGMaps'] : ''; ?>">
                        <label for="marriageGMaps">Google Maps Pernikahan</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="receptionLocation" name="receptionLocation" placeholder="Lokasi Resepsi" value="<?php echo isset($data['value']['receptionLocation']) ? $data['value']['receptionLocation'] : ''; ?>">
                        <label for="receptionLocation">Lokasi Resepsi</label>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="receptionGMaps" name="receptionGMaps" placeholder="Google Maps Resepsi" value="<?php echo isset($data['value']['receptionGMaps']) ? $data['value']['receptionGMaps'] : ''; ?>">
                        <label for="receptionGMaps">Google Maps Resepsi</label>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <h4 class="mb-3">Love Story</h4>
            <div id="story-container">
                <?php 
                $stories = isset($data['value']['storyTitle']) ? $data['value']['storyTitle'] : ['']; 
                foreach($stories as $i => $val) : 
                ?>
                <div class="row story-item mb-3">
                    <div class="col-md-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" name="storyTitle[]" placeholder="Judul Cerita" value="<?= $val; ?>">
                            <label>Judul Cerita (Contoh: Pertama Bertemu)</label>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="form-floating">
                            <textarea class="form-control" name="storyDescription[]" placeholder="Deskripsi" style="height: 100px"><?= isset($data['value']['storyDescription'][$i]) ? $data['value']['storyDescription'][$i] : ''; ?></textarea>
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
                <?php 
                $envelopes = isset($data['value']['envelopeName']) ? $data['value']['envelopeName'] : ['']; 
                foreach($envelopes as $i => $val) : 
                ?>
                <div class="row envelope-item mb-3">
                    <div class="col-md-2">
                        <select class="form-select py-3" name="envelopeType[]" onchange="changeList(this)">
                            <option value="Bank" <?= (isset($data['value']['envelopeType'][$i]) && $data['value']['envelopeType'][$i] == 'Bank') ? 'selected' : ''; ?>>Bank</option>
                            <option value="E-Wallet" <?= (isset($data['value']['envelopeType'][$i]) && $data['value']['envelopeType'][$i] == 'E-Wallet') ? 'selected' : ''; ?>>E-Wallet</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="text" class="form-control py-3" name="envelopeCompany[]" list="<?= ($data['value']['envelopeType'][$i] == 'Bank') ? 'bankList' : 'ewalletList'; ?>" placeholder="Nama Bank/App" value="<?= isset($data['value']['envelopeCompany'][$i]) ? $data['value']['envelopeCompany'][$i] : ''; ?>">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control py-3" name="envelopeNumber[]" placeholder="Nomor Rekening/E-Wallet" value="<?= isset($data['value']['envelopeNumber'][$i]) ? $data['value']['envelopeNumber'][$i] : ''; ?>">
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control py-3" name="envelopeName[]" placeholder="Nama Penerima" value="<?= $val; ?>">
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
                <button type="submit" class="btn btn-primary btn-lg px-5">Simpan Seluruh Data Acara</button>
            </div>

            <script>
            document.addEventListener('click', function (e) {
                // Fungsi Hapus Baris
                if (e.target.classList.contains('remove-row')) {
                    const row = e.target.closest('.row');
                    // Sisakan minimal 1 baris
                    if (row.parentNode.querySelectorAll('.row').length > 1) {
                        row.remove();
                    } else {
                        alert('Minimal harus ada satu data!');
                    }
                }
            });

            // Tambah Story
            document.getElementById('add-story').addEventListener('click', function() {
                const container = document.getElementById('story-container');
                const newRow = `
                <div class="row story-item mb-3">
                    <div class="col-md-4"><div class="form-floating"><input type="text" class="form-control" name="storyTitle[]" placeholder="Judul"><label>Judul Cerita</label></div></div>
                    <div class="col-md-7"><div class="form-floating"><textarea class="form-control" name="storyDescription[]" placeholder="Deskripsi" style="height: 100px"></textarea><label>Deskripsi Cerita</label></div></div>
                    <div class="col-md-1 d-flex align-items-center"><button type="button" class="btn btn-danger btn-sm remove-row">X</button></div>
                </div>`;
                container.insertAdjacentHTML('beforeend', newRow);
            });

            // Tambah Envelope
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
            }
            </script>
        </div>
    </form>
  </div>