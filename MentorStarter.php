<?php
/**
* MentorStarter.
* Main plugin class that holds entire plugin.
* @author   Arif Pavel
* @since   v0.0.1
* @version   v1.0.0   Wednesday, Mar 31th, 2021.
*/

// If this file is called firectly, abort!!!
defined('ABSPATH') or die('This is not the place you deserve!');

class MentorStarter
{
    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * __construct.
     * Constructor function
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function __construct()
    {
        // set the constants first
        $this->setConstants();

        // check & load the autoloader
        if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
            require_once dirname(__FILE__) . '/vendor/autoload.php';
        }
        // register the activation
        register_activation_hook(__FILE__, [$this, 'activate']);

        // registser the deactivation
        register_deactivation_hook(__FILE__, [$this, 'deactivate']);

        // init plugin on loaded
        add_action('plugins_loaded', [$this, 'init'], 11);
    }

    /**
     * setConstants.
     * define default constants
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function setConstants()
    {
        define('MENTORSTARTER_VERSION', $this->version);
        define('MENTORSTARTER_TEXTDOMAIN', 'metnorstarter');
        define('MENTORSTARTER_FILE', __FILE__);
        define('MENTORSTARTER_NAME', 'Mentor Starter');
        define('MENTORSTARTER_PATH', dirname(MENTORSTARTER_FILE));
        define('MENTORSTARTER_INC', MENTORSTARTER_PATH . '/inc');
        define('MENTORSTARTER_URL', plugins_url('', MENTORSTARTER_FILE));
        define('MENTORSTARTER_ASSETS', MENTORSTARTER_URL . '/assets');
    }

    /**
     * activate.
     * function that runs on plugin activation
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function activate()
    {
        // flush rewrite rules
        flush_rewrite_rules();

        $isInstalled = get_option('mentorstarter_installed');

        if (!$isInstalled) {
            update_option('mentorstarter_installed', time());
        }

        update_option('mentorstarter_version', MENTORSTARTER_VERSION);
    }

    /**
     * deactivate.
     * function that runs on plugin deactivation
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function deactivate()
    {
        // Flush reqrite rules
        flush_rewrite_rules();
    }

    /**
     * init.
     * Initialize various classes
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     * @return   void
     */
    public function init()
    {
        /**
         * Check if elementor installed & active already.
         */
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'adminNoticeMissingElementor']);
        }
        /**
         * Initialize all the core classes of the plugin
         */
        if (class_exists("Inc\\Core")) {
            Inc\Core::registerServices();
        }
    }

    /* adminNoticeMissingElementor
     * Show admin notice if paranet plugin is missing.
     * @author Arif Pavel
     * @since 31 Mar 21
     * @version v1.0.0
     * @param mixed
     * @return null
    */
    public function adminNoticeMissingElementor()
    {
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }

        $message = sprintf(
            /* translators: 1: Plugin Name 2: Elementor */
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'text-domain'),
            '<strong>' . esc_html__(MENTORSTARTER_NAME, MENTORSTARTER_TEXTDOMAIN) . '</strong>',
            '<strong>' . esc_html__('Elementor', MENTORSTARTER_TEXTDOMAIN) . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * initiateMentorStarter.
     * Return an instance if not intiated yet
     * @author   Arif Pavel
     * @since   v0.0.1
     * @version   v1.0.0   Wednesday, Mar 31th, 2021.
     * @access   public
     */
    public static function initiateMentorStarter()
    {
        return new MentorStarter();
    }
}
