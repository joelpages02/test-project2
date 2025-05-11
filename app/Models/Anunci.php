<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anunci extends Model
{
    protected $fillable = ['title', 'description', 'date', 'hour','email' ,'category_id'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
