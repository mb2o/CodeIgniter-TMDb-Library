<?php
/**
 * CodeIgniter TMDb (The Movie Database) API Library
 * 
 * Author: Chris Harvey (Back2theMovies)
 * Website: http://www.b2tm.com
 * Email: chrish@b2tm.com
 *
 * Originally developed for Back2theMovies (http://www.b2tm.com)
 * 
 **/
 
class TMDb {

	private $_api_url = 'http://api.themoviedb.org/2.1/';

	private $_methods = array(
						//	'Auth.getSession',
						//	'Auth.getToken',
						//	'Media.addID',
							'Media.getInfo',
						//	'Movie.addRating',
							'Movie.browse',
							'Movie.getImages',
							'Movie.getInfo',
							'Movie.getLatest',
							'Movie.getTranslations',
							'Movie.getVersion',
							'Movie.imdbLookup',
							'Movie.search',
							'Person.getInfo',
							'Person.getLatest',
							'Person.getVersion',
							'Person.search',
							'Genres.getList'
						);

	public function call($api_key, $method, $options = "", $params = NULL)
	{
		// Check the method exists
		if(!in_array($method, $this->_methods))
		{
			return FALSE;
		}
				
		$options_string = '/en/json/'.$api_key."/".$options; // Put together URL segments (Language, Type and API Key, Options)
		
		// Return the full URL string instead (for debugging purposes)
		// return $this->_api_url.$method.$options_string;
		
		// Use cURL to call API and receive response
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->_api_url.$method.$options_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$response = curl_exec ($ch);

		curl_close ($ch);
		
		$response = json_decode($response); // Decode the JSON response into an array
		$response = $response[0]; // All data is contained in an unneccecary array (removed here)
		
		return $response; // Return the array
		
	}
}
/* End of file */