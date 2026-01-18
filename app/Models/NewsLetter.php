<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsLetter extends Model
{
    use HasFactory;
    public $table = 'newsletters';

    public $fillable = [
        'id',
        'email',
        'created_at',
        'updated_at'
    ];
}
