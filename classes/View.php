<?php

class View
{
	const TEMPLATE_DIR = 'Templates';
	public $smarty = null;
	public $template = null;
	
	public function __construct()
	{
		$this->smarty = new MySmarty();
	}
	
	public function render()
	{
		$this->smarty->display();
	}
	
	public function fetch()
	{
		return $this->smarty->fetch(self::TEMPLATE_DIR . '/' . $this->template);
	}
}
