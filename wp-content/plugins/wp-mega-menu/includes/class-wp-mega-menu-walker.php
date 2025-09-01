<?php
class Mega_Menu_Walker extends Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $parent_id = $this->get_parent_id($output);
        $is_mega = $parent_id ? get_post_meta($parent_id, '_is_mega_menu', true) : false;

        if ($is_mega && 0 === $depth) {
            $output .= "\n$indent<div class='mega-menu-container'><ul class='sub-menu mega-menu'>\n";
        } else {
            $output .= "\n$indent<ul class='sub-menu'>\n";
        }
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $parent_id = $this->get_parent_id($output);
        $is_mega = $parent_id ? get_post_meta($parent_id, '_is_mega_menu', true) : false;

        if ($is_mega && 0 === $depth) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= "$indent</ul>\n";
        }
    }

    private function get_parent_id(&$output) {
        preg_match_all('/<li id="menu-item-(\d+)/', $output, $matches);
        return !empty($matches[1]) ? end($matches[1]) : false;
    }
}