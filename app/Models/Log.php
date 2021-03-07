<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Log extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'type',
        'message'
    ];


    protected $keyType = 'uuid';

    public $incrementing = false;



    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
