(function ($) {
    $(document).ready(function () {
        if(typeof ju_base !="undefined" && typeof ju_content_url !="undefined"){
            if (typeof token !="undefined" && token != '') {

            }else{
                $('#update-plugins-table tr input[type="checkbox"][name="checked[]"]').each(function(){
                    var ju_plugin_file = $(this).val();
                    var slug = ju_plugin_file.substr(ju_plugin_file.indexOf('/') + 1,ju_plugin_file.indexOf('.') - ju_plugin_file.indexOf('/'));
                    if(ju_plugin_file.indexOf("wp-media-folder") != '-1' || ju_plugin_file.indexOf("wp-file-download") != '-1' || ju_plugin_file.indexOf("wp-team-display") != '-1' || ju_plugin_file.indexOf("wp-latest-post") != '-1'){
                        var link = ju_base+"index.php?option=com_juupdater&view=login&tmpl=component&site="+ju_content_url+"&TB_iframe=true&width=300&height=305";
                        $(this).closest('tr').find('td').append('<p>Please <a class="thickbox ju_update" href="'+ link +'">login</a> use your account on JoomUnited.com to update the plugin</p>');
                    }
                });
            }
        }

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
                        'token': res.token
                    },
                    success: function (response) {
                        window.location.assign(document.URL);
    //                    window.location.assign(res.linkdownload);
                    }
                });
            }
        }, false);
    });
}(jQuery));