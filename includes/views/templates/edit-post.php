<form id="submit-post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">

    <?php
      $post = get_post(get_query_var('agg_post_id'));
      $postUrl = get_post_meta($post->ID, 'aggregator_entry_url', true);
          ?>
    <p class="form-row">
        <label for="post-title"><?php _e( 'Post Title', 'submit-post' ); ?></label>
        <input type="text" name="post-title" id="post-title" class="post-input" value="<?php echo $post->post_title; ?>" required>
    </p>

    <p class="form-row">
        <label for="url"><?php _e( 'URL', 'submit-post' ); ?></label>
        <input type="url" name="post-url" id="post-url" class="post-input" value="<?php echo $postUrl ?>" required>
    </p>
    <p class="form-row">
        <label for="dropdown"><?php _e( 'Post Type', 'post-type' ); ?></label>
        <select name="post-type" id="post-type" class="post-input" required>
          <?php $customterms =  get_terms( array(
                  'taxonomy' => 'aggpost-type',
                  'hide_empty' => false,
                    )
                  );
                  // var_dump($customterms);
              $postTerm = wp_get_post_terms( $post->ID, 'aggpost-type', array('count' => 1, 'fields' => 'names') );
            foreach ( $customterms as $term) {
                if (trim($postTerm[0]) == $term->{'name'} ) { $selected = ' selected ';} else { $selected = '';}
               echo "<option" . $selected . ">" . $term->{'name'} . "</option>";
            };
            ?>
        </select>
    </p>
    <?php wp_nonce_field( 'submit_aggregator_post' ); ?>

    <p class="signup-submit">
        <input type="submit" name="submit" class="edit-post-button"
               value="<?php _e( 'Edit', 'edit-post' ); ?>"/>
    </p>
    <input type="hidden" name="post-id" value="<?php echo get_query_var('agg_post_id')?>">
    <input type="hidden" name="action" value="edit_post">
</form>
