<?php declare(strict_types=1);
/**
 * DuckPhp
 * From this time, you never be alone~
 */
namespace DuckPhp\Helper;

use DuckPhp\Core\App;
use DuckPhp\Helper\HelperTrait;

class BusinessHelper
{
    use HelperTrait;
    
    public static function Setting($key)
    {
        return App::Setting($key);
    }
    public static function Config($key, $file_basename = 'config')
    {
        return App::Config($key, $file_basename);
    }
    public static function LoadConfig($file_basename)
    {
        return App::LoadConfig($file_basename);
    }
    public static function Cache($object = null)
    {
        return App::Cache($object);
    }
    public static function XCall($callback, ...$args)
    {
        return App::XCall($callback, ...$args);
    }
    public static function Event()
    {
        return App::Event();
    }
    public static function FireEvent($event, ...$args)
    {
        return App::FireEvent($event, ...$args);
    }
    public static function OnEvent($event, $callback)
    {
        return App::OnEvent($event, $callback);
    }
}
