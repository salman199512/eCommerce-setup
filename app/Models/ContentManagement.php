<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;use Illuminate\Database\Eloquent\Factories\HasFactory;
class ContentManagement extends Model
{
     use SoftDeletes;    use HasFactory;    public $table = 'content_managements';

    public $fillable = [
        'id',
        'title',
        'slug',
        'description',
        'meta_title',
        'active',
        'meta_keyword',
        'meta_description',
        'uuid',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'uuid' => 'string'
    ];

    public static array $rules = [
        'title' => 'required|string',
        'slug' => 'required|string|unique:content_managements,slug,NULL,id,deleted_at,NULL',
        'description' => 'required|string',
        'meta_title' => 'required|string',
        'meta_keyword' => 'nullable',
        'meta_description' => 'nullable'
    ];



    /**
     * Changing route key name
     * @return string
     */
    public function getRouteKeyName() {
        return 'uuid';
    }

    /**
     * Things require during the boot
     */
    protected static function boot() {
        parent::boot();

        //Auto-adding uuid to newly created instances
        self::creating(function (ContentManagement $contentManagement) {
            $contentManagement->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Things require after the boot
     */
    protected static function booted() {
        parent::booted();

        static::creating(function(ContentManagement $contentManagement){

        });
    }

    /**
     * Get Object by UUID
     *
     * @param $query
     * @param $uuid
     * @param array $with
     * @return mixed
     */
    public function scopeFindWithUuid($query,$uuid,$with = []){
        return $query->where('uuid',$uuid)->with($with)->firstOrFail();
    }

}
