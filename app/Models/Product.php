<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\File;

class Product extends Model implements HasMedia
{
    use HasFactory, SoftDeletes, InteractsWithMedia;

    public $table = 'products';

    public $fillable = [
        'category_id',
        'sub_category_id',
        'brand_id',
        'title',
        'description',
        'returned_days',
        'status',
        'uuid',
    ];

    protected $casts = [
        'category_id' => 'integer',
        'sub_category_id' => 'integer',
        'brand_id' => 'integer',
        'title' => 'string',
        'description' => 'string',
        'returned_days' => 'integer',
        'status' => 'boolean',
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

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('product_images')
            ->acceptsFile(function (File $file) {
                return in_array($file->mimeType, ['image/gif', 'image/png', 'image/jpeg', 'image/webp']);
            })
            ->withResponsiveImages();
    }
}
