<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Laracasts\Presenter\PresentableTrait;

class Drone extends Authenticatable
{
    use PresentableTrait;

    /**
     * Presenter class
     *
     * @var  string
     */
    protected $presenter = 'App\\Presenters\\DronePresenter';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'hwid',
        'steam_id',
        'password',
        'api_token',
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
}
