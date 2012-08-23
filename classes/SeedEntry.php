<?php

class SeedEntry extends Entry
{
    public function __construct($entry)
    {
	$this->icon = 'icon-plus';
	$this->class = 'btn-info';
	$this->action = 'toggle';
	parent::__construct($entry);
    }
}
