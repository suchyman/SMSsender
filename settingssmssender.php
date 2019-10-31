<?php
function myplugin_register_settings() {
    add_option( 'raa_option_name', 'This is my option value.');
    register_setting( 'raaplugin_option_gr', 'raa_option_name', 'myplugin_callback' );
 }
 add_action( 'admin_init', 'myplugin_register_settings' );

 function myplugin_register_options_page() {
    add_options_page('Page Title', 'SMS Sender', 'manage_options', 'raa', 'raa_option_page');
  }
  add_action('admin_menu', 'myplugin_register_options_page');


  function raa_option_page()
{

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $odb = $_POST["tokensms"];
      update_option( 'tokensms', $odb );
    
    echo '<div class="notice notice-success is-dismissible">
        <p><strong>Settings saved.</strong></p>
    </div>';
    
    }
    
    $tokenSMS = get_option( 'tokensms' );
  //echo $tokenSMS . '<hr>';
  echo '<div class="wrap">';
echo '<h1>Options for SMS Sender.</h1>';
echo '<p>';
echo '
<form action="" method="POST">
<table>

<tr><td>Token SMS:</td><td><input type="password" name="tokensms" value="' . get_option('tokensms') . '"></td></tr>
<tr><td></td>
</tr><td><tr><td></td><td>
<input type="submit" class="btn btn-success" value="Save configuration" ></td></tr>
</form>
';
echo '</p>';
echo '</div>';

}

  
?>