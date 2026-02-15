<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\MyClasses\GeneralHelperFunctions;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'products';

    public $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'title',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'description',
        'returned_days',
        'status',
        'is_featured',
        'is_best_seller',
        'is_new_arrival',
        'deal_start_date',
        'logistics_care',
        'is_tax_included',
        'uuid',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'sub_category_id' => 'integer',
        'brand_id' => 'integer',
        'title' => 'string',
        'slug' => 'string',
        'meta_title' => 'string',
        'meta_description' => 'string',
        'meta_keywords' => 'string',
        'description' => 'string',
        'returned_days' => 'integer',
        'status' => 'boolean',
        'is_featured' => 'boolean',
        'is_best_seller' => 'boolean',
        'is_new_arrival' => 'boolean',
        'deal_start_date' => 'datetime',
        'deal_end_date' => 'datetime',
        'logistics_care' => 'string',
        'is_tax_included' => 'boolean',
        'uuid' => 'string',
    ];

    public static $rules = [
        'category_id' => 'required|exists:categories,id',
        'sub_category_id' => 'nullable|exists:sub_categories,id',
        'brand_id' => 'nullable|exists:brands,id',
        'title' => 'required|string|max:255',
        'status' => 'boolean',
        'variants' => 'nullable', // Ensure at least one variant is generated
    ];

    public function getRouteKeyName() {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_attributes');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function getAvatarUrlAttribute()
    {
        $urls = GeneralHelperFunctions::getSingleMediaUrls($this, 'products', 'product_images');
        return $urls['NoC'] ?? '';
    }

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product_images')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/gif', 'image/png', 'image/jpeg', 'image/webp']);
            })
            ->withResponsiveImages();
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
            ->performOnCollections('product_images');

        $this->addMediaConversion('thumb_250x250')
            ->width(250)
            ->height(250)
            ->nonQueued()
            ->keepOriginalImageFormat()
            ->performOnCollections('product_images');
    }
}
