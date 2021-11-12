<?php

namespace OneThirtyOne\GoogleDrive;

class GoogleDrive
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @var \Google_Service_Drive
     */
    protected $service;

    /**
     * @var string[]
     */
    protected $optParams = [
        'pageSize' => 100,
        'fields' => 'nextPageToken, files(id, name, size, mimeType)',
    ];

    /**
     * @var
     */
    protected $files;

    /**
     * @param  Client  $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->service = new \Google_Service_Drive($this->client->client);
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function allFiles()
    {
        $files = [];
        $pageToken = null;

        do {
            try {
                if ($pageToken !== null) {
                    $this->optParams['pageToken'] = $pageToken;
                }

                $response = $this->service->files->listFiles($this->optParams);

                $files = array_merge($files, $response->files);
                $pageToken = $response->getNextPageToken();
            } catch (Exception $exception) {
                $pageToken = null;
            }
        } while ($pageToken !== null);

        $this->files = collect($files)->map(function ($file) {
            return $this->file($file->getId());
        });

        return $this->files;
    }

    /**
     * @param $id
     *
     * @return File
     */
    public function file($id)
    {
        $file = $this->service->files->get($id);

        return new File($this->client, $file);
    }

}
