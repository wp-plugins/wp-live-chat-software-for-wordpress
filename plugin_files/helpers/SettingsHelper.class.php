<?php

require_once('LiveChatHelper.class.php');

class SettingsHelper extends LiveChatHelper
{
	public function render()
	{
?>
		<div id="livechat">
		<div class="wrap">

		<div id="lc_logo">
			<img src="<?php echo LiveChat::get_instance()->get_plugin_url(); ?>/images/logo.png" />
			<span>for Wordpress</span>
		</div>
		<div class="clear"></div> 

		<?php
		if (isset($_GET['chat_button']))
		{
			LiveChat::get_instance()->get_helper('ChatButton');
		}
		else
		{
			LiveChat::get_instance()->get_helper('ChangesSaved');
			LiveChat::get_instance()->get_helper('TrackingCodeInfo');
			LiveChat::get_instance()->get_helper('ChatButtonInfo');
?>
		
		<?php if (LiveChat::get_instance()->is_installed() == false) { ?>
		<div class="metabox-holder">
			<div class="postbox">
				<h3>Do you already have a LiveChat account?</h3>
				<div class="postbox_content">
				<ul id="choice_account">
				<li><input type="radio" name="choice_account" id="choice_account_1" checked="checked"> <label for="choice_account_1">Yes, I already have a LiveChat account</label></li>
				<li><input type="radio" name="choice_account" id="choice_account_0"> <label for="choice_account_0">No, I want to create one</label></li>
				</ul>
				</div>
			</div>
		</div>
		<?php } ?>

		<!-- Already have an account -->
		<div class="metabox-holder" id="livechat_already_have" style="display:none">

			<?php if (LiveChat::get_instance()->is_installed()): ?>
			<div class="postbox">
			<h3><?php echo _e('Download application'); ?></h3>
			<div class="postbox_content">
			<p><?php echo _e('Download LiveChat for your desktop/mobile and start chatting with your customers!'); ?></p>
			<p class="btn"><a href="http://www.livechatinc.com/download/" target="_blank"><?php _e('Download application'); ?></a></p>
			</div>
			</div>
			<?php endif; ?>

			<div class="postbox">
			<form method="post" action="?page=livechat_settings">

				<?php if (LiveChat::get_instance()->is_installed() == false) { ?>
				<h3>LiveChat account</h3>
				<div class="postbox_content">
				<table class="form-table">
				<tr>
				<th scope="row"><label for="login">My LiveChat login is:</label></th>
				<td><input type="text" name="login" id="login" value="<?php echo LiveChat::get_instance()->get_login(); ?>" size="40" /></td>
				</tr>
				</table>

				<p class="ajax_message"></p>
				<p class="submit">
				<input type="hidden" name="license_number" value="<?php echo LiveChat::get_instance()->get_license_number(); ?>" id="license_number">
				<input type="hidden" name="settings_form" value="1">
				<input type="submit" class="button-primary" value="<?php _e('Save changes') ?>" />
				</p>
			</div>
			</form>

				<?php } else { ?>

				<h3>Advanced settings</h3>
				<div class="postbox_content">
				<table class="form-table">
				<tr>
				<th scope="row"><label for="lang">Language:</label></th>
				<td><input type="text" name="lang" id="lang" value="<?php echo LiveChat::get_instance()->get_lang(); ?>" /> <span class="explanation">Chat window translation. <strong>en</strong> for English (default). <a href="http://support.livechatinc.com/entries/20161073-what-languages-are-supported-in-livechat" class="help">More info&hellip;</a></span></td>
				</tr>
				<tr>
				<th scope="row"><label for="skill">Skill:</label></th>
				<td><input type="text" name="skill" id="skill" value="<?php echo LiveChat::get_instance()->get_skill(); ?>" /> <span class="explanation">Used for skill-based routing. <strong>0</strong> for default skill (recommended).</span></td>
				</tr>
				</table>
				<p class="submit">
				<input type="hidden" name="license_number" value="<?php echo LiveChat::get_instance()->get_license_number(); ?>" id="license_number">
				<input type="hidden" name="changes_saved" value="1">
				<input type="hidden" name="settings_form" value="1">
				<input type="submit" class="button-primary" value="<?php _e('Save changes') ?>" />
				</p>
			</div>
			</form>
				<?php } ?>
			</div>

			<?php if (LiveChat::get_instance()->is_installed()) { ?>
			<p id="reset_settings">Something went wrong? <a href="?page=livechat_settings&amp;reset=1">Reset your settings</a>.</p>
			<?php } ?>
		</div>

		<!-- New account form -->
		<div class="metabox-holder" id="livechat_new_account" style="display:none">
			<div class="postbox">
			<form method="post" action="?page=livechat_settings">
				<h3>Create new LiveChat account</h3>
				<div class="postbox_content">

				<?php
				global $current_user;
				get_currentuserinfo();

				$fullname = $current_user->user_firstname.' '.$current_user->user_lastname;
				$fullname = trim($fullname);
				?>
				<table class="form-table">
				<tr>
				<th scope="row"><label for="name">Full name:</label></th>
				<td><input type="text" name="name" id="name" maxlength="60" value="<?php echo $fullname; ?>" size="40" /></td> 
				</tr>
				<tr>
				<th scope="row"><label for="email">E-mail:</label></th>
				<td><input type="text" name="email" id="email" maxlength="100" value="<?php echo $current_user->user_email; ?>" size="40" /></td>
				</tr>
				<tr>
				<th scope="row"><label for="password">Password:</label></th>
				<td><input type="password" name="password" id="password" maxlength="100" value="" size="40" /></td>
				</tr>
				<tr>
				<th scope="row"><label for="password_retype">Retype password:</label></th>
				<td><input type="password" name="password_retype" id="password_retype" maxlength="100" value="" size="40" /></td>
				</tr>
				</table>

				<p class="ajax_message"></p>
				<p class="submit">
					<input type="hidden" name="website" value="<?php echo bloginfo('url'); ?>">
					<input type="submit" value="Create account" id="submit" class="button-primary">
				</p>
				</div>
			</form>

			<form method="post" action="?page=livechat_settings" id="save_new_license">
				<p>
				<input type="hidden" name="new_license_form" value="1">
				<input type="hidden" name="lang" value="en">
				<input type="hidden" name="skill" value="0">
				<input type="hidden" name="license_number" value="0" id="new_license_number">
				</p>
			</form>
			</div>
		</div>
<?php
		}
?>
		</div>
		</div>
<?php
	}
}