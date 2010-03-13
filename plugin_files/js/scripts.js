if (!$) $ = jQuery;
$(document).ready(function()
{
	var show_form = function()
	{
		if ($('#choice_account_0').is(':checked'))
		{
			$('#livechat_already_have').hide();
			$('#livechat_new_account').show();
		}
		else if ($('#choice_account_1').is(':checked'))
		{
			$('#livechat_new_account').hide();
			$('#livechat_already_have').show();
		}
	}

	show_form();
	$('#choice_account input').change(show_form);
});