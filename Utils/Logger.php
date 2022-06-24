<?php

namespace Manao\Utils;

class Logger
{
    protected $logPath;

    public function __construct($path)
    {
        $this->logPath = $path;
    }

    public function log($log)
    {
        $return = false;

		if(!defined("C_REST_BLOCK_LOG") || C_REST_BLOCK_LOG !== true){
			$this->logPath .= date("Y-m-d") . '/';

			if (!file_exists($this->logPath))
			{
				@mkdir($this->logPath, 0775, true);
			}
            
			$this->logPath .= date('H'). '_log.txt';

            if(is_array($log)){
                $log = json_encode($log, JSON_UNESCAPED_UNICODE);
            }
            
            $log = "[" . date('H:i:s') . "] " . print_r($log, 1) . "\n";

            $return = file_put_contents($this->logPath, $log, FILE_APPEND);
		}

		return $return;
    }
}