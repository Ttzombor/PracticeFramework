<?php

namespace App\Mode;

class DevelopmentMode
{
    static string $memoryUsage = '';
    static float $phpExecutionTime = 0;

    static float $databaseExecutionTime = 0;

    static function start()
    {
        self::$phpExecutionTime = (microtime(true) * 1000);
    }

    static function results()
    {
        $memory = memory_get_peak_usage(true);

        $unit= array('b','kb','mb','gb','tb','pb');
        self::$memoryUsage = @round($memory/pow(1024,($i=floor(log($memory,1024)))),2).' '.$unit[$i];

        self::$phpExecutionTime = floor((microtime(true) * 1000  - self::$phpExecutionTime) * 1000);

        return "Peak Memory Usage: " . self::$memoryUsage . PHP_EOL . "PHP Execution Time: " . self::$phpExecutionTime . ' ms' . PHP_EOL;

    }
}