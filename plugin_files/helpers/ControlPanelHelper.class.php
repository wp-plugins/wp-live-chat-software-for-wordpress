<?php

require_once('LiveChatHelper.class.php');

class ControlPanelHelper extends LiveChatHelper
{
	public function render()
	{
		return <<<HTML
			<iframe id="control_panel" src="https://panel.livechatinc.com/" frameborder="0"></iframe>
			<p>Optionally, open the Control panel in an <a href="https://panel.livechatinc.com/" target="_blank">external window</a>.</p>
HTML;
	}
}