<?php


namespace App\classes;

use Violet\StreamingJsonEncoder\StreamJsonEncoder;

class JsonStorage extends CacheStorage
{
    private $fileName;
    private $fileStream;
    private $fileContent;

    public function __construct($fileName)
    {
        $this->fileStream = fopen($fileName, 'c+');
        $this->fileName = $fileName;
    }

    public function read()
    {
        $file = fread($this->fileStream, filesize($this->fileName));
        $fileDecode = json_decode($file);
        $this->fileContent = $fileDecode;
    }
    public function write()
    {
        $finalContent = array_replace($this->fileContent, $this->cache);
        $encode = new StreamJsonEncoder($finalContent);
        $encode->encode();
        ftruncate($this->fileStream, 0);
        fwrite($this->fileStream, $encode->current());
    }

    public function __destruct()
    {
        fclose($this->fileStream);
    }
}