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
		var license = '{$license_number}',
				params = '',
				lang = '{$lang}',
				skill = '{$skill}';

		__lc_load = function (p) { if (typeof __lc_loaded != 'function')
			if (p) { var d = document, l = d.createElement('script'), s =
 d.getElementsByTagName('script')[0], a = unescape('%26'),
				h = ('https:' == d.location.protocol ? 'https://' : 'http://'); l.type = 'text/javascript'; l.async = true;
				l.src = h + 'gis' + p +'.livechatinc.com/gis.cgi?serverType=control'+a+'licenseID='+license+a+'jsonp=__lc_load';
				if (typeof p['server'] == 'string' && typeof __lc_serv != 'string') {
					l.src = h + (__lc_serv = p['server']) + '/licence/'+license+'/script.cgi?lang='+lang+a+'groups='+skill;
					l.src += (params == '') ? '' : a+'params='+encodeURIComponent(encodeURIComponent(params)); s.parentNode.insertBefore(l, s);
				} else setTimeout(__lc_load, 1000); typeof __lc_serv != 'string' && s.parentNode.insertBefore(l, s);
			} else __lc_load(Math.ceil(Math.random()*5)); }
		__lc_load();
	})();
</script>
HTML;
		}

		return '';
	}
}