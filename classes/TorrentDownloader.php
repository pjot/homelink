<?php

class TorrentDownloader
{
	public static function getUrl($url)
	{
		echo "downloading $url..\n";
		$contents = file_get_contents($url);
		$file = TORRENT_PATH . '/' . md5(time()) . '.torrent'; 
		echo "saving as $file..\n";
		file_put_contents($file, $contents);
		"adding to deluge";
		Deluge::addFile($file);
		exit;
		header('Location: ' . BASE_URL . '?action=deluge');
	}
}
