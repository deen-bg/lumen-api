<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    protected $table = 'mobil';

    protected $fillable = [
        'mobil_id',
        'price_per_day',
        'image',
        'brand_id',
        'mobil_merk',
        'model_dcs',
        'cc',
        'mobil_tahun',
        'fuel',
        'doors',
        'seats',
        'gear',
        'drive',
        'mobil_plat',
        'mobil_warna',
        'mobil_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];
    protected $hidden = [];
}
