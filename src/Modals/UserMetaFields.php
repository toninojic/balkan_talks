<?php

namespace BalkanTalks\Modals;

use BalkanTalks\Traits\SingletonTrait;
use BalkanTalks\Views\TemplateRenderer;

class UserMetaFields {

    use SingletonTrait;

    private TemplateRenderer $templateRenderer;

    public function __construct() {
        $this->templateRenderer = new TemplateRenderer();

        add_action('show_user_profile', [$this, 'addProfileFields']);
        add_action('edit_user_profile', [$this, 'addProfileFields']);
        add_action('personal_options_update', [$this, 'saveProfileFields']);
        add_action('edit_user_profile_update', [$this, 'saveProfileFields']);
    }

    public function addProfileFields($user): void {
        $this->templateRenderer->renderPhpView(
            get_template_directory() . '/src/Admin/views/user-profile-fields.php',
            ['user' => $user]
        );
    }

    public function saveProfileFields($user_id): void {
        if (!current_user_can('edit_user', $user_id)) {
            return;
        }

        update_user_meta($user_id, 'user_profile_image', sanitize_text_field($_POST['user_profile_image'] ?? ''));
        update_user_meta($user_id, 'user_role', sanitize_text_field($_POST['user_role'] ?? ''));
    }
}
