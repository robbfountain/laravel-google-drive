<?php

namespace OneThirtyOne\GoogleDrive;

use Illuminate\Support\Facades\Request;

class Client
{
    /**
     * @var \Google_Client|Google_Client
     */
    public $client;

    /**
     * @throws \Google\Exception
     */
    public function __construct()
    {
        $this->client = $this->getClient();
    }

//    public function __invoke()
//    {
//        // Get the API client and construct the service object.
//        $client = $this->getClient();
////        $service = new Google_Service_Drive($client);
//
//        // Print the names and IDs for up to 10 files.
//        $optParams = [
////            'pageSize' => 10,
//            'fields' => 'nextPageToken, files(id, name, size, mimeType)',
//        ];
//        
////        $results = $service->files->listFiles($optParams);
//
////        if (count($results->getFiles()) == 0) {
////            print "No files found.\n";
////        } else {
////            print "Files:\n";
////            foreach ($results->getFiles() as $file) {
////                printf("%s (%s)\n", $file->getName(), $file->getId());
////            }
////        }
//
////        return view('welcome',['files' => $results->getFiles()]);
//
//    }

    /**
     * Returns an authorized API client.
     *
     * @return Google_Client the authorized client object
     * @throws \Google\Exception
     */
    protected function getClient()
    {
        if (!file_exists(config('google-drive.credentials_file'))) {
            throw new \Exception('Cannot find credentials file');
        }

        $client = new \Google_Client();
//        $client->setApplicationName('Google Drive API PHP Quickstart');
        $client->setScopes(config('google-drive.scopes'));
        $client->setAuthConfig(config('google-drive.credentials_file'));
        $client->setAccessType('offline');
        $client->setRedirectUri(Request::url());
//        $client->setPrompt('select_account consent');

        return $client;
    }

//    public function download($file)
//    {
//        // Get the API client and construct the service object.
//        $client = $this->getClient();
//        $service = new Google_Service_Drive($client);
//
//        $content = $service->files->get($file);
//
//        $content->
//
//
//
//        $fileOut = null;
//        while(!$content->getBody()->eof())
//        {
//            $fileOut .= $content->getBody()->read(1024);
//        }
//
//        Storage::put('image.jpg', $fileOut);
//
//        dd('done');
//    }

}
