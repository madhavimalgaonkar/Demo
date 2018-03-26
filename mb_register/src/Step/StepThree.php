<?php

namespace Drupal\mb_register\Step;

use Drupal\mb_register\Button\StepThreeFinishButton;
use Drupal\mb_register\Button\StepThreePreviousButton;
use Drupal\mb_register\Validator\ValidatorRegex;
use Drupal\mb_register\Validator\ValidatorRequired;

/**
 * Class StepThree.
 *
 * @package Drupal\mb_register\Step
 */
class StepThree extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_THREE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepThreePreviousButton(),
      new StepThreeFinishButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {

    $form['linkedin'] = [
      '#type' => 'textfield',
      '#title' => t('What is your LinkedIn URL?'),
      '#default_value' => isset($this->getValues()['linkedin']) ? $this->getValues()['linkedin'] : NULL,
      '#required' => FALSE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'linkedin',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'linkedin' => [
        new ValidatorRequired("Tell me where I can find your LinkedIn please."),
        new ValidatorRegex(t("I don't think this is a valid LinkedIn URL..."), '/(ftp|http|https):\/\/(.*)linkedin(.*)/'),
      ],
    ];
  }

}
