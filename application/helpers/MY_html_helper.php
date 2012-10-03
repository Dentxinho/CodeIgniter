<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function add_actions_to_table($table, $resource, $other_actions = array()) {
	$CI =& get_instance();

	$pattern = array('/<tr>\s*<th>.+<\/th>/iU'
			, '/<tr>\s*<td>\s*(\d+)\s*<\/td>/iU');

	$str_other_actions = '';
	foreach ($other_actions as &$action) {
		$action = anchor($resource.'/'.$action['url'].'/$1', '<i class="icon-'.$action['icon'].'"></i>', 'class="btn btn-mini"');
	}
	$width = 85 + 29*(count($other_actions));

	$str_other_actions = implode('', $other_actions);
	$replace = array("<tr><th style='width:{$width}px'>Actions</th>"
			, '<tr><td><div class="btn-group">'
			. anchor("$resource/read/$1", '<i class="icon-eye-open"></i>', 'class="btn btn-mini"')
			. ($CI->can_modify ? anchor("$resource/update/$1", '<i class="icon-pencil"></i>', 'class="btn btn-mini"') : '')
			. ($CI->can_delete ? anchor("$resource/delete/$1", '<i class="icon-trash"></i>', 'class="btn btn-mini"') : '')
			. $str_other_actions
			.'</div></td>');

	return preg_replace($pattern, $replace, $table);
}

?>