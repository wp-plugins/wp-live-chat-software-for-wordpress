<?php

require_once('LiveChatHelper.class.php');

class TrackingCodeInfoHelper extends LiveChatHelper
{
	public function render()
	{
		if (LiveChat::get_instance()->is_installed())
		{
			return '<div class="updated installed_ok"><p>Tracking code installed properly.</p></div>';
		}

		return '';
	}
}