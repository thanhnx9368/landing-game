"use strict";


(function ($) {
    /**
     * Plugin Tabs
     */
    $.fn.tabs = function () {
        var wrap = $(this);
        var head = wrap.find('[data-head]');
        var content = wrap.find('[data-content]');

        this.reset = (function () {
            head.not(head.first()).removeClass('is-active');
            content.not(content.first()).hide();
        }).call(this);

        this.headClick = head.not('.is-active').click(function (event) {
            event.preventDefault();
            let content_target = $(this).attr('href');

            head.removeClass('is-active');
            content.hide();

            $(this).addClass('is-active');
            $(content_target).fadeIn();
        });

        return this;
    };
})(jQuery); 

var wp_upload_image;

jQuery(document).ready(function ($) {
    /** 
     * Single Image Upload
     */
    jQuery.wp_upload_image = function wp_upload_image() {
        $('.upload-row').each(function(){
            var _upload = $(this);
            _upload.find('.upload-button').on('click', function (event) {
                var _this = $(this);
    
                var file_frame = wp.media.frames.file_frame = wp.media({
                    title: 'Select image',
                    library: {},
                    button: { text: 'Select' },
                    multiple: false
                });
    
                file_frame.on('select', function () {
                    var attachment = file_frame.state().get('selection').first().toJSON();
                    var _this_parent = _this.parents('.upload-row');
                    _this_parent.find('.upload-files-ids').val(attachment.id);
                    _this_parent.find('.upload-files-preview').html('<img src="' + attachment.url + '" />');
                });
    
                file_frame.open();
            });
        });
        // Remove image single
        $('.upload-row .js-btn-remove').click(function (event) {
            event.preventDefault();
            $(this).next().empty();
            $(this).siblings('.upload-files-ids').removeAttr('value');
        });
    };
    wp_upload_image = jQuery.wp_upload_image;
    wp_upload_image();

    /**
     * Upload file document
     */
    $('#document_upload_file').click(function(event) {
        var fileFrame = wp.media.frames.fileFrame = wp.media({
            title: 'Select file',
            button: {text: 'Select'},
            multiple: false
        });

        fileFrame.on( 'select', function() {
            file = fileFrame.state().get('selection').first().toJSON();
            $('#' + document_id).val(file.id);
            $('#document_file_name').text(file.filename + '(' + file.filesizeHumanReadable + ')');
        });

        fileFrame.open();
    });

    /**
     * Upload file
     */
    (function(){
        var file_wrap = $('.js-file-upload');

        if (file_wrap) {
    
            file_wrap.find('.js-btn-upload').click(function (event) {
                var fileFrame = wp.media({
                    title: 'Select file',
                    library: {type: 'application/pdf'},
                    button: {text: 'Select'},
                    multiple: false
                });
    
                fileFrame.on('select', function () {
                    var file = fileFrame.state().get('selection').first().toJSON();
                    file_wrap.find('.js-file-id').val(file.id);
                    file_wrap.find('.js-file-name').text(file.filename + ' (' + file.filesizeHumanReadable + ')');
                });
    
                fileFrame.open(); 
            });
    
            file_wrap.find('.js-btn-delete-file').click(function(){
                file_wrap.find('.js-file-name').html('No file selected');
                file_wrap.find('.js-file-id').val('');
            }); 
            
        }

    })();

    /**
     * Upload video
     */
    (function(){
        var file_wrap = $('.js-video-upload');

        if (file_wrap) {
    
            file_wrap.find('.js-btn-upload').click(function (event) {
                var fileFrame = wp.media({
                    title: 'Select file',
                    library: { type: 'video/mp4'},
                    button: {text: 'Select'},
                    multiple: false
                });
    
                fileFrame.on('select', function () {
                    console.log('ok');
                    var file = fileFrame.state().get('selection').first().toJSON();
                    file_wrap.find('.js-file-id').val(file.id);
                    file_wrap.find('.js-file-name').text(file.filename + ' (' + file.filesizeHumanReadable + ')');
                });
    
                fileFrame.open();
            });
    
            file_wrap.find('.js-btn-delete-file').click(function(){
                file_wrap.find('.js-file-name').html('No file selected');
                file_wrap.find('.js-file-id').val('');
            }); 
            
        }

    })();

    /**
     * Date Picker
     */
    $('.js-datepicker').datepicker({
        changeMonth: true,
        changeYear: true
    });
});