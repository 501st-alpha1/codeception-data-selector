<?php

use \Codeception\Lib\Driver\Db;

class DatabaseSelector extends Db {
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
