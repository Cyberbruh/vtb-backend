<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'text',
        'solution',
        'probability',
        'image',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withPivot('change');
    }
}
