<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'Grupo';
    protected $primaryKey = 'grupo_id';
    public $timestamps = false;
    protected $fillable = [
        'grupo_id',
        'curso_id',
        'grupo_lider_aluno_id',
        'grupo_nome',
        'grupo_desc',
        'grupo_git_repositorio',
        'grupo_tema',
        'grupo_video'
    ];

    public function Grupo_aluno()
    {
        return $this->hasMany(Grupo_aluno::class, 'grupo_id', 'grupo_id');
    }

}
