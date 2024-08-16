<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;
    protected $table = 'Logs';
    protected $fillable = ['NOME', 'IP_REQUEST', 'REQUEST', 'RESPONSE'];




    public function createLog($param)
    {
        try {
            $endereco = Endereco::create([
                'ID_CLIENTE' => $param->ID_CLIENTE,
                'CEP' => $param->CEP,
                'LOGRADOURO' => $param->LOGRADOURO,
                'NUMERO' => $param->NUMERO,
                'BAIRRO' => $param->BAIRRO,
                'MUNICIPIO' => $param->MUNICIPIO
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar telefone:', ['error' => $e->getMessage()]);
            return false;
        }
    }
}
