<?php

namespace App\Helpers;

class Helper {
    
    public static function hello() 
    {
        return 'hello';
    }

    public static function secondTo($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        return $workingDuration = "$hours:$minutes:$seconds";
    }

}