<?php

namespace App\Services;

use App\Repositories\Contracts\IGameContract;
use App\Repositories\GameRepository;
use Illuminate\Support\Facades\DB;

class GameService
{
    private GameRepository $gameRepository;

    public function __construct(IGameContract $gameRepository)
    {
        $this->gameRepository = $gameRepository;
    }

    public function createDataService(array $data, int $userId) 
    {
        $game = $this->gameRepository->createGame($data);
        DB::table('gamebyuser')->insert([
            'user_id' => $userId,
            'game_id' => $game->id,
        ]);

        return $game;
    }

    public function findAllDataService() 
    {
       $game = $this->gameRepository->findAllGames();
       return $game;
    }

    public function findDataService(int $id)
    {
        return $this->gameRepository->findGame($id);
    }

    public function updateGameService(int $id, array $data)
    {
       return $this->gameRepository->updateGame($id, $data);
    }

    public function deleteGameService(int $id)
    {
      return $this->gameRepository->deleteGame($id);
    }
}
