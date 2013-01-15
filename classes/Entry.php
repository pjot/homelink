<?php

class Entry
{
	const DIR = 1;
	const FILE = 2;

	public $dir_button = 'btn-info';
	public $btn_class = '';

	public function __construct($entry)
	{
		$this->target = $entry;
		$this->name = preg_replace('/^(.*)\//', '', $entry);
		if (is_dir($entry))
		{
			$this->type = self::DIR;
			$this->icon = 'icon-white icon-folder-open';
		}
		else
		{
			$this->type = self::FILE;
		}
	}

	public static function sort($a, $b)
	{
		if ($a->type !== $b->type)
		{
			return $a->type > $b->type ? 1 : -1;
		}
		return $a->name > $b->name ? 1 : -1;
	}
}
