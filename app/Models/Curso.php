<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    protected $table = 'Curso';
    protected $primaryKey = 'curso_id';
    public $timestamps = false;
    protected $fillable = [
        'qtd_projetos'
    ];

    public function Aluno()
    {
        return $this->hasMany(Aluno::class, 'curso_id', 'curso_id');
    }
}
