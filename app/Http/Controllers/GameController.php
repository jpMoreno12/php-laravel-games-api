<?php

namespace App\Http\Controllers;

use App\Services\GameService;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePutRequest;

class GameController extends Controller
{
    protected GameService $gameContoller;

    public function __construct(GameService $gameContoller)
    {
        $this->gameContoller = $gameContoller;
    }

    public function index()
    {
        return $this->gameContoller->findAllDataService();
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();
        
        $game = $this->gameContoller->createDataService($data, 2121212122);
        
        return response()->json($game, 201);
    }
    public function show($id)
    {
        $game = $this->gameContoller->findDataService($id);

        return $game
            ? response()->json($game)
            : response()->json(['message'=> 'Jogo não encontrado'], 404);
    }

    public function update(UpdatePutRequest $request, $id)
    {
        $data = $request->validated();
        $updated = $this->gameContoller->updateGameService($id, $data);

        return $updated
            ? response()->json($updated)
            : response()->json(['messege'=> 'Jogo não encontrado'], 404);
    }

    public function destroy($id)
    {
        return $this->gameContoller->deleteGameService($id)
        ? response()->json(['message' => 'Jogo excluído com sucesso'])
        : response()->json(['message' => 'Jogo não encontrado'], 404);
    }
}
