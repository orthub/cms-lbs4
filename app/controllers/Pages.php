<?php

class Pages extends Controller
{
  public function __construct()
  {
    #
  }

  public function index()
  {
    $this->view('pages/index');
  }

  public function news()
  {
    $this->view('pages/news');
  }

  public function shop()
  {
    $this->view('pages/shop');
  }

  public function about()
  {
    $this->view('pages/about');
  }
}