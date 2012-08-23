<?php

class TorrentView extends View
{
	public $template = 'TorrentList.tpl';
	public function addRows($rows)
	{
		$this->smarty->assign('rows', $rows);
	}
}
