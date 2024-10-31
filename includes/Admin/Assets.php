<?php
namespace Kamal\Wp301Redirects\Admin;

class Assets {
    public function __construct()
    {
        add_action('admin_enqueue_scripts', [$this, 'plugin_scripts']);
    }
    /**
	 * Enqueue Files on Start Plugin
	 *
	 * @function plugin_script
	 */
	public function plugin_scripts($hook)
	{
		if (\Kamal\Wp301Redirects\Helper::plugin_page_hook_suffix($hook)) {
			add_action(
				'wp_print_scripts',
				function () {
					$isSkip = apply_filters('Wp301Redirects/Admin/skip_no_conflict', false);

					if ($isSkip) {
						return;
					}

					global $wp_scripts;
					if (!$wp_scripts) {
						return;
					}

					$pluginUrl = plugins_url();
					// var_dump($pluginUrl);
					foreach ($wp_scripts->queue as $script) {
						$src = $wp_scripts->registered[$script]->src;
						// var_dump($src);
						if (strpos($src, $pluginUrl) !== false && !strpos($src, 'wp-301-redirects') !== false) {
							// var_dump($src);
							wp_dequeue_script($wp_scripts->registered[$script]->handle);
						}
					}
				},
				1
			);
			wp_enqueue_style('wp-301-redirects-admin-style', WP301REDIRECTS_ASSETS_URI . 'css/wp-301-redirects.css', [], filemtime(WP301REDIRECTS_ASSETS_DIR_PATH . 'css/wp-301-redirects.css'), 'all');

			$dependencies = include_once WP301REDIRECTS_ASSETS_DIR_PATH . 'js/wp-301-redirects.core.min.asset.php';
			wp_enqueue_script(
				'wp-301-redirects-admin',
				WP301REDIRECTS_ASSETS_URI . 'js/wp-301-redirects.core.min.js',
				$dependencies['dependencies'],
				$dependencies['version'],
				true
			);

			wp_localize_script('wp-301-redirects-admin', 'Wp301Redirects', [
				'wpr_nonce' => wp_create_nonce('wp301redirects'),
				'plugin_root_url' => WP301REDIRECTS_PLUGIN_ROOT_URI,
				'plugin_root_path' => WP301REDIRECTS_ROOT_DIR_PATH,
				'site_url' => site_url('/'),
				'route_path' => parse_url(admin_url(), PHP_URL_PATH),
			]);
		}
	}
}