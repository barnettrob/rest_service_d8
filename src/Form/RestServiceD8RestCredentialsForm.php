<?php

namespace Drupal\rest_service_d8\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RestServiceD8RestCredentialsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'rest_service_d8_course_dates';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'rest_service_d8.rest.credentials',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('rest_service_d8.rest.credentials');

    $form['rest_endpoint_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Migrate D8 Courses Rest Endpoint Url'),
      '#default_value' => $config->get('rest_endpoint_url'),
    );

    $form['rest_endpoint_lessons_url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Migrate D8 Lessons Rest Endpoint Url'),
      '#default_value' => $config->get('rest_endpoint_lessons_url'),
    );

    $form['rest_username'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#default_value' => $config->get('rest_username'),
    );

    $form['rest_password'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Password'),
      '#default_value' => $config->get('rest_password'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config('rest_service_d8.rest.credentials')
      // Set the endpoint url configuration setting (courses).
      ->set('rest_endpoint_url', $form_state->getValue('rest_endpoint_url'))
      // Set the lessons endpoint url configuration setting.
      ->set('rest_endpoint_lessons_url', $form_state->getValue('rest_endpoint_lessons_url'))
      // Set the username configuration setting.
      ->set('rest_username', $form_state->getValue('rest_username'))
      // Set the password configuration setting.
      ->set('rest_password', $form_state->getValue('rest_password'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}