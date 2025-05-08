<?php
/**
 * Kommentarformular-Widget für Elementor
 *
 * @package Elementor_Comment_Form_Extended
 */

namespace Elementor_Comment_Form_Extended\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if (!defined('ABSPATH')) {
    exit; // Direkten Zugriff verhindern
}

/**
 * Kommentarformular-Widget-Klasse
 */
class Widget_Comment_Form extends Widget_Base {
    /**
     * Widget-Name abrufen
     *
     * @return string Widget-Name
     */
    public function get_name() {
        return 'comment_form';
    }

    /**
     * Widget-Titel abrufen
     *
     * @return string Widget-Titel
     */
    public function get_title() {
        return __('Kommentarformular', 'elementor-comment-form-extended');
    }

    /**
     * Widget-Symbol abrufen
     *
     * @return string Widget-Symbol
     */
    public function get_icon() {
        return 'eicon-comments';
    }

    /**
     * Widget-Kategorien abrufen
     *
     * @return array Widget-Kategorien
     */
    public function get_categories() {
        return ['theme-elements'];
    }

    /**
     * Widget-Schlüsselwörter abrufen
     *
     * @return array Widget-Schlüsselwörter
     */
    public function get_keywords() {
        return ['kommentar', 'formular', 'kommentare', 'diskussion'];
    }

