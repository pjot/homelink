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
		$this->smarty->assign('basePath', $_GET['folder']);
	}
	public function setBanner($banner)
	{
		$this->smarty->assign('banner', $banner);
	}
}
