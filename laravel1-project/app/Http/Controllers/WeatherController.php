<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use \GuzzleHttp\Client;
use \GuzzleHttp\Psr7;
use \GuzzleHttp\Exception\RequestException;

class WeatherController extends Controller {
	/**
	 * Get the latitude and longitude for a given zip code
	 * 
	 */
	private function getLatLon($zip) {
		// get the api key from .env
		$key = env('OPENWEATHER_API_KEY','');
		if ($key == "") {
			die ("API KEY NOT DEFINED");
		}
		// set the apikey and zipcode into uri
		$uri = 'zip?appid='.$key.'&zip='.$zip;
		// guzzle call to get lat/lon
		$client = newClient([
			'base_uri' => 'https://api.openweathermap.org/geo/1.0/',
			'timeout' => 2.0
		]);	

		try {
			// send a request to https://api.openweathermap.org/geo/1.0/ with api key and zip
			$response = $client->request('GET', $uri);
			// decode json response
			$json = json_decode($response()->getBody(), true);
			// check if json is valid
			if ($json === false) {
				$json = '{"jsonError":"unknown"}';
			}
			console.log($json);
			return $json;
		} catch (RequestException $e) {
			echo Psr7\Message::toString($e->getRequest());
			if ($e->hasResponse()) {
				echo Pser7\Message::toString($e->getResponse());
			}
	    }
	}
	
	/**
	 * Get the temperature
	 *
	 */
	public function getTemp($zip) {
		if (Cache::has('temp')) {
			$temp = Cache::get('temp');
		} else {
			// get latitude and longitude from zip code
			$json = getLatLon($zip);
			$lat = $json['lat'];
			$lon = $json['lon'];
			// get api key from .env
			$key = env('OPENWEATHER_API_KEY','');
			if ($key === "") {
				die ("API KEY NOT DEFINED");
			}
			// set lat, lon, and api key into uri
			$uri = 'weather?lat='.$lat.'&lon='.$lon.'&units=imperial&appid='.$key;
			// create guzzle client
			$client = new Client([
				'base_uri' => 'https://api.openweathermap.org/data/2.5/',
				'timeout' => 2.0
			]);
		
			try {
				// guzzle call to get temp	
				$response = $client->request('GET', $uri);        
				// decode json response                           
				$json = json_decode($response()->getBody(), true);
				// check if json is valid                         
				if ($json === false) {                            
						$json = '{"jsonError":"unknown"}';        
				}                                                 
				console.log($json);                               
				return $json;                                     
			} catch (RequestException $e) {
				echo Psr7\Message::toString($e->getRequest());
				if ($e->hasResponse()) {
					echo Pser7\Message::toString($e->getResponse());
				}
			}

			// store temp in the cache
			Cache::put('temp', $temp, $seconds=15);
		}
	}
}
