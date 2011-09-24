<?php
      // format.php - course format featuring social forum
      //              included from view.php

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
 * Format for socialbloc
 *
 * @package   format_socialbloc
 * @copyright 1999 onwards Martin Dougiamas  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
    $strgroups  = get_string('groups');
    $strgroupmy = get_string('groupmy');
    $editing    = $PAGE->user_is_editing();
    $existstop1 = $PAGE->blocks->region_has_content('top1', $OUTPUT);
    $existstop2 = $PAGE->blocks->region_has_content('top2', $OUTPUT);
    $existstop3 = $PAGE->blocks->region_has_content('top3', $OUTPUT);
    $existstop4 = $PAGE->blocks->region_has_content('top4', $OUTPUT);
    $existsbot1 = $PAGE->blocks->region_has_content('bot1', $OUTPUT);
    $existsbot2 = $PAGE->blocks->region_has_content('bot2', $OUTPUT);
    $existsbot3 = $PAGE->blocks->region_has_content('bot3', $OUTPUT);
    $existsbot4 = $PAGE->blocks->region_has_content('bot4', $OUTPUT);

    //Load top block areas
    if($existstop1) {   //Check if the region is set up
        echo '<div class="top1 block">';
        echo $OUTPUT->blocks_for_region('top1');
        echo '</div>';
    } else if($editing) {   //If not, output an error in edit mode
        echo '<h2>Course Format Configuration Error</h2><p>region top1 does not exist.<br />'.
        'Please refer to '.$CFG->wwwroot.'course/format/socialbloc/README.txt</p>';
    }
    
    if($existstop2 && $existstop3 && $existstop4) {   //Check if the regions are set up
        echo '<div class="tri_column">';
        echo '<div class="top2 block" style="margin-right:6%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('top2');
        echo '</div>';
        echo '<div class="top3 block" style="margin-right:6%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('top3');
        echo '</div>';
        echo '<div class="top4 block" style="margin-right:0%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('top4');
        echo '</div>';
        echo '<div style="clear:both;">&nbsp</div>';
        echo '</div>';
    } else if($editing) {   //If not, output an error in edit mode
        echo '<h2>Course Format Configuration Error</h2><p>regions top2, top3, and top4 do not exist.<br />'.
        'Please refer to '.$CFG->wwwroot.'course/format/socialbloc/README.txt</p>';
    }
    
    if ($forum = forum_get_course_forum($course->id, 'social')) {

        $cm = get_coursemodule_from_instance('forum', $forum->id);
        $context = get_context_instance(CONTEXT_MODULE, $cm->id);

    /// Print forum intro above posts  MDL-18483
        if (trim($forum->intro) != '') {
            $options = new stdClass();
            $options->para = false;
            $introcontent = format_module_intro('forum', $forum, $cm->id);

            if ($PAGE->user_is_editing() && has_capability('moodle/course:update', $context)) {
                $streditsummary  = get_string('editsummary');
                $introcontent .= '<div class="editinglink"><a title="'.$streditsummary.'" '.
                                 '   href="modedit.php?update='.$cm->id.'&amp;sesskey='.sesskey().'">'.
                                 '<img src="'.$OUTPUT->pix_url('t/edit') . '" '.
                                 ' class="icon edit" alt="'.$streditsummary.'" /></a></div>';
            }
            echo $OUTPUT->box($introcontent, 'generalbox', 'intro');
        }

        echo '<div class="subscribelink">', forum_get_subscribe_link($forum, $context), '</div>';
        forum_print_latest_discussions($course, $forum, 10, 'plain', '', false);

    } else {
        echo $OUTPUT->notification('Could not find or create a social forum here');
    }
    
        //Load bottom block regions
    if($existsbot1) {   //Check if the region is set up
        echo '<div class="bot1 block">';
        echo $OUTPUT->blocks_for_region('bot1');
        echo '</div>';
    } else if($editing) {
        echo '<h2>Course Format Configuration Error</h2><p>region bot1 does not exist.<br />'.
        'Please refer to '.$CFG->wwwroot.'course/format/socialbloc/README.txt</p>';
    }
    
    if($existsbot2 && $existsbot3 && $existsbot4) {   //Check if the regions are set up
        echo '<div class="tri_column">';
        echo '<div class="bot2 block" style="margin-right:6%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('bot2');
        echo '</div>';
        echo '<div class="bot3 block" style="margin-right:6%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('bot3');
        echo '</div>';
        echo '<div class="bot4 block" style="margin-right:0%;float:left;width:29.33%;">';
        echo $OUTPUT->blocks_for_region('bot4');
        echo '</div>';
        echo '<div style="clear:both;">&nbsp</div>';
        echo '</div>';
    } else if($editing) {   //If not, output an error in edit mode
        echo '<h2>Course Format Configuration Error</h2><p>regions bot2, bot3, and bot4 do not exist.<br />'.
        'Please refer to '.$CFG->wwwroot.'course/format/socialbloc/README.txt</p>';
    }

