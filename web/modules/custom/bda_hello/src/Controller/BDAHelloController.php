<?php

namespace Drupal\bda_hello\Controller;

class BDAHelloController {
  public function hello() {
    //     $output = node_load_multiple();
    //     $output = node_view_multiple($output);
    //     return array(
    //         '#markup' => render($output),
    //     );
    return array(
      '#markup' => 'Welcome to our Website.'
    );
  }

  public function get_last_news() {
      $nodeStorage = \Drupal::entityTypeManager()->getStorage('node');
      $storage = \Drupal::entityTypeManager()->getStorage('node'); 

      $ids = $nodeStorage->getQuery()
      ->condition('status', 1)
      ->condition('type', 'news') // type = bundle id (machine name)
      ->sort('created', 'DESC') // sorted by time of creation
      // ->sort('nid', 'DESC')
      // ->pager(1) // limit 15 items
      ->range(0,1)
      ->execute();
      // print_r($ids);
      // $news = $nodeStorage->loadMultiple($ids);

      $entity_type = 'node';
      $view_mode = 'teaser';  
      $builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
      $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
      $node = $storage->load(reset($ids));
      $build = $builder->view($node, $view_mode);
      // $output = render($build); 
      return $build;
      // return array(
      //     '#markup' => $build
      // ); 
  }

}