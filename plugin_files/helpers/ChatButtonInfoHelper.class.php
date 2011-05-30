<?php

require_once('LiveChatHelper.class.php');

class ChatButtonInfoHelper extends LiveChatHelper
{
	public function render()
	{
		if (LiveChat::get_instance()->is_installed())
		{
			if (is_active_widget (false, false, LiveChatWidget::get_id_base()))
			{
				return '<div class="updated info installed_ok"><p>"Click-to-chat" button installed properly. <span class="help">(<a href="widgets.php">manage widgets</a>)</span></p></div>';
			}
			else
			{
				// Check if theme supports Widgets
				if (LiveChat::get_instance()->widgets_enabled())
				{
					return '<div class="updated info"><p>To install your "click-to-chat" button, go to <a href="widgets.php">Widgets</a> page.</p></div>';
				}
				else
				{
					return '<div class="updated info"><p>To install your "click-to-chat" button, <a href="?page=livechat_settings&amp;chat_button=1">click here</a>.</p></div>';
				}
			}
		}

		return '';
	}
}