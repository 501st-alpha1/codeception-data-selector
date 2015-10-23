<?php

use \Codeception\Event\TestEvent;
use \Codeception\Extension;

class DataSelector extends Extension {
  public static $events = [
    'suite.before'=>'beforeSuite',
  ];

  public function beforeSuite(TestEvent $e) {
  }
}

?>
