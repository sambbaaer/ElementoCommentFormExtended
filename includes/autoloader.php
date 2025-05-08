<?php
/**
 * Autoloader für das Plugin
 *
 * @package Elementor_Comment_Form_Extended
 */

namespace Elementor_Comment_Form_Extended;

if (!defined('ABSPATH')) {
    exit; // Direkten Zugriff verhindern
}

/**
 * Autoloader-Klasse
 */
class Autoloader {
    /**
     * Klassenpfad-Präfix
     *
     * @var string
     */
    private static $prefix = 'Elementor_Comment_Form_Extended\\';

    /**
     * Basis-Verzeichnis für die Klassennamespace-Präfix
     *
     * @var string
     */
    private static $base_dir;

    /**
     * Autoloader initialisieren
     */
    public static function run() {
        self::$base_dir = ELEMENTOR_COMMENT_FORM_PATH . 'includes/';
        
        spl_autoload_register([__CLASS__, 'autoload']);
    }

    /**
     * Autoload-Funktion
     *
     * @param string $class Voller Klassenname
     */
    public static function autoload($class) {
        // Prüfen, ob der Klassenname unserem Präfix entspricht
        $len = strlen(self::$prefix);
        if (strncmp(self::$prefix, $class, $len) !== 0) {
            return;
        }

        // Klassenname ohne Präfix
        $relative_class = substr($class, $len);

        // Dateiname erstellen
        $file = self::$base_dir . str_replace('\\', '/', $relative_class) . '.php';

        // Wenn die Datei existiert, laden
        if (file_exists($file)) {
            require $file;
        }
    }
}
