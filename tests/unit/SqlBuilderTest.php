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

  /**
   * Test building a basic JOIN statement.
   */
  public function testJoin() {
    $tables = ['posts'=>['comments.post_id', 'posts.id']];
    $result = ' LEFT JOIN posts ON comments.post_id = posts.id';
    $this->assertEquals($result, SqlBuilder::generateJoinClause($tables));
  }

  /**
   * Test building an UPDATE statement.
   */
  public function testUpdate() {
    $sets = ['title'=>'"My Test Post"'];
    $conditions = ['user_id'=>1];
    $result = 'UPDATE posts SET title = "My Test Post" WHERE user_id = 1';
    $actual = SqlBuilder::generateUpdateStatement('posts', $sets, $conditions);
    $this->assertEquals($result, $actual);
  }
}
