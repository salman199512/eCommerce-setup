<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public $table = 'product_attributes';

    public $fillable = [
        'product_id',
        'attribute_group_id',
        'attribute_id',
    ];

    protected $casts = [
        'product_id' => 'integer',
        'attribute_group_id' => 'integer',
        'attribute_id' => 'integer',
    ];
}
