<?php
/**
 * Main Codeception extension file.
 *
 * This file is part of CodeceptionDataSelector.
 *
 * CodeceptionDataSelector is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * CodeceptionDataSelector is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CodeceptionDataSelector.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @package   CodeceptionDataSelector
 * @author    Scott Weldon <open-source@scott-weldon.com>
 * @copyright 2015 Scott Weldon
 */
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Event\SuiteEvent;
use \Codeception\Event\TestEvent;
use \Codeception\Platform\Extension;
use stdClass;

/**
 * DataSelector main plugin.
 */
class DataSelector extends Extension {
  /**
   * @var array The Codeception events to listen to.
   */
  public static $events = [
    'suite.before'=>'beforeSuite',
    'test.before'=>'beforeTest',
  ];

  /**
   * Load test data before suite is run.
   *
   * @param SuiteEvent $e The before-suite event.
   */
  public function beforeSuite(SuiteEvent $e) {
    $dsn = $this->config['dsn'];
    $user = $this->config['user'];
    $password = $this->config['password'];
    $db = new DatabaseSelector($dsn, $user, $password);

    foreach ($this->config['data'] as $group => $value) {
      $data = DataFactory::make();
      $data->$group = new stdClass;

      if (isset($value['joins']))
        $joins = $value['joins'];
      else
        $joins = [];

      $result = $db->query($value['table'], $value['fields'],
                           $value['conditions'], $joins);
      foreach ($result as $field => $value) {
        $data->$group->$field = $value;
      }
    }
  }

  /**
   * Wipe/cleanup old data that may have changed during tests.
   *
   * @param TestEvent $e The before-test event.
   */
  public function beforeTest(TestEvent $e) {
  }
}

?>
