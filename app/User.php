<?php
// views su u resource/views
// kontroleri su u app/Http, kontrolere dodajemo iz terminala: php artisan make:controller PagesController , kontrolere pisemo u pluralu
// ovo je model
namespace App;  //namespace za jedinstvenu identifikaciju

use Illuminate\Contracts\Auth\MustVerifyEmail;  //Illuminate - znaci da se importuje od laravel core sistema
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // veza: korisnik ima vise postova - 1:vise 
    public function posts(){
        return $this->hasMany('App\Post');
    }
}
