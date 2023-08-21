<?php

namespace Drupal\checkbox_config\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Configure checkbox config settings for this site.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * The config factory service.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */

  protected $configFactory;

  /**
   * The entity type manager service.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * Constructs a SettingsForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $configFactory
   *   The module Handler service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The module Handler service.
   */
  public function __construct(ConfigFactoryInterface $configFactory, EntityTypeManagerInterface $entityTypeManager) {
    $this->configFactory = $configFactory;
    $this->entityTypeManager = $entityTypeManager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'checkbox_config_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['checkbox_config.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $config = $this->configFactory->get('checkbox_config.settings');
    $entity = $config->get('vocabulary');
    $entity_tag = $this->entityTypeManager->getStorage('taxonomy_term')->load($entity);
    $form['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('title'),
      '#default_value' => $config->get('title'),
    ];
    $form['checkbox'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('advanced'),
      '#default_value' => $config->get('checkbox'),
    ];
    $form['vocabulary'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('tags'),
      '#target_type' => 'taxonomy_term',
      '#selection_settings' => [
        'target_bundles' => ['vocabulary'],
      ],
      '#default_value' => $entity_tag,
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->configFactory->getEditable('checkbox_config.settings')
      ->set('title', $form_state->getValue('title'))
      ->set('checkbox', $form_state->getValue('checkbox'))
      ->set('vocabulary', $form_state->getValue('vocabulary'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
