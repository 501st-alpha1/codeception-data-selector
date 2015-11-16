<?php

use Mockery as m;
use \Alpha1_501st\CodeceptionDataSelector\DatabaseSelector;

/**
 * @runTestsInSeparateProcesses
 * @preserveGlobalState disabled
 */
class DatabaseSelectorTest extends \Codeception\TestCase\Test {
  /**
   * @var \UnitTester
   */
  protected $tester;

  protected function _before() {
  }

  protected function _after() {
  }

  // tests
  public function testSelect() {
    $dsn = 'mysql:host=localhost;dbname=testdb';
    $joins = ['users'=>['comments.user_id', 'users.id']];
    $wheres = ['users.activated'=>1];
    $comment = "This is a test comment.";
    $join = " LEFT JOIN users ON comments.user_id = users.id";
    $where = "WHERE users.activated = 1";
    $query = "SELECT content FROM comments".$join." ".$where;

    $builder = 'overload:Alpha1_501st\CodeceptionDataSelector\SqlBuilder';
    $builderMock = m::mock($builder);
    $builderMock->shouldReceive('generateJoinClause')
                ->once()
                ->with($joins)
                ->andReturn($join);
    $builderMock->shouldReceive('generateWhereClause')
                ->once()
                ->with($wheres)
                ->andReturn($where);

    $dbMock = m::mock('overload:PDO');
    $dbMock->shouldReceive('prepare')
           ->once()
           ->with($query);
    $dbMock->shouldReceive('execute')
           ->once()
           ->with([]);
    $dbMock->shouldReceive('fetch')
           ->once()
           ->andReturn(['content'=>$comment]);

    $db = new DatabaseSelector($dsn, "root", "");
    $db->query("comments", "content", $wheres, $joins);
  }
}
