<?php

class Toggler
{
	public static function makeLink($file)
	{
		if ( ! file_exists($file))
		{
			return false;
		}
		$parts = explode('/', $file);
		$filename = $parts[count($parts) - 1];
		return link($file, Config::get('view_path') . $filename);
	}

	public static function removeLink($link)
	{
		if ( ! is_dir($link))
		{
			return unlink($link);
		}
	}
}
