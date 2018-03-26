<?php

namespace Drupal\mb_register\Button;

use Drupal\mb_register\Step\StepsEnum;

/**
 * Class StepTwoPreviousButton.
 *
 * @package Drupal\mb_register\Button
 */
class StepTwoPreviousButton extends BaseButton {

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
      '#goto_step' => StepsEnum::STEP_ONE,
      '#skip_validation' => TRUE,
    ];
  }

}
