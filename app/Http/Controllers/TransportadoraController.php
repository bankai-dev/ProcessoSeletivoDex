<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Transportadora;
use Illuminate\Support\Facades\Http;


class TransportadoraController extends Controller
{
    // Lista todas as transportadoras
    public function index()
    {
        try {
            $transportadoras = Transportadora::all();
            return response()->json($transportadoras, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao listar transportadoras: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    // Salva uma nova transportadora
    public function store(Request $request)
    {
        try {
            Log::info('Request data: ' . json_encode($request->all()));

            $request->validate([
                'nome' => 'required|string|max:255',
                'endereco' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required|string|max:2',
                'limite_credito' => 'required|numeric',
                'data_analise_credito' => 'required|date',
            ]);

            Log::info('Validation passed.');
    
            $transportadora = Transportadora::create($request->all());

            Log::info('Transportadora created: ' . json_encode($transportadora));
    
            return response()->json($transportadora, 201);
        } catch (\Exception $e) {
            Log::error('Erro ao criar transportadora: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }


    // Mostra uma transportadora específica
    public function show($id)
    {
        try {
            $transportadora = Transportadora::findOrFail($id);
            return response()->json($transportadora, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar transportadora: ' . $e->getMessage());
            return response()->json(['error' => 'Transportadora não encontrada'], 404);
        }
    }

    // Atualiza uma transportadora
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nome' => 'required|string|max:255',
                'endereco' => 'required|string|max:255',
                'bairro' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required|string|max:2',
                'limite_credito' => 'required|numeric',
                'data_analise_credito' => 'required|date',
            ]);

            $transportadora = Transportadora::findOrFail($id);
            $transportadora->update($request->all());

            return response()->json($transportadora, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar transportadora: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    // Deleta uma transportadora
    public function destroy($id)
    {
        try {
            $transportadora = Transportadora::findOrFail($id);
            $transportadora->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            Log::error('Erro ao excluir transportadora: ' . $e->getMessage());
            return response()->json(['error' => 'Erro interno do servidor'], 500);
        }
    }

    public function buscarEnderecoPorCEP(Request $request)
    {
        $request->validate([
            'cep' => 'required|string|size:8', // Validando o CEP
        ]);

        $cep = $request->cep;
        $response = Http::get("https://viacep.com.br/ws/{$cep}/json/");

        if ($response->failed()) {
            return response()->json(['error' => 'Não foi possível encontrar o endereço para o CEP fornecido'], 404);
        }

        $endereco = $response->json();

        return response()->json($endereco, 200);
    }
}
