<?php

namespace Drupal\mb_register\Validator;

/**
 * Class ValidatorRequired.
 *
 * @package Drupal\mb_register\Validator
 */
class ValidatorRequired extends BaseValidator {

  /**
   * {@inheritdoc}
   */
  public function validates($value) {
    return is_array($value) ? !empty(array_filter($value)) : !empty($value);
  }

}
