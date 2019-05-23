# Metabox Builder
### Version 0.1.0

## List metadata types
- Checkbox
- Color picker
- Date picker
- Editor 
- Input
- Radio 
- Selectbox
- Textarea 
- Upload document
- Upload Images
- Upload Video
- Insert Youtube link

## Includes Javascript
- jQuery
- jQuery UI

## Initialization

```php 
    include_once (get_template_directory().'/wp-metaboxs-builder/init.php');
```

## Usage

```php
    add_action('admin_init', 'post_type_add_metabox');
    function post_type_add_metabox() {

        function display_metabox() {

            echo '<input type="hidden" name="nonce" value="' . wp_create_nonce('post_type_save_metabox') . '">';

            $post_type_metabox = array (
                array (
                    'label' => 'Title 1',
                    'value' => 'ABC',
                    'type'  => 'input'
                ),
                array (
                    'label' => 'Title 2',
                    'value' => 'XYZ',
                    'type'  => 'upload-image-single'
                )
            );

            /**
            *  Metabox Print
            *  @param array $post_type_metabox
            */

            metaboxPrint( $post_type_metabox );

        }

        add_meta_box( 
            'display_metabox', 'Title Metabox', 'display_metabox', 'post_type', 'normal', 'high' 
        );
    }
```

## Create by
* **Huy Truong** - [huytv35@gmail.com](mailto:huytv35@gmail.com)