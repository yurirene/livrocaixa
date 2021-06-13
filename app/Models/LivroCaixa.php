<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LivroCaixa extends Model
{
    use HasFactory;
    
    protected $table = 'livro_caixa';
    protected $guarded = [];
    const CATEGORIAS = [
        1 => 'Contas',
        2 => 'Lazer',
        3 => 'Comida'
    ];

    public function getDataLancamentoAttribute($value)
    {
        $this->attributes['data_lancamento'] = Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');        
    }

}
