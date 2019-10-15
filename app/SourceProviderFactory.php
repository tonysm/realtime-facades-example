<?php

namespace App;

use App\Services\Github;
use InvalidArgumentException;

class SourceProviderFactory
{
    public function make(SourceProvider $source)
    {
        switch ($source->type) {
            case 'Github':
                return new Github($source);
            default:
                throw new InvalidArgumentException('Invalid source control provider.');
        }
    }
}
