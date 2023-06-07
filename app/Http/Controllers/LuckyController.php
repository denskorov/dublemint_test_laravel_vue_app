<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

class LuckyController extends Controller
{
    public function play(User $user)
    {
        $n = random_int(1, 1000);
        $result = [];

        if ($n % 2 != 0)
            $result = ['message' => 'lose', 'number' => $n, 'sum' => null];
        else {
            $sum = 0;

            if ($n > 900) {
                $sum = 70 * $n / 100;
            } elseif ($n > 600) {
                $sum = 50 * $n / 100;
            } elseif ($n > 300) {
                $sum = 30 * $n / 100;
            } else {
                $sum = 10 * $n / 100;
            }


            $result = ['message' => 'win', 'number' => $n, 'sum' => $sum];
        }

        $result['userId'] = $user->id;

        $game = Game::make($result);
        $game->user()->associate($user);

        $game->save();

        return response()->json($result);
    }

    public function history(Request $request)
    {
        return response()->json(Game::latest()->take($request->get('limit'))->get());
    }

    public function deactivateLink(User $user)
    {
        $user->update(['temporary_url' => null]);
//        $user->save();

        return response()->json(['deactivate' => 'ok']);
    }
}
