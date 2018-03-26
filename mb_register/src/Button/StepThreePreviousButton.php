<?php

namespace Drupal\mb_register\Button;

use Drupal\mb_register\Step\StepsEnum;

/**
 * Class StepThreePreviousButton.
 *
 * @package Drupal\mb_register\Button
 */
class StepThreePreviousButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'previous';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Previous'),
      '#goto_step' => StepsEnum::STEP_TWO,
      '#skip_validation' => TRUE,
    ];
  }

}
