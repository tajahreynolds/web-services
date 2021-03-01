<?php
/*
 * TaJah Reynolds
 * RoomController -> handle room requests
 * */

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

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

    /**
     * Add a Room to databse.
     *
     * @param \Illuminate\Http\Request	$request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request) {
	$this->validate($request, [
		'roomName' => 'required',
		'dept' => 'required',
		'description' => 'required',
		'capacity' => 'required|numeric',
	]);

	DB::insert('insert into room (roomName, capacity, dept, description) values (?, ?, ?, ?)', 
		[
			$request->input('roomName'),
			$request->input('capacity'),
			$request->input('dept'),
			$request->input('description')
		]);

	$roomCollection = DB::select('select * from room');
	return redirect()->action([RoomController::class, 'index'])->with('success','Room Added Successfully');
    }
}
