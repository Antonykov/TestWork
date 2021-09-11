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
 * Web service local plugin template external functions and service definitions.
 *
 * @package    local_wstemplate
 * @copyright  2021 Vlad Antoniukov, antonykov.v@gmail.com
 * @license
 */

$functions = array(
        'local_wstemplate_get_users' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'get_users',
                'classpath'   => 'local/wstemplate/externallib.php',
                'description' => 'Return users list',
                'type'        => 'read',
        ),
        'local_wstemplate_get_courses' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'get_courses',
                'classpath'   => 'local/wstemplate/externallib.php',
                'description' => 'Return courses list',
                'type'        => 'read',
            ),
        'local_wstemplate_get_enrol_users_and_grade' => array(
                'classname'   => 'local_wstemplate_external',
                'methodname'  => 'get_enrol_users_and_grade',
                'classpath'   => 'local/wstemplate/externallib.php',
                'description' => 'Returns a list of users enrolled in courses and their grades',
                'type'        => 'read',
            )
);

$services = array(
        'My service' => array(
                'functions' => array ('local_wstemplate_get_users' , 'local_wstemplate_get_courses', 'local_wstemplate_get_enrol_users_and_grade'),
                'restrictedusers' => 0,
                'enabled'=>1,
        )
);
