<?php
/**
 * Combo Offer
 *
 * @package   combo-offer
 * @author    Yegappan
 * @copyright 2022 Flycart
 * @license   GPL v2 or later
 * @link      https://flycart.org
 */

namespace Combo\App\Helper;

defined( 'ABSPATH' ) || exit;


class Functions
{
    /**
     * View
     *
     * @param $path
     * @param $data
     * @param bool $print
     * @return false|string
     */
    public static function view($path, $data, $print = true)
    {
        $file = COMBO_PLUGIN_PATH . '/app/Views/' . $path . '.php';
        return self::renderTemplate($file, $data, $print);
    }

    /**
     * Render template file
     *
     * @param $file
     * @param $data
     * @param bool $print
     * @return false|string
     */
    public static function renderTemplate($file, $data, $print = true)
    {
        if (file_exists($file)) {
            ob_start();
            extract($data);
            include $file;
            $output = ob_get_clean();

            if ($print) {
                echo $output;
            }
            return $output;
        }
        return false;
    }
}