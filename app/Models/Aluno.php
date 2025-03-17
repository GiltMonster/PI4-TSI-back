<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Aluno extends Authenticatable implements JWTSubject
{
    protected $table = 'Aluno';
    protected $primaryKey = 'aluno_id';
    public $timestamps = false;
    protected $fillable = [
        'aluno_id',
        'curso_id',
        'aluno_nome',
        'aluno_foto_url',
        'aluno_email',
        'aluno_senha',
        'aluno_github',
        'aluno_linkedin',
        'aluno_insta'
    ];
    protected $hidden = [
        'aluno_senha'
    ];

    public function Curso()
    {
        return $this->belongsTo(Curso::class, 'curso_id', 'curso_id');
    }

    public function Grupo_aluno()
    {
        return $this->hasMany(Grupo_aluno::class, 'aluno_id', 'aluno_id');
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
