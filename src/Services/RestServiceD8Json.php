<?php

namespace Drupal\rest_service_d8\Services;

use Drupal\Component\Serialization\Json;
use Drupal\rest_service_d8\Configuration\MigrateD8ServicesConfiguration;
use GuzzleHttp\Exception\RequestException;

class RestServiceD8Json {
  private $configuration;

  public function __construct(MigrateD8ServicesConfiguration $configuration) {
    $this->configuration = $configuration;
  }

  public function RestServiceD8Response($service) {
    $client = \Drupal::httpClient();

    $endpointUrl = '';

    switch ($service) {
      case 'courses':
        $endpointUrl = $this->configuration->GetMigrateD8CoursesRestEndpointUrl();
        break;
      case 'lessons':
        $endpointUrl = $this->configuration->GetMigrateD8ServiceRestLessonsEndpointUrl();
        break;
    }

    // Attempt to make a connection to get json response for the data and return as array.
    try {
      $response = $client->get($endpointUrl, [
        'auth' => [
          $this->configuration->GetMigrateD8ServiceRestUsername(),
          $this->configuration->GetMigrateD8ServiceRestPassword()
        ],
        'Accept' => 'application/json',
      ]);

      $data = $response->getBody();
      if (empty($data)) {
        return FALSE;
      }
    }
    catch (RequestException $e) {
      \Drupal::logger('rest_service_d8')->error($e);
      return FALSE;
    }

    return Json::decode($data);
  }
}