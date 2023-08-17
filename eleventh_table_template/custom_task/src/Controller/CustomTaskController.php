<?php

namespace Drupal\custom_task\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Connection;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Returns responses for custom task routes.
 */
class CustomTaskController extends ControllerBase {

  /**
   * The database connection.
   *
   * @var \Drupal\Core\Database\Connection
   */
  protected $database;

  /**
   * Constructs a SettingsForm object.
   *
   * @param \Drupal\Core\Database\Connection $database
   *   The database connection.
   */
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('database')
    );
  }

  /**
   * Builds the response.
   */
  public function build() {

    $result = $this->database->select('custom_task_example', 'table')
      ->fields('table')
      ->execute();
    $rows = [];
    foreach ($result as $row) {
      $rows[] = [
        'id' => $row->id,
        'firstname' => $row->firstname,
        'lastname' => $row->lastname,
        'email' => $row->email,
        'phone' => $row->phone,
        'gender' => $row->gender,
      ];
    }
    $build = [
      '#theme' => 'task_template',
      '#rows' => $rows,
    ];

    return $build;
  }

}
