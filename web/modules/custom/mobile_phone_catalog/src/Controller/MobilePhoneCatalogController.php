<?php

namespace Drupal\mobile_phone_catalog\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Controller routines for mobile_phone_catalog.
 *
 * @ingroup mobile_phone_catalog
 */
class MobilePhoneCatalogController extends ControllerBase {

  public function list() {
    $entityTypeManager = \Drupal::entityTypeManager();

    $entities = $entityTypeManager
      ->getStorage('node')
      ->loadByProperties(['type' => 'mobile_phone']);

    $template = file_get_contents('modules/custom/mobile_phone_catalog/templates/list.html.twig');

    $build = [
      'list' => [
        '#type' => 'inline_template',
        '#template' => $template,
        '#context' => [
          'title' => 'Mobile Phone Catalog',
          'catalog' => $entities,
        ],
      ],
    ];

    return $build;
  }
}
