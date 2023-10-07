<?php

const CALENDAR_TABLE_ROW = 48;
const MINUTES_INTERVAL = 30;
const UTC_OFFSET = -3600 * 9;

if (!function_exists('setCalendarTimes')) {
    function setCalendarTimes()
    {
        $times = [];
        for ($i = 0; $i < CALENDAR_TABLE_ROW; $i++) {
            $time = strtotime("+" . $i * MINUTES_INTERVAL . "minute", UTC_OFFSET);
            $times[] = date("H:i", $time);
        };
        return $times;
    }
}
