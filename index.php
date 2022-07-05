<?php
header("Content-Type: text/html; charset=utf-8");
include("config/config.php");
include(DIRREQ."lib/vendor/autoload.php");

$disPatch = new Classes\ClassDispatch();
include($disPatch->getInclusao());

// echo Traits\TraitsParseUrl::parseUrl();

// use Traits\TraitsParseUrl;

// class ClassTeste{
//     use TraitsParseUrl;
//     public function __construct()
//     {

//         var_dump($this->parseUrl(1));
//     }

// }

// $teste = new ClassTeste();