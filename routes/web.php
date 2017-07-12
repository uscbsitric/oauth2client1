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
	         		                         ['headers' => ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU1ODNiZTM2NDAyNWZhOTJlMzY3M2VlM2E4YWIxZWZjZDk5ODI5MTliZDJhOTQ4ZGQzYmI0ZTdlZjVhMTY4ODBlNzQwOGEwZmI1ZmZhMDk3In0.eyJhdWQiOiI2IiwianRpIjoiZTU4M2JlMzY0MDI1ZmE5MmUzNjczZWUzYThhYjFlZmNkOTk4MjkxOWJkMmE5NDhkZDNiYjRlN2VmNWExNjg4MGU3NDA4YTBmYjVmZmEwOTciLCJpYXQiOjE0OTk4NTExODEsIm5iZiI6MTQ5OTg1MTE4MSwiZXhwIjoxNTMxMzg3MTgxLCJzdWIiOiIiLCJzY29wZXMiOltdfQ.OVxZWnIB85UjSkt2uEVGDJ0eUN9CjwBkbPLwuNzP4yLOsLmJoT3cGHPK7ZZh3isXhZK49Fi1xOCnrsjg_XBNNS2USk7z9JGmIUFIem_8biXqL4YARy2RVZAZEDuS1c1liTDAcBX8bG1p3Tc-nT8xCAt3trnNl7u0aGq3iIqOz-YU_--3_So3uJz4NowddEDYmS5luEvp79ck1wO39QAXrCXshuTwQjCy9SRxwO7AZuKaq56bTYKgPTvAFssp96tXXzRl1piVmtHhWmC90LcuAbsAEg6Xpna7uAGKqnhRvLB2PbOr0YUab4FqToPuOrqflmAtdmdpEiYN031saCTsIuKZvlCEU1sWhddcuFbzX16fumP_I6nd2lF_SKK4h3ReN8Y58O_qV2jmoQ7IIPuXghd6LZcmH2rZLOGPjFEB9kdZeNe7L5Ov53ZhecLDFg3v9OKTk4N5p3cSf0_bkp0ksaLGhg0FGygB_w_KPmP3Xa9JxwtrOAZgVOw0kZC--rD60AJBcVK05eCg81l12dSZejlzSoaZ5pe8ZeEjoDBfMW5EIgQjYCKY9WpLLedGPNaWoR3rPXjhOqfd36NV3p9yHuRK5iV7_Co6zUiDSTQRtnH7m0JgUxb2ZK31ofQxiceRVfx4GfNp53-VBSZAQa3vWcnI92FMemj6WucQo55STME'
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
                                                          'client_id' => '7',
                                                          'client_secret' => 'dxF7GZebPEPE3vl47UApuDwXOziZlo5xl6Jx5fe9',
                                                          'scope' => '',
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
             $header = ['Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImJmZDlmMTNhMTk0MzVhMGNhZmFjMGFlYTMwMzMzM2EyMmY3NjdjYzIyZGEwYmEwYzVkNmM4ZDRiYTcxMjQ0MWU0ZDVhMzA3YWUyZTY1YzNjIn0.eyJhdWQiOiI3IiwianRpIjoiYmZkOWYxM2ExOTQzNWEwY2FmYWMwYWVhMzAzMzMzYTIyZjc2N2NjMjJkYTBiYTBjNWQ2YzhkNGJhNzEyNDQxZTRkNWEzMDdhZTJlNjVjM2MiLCJpYXQiOjE0OTk4NTk1OTksIm5iZiI6MTQ5OTg1OTU5OSwiZXhwIjoxNTMxMzk1NTk5LCJzdWIiOiIiLCJzY29wZXMiOltdfQ.WD6EuHQWt83DPhcIkj3oePg6Ml2RQtKlh8b2-coBh18fHaOF2tIN0YMgUYST1s_j3XQp5EMhwa8EBOHpS11V6KZ6nKlko1PCNfyFp6I-Aqkxa6N0fWGfW9X2Ndgr7VwSZ9sFyQjR_kiYa_ZTdKIEAN4h7-03YBjYcizqEHFU1h04qno11g80czowVqiR5Z4d07UHnOt1adpdOLSJhRCon2rVBnM4vfmg78Cl4mHEp7O3WtcpowliRwZvIgjGxh7wmE7V4vFlejfqc75LKr6cE9gQnusjnSlQ-tATckYXDvptAe0EkhyzY9UOpMsselrftMlBfWVE8AYFO49duyxmi_jrptzVwVLqLrxw3ZR4zSjq14dDquCm_7nhsLMK6n28fXt76Kb7hz0KYbPhAIqt9OYHQeINpknCRyxNuEaFAPYWeiyW-X-2yF5Qt0xQP8Ab-63TJ7nTUShnSyikVL6gZ0tPLcp3b_ldWPq02VbPb6klU_65VNhG_uB1HBLmorjTCt9J0rODk6lNX6wTvwZgBAl_ehC82SoNQzwyVdnXlB-kwOeIlOO8qv7dX0DKYYrQK7p0LpzvtWOBULCuGwm5K14Hj13jyUaGiyWEQKY8uBc3LjTODdzAnqDIVOCnyInXv4q3llGU9eQkNMrFk4FavshtwBzMrtZzYKf32X_GiJM'];

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
