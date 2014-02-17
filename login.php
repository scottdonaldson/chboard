<p class="aligncenter">You must log in to continue.</p>
<?php
wp_login_form(array(
		'label_remember' => __( 'Remember me' ),
		'label_log_in' => __( 'Sign In' ),
		'redirect' => site_url(),
	)
);
?>