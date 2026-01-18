<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\SoftDeletes;use Illuminate\Database\Eloquent\Factories\HasFactory;
class Inquiry extends Model
{
     use SoftDeletes;    use HasFactory;    public $table = 'inquiries';

    public $fillable = [
        'id',
        'name',
        'email',
        'phone',
        'subject',
        'message',
        'uuid',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'subject' => 'string',
        'uuid' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string',
        'email' => 'required|string',
        'phone' => 'required|string',
        'subject' => 'required|string',
        'message' => 'required|string'
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
        self::creating(function (Inquiry $inquiry) {
            $inquiry->uuid = Str::uuid()->toString();
        });
    }

    /**
     * Things require after the boot
     */
    protected static function booted() {
        parent::booted();

        static::creating(function(Inquiry $inquiry){

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
