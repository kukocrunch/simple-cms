<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];


    /**
     * Get the user that owns the Post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value) 
    {

        if(is_null($value) || empty($value))
        {
            $img_url = "https://dummyimage.com/900x300/50/ffffff";
            return $img_url;
        }

        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) {
            return $value;
        }

        return asset('storage/' . $value);
    }
        
}
