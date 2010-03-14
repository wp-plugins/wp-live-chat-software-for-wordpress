<?php

function _livechat_monitoring_code($license_number, $lang, $groups, $params)
{
	if (LIVECHAT_LICENSE_INSTALLED == false) return;
?>

<!-- BEGIN LIVECHAT track tag. See also www.livechatinc.com -->
<script type="text/javascript">
var livechat_params = '<?php echo $params; ?>';
var livechat_host = (("https:" == document.location.protocol) ? "https://" : "http://");
livechat_params = ((livechat_params == '') ? '' : '&amp;params='+encodeURIComponent(livechat_params));
document.write(unescape("%3Cscript src='") + livechat_host + "chat.livechatinc.net/licence/<?php echo $license_number; ?>/script.cgi?lang=<?php echo $lang; ?>&amp;groups=<?php echo $groups; ?>" + livechat_params + unescape("' type='text/javascript'%3E%3C/script%3E"));
</script>
<!-- END LIVECHAT track tag. See also www.livechatinc.com -->

<?php
}