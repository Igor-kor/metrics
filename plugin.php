<?php

/**
 * Created by PhpStorm.
 * User: игорь
 * Date: 17.06.2018
 * Time: 16:47
 */
class plugin
{
    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $version = "0.1";

    /**
     * Unique identifier for your plugin.
     *
     * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
     * match the Text Domain file header in the main plugin file.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $plugin_slug = "metrics";

    /**
     * Instance of this class.
     *
     * @since 1.0.0
     *
     * @var object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since 1.0.0
     *
     * @var string
     */
    protected $plugin_screen_hook_suffix = null;

    protected $option_name = "metrics_option_name";

    function __construct()
    {
        $this->add_hooks();
    }

    //добавление хуков
    function add_hooks()
    {
        $this->add_action('wp_footer', 'footer');
        $this->add_action('admin_menu', 'settings_add_plugin_page');
        $this->add_action('admin_init', 'settings_page_init');
    }

    function footer()
    {
        $this->options = get_option($this->option_name);
        echo $this->options['_1'];
    }

    //чтоб постоянно не писать в массиве
    private function add_action($action, $function)
    {
        add_action($action, array($this, $function));
    }

    // доюавление пункта в настройках
    function settings_add_plugin_page()
    {
        add_options_page(
            'metrics plugin', // page_title
            'metrics plugin', // menu_title
            'manage_options', // capability
            'metrics', // menu_slug
            array($this, 'settings_create_admin_page') // function
        );
    }

    //создание страницы с настройками
    function settings_create_admin_page()
    {
        $this->options = get_option('metrics_option_name');
        ?>
        <div class="wrap">
            <h2>metrics plugin settings</h2>
            <p>Настройки плагина</p>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
                <?php
                settings_fields('metrics_option_group');
                do_settings_sections('metrics-admin');
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    // добаление полей в настройки
    public function settings_page_init()
    {
        register_setting(
            'metrics_option_group', // option_group
            'metrics_option_name', // option_name
            array($this, 'metrics_sanitize') // sanitize_callback
        );

        add_settings_section(
            'metrics_setting_section', // id
            'Settings', // title
            array($this, 'metrics_section_info'), // callback
            'metrics-admin' // page
        );

        add_settings_field(
            '', // id
            'В футере', // title
            array($this, '_1_callback'), // callback
            'metrics-admin', // page
            'metrics_setting_section' // section
        );
    }

    // вывод формы с заданными полями для проверки
    public function _1_callback()
    {
        $this->options = get_option('metrics_option_name');
        printf(
            '<textarea name="%s[_1]" id="_1" >%s</textarea>',
            $this->option_name,
            isset($this->options['_1']) ? $this->options['_1'] : ''
        );
    }

    // проверка сохранения полей настроек
    public function metrics_sanitize($input)
    {
        $sanitary_values = array();
        if (isset($input['_1'])) {
            $sanitary_values['_1'] = $input['_1'];
        }

        return $sanitary_values;
    }

    public function metrics_section_info()
    {

    }

}