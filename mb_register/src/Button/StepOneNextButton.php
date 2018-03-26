<?php

namespace Drupal\mb_register\Button;

use Drupal\mb_register\Step\StepsEnum;

/**
 * Class StepOneNextButton.
 *
 * @package Drupal\mb_register\Button
 */
class StepOneNextButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'next';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Next'),
      '#goto_step' => StepsEnum::STEP_TWO,
    ];
  }

}
