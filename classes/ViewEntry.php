<?php

class ViewEntry extends Entry
{
	public function __construct($entry)
	{
		$this->icon = 'icon-trash icon-white';
		$this->btn_class = 'btn-danger';
		parent::__construct($entry);
	}
}
