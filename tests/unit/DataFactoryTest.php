<?php

use Alpha1_501st\CodeceptionDataSelector\DataFactory;
use AspectMock\Test as test;

class DataFactoryTest extends \Codeception\TestCase\Test {
  /**
   * @var \UnitTester
   */
  protected $tester;

  protected function _before() {
  }

  protected function _after() {
    test::clean();
  }

  public function testQuery() {
    $data = DataFactory::make();
    $data->one = "hi";
    $data2 = DataFactory::make();

    $this->assertEquals($data2->one, "hi");
  }
}
