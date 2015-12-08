<?php

use Alpha1_501st\CodeceptionDataSelector\DatabaseSelector;
use AspectMock\Test as test;

class DatabaseSelectorTest extends \Codeception\TestCase\Test {
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
    $builderMock = test::double('Alpha1_501st\CodeceptionDataSelector\SqlBuilder',
                                ['generateJoinClause'=>"",
                                 'generateWhereClause'=>""]);
    //$pdoMock = test::double('PDO', ['prepare'=>null]);
    //$pdoStatementMock = test::double('PDOStatement', ['execute'=>null, 'fetch'=>null]);

    // FIXME mock PDO, etc so that MySQL doesn't need to be installed.
    $db = new DatabaseSelector("mysql:host=localhost;dbname=testdb", "root", "");
    $ret = $db->query('comments', 'content', [], []);

    $builderMock->verifyInvoked('generateJoinClause');
  }
}

?>
