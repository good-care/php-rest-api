<?php


namespace App\Exceptions;

class JsonAnswer
{
    public int $code;
    public string $message;
    public mixed $data;
    public mixed $dataInfo;

    public function __construct(int $code = 0, string $message = '', mixed $data = null, mixed $dataInfo = null)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
        $this->dataInfo = $dataInfo;
    }
}