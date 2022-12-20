<?php
/**
 * Class autoloader
 *
 * @package    Korey_One
 * @subpackage Includes
 * @category   Core
 * @since      1.0.0
 */

namespace KoreyOne;

// Restrict direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class files
 *
 * Defines the class directories and file prefixes.
 *
 * @since 1.0.0
 * @var   array Defines an array of class file paths.
 */
define( 'KWO_CLASS', [
	'core'       => KWO_PATH . 'includes/classes/core/class-',
	'settings'   => KWO_PATH . 'includes/classes/settings/class-',
	'tools'      => KWO_PATH . 'includes/classes/tools/class-',
	'media'      => KWO_PATH . 'includes/classes/media/class-',
	'users'      => KWO_PATH . 'includes/classes/users/class-',
	'navigation' => KWO_PATH . 'includes/classes/navigation/class-',
	'widgets'    => KWO_PATH . 'includes/classes/widgets/class-',
	'vendor'     => KWO_PATH . 'includes/classes/vendor/class-',
	'admin'      => KWO_PATH . 'includes/classes/backend/class-',
	'front'      => KWO_PATH . 'includes/classes/frontend/class-',
	'customize'  => KWO_PATH . 'includes/classes/customizer/class-',
	'general'    => KWO_PATH . 'includes/classes/class-',
] );

/**
 * Classes namespace
 *
 * @since 1.0.0
 * @var   string Defines the namespace of class files.
 */
define( 'KWO_CLASS_NS', __NAMESPACE__ . '\Classes' );

/**
 * Array of classes to register
 *
 * When you add new classes to your version of this theme you may
 * add them to the following array rather than requiring the file
 * elsewhere. Be sure to include the precise namespace.
 *
 * SAMPLES: Uncomment sample classes to load them.
 *
 * @since 1.0.0
 * @var   array Defines an array of class files to register.
 */
define( 'KWO_CLASSES', [

	// Widgets classes.
	KWO_CLASS_NS . '\Widgets\Theme_Mode' => KWO_CLASS['widgets'] . 'theme-mode.php',

	// Vendor classes.
	KWO_CLASS_NS . '\Vendor\Plugin'    => KWO_CLASS['vendor'] . 'plugin.php',
	KWO_CLASS_NS . '\Vendor\Theme_ACF' => KWO_CLASS['vendor'] . 'theme-acf.php',
] );

/**
 * Autoload class files
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
spl_autoload_register(
	function ( string $class ) {
		if ( isset( KWO_CLASSES[ $class ] ) ) {
			require KWO_CLASSES[ $class ];
		}
	}
);
