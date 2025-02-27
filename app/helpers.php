<?php

function getFullMonthName($shortMonth) {
    $monthNames = [
        'Jan' => 'January', 'Feb' => 'February', 'Mar' => 'March', 'Apr' => 'April',
        'May' => 'May', 'Jun' => 'June', 'Jul' => 'July', 'Aug' => 'August',
        'Sep' => 'September', 'Oct' => 'October', 'Nov' => 'November', 'Dec' => 'December'
    ];
    return $monthNames[$shortMonth];
}
