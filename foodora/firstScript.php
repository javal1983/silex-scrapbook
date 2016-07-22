<?php

//include Class File
require("foodora.class.php");

// Creates the instance
$foodora = new foodora();

// Export Dump from the vendor Tabel
$DumpTable = $foodora->ExportDataTable('vendor_schedule');

// Get All Data of Special Days form Table
$SpeicalDayData = $foodora->GetAllDataTable('vendor_special_day');


$SpeicalDayFlagArray = array();
if (!empty($SpeicalDayData)) {
    foreach ($SpeicalDayData as $SpeicalDay) {
        extract($SpeicalDay);
        $weekDay = date('N', strtotime($special_date));
        if (!array_key_exists($vendor_id . '-' . $weekDay, $SpeicalDayFlagArray)) {
            $whereCondition = "vendor_id = $vendor_id AND weekday = $weekDay";
            $DeleteRows = $foodora->DeleteDataFromTable('vendor_schedule', $whereCondition);
        }
        $SpeicalDayFlagArray[$vendor_id . '-' . $weekDay] = 1;
        if ($event_type == 'opened') {
            $sql = "INSERT INTO vendor_schedule (vendor_id, weekday, all_day, start_hour, stop_hour) VALUES ($vendor_id, $weekDay, $all_day, '$start_hour', '$stop_hour')";
            $InsertRow = $foodora->ExecuteQuery($sql);
        }
    }
}

echo count($SpeicalDayData) . " - Rows Updated Successfully";
