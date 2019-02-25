<?php
/**
 * Created by PhpStorm.
 * User: qjb
 * Date: 14/01/2019
 * Time: 15:58
 */
require_once ('conn.php');
session_start();

$blacklist = [];

if (($handle = fopen("D:\wamp64\www\IC-Eval\IC-Eval\docs\blacklist.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        array_push($blacklist, $data[0]);
    }
    fclose($handle);
}

file_put_contents("cache_file", serialize($blacklist));