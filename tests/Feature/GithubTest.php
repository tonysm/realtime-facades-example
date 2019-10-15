<?php

namespace Tests\Feature;

use App\SourceProvider;
use Tests\TestCase;

class GithubTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        if (!env('GITHUB_TEST_TOKEN')) {
            $this->markTestSkipped('No GITHUB_TEST_TOKEN was found.');
        }
    }

    public function testCanListRepositories()
    {
        /** @var SourceProvider $source */
        $source = factory(SourceProvider::class)->create([
            'name' => 'tonysm',
        ]);

        $repositories = $source->client()->getRepositories();

        $this->assertTrue(
            collect($repositories)->pluck('full_name')->contains('tonysm/12factor-app-demo'),
            'Failed to list repositories.'
        );
    }
}
