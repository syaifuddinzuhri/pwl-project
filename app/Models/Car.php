<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'cars';

    protected $fillable = [
        'car_type_id',
        'merk',
        'no_plat',
        'color',
        'year',
        'price',
        'fine',
        'status',
        'image',
    ];

    /**
     * Get the user that owns the Car
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function car_type()
    {
        return $this->belongsTo(CarType::class, 'car_type_id');
    }
}