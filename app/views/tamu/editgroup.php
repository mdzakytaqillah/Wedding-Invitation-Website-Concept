  <div class="bodyy">  
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL; ?>/console/updateGroup" method="post" enctype="multipart/form-data">
        <div class="container-fluid" style="padding-bottom: 90px;">
          <input type="hidden" name="eventID" value="<?= $data['value']['eventID']; ?>">
          <input type="hidden" name="groupID" value="<?= $data['value']['groupID']; ?>">
          <div class="form-floating mb-3">
              <input type="text" class="form-control" id="groupName" name="groupName" placeholder="Nama Grup" value="<?php echo isset($data['value']['groupName']) ? $data['value']['groupName'] : ''; ?>" required>
              <label for="groupName">Nama Grup</label>
          </div>
          <div class="mt-5 text-center">
              <button type="submit" class="btn btn-primary btn-lg px-5">Simpan Grup Tamu</button>
          </div>
        </div>
    </form>
  </div>