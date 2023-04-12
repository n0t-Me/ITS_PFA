<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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

    public function team()
    {
      return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    public static function random_password()
    {

      $punctiation = '!"#$%&\'()*+,-./:;<=>?@[\\]^_`{|}~';
      $ascii_upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $ascii_lower = 'abcdefghijklmnopqrstuvwxyz';
      $digits = '0123456789';

      $rand_pass = '';
      for ($i=0; $i < 4; $i++) {
        $rand_pass .= $punctiation[random_int(0, strlen($punctiation)-1)];
        $rand_pass .= $ascii_lower[random_int(0, strlen($ascii_lower)-1)];
        $rand_pass .= $ascii_upper[random_int(0, strlen($ascii_upper)-1)];
        $rand_pass .= $digits[random_int(0, strlen($digits)-1)];
      }
      for ($i=0; $i < 10; $i++)
        $rand_pass = str_shuffle($rand_pass);

      return $rand_pass;
    }
}
