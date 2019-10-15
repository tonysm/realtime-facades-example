<?php

namespace App;

use App\Services\Github;
use Illuminate\Database\Eloquent\Model;
use Facades\App\SourceProviderFactory;

/**
 * @property string $type
 * @property string $name
 * @property array $meta
 */
class SourceProvider extends Model
{
    protected $fillable = [
        'type',
        'name',
        'meta',
    ];

    protected $casts = [
        'meta' => 'json',
    ];

    public function client()
    {
        return SourceProviderFactory::make($this);
    }
}
