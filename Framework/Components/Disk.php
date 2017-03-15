<?php

define('RAW_OUTPUT', false);

class Disk
{
    public static  $diskPath;

    public static function setPath($path)
    {
        self::$diskPath = $path;
    }

    public static function totalSpace($rawOutput = false)
    {
        $diskTotalSpace = @disk_total_space(self::$diskPath);

        if ($diskTotalSpace === FALSE)
            throw new Exception('totalSpace(): Invalid disk path.');

        return $rawOutput ? $diskTotalSpace : self::addUnits($diskTotalSpace);
    }

    public static function freeSpace($rawOutput = false)
    {
        $diskFreeSpace = @disk_free_space(self::$diskPath);

        if($diskFreeSpace === FALSE)
          throw new Exception('freeSpace(): Invalid disk path.');

        return $rawOutput ? $diskFreeSpace : self::addUnits($diskFreeSpace);
    }

    public static function usedSpace($precision = 1)
    {
        try
        {
            return round((100 - (self::freeSpace(RAW_OUTPUT) / self::totalSpace(RAW_OUTPUT)) * 100), $precision);
        }
        catch(Exception $e)
        {
            throw $e;
        }
    }

    public static function getDiskPath()
    {
        return self::$diskPath;
    }

    private static function addUnits($size)
    {
        $i = 0;
        $iec = ['o', 'Ko', 'Mo', 'Go', 'To'];
        while(($size / 1024) > 1)
        {
            $size = $size / 1024;
            $i++;
        }
        return(round($size, 2).' '.$iec[$i]);
    }
}
?>
