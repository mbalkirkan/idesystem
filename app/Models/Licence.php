<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Licence extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'start_date',
        'end_date',
    ];


    protected $keyType = 'uuid';

    public $incrementing = false;

    public $timestamps = false;

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
