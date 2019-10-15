<?php

namespace App\Http\Controllers;

use App\SourceProvider;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SourceProvidersController extends Controller
{
    public function callback(Request $request)
    {
        /** @var \Laravel\Socialite\Two\User $oauthUser */
        $oauthUser = Socialite::driver('github')->user();

        $request->user()->sourceProviders()->create([
            'type' => 'Github',
            'name' => $oauthUser->getNickname(),
            'meta' => [
                'token' => $oauthUser->token,
                'refresh_token' => $oauthUser->refreshToken,
                'expires_in' => $oauthUser->expiresIn,
            ],
        ]);

        return redirect()->home()
            ->with('status', 'Source created successfully!');
    }

    public function store()
    {
        return Socialite::driver('github')
            ->scopes(['read:user', 'public_repo'])
            ->redirect();
    }

    public function show(SourceProvider $sourceProvider)
    {
        $this->authorize('view', $sourceProvider);

        return view('source-providers.show', [
            'sourceProvider' => $sourceProvider,
            'repositories' => $sourceProvider->client()->getRepositories(),
        ]);
    }
}
