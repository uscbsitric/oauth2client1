<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/redirect',
		   function()
		   {
		   	$query = http_build_query(['client_id' => '3',
		   							   'redirect_uri' => 'http://authorizationgrantclient1/callback',
		   							   'response_type' => 'code',
		   							   'scope' => ''
		   							  ]
		   							 );

		   	return redirect('http://oauth2server1/oauth/authorize?' . $query);
           }
		  );

Route::get('/callback',
		   function(Illuminate\Http\Request $request)
		   {
		   	$http = new \GuzzleHttp\Client;
		   	
		   	$response = $http->post('http://oauth2server1/oauth/token', 
		   			                ['form_params' => ['client_id' => '3',
		   											   'client_secret' => 'CBgVDvofCj1ocT13wfT5VEaXY7qLt8r3kfh8l4Xu',
		   											   'grant_type' => 'authorization_code',
		   											   'redirect_uri' => 'http://authorizationgrantclient1/callback',
		   											   'code' => $request->code,
		   											  ],
		   	                        ]
		   						   );

		   	return json_decode((string) $response->getBody(), true);
           }
		  );
