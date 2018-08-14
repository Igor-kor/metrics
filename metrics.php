<?php
/**
 * Plugin Name: Metrics
 * Plugin URI: https://github.com/Igor-kor/metrics
 * Description: подключение метрики
 * Version: 0.1.1
 * Author: Игорь Шарангия
 * Author URI: http://vk.com/id117766113
 * GitHub Plugin URI: https://github.com/Igor-kor/metrics
 */

// Для того, чтобы этот файл не могли подключить вне WordPress
if (!defined("WPINC")) {
    die;
}

// Подключаем класс плагина
require_once(plugin_dir_path(__FILE__) . "plugin.php");

// Получаем сущность плагина, паттерн Singleton
new plugin(__FILE__);