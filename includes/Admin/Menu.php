<?php 
namespace Kamal\Wp301Redirects\Admin;

class Menu {
    public function __construct()
    {
        add_action('admin_menu', array($this,'create_menu'));
        // if submitted, process the data
        if (isset($_POST['wp_301_redirects'])) {
            add_action('admin_init', array($this,'save_redirects'));
        }
    }

    /**
     * create_menu function
     * generate the link to the options page under settings
     * @access public
     * @return void
     */
    public function create_menu() {
        add_options_page('WP 301 Redirects', 'WP 301 Redirects', 'manage_options', 'wp_redirect_options', array($this,'load_main_template'));
    }

    public function load_main_template()
	{
		echo '<div id="wp301redirectsbody" class="wp301redirects"></div>';
	}
}