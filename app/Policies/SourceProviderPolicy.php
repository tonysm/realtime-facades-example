<?php

namespace App\Policies;

use App\SourceProvider;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourceProviderPolicy
{
    use HandlesAuthorization;

    public function view(User $user, SourceProvider $sourceProvider): bool
    {
        return $user->id == $sourceProvider->user_id;
    }
}
