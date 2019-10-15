<?php

namespace Tests\Feature;

use App\Services\SourceProviderClient;
use App\SourceProvider;
use App\User;
use Facades\App\SourceProviderFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class ListSourceProviderRepositoriesTest extends TestCase
{
    use RefreshDatabase;

    public function testCanListSourceProviderRepositories()
    {
        SourceProviderFactory::shouldReceive('make')->andReturn(
            $client = Mockery::mock(SourceProviderClient::class)
        );

        $client->shouldReceive('getRepositories')->andReturn([
            [
                'full_name' => 'testuser/example-repository',
            ],
        ]);

        $user = factory(User::class)->create();
        $sourceProvider = factory(SourceProvider::class)->create([
            'user_id' => $user->id,
        ]);

        $this->actingAs($user)
            ->withoutExceptionHandling()
            ->get(route('source-providers.show', $sourceProvider))
            ->assertSee('testuser/example-repository');
    }
}
