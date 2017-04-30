<div class="login-form-container">
    <?php if ($attributes['show_title']) : ?>
      <!-- Show errors if there are any -->
        <?php _e('Sign In', 'personalize-login'); ?>
    <?php endif; ?>
    <?php if (get_query_var('status') == 'success') {
      echo '<br>Password successfully changed. Take your new password for a spin by logging back in!<br>';
    }?>
    <?php if (count($attributes['errors']) > 0) : ?>
        <?php foreach ($attributes['errors'] as $error) : ?>
            <p class="login-error">
                <?php echo $error; ?>
            </p>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if ( $attributes['registered'] ) : ?>
    <p class="login-info">
        <?php
            printf(
                __( 'You have successfully registered to <strong>%s</strong>.', 'personalize-login' ),
                get_bloginfo( 'name' )
            );
        ?>
    </p>
<?php endif; ?>
    <!-- Show logged out message if user just logged out -->
<?php if ( $attributes['logged_out'] ) : ?>
    <p class="login-info">
        <?php _e( 'You have signed out. Would you like to sign in again?', 'personalize-login' ); ?>
    </p>
<?php endif; ?>
    <?php
        wp_login_form(
            array(
                'label_username' => __('Username', 'personalize-login'),
                'label_log_in' => __('Sign In', 'personalize-login'),
                'redirect' => $attributes['redirect'],
            )
        );
    ?>

    <a class="forgot-password" href="<?php echo wp_lostpassword_url(); ?>">
        <?php _e('Forgot your password?', 'personalize-login'); ?>
    </a>
    <br>
    <a class="registration-redirect" href="<?php echo home_url('registration') ?>">
        <?php _e('Or register a new account', 'personalize-login'); ?>
    </a>
</div>
