<?php
final class Download_Add extends GWF_Method
{
	public function execute()
	{
		if (!$this->module->mayUpload(GWF_Session::getUser()))
		{
			return GWF_HTML::err('ERR_NO_PERMISSION');
		}
		
		$this->getForm()->onFlowUpload();
		
		if (false !== (Common::getPost('add')))
		{
			return $this->onAdd();
		}
		
		return $this->templateAdd();
	}
	
	private function templateAdd()
	{
		$form = $this->getForm();
		$tVars = array(
			'form' => $form->templateY($this->module->lang('ft_add')),
			'max_size' => GWF_Upload::getMaxUploadSize(),
			'max_time' => ini_get('max_execution_time'),
		);
		return $this->module->templatePHP('add.php', $tVars);
	}
	
	private function getForm()
	{
		$data = array();
		
		$data['filename'] = array(GWF_Form::STRING, '', $this->module->lang('th_dl_filename'));
		$data['file'] = array(GWF_Form::FILE, '', $this->module->lang('th_file'), '', $this->module->fileUploadParams());

		$data['group'] = array(GWF_Form::SELECT, GWF_GroupSelect::single('group', Common::getPost('group')), $this->module->lang('th_dl_gid'));
		$data['level'] = array(GWF_Form::INT, '0', $this->module->lang('th_dl_level'));
		
		if (GWF_User::isAdminS())
		{
			$data['price'] = array(GWF_Form::FLOAT, '0.00', $this->module->lang('th_dl_price'));
		}
		
		$data['expire'] = array(GWF_Form::STRING, '0 seconds', $this->module->lang('th_dl_expire'), $this->module->lang('tt_dl_expire'));
		$data['guest_view'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_dl_guest_view'), $this->module->lang('tt_dl_guest_view'));
		$data['guest_down'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_dl_guest_down'), $this->module->lang('tt_dl_guest_down'));
		
		$data['adult'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_adult'));
		
		if (GWF_User::isLoggedIn())
		{
			$data['huname'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_huname'));
		}
		
		$data['descr'] = array(GWF_Form::MESSAGE, '', $this->module->lang('th_dl_descr'));
		if (!GWF_User::isLoggedIn() && $this->module->cfgGuestCaptcha())
		{
			$data['captcha'] = array(GWF_Form::CAPTCHA);
		}
		$data['add'] = array(GWF_Form::SUBMIT, $this->module->lang('btn_add'));
		return new GWF_Form($this, $data);
	}
	
	private function onAdd()
	{
		$form = $this->getForm();
		if (false !== ($errors = $form->validate($this->module)))
		{
			return $errors.$this->templateAdd();
		}
		
		$file = $form->getVar('file');

		$mod = $this->module->isModerated($this->module);
		
		$userid = GWF_Session::getUserID();
		$options = 0;
		$options |= isset($_POST['adult']) ? GWF_Download::ADULT : 0;
		$options |= isset($_POST['huname']) ? GWF_Download::HIDE_UNAME : 0;
		$options |= isset($_POST['guest_view']) ? GWF_Download::GUEST_VISIBLE : 0;
		$options |= isset($_POST['guest_down']) ? GWF_Download::GUEST_DOWNLOAD : 0;
		$options |= $mod ? 0 : GWF_Download::ENABLED;
		
		$dl = new GWF_Download(array(
			'dl_id' => 0,
			'dl_uid' => $userid,
			'dl_gid' => $form->getVar('group'),
			'dl_level' => $form->getVar('level'),
			'dl_token' => GWF_Download::generateToken(),
			'dl_count' => 0,
			'dl_date' => GWF_Time::getDate(GWF_Date::LEN_SECOND),
			'dl_filename' => $form->getVar('filename'),
			'dl_realname' => $file['name'],
			'dl_descr' => $form->getVar('descr'),
			'dl_mime' => $file['mime'],
			'dl_price' => sprintf('%.02f', $form->getVar('price', 0.0)),
			'dl_options' => $options,
			'dl_voteid' => 0,
			'dl_purchases' => 0,
			'dl_expire' => GWF_TimeConvert::humanToSeconds($form->getVar('expire')),
		));
		if (false === $dl->insert())
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateAdd();
		}
		
		# Move file
		$dlid = $dl->getID();
		$filename = 'dbimg/dl/'.$dlid;
		if (!@copy($file['path'], $filename))
		{
			return GWF_HTML::err('ERR_GENERAL', array( __FILE__, __LINE__)).$this->templateAdd();
		}
		
		$form->cleanup();
		
		# Votes
		if (false === $dl->createVotes($this->module))
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateAdd();
		}
		
		# Moderation
		if ($mod)
		{
			$this->sendModMail($dl);
			return $this->module->message('msg_uploaded_mod');
		}
		else
		{
			return $this->module->message('msg_uploaded');
		}
	}
	
	##################
	### Validators ###
	##################
	public function validate_file(Module_Download $m, $arg) { return count($arg) === 1 ? false : $m->lang('err_one_file'); }
	public function validate_price(Module_Download $m, $arg) { return GWF_Validator::validateDecimal($m, 'price', $arg, 0.00, 10000.00, '0.00'); }
	public function validate_filename(Module_Download $m, $arg) { return GWF_Validator::validateFilename($m, 'filename', $arg, true); }
	public function validate_group(Module_Download $m, $arg) { return GWF_Validator::validateGroupID($m, 'group', $arg, true, true); }
	public function validate_level(Module_Download $m, $arg) { return GWF_Validator::validateInt($m, 'level', $arg, 0, 3999999999, '0'); }
	public function validate_descr(Module_Download $m, $arg) { return GWF_Validator::validateString($m, 'descr', $arg, 0, $m->cfgMaxDescrLen(), false); }
	public function validate_expire(Module_Download $m, $arg) { return GWF_Time::isValidDuration($arg, 0, GWF_Time::ONE_YEAR*10) ? false : $m->lang('err_dl_expire'); }

	##################
	### Moderation ###
	##################
	private function sendModMail(GWF_Download $dl)
	{
		$user = GWF_Session::getUser();
		foreach (GWF_UserSelect::getUsers(GWF_Group::STAFF) as $staff)
		{
			$this->sendModMailB($dl, $user, new GWF_User($staff));
		}
	}
	
	private function sendModMailB(GWF_Download $dl, GWF_User $uploader, GWF_User $staff)
	{
		if ('' === ($rec = $staff->getValidMail()))
		{
			return;
		}
		
		$mail = new GWF_Mail();
		$mail->setSender(GWF_BOT_EMAIL);
		$mail->setReceiver($rec);
		$mail->setSubject($this->module->langUser($staff, 'mod_mail_subj'));
		
		$token = $dl->getHashcode();
		$dlid = $dl->getID();
		$url1 = "index.php?mo=Download&me=Moderate&token={$token}&dlid={$dlid}&action=download";
		$url2 = "index.php?mo=Download&me=Moderate&token={$token}&dlid={$dlid}&action=allow";
		$url3 = "index.php?mo=Download&me=Moderate&token={$token}&dlid={$dlid}&action=delete";
		
		$args = array(
			$staff->displayUsername(),
			$uploader->displayUsername(),
			$dl->display('dl_filename'),
			$dl->display('dl_realname'),
			$dl->display('dl_mime'),
			$dl->getFilesize(),
			$dl->display('dl_descr'),
			Common::getAbsoluteURL($url1, true),
			Common::getAbsoluteURL($url2, true),
			Common::getAbsoluteURL($url3, true),
		);
		
		$mail->setBody($this->module->langUser($staff, 'mod_mail_body', $args));
		
		$mail->sendToUser($staff);
	}
}
