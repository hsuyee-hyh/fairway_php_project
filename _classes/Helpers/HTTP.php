<?php

namespace Helpers;

class HTTP{

    static $base = "http://localhost/project";

    static function redirect($page, $q="" ){
        echo "HTTP redirect <br>";

        
        $url = static::$base . $page;
        if ($q) $url.="?$q";

        header("location: $url");
        exit();
    }
}

// http://localhost/project/index.php/http=test