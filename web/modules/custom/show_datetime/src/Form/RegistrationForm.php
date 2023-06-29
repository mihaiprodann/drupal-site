<?php

/**
 * @file
 * Contains \Drupal\show_datetime\Form\RegistrationForm.
 */

namespace Drupal\show_datetime\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RegistrationForm extends FormBase {
  /**
   * {@inheritdoc}
   */

  public function getFormId() {
    return 'student_registration_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['student_name'] = [
      '#type' => 'textfield',
      '#title' => t('Enter the student\'s name'),
      '#default_value' => '',
      '#required' => TRUE
    ];
    $form['student_phone'] = array(
      '#type' => 'tel',
      '#title' => t('Enter the student\'s phone number'),
      '#required' => TRUE
    );
    $form['student_birthday'] = array(
      '#type' => 'date',
      '#title' => t('Enter the student\'s birthday (student must be 18+)'),
      '#required' => TRUE
    );

    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit the form'),
      '#button_type' => 'primary'
    );


    return $form;

  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    // check if student is underage
    $current_time = strtotime('-18 years'); // subtract 18 years from today
    $student_age = strtotime($form_state->getValue('student_birthday'));
    if ($current_time < $student_age) {
      $form_state->setErrorByName('student_birthday', $this->t('The student is not over 18 yo.'));
    }
  }


  public function submitForm(array &$form, FormStateInterface $form_state) {
    \Drupal::messenger()->addMessage($this->t('Student registered. Values: '));
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key. ': '. $value);
    }
  }

}
