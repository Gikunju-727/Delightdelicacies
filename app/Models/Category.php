<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable=[
    'group_id',
    'url',
    'name',
    'description',
    'image',
    'icon',
    'status',];

    //belong to relationship

    public function group()
    {
        return $this->belongsTo(Groups::class,'group_id','id');
    }
}
