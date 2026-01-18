<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;use Illuminate\Database\Eloquent\Factories\HasFactory;
class Faq extends Model
{
     use SoftDeletes;    use HasFactory;    public $table = 'faqs';

    public $fillable = [
        'id',
        'question_english',
        'answer_english',
        'uuid',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'question_english' => 'string',
        'answer_english' => 'string',
        'uuid' => 'string'
    ];

    public static array $rules = [
        'question_english' => 'required|string',
        'answer_english' => 'required|string',
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
        self::creating(function (Faq $faq) {
            $faq->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Things require after the boot
     */
    protected static function booted() {
        parent::booted();

        static::creating(function(Faq $faq){

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
