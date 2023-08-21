<?php

namespace Drupal\custom_general\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Controller for displaying custom node information.
 */
class CustomController extends ControllerBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a CustomController object.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entityTypeManager) {
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

  /**
   * Display custom node information.
   */
  public function customNodeDisplay($node_id) {

    $node = $this->entityTypeManager->getStorage('node')->load($node_id);

    $term_reference = $node->field_colorssss->referencedEntities();
    $term_name = '';
    $user_name = '';

    if (!empty($term_reference)) {
      $term = reset($term_reference);
      $term_name = $term->getName();

      $user_reference = $term->field_user_new->referencedEntities();
      if (!empty($user_reference)) {
        $user = reset($user_reference);
        $user_name = $user->getDisplayName();
      }
    }

    $node_title = $node->getTitle();

    $content = $node_title . '. ' . $term_name . '. ' . $user_name;

    return [
      '#markup' => $content,
    ];
  }

}
