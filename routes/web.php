<?php

use GuzzleHttp\Cookie\CookieJar;

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


///////////// AUTHORIZATION GRANT TOKEN /////////////
Route::get('/redirect',
           function()
           {
             $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://authorizationgrantclient1/callback',
        'response_type' => 'token',
        'scope' => '',
    ]);
exit( var_dump('http://oauth2server1/oauth/authorize?'.$query) );
    return redirect('http://oauth2server1/oauth/authorize?'.$query);

    /*****
    $query = http_build_query(['client_id' => '5',
                               'redirect_uri' => 'http://authorizationgrantclient1/implicitGrantRedirectCallback',
                               'response_type' => 'token',
                               'scope' => '',
                              ]
                             );

    return redirect('http://oauth2server1/oauth/authorize?'.$query);
    *****/


});

Route::get('/callback',
           function(Illuminate\Http\Request $request)
           {
             return var_dump($request);
           }
          );

Route::get('/redirect2',
		   function()
		   {
		   	$query = http_build_query(['client_id' => '4',
		   							   'redirect_uri' => 'http://authorizationgrantclient1/callback',
		   							   'response_type' => 'code',
		   							   'scope' => ''
		   							  ]
		   							 );

		   	return redirect('http://oauth2server1/oauth/authorize?' . $query);
           }
		  );

Route::get('/callback2',
		   function(Illuminate\Http\Request $request)
		   {
		   	$http = new \GuzzleHttp\Client;

		   	$response = $http->post('http://oauth2server1/oauth/token',
		   			                ['form_params' => ['client_id' => '4',
		   											   'client_secret' => '3oNgT1iLvWw5JDXup8UfJ2apStMtk4OhgrvlGoId',
		   											   'grant_type' => 'authorization_code',
		   											   'redirect_uri' => 'http://authorizationgrantclient1/callback',
		   											   'code' => $request->code,
		   											  ],
		   	                        ]
		   						   );

		   	return json_decode((string) $response->getBody(), true);
           }
		  );

Route::get('/test',
		   function()
		   {
	         $http = new \GuzzleHttp\Client;

	         $response = $http->request('GET',
	         		                    'http://oauth2server1/api/user/1',
	         		                    ['headers' => ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImEzZjc3N2E4NTg1OTM4OWM4ZjE4ZGI2NTdmNDNlY2I1MmNhNzE5NmY1YzljYmYzNDc4YzE3YjQyN2NjMTU1ZDAwNWJkNjEzYjRmNWYxN2JmIn0.eyJhdWQiOiI0IiwianRpIjoiYTNmNzc3YTg1ODU5Mzg5YzhmMThkYjY1N2Y0M2VjYjUyY2E3MTk2ZjVjOWNiZjM0NzhjMTdiNDI3Y2MxNTVkMDA1YmQ2MTNiNGY1ZjE3YmYiLCJpYXQiOjE0OTk1MzAwMTYsIm5iZiI6MTQ5OTUzMDAxNiwiZXhwIjoxNTMxMDY2MDE2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.boaHgsN751M47Bj-miJ338hSjKVd12K984DpwhClknyBnP56oFuLOZSW8XLWl93HEoOKu6dKOucoxOR1MQRfaCgJwyLBW01S0WeSVR4B9KMEY1dNUM7PfypUyaaLiAfyCuOxtUDnGGCK09Hq_d0kVqkgtuhGLjBajYhZxrD4e3zSWILrAPxF6Ue1NO8txKW2bni4beDiXv6_VcW3vvdDlOsn8NeU6kHtCLyhKmByyaFgJaqT0Ytvz1CMJw_MQj94L5T4lG5saZH7YBJ05tyz6XPufr2y0INss8UFx0bocsqGcb2m4ik-gNz7NxnFUO5qFZfQ_ZtgyO9VBrT2eDOkNutwIywtYM5yWPrTGdqnBes8yjYKC50SXLewP9CntJHDsYZ8NPtovgQ5HWmkUivpPDcoS5EVI1xE6deT3llkCTsHBCcXJMwtUhXcjudaWVlqaoDg60J19H3eJXM_m-NRf3jw8dO73UJV0k1fnjiwCEQPUC6iPtFwjxpzoXgYKbeMWZUqV4zuPE0P1yjlhwR1xkOlINWTJ7-sx_lgSKukrBs82sixTuqAMUfRXqv4VvEw5HKfqYOxGTd2nv85T0OuI9ZwD9eKFl1b-TX2cZxmn_wGxyTsbyhsZWzj7yEWaTJLrr0-MAUmj2oao5kUSBwJppujd_ZKfOiqfhFf20qGhVg'
	         		                                  ]
	         		                    ]
	         		                   );
	         /* DO NOT DELETE THESE PARTS, they are for reference and debugging purposes
	         echo "<pre>";
	         var_dump( ['statusCode'   => $response->getStatusCode(),
	         		    'reasonPhrase' => $response->getReasonPhrase(),
     	         		'header'       => $response->getHeader('Content-Length'),
	         		    'body'         => $response->getBody(),
	         		    'bodyContents' => $response->getBody()->getContents()
	                   ]
	         		 );
	         exit();
	         *  DO NOT DELETE THESE PARTS, they are for reference and debugging purposes
	         */
	         /*
	         $response = $http->get('http://oauth2server1/api/user/1',
	         		                []
	         		               );
	         */

	         $result = json_decode( (string) $response->getBody(), true );

	         return $result;
           }
		  );


