<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Attribute extends Model
{
    use HasFactory, SoftDeletes;

    public $table = 'attributes';

    public $fillable = [
        'attribute_group_id',
        'title',
        'status',
        'uuid',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'attribute_group_id' => 'integer',
        'title' => 'string',
        'status' => 'boolean',
        'uuid' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'attribute_group_id' => 'required|exists:attribute_groups,id',
        'title' => 'required|string|max:255',
        'status' => 'boolean',
    ];

    /**
     * Changing route key name
     * @return string
     */
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

    public function attributeGroup()
    {
        return $this->belongsTo(AttributeGroup::class);
    }
}
