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

use PDO;

/**
 * Provides access to database.
 */
class DatabaseAccessor {
  /**
   * @var PDO $pdo The PDO object for database access.
   */
  protected $pdo;

  /**
   * Constructor
   */
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
  }

  /**
   * Run the given query and return any results.
   *
   * @param string $query The query to run.
   *
   * @return array|bool Returns either an array of the results, or `false` on
   *                    error.
   */
  public function runQuery($query) {
    $pdoStatement = $this->pdo->prepare($query);
    $pdoStatement->execute([]);

    return $pdoStatement->fetchAll();
  }
}

?>
