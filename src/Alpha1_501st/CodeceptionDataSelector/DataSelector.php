<?php
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Event\SuiteEvent;
use \Codeception\Platform\Extension;

class DataSelector extends Extension {
  public static $events = [
    'suite.before'=>'beforeSuite',
  ];

  public function beforeSuite(SuiteEvent $e) {
    $dsn = $this->config['dsn'];
    $user = $this->config['user'];
    $password = $this->config['password'];
    $db = new DatabaseSelector($dsn, $user, $password);

    foreach ($this->config['data'] as $group => $value) {
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
