<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'description',
        'location',
        'image',
        'price',
    ];
    
    public function getSlug()
    {
        return $this->attributes['slug'];
    }

    public function getTitle() 
    {
        return $this->attributes['title'];
    }

    public function getDescription()
    {
        return $this->attributes['description'];;
    }

    public function getLocation()
    {
        return $this->attributes['location'];
    }

    public function getImage()
    {
        return $this->attributes['image'];
    }

    public function getPrice() 
    {
        return $this->attributes['price'];
    }
}
