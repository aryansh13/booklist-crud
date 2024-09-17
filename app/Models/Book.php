<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'publication_date',
        'number_of_pages',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(BookCategory::class, 'category_id');
    }
}
