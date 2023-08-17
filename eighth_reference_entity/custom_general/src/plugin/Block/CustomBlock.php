<?php

namespace Drupal\custom_general\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "module_custom_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("module_custom")
 * )
 */
class CustomBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
      'node_id' => "",
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    // print_r($this->configuration['node_id']);exit;.
    $form['node_id'] = [
      '#type' => 'entity_autocomplete',
      '#title' => 'Select Node',
      '#default_value' => Node::load($this->configuration['node_id']),
      '#target_type' => 'node',
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['node_id'] = $form_state->getValue('node_id');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node_id = $this->configuration['node_id'];
    $node = Node::load($node_id);
    $title = [
      '#markup' => $node->getTitle(),
    ];
    return $title;
  }

}
