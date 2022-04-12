<?php require_once __DIR__ . '/../lib/sessionHelper.php'; ?>
<!DOCTYPE html>
<html>
<?php require_once __DIR__ . '/partials/head.php' ?>

<body>
  <div class="container">
    <?php require_once __DIR__ . '/partials/navbar.php' ?>
    <?php require_once __DIR__ . '/partials/userbar.php' ?>
    <?php require_once __DIR__ . '/../controllers/newProduct.php' ?>
    <div class="row">
      <div class="col-4"></div>
      <div class="col-4">
        <?php require_once __DIR__ . '/../lib/error_messages.php' ?>

        <form action="/controllers/newProduct.php" method="POST">
          <label for="product">Produktname</label><br />
          <input onkeyup="slug_generator()" type="text" name="product" id="product"
            value="<?php echo (isset($_SESSION['newProduct']['title'])) ? $_SESSION['newProduct']['title'] : '' ?>" /><br />
          <label for="slug">Slug</label><br />
          <input type="text" id="slug" name="slug"
            value="<?php echo (isset($_SESSION['newProduct']['slug'])) ? $_SESSION['newProduct']['slug'] : '' ?>"></input><br />
          <label for="description">Beschreibung</label><br />
          <textarea id="description"
            name="description"><?php echo (isset($_SESSION['newProduct']['description'])) ? $_SESSION['newProduct']['description'] : '' ?></textarea><br />
          <label for="price">Preis (in cent)</label><br />
          <input type="number" id="price" name="price"
            value="<?php echo (isset($_SESSION['newProduct']['price'])) ? $_SESSION['newProduct']['price'] : '' ?>"></input><br />
          <label for="category">Kategorie</label><br />
          <select id="category" name="category">
            <?php foreach ($categories as $category) : ?>
            <option value="<?php echo $category['category'] ?>"><?php echo $category['category'] ?></option>
            <?php endforeach ?>
          </select>
          <br />
          <label for="quantity">Stückzahl</label><br />
          <input type="number" id="quantity" name="quantity"
            value="<?php echo (isset($_SESSION['newProduct']['quantity'])) ? $_SESSION['newProduct']['quantity'] : '' ?>"></input><br />
          <input class="button" type="submit" value="Speichern"></input>
          <button class="button-cancel pos-right"><a href="/views/products.php">Abbrechen</a></button>
        </form>

      </div>
      <div class="col-4"></div>
    </div>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php' ?>
</body>
<script src="/js/slug-generator.js"></script>

</html>