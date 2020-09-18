<?php 

function fmt_format($number) {
    return number_format($number,0,'','.');
}


function fmtc_format($number, $curency = "ден.") {
    return number_format($number,2,',','.') . " " . $curency;
}
