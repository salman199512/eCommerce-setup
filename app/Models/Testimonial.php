<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\MyClasses\GeneralHelperFunctions;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'testimonials';

    public $fillable = [
        'name',
        'role',
        'content',
        'status',
        'uuid',
    ];

    protected $casts = [
        'name' => 'string',
        'role' => 'string',
        'content' => 'string',
        'status' => 'boolean',
        'uuid' => 'string',
    ];

    public static $rules = [
        'name' => 'required|string|max:255',
        'content' => 'required|string',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function getAvatarUrlAttribute()
    {
        $urls = GeneralHelperFunctions::getSingleMediaUrls($this, 'testimonials', 'testimonial_avatars');
        return $urls['NoC'] ?? 'https://i.pravatar.cc/150?u=' . $this->id;
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('testimonial_avatars')
            ->singleFile();
    }
}
