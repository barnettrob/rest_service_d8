<?php

namespace Drupal\rest_service_d8\Configuration;

class MigrateD8ServicesConfiguration implements MigrateD8ServicesConfigurationInterface {
  /**
   *  Migrate D8 REST Credentials configuration.
   */
  public function MigrateD8ServiceCredentialsConfig() {
    return \Drupal::config('migrate_d8.rest.credentials');
  }

  /**
   * Migrate D8 Course Start and End Date configuration to use in Endpoint Url.
   */
  public function MigrateD8CourseDatesServiceConfig() {
    return \Drupal::config('migrate_d8.course.dates');
  }

  /**
   * Get Migrate D8 REST Service Courses sku Endpoint Url.
   */
  public function GetMigrateD8CoursesRestEndpointUrl() {
    return trim($this->MigrateD8ServiceCredentialsConfig()->get('rest_endpoint_url')) . '/' . $this->GetMigrateD8ServiceStartDate() . $this->GetMigrateD8ServiceEndDate();
  }

  /**
   * Get Migrate D8 REST Service Lessons Endpoint Url.
   */
  public function GetMigrateD8ServiceRestLessonsEndpointUrl() {
    return trim($this->MigrateD8ServiceCredentialsConfig()->get('rest_endpoint_lessons_url')) . '/' . $this->GetMigrateD8ServiceStartDate() . $this->GetMigrateD8ServiceEndDate();
  }

  /**
   * Get Migrate D8 Service REST Username.
   */
  public function GetMigrateD8ServiceRestUsername() {
    return $this->MigrateD8ServiceCredentialsConfig()->get('rest_username');
  }

  /**
   * Get Migrate D8 Service REST Password.
   */
  public function GetMigrateD8ServiceRestPassword() {
    return $this->MigrateD8ServiceCredentialsConfig()->get('rest_password');
  }

  /**
   * Get Migrate D8 Service REST Start Date.
   */
  public function GetMigrateD8ServiceStartDate() {
    return !empty($this->MigrateD8CourseDatesServiceConfig()->get('start_date')) ? trim($this->MigrateD8CourseDatesServiceConfig()->get('start_date')) . '/' : '';
  }

  /**
   * Get Migrate D8 Service REST End Date.
   */
  public function GetMigrateD8ServiceEndDate() {
    return !empty($this->MigrateD8CourseDatesServiceConfig()->get('end_date')) ? trim($this->MigrateD8CourseDatesServiceConfig()->get('end_date')) . '/' : '';
  }
}