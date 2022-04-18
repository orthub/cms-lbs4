<?php require_once __DIR__ . '/../helpers/session.php'; ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <div class="landing">
    <div class="landing-img"></div>
  </div>
  <div class="content">
    <div class="space-big"></div>
    <div class="row">
      <div class="col-4 text-center">
        <i class="fa-solid fa-pencil main-icons"></i>
        <p class="main-icon-text">Große Auswahl</p>
      </div>
      <div class="col-4 text-center">
        <i class="fa-solid fa-recycle main-icons"></i>
        <p class="main-icon-text">Recycelte Materialien</p>
      </div>
      <div class="col-4 text-center">
        <i class="fa-solid fa-leaf main-icons"></i>
        <p class="main-icon-text">Natürliche Materialien</p>
      </div>
    </div>
    <div class="space-big"></div>
  </div>
  <div class="row">
    <div class="spacer-main text-center">
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <br />
      <h2>Ein Büro ohne Stifte ist trotz Digitalisierung in der heutigen Zeit nicht wegzudenken.</h2>
    </div>
  </div>
  <div class="content">
    <div class="space-big"></div>
    <div class="row">
      <div class="col-3 text-center">
        <p class="text-bold">Schnell trocknend</p>
      </div>
      <div class="col-3 text-center">
        <p class="text-bold">Prächtige Farben</p>
      </div>
      <div class="col-3 text-center">
        <p class="text-bold">Ergonomisch</p>
      </div>
      <div class="col-3 text-center">
        <p class="text-bold">Dokumentenecht</p>
      </div>
    </div>
    <div class="space-big"></div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>