<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
    ];

    public function product(): HasOne
    {
        return $this->hasOne(Product::class);
    }
}
