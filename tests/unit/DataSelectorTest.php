<?php

use Alpha1_501st\CodeceptionDataSelector\DataSelector;
use AspectMock\Test as test;

class DataSelectorTest extends \Codeception\TestCase\Test {
  /**
   * @var \UnitTester
   */
  protected $tester;

  protected function _before() {
  }

  protected function _after() {
    test::clean();
  }

  public function testBeforeSuite() {
    $eventMock = test::double("Codeception\Event\SuiteEvent");
    $suiteMock = test::double("PHPUnit_Framework_TestSuite");
    $selectorClass = "Alpha1_501st\CodeceptionDataSelector\DatabaseSelector";
    $selectorMock = test::double($selectorClass, ['query'=>[]]);

    $selector = new DataSelector(new PHPUnit_Framework_TestSuite);
    $selector->beforeSuite(new Codeception\Event\SuiteEvent);
  }
}
