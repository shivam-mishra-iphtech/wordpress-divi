<?php
class WP_Mega_Menu {
    public function __construct() {
        // Frontend
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        
        // Admin
        if (is_admin()) {
            add_action('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
            add_action('wp_nav_menu_item_custom_fields', [$this, 'add_menu_item_fields'], 10, 4);
            add_action('wp_update_nav_menu_item', [$this, 'save_menu_item_fields'], 10, 3);
        }
        
        // Menu Walker
        add_filter('wp_nav_menu_args', [$this, 'modify_menu_args']);
    }

    public function enqueue_scripts() {
        wp_enqueue_style('wp-mega-menu', WP_MEGA_MENU_URL . 'assets/css/frontend.css', [], WP_MEGA_MENU_VERSION);
        wp_enqueue_script('wp-mega-menu', WP_MEGA_MENU_URL . 'assets/js/frontend.js', ['jquery'], WP_MEGA_MENU_VERSION, true);
    }

    public function admin_enqueue_scripts($hook) {
        if ('nav-menus.php' !== $hook) return;
        
        wp_enqueue_style('wp-mega-menu-admin', WP_MEGA_MENU_URL . 'assets/css/admin.css', [], WP_MEGA_MENU_VERSION);
        wp_enqueue_script('wp-mega-menu-admin', WP_MEGA_MENU_URL . 'assets/js/admin.js', ['jquery'], WP_MEGA_MENU_VERSION, true);
    }

    public function add_menu_item_fields($id, $item, $depth, $args) {
        $is_mega = get_post_meta($item->ID, '_is_mega_menu', true);
        $columns = get_post_meta($item->ID, '_mega_menu_columns', true) ?: '4';
        ?>
        <div class="field-mega-menu description description-wide">
            <label>
                <input type="checkbox" name="menu-item-mega-menu[<?= $item->ID ?>]" value="1" <?php checked($is_mega, 1) ?> />
                <?php _e('Enable Mega Menu', 'wp-mega-menu') ?>
            </label>
        </div>
        
        <div class="field-mega-menu-columns description description-wide" style="<?= $is_mega ? '' : 'display:none' ?>">
            <label>
                <?php _e('Columns:', 'wp-mega-menu') ?>
                <select name="menu-item-mega-menu-columns[<?= $item->ID ?>]">
                    <option value="2" <?php selected($columns, '2') ?>>2</option>
                    <option value="3" <?php selected($columns, '3') ?>>3</option>
                    <option value="4" <?php selected($columns, '4') ?>>4</option>
                </select>
            </label>
        </div>
        <?php
    }

    public function save_menu_item_fields($menu_id, $menu_item_db_id, $args) {
        $mega_enabled = isset($_POST['menu-item-mega-menu'][$menu_item_db_id]) ? 1 : 0;
        update_post_meta($menu_item_db_id, '_is_mega_menu', $mega_enabled);
        
        if (isset($_POST['menu-item-mega-menu-columns'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_mega_menu_columns', sanitize_text_field($_POST['menu-item-mega-menu-columns'][$menu_item_db_id]));
        }
    }

    public function modify_menu_args($args) {
        if (!isset($args['walker'])) {
            $args['walker'] = new WP_Mega_Menu_Walker();
        }
        return $args;
    }
}