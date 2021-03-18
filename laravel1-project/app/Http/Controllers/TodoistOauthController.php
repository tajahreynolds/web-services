<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;

class TodoistOauthController extends Controller
{
	public function index(Request $request) {
		session_start();
		// if request contains code
		if ($request->has('code')) {
			// create guzzle client
			$client = new Client(['base_uri' => 'https://todoist.com/oauth/access_token']);
			// send request to https://todoist.com/oauth/access_token
			$response = $client->request('POST', 'https://todoist.com/oauth/access_token', [
				'form_params' => [
					'client_id' => env('TODOIST_CLIENT_ID'),
					'client_secret' => env('TODOIST_SECRET'),
					'code' => $request->query('code')
				]
			]);
			// decode json response
			$json = json_decode($response->getBody(), true);
			// check if json is valid
			if ($json === false) {
				die("Invalid response");
			}
			// store token in session
			$_SESSION['token'] = $json['access_token'];
			return redirect("https://reynolt4.451.csi.miamioh.edu/cse451-reynolt4-web/laravel1-project/public/index.php/todoistoauth");
		}
		// if logout request
		if ($request->has('cmd')) {
			if ($request->query('cmd') === 'logout') {
				session_unset();
			}
		}
		// see if we have token in session
		if (!isset($_SESSION['token'])) {
			// redirect user to todoist to grant access
			return redirect('https://todoist.com/oauth/authorize?client_id='.env('TODOIST_CLIENT_ID').'&scope=data:read&state='.env('TODOIST_SECRET'));
		}
		// once we are here we should have a token
		// create guzzle client
		$client = new Client([
			'base_uri' => 'https://api.todoist.com/rest/v1/'
		]);
		// prepare auth headers
		$headers = ['Authorization' => 'Bearer '.$_SESSION['token']];
		// access todoist with token
		try {
			$response = $client->request('GET', 'projects', ['headers' => $headers]);
			// decode json response
			$json = json_decode($response->getBody(), true);
			// check if json is valid
			if ($json === false) {
				die("Invalid response");
			}
			// return view with data
			var_dump($json);
			// return view('projects', ['projects' => $json]);
		} catch (RequestException $e) {
		        echo Psr7\Message::toString($e->getRequest());          
			if ($e->hasResponse()) {                                
				echo Psr7\Message::toString($e->getResponse()); 
			}
		}
	}
}
