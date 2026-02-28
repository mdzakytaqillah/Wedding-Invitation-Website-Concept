<!doctype html>
<html lang="id" class="scroll-smooth">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Undangan Pernikahan - <?= $data['event']['maleName']; ?> & <?= $data['event']['femaleName']; ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Playfair+Display:wght@400;700&family=Poppins:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
      :root { --gold: #C5A059; --stone-50: #FAFAF9; --stone-600: #57534E; }
      .no-smooth {
        scroll-behavior: auto !important;
      }
      body {
        font-family: "Poppins", sans-serif;
      }
      .font-wedding {
        font-family: "Great Vibes", cursive;
      }
      .font-title {
        font-family: "Playfair Display", serif;
      }
      .bg-gold {
        background-color: #c5a059;
      }
      .text-gold {
        color: #c5a059;
      }
      .border-gold {
        border-color: #c5a059;
      }
      /* Universal Slider */
      .testimonial-container { position: relative; overflow: hidden; }
      .slider-wrapper { display: flex; transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
      .slide { min-width: 100%; display: flex; justify-content: center; padding: 0 10px; }
      /* Cards Styling */
      .testimonial-card { 
          background: white; padding: 40px; border: 1px solid rgba(197, 160, 89, 0.2); 
          text-align: center; width: 100%; max-width: 600px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);
      }
      .gallery-masonry-wrapper {
          width: 100%;
          display: block;
          text-align: center; /* Membantu elemen inline-block di dalamnya ke tengah */
      }
      .gallery-columns {
          display: inline-block; /* Agar lebar container mengikuti isi (fit-content) */
          width: fit-content;
          max-width: 100%; /* Agar tidak meluber di layar kecil */
          margin: 0 auto; /* Memastikan posisi di tengah */
          /* Pengaturan Kolom */
          column-count: 2;     /* Maksimal 2 kolom */
          column-gap: 20px;
      }
      .gallery-item {
          display: block; /* Agar setiap item jadi satu kesatuan */
          break-inside: avoid; /* Mencegah foto terpotong di antara kolom */
          width: 100%;
          max-width: 400px; /* Membatasi lebar maksimal foto untuk menjaga estetika */
          margin-bottom: 20px;
          cursor: pointer;
          transition: transform 0.3s ease;
      }
      .gallery-img-natural {
          width: 100%;
          height: auto; /* Width dikunci, Height natural (No Crop) */
          display: block;
          border-radius: 4px;
          border: 1px solid rgba(197, 160, 89, 0.2);
          box-shadow: 0 4px 15px rgba(0,0,0,0.05);
      }
      .gallery-item:hover {
          transform: scale(1.03);
      }
      /* Text Styling */
      .quote-icon { font-size: 50px; color: var(--gold); opacity: 0.5; line-height: 1; display: block; }
      .message { font-style: italic; color: var(--stone-600); margin: 20px 0; line-height: 1.8; }
      .user-name { font-weight: bold; font-size: 1.1rem; display: block; }
      .user-role { color: var(--gold); font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; }
      /* Navigation */
      .nav-btn { position: absolute; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--gold); font-size: 2rem; cursor: pointer; z-index: 50; opacity: 0.5; transition: 0.3s; }
      .nav-btn:hover { opacity: 1; scale: 1.1; }
      .prev { left: 10px; } .next { right: 10px; }
      /* Lightbox */
      #lightbox-overlay.show { display: flex; animation: fadeIn 0.3s ease; }
      @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
      /* Responsif untuk HP */
      @media (max-width: 768px) {
          .gallery-columns { column-count: 1; }
          .gallery-item { max-width: 350px; }
      }
    </style>
  </head>
  <body class="bg-stone-50 text-stone-800 overflow-x-hidden">
    <section id="splash-screen" 
            style="<?= !isset($data['guestName']) || empty($data['guestName']) ? 'display: none;' : ''; ?>" 
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-stone-50 transition-transform duration-1000 ease-in-out">
        
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/natural-paper.png')]"></div>
        
        <div class="relative text-center px-6">
            <p class="text-stone-500 tracking-[0.2em] uppercase text-sm mb-4">The Wedding of</p>
            <h1 class="font-wedding text-6xl md:text-8xl text-gold mb-8"><?= $data['event']['maleName']; ?> & <?= $data['event']['femaleName']; ?></h1>
            
            <div class="mb-10">
                <p class="text-stone-600 italic mb-2">Kepada <?= empty($data['guestPrefix']) ? 'Bapak/Ibu/Saudara/i' : $data['guestPrefix'] . ' '; ?>:</p>
                <h2 class="text-2xl md:text-3xl font-title font-bold text-stone-800">
                    <?= isset($data['guestName']) ? htmlspecialchars($data['guestName']) : ''; ?><?= !empty($data['guestSuffix']) ? ', ' . htmlspecialchars($data['guestSuffix']) : ''; ?>
                </h2>
            </div>

            <button onclick="openInvitation()" class="bg-gold hover:bg-yellow-700 text-white px-10 py-3 rounded-full font-bold shadow-lg transition-all">
                Buka Undangan
            </button>
        </div>
    </section>

    <section
      class="relative min-h-screen flex items-center justify-center text-center bg-cover bg-center px-4"
      id="top"
      style="
        background-image:
          linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
          url(<?= $data['coverpath'] ?>);
      "
    >
      <div class="text-white w-full max-w-4xl">
        <p class="text-lg tracking-widest uppercase mb-4 animate-pulse">
          The Wedding of
        </p>
        <h1 class="font-wedding text-7xl md:text-9xl mb-2"><?= $data['event']['maleName']; ?> & <?= $data['event']['femaleName']; ?></h1>
        <div style="<?= empty($data['event']['receptionDate']) ? 'display: none;' : '' ?>">
          <p class="text-xl md:text-3xl font-title italic mb-10">
            <?= $data['tanggalresepsi']; ?>
          </p>

          <div id="countdown" class="flex justify-center gap-6 md:gap-10">
            <div class="text-center">
              <span
                id="days"
                class="block text-4xl md:text-6xl font-title font-bold"
                >00</span
              >
              <span class="text-xs uppercase tracking-widest opacity-80"
                >Hari</span
              >
            </div>
            <div class="text-center">
              <span
                id="hours"
                class="block text-4xl md:text-6xl font-title font-bold"
                >00</span
              >
              <span class="text-xs uppercase tracking-widest opacity-80"
                >Jam</span
              >
            </div>
            <div class="text-center">
              <span
                id="minutes"
                class="block text-4xl md:text-6xl font-title font-bold"
                >00</span
              >
              <span class="text-xs uppercase tracking-widest opacity-80"
                >Menit</span
              >
            </div>
            <div class="text-center">
              <span
                id="seconds"
                class="block text-4xl md:text-6xl font-title font-bold w-[70px]"
                >00</span
              >
              <span class="text-xs uppercase tracking-widest opacity-80"
                >Detik</span
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="mempelai" class="py-20 bg-stone-50" style="<?= empty($data['event']['malePhoto']) || empty($data['event']['femalePhoto']) ? 'display: none;' : '' ?>">
        <div class="container mx-auto px-4 text-center">
            <h2 class="font-wedding text-5xl text-gold mb-12">Mempelai</h2>
            
            <div class="flex flex-wrap justify-center gap-12 lg:gap-24">
                <div class="w-full md:w-1/3" data-aos="fade-right">
                    <img src="<?= BASEURL ?>/img/gallery/<?= $data['event']['malePhoto']; ?>" 
                        class="w-48 h-48 mx-auto rounded-full object-cover border-4 border-gold p-1 mb-4 shadow-lg">
                    <h3 class="font-wedding text-4xl mb-2"><?= $data['event']['maleFullname']; ?></h3>
                    <p style="<?= empty($data['event']['maleFather']) && empty($data['event']['maleMother']) ? 'display: none;' : '' ?>" class="text-stone-600 mb-4">
                        Putra dari <span style="<?= empty($data['event']['maleFather']) ? 'display: none;' : '' ?>">Bapak <?= $data['event']['maleFather']; ?></span><span style="<?= empty($data['event']['maleFather']) || empty($data['event']['maleMother'])  ? 'display: none;' : '' ?>"><br> 
                        & </span><span style="<?= empty($data['event']['maleMother']) ? 'display: none;' : '' ?>">Ibu <?= $data['event']['maleMother']; ?></span>
                    </p>
                    <a style="<?= empty($data['event']['maleInstagram']) ? 'display: none;' : '' ?>" href="https://instagram.com/<?= $data['event']['maleInstagram']; ?>" target="_blank" class="text-gold text-2xl">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>

                <div class="hidden md:flex items-center text-gold font-wedding text-6xl">&</div>

                <div class="w-full md:w-1/3" data-aos="fade-left">
                    <img src="<?= BASEURL ?>/img/gallery/<?= $data['event']['femalePhoto']; ?>" 
                        class="w-48 h-48 mx-auto rounded-full object-cover border-4 border-gold p-1 mb-4 shadow-lg">
                    <h3 class="font-wedding text-4xl mb-2"><?= $data['event']['femaleFullname']; ?></h3>
                    <p style="<?= empty($data['event']['femaleFather']) && empty($data['event']['femaleMother']) ? 'display: none;' : '' ?>" class="text-stone-600 mb-4">
                        Putri dari <span style="<?= empty($data['event']['femaleFather']) ? 'display: none;' : '' ?>">Bapak <?= $data['event']['femaleFather']; ?></span><span style="<?= empty($data['event']['femaleFather']) || empty($data['event']['femaleMother'])  ? 'display: none;' : '' ?>"><br> 
                        & </span><span style="<?= empty($data['event']['femaleMother']) ? 'display: none;' : '' ?>">Ibu <?= $data['event']['femaleMother']; ?></span>
                    </p>
                    <a style="<?= empty($data['event']['femaleInstagram']) ? 'display: none;' : '' ?>" href="https://instagram.com/<?= $data['event']['femaleInstagram']; ?>" target="_blank" class="text-gold text-2xl">
                        <i class="bi bi-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="video-story" class="py-20 bg-white" style="<?= empty($data['YTvideoID']) ? 'display: none;' : '' ?>">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto shadow-2xl rounded-2xl overflow-hidden border-8 border-white">
                <div class="aspect-video">
                    <iframe width="100%" height="100%" 
                            src="https://www.youtube.com/embed/<?= $data['YTvideoID']; ?>" 
                            title="YouTube video player" frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>

    <section id="cerita" class="py-24 container mx-auto px-4" style="<?= empty($data['story'][0]['title']) ? 'display: none;' : '' ?>">
      <div class="max-w-3xl mx-auto text-center">
        <h2 class="font-wedding text-6xl text-gold mb-8">Our Love Story</h2>
        <div
          class="border-l-2 border-gold ml-4 md:ml-0 md:mx-auto space-y-10 text-left relative"
        >
          <?php foreach($data['story'] as $storyindex => $story) : ?>
          <div class="pl-8 relative" data-index="<?= $storyindex; ?>">
            <div
              class="absolute w-5 h-5 bg-gold rounded-full -left-[11px] top-1 border-4 border-white outline outline-gold"
            ></div>
            <h3 class="font-bold font-title text-2xl">
              <?= $story['title']; ?>
            </h3>
            <p class="text-stone-600 mt-2">
              <?= $story['description']; ?>
            </p>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section id="acara" class="py-24 bg-stone-100" style="<?= !empty($data['event']['marriageDate']) || !empty($data['event']['receptionDate']) || !empty($data['event']['marriageLocation']) || !empty($data['event']['receptionLocation']) ? '' : 'display: none;' ?>">
      <div class="container mx-auto px-4">
        <h2 class="font-title text-5xl text-center mb-16">Informasi Acara</h2>
        <div class="flex flex-wrap justify-center gap-8 max-w-5xl mx-auto">
          <div
            class="bg-white p-10 rounded-[2rem] shadow-xl text-center border-t-8 border-gold transform hover:-translate-y-2 transition duration-300" style="<?= !empty($data['event']['marriageDate']) || !empty($data['event']['marriageLocation']) ? '' : 'display: none;' ?>"
          >
            <h3 class="font-wedding text-5xl text-gold mb-6">Akad Nikah</h3>
            <div class="space-y-4 text-stone-600">
              <p class="text-xl font-bold text-stone-800">
                <?= $data['tanggalakad']; ?>
              </p>
              <p class="font-semibold"><?= $data['waktuakad']; ?></p>
              <p class="px-8"><?= $data['event']['marriageLocation'] ?></p>
            </div>
            <div class="mt-8" style="<?= empty($data['event']['marriageGMaps']) ? 'display: none;' : '' ?>">
              <a
                href="<?= $data['locakad'] ?>"
                target="_blank"
                class="inline-block border-2 border-gold text-gold font-bold px-6 py-2 rounded-full hover:bg-gold hover:text-white transition"
                >Buka Google Maps</a
              >
            </div>
          </div>
          <div
            class="bg-white p-10 rounded-[2rem] shadow-xl text-center border-t-8 border-gold transform hover:-translate-y-2 transition duration-300" style="<?= !empty($data['event']['receptionDate']) || !empty($data['event']['receptionLocation']) ? '' : 'display: none;' ?>"
          >
            <h3 class="font-wedding text-5xl text-gold mb-6">Resepsi</h3>
            <div class="space-y-4 text-stone-600">
              <p class="text-xl font-bold text-stone-800">
                <?= $data['tanggalresepsi']; ?>
              </p>
              <p class="font-semibold"><?= $data['wakturesepsi']; ?></p>
              <p class="px-8"><?= $data['event']['receptionLocation'] ?></p>
            </div>
            <div class="mt-8" style="<?= empty($data['event']['receptionGMaps']) ? 'display: none;' : '' ?>">
              <a
                href="<?= $data['locresepsi'] ?>"
                target="_blank"
                class="inline-block border-2 border-gold text-gold font-bold px-6 py-2 rounded-full hover:bg-gold hover:text-white transition"
                >Buka Google Maps</a
              >
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="gallery" class="py-20 bg-white" style="<?= empty($data['gallery']) ? 'display: none;' : '' ?>">
      <div class="container mx-auto px-4 max-w-5xl">
          <div class="text-center mb-10">
              <h2 class="font-wedding text-4xl text-gold mb-2">Our Moments</h2>
              <p class="text-stone-500 italic">Momen-momen indah kami</p>
          </div>
          <div class="gallery-masonry-wrapper">
            <div class="gallery-columns">
              <?php foreach ($data['gallery'] as $img): ?>
                  <div class="gallery-item" onclick="openLightbox(this)">
                    <img src="<?= BASEURL ?>/img/gallery/<?= $img['fileName']; ?>" alt="Gallery Photo" class="gallery-img-natural">
                  </div>
              <?php endforeach; ?>
            </div>
          </div>
      </div>
      <div id="lightbox-overlay" class="fixed inset-0 z-[10000] hidden bg-black/90 items-center justify-center p-4">
        <button onclick="closeLightbox()" class="absolute top-5 right-5 text-white text-4xl">&times;</button>
        <img id="lightbox-img" src="" class="max-w-full max-height-screen shadow-2xl">
      </div> 
    </section>

    <section id="media-sharing" class="py-20 bg-stone-50" style="<?= empty($data['share']) ? 'display: none;' : '' ?>">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="text-center mb-10">
                <h2 class="font-wedding text-4xl text-gold mb-2">Dokumentasi Acara</h2>
                <p class="text-stone-500 italic">Silakan akses folder di bawah ini untuk melihat atau mengunduh momen kebersamaan kita</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php foreach ($data['share'] as $share): ?>
                    <div class="bg-white p-5 rounded-2xl shadow-sm border border-stone-100 flex items-center justify-between hover:border-gold transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center text-gold text-xl group-hover:bg-gold group-hover:text-white transition-colors">
                                <i class="bi bi-folder2-open"></i>
                            </div>
                            <div>
                                <h6 class="font-bold text-stone-800 mb-0"><?= $share['fileName']; ?></h6>
                                <p class="text-[10px] uppercase tracking-widest text-stone-400">Google Drive Folder</p>
                            </div>
                        </div>
                        <a href="<?= $share['fileLink']; ?>" 
                          target="_blank" 
                          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-stone-100 text-stone-600 hover:bg-gold hover:text-white transition-all">
                            <i class="bi bi-box-arrow-up-right"></i>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="envelope" class="py-24 bg-stone-900 text-white relative overflow-hidden" style="<?= empty($data['envelope'][0]['company']) ? 'display: none;' : '' ?>">
      <div
        class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"
      ></div>
      <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="font-title text-4xl mb-8">Digital Envelope</h2>
        <p class="mb-12 opacity-80 max-w-lg mx-auto">
          Doa restu Anda adalah kado terindah bagi kami. Namun jika Anda ingin
          memberi tanda kasih, dapat melalui:
        </p>
        <div class="flex flex-col md:flex-row justify-center gap-6">
          <?php foreach($data['envelope'] as $envelopeindex => $envelope) : ?>
          <div
            class="bg-white text-stone-800 p-8 rounded-2xl w-full max-w-xs mx-auto"
          >
            <?php if($envelope['company'] == 'BCA' || $envelope['company'] == 'BNI' || $envelope['company'] == 'BRI' || $envelope['company'] == 'BSI' || $envelope['company'] == 'BTN' || $envelope['company'] == 'DBS' || $envelope['company'] == 'Jago' || $envelope['company'] == 'Mandiri' || $envelope['company'] == 'SeaBank') : ?>
            <img
              src="<?php echo BASEURL; ?>/img/bank/<?= $envelope['company']; ?>-logo.png"
              alt="<?php echo $envelope['company']; ?> Logo"
              class="h-8 mx-auto mb-4"
            />
            <?php elseif($envelope['company'] == 'GoPay' || $envelope['company'] == 'Dana' || $envelope['company'] == 'LinkAja' || $envelope['company'] == 'ShopeePay') : ?>
            <img
              src="<?php echo BASEURL; ?>/img/ewallet/<?= $envelope['company']; ?>-logo.png"
              alt="<?= $envelope['company']; ?> Logo"
              class="h-8 mx-auto mb-4"
            />
            <?php else : ?>
              <h3 class="text-2xl font-bold text-gold mb-4"><?= $envelope['company']; ?></h3>
            <?php endif; ?>
            <p
              class="text-xl font-mono font-bold my-4 select-all bg-stone-100 p-2 rounded"
            >
              <?= $envelope['number']; ?>
            </p>
            <p class="text-sm mb-6">a/n <?= $envelope['name']; ?></p>
            <button
              onclick="copyToClipboard('<?= $envelope['number']; ?>')"
              class="w-full bg-gold hover:bg-yellow-700 text-white px-4 py-3 rounded-xl text-sm uppercase font-bold transition flex items-center justify-center gap-2"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="16"
                height="16"
                fill="currentColor"
                class="bi bi-clipboard"
                viewBox="0 0 16 16"
              >
                <path
                  d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"
                />
                <path
                  d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"
                />
              </svg>
              Salin <?php if($envelope['type'] == 'Bank') { echo 'No. Rekening'; } else { echo 'No. E-Wallet'; } ?>
            </button>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="py-24 bg-stone-100" id="message-section">
      <div
        class="container mx-auto px-4 max-w-lg bg-white p-8 md:p-12 rounded-[2rem] shadow-lg"
      >
        <h2 class="font-title text-4xl text-center mb-8">
          Kirim Ucapan & Doa untuk <?= $data['event']['maleName']; ?> & <?= $data['event']['femaleName']; ?>
        </h2>
        <form id="messageForm" class="space-y-6" method="POST" action="<?= BASEURL; ?>/home/sendMessage">
          <div>
            <input type="hidden" name="guestCode" id="guestCode" value="<?= !empty($data['guestCode']) ? $data['guestCode'] : ''; ?>">
            <input type="hidden" name="guestID" id="guestID" value="<?= isset($data['guestID']) ? $data['guestID'] : ''; ?>">
          </div>
          <div>
            <label class="block text-sm font-bold mb-2 text-stone-600"
              >Nama Lengkap</label
            >
            <input
              type="text"
              placeholder="Masukkan nama Anda"
              name="guestName"
              id="guestName"
              class="w-full border-2 border-stone-200 p-4 rounded-xl focus:outline-none focus:border-gold transition"
              value="<?= !empty($data['guestName']) ? $data['guestName'] : ''; ?><?= !empty($data['guestSuffix']) ? ', ' . $data['guestSuffix'] : ''; ?>"
              <?= !empty($data['guestName']) ? 'readonly' : ''; ?>
              required
            />
          </div>
          <div>
            <label class="block text-sm font-bold mb-2 text-stone-600"
              >Ucapan & Doa</label
            >
            <textarea
              placeholder="Tuliskan ucapan selamat..."
              name="messageContent"
              id="messageContent"
              class="w-full border-2 border-stone-200 p-4 rounded-xl focus:outline-none focus:border-gold transition"
              rows="4"
              required
            ></textarea>
          </div>
          <div>
            <label class="block text-sm font-bold mb-2 text-stone-600">Publikasi</label>
            <select name="publish" id="publishSelect" class="w-full border-2 border-stone-200 p-4 rounded-xl focus:outline-none focus:border-gold transition" required>
              <option value="0">Hanya untuk pengelola</option>
              <option value="1">Publikasikan dengan nama samaran</option>
              <option value="2">Publikasikan beserta nama</option>
            </select>
          </div>
          <button
            type="submit"
            class="w-full bg-gold text-white py-4 rounded-xl font-bold text-lg hover:bg-yellow-700 transition shadow-md hover:shadow-lg transform hover:-translate-y-1"
          >
            Kirim
          </button>
        </form>
      </div>
    </section>

    <section id="section-pesan" class="py-20 bg-stone-50" style="<?= empty($data['ucapan']) ? 'display: none;' : '' ?>">
      <div class="container mx-auto px-4 max-w-4xl">
          <div class="text-center mb-10">
              <h2 class="font-wedding text-4xl text-gold mb-2">Wall of Love</h2>
              <p class="text-stone-500 italic">Doa tulus dari para tamu undangan</p>
          </div>
          <div class="testimonial-container universal-slider">
              <button class="nav-btn prev" onclick="plusSlides(-1, this)">&#10094;</button>
              <button class="nav-btn next" onclick="plusSlides(1, this)">&#10095;</button>
              <div class="slider-wrapper">
                  <?php foreach ($data['ucapan'] as $ucapan): ?>
                      <div class="slide">
                          <div class="testimonial-card">
                              <span class="quote-icon">“</span>
                              <p class="message">"<?= nl2br(htmlspecialchars($ucapan['messageContent'])); ?>"</p>
                              <div class="user-info">
                                  <span class="user-name"><?= htmlspecialchars($ucapan['guestDisplayName']); ?></span>
                                  <span style="<?= $ucapan['publish'] < 2 || empty($ucapan['groupName']) ? 'display: none;' : '' ?>" class="user-role"><?= htmlspecialchars($ucapan['groupName']); ?></span>
                              </div>
                          </div>
                      </div>
                  <?php endforeach; ?>
              </div>
          </div>
      </div>
    </section>

    <footer class="py-10 bg-stone-800 text-center text-stone-400">
      <h2 class="font-wedding text-4xl text-stone-300 mb-4"><?= $data['event']['maleName']; ?> & <?= $data['event']['femaleName']; ?></h2>
      <p class="text-sm mb-4">Terima kasih atas doa dan restu Anda.</p>
      <p class="text-xs">© 2026 Wedding Invitation. Made by Dzaky Taqillah</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <script>
      // --- 1. COUNTDOWN TIMER ---
      const targetDate = new Date("<?= $data['iso8601resepsi']; ?>").getTime();

      const updateCountdown = setInterval(() => {
        const now = new Date().getTime();
        const distance = targetDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Menambahkan angka 0 di depan jika satuan (misal: 9 jadi 09)
        document.getElementById("days").innerText =
          days < 10 ? "0" + days : days;
        document.getElementById("hours").innerText =
          hours < 10 ? "0" + hours : hours;
        document.getElementById("minutes").innerText =
          minutes < 10 ? "0" + minutes : minutes;
        document.getElementById("seconds").innerText =
          seconds < 10 ? "0" + seconds : seconds;

        if (distance < 0) {
          clearInterval(updateCountdown);
          document.getElementById("countdown").style.display = "none";
        }
      }, 1000);

      // --- 2. COPY TO CLIPBOARD FUNCTION ---
      function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(
          () => {
            alert("Nomor Rekening " + text + " berhasil disalin!");
          },
          () => {
            alert("Gagal menyalin. Silakan salin manual.");
          },
        );
      }

      // --- 3. OPEN INVITATION (OPENING OVERLAY / SPLASH SCREEN) ---
      function openInvitation() {
          const splash = document.getElementById('splash-screen');
          sessionStorage.setItem('invitation_opened', 'true');
          splash.classList.add('-translate-y-full');
          document.body.style.overflow = 'auto'; // Aktifkan scroll saat dibuka
      }

      // --- 4. SLIDER ---
      function plusSlides(dir, btn) {
        btn.closest('.universal-slider').move(dir);
      }

      // --- 5. LIGHTBOX FOR GALLERY ---
      function openLightbox(element) {
        const img = element.querySelector('img').src;
        document.getElementById('lightbox-img').src = img;
        document.getElementById('lightbox-overlay').classList.add('show');
        document.body.style.overflow = 'hidden';
      }

      function closeLightbox() {
        document.getElementById('lightbox-overlay').classList.remove('show');
        document.body.style.overflow = 'auto';
      }

      // --- 6. DOM CONTENT LOADED LOGIC ---
      document.addEventListener('DOMContentLoaded', () => {
          // --- RELOAD LOGIC ---
          // 1. Cek apakah ada anchor (#) di URL
          if (window.location.hash) {
              const html = document.documentElement;
              
              // 2. Tambahkan class untuk mematikan smooth scroll sementara
              html.classList.add('no-smooth');

              // 3. Paksa browser untuk langsung melompat ke target ID
              const target = document.querySelector(window.location.hash);
              if (target) {
                  target.scrollIntoView({ behavior: 'auto' });
              }

              // 4. Setelah melompat, aktifkan kembali smooth scroll (opsional) agar navigasi klik menu biasa tetap terasa halus
              setTimeout(() => {
                  html.classList.remove('no-smooth');
              }, 100);
          }
          
          // --- SPLASH SCREEN LOGIC ---
          const splash = document.getElementById('splash-screen');
          const isOpened = sessionStorage.getItem('invitation_opened');

          // Jika sudah pernah dibuka sebelumnya (misal setelah kirim ucapan)
          if (isOpened === 'true') {
              if (splash) {
                  splash.style.display = 'none'; // Sembunyikan permanen
              }
              document.body.style.overflow = 'auto'; // Pastikan bisa di-scroll
          } else {
            if (splash && splash.style.display !== 'none') {
                // Jika ada tamu khusus, kunci scroll body
                document.body.style.overflow = 'hidden';
            } else {
                // Jika tamu umum (display: none), pastikan scroll aktif
                document.body.style.overflow = 'auto';
            }
          }

          // --- UNIVERSAL SLIDER LOGIC ---
          document.querySelectorAll('.universal-slider').forEach(slider => {
            const wrapper = slider.querySelector('.slider-wrapper');
            const slides = slider.querySelectorAll('.slide');
            let index = 0;
            let timer;

            const update = () => wrapper.style.transform = `translateX(-${index * 100}%)`;
            
            slider.move = (dir) => {
                if (slides.length <= 1) return;
                index = (index + dir + slides.length) % slides.length;
                update();
            };

            const start = () => { if(slides.length > 1) timer = setInterval(() => slider.move(1), 5000); };
            slider.addEventListener('mouseenter', () => clearInterval(timer));
            slider.addEventListener('mouseleave', start);
            start();
          });
      });
    </script>
  </body>
</html>
