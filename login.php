<?php
if (isset($error)) { ?>
	<p class="aligncenter"><strong><?= $error; ?>1234</strong></p>
<?php } ?>

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