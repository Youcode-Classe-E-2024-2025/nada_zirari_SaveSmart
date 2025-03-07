<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


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
