<?php

function _livechat_chat_button_code ($license_number, $lang, $groups, $use_ssl = false)
{
?>

<!-- BEGIN LIVECHAT button tag. See also www.livechatinc.com -->
<div style="text-align:center"><a id="LivechatButton" href="http<?php echo $use_ssl ? 's' : ''; ?>://chat.livechatinc.net/licence/<?php echo $license_number; ?>/open_chat.cgi?groups=<?php echo $groups; ?>&amp;lang=<?php echo $lang; ?>" target="chat_<?php echo $license_number; ?>" onclick="window.open('http<?php echo $use_ssl ? 's' : ''; ?>://chat.livechatinc.net/licence/<?php echo $license_number; ?>/open_chat.cgi?groups=<?php echo $groups; ?>'+'&amp;lang=<?php echo $lang; ?>&amp;dc='+escape(document.cookie+';l='+document.location+';r='+document.referer+';s='+typeof lc_session),'Czat_<?php echo $license_number; ?>','width=529,height=520,resizable=yes,scrollbars=no,status=1');return false;"></a><script type='text/javascript'>var img=new Image();img.style.border='0';img.src=(("https:" == document.location.protocol) ? "https://" : "http://")+'chat.livechatinc.net/licence/<?php echo $license_number; ?>/button.cgi?lang=<?php echo $lang; ?>&groups=<?php echo $groups; ?>'+'&d='+((new Date()).getTime());var _livechat_button=document.getElementById('LivechatButton');if(_livechat_button!=null){_livechat_button.appendChild(img);}</script><br><span style="font-family:Tahoma,sans-serif;font-size:10px;color:#333"><a href="http://www.livechatinc.com" style="font-size:10px;text-decoration:none" target="_blank">Live Chat</a> <span style="color: #475780">Software for Business</span></span></div>
<!-- END LIVECHAT button tag. See also www.livechatinc.com -->

<?php
}

function _livechat_chat_button_code_control ($license_number, $lang, $groups, $use_ssl = false)
{
	if (strlen(get_option('livechat_license_number') > 0)):
?>
<p>Your live chat button is installed properly!</p>
<hr class="livechat">
<p>License number: <strong><?php echo $license_number; ?></strong><br>
Language: <strong><?php echo $lang; ?></strong><br>
Groups: <strong><?php echo $groups; ?></strong></p>
<hr class="livechat">
<p>To change these settings, go to <a href="?page=_livechat_settings">Live chat plugin settings page</a>.</p>
<?php else: ?>
<p>Your live chat button <strong>is not working yet</strong>.</p>
<p>You need to <a href="?page=_livechat_settings">set up your live chat account</a> first.</p>
<?php endif; ?>
<?php
}