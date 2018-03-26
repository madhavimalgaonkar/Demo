<?php

namespace Drupal\mb_register\Button;

/**
 * Class BaseButton.
 *
 * @package Drupal\mb_register\Button
 */
abstract class BaseButton implements ButtonInterface {

  /**
   * {@inheritdoc}
   */
  public function ajaxify() {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public function getSubmitHandler() {
    return FALSE;
  }

}
