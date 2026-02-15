<?php

namespace BalkanTalks;

use BalkanTalks\Controllers\CustomHooks;
use BalkanTalks\Controllers\Enqueue;
use BalkanTalks\Controllers\LoadMore;
use BalkanTalks\Controllers\Redirections;
use BalkanTalks\Controllers\ThemeSupportController;
use BalkanTalks\Modals\UserMetaFields;
use BalkanTalks\Shortcodes\PostsLoop;
use BalkanTalks\Shortcodes\UserProfiles;

class MainLoader
{
    public function __construct() {
        $this->init();
    }

    public function init(): void {
        $this->registerShortcodes();
        $this->registerControllers();
    }

    private function registerShortcodes(): void
    {
        new UserProfiles();
        new PostsLoop();
    }

    private function registerControllers(): void
    {
        ThemeSupportController::getInstance();
        Enqueue::getInstance();
        CustomHooks::getInstance();
        Redirections::getInstance();
        UserMetaFields::getInstance();
        LoadMore::getInstance();
    }
}
