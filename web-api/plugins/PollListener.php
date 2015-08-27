<?php

/**
 * Poll Event Listener - plugin
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */

namespace Socialveo\Poll\Plugins;

use Phalcon\Events\Event as Event,
    Phalcon\Mvc\User\Plugin as Plugin;

class PollListener extends Plugin {

    public function beforeValidation($eventType, $model) {
        /**
         * Validation for Post of type Poll
         */
        if (get_class($model)=='Socialveo\Core\Models\Post' && $model->post_type == 'poll') {
            $request = $this->request->getJsonRawBody();
            if (!isset($request->poll->question, $request->poll->answers))
                throw new \Exception('A poll has to have a question and possible answers.');
        }
    }

    public function afterValidation($eventType, $model) {

        /**
         * Saving custom properties of Poll Post
         */
        if (get_class($model)=='Socialveo\Core\Models\Poll' && $model->post_type == 'poll') {
            $request = $this->request->getJsonRawBody();

            if (empty($model->properties))
                $model->properties = new \stdClass();

            $model->properties->poll->question = $request->poll->question;
            $model->properties->poll->answers  = $request->poll->answers;
        }
    }

    public function afterSave($eventType, $model) {

        /**
         * Recalculating poll results
         */
        if (get_class($model)=='Socialveo\Poll\Models\PollSubmission') {

            $post = \Socialveo\Core\Models\Post::retrieve($model->post_uuid);

            if (empty($post->properties->poll->results))
                $post->properties->poll->results = array();

            if (empty( $post->properties->poll->results[ $submission->value ] ))
                $post->properties->poll->results[ $submission->value ] = 0;

            $post->properties->poll->results[ $submission->value ]++;
            $post->save();
        }
    }
}

// end
