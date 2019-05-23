<?php

/**
 * Data List
 */
function metabox_builder_data_list($item) {
    $name = $item['name'];
    $label = $item['label'];
    $value = $item['value'];
    ?>

    <style>
        .location-item {
            position: relative;
            margin: 15px 20px;
            padding: 15px 20px;
            display: flex;
            flex-wrap: wrap;
            background-color: gray;
        }

        .location-item > * {
            box-sizing: border-box;
        }

        .location-img {
            display: block;
            position: relative;
            width: 100px;
            height: 100px;
        }

        .location-text  {
            position: relative;
            width: calc(100% - 180px);
            padding-left: 30px;
        }

        .location-item-delete {
            display: block;
            width: 80px;
            background-color: red;
        }

        .location-img a { 
            display: block;
            position: absolute;
            right: 10px;
            bottom: 10px;
            width: 20px;
            padding: 2px 7px;
            background-color: rgba(white, 0.2);
        }

        .location-title,
        .location-length {
            display: block;
            width: 100%;
            margin-bottom: 15px; 
        }

        .location-add-new {
            display: block;
            margin: 20px;
            text-align: center;
            background-color: blue;
            color: #fff;
            padding: 20px;
            font-size: 20px;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="col m10 offset-m1">
                <form id="js-submit" action="">
                    <div class="data-list-wrap">

                        <div class="data-item" id="data-item-first">
                            <div class="location-item">
                                <div class="location-img" data-status>
                                    <div class="upload-row">
                                        <button type="button" class="button upload-button"><?php _e('Select photo', TEXT_DOMAIN); ?></button>
                                        <ul class="tu-meta-box-photo-list">
                                            <li>
                                                <span class="js-btn-remove remove album_images-remove dashicons dashicons-no-alt" title"remove"=""></span>
                                                <div class="upload-files-preview"></div>
                                                <input type="hidden" class="upload-files-ids" name="" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="location-text">
                                    <input class="location-title" name="dataItem[0][title]" />
                                    <input class="location-length" name="dataItem[0][length]" />
                                </div>
                                <a href="#" class="location-item-delete">Delete</a>
                            </div>
                        </div>

                        <a href="#" class="js-add location-add-new">Add</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function($){
            $('.js-add').click(function(){
                var html = $('#data-item-first').html();
                $('.data-list-wrap').append(html);
                
                wp_upload_image();
            });
        });
    </script>

    <?php
}