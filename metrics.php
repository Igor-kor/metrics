<?php
/**
 * Plugin Name: Metrics
 * Plugin URI: http://github.com/
 * Description: подключение метрики
 * Version: 0.1
 * Author: Шарангия Игорь
 * Author URI: http://vk.com/id117766113
 */

// Для того, чтобы этот файл не могли подключить вне WordPress
if (!defined("WPINC")) {
    die;
}

// Подключаем класс плагина
require_once(plugin_dir_path(__FILE__) . "plugin.php");

// Получаем сущность плагина, паттерн Singleton
new plugin(__FILE__);