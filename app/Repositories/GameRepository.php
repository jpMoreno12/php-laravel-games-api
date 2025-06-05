<?php

namespace App\Repositories;

use App\Models\Game;
use App\Repositories\Contracts\IGameContract;

class GameRepository implements IGameContract
{
    public Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function createGame(array $data)
    {
         return $this->game->create($data);
    }

    public function findGame(int $id)
    {
        return $this->game->craate($id);
    }

    public function findAllGames()
    {
        return $this->game->all();
    }

    public function updateGame(int $id, array $data)
    {
        $game = $this->game->find($id);
        if ($game) {
            $game->update($data);
            return $game;
        }
        return false;
    }

    public function deleteGame(int $id)
    {
        $game = $this->game->find($id);
        if ($game) {
            return $game->delete();
        }
        return false;
    }
}
