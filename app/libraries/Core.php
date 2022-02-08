<?php

/**
 * Called in require.php
 * get the url parts
 */

class Core
{
  // if no controller found, the default 'Pages' will load
  protected $currentController = 'Pages';
  // default method when Pages are called
  protected $currentMethod = 'index';
  // for the url parts
  protected $params = [];

  // print the array
  public function __construct()
  {
    // call the get_url function
    $url = $this->get_url();

    // take first part from url and search in controllers if the file exists
    if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
      // overwrite the default controller
      $this->currentController = ucwords($url[0]);
      unset($url[0]);
    }

    // load the controller
    require_once '../app/controllers/' . $this->currentController . '.php';
    // instanciate the controller
    $this->currentController = new $this->currentController;

    // check if the method exist and rewrite it
    if (isset($url[1])) {
      if (method_exists($this->currentController, $url[1])) {
        $this->currentMethod = $url[1];
        unset($url[1]);
      }
    }

    // write params in array if some exists
    $this->params = $url ? array_values($url) : [];

    // call a callback with params
    call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
  }

  public function get_url()
  {
    // remove last slash from url on GET method
    if (isset($_GET['url'])) {
      $url = rtrim($_GET['url'], '/');

      // filter variables as string or number and remove characters thats not allowed in urls
      $url = filter_var($url, FILTER_SANITIZE_URL);

      // write url parts in array
      $url = explode('/', $url);
      return $url;
    }
  }
}