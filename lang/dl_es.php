<?php
$lang = array(
	# Page Titles
	'pt_list' => 'Sección de descarga',
	'mt_list' => 'Sección de descarga, descargas, descargas exclusivas, '.GWF_SITENAME,
	'md_list' => 'Descargas exclusivas en '.GWF_SITENAME.'.',

	# Page Info
	'pi_add' => 'Para mejor experiencia del usuario cargue su archivo primero, será almacenado en su sesión. Luego modifique las opciones.<br/>El tamaño máximo de archivo es %s.',

	# Form Titles
	'ft_add' => 'Subir un archivo',
	'ft_edit' => 'Editar descarga',
	'ft_token' => 'Ingrese su token descarga',

	# Errors
	'err_file' => 'Tiene que subir un archivo.',
	'err_filename' => 'El nombre de archivo especificado no es válido. La longitud máxima es %s. Trate de usar caracteres ascii básicos.',
	'err_level' => 'El nivel de usuario tiene que ser >= 0.',
	'err_descr' => 'La descripción tiene que estar entre 0 y %s caracteres de largo.',
	'err_price' => 'El precio debe estar en el rango %s y %s.',
	'err_dlid' => 'No se pudo encontrar la descarga.',
	'err_token' => 'Su token de descarga no es válido.',

	# Messages
	'prompt_download' => 'Presione OK para descargar el archivo',
	'msg_uploaded' => 'Su archivo se guardó exitosamente.',
	'msg_edited' => 'La descarga se ha modificado exitosamente.',
	'msg_deleted' => 'La descarga se ha eliminado exitosamente.',

	# Table Headers
	'th_dl_filename' => 'Nombre del archivo',
	'th_file' => 'Archivo',
	'th_dl_id' => 'ID',
	'th_dl_gid' => 'Grupo necesario',
	'th_dl_level' => 'Nivel necesario',
	'th_dl_descr' => 'Descripción',
	'th_dl_price' => 'Precio',
	'th_dl_count' => 'Descargas',
	'th_dl_size' => 'Tamaño de archivo',
	'th_user_name' => 'Subido por',
	'th_adult' => 'Contenido para adultos',
	'th_huname' => 'Ocultar usuario',
	'th_vs_avg' => 'Votación',
	'th_dl_expires' => 'Expira',
	'th_dl_expiretime' => 'Descarga válida para',
	'th_paid_download' => 'Un pago es necesario para descargar este fichero',
	'th_token' => 'Token de descarga',

	# Buttons
	'btn_add' => 'Añadir',
	'btn_edit' => 'Editar',
	'btn_delete' => 'Borrar',
	'btn_upload' => 'Subir',
	'btn_download' => 'Descargar',
	'btn_remove' => 'Eliminar',

	# Admin config
	'cfg_anon_downld' => 'Invitados pueden descargar',
	'cfg_anon_upload' => 'Invitados pueden subir',
	'cfg_user_upload' => 'Usuarios pueden subir',
	'cfg_dl_gvotes' => 'Invitados pueden votar',	
	'cfg_dl_gcaptcha' => 'Captcha para los invitados',	
	'cfg_dl_descr_max' => 'Max. longitud de descripción',
	'cfg_dl_descr_min' => 'Min. longitud de descripción',
	'cfg_dl_ipp' => 'Registros por página',
	'cfg_dl_maxvote' => 'Max. puntaje de votación',
	'cfg_dl_minvote' => 'Min. puntaje de votación',

	# Order
	'order_title' => 'Descarga token para %s (Token: %s)',
	'order_descr' => 'Token de descarga comprado para %s. Válido para %s. Token: %s',
	'msg_purchased' => 'Su pago ha sido recibido y el token de descarga ha sido insertado.<br/>Su token es \'%s\' y es válida para %s.<br/><b>Escribe el token abajo si no tienes una cuenta en '.GWF_SITENAME.'!</b><br/>Sino, simplemente <a href="%s">siga este enlace</a>.',

	# v2.01 (+col)
	'th_purchases' => 'Compras',

	# v2.02 Expire + finsih
	'err_dl_expire' => 'El tiempo de expiración tiene que estar entre 0 segundos y 5 años.',
	'th_dl_expire' => 'La descarga expira luego de',
	'tt_dl_expire' => 'La duración expresa como 5 segundos o 1 mes 3 días.',
	'th_dl_guest_view' => 'Invitado visible',
	'tt_dl_guest_view' => 'Los invitados pueden ver la descarga',
	'th_dl_guest_down' => 'Descargable por invitados',
	'tt_dl_guest_down' => 'Los invitados pueden descargar este archivo',
	'ft_reup' => 'Re-subir el archivo',
	'order_descr2' => 'Token de descargas compradas para %s. Token: %s.',
	'msg_purchased2' => 'Su pago ha sido recibido y el token de descarga ha sido insertado.<br/>Su token es \'%s\'.<br/><b>Escribe el token abajo si no tienes una cuenta en '.GWF_SITENAME.'!</b><br/>Sino, simplemente <a href="%s">siga este enlace</a>.',
	'err_group' => 'Usted necesita estar en el grupo de usuarios %s para descargar este archivo.',
	'err_level' => 'Necesitas un nivel de usuario %s para descargar este archivo.',
	'err_guest' => 'Los invitados no podrán descargar este archivo.',
	'err_adult' => 'Esto incluye contenido para adultos.',

	'th_dl_date' => 'Fecha',

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