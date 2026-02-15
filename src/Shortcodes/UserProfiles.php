<?php

namespace BalkanTalks\Shortcodes;

use BalkanTalks\Models\UserProfilesModel;
use BalkanTalks\Views\TemplateRenderer;

class UserProfiles
{
    private UserProfilesModel $userProfilesModel;

    private TemplateRenderer $templateRenderer;

    public function __construct() {
        $this->userProfilesModel = new UserProfilesModel();
        $this->templateRenderer = new TemplateRenderer();

        add_shortcode('user_profiles', [$this, 'displayUserProfiles']);
    }

    /**
     * @param array<string, mixed> $atts
     */
    public function displayUserProfiles($atts): string {
        $atts = shortcode_atts([
            'role' => 'staff',
        ], $atts, 'user_profiles');

        $users = $this->userProfilesModel->getUsersByRole((string) $atts['role']);

        $content = '<div class="user-profiles-accordion">';

        foreach ($users as $user) {
            $content .= $this->templateRenderer->renderTemplatePart('global-templates/content', 'user', ['user' => $user]);
        }

        $content .= '</div>';

        return $content;
    }
}
