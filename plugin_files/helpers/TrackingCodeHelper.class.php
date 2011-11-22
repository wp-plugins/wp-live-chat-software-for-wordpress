<?php

require_once('LiveChatHelper.class.php');

class TrackingCodeHelper extends LiveChatHelper
{
	public function render()
	{
		if (LiveChat::get_instance()->is_installed())
		{
			$lang = LiveChat::get_instance()->get_lang();
			$skill = LiveChat::get_instance()->get_skill();
			$license_number = LiveChat::get_instance()->get_license_number();

			return <<<HTML
<script type="text/javascript">
  var __lc = {};
  __lc.license = {$license_number};
  __lc.lang = '{$lang}';
  __lc.skill = {$skill};

  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'labs.livechatinc.com/licence/{$license_number}/script.cgi';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
</script>
HTML;
		}

		return '';
	}
}