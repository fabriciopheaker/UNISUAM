<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Exception;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Validator;

class LogController extends Controller
{

    public function store($params)
    {
        try {
            $data = $this->validateData($params);
            if (!$data) {
                throw new \Exception('Dados invalidos para registrar log');
            }
            Log::create([
                'NOME' => $params['NOME'],
                'IP_REQUEST' => $params['IP_REQUEST'],
                'REQUEST' => $params['REQUEST'],
                'RESPONSE' => $params['RESPONSE'],
            ]);
        } catch (Exception $e) {
            FacadesLog::error('Erro ao criar o log: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
    }


    public function validateData(array $data): bool
    {
        $validator = Validator::make($data, [
            'NOME' => 'required|string|max:50',
            'IP_REQUEST' => 'required|string|max:50',
            'REQUEST' => 'required|string|max:150',
            'RESPONSE' => 'required|json',
        ]);

        if ($validator->fails()) {
            return false;
        }
        return true;
    }
}
