<?php

/**
 * Theme Name: holmesportfolio
 * Theme URI: https://holmesportfolio.co.uk/
 * Description: A theme designed with accessibility in mind
 * Author: David Holmes
 * Author URI: https://holmesportfolio.co.uk/
 * Requires PHP: 8
 * Tested up to: 6.5
 * Version: 5
 * License: holmesportfolio Commercial License
 * License URI: https://holmesportfolio.co.uk/hwlicense
 * Text Domain: holmesportfolio
 *
 * @package holmesportfolio
 */

// Prevent access to comments if password is required.
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
			$comment_count = get_comments_number();
			if ('1' === $comment_count) {
				// %s represents the number of comments.
				printf(
					esc_html__('1 Comment', 'holmesportfolio'),
					esc_html(number_format_i18n($comment_count))
				);
			} else {
				// %s represents the number of comments.
				printf(
					esc_html__('%s Comments', 'holmesportfolio'),
					esc_html(number_format_i18n($comment_count))
				);
			}
			?>
		</h2>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				)
			);
			?>
		</ol><!-- comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; ?>

	<?php if (comments_open()) : ?>
		<div id="respond" class="comment-respond">

			<?php

			global $comment_errors;
			if (! empty($comment_errors)) :
			?>
				<div class="comment-errors">
					<?php foreach ($comment_errors as $error) : ?>
						<p class="error-message"><?php echo esc_html($error); ?></p>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<?php
			comment_form(
				array(
					'class_form'           => 'comment-form',
					'comment_notes_before' => '<p class="comment-notes">' . esc_html__('Your email address will not be published.', 'holmesportfolio') . '</p>',
					'fields'               => array(
						'author' => '<p class="comment-form-author"><label for="author">' . esc_html__('Name', 'holmesportfolio') . '</label><br /><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" aria-required="true" /></p>',
						'email'  => '<p class="comment-form-email"><label for="email">' . esc_html__('Email', 'holmesportfolio') . '</label><br /><input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-required="true" /></p>',
						'url'    => '<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'holmesportfolio') . '</label><br /><input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>',
					),
					'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . esc_html__('Comment', 'holmesportfolio') . '</label><br /><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
					'comment_notes_after'  => '',
					'class_submit'         => 'submit btn btn-primary',
					'logged_in_as'         => '<p class="logged-in-as">' .
						sprintf(
							wp_kses(
								__('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'holmesportfolio'),
								array(
									'a' => array(
										'href'  => array(),
										'title' => array(),
									),
								)
							),
							admin_url('profile.php'),
							$user_identity,
							wp_logout_url(apply_filters('the_permalink', get_permalink()))
						) . '</p>',
					'must_log_in'          => '<p class="must-log-in">' .
						sprintf(
							wp_kses(
								__('You must be <a href="%s">logged in</a> to post a comment.', 'holmesportfolio'),
								array(
									'a' => array(
										'href' => array(),
									),
								)
							),
							wp_login_url(apply_filters('the_permalink', get_permalink()))
						) . '</p>',
				)
			);
			?>

		</div>
	<?php endif; ?>

</div><!-- comments -->