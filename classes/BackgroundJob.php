<?php

class BackgroundJob
{
    protected static $command_template = "script -c \"mkvmerge -o %s %s && rm %s\" /dev/null > %s";
    protected static $array_file = 'jobs';
    protected $output_file;
    protected $input_files;
    protected $id;

    public function __construct($output_file, $input_files)
    {
        $this->output_file = $output_file;
        $this->input_files = '';
        foreach ($input_files as $file)
        {
            $this->input_files .= ' ' . self::sanitize($file);
        }
        $this->id = md5($this->output_file . $this->input_files);
    }

    public function start()
    {
        $command = sprintf(self::$command_template,
            $this->output_file,
            $this->input_files,
            self::getLogFile($this->id),
            self::getLogFile($this->id)
        );
        if (self::jobExists($this->id))
        {
            return;
        }
        file_put_contents(self::getArrayFile(), sprintf("%s,%s\n", $this->id, $this->output_file), FILE_APPEND);
        error_log('Running: ' . $command);
        shell_exec($command);
    }

    protected static function jobExists($id)
    {
        foreach (self::readArrayFile() as $row)
        {
            if (strpos($row, $id) !== false)
            {
                return true;
            }
        }
        return false;
    }

    protected static function getLogFile($id)
    {
        return sprintf('%s%s', Config::get('worker_path'), $id);
    }

    protected static function getArrayFile()
    {
        return sprintf('%s%s', Config::get('worker_path'), self::$array_file);
    }

    protected static function sanitize($string)
    {
        return escapeshellarg($string);
    }

    public static function getRunningStatus($id)
    {
        $file = self::getLogFile($id);
        if ( ! file_exists($file))
        {
            return 100;
        }
        if (preg_match('/\rProgress: (?<percentage>\d+)%\r$/', array_pop(file($file)), $matches))
        {
            return (int) $matches['percentage'];
        }
        return 0;
    }

    public static function removeFromArrayFile($id)
    {
        $out_lines = [];
        foreach (self::readArrayFile() as $row)
        {
            if (strpos($row, $id) === false)
            {
                $out_lines[] = $row;
            }
        }
        file_put_contents(self::getArrayFile(), implode("\n", $out_lines));
    }

    protected static function readArrayFile()
    {
        return file(self::getArrayFile(), FILE_IGNORE_NEW_LINES);
    }

    public static function getRunningJobs()
    {
        $jobs = [];
        foreach (self::readArrayFile() as $row)
        {
            $row_data = explode(',', $row);
            $job = new stdClass;
            $job->id = $row_data[0];
            $job->name = $row_data[1];
            $job->progress = self::getRunningStatus($job->id);
            $jobs[] = $job;
        }
        return $jobs; 
    }
}
