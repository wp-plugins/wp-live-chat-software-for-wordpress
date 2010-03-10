<?php
/*
Plugin Name: WP LIVECHAT Contact Center for WordPress
Plugin URI: http://www.livechatinc.com
Description: Description: Live chat software for live help, online sales and customer support. Plugin allows to quickly install the live chat button and monitoring code on any WordPress website.
Author: LIVECHAT Software
Version: 1.0.0
Author URI: http://www.livechatinc.com
*/

function sampleLIVECHAT($licenceNumber, $groups, $language) {
?>
<!-- BEGIN LIVECHAT button tag. See also www.livechatinc.com -->
<div style="text-align:center"><a id="LivechatButton" href="http://chat.livechatinc.net/licence/<?php echo $licenceNumber?>/open_chat.cgi?groups=<?php echo $groups?>&amp;lang=<?php echo $language?>" target="chat_<?php echo $licenceNumber?>" onclick="window.open('http://chat.livechatinc.net/licence/<?php echo $licenceNumber?>/open_chat.cgi?groups=<?php echo $groups?>'+'&amp;lang=<?php echo $language?>&amp;dc='+escape(document.cookie+';l='+document.location+';r='+document.referer+';s='+typeof lc_session),'Czat_<?php echo $licenceNumber?>','width=529,height=520,resizable=yes,scrollbars=no,status=1');return false;"></a><script type='text/javascript'>var img=new Image();img.style.border='0';img.src=(("https:" == document.location.protocol) ? "https://" : "http://")+'chat.livechatinc.net/licence/<?php echo $licenceNumber?>/button.cgi?lang=<?php echo $language?>&groups=<?php echo $groups?>'+'&d='+((new Date()).getTime());var _livechat_button=document.getElementById('LivechatButton');if(_livechat_button!=null){_livechat_button.appendChild(img);}</script><br><span style="font-family:Tahoma,sans-serif;font-size:10px;color:#333"><a href="http://www.livechatinc.com" style="font-size:10px;text-decoration:none" target="_blank">Live Chat</a> <span style="color: #475780">Software for Business</span></span></div>
<!-- END LIVECHAT button tag. See also www.livechatinc.com -->
<!-- BEGIN LIVECHAT track tag. See also www.livechatinc.com -->
<script type="text/javascript">
var livechat_params = '';
var livechat_host = (("https:" == document.location.protocol) ? "https://" : "http://");
livechat_params = ((livechat_params == '') ? '' : '&amp;params='+encodeURIComponent(livechat_params));
document.write(unescape("%3Cscript src='") + livechat_host + "chat.livechatinc.net/licence/<?php echo $licenceNumber?>/script.cgi?lang=<?php echo $language?>&amp;groups=<?php echo $groups?>" + livechat_params + unescape("' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- END LIVECHAT track tag. See also www.livechatinc.com -->
<?php
}

function widget_myLIVECHAT($args) {
    extract($args);

    $options = get_option("widget_myLIVECHAT");
    if (!is_array( $options )) {
	$options = array(
	    'licence_number' => '',
	    'language' => 'en',
	    'groups' => 0
	); 
    }      
    //Our Widget Content
    sampleLIVECHAT($options['licence_number'], $options['groups'], $options['language']);
}

function myLIVECHAT_control()  {
    $options = get_option("widget_myLIVECHAT");
    if (!is_array( $options )) {
	$options = array(
	    'licence_number' => '',
	    'language' => 'en',
	    'groups' => 0
	); 
    }    

    if ($options['groups'] == '')  { $options['groups'] = "0"; }
    if ($options['language'] == '') { $options['language'] = "en"; }
    if ($_POST['myLIVECHAT-Submit']) {
	$options['licence_number'] = htmlspecialchars($_POST['myLIVECHAT-licence_number']);
	$options['language'] = htmlspecialchars($_POST['myLIVECHAT-language']);
	$options['groups'] = htmlspecialchars($_POST['myLIVECHAT-groups']);
	update_option("widget_myLIVECHAT", $options);
    }

?>
    <p>
    <label for="myLIVECHAT-licence_number">Enter your licence number: </label><br />
    <input type="text" id="myLIVECHAT-licence_number" name="myLIVECHAT-licence_number" value="<?php echo $options['licence_number'];?>" />
    </p>
    <p>
    <label for="myLIVECHAT-language">Button language (default is EN): </label><br />
    <input type="text" id="myLIVECHAT-language" name="myLIVECHAT-language" value="<?php echo $options['language'];?>" />
    </p>
    <p>
    <label for="myLIVECHAT-groups">Groups (default is 0): </label><br />
    <input type="text" id="myLIVECHAT-groups" name="myLIVECHAT-groups" value="<?php echo $options['groups'];?>" />
    </p>
    <input type="hidden" id="myLIVECHAT-Submit" name="myLIVECHAT-Submit" value="1" />
  </p>
<?php
}

function myLIVECHAT_init() {
    wp_register_sidebar_widget( 'WIDGETID', 'LIVECHAT Contact Center', 'widget_myLIVECHAT', array('description' => __('Live chat software for live help, online sales and customer support. Plugin allows to quickly install the live chat button and monitoring code on any WordPress website.')) );
    wp_register_widget_control( 'WIDGETID', 'LIVECHAT Contact Center', 'myLIVECHAT_control');
}
add_action("plugins_loaded", "myLIVECHAT_init");
?>