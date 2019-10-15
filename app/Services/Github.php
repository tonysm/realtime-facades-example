<?php

namespace App\Services;

use App\SourceProvider;
use GuzzleHttp\Client;

class Github
{
    /**
     * @var \App\SourceProvider
     */
    private $source;

    public function __construct(SourceProvider $provider)
    {
        $this->source = $provider;
    }

    public function getRepositories()
    {
        $response = (new Client())->get(
            sprintf(
                'https://api.github.com/users/%s/repos',
                $this->source->name
            ),
            [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                    'Authorization' => 'token '.$this->token(),
                ],
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    private function token()
    {
        return $this->source->meta['token'];
    }
}
