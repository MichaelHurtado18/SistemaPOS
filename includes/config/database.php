<?php


function database()
{

    $db =  new mysqli('localhost', 'root', 'HURMAR1218presidente', 'pos');
    return $db;
}
