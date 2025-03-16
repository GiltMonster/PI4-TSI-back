<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Grupo_aluno extends Model
{
    use HasCompositePrimaryKey;

    protected $table = 'Grupo_Aluno';
    protected $primaryKey = ['grupo_id', 'aluno_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'grupo_id',
        'aluno_id'
    ];

    public function Grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'grupo_id');
    }

    public function Aluno()
    {
        return $this->belongsTo(Aluno::class, 'aluno_id', 'aluno_id');
    }

}
