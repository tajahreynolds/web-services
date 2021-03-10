<?php
/*
 * TaJah Reynolds
 * RoomController -> handle room requests
 * */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;

class RoomController extends Controller
{
    /**
     * Show a list of all of the Rooms
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomCollection = DB::select('select * from room');

        return view('room', ['roomCollection' => $roomCollection]);
    }

    /**
     * Show a form to add a Room
     * @return \Illuminate\Http\Response
     */
    public function addForm() {
	    return view('addRoomForm');
    }

    private function getImage($building) {                                     
        	$client = new Client([                                          
		        'base_uri'=> 'http://ws.miamioh.edu/api/building/v1/',  
		        'timeout'=>2.0                                          
	    	]);                                                             
		try {                                                           
		        $response = $client->request('GET',$building);          
		        $json = json_decode($response->getBody(),true);         
		        return $json['data']['imageURL'];                       
		                                                                  
		}                                                               
		catch (RequestException $e) {                                   
		        echo Psr7\Message::toString($e->getRequest());          
		        if ($e->hasResponse()) {                                
		               echo Psr7\Message::toString($e->getResponse()); 
		        }                                                       
			return '';                                              		
		}                                                               
    }

    /**
     * Add a Room to database.
     *
     * @param \Illuminate\Http\Request	$request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
	    $this->validate($request, [
		'buildingName' => 'required',
		'roomNum' => 'required|numeric',
		'dept' => 'required',
		'description' => 'required',
		'capacity' => 'required|numeric',
	    ]);
	
	$imgurl = self::getImage($request->input('buildingName'));
	
	DB::insert('insert into room (buildingName, roomNum, capacity, dept, description, image) values (?, ?, ?, ?, ?, ?)', 
		[
			$request->input('buildingName'),
			$request->input('roomNum'),
			$request->input('capacity'),
			$request->input('dept'),
			$request->input('description'),
			$imgurl,	
		]);

	return redirect()->action([RoomController::class, 'index'])->with('success','Room Added Successfully');
    }
}
