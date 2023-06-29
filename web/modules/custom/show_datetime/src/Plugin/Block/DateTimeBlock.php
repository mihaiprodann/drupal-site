<?php

namespace Drupal\show_datetime\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'DateTime' Block.
 *
 * @Block(
 *   id = "show_datetime_block",
 *   admin_label = @Translation("DateTime block"),
 *   category = @Translation("custom"),
 * )
 */

class DateTimeBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */

  public function defaultConfiguration() {
    return [
        'datetime_format' => $this->t('')
    ];
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form['datetime_format'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Format'),
      '#description' => $this->t('Enter the datetime format, but make sure to include the hour (h): '),
      '#default_value' => $this->configuration['datetime_format']
    ];
    return $form;
  }

  public function blockValidate($form, FormStateInterface $form_state) {
    if( !str_contains($form_state->getValue('datetime_format'), 'h') ) {
      $form_state->setErrorByName('datetime_format', $this->t('Please include the hour in your format.'));
    }
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $values = $form_state->getValues();
    $this->configuration['datetime_format'] = $values['datetime_format'];
  }

  public function build(): array {
    $message = 'Current datetime: ' . date($this->configuration['datetime_format']);
    return [
      '#type' => 'markup',
      '#markup' => $message
    ];
  }



}
