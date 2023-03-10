<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    // protected $fillable = [
    //     'category_name',
    //     'added_by',
    //     'category_image',
        
        
    // ];
    protected $guarded = ['id']; 

    //Relation with table 

    function rel_to_table(){
        return $this->belongsTo(User::class,'added_by');
    }
}
