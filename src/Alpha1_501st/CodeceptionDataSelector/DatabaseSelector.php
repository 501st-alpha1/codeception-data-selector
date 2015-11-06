<?php
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Lib\Driver\Db;

class DatabaseSelector extends Db {
  public function query($table, $fields, $joins, $conditions) {
    $join = $this->generateJoinClause($joins);
    $where = $this->generateWhereClause($conditions);

    if (is_array($fields))
      $fields = implode(',', $fields);

    $query = "SELECT %s FROM %s %s %s LIMIT 1";

    $query = sprintf($query, $fields, $this->getQuotedName($table), $join,
                     $where);

    $pdoStatement = $this->getDbh()->prepare($query);
    $pdoStatement->execute([]);

    $row = $pdoStatement->fetch();

    return $row;
  }

  protected function generateWhereClause(array &$criteria) {
    if (empty($criteria))
      return "";

    $where = "WHERE ";
    foreach ($criteria as $column => $value) {
      $where .= $column." = ".$value." AND ";
    }

    return substr($where, 0, -5);
  }

  protected function generateJoinClause(array &$criteria) {
    if (empty($criteria))
      return "";

    $out = "";
    foreach ($criteria as $table => $fields) {
      $out .= " LEFT JOIN ".$table." ON ".$fields[0]." = ".$fields[1];
    }

    return $out;
  }
}

?>
