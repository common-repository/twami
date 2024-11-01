<?php
class twami {
   
	function __construct() {
      add_action( 'admin_menu', array( &$this, 'twami_id_settings' ));
      
      add_action( 'wp_head', array( &$this, 'inject_twami_code'));
      
      wp_enqueue_style( 'twami-styles', TWAMI_URL .'css/default.css', '', '1.0' );
   }
   
   public function twami_id_settings()
   {
      add_options_page( __('Twami', 'twami'), 'Twami', 'manage_options', 'twami.php', array( &$this, 'display_twami_id_setup' ) );
   }
   
   public function display_twami_id_setup()
   {
      ?>
      <div class="wrap">
         <!-- TODO: Plugin icon -->
         <div id="icon-twami" class="icon32"></div>
         
         <h2><?php echo __('Twami', 'twami'); ?></h2>
         <?php
            if(isset($_POST['twami_id']))
            {
               if ( !(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE) && wp_verify_nonce( $_POST['twami_nonce'], plugin_basename( __FILE__ ) ) && current_user_can( 'manage_options')) 
               {
                  if(preg_match('/^[0-9]+$/', trim($_POST['twami_id'])))
                  {
                     if(update_option( 'twami_id',  trim($_POST['twami_id'])))
                     {
                        ?>
                        <div class="updated fade">
                           <p><?php echo __('Your ID from Twami has been updated', 'twami'); ?></p>
                        </div>
                        <?php
                     }
                  } else
                  {
                     ?>
                     <div class="error fade">
                        <p><?php echo __('You have not entered a valid Twami ID. Only numbers are valid.', 'twami'); ?></p>
                     </div>
                     <?php
                  }
               } else
               {
                  
               }
            }
         ?>
         <form method="post" action="">
            <label><?php echo __('Insert your ID from Twami (ie. 1451)', 'twami'); ?>:</label>
            <input type="text" name="twami_id" value="<?php echo get_option( 'twami_id' ); ?>" />
            
            <input type="submit" value="<?php echo __('Save'); ?>" class="button-primary" />
            
            <?php
            wp_nonce_field( plugin_basename( __FILE__ ), 'twami_nonce' );
            ?>
         </form>
      </div>
      <?php
   }
   
   public function inject_twami_code()
   {
      ?>
      <script id="twamiScript" type="text/javascript">
         (function () {
             var twamiScriptTag = document.createElement('script');
             twamiScriptTag.type = 'text/javascript';
             twamiScriptTag.src = ('http://twami.com/javascript/<?php echo get_option( 'twami_id' ); ?>.js');
             var s = document.getElementById('twamiScript');
             s.parentNode.insertBefore(twamiScriptTag, s);
         })();
      </script> 
      <?php
   }
}

new twami();
?>