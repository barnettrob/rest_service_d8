<?php

namespace Drupal\rest_service_d8\Controller;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Controller\ControllerBase;
use Drupal\rest_service_d8\Services\RestServiceD8Json;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;

class RestServiceD8Display extends ControllerBase {
  private $restData;

  public function __construct(RestServiceD8Json $restData) {
    $this->restData = $restData;
  }

  /**
   * @return array
   * Returns Rest Service D8 exception data from REST api.
   */
  public function displayRestData($service) {
    $restJsonArray = $this->restData->RestServiceD8Response($service);

    return new Response('<pre>' . print_r($restJsonArray, TRUE) . '</pre>');
  }

  /**
   * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
   * @return static
   * Drupal's dependency injection to inject custom service pulling Rest Service D8 service data.
   */
  public static function create(ContainerInterface $container) {
    $orgsData = $container->get('rest_service_d8.rest.endpoint.call');

    return new static($orgsData);
  }

  /**
   * Checks access for this controller.
   */
  public function access() {
    $currentUser = \Drupal::currentUser();

    if ($currentUser->id() == 1) {
      return AccessResult::allowed();
    }

    $currentUserRoles = $currentUser->getRoles();

    if (array_intersect($currentUserRoles, ['administrator', 'site_admin', 'content_manager'])) {
      return AccessResult::allowed();
    }
    else {
      return AccessResult::forbidden();
    }
  }
}