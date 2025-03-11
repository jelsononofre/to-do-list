<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Transformers\TaskTransform;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;


class TaskController extends Controller
{
    protected Authenticatable $authUser;

    public function __construct(
        protected TaskRepository $repository
    ) {
        $this->authUser = auth()->user();
    }

    public function create(Request $request)
    {
        try {
            $params = [
                'title' => $request->get('title', null),
                'info' => $request->get('info', null),
                'status' => $request->get('status', default: 0),
                'created_by' => $this->authUser->name
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
        try {
            $results = $this->repository->getAll(
                $this->authUser
            );

            $transformData = fractal($results, new TaskTransform());

            return response()->json($transformData);
        } catch (Exception $error) {
            report($error);
            dd($error);
        }
    }

    public function update()
    {
        
    }

    public function delete()
    {
        
    }
}
