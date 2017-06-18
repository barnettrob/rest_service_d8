<?php

namespace Drupal\rest_service_d8\Configuration;

interface MigrateD8ServicesConfigurationInterface {
  /**
   *  Migrate D8 REST Credentials configuration.
   *
   * @return \Drupal::config('migrate_d8.rest.credentials')
   */
  public function MigrateD8ServiceCredentialsConfig();

  /**
   * Migrate D8 Course Start and End Date configuration to use in Endpoint Url.
   *
   * @return \Drupal::config('migrate_d8.course.dates')
   */
  public function MigrateD8CourseDatesServiceConfig();

  /**
   * Get Migrate D8 REST Service Courses sku Endpoint Url.
   *
   * @return $this->MigrateD8ServiceCredentialsConfig()->get('rest_endpoint_url')
   * with concatenation of $this->GetMigrateD8ServiceStartDate()
   * and concatenation of $this->GetMigrateD8ServiceEndDate()
   */
  public function GetMigrateD8ServiceCoursesRestEndpointUrl();

  /**
   * Get Migrate D8 REST Service Lessons Endpoint Url.
   *
   * @return $this->MigrateD8ServiceCredentialsConfig()->get('rest_endpoint_lessons_url')
   * with concatenation of $this->GetMigrateD8ServiceStartDate()
   * and concatenation of $this->GetMigrateD8ServiceEndDate()
   */
  public function GetMigrateD8ServiceRestLessonsEndpointUrl();

  /**
   * Get Migrate D8 Service REST Username.
   *
   * @return $this->MigrateD8ServiceCredentialsConfig()->get('rest_username')
   */
  public function GetMigrateD8ServiceRestUsername();

  /**
   * Get Migrate D8 Service REST Password.
   *
   * @return $this->MigrateD8ServiceCredentialsConfig()->get('rest_password')
   */
  public function GetMigrateD8ServiceRestPassword();

  /**
   * Get Migrate D8 Service REST Start Date.
   *
   * @return $this->MigrateD8CourseDatesServiceConfig()->get('start_date')
   */
  public function GetMigrateD8ServiceStartDate();

  /**
   * Get Migrate D8 Service REST End Date.
   *
   * @return $this->MigrateD8CourseDatesServiceConfig()->get('end_date')
   */
  public function GetMigrateD8ServiceEndDate();
}