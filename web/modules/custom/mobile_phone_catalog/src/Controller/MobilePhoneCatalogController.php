<?php

namespace Drupal\mobile_phone_catalog\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Entity\EntityType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for mobile_phone_catalog.
 *
 * @ingroup mobile_phone_catalog
 */
class MobilePhoneCatalogController extends ControllerBase {

  public function list() {
    $entities = $this->getMobilePhoneEntitiesFromDB();

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

  public function json() {
    $entities = $this->getMobilePhoneEntitiesFromDB();

    $arr = [];

    /** @var \Drupal\Core\Entity\EntityType $entity */
    foreach ($entities as $entity) {
      $arr[] = $entity->toArray();
    }

    return new JsonResponse($arr);
  }

  private function getMobilePhoneEntitiesFromDB() {
    return (\Drupal::entityTypeManager())
      ->getStorage('node')
      ->loadByProperties(['type' => 'mobile_phone']);
  }
}
