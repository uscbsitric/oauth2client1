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
		   	$query = http_build_query(['client_id'     => '3',
            		   							   'redirect_uri'  => 'http://authorizationgrantclient1/callback',
            		   							   'response_type' => 'code',
            		   							   'scope' => 'check-status place-orders',
            		   							  ]
            		   							 );

        $redirectTo = 'http://oauth2server1/oauth/authorize?' . $query;

		   	return redirect( $redirectTo );
       }
		  );

Route::get('/callback',
		   function(Illuminate\Http\Request $request)
		   {
		   	$http = new \GuzzleHttp\Client;

		   	$response = $http->post('http://oauth2server1/oauth/token',
		   			                    ['form_params' => ['client_id' => '3',
                  		   											     'client_secret' => 'ogZbdI6qLQfuN80BiH1XEVQSzRuOHpwkYoKUqUKc',
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
	         		                         ['headers' => ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjExM2Y5ZTEwZmE2N2Q0MTI3YjY5ZTViMjkyODRhMjFiMWQ5ZmQ1MGMzNzQ4MjcxYjllZjI0MDJjYzYwNWU5ZTQ5YjExMTEwYjJiZGU0OWRhIn0.eyJhdWQiOiIzIiwianRpIjoiMTEzZjllMTBmYTY3ZDQxMjdiNjllNWIyOTI4NGEyMWIxZDlmZDUwYzM3NDgyNzFiOWVmMjQwMmNjNjA1ZTllNDliMTExMTBiMmJkZTQ5ZGEiLCJpYXQiOjE1MDAyNjI1ODUsIm5iZiI6MTUwMDI2MjU4NSwiZXhwIjoxNTMxNzk4NTg1LCJzdWIiOiIxIiwic2NvcGVzIjpbImNoZWNrLXN0YXR1cyIsInBsYWNlLW9yZGVycyJdfQ.AgbT7QyF70eD_1ZI1HM3m8SkQngZRrdaq9ruicGHBrVWRJKqWBQDbhrIqgMbZO4L2G4v8Cv0aEZzqkn54Aww530b4Ln8cwzDew4y4H7aL60cL0Bj2QKRs-biIAwyVSkPIVXLbxOX2C6bkN4UxImzXgfi9HpADmU43tDcdz2LnxBBirfZITYmYsaFSIwQ6s1HyJXGexnbNz9A7JoQIF-loNV-QLW9BE963jCgGK7W3hFspKW1ZXavoUk5uAryDJzEdv8MWqsRBtbxViodtGBZzxpwV9gv8viVReOFINtPED_eMgbJ1FQjVkGyLqs9hF1t1vcVI6CmHw1sbNYvUy6xFuGn3HDokNnBCUrOVa38qttdqRX2Hb9O6dPqCTd-dGMNII8tKilmXFMT1SD19bvdtcJtB2IU_2gO8URfkazOOAkzX_Q3FslIMTgl1GTbLJLDO1z1FXxJ3FD7VmHgbYGFhQ24AwLHOEulhtW6m_d1oXnwwdmQJXpbNi1RsZ84dtcCW8eY2iebLtTHFeBF4S8sJn23EISkRmdIJALoVoG-iPAICP9hlAJ_aRH8hTxl4Y3lFrWnrRo001FMNOqXf5QVc6aO9ipNHec80WdC478aryFzG1OZlARmDl7ryCBDDDmgxwLCzmF0JaXh7Il7VeMgvq9lHKPzxOk7Pf2mq3AgPXg'
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
                        									   					  'client_id' => '2',
                        									   					  'client_secret' => 'UJrd2yWnIAOGHqWeUiLJPDuBLSgXBHMWmQPwxToI',
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
             $query = http_build_query(['client_id' => '3',
                                        'redirect_uri' => 'http://authorizationgrantclient1/implicitGrantRedirectCallback',
                                        'response_type' => 'token',
                                        'scope' => 'check-status place-orders',
                                       ]
                                      );

             $redirectTo = 'http://oauth2server1/oauth/authorize?'.$query;

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
                                                          'client_id' => '3',
                                                          'client_secret' => 'ogZbdI6qLQfuN80BiH1XEVQSzRuOHpwkYoKUqUKc',
                                                          'scope' => 'place-orders check-status',
                                                         ],
                                       ]
                                      );

            return json_decode((string) $response->getBody(), true);
           }
          );

Route::get('/clientCredentialsGrantMachineTest',
           function()
           {
             /* I dont know why but this acces code works but the one made by /clientCredentialsGrantTest is not woking

             eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMxNDFlNzkyZmNkMjYyNjUwZTQ5MWNhZTE3MzUxMmZmMjg4Y2NjNTY5ZTRiYmFhMmJhZDFiZWFkNmQ1YjFjYmVkZmQwMTYwZWNhZDliNjkwIn0.eyJhdWQiOiIzIiwianRpIjoiMzE0MWU3OTJmY2QyNjI2NTBlNDkxY2FlMTczNTEyZmYyODhjY2M1NjllNGJiYWEyYmFkMWJlYWQ2ZDViMWNiZWRmZDAxNjBlY2FkOWI2OTAiLCJpYXQiOjE0OTk3ODc1NzYsIm5iZiI6MTQ5OTc4NzU3NiwiZXhwIjoxNTMxMzIzNTc2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.r637rV5SPo-f4RCxAAk4wAg88cxGHgiVZng6y35afoHMwYc6rp3d4CEgUwnAc3GM8uaNeG5RediDQ-9QigQFeUDaakPXjbbKhuyfryU3SQhw1MohH09HSg_yUKOxGTwBnlJrcY3sAFHL1MOfAmtaFGMomzHH-BV6Kfd0pe3fwb3eFfGfpcI15bcQzNDXvn3bvdZMvt8d4ByYAaqdD4G13qWAiQPcBTs9RDeE3I-SCWFJtfd6h1Ii3CrmO2n6op7O5GD7fz-mAiIwTcmlj-qgbqVCwIbVV4Ev0Bixj0OlQnOpjWMOtqAJDs_ZPB71qIlxmiI03prtwAYwKiaqxEmBEs18DdvpHjWwu7vxwZEuNuMFHXCX67KhaC1li_7Stz0UNQMSUx85tNBOL_Czc1a6M8T-iMni8VeQY11T3n1GVnwGbAWy0vKzUvvLtlV7wmNN39EJ0lAWntLXq2YPARiFjqjgmqM06klekQXIoa7-1du3WBbBB_AZOnimGahYjQBrPa-dQFs4ZRQkxZ81NUlGjkJETnfBA1eXrlvmhe6OpQq0I2H1v0AbZwdqpgcBA73NJ89Me92GoosqwGbPAsbuur53Z-pEAyTOZGfW2EAe9OxhlydX-CTN0wqnwhRN8oC2OQkW9bXT6lyzgH8KOSJx6wat0uaXSp109xKj7CyPVSk

             */
             $header = ['Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImMyNzQxMzI1ZmY2YmU3ZDI1MzNiMjE1MDc4ZDQ1Yjk0ZTE3NjAwZDFlM2M0NDVkMjQ1MzE0YzU1ZWM5ZTJlNDBkYjYyNTQyMjliYTFhOTJiIn0.eyJhdWQiOiIzIiwianRpIjoiYzI3NDEzMjVmZjZiZTdkMjUzM2IyMTUwNzhkNDViOTRlMTc2MDBkMWUzYzQ0NWQyNDUzMTRjNTVlYzllMmU0MGRiNjI1NDIyOWJhMWE5MmIiLCJpYXQiOjE0OTk5OTQ4MTgsIm5iZiI6MTQ5OTk5NDgxOCwiZXhwIjoxNTMxNTMwODE4LCJzdWIiOiIiLCJzY29wZXMiOlsicGxhY2Utb3JkZXJzIiwiY2hlY2stc3RhdHVzIl19.ReCgU6PGR8VGVflH5gIIoqak7XR6cgztGhs-Vh5LruzplSZcALdIpJ3TGqEFbDHDR37cVUoUyquc3r5qaLFm14WGNZrHA3ZknHsBvsvk56k7CpXnQKArRIQBYboxhvoNcVY-wV1Qi3QbGZcc_kGLIYHTsqJgKokVySmTBsdL8vSDhz6u0jPvNGmrn3rHwA-nHRchV5Fm2nUe_4VwZ1Dw9gOEtCt8MNL2bNpb2kF-jeSx_yd1Hx42-aVh8EPsHnOjDNpIOYF38wY5bDehYW--ctmigfJ7Ij4JPeW31q7N8jw5mcESdLVm7kmLzg7enTsVNcJGb8IzENhHPTv7_VfjYZjg87D30FHtLyGp-h8c7uvqqSTtwA-PgRtvZGDALQ__Sn6hDw--rLYANiPZHzgOvqbd74LVcybeJO9_lZbymZcO1f-OI_G3jpCQ4DLxC3QbvhFM1-Z7Il6dFa0Cg9QTS0i6fRIujxAOMFsfl2j4JRfJ-F74iEWpiMez7SeGpaV2dx00xvLPk-aSH40ByYR0JMCMCX5SliaGPsAh4f4PEJEeCwh6r1rbYzmCIML943Z1EB3WMcV7O-KbVfyNo5qtXjT37RA2vC_3mLOwOehhcRDBvXcfXh0b_jMeySzzHy6P8uGk6Pj0ohuQLVt4qhAxKmMI9LVH3YC8NfEnF_cDcm8'];

             $ch = curl_init ();
             curl_setopt ($ch, CURLOPT_URL, 'http://oauth2server1/api/user/1');
             curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
             $result = curl_exec ($ch);
             curl_close($ch);

             return json_decode( (string)$result, true );
           }
          );

Route::get('/clientCredentialsGrantTokenRedirect',
           function()
           {

           }
          );

///////////// CLIENT CREDENTIALS GRANT TOKEN /////////////
