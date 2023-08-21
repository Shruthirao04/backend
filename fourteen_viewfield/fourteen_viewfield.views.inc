<?php

/**
 * @file
 * Provide views data for quick_node_clone.module.
 */

/**
 * Implements hook_views_data_alter().
 */
function fourteen_viewfield_views_data_alter(&$data) {
  $data['node']['node_link'] = [
    'field' => [
      'title' => t('Add node link'),
      'help' => t('Provide a clone link to the Content.'),
      'id' => 'node_clone_link',
    ],
  ];
}
