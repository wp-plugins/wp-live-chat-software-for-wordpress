$(document).ready(function()
{
	var validate = function(use_alert)
	{
		if ($('#livechat_account_first_name').val().length < 1)
		{
			if (use_alert) alert ('Please enter your first name.');
			return false;
		}

		if ($('#livechat_account_first_name').val().length < 1)
		{
			if (use_alert) alert ('Please enter your last name.');
			return false;
		}

		if (/^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,6}$/i.test($('#livechat_account_email').val()) == false)
		{
			if (use_alert) alert ('Please enter a valid email address.');
			return false;
		}

		return true;
	}

	$('#livechat_new_account form').submit(function()
	{
		if (validate(true))
		{
			$('#ajax_message').removeClass('message').addClass('wait').html('Please wait&hellip;');

			var create_licence = function()
			{
				$('#ajax_message').removeClass('message').addClass('wait').html('Creating new licence&hellip;');

				var url = 'http://www.livechatinc.com/en/signup/';
				url += '?account_first_name='+$('#livechat_account_first_name').val();
				url += '&account_last_name='+$('#livechat_account_last_name').val();
				url += '&account_email='+$('#livechat_account_email').val();
				url += '&action=wordpress_signup';
				url += '&recaptcha_ip='+$('input[name=recaptcha_ip]').val();
				url += '&recaptcha_challenge_field='+$('input[name=recaptcha_challenge_field]').val();
				url += '&recaptcha_response_field='+$('input[name=recaptcha_response_field]').val();
				url += '&jsoncallback=?';

				$.getJSON(url,
				function(data)
				{
					data = parseInt(data.response);
					if (data == '-1')
					{
						// Wrong captcha
						$('#ajax_message').html('Confirmation code is incorrect. Please try again.').addClass('message').removeClass('wait');
						return false;
					}
					if (data == '0')
					{
						$('#ajax_message').html('Could not create licence. Please try again later.').addClass('message').removeClass('wait');
						return false;
					}

					// Save new licence number
					$('#livechat_license_number').val(data);
					$('#livechat_license_created_flag').val('1');
					$('#livechat_already_have form')
						.unbind('submit')
						.submit();
				});
			}

			// Check if email address is available
			$.getJSON('http://www.livechatinc.com/php/licence_info.php?email='+$('#livechat_new_account form input[name=livechat_account_email]').val()+'&jsoncallback=?',
			function(data)
			{
				data = parseInt(data.response);
				if (data == 1)
				{
					create_licence();
				}
				else if (data == 2)
				{
					$('#ajax_message').removeClass('wait').addClass('message').html('This email address is already in use. Please choose another e-mail address.');
				}
				else
				{
					$('#ajax_message').removeClass('wait').addClass('message').html('Could not create licence. Please try again later.');
				}
			});
		}
		return false;
	});
});