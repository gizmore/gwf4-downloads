<?php
final class Download_Edit extends GWF_Method
{
	public function execute()
	{
		if (false === ($dl = GWF_Download::getByID(Common::getGet('id'))))
		{
			return $this->module->error('err_dlid');
		}
		
		if (!$dl->mayEdit(GWF_Session::getUser()))
		{
			return GWF_HTML::err('ERR_NO_PERMISSION');
		}
		
		$this->getFormReup($dl)->onFlowUpload();
		
		if (isset($_POST['edit']))
		{
			return $this->onEdit($dl);
		}
		
		if (isset($_POST['delete']))
		{
			return $this->onDelete($dl);
		}
		
		if (isset($_POST['reup']))
		{
			return $this->onReup($dl);
		}
		
		return $this->templateEdit($dl);
	}
	
	private function templateEdit(GWF_Download $dl)
	{
		$form = $this->getForm($dl);
		
		$form_reup = '';
		if (!$this->module->isModerated($this->module))
		{
			$form_reup = $this->getFormReup($dl);
			$form_reup = $form_reup->templateY($this->module->lang('ft_reup'));
		}
		
		$tVars = array(
			'form' => $form->templateY($this->module->lang('ft_edit')),
			'form_reup' => $form_reup,
		);
		return $this->module->templatePHP('edit.php', $tVars);
	}
	
	private function getFormReup(GWF_Download $dl)
	{
		$data = array();
		$data['file'] = array(GWF_Form::FILE, '', $this->module->lang('th_file'), '', $this->module->fileUploadParams());
		$data['reup'] = array(GWF_Form::SUBMIT, $this->module->lang('btn_upload'));
		return new GWF_Form($this, $data);
	}
	
	private function getForm(GWF_Download $dl)
	{
		$data = array();
		
		$data['filename'] = array(GWF_Form::STRING, $dl->getVar('dl_filename'), $this->module->lang('th_dl_filename'));
		$data['group'] = array(GWF_Form::SELECT, GWF_GroupSelect::single('group', $dl->getVar('dl_gid')), $this->module->lang('th_dl_gid'));
		$data['level'] = array(GWF_Form::INT, $dl->getVar('dl_level'), $this->module->lang('th_dl_level'));
		if (GWF_User::isAdminS())
		{
			$data['price'] = array(GWF_Form::FLOAT, $dl->getVar('dl_price'), $this->module->lang('th_dl_price'));
		}
		
		$data['expire'] = array(GWF_Form::STRING, GWF_Time::humanDuration($dl->getVar('dl_expire')), $this->module->lang('th_dl_expire'), $this->module->lang('tt_dl_expire'));
		$data['guest_view'] = array(GWF_Form::CHECKBOX, $dl->isOptionEnabled(GWF_Download::GUEST_VISIBLE), $this->module->lang('th_dl_guest_view'), $this->module->lang('tt_dl_guest_view'));
		$data['guest_down'] = array(GWF_Form::CHECKBOX, $dl->isOptionEnabled(GWF_Download::GUEST_DOWNLOAD), $this->module->lang('th_dl_guest_down'), $this->module->lang('tt_dl_guest_down'));
		$data['adult'] = array(GWF_Form::CHECKBOX, $dl->isOptionEnabled(GWF_Download::ADULT), $this->module->lang('th_adult'));
		$data['huname'] = array(GWF_Form::CHECKBOX, $dl->isOptionEnabled(GWF_Download::HIDE_UNAME), $this->module->lang('th_huname'));
		$data['enabled'] = array(GWF_Form::CHECKBOX, $dl->isEnabled(), $this->module->lang('th_enabled'));
		
		$data['descr'] = array(GWF_Form::MESSAGE, $dl->getVar('dl_descr'), $this->module->lang('th_dl_descr'));
		
		$data['buttons'] = array(GWF_Form::SUBMITS, array('edit'=>$this->module->lang('btn_edit'),'delete'=>$this->module->lang('btn_delete')));

		return new GWF_Form($this, $data);
	}

