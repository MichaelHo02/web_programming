<?php
function extract_email($s)
{
    preg_match("/[a-zA-Z0-9]+@[a-zA-Z0-9]+(\.[a-zA-Z0-9]+)*\.[a-zA-Z]{2,6}/", $s, $matches);
    return $matches;
}
