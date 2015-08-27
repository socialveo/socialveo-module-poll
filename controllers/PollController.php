<?php

/**
 * Poll Controller
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */
namespace Socialveo\Poll\Controllers;

use Socialveo\Core\Controllers\SocialveoController as SocialveoController;

class PollController extends SocialveoController {
    
    public function submissionAction()
    {
        $payload = $this->request->getJsonRawBody();
        $submission = \Socialveo\Poll\Models\PollSubmission::createObject( $payload );
        return $this->respondWithItem($submission);
    }

}
