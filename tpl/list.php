<?php
$user = GWF_Session::getUser();

$headers = array(
	array($lang->lang('th_dl_id'), 'dl_id'),
	array($lang->lang('th_dl_date'), 'dl_date'),
	array($lang->lang('th_dl_filename'), 'dl_filename'),
	array($lang->lang('th_dl_price'), 'dl_price'),
	array($lang->lang('th_purchases'), 'dl_purchases'),
	array($lang->lang('th_user_name'), 'user_name'),
	array($lang->lang('th_dl_count'), 'dl_count'),
	array($lang->lang('th_dl_descr'), 'dl_descrs'),
	array($lang->lang('th_vs_avg'), 'vs_avg'),
	array(),
);
//$headers = GWF_Table::getHeade<<<<##rs2($headers, $tVars['sort_url']);

echo $tVars['page_menu'];


echo GWF_Table::start();
echo GWF_Table::displayHeaders1($headers, $tVars['sort_url']);
foreach ($tVars['downloads'] as $dl)
{
	$dl instanceof GWF_Download;
	$href = $dl->hrefDownload();
	$u = $dl->getUser();
	$v = $dl->getVotes();
	$editbtn = $dl->mayEdit($user) ? GWF_Button::edit($dl->hrefEdit()) : false;
	$onclick = sprintf("return confirm('%s')", $lang->lang('prompt_download'));
	echo GWF_Table::rowStart();
	echo sprintf('<td>%s</td>', $editbtn ? $editbtn : $dl->getVar('dl_id'));
	echo sprintf('<td class="gwf_date">%s</td>', GWF_Time::displayDate($dl->getVar('dl_date')));
	echo sprintf('<td><a href="%s" onclick="%s">%s</a></td>', $href, $onclick, $dl->display('dl_filename'));
	echo sprintf('<td class="gwf_num">%s</td>', $dl->displayPrice());
	echo sprintf('<td class="gwf_num">%s</td>', $dl->getVar('dl_purchases'));
	if ($dl->isUsernameHidden()) {
		echo '<td></td>';
	} else {
		echo sprintf('<td><a href="%s">%s</a></td>', GWF_WEB_ROOT.'profile/'.$u->urlencode('user_name'), $u->display('user_name'));
	}
	echo sprintf('<td class="gwf_num"><a href="%s" onclick="%s">%s</a></td>', $href, $onclick, $dl->getVar('dl_count'));
	echo sprintf('<td><a href="%s" onclick="%s" title="%s">%s</a></td>', $href, $onclick, $dl->display('dl_descr'), GWF_HTML::display(Common::stripMessage($dl->getVar('dl_descr'), 50)));
	echo sprintf('<td class="gwf_num"><a id="gwf_vsba_%d" href="%s" onclick="%s">%.02f%%</a></td>', $v->getID(), $href, $onclick, $v->getAvgPercent());
	echo sprintf('<td class="nowrap">%s</td>', $v->displayButtons());
	echo GWF_Table::rowEnd();
}
echo GWF_Table::end();

if ($tVars['may_upload']) {
	echo GWF_Button::add($tVars['href_add'], $lang->lang('btn_add'));
}
