<?php

namespace Drupal\custom_new\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\node\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Custom controller to render the custom form.
 */
class NewCustomController extends ControllerBase {

  /**
   * The form builder.
   *
   * @var \Drupal\Core\Form\FormBuilderInterface
   */
  protected $formBuilder;

  /**
   * CustomFormController constructor.
   */
  public function __construct(FormBuilderInterface $form_builder) {
    $this->formBuilder = $form_builder;
  }

  /**
   * Creates an instance of the controller.
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('form_builder')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build(Node $node) {
    $form = $this->formBuilder->getForm('\Drupal\custom_new\Form\CustomForm', $node);
    return $form;
  }

}
