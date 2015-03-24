<?php
require_once 'config.php';

    import('core.Controller');
    import('core.Model');
    import('core.View');
    import('core.Request');
    import('core.Autoload');
    import('core.Session');
    import('core.Database');
    
    try {
        Session::init();
        $miReq = new Request();
        Autoload::run($miReq);
        
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }



    //$init = Session::init();
    
#    $miReq = new Request();
 #   Autoload::run($miReq);




?>