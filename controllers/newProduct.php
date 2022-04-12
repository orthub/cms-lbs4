<?php
require_once __DIR__ . '/../helpers/session.php';
require_once __DIR__ . '/userRights.php';
require_once __DIR__ . '/../models/userRights.php';


if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
  $user_role = check_user_role($userId);
  $role = $user_role['role'];

  if ($role === 'CUSTOMER') {
    header('Location: ' . '/');
    exit();
  }


  
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];
    require_once __DIR__ . '/../helpers/session.php';
    $product_title = filter_input(INPUT_POST, 'product', FILTER_SANITIZE_SPECIAL_CHARS);
    $slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_SPECIAL_CHARS);
    $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_SPECIAL_CHARS);
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT);

    if ((bool)$product_title === false) {
      $_SESSION['errors']['title'] = 'Titel darf nicht leer sein';
      $errors[] = 1;
    }
    if ((bool)$slug === false) {
      $_SESSION['errors']['slug'] = 'Slug darf nicht leer sein';
      $errors[] = 1;
    }
    if ((bool)$description === false) {
      $_SESSION['errors']['description'] = 'Bitte eine Beschreibung für das Produkt eingeben';
      $errors[] = 1;
    }
    if ((bool)$price === false) {
      $_SESSION['errors']['price'] = 'Preis darf nicht leer sein';
      $errors[] = 1;
    }
    if ((bool)$quantity === false) {
      $_SESSION['errors']['quantity'] = 'Stückzahl wird benötigt';
      $errors[] = 1;
    }
    
    if (count($errors) > 0 ) {
      header('Location: ' . '/views/newProduct.php');
    }

    if ((bool)$product_title) {
      $_SESSION['newProduct']['title'] = $product_title;
    }
    if ((bool)$slug) {
      $_SESSION['newProduct']['slug'] = $slug;
    }
    if ((bool)$description) {
      $_SESSION['newProduct']['description'] = $description;
    }
    if ((bool)$price) {
      $_SESSION['newProduct']['price'] = $price;
    }
    if ((bool)$category) {
      $_SESSION['newProduct']['category'] = $category;
    }
    if ((bool)$quantity) {
      $_SESSION['newProduct']['quantity'] = $quantity;
    }

    if (count($errors) === 0) {
      require_once __DIR__ . '/../models/products.php';
      $categories = get_categories();

      $slugExists = check_slugs($slug);
    
      if ($slugExists === $slug){
        $_SESSION['errors']['slug-exists'] = 'Slug wird schon verwendet, bitte einen neuen wählen';
        header('Location: ' . '/views/newProduct.php');
        exit();
      }
    }

    $create_new_product = new_product($product_title, $slug, $description, $price, $category, $quantity);

    if ($create_new_product){
      $_SESSION['new-product'] = 'Neues Produkt erfolgreich angelegt';
      unset($_SESSION['newProduct']);
      unset($_SESSION['errors']);
      header('Location: ' . '/views/products.php');
    }
    
  }
  
  

}