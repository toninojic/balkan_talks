<?php
namespace BalkanTalks\Shortcodes;

class UserProfiles
{
    public function __construct() {
        add_shortcode('user_profiles', [$this, 'displayUserProfiles']);
    }

    public function displayUserProfiles($atts) {
        $atts = shortcode_atts(array(
            'role' => 'staff',
        ), $atts, 'user_profiles');

        $mainStaffUsers = get_users(array(
            'meta_key' => 'user_role',
            'meta_value' => 'main_staff',
        ));

        $shortcodeRoleUsers = get_users(array(
            'meta_key' => 'user_role',
            'meta_value' => $atts['role'],
        ));

        $allUsers = array_merge($mainStaffUsers, $shortcodeRoleUsers);

        ob_start();
        ?>
        <div class="user-profiles-accordion">
            <?php foreach ($allUsers as $user) : ?>
                <?php get_template_part('global-templates/content', 'user', ['user' => $user]); ?>
            <?php endforeach; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
