  <div class="bodyy">  
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/console/updateGuest" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-bottom: 90px;">
          <input type="hidden" name="eventID" value="<?= $data['value']['eventID']; ?>">
          <input type="hidden" name="guestID" value="<?= $data['value']['guestID']; ?>">
          <div class="row">
            <div class="form-floating mb-3">
              <select class="form-select" name="groupID" id="groupID" required>
                  <option value="" disabled <?= empty($data['value']['groupID']) ? 'selected' : ''?> hidden>-- Select an option --</option>
                <?php foreach($data['groupList'] as $group): ?>
                  <option value="<?= $group['groupID']; ?>" <?= (isset($data['value']['groupID']) && $data['value']['groupID'] == $group['groupID']) ? 'selected' : ''; ?>><?= $group['groupName']; ?></option>
                <?php endforeach; ?>
              </select>
              <label for="groupID">Pilih Grup Tamu</label>
            </div>
          </div>
          <div class="row">
              <div class="col-md-3">
                <input type="text" class="form-control py-3" name="prefix" placeholder="Prefix" list="prefixList" value="<?= isset($data['value']['prefix']) ? $data['value']['prefix'] : ''; ?>">
              </div>
              <div class="col-md-4">
                <input type="text" class="form-control py-3" name="guestName" placeholder="Nama Tamu" value="<?= isset($data['value']['guestName']) ? $data['value']['guestName'] : ''; ?>" required>
              </div>
              <div class="col-md-3">
                <input type="text" class="form-control py-3" name="suffix" placeholder="Suffix (S.Kom., S.Ked., M.M.)" value="<?= isset($data['value']['suffix']) ? $data['value']['suffix'] : ''; ?>">
              </div>
              <div class="col-md-2">
                <input type="text" class="form-control py-3" name="guestCode" placeholder="Kode Unik Tamu" value="<?= isset($data['value']['guestCode']) ? $data['value']['guestCode'] : ''; ?>">
              </div>
          </div>
          <datalist id="prefixList">
            <option value="Bapak">Bapak</option>
            <option value="Ibu">Ibu</option>
            <option value="Saudara">Saudara</option>
            <option value="Saudari">Saudari</option>
            <option value="Tuan">Tuan</option>
            <option value="Nyonya">Nyonya</option>
            <option value="Nona">Nona</option>
          </datalist>
          <div class="mt-5 text-center">
            <button type="submit" class="btn btn-primary btn-lg px-5">Simpan Tamu</button>
          </div>
        </div>
    </form>
  </div>