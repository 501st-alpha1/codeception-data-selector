<?php

use Alpha1_501st\CodeceptionDataSelector\SqlBuilder;

class SqlBuilderTest extends \Codeception\TestCase\Test {
  /**
   * @var \UnitTester
   */
  protected $tester;

  protected function _before() {
  }

  protected function _after() {
  }

  /**
   * Test building a basic WHERE statement.
   */
  public function testWhere() {
    $conditions = ['first_name'=>'"Test"',
                   'last_name'=>'"User"'];
    $result = 'WHERE first_name = "Test" AND last_name = "User"';
    $this->assertEquals($result, SqlBuilder::generateWhereClause($conditions));
  }

  /**
   * Test a WHERE with a custom comparison operator.
   */
  public function testWhereCustomOp() {
    $conditions = ['first_name'=>['LIKE', '"%Test%"'],
                   'last_name'=>'"User"'];
    $result = 'WHERE first_name LIKE "%Test%" AND last_name = "User"';
    $this->assertEquals($result, SqlBuilder::generateWhereClause($conditions));
  }
}
