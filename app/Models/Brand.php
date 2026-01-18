<?php

namespace App\Models;

use App\MyClasses\GeneralHelperFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Brand extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'brands';

    public $fillable = [
        'name',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'uuid',
    ];

    protected $casts = [
        'name' => 'string',
        'slug' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keywords' => 'string',
        'status' => 'boolean',
        'uuid' => 'string',
    ];

    public static $rules = [
        'name' => 'required|string|max:255|unique:brands,name,NULL,id,deleted_at,NULL',
        'status' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeFindWithUuid($query, $uuid, $with = [])
    {
        return $query->where('uuid', $uuid)->with($with)->firstOrFail();
    }

    public function getAvatarUrlAttribute()
    {
        return GeneralHelperFunctions::getSingleMediaUrls($this, 'brands');
    }

    /**
     * Registering media collection
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('avatar')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/gif', 'image/png', 'image/jpeg']);
            })
            ->withResponsiveImages()
            ->singleFile();
    }

    /**
     * Register Media Conversions.
     * @param Media|null $media
     */
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb_100x100')
            ->width(100)
            ->height(100)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('avatar');

        $this->addMediaConversion('thumb_250x250')
            ->width(250)
            ->height(250)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('brand_icon');
    }
}
