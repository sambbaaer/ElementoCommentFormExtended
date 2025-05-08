<?php
/**
 * Plugin Name: Elementor Comment Form Extended
 * Description: Ein anpassbares Kommentarformular-Widget für Elementor Pro
 * Version: 1.0.0
 * Author: Entwickelt mit Claude
 * Text Domain: elementor-comment-form-extended
 * Domain Path: /languages
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

// Direkten Zugriff verhindern
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Hauptklasse des Plugins
 */
class Elementor_Comment_Form_Extended {
    /**
     * Plugin-Version
     *
     * @var string
     */
    const VERSION = '1.0.0';

    /**
     * Instanz des Plugins
     *
     * @var Elementor_Comment_Form_Extended
     */
    private static $instance = null;

    /**
     * Singleton-Muster: Gibt eine Instanz der Klasse zurück
     *
     * @return Elementor_Comment_Form_Extended
     */
    public static function get_instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Konstruktor
     */
    public function __construct() {
        // Plugin-Konstanten definieren
        $this->define_constants();
        
        // Autoloader registrieren
        $this->register_autoloader();
        
        // Hooks registrieren
        $this->register_hooks();
    }

    /**
     * Plugin-Konstanten definieren
     */
    private function define_constants() {
        define('ELEMENTOR_COMMENT_FORM_VERSION', self::VERSION);
        define('ELEMENTOR_COMMENT_FORM_FILE', __FILE__);
        define('ELEMENTOR_COMMENT_FORM_PATH', plugin_dir_path(__FILE__));
        define('ELEMENTOR_COMMENT_FORM_URL', plugin_dir_url(__FILE__));
    }

    /**
     * Autoloader registrieren
     */
    private function register_autoloader() {
        require_once ELEMENTOR_COMMENT_FORM_PATH . 'includes/Autoloader.php';
        Elementor_Comment_Form_Extended\Autoloader::run();
    }

    /**
     * Hooks registrieren
     */
    private function register_hooks() {
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Plugin initialisieren
     */
    public function init_plugin() {
        // Prüfen, ob Elementor aktiviert ist
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
            return;
        }

        // Prüfen, ob Elementor Pro aktiviert ist
        if (!class_exists('ElementorPro\Plugin')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_elementor_pro']);
            return;
        }

        // Textdomain laden
        load_plugin_textdomain('elementor-comment-form-extended', false, dirname(plugin_basename(__FILE__)) . '/languages');

        // Widgets registrieren
        add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
        
        // AJAX-Handler registrieren
        $ajax_handler = new Elementor_Comment_Form_Extended\Core\Ajax_Handler();
        $ajax_handler->register_hooks();
    }

    /**
     * Widgets registrieren
     */
    public function register_widgets() {
        // Widget-Manager abrufen
        $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

        // Widget registrieren
        $widgets_manager->register_widget_type(new Elementor_Comment_Form_Extended\Widgets\Widget_Comment_Form());
    }

    /**
     * Admin-Benachrichtigung, wenn Elementor nicht installiert ist
     */
    public function admin_notice_missing_elementor() {
        $message = sprintf(
            /* translators: 1: Plugin-Name 2: Elementor */
            esc_html__('%1$s benötigt %2$s, um zu funktionieren.', 'elementor-comment-form-extended'),
            '<strong>' . esc_html__('Elementor Comment Form Extended', 'elementor-comment-form-extended') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'elementor-comment-form-extended') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    /**
     * Admin-Benachrichtigung, wenn Elementor Pro nicht installiert ist
     */
    public function admin_notice_missing_elementor_pro() {
        $message = sprintf(
            /* translators: 1: Plugin-Name 2: Elementor Pro */
            esc_html__('%1$s benötigt %2$s, um zu funktionieren.', 'elementor-comment-form-extended'),
            '<strong>' . esc_html__('Elementor Comment Form Extended', 'elementor-comment-form-extended') . '</strong>',
            '<strong>' . esc_html__('Elementor Pro', 'elementor-comment-form-extended') . '</strong>'
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }
}

// Plugin initialisieren
Elementor_Comment_Form_Extended::get_instance();
