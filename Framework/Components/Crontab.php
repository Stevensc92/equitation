<?php

class Crontab
{

    public
    $crontab = '/usr/bin/crontab',
    $destination = '/tmp/CronManager',
    $minute = 0,
    $hour = 10,
    $dayOfMonth = '*',
    $month = '*',
    $dayOfWeek = '*',
    $jobs = array();

    function Crontab() {
    }

    function onMinute($minute) {
        $this->minute = $minute;
        return $this;
    }

    function onHour($hour) {
        $this->hour = $hour;
        return $this;
    }

    function onDayOfMonth($dayOfMonth) {
        $this->dayOfMonth = $dayOfMonth;
        return $this;
    }

    function onMonth($month) {
        $this->month = $month;
        return $this;
    }

    function onDayOfWeek($dayOfWeek) {
        $this->dayOfWeek = $dayOfWeek;
        return $this;
    }

    function on($timeCode) {
        list(
            $this->minute,
            $this->hour,
            $this->dayOfMonth,
            $this->month,
            $this->dayOfWeek
        ) = explode(' ', $timeCode);

        return $this;
    }

    function doJob($job) {
        $this->jobs[] = $this->minute.' '.
                        $this->hour.' '.
                        $this->dayOfMonth.' '.
                        $this->month.' '.
                        $this->dayOfWeek.' '.
                        $job;

        return $this;
    }

    function activate($includeOldJobs = true) {
        $contents  = implode("\n", $this->jobs);
        $contents .= "\n";

        $contents .= $this->listJobs();

        if(is_writable($this->destination) || !file_exists($this->destination)){
            exec($this->crontab.' -r;');
            file_put_contents($this->destination, $contents, LOCK_EX);
            exec($this->crontab.' '.$this->destination.';');
            return true;
        }

        return false;
    }

    function listJobs() {
        return exec($this->crontab.' -l;');
    }
}

?>