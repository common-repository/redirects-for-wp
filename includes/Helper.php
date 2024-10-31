<?php
namespace Kamal\Wp301Redirects;

class Helper
{
    /**
     * Check Supported Post type for admin page and plugin main settings page
     *
     * @return bool
     */

    public static function plugin_page_hook_suffix($hook)
    {
        if ($hook == 'settings_page_wp_redirect_options') {
            return true;
        }
        return false;
    }
    public static function str_ireplace($search, $replace, $subject)
    {
        $token = chr(1);
        $haystack = strtolower($subject);
        $needle = strtolower($search);
        while (($pos=strpos($haystack, $needle))!==false) {
            $subject = substr_replace($subject, $token, $pos, strlen($search));
            $haystack = substr_replace($haystack, $token, $pos, strlen($search));
        }
        $subject = str_replace($token, $replace, $subject);
        return $subject;
    }

    

   

   

    public static function sanitize_text_or_array_field($array_or_string)
    {
        if (is_string($array_or_string)) {
            $array_or_string = sanitize_text_field($array_or_string);
        } elseif (is_array($array_or_string)) {
            foreach ($array_or_string as $key => &$value) {
                if (is_array($value)) {
                    $value = self::sanitize_text_or_array_field($value);
                } else {
                    $value = sanitize_text_field($value);
                }
            }
        }
        return $array_or_string;
    }
}
