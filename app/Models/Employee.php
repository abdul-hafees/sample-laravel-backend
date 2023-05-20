<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        $imageUrl = $this->image ? url('storage/images/' . $this->image) : url('user/user.jpg');

        return $imageUrl;
    }
}
