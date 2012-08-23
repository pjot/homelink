<?php

class FileView extends View
{
	public $template = 'FileView.tpl';
	public function loadRows($rows)
	{
		$this->smarty->assign('rows', $rows);
	}
	public function useBack()
	{
		$this->smarty->assign('useBack', true);
	}
	public function setBanner($banner)
	{
		$this->smarty->assign('banner', $banner);
	}
}
