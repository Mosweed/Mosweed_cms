<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResizedImage extends Model
{
    use HasFactory;

    protected $fillable = ['path',
        'width',
        'height',
    ];

    public function picture()
    {
        return $this->belongsTo(Picture::class);
    }
}
