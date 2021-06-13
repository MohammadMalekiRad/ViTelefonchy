<?php

namespace ViTelefonchy;

require_once 'vendor/autoload.php';

use ViTelefonchy\classes\OptionPanel;

/**
 * @package ViTelefonchy
 * @version 1.0.2
 */

/*
Plugin Name: Telefonchy
Plugin URI: http://mohammadmalekirad.ir/ViTelefonchy
Description: این افزونه اطلاعات لیست تماس سرویس تلفنچی را در پنل وردپرس شما نمایش می دهد.
Author: Mohammad MalekiRad
Version: 1.0.2
Author URI: http://mohammadmalekirad.ir/
Requires at least: 5.2
Requires PHP: 7.0
License URI: https://opensource.org/licenses/MIT
Code Name: ViTelefonchy
*/
define( 'VI_TELEFONCHY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'VI_TELEFONCHY_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'VI_TELEFONCHY_PLUGIN_FILE', __FILE__ );

OptionPanel::getInstance();