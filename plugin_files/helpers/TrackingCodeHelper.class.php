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

		  (function() {
		    var lc_params = '';
		    var lc_lang = '{$lang}';
		    var lc_skill = '{$skill}';

		    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
		    var lc_src = ('https:' == document.location.protocol ? 'https://' : 'http://');
		        lc_src += 'chat.livechatinc.net/licence/{$license_number}/script.cgi?lang='+lc_lang+unescape('%26')+'groups='+lc_skill;
		        lc_src += ((lc_params == '') ? '' : unescape('%26')+'params='+encodeURIComponent(encodeURIComponent(lc_params))); lc.src = lc_src;
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
		  })();

		</script>
HTML;
		}

		return '';
	}
}