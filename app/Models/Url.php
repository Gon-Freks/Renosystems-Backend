<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;
use App\Mail\UrlExpiryEmail;

class Url extends Model
{
    use HasFactory;

    protected $guarded=[];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($url) {
            
            $url->expiration_date = now()->addDays(30);

        });
    }


    public static function generateShortUrl($url)
    {
        $hashedUrl = hash('md5', $url);

        return "http://localhost:8000/".$hashedUrl;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
