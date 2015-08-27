<?php

/**
 * Socialveo Poll custom module routes
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */

$pollRouteGroup = new \Phalcon\Mvc\Router\Group(array('module' => 'poll', 'controller' => 'Poll', 'namespace'=>'Socialveo\Poll\Controllers'));
$pollRouteGroup->addPost('/v1/post/([a-z0-9-]{36})/submissions', array('action' => 'submission',	'post_uuid'	=> 1  ));
$router->groups['poll'] = $pollRouteGroup;
$router->mount($pollRouteGroup);
