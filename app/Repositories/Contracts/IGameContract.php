<?php

namespace App\Repositories\Contracts;

interface IGameContract
{
    public function createGame(array $data);
    public function findGame(int $id);
    public function findAllGames();
    public function updateGame(int $id, array $data);
    public function deleteGame(int $id);
}
