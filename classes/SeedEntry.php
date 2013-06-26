<?php

class SeedEntry extends Entry
{
    public function __construct($entry)
    {
        $this->icon = 'icon-arrow-right';
        $this->class = 'btn-info';
        $this->action = 'toggle';
        parent::__construct($entry);
        $this->suggested_out_file = self::suggestOutName($this->name);
    }

    protected static function suggestOutName($name)
    {
        $name = str_replace(' ', '.', $name);
        $parts = explode('.', $name);
        $extension = array_pop($parts);
        $blacklist = array(
            '264',
            'BluRay',
            '720',
            '2013',
            '2012',
            '2011',
            '2010',
            'WEB',
            'HDTV',
            'DTS',
            'DD5',
        );
        $blacklist_regex = '/' . implode('|', $blacklist) . '/';
        $out = '';
        foreach ($parts as $part)
        {
            if (preg_match($blacklist_regex, $part))
            {
                continue;
            }
            if (preg_match('/[sS]\d+[eE]\d+/', $part))
            {
                $out .= '.' . strtolower($part) . '.';
            }
            else
            {
                $out .= strtolower(substr($part, 0, 1));
            }
        }
        if ( ! preg_match('/\.$/', $out))
        {
            $out .= '.';
        }
        $out .= 'sub.' . $extension;
        return $out;
    }
}
