<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/../controllers/editProduct.php';
?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <?php require_once __DIR__ . '/partials/navbar.php' ?>
  <?php require_once __DIR__ . '/partials/userbar.php' ?>

  <div class="space-small"></div>
  <div class="row">
    <div class="col-4"></div>
    <div class="col-4">
      <?php require_once __DIR__ . '/../helpers/flashMessage.php' ?>
      <div class="text-center">
        <a
          href="/controllers/productStatus.php?prodid=<?php echo $_SESSION['edit-product']['id'] . '&current=' . $_SESSION['edit-product']['status'] . '&slug=' . $_SESSION['edit-product']['slug'] ?>">
          <button
            class="<?php echo ($_SESSION['edit-product']['status'] === 'LIVE') ? 'button-live' : 'button-draft' ?>">Status:
            <?php echo $_SESSION['edit-product']['status'] ?>
          </button></a>
      </div>
      <div class="space-small"></div>
      <div class="row">
        <div class="col-6">
          <p>Produktbild hochladen:</p>
          <form action="/controllers/uploadProductImage.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="product-image"><br>
            <input class="button" type="submit" value="Hochladen">
          </form>
        </div>
        <div class="col-6">
          <p>Aktuelles Produktbild:</p>
          <img class="product-img" src="<?php echo $_SESSION['edit-product']['img_url'] ?>" />
        </div>
      </div>
      <div class="space-small"></div>
      <form action="/controllers/editProductSave.php" method="POST">
        <label for="">Titel</label>
        <input type="text" name="title" value="<?php echo $_SESSION['edit-product']['title'] ?>">
        <label for="des">Beschreibung</label>
        <textarea id="des" name="description"><?php echo $_SESSION['edit-product']['description'] ?>"</textarea>
        <label for="">Kategorie (Aktuell: <?php echo $_SESSION['edit-product']['category'] ?>)</label><br />
        <select id="category" name="category">
          <?php foreach ($categories as $category) : ?>
          <option value="<?php echo $category['category'] ?>"><?php echo $category['category'] ?>
          </option>
          <?php endforeach ?>
        </select>
        <input type="number" name="quantity" value="<?php echo $_SESSION['edit-product']['quantity'] ?>">
        <label for="">Preis</label>
        <input type="number" name="price" value="<?php echo $_SESSION['edit-product']['price'] ?>">
        <input type="hidden" name="productId" value="<?php echo $_SESSION['edit-product']['id'] ?>">
        <input type="hidden" name="productStatus" value="<?php echo $_SESSION['edit-product']['status'] ?>">
        <input class="button" type="submit" value="Speichern">
      </form>
    </div>
    <div class="col-4"></div>
  </div>
  <div class="space-big"></div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>

</html>