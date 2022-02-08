<?php

/**
 * load model and view
 */

class Controller
{
  // loads the given model
  public function model($model)
  {
    require_once '../app/models/' . $model . '.php';

    // instanciate model
    return new $model();
  }

  // load the given view and data
  public function view($view, $data = [])
  {
    if (file_exists('../app/views/' . $view . '.php')) {
      require_once '../app/views/' . $view . '.php';
    } else {
      die('View dont exist');
    }
  }
}