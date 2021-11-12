<?php

namespace OneThirtyOne\GoogleDrive;

use Illuminate\Support\Str;

class File
{
    /**
     * @var
     */
    public $metaData;

    /**
     * @var
     */
    protected $content;

    /**
     * @var
     */
    protected $client;

    /**
     * @var \Google_Service_Drive
     */
    protected $service;

    /**
     * @var string[]
     */
    protected $allowedMimeTypes = [
        'image/jpeg',
        'image/png',
    ];

    /**
     * @param $metaData
     * @param $content
     */
    public function __construct($client, $metaData)
    {
        $this->client = $client;
        $this->metaData = $metaData;

        $this->service = new \Google_Service_Drive($this->client->client);
    }

    /**
     * @return string|void
     */
    public function download()
    {
        $content = '';

        if (in_array($this->metaData->getMimeType(), $this->allowedMimeTypes)) {
            $file = $this->service->files->get($this->metaData->getId(), ['alt' => 'media']);

            while (!$file->getBody()->eof()) {
                $content .= $file->getBody()->read(1024);
            }

            return $content;
        }
    }

    public function __get($property)
    {
        $method = 'get'. Str::studly($property);

        return $this->metaData->$method();
    }

}
