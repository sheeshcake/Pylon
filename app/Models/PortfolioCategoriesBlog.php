<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortfolioCategoriesBlog extends Model
{
    use HasFactory;
    protected $fillable = [
        'portfoliocategory_id',
        'portgoliocategory_content'
    ];
}
