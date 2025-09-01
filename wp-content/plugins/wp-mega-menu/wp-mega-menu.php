<?php
/**
 * Plugin Name: Mega Menu Ultimate
 * Description: Fully functional mega menu system
 * Version: 2.0
 * Author: Your Name
 */

defined('ABSPATH') || exit;

// Define constants
define('MEGA_MENU_VERSION', '2.0');
define('MEGA_MENU_PATH', plugin_dir_path(__FILE__));
define('MEGA_MENU_URL', plugin_dir_url(__FILE__));

class Mega_Menu_Plugin {

    public function __construct() {
        // Load files
        require_once MEGA_MENU_PATH . 'includes/class-wp-mega-menu-walker.php';

        // Register hooks
        add_action('admin_enqueue_scripts', [$this, 'admin_assets']);
        add_action('wp_nav_menu_item_custom_fields', [$this, 'add_menu_fields'], 10, 4);
        add_action('wp_update_nav_menu_item', [$this, 'save_menu_fields'], 10, 3);
        add_filter('wp_nav_menu_args', [$this, 'apply_walker']);
    }

    public function admin_assets($hook) {
        if ('nav-menus.php' !== $hook) return;
        
        wp_enqueue_style(
            'mega-menu-admin-css', 
            MEGA_MENU_URL . 'assets/css/admin.css',
            [],
            MEGA_MENU_VERSION
        );
        
        wp_enqueue_script(
            'mega-menu-admin-js',
            MEGA_MENU_URL . 'assets/js/admin.js',
            ['jquery'],
            MEGA_MENU_VERSION,
            true
        );
    }

    public function add_menu_fields($id, $item, $depth, $args) {
        $is_mega = get_post_meta($item->ID, '_is_mega_menu', true);
        ?>
        <div class="field-mega-menu description description-wide">
            <label>
                <input type="checkbox" 
                    name="menu-item-mega-menu[<?php echo $item->ID ?>]" 
                    value="1" 
                    <?php checked($is_mega, 1) ?> />
                <?php esc_html_e('Enable Mega Menu', 'mega-menu') ?>
            </label>
        </div>
        <?php
    }

    public function save_menu_fields($menu_id, $menu_item_db_id, $args) {
        $mega_enabled = isset($_POST['menu-item-mega-menu'][$menu_item_db_id]) ? 1 : 0;
        update_post_meta($menu_item_db_id, '_is_mega_menu', $mega_enabled);
    }

    public function apply_walker($args) {
        if (!isset($args['walker'])) {
            $args['walker'] = new Mega_Menu_Walker();
        }
        return $args;
    }
}

new Mega_Menu_Plugin();