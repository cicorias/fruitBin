<?php
/*
*   Logger Class adapted from
*   @author: Kevin Richards
*/

class Logger
{
    function __construct()
    {
        $this->logfile = '../logs/log_'.date('Ymd').'.log';  
    }
    
    function urLog($message)
    {
        $logdata = date("Y m d h:i:s",time())."->".__DIR__." message: ".print_r($message,true)."\n";
        file_put_contents($this->logfile,print_r($logdata,true),FILE_APPEND);
        //$fp = fopen($this->logfile,'a+');
        //$logdata = date("Y m d h:i:s",time())."->".__DIR__." message: ".print_r($message,true)."\n";
        //fwrite($fp,$logdata."\n");
        //fclose($fp);
    }
}