    /**
     * Widget-Steuerelemente registrieren
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_form',
            [
                'label' => __('Formular-Einstellungen', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'form_title',
            [
                'label'       => __('Formular-Titel', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Einen Kommentar hinterlassen', 'elementor-comment-form-extended'),
                'placeholder' => __('Formular-Titel eingeben', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'show_author_field',
            [
                'label'     => __('Namen-Feld anzeigen', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'author_label',
            [
                'label'       => __('Namen-Beschriftung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Name', 'elementor-comment-form-extended'),
                'placeholder' => __('Namen-Beschriftung eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_author_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'author_placeholder',
            [
                'label'       => __('Namen-Platzhalter', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Ihr Name', 'elementor-comment-form-extended'),
                'placeholder' => __('Namen-Platzhalter eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_author_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_email_field',
            [
                'label'     => __('E-Mail-Feld anzeigen', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'email_label',
            [
                'label'       => __('E-Mail-Beschriftung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('E-Mail', 'elementor-comment-form-extended'),
                'placeholder' => __('E-Mail-Beschriftung eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_email_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'email_placeholder',
            [
                'label'       => __('E-Mail-Platzhalter', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Ihre E-Mail-Adresse', 'elementor-comment-form-extended'),
                'placeholder' => __('E-Mail-Platzhalter eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_email_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_url_field',
            [
                'label'     => __('Website-Feld anzeigen', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'url_label',
            [
                'label'       => __('Website-Beschriftung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Website', 'elementor-comment-form-extended'),
                'placeholder' => __('Website-Beschriftung eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_url_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'url_placeholder',
            [
                'label'       => __('Website-Platzhalter', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Ihre Website', 'elementor-comment-form-extended'),
                'placeholder' => __('Website-Platzhalter eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_url_field' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'comment_label',
            [
                'label'       => __('Kommentar-Beschriftung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Kommentar', 'elementor-comment-form-extended'),
                'placeholder' => __('Kommentar-Beschriftung eingeben', 'elementor-comment-form-extended'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'comment_placeholder',
            [
                'label'       => __('Kommentar-Platzhalter', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Ihr Kommentar...', 'elementor-comment-form-extended'),
                'placeholder' => __('Kommentar-Platzhalter eingeben', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'show_cookies_checkbox',
            [
                'label'     => __('Cookie-Checkbox anzeigen', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'cookies_text',
            [
                'label'       => __('Cookie-Text', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Speichern Sie meinen Namen, E-Mail und Website in diesem Browser für die nächste Kommentierung.', 'elementor-comment-form-extended'),
                'placeholder' => __('Cookie-Text eingeben', 'elementor-comment-form-extended'),
                'condition'   => [
                    'show_cookies_checkbox' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'submit_button_text',
            [
                'label'       => __('Button-Text', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Kommentar absenden', 'elementor-comment-form-extended'),
                'placeholder' => __('Button-Text eingeben', 'elementor-comment-form-extended'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'show_honeypot',
            [
                'label'       => __('Honeypot-Spam-Schutz', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::SWITCHER,
                'default'     => 'yes',
                'description' => __('Fügt ein verstecktes Feld hinzu, um Spam-Bots abzuwehren.', 'elementor-comment-form-extended'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'success_message',
            [
                'label'       => __('Erfolgsmeldung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Ihr Kommentar wurde erfolgreich eingereicht und wartet auf Moderation.', 'elementor-comment-form-extended'),
                'placeholder' => __('Erfolgsmeldung eingeben', 'elementor-comment-form-extended'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'error_message',
            [
                'label'       => __('Fehlermeldung', 'elementor-comment-form-extended'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Es ist ein Fehler aufgetreten. Bitte versuchen Sie es erneut.', 'elementor-comment-form-extended'),
                'placeholder' => __('Fehlermeldung eingeben', 'elementor-comment-form-extended'),
            ]
        );

        $this->end_controls_section();

        // Formular-Stil
        $this->start_controls_section(
            'section_form_style',
            [
                'label' => __('Formular-Stil', 'elementor-comment-form-extended'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'form_background_color',
            [
                'label'     => __('Hintergrundfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_padding',
            [
                'label'      => __('Innenabstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'form_margin',
            [
                'label'      => __('Aussenabstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'form_border',
                'selector' => '{{WRAPPER}} .elementor-comment-form-wrapper',
            ]
        );

        $this->add_responsive_control(
            'form_border_radius',
            [
                'label'      => __('Rahmenradius', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'form_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-comment-form-wrapper',
            ]
        );

        $this->end_controls_section();

        // Eingabefeld-Stil
        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __('Eingabefeld-Stil', 'elementor-comment-form-extended'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'input_spacing',
            [
                'label'      => __('Abstand zwischen Feldern', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-field:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_padding',
            [
                'label'      => __('Innenabstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_input_style');

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label' => __('Normal', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label'     => __('Textfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label'     => __('Hintergrundfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'input_border',
                'selector' => '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea',
            ]
        );

        $this->add_responsive_control(
            'input_border_radius',
            [
                'label'      => __('Rahmenradius', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label' => __('Fokus', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'input_focus_text_color',
            [
                'label'     => __('Textfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field input:focus, {{WRAPPER}} .elementor-comment-form-field textarea:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_focus_background_color',
            [
                'label'     => __('Hintergrundfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field input:focus, {{WRAPPER}} .elementor-comment-form-field textarea:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_focus_border_color',
            [
                'label'     => __('Rahmenfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field input:focus, {{WRAPPER}} .elementor-comment-form-field textarea:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'input_focus_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-comment-form-field input:focus, {{WRAPPER}} .elementor-comment-form-field textarea:focus',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'selector' => '{{WRAPPER}} .elementor-comment-form-field input, {{WRAPPER}} .elementor-comment-form-field textarea',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Label-Stil
        $this->start_controls_section(
            'section_label_style',
            [
                'label' => __('Label-Stil', 'elementor-comment-form-extended'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label'     => __('Textfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-field label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'label_typography',
                'selector' => '{{WRAPPER}} .elementor-comment-form-field label',
            ]
        );

        $this->add_responsive_control(
            'label_spacing',
            [
                'label'      => __('Abstand zum Eingabefeld', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-field label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Button-Stil
        $this->start_controls_section(
            'section_button_style',
            [
                'label' => __('Button-Stil', 'elementor-comment-form-extended'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'      => __('Breite', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_margin',
            [
                'label'      => __('Aussenabstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => __('Innenabstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-comment-form-submit',
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __('Normal', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __('Textfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => __('Hintergrundfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .elementor-comment-form-submit',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label'      => __('Rahmenradius', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-comment-form-submit',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __('Hover', 'elementor-comment-form-extended'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => __('Textfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label'     => __('Hintergrundfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => __('Rahmenfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-comment-form-submit:hover',
            ]
        );

        $this->add_control(
            'button_hover_transition',
            [
                'label'     => __('Übergangszeit', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-submit' => 'transition: all {{SIZE}}s ease;',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        // Meldungen-Stil
        $this->start_controls_section(
            'section_messages_style',
            [
                'label' => __('Meldungen-Stil', 'elementor-comment-form-extended'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'success_message_color',
            [
                'label'     => __('Erfolgsfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-message.success' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'error_message_color',
            [
                'label'     => __('Fehlerfarbe', 'elementor-comment-form-extended'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-comment-form-message.error' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'messages_typography',
                'selector' => '{{WRAPPER}} .elementor-comment-form-message',
            ]
        );

        $this->add_responsive_control(
            'messages_spacing',
            [
                'label'      => __('Abstand', 'elementor-comment-form-extended'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-comment-form-message' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Widget rendern
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $post_id = get_the_ID();

        // Eindeutige ID für das Formular
        $form_id = 'elementor-comment-form-' . $this->get_id();

        // Nonce für die Kommentareinreichung erstellen
        $nonce = wp_create_nonce('comment_submission');

        // Formular-HTML ausgeben
        ?>
        <div class="elementor-comment-form-wrapper" id="<?php echo esc_attr($form_id); ?>">
            <?php if (!empty($settings['form_title'])) : ?>
                <h3 class="elementor-comment-form-title"><?php echo esc_html($settings['form_title']); ?></h3>
            <?php endif; ?>

            <form class="elementor-comment-form" data-post-id="<?php echo esc_attr($post_id); ?>">
                <div class="elementor-comment-form-message"></div>

                <input type="hidden" name="comment_post_ID" value="<?php echo esc_attr($post_id); ?>">
                <input type="hidden" name="comment_parent" value="0">
                <input type="hidden" name="comment_nonce" value="<?php echo esc_attr($nonce); ?>">

                <?php // Honeypot-Feld für Spam-Schutz
                if ('yes' === $settings['show_honeypot']) : ?>
                    <div class="elementor-comment-form-honeypot" style="display: none !important;">
                        <input type="text" name="url" value="">
                    </div>
                <?php endif; ?>

                <div class="elementor-comment-form-field elementor-comment-form-comment">
                    <label for="<?php echo esc_attr($form_id); ?>-comment"><?php echo esc_html($settings['comment_label']); ?></label>
                    <textarea id="<?php echo esc_attr($form_id); ?>-comment" name="comment_content" placeholder="<?php echo esc_attr($settings['comment_placeholder']); ?>" required></textarea>
                </div>

                <?php if ('yes' === $settings['show_author_field']) : ?>
                    <div class="elementor-comment-form-field elementor-comment-form-author">
                        <label for="<?php echo esc_attr($form_id); ?>-author"><?php echo esc_html($settings['author_label']); ?></label>
                        <input id="<?php echo esc_attr($form_id); ?>-author" name="comment_author" type="text" placeholder="<?php echo esc_attr($settings['author_placeholder']); ?>" required>
                    </div>
                <?php endif; ?>

                <?php if ('yes' === $settings['show_email_field']) : ?>
                    <div class="elementor-comment-form-field elementor-comment-form-email">
                        <label for="<?php echo esc_attr($form_id); ?>-email"><?php echo esc_html($settings['email_label']); ?></label>
                        <input id="<?php echo esc_attr($form_id); ?>-email" name="comment_author_email" type="email" placeholder="<?php echo esc_attr($settings['email_placeholder']); ?>" required>
                    </div>
                <?php endif; ?>

                <?php if ('yes' === $settings['show_url_field']) : ?>
                    <div class="elementor-comment-form-field elementor-comment-form-url">
                        <label for="<?php echo esc_attr($form_id); ?>-url"><?php echo esc_html($settings['url_label']); ?></label>
                        <input id="<?php echo esc_attr($form_id); ?>-url" name="comment_author_url" type="url" placeholder="<?php echo esc_attr($settings['url_placeholder']); ?>">
                    </div>
                <?php endif; ?>

                <?php if ('yes' === $settings['show_cookies_checkbox']) : ?>
                    <div class="elementor-comment-form-field elementor-comment-form-cookies">
                        <input id="<?php echo esc_attr($form_id); ?>-cookies" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                        <label for="<?php echo esc_attr($form_id); ?>-cookies"><?php echo esc_html($settings['cookies_text']); ?></label>
                    </div>
                <?php endif; ?>

                <div class="elementor-comment-form-field elementor-comment-form-submit-wrapper">
                    <button type="submit" class="elementor-comment-form-submit"><?php echo esc_html($settings['submit_button_text']); ?></button>
                </div>
            </form>
        </div>

        <script>
            (function($) {
                $(document).ready(function() {
                    const formId = '#<?php echo esc_js($form_id); ?>';
                    const form = $(formId + ' .elementor-comment-form');
                    const messageContainer = $(formId + ' .elementor-comment-form-message');

                    form.on('submit', function(e) {
                        e.preventDefault();
                        
                        // Formular-Daten sammeln
                        const formData = new FormData(this);
                        formData.append('action', 'submit_comment');

                        // Button-Status während der Übermittlung
                        const submitButton = $(this).find('.elementor-comment-form-submit');
                        const originalButtonText = submitButton.text();
                        submitButton.text('<?php echo esc_js(__('Wird gesendet...', 'elementor-comment-form-extended')); ?>');
                        submitButton.prop('disabled', true);

                        // AJAX-Anfrage senden
                        $.ajax({
                            url: '<?php echo esc_js(admin_url('admin-ajax.php')); ?>',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                // Button zurücksetzen
                                submitButton.text(originalButtonText);
                                submitButton.prop('disabled', false);

                                if (response.success) {
                                    // Erfolgsmeldung anzeigen
                                    messageContainer.removeClass('error').addClass('success');
                                    messageContainer.text('<?php echo esc_js($settings['success_message']); ?>');
                                    
                                    // Formular zurücksetzen
                                    form[0].reset();
                                } else {
                                    // Fehlermeldung anzeigen
                                    messageContainer.removeClass('success').addClass('error');
                                    messageContainer.text(response.data.message || '<?php echo esc_js($settings['error_message']); ?>');
                                }
                            },
                            error: function() {
                                // Button zurücksetzen
                                submitButton.text(originalButtonText);
                                submitButton.prop('disabled', false);
                                
                                // Fehlermeldung anzeigen
                                messageContainer.removeClass('success').addClass('error');
                                messageContainer.text('<?php echo esc_js($settings['error_message']); ?>');
                            }
                        });
                    });
                });
            })(jQuery);
        </script>
        <?php
    }

    /**
     * Widget-Inhalte für den Editor rendern
     */
    protected function content_template() {
        ?>
        <#
        var formId = 'elementor-comment-form-' + view.getID();
        #>
        <div class="elementor-comment-form-wrapper" id="{{ formId }}">
            <# if (settings.form_title) { #>
                <h3 class="elementor-comment-form-title">{{{ settings.form_title }}}</h3>
            <# } #>

            <form class="elementor-comment-form">
                <div class="elementor-comment-form-message"></div>

                <input type="hidden" name="comment_post_ID" value="">
                <input type="hidden" name="comment_parent" value="0">
                <input type="hidden" name="comment_nonce" value="">

                <# if (settings.show_honeypot === 'yes') { #>
                    <div class="elementor-comment-form-honeypot" style="display: none !important;">
                        <input type="text" name="url" value="">
                    </div>
                <# } #>

                <div class="elementor-comment-form-field elementor-comment-form-comment">
                    <label for="{{ formId }}-comment">{{{ settings.comment_label }}}</label>
                    <textarea id="{{ formId }}-comment" name="comment_content" placeholder="{{ settings.comment_placeholder }}"></textarea>
                </div>

                <# if (settings.show_author_field === 'yes') { #>
                    <div class="elementor-comment-form-field elementor-comment-form-author">
                        <label for="{{ formId }}-author">{{{ settings.author_label }}}</label>
                        <input id="{{ formId }}-author" name="comment_author" type="text" placeholder="{{ settings.author_placeholder }}">
                    </div>
                <# } #>

                <# if (settings.show_email_field === 'yes') { #>
                    <div class="elementor-comment-form-field elementor-comment-form-email">
                        <label for="{{ formId }}-email">{{{ settings.email_label }}}</label>
                        <input id="{{ formId }}-email" name="comment_author_email" type="email" placeholder="{{ settings.email_placeholder }}">
                    </div>
                <# } #>

                <# if (settings.show_url_field === 'yes') { #>
                    <div class="elementor-comment-form-field elementor-comment-form-url">
                        <label for="{{ formId }}-url">{{{ settings.url_label }}}</label>
                        <input id="{{ formId }}-url" name="comment_author_url" type="url" placeholder="{{ settings.url_placeholder }}">
                    </div>
                <# } #>

                <# if (settings.show_cookies_checkbox === 'yes') { #>
                    <div class="elementor-comment-form-field elementor-comment-form-cookies">
                        <input id="{{ formId }}-cookies" name="wp-comment-cookies-consent" type="checkbox" value="yes">
                        <label for="{{ formId }}-cookies">{{{ settings.cookies_text }}}</label>
                    </div>
                <# } #>

                <div class="elementor-comment-form-field elementor-comment-form-submit-wrapper">
                    <button type="submit" class="elementor-comment-form-submit">{{{ settings.submit_button_text }}}</button>
                </div>
            </form>
        </div>
        <?php
    }
}