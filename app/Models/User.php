<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Auth;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'openid',
        'nickname',
        'avatar',
        'integral',
        'monetary',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Rest omitted for brevity

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function title()
    {
        $members = Member::orderBy('monetary', 'desc')->get();
        foreach ($members as $key => $value) {
            if ($this->monetary >= $value->monetary) {
                if ($value->is_forbid) {
                    return '暂无会员等级';
                }
                $title = MemberTitle::where('id', $value->title_id)->first();

                return $title->name;
            }
        }

        return '暂无会员等级';
    }

    public function discount()
    {
        $members = Member::orderBy('monetary', 'desc')->get();
        foreach ($members as $key => $value) {
            if ($this->monetary >= $value->monetary) {
                if ($value->is_forbid) {
                    return '0';
                }
                return $value->discount;
            }
        }

        return '0';
    }
}
