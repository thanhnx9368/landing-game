(function ($) {
    ju_update = function (plugin, slug) {
        var $message, name;
        if ('plugins' === pagenow || 'plugins-network' === pagenow) {
            $message = $('[data-slug="' + slug + '"]').next().find('.update-message');
        } else if ('plugin-install' === pagenow) {
            $message = $('.plugin-card-' + slug).find('.update-now');
            name = $message.data('name');
            $message.attr('aria-label', wp.updates.l10n.updatingLabel.replace('%s', name));
        }

        $message.addClass('updating-message');
        if ($message.html() !== wp.updates.l10n.updating) {
            $message.data('originaltext', $message.html());
        }

        $message.text(wp.updates.l10n.updating);
        wp.a11y.speak(wp.updates.l10n.updatingMsg);

        if (wp.updates.updateLock) {
            wp.updates.updateQueue.push({
                type: 'update-plugin',
                data: {
                    plugin: plugin,
                    slug: slug
                }
            });
            return;
        }

        wp.updates.updateLock = true;

        var data = {
            _ajax_nonce: wp.updates.ajaxNonce,
            plugin: plugin,
            slug: slug,
            username: wp.updates.filesystemCredentials.ftp.username,
            password: wp.updates.filesystemCredentials.ftp.password,
            hostname: wp.updates.filesystemCredentials.ftp.hostname,
            connection_type: wp.updates.filesystemCredentials.ftp.connectionType,
            public_key: wp.updates.filesystemCredentials.ssh.publicKey,
            private_key: wp.updates.filesystemCredentials.ssh.privateKey
        };
        
        wp.ajax.post('update-plugin', data)
                .done(wp.updates.updateSuccess)
                .fail(wp.updates.updateError);
    }

    JuupdatePlugin = function (plugin, slug) {
        if (slug == 'wp-media-folder' || slug == 'wp-file-download' || slug == 'wp-team-display' || slug == 'wp-latest-post' || slug == 'wp-table-manager' || slug == 'wp-frontpage-news-pro-addon') {
            if (token && token != '') {
                $('#'+ slug +'-update .update-message').append('<a style="margin-left:10px;color: #a00;" class="ju_check">Checking token...</a>');
                
                if(slug == 'wp-frontpage-news-pro-addon'){
                    var link = ju_base + 'index.php?option=com_juupdater&task=download.checktoken&extension=wp-latest-posts-addon.zip&token=' + token;
                }else{
                    var link = ju_base + 'index.php?option=com_juupdater&task=download.checktoken&extension=' + slug + '.zip&token=' + token;
                }
                $.ajax({
                    url: link,
                    method: 'GET',
                    dataType: 'json',
                    data: {
                    },
                    success: function (response) {
                        $('#'+ slug +'-update .update-message .ju_check').remove();
                        if (response.status == true) {
                            ju_update(plugin, slug);
                            //window.location.assign(response.linkdownload);
                        } else {
                            var r = confirm(response.datas);
                            if (r == true) {
                                window.open(ju_base,"_blank");
                            }
                        }
                    }
                });
            } else {
                $('tr[data-slug="' + slug + '"] .thickbox.ju_update').click();
            }
        } else {
            ju_update(plugin, slug);
        }
    };

    $(document).ready(function () {
        var ju_plugins = ['wp-media-folder','wp-file-download','wp-team-display','wp-latest-post','wp-table-manager','wp-frontpage-news-pro-addon'];
        $.each(ju_plugins,function(i,slug){
            if(!token || token == ''){
                $('#'+ slug +'-update .update-message a.update-link').addClass('ju-update-link').removeClass('update-link').html('Connect your Joomunited account to update');
            }else{
                $('#'+ slug +'-update .update-message a.update-link').addClass('ju-update-link').removeClass('update-link');
            }
            $('#'+ slug +'-update td.plugin-update').css({'border-left':'4px solid #d54e21','background-color':'#fef7f1'});
        });

        var eventMethod = window.addEventListener ? "addEventListener" : "attachEvent";
        var eventer = window[eventMethod];
        var messageEvent = eventMethod == "attachEvent" ? "onmessage" : "message";

        // Listen to message from child window
        eventer(messageEvent, function (e) {

            var res = e.data;
            if(typeof res != "undefined" && typeof res.type != "undefined" && res.type == "joomunited_login"){
                $.ajax({
                    url: ajaxurl,
                    type: 'POST',
                    data: {
                        'action': 'ju_add_token',
                        'token': res.token,
                    },
                    success: function (response) {
                        window.location.assign(document.URL);
    //                    window.location.assign(res.linkdownload);
                    }
                });
            }
        }, false);

        $('.plugin-update-tr').on('click', '.ju-update-link', function (e) {
            e.preventDefault();
            if (wp.updates.shouldRequestFilesystemCredentials && !wp.updates.updateLock) {
                wp.updates.requestFilesystemCredentials(e);
            }
            var updateRow = $(e.target).parents('.plugin-update-tr');
            // Return the user to the input box of the plugin's table row after closing the modal.
            wp.updates.$elToReturnFocusToFromCredentialsModal = $('#' + updateRow.data('slug')).find('.check-column input');
            JuupdatePlugin(updateRow.data('plugin'), updateRow.data('slug'));
        });
        
        $(document).on('click','.ju-btn-disconnect',function(){
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    'action': 'ju_logout',
                },
                success: function (response) {
                    window.location.assign(document.URL);
                }
            });
        });

    });
}(jQuery));