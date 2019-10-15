<?php

namespace App\Services;

interface SourceProviderClient
{
    public function getRepositories(): array;
}
