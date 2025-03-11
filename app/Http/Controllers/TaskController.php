<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct(
        protected TaskRepository $repository
    ) {

    }

    public function create(Request $request)
    {
        try {
            $user = auth()->user();

            $params = [
                'title' => $request->get('title', null),
                'info' => $request->get('info', null),
                'status' => $request->get('status', default: 0),
                'created_by' => $user->name
            ];
    
            $results = $this->repository->create($params);
    
            return response()->json([
                'message' => 'Task criada com sucesso!',
                'taskId' => $results->id
            ]);
        } catch (Exception $error) {
            report($error);

            return response()->json([
                'message' => 'Erro ao criar task, contate o suporte!',
                'taskId' => null
            ]);
        }
    }

    public function get()
    {
        
    }

    public function getAll()
    {

    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }
}
