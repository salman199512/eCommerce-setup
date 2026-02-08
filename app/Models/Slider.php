<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Slider extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $guarded = [];

    /**
     * Changing route key name
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Things require during the boot
     */
    protected static function boot()
    {
        parent::boot();

        //Auto-adding uuid to newly created instances
        self::creating(function ($model) {
            $model->uuid = \Illuminate\Support\Str::uuid()->toString();
        });
    }

    protected $casts = [
        'status' => 'boolean',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('slider_images')->singleFile();
    }
}
