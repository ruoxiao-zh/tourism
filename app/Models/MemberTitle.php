<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberTitle extends Model
{
    protected $table = 'member_title';

    protected $fillable = ['name'];
}
