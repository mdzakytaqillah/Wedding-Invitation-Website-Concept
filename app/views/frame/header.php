<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= BASEURL; ?>/css/style.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <title><?= $data['title']; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= BASEURL; ?>/icon/favicon.ico">
</head>
<body>
<div style="height:20px;" class="d-flex mb-4 p-1 justify-content-end">
    <div class="accbutton" style="<?= !isset($_SESSION['login']) ? 'display: none;' : '' ?>">
        <button type="button" onclick="confirm('Apakah anda yakin ingin keluar?') ? location.href='<?= BASEURL; ?>/console/logout' : '';" class="btn btn-outline-danger">Sign Out</button>
        <a class="btn btn-outline-light text-black" href="<?= BASEURL; ?>/console/signup" role="button">Daftarkan Anggota</a>
    </div>
    <div class="accbutton" style="<?= isset($_SESSION['login']) ? 'display: none;' : '' ?>">
        <a class="btn btn-primary" href="<?= BASEURL; ?>/console/login" role="button">Login</a>
    </div>
</div>