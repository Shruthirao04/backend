<?php

namespace Drupal\cache_task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Cache\Cache;

/**
 * Returns responses for cache task routes.
 */
class CacheTaskController extends ControllerBase {

  /**
   * Build function.
   */
  public function build() {
    $nid = $node->id();
    $cid = 'mark:' . $nid;

    // Look for the item in cache, don't have to do work if we don't need to.
    if ($item = \Drupal::cache()->get($cid)) {
      return $item->data;
    }

    // Build up the markdown array we're going to use later.
    $node = Node::load($nid);
    $mark = [
      '#title' => $node->get('title')->value,
    ];

    // Set the cache so we don't need to do this work again until $node changes.
    \Drupal::cache()->set($cid, $mark, Cache::PERMANENT, $node->getCacheTags());

    return $mark;
  }

}
