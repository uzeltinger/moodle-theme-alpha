define(['jquery', 'core/log', 'core/aria'], function ($, log) {
    "use strict"; // ...jshint ;_; !!!

    log.debug('space AMD opt in functions');
    var teachers;

    return {
        init: function (root, id) {
            $(document).ready(function ($) {
                getinnerText(id);
            });
        }
    };

    function getinnerText(id) {
        var course_id_teachers = document.getElementById("courseId-" + id + "-teachers");
        console.log('course_id_teachers', course_id_teachers.innerHTML);
        document.getElementById("course_teachers_" + id).innerHTML = course_id_teachers.innerHTML;
    }
});
/* jshint ignore:end */