<?php

namespace App\Models;

use App\Traits\HasCompositePrimaryKey;
use Illuminate\Database\Eloquent\Model;

class Avaliador_grupo extends Model
{
    use HasCompositePrimaryKey;
    protected $table = 'Avaliador_grupo';

    protected $primaryKey = ['avalista_id', 'grupo_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'avalista_id',
        'grupo_id'
    ];

    public function avalista()
    {
        return $this->belongsTo(Avalista::class, 'avalista_id', 'avalista_id');
    }

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id', 'grupo_id');
    }

}
