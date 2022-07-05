<?php
namespace Traits;
trait TraitsParseUrl{
    #Cria um array com a url digitada pelo usuário
    public static function parseUrl($par=null)
    {
        $url = explode("/", rtrim($_GET['url'], FILTER_SANITIZE_URL));

        return ($par == null) ? $url: $url[$par];

        // if ($par == null) {
        //     return $url;
        // } else {
        //     return $url[$par];
        // }

    }

}