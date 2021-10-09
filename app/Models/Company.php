<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'image',
        'rate'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
