<?php
namespace App\Http\Controllers;

require "/var/www/html/cse451-reynolt4-web/laravel1-project/vendor/autoload.php";

use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use Aws\Credentials\CredentialProvider;

use Illuminate\Http\Request;

class S3Controller extends Controller
{
	public function index() {
		return view('s3');
	}

	public function getContent() {
		echo 'getting content';
		$profile = 'class';
		$path = '/var/www/.aws/credentials.ini';

		$provider = CredentialProvider::ini($profile, $path);
		$provider = CredentialProvider::memoize($provider);

		$s3Client = new S3Client([
			'region' => 'us-east-2',
			'version' => '2006-03-01',
			'credentials' => CredentialProvider::env()
		]);
		try {
			$result = $s3Client->getObject(array(
				'Bucket' => 'cse451-s21-web',
				'Key'	 => 'reynolt4/information'
			));
			var_dump($result);
		} catch (S3Exception $e) {
			echo $e->getMessage().PHP_EOL;
		}
	}

	public function putContent(Request $request) {
		$json = json_decode($request->input('content'), true);
		if ($json === false) {
			die("Input should be JSON format");
		}
		try {
			$result = $s3Client->putObject([
				'Bucket' => 'cse451-s21-web',
				'Key' => 'reynolt4/information',
				'Body' => $json['content'],
				'ACL' => 'public-read',
				'ContentType' => 'application/json'
			]);
		} catch (S3Exception $e) {
			var_dump($e);
		}
		var_dump($result);
	}
}
