<?php

class TorrentDownloader
{
	public static function getUrl($url)
	{
        $contents = file_get_contents($url);
        if ($contents === false)
        {
            error_log('Unable to download url: ' . $url);
            return false;
        }
        $file = Config::get('torrent_path') . md5(time()) . '.torrent'; 
        file_put_contents($file, $contents);
        return Deluge::addFile($file);;
	}
}
