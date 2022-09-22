<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\GameRequest;
use App\Http\Requests\NumberRequest;
use App\Models\Game;
use Illuminate\Support\Facades\Session;

class GameController extends Controller
{
    /**
     * Start the Game | Set new Game, Generate number and store in session
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function startGame()
    {
        $game = new Game();
        $number = $game->generateNumber();
        Session::put('game', [
            'id' => session()->getId(),
            'players' => [
                'playerOne' => 'Speler 1',
                'playerTwo' => 'Speler 2',
                'playerThree' => 'Speler 3',
            ],
            'randomNumber' => $number
        ]);

        return response()->json(['game' => Session::get('game')]);
    }

    /**
     * Set players, put them in the game session.
     *
     * @param GameRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function setPlayerNames(GameRequest $request)
    {
        $validated = $request->validated();
        $request->session()->put('game.players.' . $request->get('playerKey'), $validated['name']);

        return response()->json(Session::get('game'));
    }

    /**
     * Guess the number. Returns about the number to be higher = 1 or lower = 2. When the number is guessed correctly return 3
     *
     * @param GameRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function guessNumber(NumberRequest $request)
    {
        $validated = $request->validated();
        $returnValue = null;

        if ((int)$validated['number'] === Session::get('game.randomNumber')) {
            $returnValue = 3; //Winner
        } elseif ((int)$validated['number'] > Session::get('game.randomNumber')) {
            $returnValue = 2; //Lower
        } elseif ((int)$validated['number'] < Session::get('game.randomNumber')) {
            $returnValue = 1; //Higher
        }

        return response()->json(['result' => $returnValue]);
    }

    /**
     * TODO: REMOVE THIS FUNCTION AND REMOVE ROUTE!!!!!!
     * @return \Illuminate\Http\JsonResponse
     */
    public function test()
    {
        return response()->json(Session::all());
    }
}
