/**
 * Elementor Comment Form Extended Frontend JavaScript
 */
(function($) {
    'use strict';

    var ElementorCommentForm = {
        /**
         * Initialisierung
         */
        init: function() {
            this.bindEvents();
        },

        /**
         * Event-Listener registrieren
         */
        bindEvents: function() {
            $(document).on('submit', '.elementor-comment-form', this.handleFormSubmit);
            $(document).on('input', '.elementor-comment-form-field input, .elementor-comment-form-field textarea', this.validateField);
        },

        /**
         * Formular-Einreichung verarbeiten
         * 
         * @param {Event} e Event-Objekt
         */
        handleFormSubmit: function(e) {
            e.preventDefault();
            
            var $form = $(this);
            var $messageContainer = $form.find('.elementor-comment-form-message');
            var $submitButton = $form.find('.elementor-comment-form-submit');
            var originalButtonText = $submitButton.text();
            
            // Validierung durchführen
            var isValid = ElementorCommentForm.validateForm($form);
            
            if (!isValid) {
                return;
            }
            
            // Button-Status während der Übermittlung
            $submitButton.text(ElementorCommentFormVars.i18n.sending);
            $submitButton.prop('disabled', true);
            
            // Formular-Daten sammeln
            var formData = new FormData($form[0]);
            formData.append('action', 'submit_comment');
            
            // AJAX-Anfrage senden
            $.ajax({
                url: ElementorCommentFormVars.ajaxurl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Button zurücksetzen
                    $submitButton.text(originalButtonText);
                    $submitButton.prop('disabled', false);
                    
                    if (response.success) {
                        // Erfolgsmeldung anzeigen
                        $messageContainer.removeClass('error').addClass('success');
                        $messageContainer.text(response.data.message || ElementorCommentFormVars.i18n.success);
                        
                        // Formular zurücksetzen
                        $form[0].reset();
                    } else {
                        // Fehlermeldung anzeigen
                        $messageContainer.removeClass('success').addClass('error');
                        $messageContainer.text(response.data.message || ElementorCommentFormVars.i18n.error);
                    }
                },
                error: function() {
                    // Button zurücksetzen
                    $submitButton.text(originalButtonText);
                    $submitButton.prop('disabled', false);
                    
                    // Fehlermeldung anzeigen
                    $messageContainer.removeClass('success').addClass('error');
                    $messageContainer.text(ElementorCommentFormVars.i18n.error);
                }
            });
        },

        /**
         * Formular validieren
         * 
         * @param {jQuery} $form Formular-Element
         * @return {boolean} Gültigkeit
         */
        validateForm: function($form) {
            var isValid = true;
            
            // Alle erforderlichen Felder überprüfen
            $form.find('input[required], textarea[required]').each(function() {
                if (!ElementorCommentForm.validateField({ target: this })) {
                    isValid = false;
                }
            });
            
            return isValid;
        },

        /**
         * Einzelnes Feld validieren
         * 
         * @param {Event} e Event-Objekt
         * @return {boolean} Gültigkeit
         */
        validateField: function(e) {
            var $field = $(e.target);
            var $fieldWrapper = $field.closest('.elementor-comment-form-field');
            var $errorMessage = $fieldWrapper.find('.elementor-comment-form-error');
            var value = $field.val();
            var isValid = true;
            var errorMessage = '';
            
            // Fehlermeldung erstellen, falls nicht vorhanden
            if ($errorMessage.length === 0) {
                $errorMessage = $('<div class="elementor-comment-form-error"></div>');
                $fieldWrapper.append($errorMessage);
            }
            
            // Erforderlich
            if ($field.prop('required') && value.trim() === '') {
                isValid = false;
                errorMessage = ElementorCommentFormVars.i18n.required;
            }
            
            // E-Mail
            if (isValid && $field.attr('type') === 'email' && value !== '') {
                var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!emailPattern.test(value)) {
                    isValid = false;
                    errorMessage = ElementorCommentFormVars.i18n.email;
                }
            }
            
            // URL
            if (isValid && $field.attr('type') === 'url' && value !== '') {
                var urlPattern = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/;
                if (!urlPattern.test(value)) {
                    isValid = false;
                    errorMessage = ElementorCommentFormVars.i18n.url;
                }
            }
            
            // Fehlermeldung anzeigen/verstecken
            if (isValid) {
                $errorMessage.hide();
                $fieldWrapper.removeClass('elementor-error');
            } else {
                $errorMessage.text(errorMessage).show();
                $fieldWrapper.addClass('elementor-error');
            }
            
            return isValid;
        }
    };

    // Initialisierung bei Document-Ready
    $(document).ready(function() {
        ElementorCommentForm.init();
    });

})(jQuery);
