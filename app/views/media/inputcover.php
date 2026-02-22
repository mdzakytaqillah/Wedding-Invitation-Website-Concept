<div class="bodyy">
    <div class="row">
        <div class="col-md-6">
            <?php Flasher::flash(); ?>
        </div>
    </div>
    <form action="<?= BASEURL ?>/console/updatecover" method="post">
        <input type="hidden" name="eventID" value="<?= $data['eventID']; ?>">
        <div class="row">
            <div class="col-md-12 text-center">
                <label for="imgcover">Upload Cover Page</label>
                <input type="file" name="imgcover" id="imgcover" class="form-control mb-3">
                <p>Format Gambar yang diizinkan: JPG, JPEG, PNG</p>
                <p>Ukuran Gambar maksimal: 4MB</p>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>