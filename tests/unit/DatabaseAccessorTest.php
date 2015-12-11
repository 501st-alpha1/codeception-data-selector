<?php

use Alpha1_501st\CodeceptionDataSelector\DatabaseAccessor;
use AspectMock\Test as test;

class DatabaseAccessorTest extends \Codeception\TestCase\Test {
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
    $pdoStatementMock = test::double('PDOStatement', ['execute'=>null, 'fetch'=>null]);
    $pdoMock = test::double('PDO', ['__construct'=>null, 'prepare'=>$pdoStatementMock]);

    $pdo = new PDO("");

    $db = new DatabaseAccessor();
  }
}
