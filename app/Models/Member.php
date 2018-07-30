<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $fillable = ['monetary', 'title_id', 'discount', 'is_forbid'];

    public function title()
    {
        return $this->belongsTo(MemberTitle::class, 'title_id', 'id');
    }
}
