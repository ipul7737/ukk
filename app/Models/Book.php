<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Loan;

class Book extends Model
{
    protected $fillable = [
    'judul',
    'penulis',
    'penerbit',
    'tahun',
    'stok'
    ];

    public function Loan()
    {
        return $this->hasMany(Loan::class);
    }
}
