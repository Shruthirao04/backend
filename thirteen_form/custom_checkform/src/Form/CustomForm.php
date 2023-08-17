<?php

namespace Drupal\custom_checkform\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides the form for adding names.
 */
class CustomForm extends FormBase {

  /**
   * Logger Factory.
   *
   * @var \Drupal\Core\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Constructor.
   */
  public function __construct(LoggerInterface $logger) {
    $this->logger = $logger;
  }

  /**
   * Create function.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('logger.factory')->get('custom_form')
    );
  }

  /**
   * {@inheritDoc}
   */
  public function getFormId() {
    return 'custom_form';
  }

  /**
   * Buildform.
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['#attached']['library'][] = 'custom_checkform/js_lib';
    $form['first_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First name'),
      '#required' => TRUE,
    ];

    $form['has_last_name'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('last name'),
      '#attributes' => ['id' => 'same-lastname'],
    ];

    $form['last_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last name'),
      // '#states' => [
      //   'visible' => [
      //     ':input[name="has_last_name"]' => ['checked' => FALSE],
      //   ],
      // ]
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submitted'),
    ];

    return $form;

  }

  /**
   * Submit function.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $this->logger->error($this->t('sent message'));
    $this->logger->notice($this->t('message sent'));
    $this->logger->warning($this->t('message sent successfully'));
    $this->messenger()->addStatus($this->t('submitted'));
  }

}
