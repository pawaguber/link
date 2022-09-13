<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = false;

    protected $table = 'links';

    public function getRouteKeyName(){
        return 'short_link';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
