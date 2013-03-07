<?php

class TorrentDownloader
{
	public static function getUrl($url)
	{
		return Transmission::addFile($url);
	}
}
