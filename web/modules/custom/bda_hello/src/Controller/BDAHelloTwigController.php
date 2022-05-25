<?php
 
namespace Drupal\bda_hello\Controller;
 
use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
 
class BDAHelloTwigController extends ControllerBase {
  // public function content() {
 
  //   return [
  //     '#theme' => 'bda-hello-template',
  //     '#test_var' => $this->t('Test Value'),
  //   ];
 
  // }

  public function content() {
    $nodes = Node::loadMultiple();
    $i = 0;
    foreach ($nodes as $node) {
      $i++;
      if ($node == 'news') {
        if ($node->hasField('field_category_choice')) {
          $theme = 'bda-hello-template-bookmark-true';
        }
      }
    }
    return $theme;
  }

}
