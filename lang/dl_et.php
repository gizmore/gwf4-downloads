<?php
$lang = array(
	# Page titles
	'pt_list' => 'Allalaadimiste osakond',
	'mt_list' => 'Allalaadimiste osakond, Allalaadimised, Eksklusiivsed allalaadimised, '.GWF_SITENAME,
	'md_list' => 'Exclusive downloads on '.GWF_SITENAME.'.',

	# Page info
	'pi_add' => 'Saamaks parimat kogemust, lae oma fail kõigepealt üles, see pannakse sinu sessiooni. Hiljem muuda valikuid.<br/>Üleslaadimiste maksimum on %s.',

	# Form Titles
	'ft_add' => 'Lae fail üles',
	'ft_edit' => 'Muuda tõmbamist',
	'ft_token' => 'Sisesta oma tõmbamise märk',

	# Errors
	'err_file' => 'Sa pead faili üleslaadima.',
	'err_filename' => 'Sinu sisestad failinimi on vigane. Suurim pikkus on %s. Proovi kasutada traditsioonilisi tähti.',
	'err_level' => 'Kasutaja level peab olema >= 0.',
	'err_descr' => 'Kirjeldus peab olema 0-%s tähte pikk.',
	'err_price' => 'Hind peab olema vahemikus %s ja %s.',
	'err_dlid' => 'Allalaadimist ei leitud.',
	'err_token' => 'Sinu tõmbamismärk on vigane.',

	# Messages
	'prompt_download' => 'Vajuta OK, et alustada allalaadimist.',
	'msg_uploaded' => 'Faili üleslaadimine õnnestus.',
	'msg_edited' => 'Allalaadimise muutmine õnnestus.',
	'msg_deleted' => 'Allalaadimine on edukalt kustutatud.',

	# Table Headers
	'th_dl_filename' => 'Failinimi',
	'th_file' => 'Fail',
	'th_dl_id' => 'ID',
	'th_dl_gid' => 'Vajalik grupp',
	'th_dl_level' => 'Vajalik tase',
	'th_dl_descr' => 'Kirjeldus',
	'th_dl_price' => 'Hind',
	'th_dl_count' => 'Tõmbamisi',
	'th_dl_size' => 'Faili suurus',
	'th_user_name' => 'Üleslaadija',
	'th_adult' => 'Täiskasvanutele mõeldud?',
	'th_huname' => 'Varja kasutajanimi?',
	'th_vs_avg' => 'Hääleta',
	'th_dl_expires' => 'Aegub',
	'th_dl_expiretime' => 'Allalaadimine kehtib kuni',
	'th_paid_download' => 'Tõmbamiseks on vaja teha makse',
	'th_token' => 'Tõmbamismärk',

	# Buttons
	'btn_add' => 'Lisa',
	'btn_edit' => 'Muuda',
	'btn_delete' => 'Kustuta',
	'btn_upload' => 'Lae üles',
	'btn_download' => 'Tõmba',
	'btn_remove' => 'Eemalda',

	# Admin config
	'cfg_anon_downld' => 'Luba külalistele tõmbamine',
	'cfg_anon_upload' => 'Luba külaliste üleslaadimised',
	'cfg_user_upload' => 'Luba kasutajate üleslaadimised',
	'cfg_dl_gvotes' => 'Luba külaliste hääled',	
	'cfg_dl_gcaptcha' => 'Külaliste üleslaadimiste Captcha',	
	'cfg_dl_descr_max' => 'Maksimaalne kirjelduse pikkus',
	'cfg_dl_descr_min' => 'Minimaalne kirjelduse pikkus',
	'cfg_dl_ipp' => 'Asju leheküljel',
	'cfg_dl_maxvote' => 'Maksimaalne häältearv',
	'cfg_dl_minvote' => 'Minimaalne häältearv',

	# Order
	'order_title' => 'Tõmbamismärk %s eest (Token: %s)',
	'order_descr' => 'Ostsite tõmbamismrgi %s eest. Kehtivusaeg %s. Märk: %s',
	'msg_purchased' => 'Makse on laekunud ning tõmbamismärk on sisestatud.<br/>Sinu tõmbamismärk on\'%s\' ja see kehtib %s.<br/><b>Juhul kui sul pole kontot '.GWF_SITENAME.', kirjuta oma tõmbamismärk üles!</b><br/>Või siis mine sellele lingile <a href="%s"> </a>.',

	# v2.01 (+col)
	'th_purchases' => 'Ostud',

	# v2.02 Expire + finsih
	'err_dl_expire' => 'Aegumistäthaeg peab olema vahemikus 0 sekundit ja 5 aastat.',
	'th_dl_expire' => 'Tõmbamine aegub peale',
	'tt_dl_expire' => 'Aja väljendus nagu 5 sekundit või 1 kuu ja 3 päeva.',
	'th_dl_guest_view' => 'Külaline nähtav?',
	'tt_dl_guest_view' => 'Kas külalised tohivad seda allalaadimist näha?',
	'th_dl_guest_down' => 'Külalistele tõmmatav?',
	'tt_dl_guest_down' => 'Kas külalised tohivad seda faili tõmmata?',
	'ft_reup' => 'Lae fail uuesti üles',
	'order_descr2' => 'Tõmbamismärk ostetud %s eest. Tõmbamismärk: %s.',
	'msg_purchased2' => 'Makse on laekunud ning tõmbamismärk on sisestatud.<br/>Sinu tõmbamismärk on\'%s\' ja see kehtib %s.<br/><b>Juhul kui sul pole kontot '.GWF_SITENAME.', kirjuta oma tõmbamismärk üles!</b><br/>Või siis mine sellele lingile <a href="%s"> </a>.',
	'err_group' => 'Et tõmmata seda faili, pead olema kasutajagrupis %s.',
	'err_level' => 'Sa pead olema kasutajatasemel %s, et seda faili tõmmata.',
	'err_guest' => 'Külalistele on selle faili tõmbamine keelatud.',
	'err_adult' => 'Sisaldab täiskasvanute materjale.',

	'th_dl_date' => 'Date',

	# GWF3v1.1
	'cfg_dl_min_level' => 'Minimum userlevel for an upload',
	'cfg_dl_moderated' => 'Require moderators to unlock uploads?',
	'cfg_dl_moderators' => 'Usergroup for upload moderators.',
	'th_enabled' => 'Enabled?',
	'err_disabled' => 'This download isn\'t enabled yet.',
	'msg_enabled' => 'The download has been enabled.',
	'msg_uploaded_mod' => 'Your file has been uploaded successfully, but has to be reviewed before it is released.',

	'mod_mail_subj' => GWF_SITENAME.': Upload Moderation',
	'mod_mail_body' =>
		'Dear %s'.PHP_EOL.
		PHP_EOL.
		'There has been a new file uploaded to '.GWF_SITENAME.' which requires moderation.'.PHP_EOL.
		PHP_EOL.
		'From: %s'.PHP_EOL.
		'File: %s (%s)'.PHP_EOL.
		'Mime: %s'.PHP_EOL.
		'Size: %s'.PHP_EOL.
		'Desc: %s'.PHP_EOL.
		PHP_EOL.
		'You can download the file here:'.PHP_EOL.
		'%s'.PHP_EOL.
		PHP_EOL.
		'You can allow the download here:'.PHP_EOL.
		'%s'.PHP_EOL.
		PHP_EOL.
		'You can delete the download here:'.PHP_EOL.
		'%10$s'.PHP_EOL.
		PHP_EOL.
		PHP_EOL.
		'Kind Regards,'.PHP_EOL.
		'The '.GWF_SITENAME.' script!',
);
?>