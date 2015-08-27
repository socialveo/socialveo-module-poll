<?php

/**
 * Poll Submission Model
 *
 * @author      Socialveo.com Dev Team
 * @license     MIT License
 * @package     Poll
 * @since       1.0
 * @version     1.0
 */

namespace Socialveo\Poll\Models;

use Socialveo\Core\Models\SocialveoModel as SocialveoModel;

class PollSubmission extends SocialveoModel {

    public $id;
    public $uuid;
    public $user_id;
    public $user_uuid;
    public $post_id;
    public $post_uuid;
    public $value;
    public $created;
    public $updated;
    public $active;

    public function validation() {

        $this->validate(new \Phalcon\Mvc\Model\Validator\PresenceOf([
                'field'    => 'user_uuid'
            ])
        );

        $this->validate(new \Phalcon\Mvc\Model\Validator\PresenceOf([
                'field'    => 'post_uuid'
            ])
        );

        $this->validate(new \Phalcon\Mvc\Model\Validator\Regex([
            'field'     => 'value',
            'pattern' => '/^[0-9]+/',
            'message' => 'value has to be an integer'
        ]));

        if ($this->validationHasFailed() == true)
            return false;
    }

    public function initialize() {
        $this->belongsTo('user_id', 'Socialveo\Core\Models\User', 'id', array('alias' => 'User'));
        $this->belongsTo('post_id', 'Socialveo\Core\Models\Post', 'id', array('alias' => 'Post'));
        $this->keepSnapshots(true);
    }

    public function getSource() {
        $config = \Phalcon\DI::getDefault()->getShared('config');
        if (!empty($config->database->prefix))
            return $config->database->prefix.'poll_submissions';
        else
            return 'poll_submissions';
    }
}

// end
