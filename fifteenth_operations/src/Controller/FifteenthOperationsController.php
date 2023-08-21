<?php

namespace Drupal\fifteenth_operations\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Returns responses for fifteenth operations routes.
 */
class FifteenthOperationsController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build(Node $node) {
    if (!empty($node)) {
      $title = $node->getTitle();
      return [
        '#markup' => $title,
      ];
    }
    else {
      throw new NotFoundHttpException();
    }
  }

}
