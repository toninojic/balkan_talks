<?php

namespace BalkanTalks\Modals;

use BalkanTalks\Traits\SingletonTrait;

class UserMetaFields {

    use SingletonTrait;

    public function __construct() {
        add_action('show_user_profile', [$this, 'addProfileFields']);
        add_action('edit_user_profile', [$this, 'addProfileFields']);
        add_action('personal_options_update', [$this, 'saveProfileFields']);
        add_action('edit_user_profile_update', [$this, 'saveProfileFields']);
    }

    public function addProfileFields($user) {
        include_once get_template_directory() . '/src/Admin/views/user-profile-fields.php';
    }

    public function saveProfileFields($user_id) {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        update_user_meta($user_id, 'user_profile_image', sanitize_text_field($_POST['user_profile_image']));
        update_user_meta($user_id, 'user_role', sanitize_text_field($_POST['user_role']));
    }
}
