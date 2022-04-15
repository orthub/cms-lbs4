<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../controllers/dashboard.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <div class="content">
    <div class="space-small"></div>
    <div class="text-center">
      <?php require_once __DIR__ . '/../helpers/flashMessage.php' ?>
    </div>
    <div class="space-mid"></div>
    <div class="row">
      <div class="col-6">
        <p class="text-bold">Benutzer</p>
        <p>Insgesamt: <?php echo $all_users ?></p>
        <p>Administratoren: <?php echo $admins ?></p>
        <p>Angestellte: <?php echo $employees ?></p>
        <p>Kunden: <?php echo $customers ?></p>
        <br />
        <a href="/views/user-list.php">Alle Benutzer anzeigen</a>
      </div>
      <div class="col-6">
        <p class="text-bold">Nachrichten</p>
        <p>Insgesamt: <?php echo $messages ?></p>
        <p>Neu: <?php echo $new_messages ?></p>
        <p>Gelesen: <?php echo $read_messages ?></p>
        <p>Beantwortet: <?php echo $answered_messages ?></p>
        <br />
        <a href="/views/message-list.php">Alle Nachrichten anzeigen</a>
      </div>
    </div>
    <div class="space-mid"></div>
    <div class="row">
      <div class="col-6">
        <p class="text-bold">Produkte</p>
        <p>Insgesamt: <?php echo $all_products ?></p>
        <p>Sichtbar: <?php echo $products_live ?></p>
        <p>Nicht sichtbar: <?php echo $products_draft ?></p>
        <br />
        <p>Lagerbestand weniger als 10:</p>
        <?php if (!empty($products_less_ten)) : ?>
        <?php foreach ($products_less_ten as $value) : ?>
        <br />
        <?php echo $value['title'] . ' | <b class="red">' . $value['quantity'] . '</b> Lagernd, Produkt ist ' . $value['status'] ?>
        <?php endforeach ?>
        <?php endif ?>
        <br /><br />
        <a href="/views/product-list.php">Alle Produkte anzeigen</a>
      </div>
      <div class="col-6">
        <p class="text-bold">Posts</p>
        <p>Insgesamt: <?php echo $posts ?></p>
        <p>Sichtbar: <?php echo $posts_live ?></p>
        <p>Nicht sichtbar: <?php echo $posts_draft ?></p>
        <br />
        <a href="/views/post-list.php">Alle Posts anzeigen</a>
      </div>
    </div>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>