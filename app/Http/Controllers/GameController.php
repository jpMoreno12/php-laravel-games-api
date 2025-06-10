<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePutRequest;
class GameController extends Controller
{
    protected GameService $gameController;

    public function __construct(GameService $gameController)
    {
        $this->gameController = $gameController;
    }

    public function index()
    {
        return $this->gameController->findAllDataService();
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
      
        $game = $this->gameController->createDataService($data, $request->header('HeaderX'));
        
        return response()->json($game, 201);
    }
    public function show($id)
    {
        $game = $this->gameController->findDataService($id);

        return $game
            ? response()->json($game)
            : response()->json(['message'=> 'Jogo não encontrado'], 404);
    }

    public function update(UpdatePutRequest $request, $id)
    {
        $data = $request->validated();
        $updated = $this->gameController->updateGameService($id, $data);

        return $updated
            ? response()->json($updated)
            : response()->json(['message'=> 'Jogo não encontrado'], 404);
    }

    public function destroy($id)
    {
        return $this->gameController->deleteGameService($id)
        ? response()->json(['message' => 'Jogo excluído com sucesso'])
        : response()->json(['message' => 'Jogo não encontrado'], 404);
    }
}
