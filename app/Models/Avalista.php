<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Avalista extends Authenticatable implements JWTSubject
{
    protected $table = 'Avalista';
    protected $primaryKey = 'avalista_id';
    public $timestamps = false;
    protected $fillable = [
        'avalista_id',
        'curso_id',
        'avalista_nome',
        'avalista_email',
        'avalista_senha'
    ];

    protected $hidden = [
        'avalista_senha'
    ];

    public function Curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'curso_id');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

}
