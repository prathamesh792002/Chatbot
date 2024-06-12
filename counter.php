<?php
$file = 'counter.txt';
$todayFile = 'today_counter.txt';

if (!file_exists($file)) {
    file_put_contents($file, "0");
}

if (!file_exists($todayFile)) {
    file_put_contents($todayFile, "0|" . date("Y-m-d"));
}

// Read total visitors
$total = (int)file_get_contents($file);

// Read today's visitors
list($today, $date) = explode('|', file_get_contents($todayFile));

// Update total visitors
$total++;

// Update today's visitors if the date matches
if ($date === date("Y-m-d")) {
    $today++;
} else {
    $today = 1;
    $date = date("Y-m-d");
}

// Save updated counts
file_put_contents($file, $total);
file_put_contents($todayFile, "$today|$date");

echo json_encode(['total' => $total, 'today' => $today]);
?>
