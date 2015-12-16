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
    $pdoStatementMock = test::double('PDOStatement',
                                     ['execute'=>null, 'fetch'=>null]);
    $pdoMock = test::spec('MyPDO', ['prepare'=>$pdoStatementMock]);
    $query = "SELECT * FROM users";

    $pdo = $pdoMock->construct();

    $db = new DatabaseAccessor($pdo);
    $db->runQuery($query);

    $pdoMock->verifyInvoked('prepare', [$query]);
    $pdoStatementMock->verifyInvoked('execute');
    $pdoStatementMock->verifyInvoked('fetchAll');
  }
}
