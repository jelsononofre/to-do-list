<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
                'description' => $request->get('description', null),
                'status' => Task::PENDING,
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

    public function get($id)
    {
        try {
            $results = $this->repository->findById($id);

            $transformData = fractal($results, new TaskTransform());

            return response()->json($transformData);
        } catch (Exception $error) {
            report($error);

            return response()->json([
                'message' => 'Erro ao consultar task, entre em contato com o suporte!',
                'taskId' => null
            ]);
        }
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
        }
    }

    public function update()
    {
        
    }

    public function delete($id)
    {
        try {
            $results = $this->repository->delete($id);

            if (empty($results)) {
                return response()->json([
                    'message' => 'Nenhuma task encontrada com esse ID para exclusão!',
                    'taskId' => (int) $id
                ]);
            }

            return response()->json([
                'message' => 'Task excluída com sucesso!',
                'taskId' => (int) $id
            ]);
        } catch (Exception $error) {
            report($error);

            return response()->json([
                'message' => 'Erro ao remover task, entre em contato com o suporte!',
                'taskId' => null
            ]);
        }
    }
}
