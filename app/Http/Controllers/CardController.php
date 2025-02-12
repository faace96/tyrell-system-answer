<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function distribute(Request $request)
    {
        $numPeople = $request->input('num_people');

        //Validate the input number of people
        if (!is_numeric($numPeople) || $numPeople <= 0) {
            return response()->json(['error' => 'Input value does not exist or value is invalid']);
        }

        //Group suits and number of suits into array
        $suits = ['S', 'H', 'D', 'C'];
        $numbers = [1 => 'A', 2, 3, 4, 5, 6, 7, 8, 9, 10 => 'X', 11 => 'J', 12 => 'Q', 13 => 'K'];
        $deck = [];

        //Create Deck
        foreach ($suits as $suit) {
            foreach ($numbers as $key => $value) {
                switch ($suit) {
                    case 'S': $colorSuit = 'blue'; break;
                    case 'H': $colorSuit = 'red'; break;
                    case 'D': $colorSuit = 'orange'; break;
                    case 'C': $colorSuit = 'green'; break;
                    default: $colorSuit = 'black';
                }
                $deck[] = "<span style='color:$colorSuit'>$suit-$value</span>";
            }
        }

        shuffle($deck);

        //Ensure distribute evenly if the number of people is even, if odd some people will have extra
        $result = array_fill(0, $numPeople, []);
        for ($i = 0; $i < count($deck); $i++) {
            $result[$i % $numPeople][] = $deck[$i];
        }

        //Format the result
        $formattedResult = array_map(function ($cards, $index) {
            return "Person " . ($index + 1) . ": " . implode(', ', $cards) . " (Total: " . count($cards) . " cards)";
        }, $result, array_keys($result));

        //Passed the data through AJAX
        return response()->json(['result' => $formattedResult]);
    }
}
