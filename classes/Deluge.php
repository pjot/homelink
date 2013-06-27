<?php

class Deluge
{
	public static function addFile($file)
	{
		$command = 'deluge-console "add -p ' . Config::get('seed_path') . ' ' . $file . '"';
		$ret = shell_exec($command);
		$success = preg_match('/Torrent\sadded!\n$/m', $ret) === 1;
		if ( ! $success)
		{
			error_log('Error when adding torrent to Deluge: ' . $ret);
		}
		return $success;
	}

	public static function getInfo()
	{
		$info = shell_exec('deluge-console info');
		$info_array = explode('Name:', $info);
		$out = array();
		foreach ($info_array as $torrent)
		{
			$ret = preg_match('/^(?<name>.*)\n.*\n.*ETA:\s(?<eta>.*)\n.*\n.*\n.*\n.*\nProgress:\s(?<progress>\d+)\.\d+%/m', $torrent, $matches);
			if ( ! $ret)
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
