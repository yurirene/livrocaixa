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
        3 => 'Alimentação',
        4 => 'Acessórios',
        5 => 'Doações',
        6 => 'Saúde',
        7 => 'Estética',
        8 => 'PET',
        9 => 'Salário'
    ];

    public function getDataLancamentoAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->created_at)->format('d/m/Y');        
    }

}
