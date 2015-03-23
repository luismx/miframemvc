<?php
$config_file = 'config.ini';

$options = parse_ini_file($config_file, True);
foreach($options as $section=>$config) {
    if($section != 'PLUGINS') {
        foreach($config as $constant=>$value) {
            define($constant, $value);
            if($section == 'TEMPLATE') $GLOBALS['DICT'][$constant] = $value;
        }
    }
}

if(!PRODUCTION) {
    ini_set('error_reporting', E_ALL | E_NOTICE | E_STRICT);
    ini_set('display_errors', '1');
    ini_set('track_errors', 'On');
} else {
    ini_set('display_errors', '0');
}

function import($str='', $exit=False) {
    $file = str_replace('.', '/', $str);
    if(file_exists(APP_DIR . "$file.php")) {
        require_once "$file.php";
    } else {
        if($exit) exit("FATAL ERROR: no se pudo importar '$str'");
    }
}
?>