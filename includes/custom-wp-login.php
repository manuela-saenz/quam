<?php

function custom_login()
{
?>
  <link rel="stylesheet" href="<?= bloginfo('template_url') ?>/wp-login-styles.css" />
<?php
}
add_action('login_head', 'custom_login');

?>