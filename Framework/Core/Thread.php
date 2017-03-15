<?php

class Thread
{
    public static function process($command, $priority = 0)
    {
        if($priority)
            $pid = shell_exec('nohup nice -n '.$priority.' '.$command.' 2> /dev/null & echo $!');
        else
            $pid = shell_exec('nohup '.$command.' 2> /dev/null & echo $!');
    }

    public static function isRunning($pid)
    {
        exec('ps '.$pid, $status);
        return count($status) >= 2;
    }
}

?>