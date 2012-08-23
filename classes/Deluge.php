<?php

class Deluge
{
	public static function addFile($file)
	{
		$command = 'deluge-console "add -p ' . SEED_PATH . ' ' . $file . '"';
		var_dump($command);
		shell_exec($command);
exit;
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
