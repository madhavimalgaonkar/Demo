<?php

namespace Drupal\mb_register\Step;

use Drupal\mb_register\Button\StepTwoNextButton;
use Drupal\mb_register\Button\StepTwoPreviousButton;
use Drupal\mb_register\Validator\ValidatorRequired;

/**
 * Class StepTwo.
 *
 * @package Drupal\mb_register\Step
 */
class StepTwo extends BaseStep {

  /**
   * {@inheritdoc}
   */
  protected function setStep() {
    return StepsEnum::STEP_TWO;
  }

  /**
   * {@inheritdoc}
   */
  public function getButtons() {
    return [
      new StepTwoPreviousButton(),
      new StepTwoNextButton(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildStepFormElements() {
    $form['interests'] = [
      '#type' => 'checkboxes',
      '#title' => t('Nice to meet you! So, what are you interests?'),
      '#options' => [1 => 'interest 1', 2 => 'interest 2', 3 => 'interest 3'],
      '#default_value' => isset($form->getValue['interests']) ? $form->getValue['interests'] : [],
      '#required' => FALSE,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldNames() {
    return [
      'interests',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldsValidators() {
    return [
      'interests' => [
        new ValidatorRequired("It would be a lot easier for me if you could fill out some of your interests."),
      ],
    ];
  }

}
