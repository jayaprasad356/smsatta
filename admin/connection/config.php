<?php
ob_start();
session_start();

define("zone",  'Asia/Kolkata');    /** FIND YOUR TIMEZONE - https://www.php.net/manual/en/timezones.php */


define("SALT","Z~Zhy}~FVaJmY:oGmjQ8a/AEe7&F3|pco(vdHnM%9d`]50(Og^hUyoZ:$?maZ^m");    /** 504 bit SALT TO SECURE PASSWORD */

$stamp = time();

include "lib/lib.php";

