<?php
/**
 * Created by PhpStorm.
 * User: pbuw
 * Date: 22.11.18
 * Time: 17:51
 */

class alert
{
    public static function boersencrash($name, $currentPrice)
    {
        echo "<div class='item'> <div class='alert alert-danger' role='alert'><b>Börsencrash</b><br><h1>$currentPrice Fr.</h1> $name</div></div>";
    }

    public static function warning($name, $currentPrice)
    {
        echo "<div class='item'> <div class=' alert alert-warning' role='alert'><b>Warning</b><br><h1>$currentPrice Fr.</h1> $name</div></div>";
    }

    public static function success($name, $currentPrice)
    {
        echo "<div class='item'><div class=' alert alert-success' role='alert'><h1>$currentPrice Fr.</h1> $name</div></div>";
    }

    public static function normal($name, $currentPrice)
    {
        echo "<div class='item'></h1><h1>$currentPrice Fr.</h1> $name</div></div>";
    }

    public static function error($errortext)
    {
        echo "<div class='alert alert-danger' role='alert'>$errortext</div>";
    }
}