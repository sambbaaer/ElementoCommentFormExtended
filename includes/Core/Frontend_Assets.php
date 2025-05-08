<?php
/**
 * Frontend-Assets-Handler
 *
 * @package Elementor_Comment_Form_Extended
 */

namespace Elementor_Comment_Form_Extended\Core;

if (!defined('ABSPATH')) {
    exit; // Direkten Zugriff verhindern
}

/**
 * Frontend-Assets-Klasse
 */
class Frontend_Assets {
    /**
     * Rekursive Suche nach dem Widget in den Elementor-Daten
     *
     * @param array  $elements Elementor-Daten
     * @param string $widget_name Widget-Name
     * @return bool
     */
    private function find_widget_recursive($elements, $widget_name) {
        foreach ($elements as $element) {
            if (isset($element['widgetType']) && $element['widgetType'] === $widget_name) {
                return true;
            }
            
            if (isset($element['elements']) && !empty($element['elements'])) {
                $found = $this->find_widget_recursive($element['elements'], $widget_name);
                
                if ($found) {
                    return true;
                }
            }
        }
        
        return false;
    }
    return false;
}

    /**
     * Konstruktor
     */
    public function __construct() {
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_styles']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'register_scripts']);
        add_action('elementor/frontend/before_enqueue_scripts', [$this, 'maybe_enqueue_scripts']);
    }

    /**
     * Stylesheets registrieren
     */
    public function enqueue_styles() {
        wp_register_style(
            'elementor-comment-form-extended',
            ELEMENTOR_COMMENT_FORM_URL . 'assets/css/comment-form.css',
            [],
            ELEMENTOR_COMMENT_FORM_VERSION
        );
    }

    /**
     * Skripte registrieren
     */
    public function register_scripts() {
        wp_register_script(
            'elementor-comment-form-extended',
            ELEMENTOR_COMMENT_FORM_URL . 'assets/js/comment-form.js',
            ['jquery'],
            ELEMENTOR_COMMENT_FORM_VERSION,
            true
        );

        wp_localize_script(
            'elementor-comment-form-extended',
            'ElementorCommentFormVars',
            [
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce'   => wp_create_nonce('elementor_comment_form_nonce'),
                'i18n'    => [
                    'required'      => __('Dieses Feld ist erforderlich.', 'elementor-comment-form-extended'),
                    'email'         => __('Bitte geben Sie eine gültige E-Mail-Adresse ein.', 'elementor-comment-form-extended'),
                    'url'           => __('Bitte geben Sie eine gültige URL ein.', 'elementor-comment-form-extended'),
                    'sending'       => __('Wird gesendet...', 'elementor-comment-form-extended'),
                    'error'         => __('Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.', 'elementor-comment-form-extended'),
                    'success'       => __('Ihr Kommentar wurde erfolgreich eingereicht und wartet auf Moderation.', 'elementor-comment-form-extended'),
                ],
            ]
        );
    }

    /**
     * Skripte laden, wenn das Widget verwendet wird
     */
    public function maybe_enqueue_scripts() {
        if (!class_exists('\Elementor\Plugin')) {
            return;
        }

        $elementor = \Elementor\Plugin::instance();

        if (!$elementor->preview->is_preview_mode() && !$elementor->editor->is_edit_mode()) {
            // Überprüfen, ob das Widget auf der aktuellen Seite verwendet wird
            $document = $elementor->documents->get(get_the_ID());
            
            if (!$document) {
                return;
            }
            
            $data = $document->get_elements_data();
            
            if (empty($data)) {
                return;
            }
            
            // Rekursiv nach dem Widget suchen
            $found = $this->find_widget_recursive($data, 'comment_form');
            
            if ($found) {
                wp_enqueue_style('elementor-comment-form-extended');
                wp_enqueue_script('elementor-comment-form-extended');
            }
        } else {
            // Im Editor- oder Vorschau-Modus immer laden
            wp_enqueue_style('elementor-comment-form-extended');
            wp_enqueue_script('elementor-comment-form-extended');
        }
    }

    /**