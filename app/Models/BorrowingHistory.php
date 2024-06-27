<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'action',
        'timestamp',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }
}