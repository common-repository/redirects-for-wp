<?php
namespace Kamal\Wp301Redirects;

class Installer {
    
    public function migrate()
    {
        $this->set_version_number();
    }

    public function set_version_number()
    {
        if (get_option('wp301redirects_version') != WP301REDIRECTS_VERSION) {
			update_option('wp301redirects_version', WP301REDIRECTS_VERSION);
		}
    }
}