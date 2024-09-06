<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Picture extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'fileTitle',
        'fileName',
        'originalName',
        'fileSize',
        'originalFileSize',
        'compressionRatio',
        'altText',
        'originalPath',
    ];

    protected $mediaLibraryDisk = 'public'; // Set the disk to 'public'

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function resizedImages()
    {
        return $this->hasMany(ResizedImage::class);
    }

    public function getImageUrlAttribute()
    {
        // Get the URL of the first media in the 'images' collection
        $media = $this->getFirstMedia('images');

        if ($media) {
            return $media->getUrl();
        }

        // Return a default URL if media is not found
        return ''; // or any default URL you want
    }
}
