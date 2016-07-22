<?php
//include Class File
require("foodora.class.php");

// Creates the instance
$foodora = new foodora();

// Truncate vendor_schedule Tabel
$TruncateTable = $foodora->DeleteDataFromTable('vendor_schedule');

//Revert Data
$ImportData = $foodora->ImportDataTable('vendor_schedule');

echo 'Data Reverted Successfully';
