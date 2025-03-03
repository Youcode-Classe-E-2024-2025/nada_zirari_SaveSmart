<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
    protected $fillable = ['type','amount','description','category_id','profile_id'];

    public function profile(){
        
        return $this->belongsTo(Profile::class);
    }
    public function category(){
        
        return $this->belongsTo(Category::class);
    }
}
