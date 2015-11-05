<?php
namespace Alpha1_501st\CodeceptionDataSelector;

final class DataFactory {
  public static function make() {
    static $inst = null;

    if ($inst == null)
      $inst = new self;

    return $inst;
  }

  private function __construct() {
    // Thou shalt not construct this singleton!
  }

  private function __clone() {
    // Thou shalt not clone this singleton!
  }
}

?>
