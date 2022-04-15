<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../controllers/products.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>
  <div class="content">
    <div class="space-mid"></div>
    <div class="text-center">
      <?php require_once __DIR__ . '/../helpers/flashMessage.php' ?>
    </div>
    <div class="space-small"></div>
    <h2 class="text-center" class="category"><?php echo $get_category ?></h2>
    <?php if(!$category_available) : ?>
    <p>Kategorie nicht gefunden.</p>
    <?php endif ?>
    <div class="space-small"></div>
    <div class="row">
      <?php if($category_available) : ?>
      <?php foreach ($category_products as $product) : ?>
      <div class="col-3">
        <p class="text-bold"><?php echo $product['title'] ?></p>
        <img class="product-img" src="<?php echo $product['img_url'] ?>" alt="<?php echo $product['slug']?>">
        <p><?php echo $product['price'] / 100 . '€' ?></p>
        <p>Lagernd: <?php echo $product['quantity'] ?></p>
        <?php if ($product['quantity'] >= 1) : ?>
        <form action="/../controllers/addToCart.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $product['id'] ?>" />
          <input class="button" type="submit" value="In den Warenkorb" />
        </form>
        <?php endif ?>
        <?php if ($product['quantity'] === 0) : ?>
        <p class="text-danger">Ausverkauft</p>
        <?php endif ?>
      </div>
      <?php endforeach ?>
    </div>
    <?php endif ?>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>