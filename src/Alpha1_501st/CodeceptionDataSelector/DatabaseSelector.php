<?php
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Lib\Driver\Db;

class DatabaseSelector extends Db {
  public function query($table, $fields, $joins, $conditions) {
    $join = $this->generateJoinClause($joins);
    $where = $this->generateWhereClause($conditions);

    if (is_array($fields))
      $fields = implode(',', $fields);

    $query = "SELECT %s FROM %s %s %s";

    return sprintf($query, $fields, $this->getQuotedName($table), $joins,
                   $where);
  }

  protected function generateJoinClause(array &$criteria) {
    if (empty($criteria))
      return "";

    $out = "";
    foreach ($criteria as $table => $fields) {
      $out .= "LEFT JOIN ".$table." ON ".$fields[0]." = ".$fields[1];
    }

    return $out;
  }
}

?>
