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
    $builderMock->verifyInvoked('generateWhereClause');
  }

  public function testDelete() {
    $builderMock = test::double('Alpha1_501st\CodeceptionDataSelector\SqlBuilder',
                                ['generateWhereClause'=>""]);

    $db = new DatabaseSelector("mysql:host=localhost;dbname=testdb", "root", "");
    $ret = $db->delete('comments', ['content'=>"bad comment"]);

    $builderMock->verifyInvoked('generateWhereClause');
  }

  public function testUpdate() {
    $update = "UPDATE comments SET content = 'I was modified!'";
    $builderMock = test::double('Alpha1_501st\CodeceptionDataSelector\SqlBuilder',
                                ['generateUpdateStatement'=>$update]);

    $db = new DatabaseSelector("mysql:host=localhost;dbname=testdb", "root", "");
    $ret = $db->update('comments', ['content'=>"I was modified!"],
                       ['content'=>"Modify me!"]);

    $builderMock->verifyInvoked('generateUpdateStatement');
  }
}

?>
