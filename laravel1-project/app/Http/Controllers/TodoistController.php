<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;

class TodoistController extends Controller
{
	// call todoist and return json {status:OK|FAIL,tasks:[]}
	public function getTodo() {
		// get the api key from .env
		$key = env('TODOIST_API_KEY','');
		if ($key == "") {
			die ("API KEY NOT DEFINED");
		}
		// create guzzle client
		$client = new Client([
			'base_uri' => 'https://api.todoist.com/rest/v1/'
		]);
		// prepare auth headers
		$headers = ['Authorization' => 'Bearer '.$key];
		try {
			// guzzle call
			$response = $client->request('GET', 'tasks?project_id=2260823064', ['headers' => $headers]);
			// decode json response
			$json = json_decode($response->getBody(), true);
			// check if json is valid	
			if ($json === false) {
				$ret = json_decode('{"status":"FAIL","tasks":[]}', true);
			} else {
				$temp = '{"status":"OK","tasks":[';
				foreach ($json as $task) {
					$temp = $temp.'"'.$task['content'].'",';
				}
				$temp = substr($temp,0,-1).']}';
				$ret = json_decode($temp, true);
			}
			return $ret;
		} catch (RequestException $e) {
			echo Psr7\Message::toString($e->getRequest());
			if ($e->hasResponse()) {
				echo Pser7\Message::toString($e->getResponse());
			}	
		}
	}
}
