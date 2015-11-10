<?php
/**
 * Data singleton to store and access selected data.
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

/**
 * Data singleton.
 */
final class DataFactory {
  public static function make() {
    static $inst = null;

    if ($inst == null)
      $inst = new self;

    return $inst;
  }

  private function __construct() {
    // Thou shalt not construct this singleton!
  }

  private function __clone() {
    // Thou shalt not clone this singleton!
  }
}

?>
