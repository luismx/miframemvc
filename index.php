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
<<<<<<< HEAD
    
=======
        
    } catch (Exception $exc) {
        echo $exc->getMessage();
        echo "Hey";
    }
>>>>>>> 2f480d80a04c7399f830041da0fa711f1f9a4091

?>