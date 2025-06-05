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
        DB::table('gamesbyuser')->insert([
            'user_id' => $userId,
            'game' => $game->id,
        ]);

        return $game;
    }

    public function findAllDataService() 
    {
       $game = $this->gameRepository->findAllGames();
       return $game;
    }
}
