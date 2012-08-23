<?php

class DirectoryLister
{
    private $path = null;
    public function __construct($path)
    {
	$this->path = $path;
	if ($this->path[0] !== '/')
	{
        	$this->path = '/' . $this->path;
	}
    }
    public function getFiles()
    {
        if (false === ($this->directory = opendir($this->path)))
	{
		throw new Exception('Cannot open dir: ' . $this->path);
	}
        $files = array();
        while (false !== ($entry = readdir($this->directory)))
        {
            if ($entry[0] !== '.')
            {
                $files[] = $entry;
            }
        }
        return $files;
    }
}
