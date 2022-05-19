<?php
 
namespace Drupal\bda_hello\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
class BDAHelloTwigController extends ControllerBase {
  public function content() {
 
    return [
      '#theme' => 'bda-hello-template',
      '#test_var' => $this->t('Test Value'),
    ];
 
  }

  public function form() {
 
    return [
      '#theme' => 'bda-hello-form-template',
    ];
 
  }
}