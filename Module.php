<?php
/**
 * Poll custom module definition file
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */
namespace Socialveo\Poll;

use Phalcon\Loader as Loader,
    Phalcon\DiInterface as DiInterface,
    Phalcon\Mvc\ModuleDefinitionInterface as ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface {

    public function registerAutoloaders(DiInterface $di = null) {

        $path = $di->getShared('config')->modules->poll->path;
        $path = str_replace('Module.php', '', $path);
        
        $loader = new Loader();
        $loader->registerNamespaces(array(
            'Socialveo\Poll\Models'      => $path.'models/',
            'Socialveo\Poll\Controllers' => $path.'controllers/',
            'Socialveo\Poll\Plugins'     => $path.'plugins/',
        ));

        $loader->register();
    }

    public function registerServices(DiInterface $di = null) {}
}

// end
