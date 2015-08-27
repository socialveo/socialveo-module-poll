<?php

/**
 * Socialveo Poll permissions
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */

return new \Phalcon\Config([

    'Poll' => [
        'submission' =>	['owner', 'network_public_or_protected', 'user_connected_to_network'],
    ],
    
]);