Route::get('/test2',
	       function()
           {
	         $http = new \GuzzleHttp\Client;
		 /* // ?XDEBUG_SESSION_START=ECLIPSE_DBGP&KEY=14990601190393 */
	         $cookieJar = CookieJar::fromArray(['XDEBUG_SESSION_START' => 'ECLIPSE_DBGP',
                                                    'KEY' => '14990601190393'
                                                   ],
	         		                    'oauth2server1'
	         		                  );

	         $response = $http->request('GET',
	         		            'http://oauth2server1/simpleTest',
                                            ['cookies' => $cookieJar]
	         		           );

		     /*****
		     *********************************************************************
			 use GuzzleHttp\Cookie\CookieJar;

			 $cookieJar = CookieJar::fromArray(['cookie_name' => 'cookie_value'],
			 								   'example.com'
			 								  );

			 $client->request('GET', '/get', ['cookies' => $cookieJar]);
		     *********************************************************************

		     echo "<pre>";
		     var_dump( ['statusCode'   => $response->getStatusCode(),
			     		'reasonPhrase' => $response->getReasonPhrase(),
			     		'header'       => $response->getHeader('Content-Length'),
			     		'body'         => $response->getBody(),
			     		'bodyContents' => $response->getBody()->getContents()
		     		   ]
		     		);
		     exit();
		     *****/

		     $result = json_decode( (string) $response->getBody(), true );

		     return $result;
           }
          );

Route::get('/test3',
           function()
           {//exit('bati-a oy');
             $ch = curl_init('http://oauth2server1/simpleTest');
             curl_setopt($ch,   CURLOPT_COOKIE, "XDEBUG_SESSION_START=ECLIPSE_DBGP");
             curl_exec($ch);
           }
          );

Route::get('/test4',
           function()
           {
             $ch = curl_init ();
             curl_setopt ($ch, CURLOPT_URL, 'http://oauth2server1/simpleTest');
             curl_setopt ($ch, CURLOPT_COOKIE, 'XDEBUG_SESSION=1');
             curl_exec ($ch);
           }
          );

Route::get('phpinfo', function(){ phpinfo(); });


