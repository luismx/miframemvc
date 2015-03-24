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
        $miReq = new Request();
        Autoload::run($miReq);
        Session::init();
        
    } catch (Exception $exc) {
        throw new Exception("No existe el controlador", 1);
    }

?>