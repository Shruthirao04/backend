<?php

namespace Drupal\custom_general\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Undocumented class.
 */
class EntityController extends ControllerBase {

  /**
   * Function.
   */
  public function customDisplay() {
    $nid = 21;
    $node = Node::load($nid);
    if ($node && $node->getType() === 'shapesss') {
      $shape = $node->getTitle();
      $color = $node->get('field_colorssss')->entity->getName();
      $user = $node->get('field_colorssss')->entity;
      $username = $user->get('field_user_new')->entity->getDisplayName();
      $build = [
        '#markup' => " $shape $color $username",
      ];
      return $build;
    }
  }

}
