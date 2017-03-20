<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar','confirmation_token','is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {
        $bind_data = [
            'url' => url('password/reset',$token),
        ];
        $template = new SendCloudTemplate('zhihu_forgot_password', $bind_data);

        Mail::raw($template, function ($message) {
            $message->from('1134607817@qq.com', 'wangliway');

            $message->to($this->email);
        });
    }
}
