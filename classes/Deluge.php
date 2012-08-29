<?php

class Deluge
{
	public static function addFile($file)
	{
		$command = 'deluge-console "add -p ' . Config::get('SEED_PATH') . ' ' . $file . '"';
		$ret = shell_exec($command);
		return preg_match('/Torrent\sadded!\n$/m', $ret) === 1;
	}

	public static function getInfo()
	{
		$info = shell_exec('deluge-console info');
		$info_array = explode('Name:', $info);
		$out = array();
		foreach ($info_array as $torrent)
		{
			if ( ! preg_match('/^\s(?<name>.*)\n.*\n.*ETA:\s(?<eta>.*)\n.*\n.*\nProgress:\s(?<progress>\d+)\.\d+%/m', $torrent, $matches))
			{
				continue;
			}			
			$torr = new stdClass();
			$torr->name = $matches['name'];
			$torr->progress = $matches['progress'];
			$torr->eta = $matches['eta'];
			$out[] = $torr;
		}
		return $out;
	}
}
