<?php

/**
 * Description of template
 *
 * @author yabada
 */
class View {

	public function __construct($dir, $param) {
//		$content = include_once 'view/' . $dir;
		return require_once 'view/layout.php';
	}
}