	##################
	### Validators ###
	##################
	public function validate_price(Module_Download $m, $arg) { return GWF_Validator::validateDecimal($m, 'price', $arg, 0.00, 10000.00, '0.00'); }
	public function validate_filename(Module_Download $m, $arg) { return GWF_Validator::validateFilename($m, 'filename', $arg, true); }
	public function validate_group(Module_Download $m, $arg) { return GWF_Validator::validateGroupID($m, 'group', $arg, true, true); }
	public function validate_level(Module_Download $m, $arg) { return GWF_Validator::validateInt($m, 'level', $arg, 0, 3999999999, '0'); }
	public function validate_descr(Module_Download $m, $arg) { return GWF_Validator::validateString($m, 'descr', $arg, 0, $m->cfgMaxDescrLen(), false); }
	public function validate_expire(Module_Download $m, $arg) { return GWF_Time::isValidDuration($arg, 0, GWF_Time::ONE_YEAR*10) ? false : $m->lang('err_dl_expire'); }
	public function validate_file(Module_Download $m, $arg) { return count($arg) === 1 ? false : $m->lang('err_one_file'); }
	
	private function onEdit(GWF_Download $dl)
	{
		$form = $this->getForm($dl);
		if (false !== ($err = $form->validate($this->module)))
		{
			return $err.$this->templateEdit($dl);
		}

		if (GWF_User::isAdminS())
		{
			if (false === $dl->saveVar('dl_price', $form->getVar('price')))
			{
				return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateEdit($dl);
			}
		}
		
		$options = 0;
		$options |= isset($_POST['enabled']) ? GWF_Download::ENABLED : 0;
		$options |= isset($_POST['adult']) ? GWF_Download::ADULT : 0;
		$options |= isset($_POST['huname']) ? GWF_Download::HIDE_UNAME : 0;
		$options |= isset($_POST['guest_view']) ? GWF_Download::GUEST_VISIBLE : 0;
		$options |= isset($_POST['guest_down']) ? GWF_Download::GUEST_DOWNLOAD : 0;
		
		if (false === $dl->saveVars(array(
			'dl_filename' => $form->getVar('filename'),
			'dl_gid' => $form->getVar('group'),
			'dl_level' => $form->getVar('level'),
			'dl_descr' => $form->getVar('descr'),
			'dl_options' => $options,
			'dl_expire' => GWF_TimeConvert::humanToSeconds($form->getVar('expire')),
		)))
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__)).$this->templateEdit($dl);
		}

		return $this->module->message('msg_edited').$this->templateEdit($dl);
	}

	private function onDelete(GWF_Download $dl)
	{
		if (false === $dl->getVotes()->onDelete())
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}

		if (false === $dl->delete())
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return $this->module->message('msg_deleted');
	}
	
	private function onReup(GWF_Download $dl)
	{
		$form = $this->getFormReup($dl);
		if (false !== ($err = $form->validate($this->module)))
		{
			return $err.$this->templateEdit($dl);
		}
		
		if (false === ($file = $form->getVar('file')))
		{
			return $this->module->error('err_file').$this->templateEdit($dl);
		}
		
		if ($this->module->isModerated($this->module))
		{
			return GWF_HTML::err('ERR_NO_PERMISSION').$this->templateEdit($dl);
		}
		
		$tempname = 'dbimg/dl/'.$dl->getVar('dl_id');
		if (!@copy($file['path'], $tempname))
		{
			return GWF_HTML::err('ERR_WRITE_FILE', array( $tempname)).$this->templateEdit($dl);
		}
		
		$form->cleanup();
		
		if (!$dl->saveVars(array(
			'dl_uid' => GWF_Session::getUserID(),
			'dl_mime' => $file['mime'],
			'dl_date' => GWF_Time::getDate(GWF_Date::LEN_SECOND),
		)))
		{
			return GWF_HTML::err('ERR_DATABASE', array( __FILE__, __LINE__));
		}
		
		return $this->module->message('msg_uploaded').$this->templateEdit($dl);
	}
	
}
