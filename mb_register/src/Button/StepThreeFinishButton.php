<?php

namespace Drupal\mb_register\Button;

use Drupal\mb_register\Step\StepsEnum;

/**
 * Class StepThreeFinishButton.
 *
 * @package Drupal\mb_register\Button
 */
class StepThreeFinishButton extends BaseButton {

  /**
   * {@inheritdoc}
   */
  public function getKey() {
    return 'finish';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#type' => 'submit',
      '#value' => t('Finish!'),
      '#goto_step' => StepsEnum::STEP_FINALIZE,
      '#submit_handler' => 'submitValues',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getSubmitHandler() {
    return 'submitIntake';
  }

}
