<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function userModelGet($user) {
        $where = [
            'loginid' => $user,
        ];
        $users = DB::table('users')->where($where)->get();
        return $users;
    }

    public function userModelExist($whereColumn,$whereOutput) {
        $where = [
            $whereColumn => $whereOutput,
        ];
        $users = DB::table('users')->where($where)->exists();
        return $users;
    }

    public function userModelUpdate($whereColumn,$whereOutput,$updateColumn,$updateOutput) {
        $where = [
            $whereColumn => $whereOutput,
        ];
        $update = [
            $updateColumn => $updateOutput,
        ];
        DB::table('users')->where($where)->update($update);
    }

    public function userModelInsert($loginid,$nickname,$password,$email,$uservalue) {
        $insert = [
            'loginid' => $loginid,
            'nickname' => $nickname,
            'password' => password_hash($password,PASSWORD_DEFAULT),
            'email' => $email,
            'user_value_id' => $uservalue,
            'login_number_of_times' => 0,
            'last_display_login_time' => '-------',
            'next_display_login_time' => '-------',
            'attr_ans_flag' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($insert);
    }

    public function userModelWhere($logintimes = NULL,$times = NULL) {
        $users = DB::table('users');
        if ($logintimes) $users = $users->where('login_number_of_times','>=',$logintimes);
        if ($times) $users = $users->where('next_display_login_time','>=',date('Y-m-d H:i:s',time()-($times * 31 * 24 * 60 * 60)));
        $users = $users->get();
        return $users;
    }

    public function userModelSearch($whereColumn,$whereOutput,$select) {
        $where = [
            $whereColumn => $whereOutput,
        ];
        $output = DB::table('users')->where($where)->get();

        switch ($select) {
            case 'loginid':
                if (empty($output)) {
                    $output[0] = 'Guest';
                } else {
                    $i = 0;
                    foreach ($output as $op) {
                        $output[$i] = $op->loginid;
                        $i++;
                    }
                }
                break;
            case 'nickname':
                $i = 0;
                foreach ($output as $op) {
                    $output[$i] = $op->nickname;
                    $i++;
                }
                break;
            case 'email':
                $i = 0;
                foreach ($output as $op) {
                    $output[$i] = $op->email;
                    $i++;
                }
                break;
            case 'user_value_id':
                $i = 0;
                foreach ($output as $op) {
                    $output[$i] = $op->user_value_id;
                    $i++;
                }
                break;
        }
        return $output[0];
    }

}