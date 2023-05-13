<?php
namespace theme_alpha\output;
use block_myoverview\output\main;
use theme_alpha\util\course;
use core_course_list_element;

class block_myoverview_renderer extends \block_myoverview\output\renderer {

    private $teachersList;

    public function render_main(main $main) {
        global $DB;        

        $theme = \theme_config::load('alpha');
        $displayteachers = $theme->settings->displayteachers;

        $coursecontacts = null;
        $mycourses = enrol_get_my_courses('id');

        foreach ($mycourses as $key => $value) {
            $course = $DB->get_record('course', ['id' => $value->id]);
            $course = new core_course_list_element($course);

            $courseutil = new course($course);
            $courseListTeachers = $courseutil->get_course_contacts();
            foreach ($courseListTeachers as $key_ => $value_) {
                $courseListTeachers[$key_]['courseId'] = $value->id;
            }
            
            $coursecontacts[] = [
                'courseId' => $value->id,
                'courseListTeachers' => $courseListTeachers
            ];
        }

        $teachersList = [
            'hascontacts' => !empty($coursecontacts),
            'cursos' => $coursecontacts,
            'displayteachers' => $displayteachers
        ];
        return $this->render_from_template('block_myoverview/main', $main->export_for_template($this, $teachersList));
    }
}