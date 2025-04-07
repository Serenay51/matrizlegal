<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Law extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'category',
        'description',
        'link',
        'law_creation_date',
    ];
}
