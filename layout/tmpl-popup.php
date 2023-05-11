<?php
// This file is part of Moodle - http://moodle.org/
//
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
 *
 * @package   theme_alpha
 * @copyright 2022 - 2023 Marcin Czaja (https://rosea.io)
 * @license   Commercial https://themeforest.net/licenses
 */

defined('MOODLE_INTERNAL') || die();
user_preference_allow_ajax_update('darkmode-on', PARAM_ALPHA);
$extraclasses = [];

// Dark mode.
if (theme_alpha_get_setting('darkmodetheme') == '1') {
    $darkmodeon = (get_user_preferences('darkmode-on', 'false') == 'true');
    if ($darkmodeon) {
        $extraclasses[] = 'theme-dark';
    }
    $darkmodetheme = true;
} else {
    $darkmodeon = false;
}

if (theme_alpha_get_setting('darkmodefirst') == '1') {
    $extraclasses[] = 'theme-dark';
    $darkmodetheme = false;
}
$bodyattributes = $OUTPUT->body_attributes($extraclasses);
$siteurl = $CFG->wwwroot;
$templatecontext = [
    'sitename' => format_string($SITE->shortname, true, ['context' => context_course::instance(SITEID), "escape" => false]),
    'output' => $OUTPUT,
    'bodyattributes' => $bodyattributes,
    'darkmodeon' => !empty($darkmodeon),
    'darkmodetheme' => !empty($darkmodetheme),
    'siteurl' => $siteurl
];

// Load theme settings.
$themesettings = new \theme_alpha\util\theme_settings();
$templatecontext = array_merge($templatecontext, $themesettings->global_settings());
$templatecontext = array_merge($templatecontext, $themesettings->footer_settings());

echo $OUTPUT->render_from_template('theme_alpha/tmpl-popup', $templatecontext);