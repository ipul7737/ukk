<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Book;
use App\Models\User;

class Loan extends Model
{
    protected $fillable =[
        'user_id', 'book_id', 'tanggal_pinjam',
        'due_date','tanggal_kembali',
        'denda', 'status'
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Book()
    {
        return $this->belongsTo(Book::class);
    }
}
