<?php

namespace Drupal\mb_register\Validator;

/**
 * Interface ValidatorInterface.
 *
 * @package Drupal\mb_register\Validator
 */
interface ValidatorInterface {

  /**
   * Returns bool indicating if validation is ok.
   */
  public function validates($value);

  /**
   * Returns error message.
   */
  public function getErrorMessage();

}
