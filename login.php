<?php
if ( isset($GLOBALS['chboard_error']) ) { ?>
	<p class="aligncenter red"><strong><?= $GLOBALS['chboard_error']; ?></strong></p>
<?php } ?>

<?php if (!chboard_logged_in()) { ?>
<p class="aligncenter">You must log in to continue.</p>

<form name="loginform" id="loginform" action="<?php the_permalink(); ?>?action=login" method="post">
			
	<p class="login-username">
		<label for="username">Username</label>
		<input type="text" name="username" id="username" class="input" value="" size="20" required>
	</p>
	<p class="login-password">
		<label for="password">Password</label>
		<input type="password" name="password" id="password" class="input" value="" size="20" required>
	</p>
	
	<p class="login-submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button-primary" value="Sign In">
		<input type="hidden" name="redirect_to" value="<?= home_url(); ?>">
	</p>
	
</form>

<?php
// logged in but does not have permission to view
} else if (chboard_logged_in() && !chboard_has_permission()) { ?>
	<p class="aligncenter red"><strong>You do not have permission to view this page.</strong></p>
	<p class="aligncenter"><strong><a href="<?= home_url(); ?>">Back to main page &raquo;</a></strong></p>
<?php } ?>