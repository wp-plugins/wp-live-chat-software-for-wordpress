<?php

require_once('LiveChatHelper.class.php');

class ChatButtonHelper extends LiveChatHelper
{
	public function render()
	{
		$url = LiveChat::get_instance()->get_plugin_url();

		$time = time();
		$license = LiveChat::get_instance()->get_license_number();
		$lang = LiveChat::get_instance()->get_lang();
		$skill = LiveChat::get_instance()->get_skill();

		$code = <<<CODE
<div id="LiveChat_{$time}"><a href="http://www.livechatinc.com/?partner=lc_{$license}">live chat software</a></div>

<script type="text/javascript">
  var __lc_buttons = __lc_buttons || [];
  __lc_buttons.push({
    elementId: 'LiveChat_{$time}',
    language: '{$lang}',
    skill: '{$skill}'
  });
</script>
CODE;

		return <<<HTML
	<p>Your theme <strong>does not</strong> support Widgets <a class="help" href="http://codex.wordpress.org/Widgetizing_Themes">(read more)</a>. Thus, you can't easily drag &amp; drop the Widget in your Wordpress admin page.</p>
	<hr class="livechat">
	<p>To install "click-to-chat" button you need to put the following code <strong>in a visible place of your website</strong>:</p>
	<textarea id="chat_button_code" cols="80" rows="12" readonly="readonly" onclick="this.select()">{$code}</textarea>

	<p><a href="#button_placement" class="toggle">What is the best place for my button?</a></p>
	<div id="button_placement" style="display:none">
		<p class="img"><img src="{$url}/images/button_placement.png" alt="" /></p>
	</div>

	<p class="back"><a href="?page=livechat_settings">&laquo; go back to Settings</a></p>
HTML;
	}
}