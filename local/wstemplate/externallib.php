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
 * External Web Service Template
 *
 * @package    local_wstemplate
 * @copyright  2021 Vlad Antoniukov, antonykov.v@gmail.com
 * @license
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir . "/externallib.php");

class local_wstemplate_external extends external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_users_parameters() {
        return new external_function_parameters(
                array()
        );
    }

    /**
     * Returns a list of users
     *
     * @return array the list of users
     */
    public static function get_users() {
        return get_users();
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_users_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'id'),
                    'firstname' => new external_value(PARAM_TEXT, 'FName'),
                    'lastname' => new external_value(PARAM_TEXT, 'LName'),
                )
            )
        );
    }

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_courses_parameters() {
        return new external_function_parameters(
            array()
        );
    }

    /**
     * Returns a list of courses
     *
     * @return array the list of courses
     */
    public static function get_courses() {
        $courses = get_courses();

        // Unset course with id = 1 (site).
        unset($courses[1]);
        return $courses;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_courses_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'id' => new external_value(PARAM_INT, 'id'),
                    'fullname' => new external_value(PARAM_TEXT, 'Course name'),
                    'shortname' => new external_value(PARAM_TEXT, 'Short course name'),
                )
            )
        );
    }

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     */
    public static function get_enrol_users_and_grade_parameters() {
        return new external_function_parameters(
            array()
        );
    }

    /**
     * Returns a list of users enrolled in courses and their grades
     *
     * @return array the list of users enrolled in courses and their grades
     * @throws dml_exception
     */
    public static function get_enrol_users_and_grade() {
        global $DB;

        $enrolusers =[];

        // ID, firstname and lastname of users enrolled in courses.
        $users = $DB->get_records_sql('SELECT mdl_user_enrolments.userid, mdl_user.firstname, mdl_user.lastname
                                             FROM mdl_user_enrolments,mdl_user
                                            WHERE mdl_user_enrolments.userid = mdl_user.id
                                         GROUP BY mdl_user_enrolments.userid;');

        $users = json_decode(json_encode($users), true);

        foreach($users as $key => $value) {
            $key = $value['userid'];

            // Name of courses where users are enrolled.
            $enrolid = $DB->get_records_sql('SELECT mdl_course.id, mdl_course.fullname
                                                   FROM mdl_user_enrolments, mdl_enrol, mdl_course
                                                  WHERE mdl_user_enrolments.userid = ? 
                                                        AND mdl_user_enrolments.enrolid = mdl_enrol.id 
                                                        AND mdl_enrol.courseid = mdl_course.id;', [$key]);

            $enrolid = json_decode(json_encode($enrolid), true);

            foreach($enrolid as $key2 => $value2) {
                $key2 = $value2['id'];

                // Users grades.
                $grade = $DB->get_records_sql('SELECT mdl_quiz_grades.id, mdl_quiz_grades.grade, mdl_quiz.name
                                                     FROM mdl_quiz_grades, mdl_quiz
                                                    WHERE mdl_quiz_grades.userid = ? 
                                                          AND mdl_quiz.course = ? 
                                                          AND mdl_quiz_grades.quiz = mdl_quiz.id;', [$key, $key2]);
                $grade = json_decode(json_encode($grade), true);

                $enrolid[$key2]['grade'] = $grade;
            }

            // An array with the name of the user and their grades for the courses.
            $enrolusers[] = ['firstname'=> $value['firstname'], 'lastname'=> $value['lastname'], 'courses'=> $enrolid];

        }
        return $enrolusers;
    }

    /**
     * Returns description of method result value
     *
     * @return external_description
     */
    public static function get_enrol_users_and_grade_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'firstname' => new external_value(PARAM_TEXT, 'First name'),
                    'lastname' => new external_value(PARAM_TEXT, 'Last name'),
                    'courses' => new external_multiple_structure(
                        new external_single_structure(
                            array(
                                'id' => new external_value(PARAM_INT, 'id'),
                                'fullname' => new external_value(PARAM_TEXT, 'Course name'),
                                'grade' => new external_multiple_structure(
                                    new external_single_structure(
                                        array(
                                            'id' => new external_value(PARAM_INT, 'id'),
                                            'grade' => new external_value(PARAM_FLOAT, 'Grade'),
                                            'name' => new external_value(PARAM_TEXT, 'Test name'),
                                        )
                                    )
                                )
                            )
                        )
                    ),
                )
            )
        );
    }

}
