<?php

spl_autoload_register(function ($name) {
    $analyseName = explode('\\',$name);
    include_once($name.".php");
});