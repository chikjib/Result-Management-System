<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\Card;
use App\UsedCard;

ini_set('max_execution_time', 300);


class CardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_cards()
    {
    	

    	$cards = DB::table('used_cards')
    			->join('cards','used_cards.pin_no','=','cards.pin_no')->get();

    	$unused_cards = Card::where('status','unused')->get();

    	return view('pages.admin.card-generator',['cards' => $cards,'unused_cards' => $unused_cards]);
    }
    public function generate_cards(Request $request)
    {
    
    	
    	$number_of_cards = $request->number_of_cards;

    	for ($i=0; $i < $number_of_cards; $i++) { 
    		$serial_no = "TGR".mt_rand().rand(1000,9999);
    		$pin_no = mt_rand().rand(1000,9999);

    		Card::create([
    			'serial_no'=>$serial_no,
    			'pin_no' => $pin_no
    		]);
    	}

    	return back()->with('message','Cards generated successfully');


    }

    public function destroy($id)
    {
    	$card = Card::findOrFail($id);
    	$used_cards = UsedCard::where('pin_no',$card->pin_no)->delete();
    	$card->delete();

    	return back()->with('message','Cards deleted successfully');
    }
}
