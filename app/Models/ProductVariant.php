<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductVariant extends Model
{
    use HasFactory;

    public $table = 'product_variants';

    public $fillable = [
        'product_id',
        'price',
        'discount',
        'final_price',
        'sku',
        'uuid',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'price' => 'decimal:2',
        'discount' => 'decimal:2',
        'final_price' => 'decimal:2',
        'sku' => 'string',
        'uuid' => 'string',
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'product_variant_attributes', 'product_variant_id', 'attribute_id')
                    ->withPivot('attribute_group_id');
    }
}
