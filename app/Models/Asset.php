<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_type',
        'asset_name',
        'description',
        'quantity',
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}