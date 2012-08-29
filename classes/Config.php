<?php

class Config
{
	private static $config = null;

	public static function get($value)
	{
		self::loadConfig();
		return self::$config[$value];
	}

	private static function loadConfig()
	{
		if ( ! isset(self::$config))
		{
			self::$config = parse_ini_file(dirname(__FILE__) . '/../config.ini');
		}
	}
}
