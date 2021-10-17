<?php

namespace App\Models;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ListingImage extends Model
{
    use HasFactory;

    protected $casts = [
        "labels"=>"array"
    ];

    public function listing(){
        return $this->belongsTo(Listing::class);
    }

    static public function getUrlByFilePath($filePath, $w = null, $h = null){
        if (!$w && !$h) {
            return Storage::url($filePath);
        }

        $path = dirname($filePath);
        $filename = basename($filePath);

        $file = "{$path}/crop{$w}x{$h}_{$filename}";

        return Storage::url($file);
    }

    public function getUrl($w = null, $h = null)
    {
        return ListingImage::getUrlByFilePath($this->file, $w, $h);
    }

    public function stoplight($content){
        
        if ($content === "UNKNOWN") {
            return "circle";
        }

        if ($content === "VERY_UNLIKELY") {
            return "circle_green";
        }

        if ($content === "UNLIKELY"){
            return "circle_light_green";
        }
        
        if ($content === "POSSIBLE"){
            return "circle_yellow";
        }

        if ($content === "LIKELY"){
            return "circle_orange";
        }

        if ($content === "VERY_LIKELY"){
            return "circle_red";
        }

    }
}
