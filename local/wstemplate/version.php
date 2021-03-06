<?php
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This plugin returns three sets of data:
 * a list of users, a list of courses
 * and a list of enrolled users for a course and their grades
 *
 * @package    local_wstemplate
 * @copyright  2021 Vlad Antoniukov, antonykov.v@gmail.com
 * @license
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version  = 2021090900;
$plugin->requires = 2013051400;
$plugin->release = '2';
$plugin->maturity = MATURITY_STABLE;
$plugin->component = 'local_wstemplate';