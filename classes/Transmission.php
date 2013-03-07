<?php

class Transmission
{
	public static function addFile($url)
	{
		$command = 'transmission-remote --auth=pjot:apan -a ' . $url;
		$ret = shell_exec($command);
        error_log($ret);
		return preg_match('/responded: "success"/m', $ret) === 1;
	}

	public static function getInfo()
	{
		$info = shell_exec('transmission-remote --auth=pjot:apan -l | tail -n +2 | head -n-1');
		$info_array = split("\n", $info);
		$out = array();
		foreach ($info_array as $torrent)
		{
            $result = preg_split('/\s\s+/', $torrent);
            if (count($result) < 4)
            {
                continue;
            }
            $torr = new stdClass;
            $torr->name = $result[9];
            $torr->progress = $result[2];
            $torr->eta = $result[4];
            $torr->speed = $result[6];
            $torr->status = $result[8];
            $out[] = $torr;
		}
		return $out;
	}
}
