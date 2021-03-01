<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'summary',
        'price',
        'image',
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
