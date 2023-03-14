<?php
class Logger
{
    private string $ip;
    private string $queryString;
    private string $logPath;

    public function __construct($logPath)
    {
        $this->ip = $_SERVER["REMOTE_ADDR"];
        $this->queryString = $_SERVER["QUERY_STRING"];
        $this->logPath = $logPath;
    }


    protected function generateLine($result)
    {
        $date = date('c', time());
        return sprintf(
            "[%s][%s][%s][%s]\n",
            $this->ip,
            $date,
            $this->queryString,
            $result
        );
    }

    public function log($result)
    {
        file_put_contents(
            $this->logPath,
            $this->generateLine($result),
            FILE_APPEND
        );
    }
}
