# Making A Custom Plugin

Notes for creating your very own plugin.

## Getting Started:
1. Inside `htdocs/wp-content/plugins/` create your plugin directory. Remember the name. 
2. In that directory create a .php file with the same name as the directory.
    - `plugins/<plugin-name>/<plugin-name>.php`
3. Minimum requirement for a plugin is a *Plugin Header*:
    ```
    <?php 
        /*
         *   Plugin Name: YOUR PLUGIN NAME
         */
    ?>
    ```
4. To prevent anyone from accessing your plugin from the browser, create an `index.php` and add the following line.
    ```
    <?php
    // Silence is golden

    ```

## Validating Access:
Three ways to ensure that plugin access happens over WordPress. We'll be checking whether function or constants defined by WordPress exists. If they do not exist, then the file was not accessed through WordPress.
```
// 1
if ( !defined('ABSPATH') ){
    die;
}

// 2
defined( 'ABSPATH' ) or die( 'Hey, you cant be here' );

// 3
if ( !function_exists( 'add_action' ) ){
    die();
}

```

