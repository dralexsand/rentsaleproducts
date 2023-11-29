<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'status_id');
    }
}
