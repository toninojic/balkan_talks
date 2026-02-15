<?php

namespace BalkanTalks\Models;

class UserProfilesModel
{
    /**
     * @return array<int, \WP_User>
     */
    public function getUsersByRole(string $role = 'staff'): array
    {
        $role = sanitize_key($role);

        $mainStaffUsers = get_users([
            'meta_key' => 'user_role',
            'meta_value' => 'main_staff',
        ]);

        $shortcodeRoleUsers = get_users([
            'meta_key' => 'user_role',
            'meta_value' => $role,
        ]);

        return array_values($this->removeDuplicatesById(array_merge($mainStaffUsers, $shortcodeRoleUsers)));
    }

    /**
     * @param array<int, \WP_User> $users
     *
     * @return array<int, \WP_User>
     */
    private function removeDuplicatesById(array $users): array
    {
        $indexedUsers = [];

        foreach ($users as $user) {
            $indexedUsers[$user->ID] = $user;
        }

        return $indexedUsers;
    }
}