Route::get('/refreshToken',
		   function()
		   {
		   	 $http = new GuzzleHttp\Client;

		   	 $response = $http->post('http://oauth2server1/oauth/token',
		   	 		                  ['form_params' => ['grant_type' => 'refresh_token',
									   					 'refresh_token' => 'GCqZxY1k4ykdXWNfrWdB3GRxbjZWGYNfOfDQ3ZUQVFP0/EOypbGrNizQ/sh7ZlN3aqJw9/8iB5S4uV8fQSRSo6XBWL4/T2jSG8Zeltia1j1xxeCbcWsVE5hSR8Mx9m+f9dbEbpb4I4ISpsWV/f0DJaw4dQZxajBuXQqdHwNrk78LUUihW+wLvMJfdnBEQzC0JaT6sIm63Y5PWDkjXKDqv1QDcXobIcMy5CQkMEBUzfuAFMCyVoZW3FErkVz99zSGkstDR5nFTweOdTH2RgZ1NANNIbL7m3e8JBJ+pg5QP9UhWxpfVF3yrHFY1W6XEYAfKBWGg2CiKXIQJQTaTvKj32VJXwc5bEzzxdQ4/2RA3Ovp4A2/6nPfApE72kulBe3ypruvQMbs6Q5LdkYy/FqBQ6vBA+KV0sMwLEBISTUNuhWQssxNUx1XEUvRW8WJgPQx62heDzB2aLYn2NqlfjS+iO38DpCmGP9Bmvwkgu3XmaX4LdX1tLzWN02HuffTjZ464d3V36kLM7xh0FLkjuc88XOLr8WkydGVxC/NK3U8HyoPfxdSEnxArpOHyXXJhOIpXdXp0mmFavpg/4H5o1LdS5m+hLnuQAJNo7EOcJWT+GcF1yM8X7/mwORZhSbDXF7CjPN5xMF2DSfvjg5Rbl+YmInWMM/OoZDfi+o0ROdDHKw=',
									   					 'client_id' => '4',
									   					 'client_secret' => 'RfVD1eckCrEpGqIppokjMfoIswQsNcgkWZ17ERdr',
									   					 'scope' => '',
									   			        ],
		   	                          ]
		   	 		                );

		   	return json_decode((string) $response->getBody(), true);
           }
		  );
///////////// AUTHORIZATION GRANT TOKEN /////////////


///////////// PASSWORD GRANT TOKEN /////////////
Route::get('/passwordTokenGrantTest',
		   function()
		   {
		   	 $http = new GuzzleHttp\Client;

		   	 $response = $http->post('http://oauth2server1/oauth/token',
    		   	 		                 ['form_params' => ['grant_type' => 'password',
                    									   					  'client_id' => '3',
                    									   					  'client_secret' => 'WYveOsogWzD3t4RehAPctuL1EWL4uZzpiM51XAN9',
                    									   					  'username' => 'user1@somewhere.com',
                    									   					  'password' => 'user1',
                    									   					  'scope' => '',
                    									   				   ],
    		   							         ]
		   	 						            );

		   	return json_decode((string) $response->getBody(), true);
           }
          );

Route::get('/passwordGrantClientRedirect',
           function()
           {
             return 'this part not complete yet';
           }
          );
///////////// PASSWORD GRANT TOKEN /////////////


///////////// IMPLICIT GRANT TOKEN /////////////
Route::get('/implicitGrantRedirect',
           function()
           {
             $query = http_build_query(['client_id' => '5',
                                        'redirect_uri' => 'http://authorizationgrantclient1/implicitGrantRedirectCallback',
                                        'response_type' => 'token',
                                        'scope' => '',
                                       ]
                                      );

             return redirect('http://oauth2server1/oauth/authorize?'.$query);
           }
          );

Route::get('/implicitGrantRedirectCallback',
           function(Illuminate\Http\Request $request)
           {
             /*****
             $http = new \GuzzleHttp\Client;

          	 $response = $http->post('http://oauth2server1/oauth/token',
          		   			               ['form_params' => ['client_id' => '5',
          		   											                  'client_secret' => 'sLbwI1zFImcvsunqSYpdq6WkIqnvNzTuCADAohuN',
          		   											                  'grant_type' => 'authorization_code',
          		   											                  'redirect_uri' => 'http://authorizationgrantclient1/callback',
          		   											                  'code' => $request->code,
          		   											                 ],
          		   	                   ]
          		   						        );

          	 return json_decode((string) $response->getBody(), true);
             *****/

             return var_dump($request);
          }
         );
///////////// IMPLICIT GRANT TOKEN /////////////
