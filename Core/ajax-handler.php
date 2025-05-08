<?php
/**
 * AJAX-Handler für Kommentarformular
 *
 * @package Elementor_Comment_Form_Extended
 */

namespace Elementor_Comment_Form_Extended\Core;

if (!defined('ABSPATH')) {
    exit; // Direkten Zugriff verhindern
}

/**
 * AJAX-Handler-Klasse
 */
class Ajax_Handler {
    /**
     * Konstruktor
     */
    public function __construct() {
    }

    /**
     * Hooks registrieren
     */
    public function register_hooks() {
        add_action('wp_ajax_submit_comment', [$this, 'handle_comment_submission']);
        add_action('wp_ajax_nopriv_submit_comment', [$this, 'handle_comment_submission']);
    }

    /**
     * Kommentareinreichung verarbeiten
     */
    public function handle_comment_submission() {
        // Nonce überprüfen
        if (!isset($_POST['comment_nonce']) || !wp_verify_nonce($_POST['comment_nonce'], 'comment_submission')) {
            wp_send_json_error([
                'message' => __('Sicherheitsüberprüfung fehlgeschlagen. Bitte laden Sie die Seite neu und versuchen Sie es erneut.', 'elementor-comment-form-extended')
            ]);
        }

        // Honeypot-Prüfung (optional)
        if (isset($_POST['url']) && !empty($_POST['url'])) {
            // Wenn das versteckte Feld ausgefüllt wurde, handelt es sich wahrscheinlich um einen Bot
            wp_send_json_error([
                'message' => __('Spam-Verdacht. Bitte versuchen Sie es erneut.', 'elementor-comment-form-extended')
            ]);
        }

        $comment_data = [
            'comment_post_ID'      => isset($_POST['comment_post_ID']) ? (int) $_POST['comment_post_ID'] : 0,
            'comment_author'       => isset($_POST['comment_author']) ? sanitize_text_field($_POST['comment_author']) : '',
            'comment_author_email' => isset($_POST['comment_author_email']) ? sanitize_email($_POST['comment_author_email']) : '',
            'comment_author_url'   => isset($_POST['comment_author_url']) ? esc_url_raw($_POST['comment_author_url']) : '',
            'comment_content'      => isset($_POST['comment_content']) ? sanitize_textarea_field($_POST['comment_content']) : '',
            'comment_parent'       => isset($_POST['comment_parent']) ? (int) $_POST['comment_parent'] : 0,
        ];

        // Cookie speichern, wenn angefordert
        if (isset($_POST['wp-comment-cookies-consent']) && $_POST['wp-comment-cookies-consent'] === 'yes') {
            $comment_data['comment_cookies'] = true;
        } else {
            $comment_data['comment_cookies'] = false;
        }

        try {
            // Kommentar mit WordPress-Funktion einreichen
            $comment_id = wp_handle_comment_submission($comment_data);

            if (is_wp_error($comment_id)) {
                wp_send_json_error([
                    'message' => $comment_id->get_error_message()
                ]);
            }

            // Kommentar erfolgreich eingereicht
            wp_send_json_success([
                'comment_id' => $comment_id,
                'message'    => __('Ihr Kommentar wurde erfolgreich eingereicht und wartet auf Moderation.', 'elementor-comment-form-extended')
            ]);
        } catch (\Exception $e) {
            wp_send_json_error([
                'message' => $e->getMessage()
            ]);
        }
    }
}
