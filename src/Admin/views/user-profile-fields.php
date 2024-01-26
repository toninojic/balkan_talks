<!-- user-profile-fields.php -->

<h3><?php _e('Custom User Fields', 'balkan_talks'); ?></h3>

<table class="form-table">
    <tr>
        <th>
            <label for="user_profile_image"><?php _e('User Profile Image', 'balkan_talks'); ?></label>
        </th>
        <td>
            <input type="text" name="user_profile_image" id="user_profile_image" value="<?php echo esc_attr(get_user_meta($user->ID, 'user_profile_image', true)); ?>" class="regular-text" />
            <br />
            <span class="description"><?php _e('Enter the URL of the user profile image.', 'balkan_talks'); ?></span>
        </td>
    </tr>

    <tr>
        <th>
            <label for="user_role"><?php _e('User Role', 'balkan_talks'); ?></label>
        </th>
        <td>
            <select name="user_role" id="user_role">
                <option value="staff" <?php selected(get_user_meta($user->ID, 'user_role', true), 'staff'); ?>><?php _e('Staff', 'balkan_talks'); ?></option>
                <option value="contributors" <?php selected(get_user_meta($user->ID, 'user_role', true), 'contributors'); ?>><?php _e('Contributors', 'balkan_talks'); ?></option>
                <option value="main_staff" <?php selected(get_user_meta($user->ID, 'user_role', true), 'main_staff'); ?>><?php _e('Main Staff', 'balkan_talks'); ?></option>
                <option value="" <?php selected(get_user_meta($user->ID, 'user_role', true), ''); ?>><?php _e('Default', 'balkan_talks'); ?></option>
            </select>
            <br />
            <span class="description"><?php _e('Select the role of the user.', 'balkan_talks'); ?></span>
        </td>
    </tr>

</table>
