</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<nav class="navbar fixed-bottom">
  <div class="container-fluid">
      <a class="nav-link<?= $data['title'] == 'Console' ? '-active' : '' ?>" href="<?= BASEURL; ?>/console"><span class="material-symbols-rounded" style="font-size: 32px; font-variation-settings: 'FILL' <?= $data['title'] == 'Console' ? '1' : '0' ?>, 'wght' 500, 'GRAD' 0, 'opsz' 40;">home</span></a>
      <a class="nav-link<?= $data['title'] == 'Media' ? '-active' : '' ?>" href="<?= BASEURL; ?>/console/media"><span class="material-symbols-rounded" style="font-size: 32px; font-variation-settings: 'FILL' <?= $data['title'] == 'Media' ? '1' : '0' ?>, 'wght' 500, 'GRAD' 0, 'opsz' 40;">perm_media</span></a>
      <a class="nav-link<?= $data['title'] == 'Tamu' ? '-active' : '' ?>" href="<?= BASEURL; ?>/console/tamu"><span class="material-symbols-rounded" style="font-size: 32px; font-variation-settings: 'FILL' <?= $data['title'] == 'Tamu' ? '1' : '0' ?>, 'wght' 500, 'GRAD' 0, 'opsz' 40;">groups</span></a>
  </div>
</nav>
</html>