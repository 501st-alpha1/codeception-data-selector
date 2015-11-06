<?php
/**
 * Database access.
 *
 * This file is part of CodeceptionDataSelector.
 *
 * CodeceptionDataSelector is free software: you can redistribute it and/or
 * modify it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * CodeceptionDataSelector is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with CodeceptionDataSelector.  If not, see
 * <http://www.gnu.org/licenses/>.
 *
 * @package   CodeceptionDataSelector
 * @author    Scott Weldon <open-source@scott-weldon.com>
 * @copyright 2015 Scott Weldon
 */
namespace Alpha1_501st\CodeceptionDataSelector;

use \Codeception\Lib\Driver\Db;

class DatabaseSelector extends Db {
  public function query($table, $fields, $conditions, $joins) {
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
