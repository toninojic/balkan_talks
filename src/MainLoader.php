<?php

namespace BalkanTalks;

use BalkanTalks\Controllers\LoadMore;
use BalkanTalks\Controllers\ThemeSupportController;
use BalkanTalks\Controllers\Enqueue;
use BalkanTalks\Controllers\CustomHooks;
use BalkanTalks\Controllers\Redirections;
use BalkanTalks\Modals\UserMetaFields;
use BalkanTalks\Shortcodes\PostsLoop;
use BalkanTalks\Shortcodes\UserProfiles;

class MainLoader
{
    public function __construct() {
        $this->init();
    }

    public function init() {
        new UserProfiles();
        new PostsLoop();

        ThemeSupportController::getInstance();
        Enqueue::getInstance();
        CustomHooks::getInstance();
        Redirections::getInstance();
        UserMetaFields::getInstance();
        LoadMore::getInstance();
    }
}
