<?php

class SubtitlesView extends View
{
	public $template = 'SubtitlesList.tpl';
	public function addRows($rows)
	{
		$this->smarty->assign('rows', $rows);
	}
	public function setBanner($banner)
	{
		$this->smarty->assign('banner', $banner);
	}
}
