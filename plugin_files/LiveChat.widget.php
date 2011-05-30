<?php

/**
 * LiveChat "click-to-chat" button widget
 */

class LiveChatWidget extends WP_Widget
{
	private static $my_id_base = 'livechat_widget';

	static public function get_id_base()
	{
		return self::$my_id_base;
	}

	function LiveChatWidget()
	{
		$this->WP_Widget('livechat_widget', 'LiveChat', array(
			'classname' => 'LiveChatWidget',
			'description' => 'Install "click-to-chat" button to let your visitors start a chat with you.'
		), array(
			'id_base' => self::$my_id_base
		));
	}

	function form($instance)
	{
		if (LiveChat::get_instance()->is_installed())
		{
			echo <<<HTML
			<p><strong>Everything is all right!</strong></p>
			<p>To configure LiveChat, go to <a href="admin.php?page=livechat_settings">Settings</a>.</p>
HTML;
		}
		else
		{
			echo <<<HTML
			<p>Your live chat button <strong>is not working yet</strong>.</p>
			<p>You need to <a href="admin.php?page=livechat_settings">set up your LiveChat account</a> first.</p>
HTML;
		}
	}

	function widget($args, $instance)
	{
		// Do not try to display click-to-chat button
		// if LiveChat plugin is not configured properly
		if (LiveChat::get_instance()->is_installed() == false) return;

		$url = LiveChat::get_instance()->get_plugin_url();

		$time = time();
		$license = LiveChat::get_instance()->get_license_number();
		$lang = LiveChat::get_instance()->get_lang();
		$skill = LiveChat::get_instance()->get_skill();

		echo <<<CODE
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
	}
}