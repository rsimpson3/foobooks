<?php

namespace App\Libraries;

class GoogleBooks {

    public function __construct() {

        # Instantiate a new object from the library we're using
        $this->client = new \Google_Client();

        # Put the name of your application here
        $this->client->setApplicationName("Foobooks");

        # Paste in your API Key
        $this->client->setDeveloperKey(\Config::get('apis.google.api_key'));

    }

    # pass author name and # of results requested to method
    public function getOtherBooksByAuthor($author_name, $maxResults = 5) {

        # This library can work with multiple different Google APIs, so here we're specifying we're using the Books API
        $service = new \Google_Service_Books($this->client);

        # Create an array of params for the query; these are the same params we used in the basic example above
        $optParams = [
            'q' => 'author:'.$author_name,
            'maxResults' => 5,
        ];

        # Each API provides resources and methods, usually in a chain. These can be accessed from the service object in the form $service->resource->method(args)
        $books = $service->volumes->listVolumes('', $optParams);

        return $books;
    }

}
