<?php

namespace Drupal\mb_register\Step;

use Drupal\mb_register\Button\StepOneNextButton;
use Drupal\mb_register\Validator\ValidatorRequired;

/**
 * Class StepOne.
 *
 * @package Drupal\mb_register\Step
 */
class StepOne extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_ONE;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepOneNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t("What's your name?"),
      '#required' => FALSE,
      '#default_value' => isset($form->getValue['name']) ? $form->getValue['name'] : NULL,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'name',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'name' => [
        new ValidatorRequired("Hey stranger, please tell me your name. I would like to get to know you."),
      ],
    ];
  }

}
