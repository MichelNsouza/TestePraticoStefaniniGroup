<?php

namespace App\Http\Controllers;


use App\Enums\StatusTarefa;
use App\Models\Tarefa;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;


class TarefaController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(){
        $tarefas = Tarefa::all();

        return response()->json([
            'status' => true,
            'tarefas' => $tarefas
        ], HttpResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:300|min:3',
            'descricao' => 'string|max:1000',
            'status' => 'required|string|in:' . implode(',', StatusTarefa::values()), // Validação do status
        ]);


        $tarefa = Tarefa::create($request->all());

        return response()->json([
            'status' => true,
            'message' => "Tarefa Criada com Sucesso!",
            'tarefa' => $tarefa
        ], HttpResponse::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $tarefa = Tarefa::findOrFail($id);
            return response()->json([
                'status' => true,
                'tarefa' => $tarefa
            ],HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tarefa não encontrada.',
                'erro' => $e

            ],HttpResponse::HTTP_NOT_FOUND);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:300|min:3',
            'descricao' => 'string|max:1000',
            'status' => 'required|string|in:' . implode(',', StatusTarefa::values()), // Validação do status
        ]);

        try {
            $tarefa = Tarefa::findOrFail($id);

            $tarefa->update($request->all());

            return response()->json([
                'status' => true,
                'message' => "Tarefa Atualizada com Sucesso!",
                'tarefa' => $tarefa
            ], HttpResponse::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Tarefa não encontrada.'
            ],HttpResponse::HTTP_NOT_FOUND);
        }
    }
    public function destroy($id)
    {
        try {
            $tarefa = Tarefa::findOrFail($id);
            $tarefa->delete();

            return response()->json([
                'status' => true,
                'message' => "Tarefa Deletada com Sucesso!"
            ],HttpResponse::HTTP_NO_CONTENT);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'tarefa não encontrado.'
            ],HttpResponse::HTTP_NOT_FOUND);
        }
    }
}
