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
		   	$query = http_build_query(['client_id'     => '6',
            		   							   'redirect_uri'  => 'http://authorizationgrantclient1/callback',
            		   							   'response_type' => 'code',
            		   							   'scope'         => ''
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
		   			                    ['form_params' => ['client_id' => '6',
                  		   											     'client_secret' => 'aPtS2UTILPrSPTvtXZxsF8VEMj9fDlQabRNNFzGR',
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
	         		                         ['headers' => ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMwODQzYzJmYjk0Mjk1MzlkNmQ0MjgzZmY5MDFlYzU1MmVmYTJjYTE0NjFhYmJjZjJjZjEwYzAwZTY3NTQxNzFhNGQ1OTEyYjVmYWQ4NmU4In0.eyJhdWQiOiIxIiwianRpIjoiMzA4NDNjMmZiOTQyOTUzOWQ2ZDQyODNmZjkwMWVjNTUyZWZhMmNhMTQ2MWFiYmNmMmNmMTBjMDBlNjc1NDE3MWE0ZDU5MTJiNWZhZDg2ZTgiLCJpYXQiOjE0OTk3ODkxMjYsIm5iZiI6MTQ5OTc4OTEyNiwiZXhwIjoxNTMxMzI1MTI2LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.O7jKOdDttvH-Tigl9TnolrA-XGuJUnNaMrtxM0QXNvVa37myw4595kIzhWRAUKcIBBHCUmg6gTpz2mVBz42zfp_cZGEUVekstkBNqAsUjDbYaF_tk4thiinXTyVbsazadr6S-QWDTyJa4LABVgEYP-UkWwM6TJ-aJk1mOwRT9eVUKycqSNmDq0UwQchhz8iGqDH9Cpv5iefWqVp46mJilbQ-pQgzZ9MaeMa4pNPWB0vC7EgY2wONtZeaA0sNPohYV8CRpN9X0sh4jyDAjEz_WuBSRlBWd2aJT6iGWieT-w0EwRTOZ_--L5Bku0npFDJrY3JWYy6XktJKSXW80Pkyc37i8zD9kWuyxlyleE83VSPOutUDzKQ48iBqhsMCir7gA4vObnjX4_gduTMebSJl8zgEWhdgsKg0Mj9j4_277IHwvuvBy7lHkokhvfJwNqspRYbHKYm1pBFbUc6GVmoYM2vRpzPoaEHvu-H_4koJu2SCqMxkOT7tguIQ1kw32cyZ48qpvJ9xsQs-7YmkciNcqmVaciyZZGeTPmCQFNPzEeY24jrGGt7MNPnsfRzB-COjarDB_B98LtS9NPE1HaHstFM7FKfYZUlUxHpzw8SOPX2dBGwBE_WWeI_2lLc3Y71JvXpQV8NeEB2HnxLliMb9FmocifYL2G4Atx6rKcfuduk'
	         		                                       ]
	         		                         ]
	         		                       );
	          //DO NOT DELETE THESE PARTS, they are for reference and debugging purposes
            /*

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
                        									   					  'refresh_token'=>'GCqZxY1k4ykdXWNfrWdB3GRxbjZWGYNfOfDQ3ZUQVFP0/EOypbGrNizQ/sh7ZlN3aqJw9/8iB5S4uV8fQSRSo6XBWL4/T2jSG8Zeltia1j1xxeCbcWsVE5hSR8Mx9m+f9dbEbpb4I4ISpsWV/f0DJaw4dQZxajBuXQqdHwNrk78LUUihW+wLvMJfdnBEQzC0JaT6sIm63Y5PWDkjXKDqv1QDcXobIcMy5CQkMEBUzfuAFMCyVoZW3FErkVz99zSGkstDR5nFTweOdTH2RgZ1NANNIbL7m3e8JBJ+pg5QP9UhWxpfVF3yrHFY1W6XEYAfKBWGg2CiKXIQJQTaTvKj32VJXwc5bEzzxdQ4/2RA3Ovp4A2/6nPfApE72kulBe3ypruvQMbs6Q5LdkYy/FqBQ6vBA+KV0sMwLEBISTUNuhWQssxNUx1XEUvRW8WJgPQx62heDzB2aLYn2NqlfjS+iO38DpCmGP9Bmvwkgu3XmaX4LdX1tLzWN02HuffTjZ464d3V36kLM7xh0FLkjuc88XOLr8WkydGVxC/NK3U8HyoPfxdSEnxArpOHyXXJhOIpXdXp0mmFavpg/4H5o1LdS5m+hLnuQAJNo7EOcJWT+GcF1yM8X7/mwORZhSbDXF7CjPN5xMF2DSfvjg5Rbl+YmInWMM/OoZDfi+o0ROdDHKw=',
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

///////////// PASSWORD GRANT TOKEN /////////////


///////////// IMPLICIT GRANT TOKEN (basically not working, refer to my personal notes about it)/////////////
Route::get('/implicitGrantRedirect',
           function()
           {
             $query = http_build_query(['client_id' => '5',
                                        'redirect_uri' => 'http://authorizationgrantclient1/implicitGrantRedirectCallback',
                                        'response_type' => 'token',
                                        'scope' => '',
                                       ]
                                      );

             $redirectTo = 'http://oauth2server1/oauth/authorize?'.$query;
             dd($redirectTo);
             return redirect($redirectTo);
           }
          );

Route::get('/implicitGrantRedirectCallback',
           function(Illuminate\Http\Request $request)
           {

           }
          );
///////////// IMPLICIT GRANT TOKEN (basically not working refer to my personal notes about it)/////////////

///////////// CLIENT CREDENTIALS GRANT TOKEN /////////////

Route::get('/clientCredentialsGrantTest',
           function()
           {
             $guzzle = new GuzzleHttp\Client;

             $response = $guzzle->post('http://oauth2server1/oauth/token',
                                       ['form_params' => ['grant_type' => 'client_credentials',
                                                          'client_id' => '1',
                                                          'client_secret' => 'xmKDdJnyi139Hc1D3SIlae1bHJxzE5xkCTiJUQ70',
                                                          'scope' => '',
                                                         ],
                                       ]
                                      );

            return json_decode((string) $response->getBody(), true);
           }
          );

///////////// CLIENT CREDENTIALS GRANT TOKEN /////////////
