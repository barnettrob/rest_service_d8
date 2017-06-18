<?php

namespace Drupal\rest_service_d8\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class RestServiceD8CourseDatesForm extends ConfigFormBase {
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
      'rest_service_d8.course.dates',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('rest_service_d8.course.dates');

    $form['start_date'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Courses Start Date'),
      '#description' => $this->t('Format: YYYYMMDD.  If left blank then end date becomes start date.  If end date is also blank then pull in previous date to current date.'),
      '#default_value' => $config->get('start_date'),
    );

    $form['end_date'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Courses End Date'),
      '#description' => $this->t('Format: YYYYMMDD.  If left blank, then end date is current date.  If start date is also blank then pull in previous date to current date.'),
      '#default_value' => $config->get('end_date'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration.
    $this->config('rest_service_d8.course.dates')
      // Set the start date configuration setting.
      ->set('start_date', $form_state->getValue('start_date'))
      // Set the end date configuration setting.
      ->set('end_date', $form_state->getValue('end_date'))
      ->save();

    parent::submitForm($form, $form_state);
  }
}