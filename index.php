<?php
require_once 'config.php';

    import('core.Controller');
    import('core.Model');
    import('core.View');
    import('core.Request');
    import('core.Autoload');
    import('core.Session');
    import('core.Database');
    

        Session::init();
        Autoload::run(new Request);
    

?>