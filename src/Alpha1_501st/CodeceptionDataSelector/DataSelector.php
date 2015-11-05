<?php
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Event\TestEvent;
use \Codeception\Extension;

class DataSelector extends Extension {
  public static $events = [
    'suite.before'=>'beforeSuite',
  ];

  public function beforeSuite(TestEvent $e) {
    $db = new DatabaseSelector;

    foreach ($this->config as $group => $value) {
      $data = DataFactory::make();
      $data->$group = new stdClass;

      $result = $db->query($value['table'], $value['fields'], $value['joins'],
                           $value['conditions']);
      foreach ($result as $field => $value) {
        $data->$group->$field = $value;
      }
    }
  }
}

?>
