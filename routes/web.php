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
		   	$query = http_build_query(['client_id' => '4',
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
		   			                ['form_params' => ['client_id' => '4',
		   											   'client_secret' => 'RfVD1eckCrEpGqIppokjMfoIswQsNcgkWZ17ERdr',
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
	         		                    ['headers' => ['Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjVjYjZlZGFmNzQ2MDIxZjNmODdmNDRjYWY3NTIwMmI0ZGQ3ZGJiMThmZGUwY2VkMWYzNWQxNWZmMWMyOWRlYTdjOTVlMWMzNmQ3MTM3NmMwIn0.eyJhdWQiOiI0IiwianRpIjoiNWNiNmVkYWY3NDYwMjFmM2Y4N2Y0NGNhZjc1MjAyYjRkZDdkYmIxOGZkZTBjZWQxZjM1ZDE1ZmYxYzI5ZGVhN2M5NWUxYzM2ZDcxMzc2YzAiLCJpYXQiOjE0OTg4NzM3MjMsIm5iZiI6MTQ5ODg3MzcyMywiZXhwIjoxNDk4ODczNzgzLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.d0WpTauGogy_52Kj5QU0pmRnBw7LGpmYFwsjZ5bw7SwHHarwyxBRHMOJay7fTBJdKinsONb-9rA5RftttlzNQrtr5VkHg_Xxn_0BW6hg9kR0LsFvq29ZqCsCXoDOao5VoVlfvb-3xy6oTfnhmc5dx_80dSpW8m31hCmlfFrgguCua5rC0hDw6Gd1Nkjg2mkFD-X26YGlPpSFWuNV3L5rHWnYop0-KId6IxqVOgoBHbpYTd0wFT3w8Pk5yoKRpDhJAUly465F-ZgPXt3giBPBidrtjWdVYc1NlZQqlYgxNXkT7pVVGsqCPF2w20aL6qr-FU9izoCmf4UGOeomFfOljLk_RMvbeSDmkdyVzp78pUl7LTjwYWGObjPrPw9XdyDnOanKowFZ5nY4CRSTlxARBJVmQZPRkuRAM---yRs576MqudVMoqiHG9BgKfw_KHjiCaTzpiC7TFrNEu1QNr-9os3s63N8mm9bs7fjzd6VNZvNW4w3AiOVLZC83jxLVPOl4Adi2aBho5OqKRREq3hql9lOZeOXtM7oQB4Mm4OZRM8vVLiO-7ywo3g0VRr1UHnRjr8h2fyF4k48F8Gg9tCrha6ofc8xjO3QS29r5J3FA-FqnBjBO_7BzWj-BCWt7aMsyVcGzi6FO5MKlkM6pUFpvVRQDblBJFAnatc7JG5OhTE'
	         		                                  ]
	         		                    ]
	         		                   );
	         /*
	         echo "<pre>";
	         var_dump( ['statusCode'   => $response->getStatusCode(),
	         		    'reasonPhrase' => $response->getReasonPhrase(),
     	         		'header'       => $response->getHeader('Content-Length'),
	         		    'body'         => $response->getBody(),
	         		    'bodyContents' => $response->getBody()->getContents()
	                   ] 
	         		 );
	         exit();
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

Route::get('/refreshToken',
		   function()
		   {
		   	 $http = new GuzzleHttp\Client;
		   	
		   	 $response = $http->post('http://oauth2server1/oauth/token', 
		   	 		                  ['form_params' => ['grant_type' => 'refresh_token',
									   					 'refresh_token' => 'QJ/TJ7VcLGub0EZVWpPEmrNf+526r38aCB2L4/zYXWql3ENT4y2LjbqAlg5hDEengZNyi4dE9OB/Cyk9VErHomhGWPhzCTY74chqLrLB5ATq5XTzdoghc92U1O9iDiP/AThcUPOxNx3Y3UXmz2mJ3UnGF2EnpbD3Q2imx4JICN601UHW+EiOSC/OHy5nq0eWPqNYWkT/EYL+uPYLg1j9rCf4laFQGwyiyDo1A+5jYtl+XWion7RevG2polZeW0F+QTT1ivxFiplhFmZkOYVmt8aFMxxDzz1rqp8qghGh+vbF4zquuI0/sI+5ZYow59buIQkaxS4fpjryQg5uZctjt28TxLxogNBIhuEjSbx2douTUY4p6Bnxeh7+o1fy++visFjsc3G8G15GogrmH7/p5rGPafRF93G4SJNO5z4407Docv+b1lBbX6d84WC2YVR636wyclUR3cGWs6meEMSp5Mu5P9okapi+IedQrtVWXPE2miJ629feYAVrqXz63hg0dRmmaYPubq3A/9YKCfxcDFYBr27CXg+R2/MIfwgzJHHA/nTossQppuA6E+nyDf0iAfZis804XKgC8KASSYvPUPmuOTjtiHULKHWMV339b29l048pulACww0WzyFSIl/iLBnZVdVplUW9Gu0c1ps50LyWKVdPtfL5XPLv6m+hiRk=',
									   					 'client_id' => '4',
									   					 'client_secret' => 'RfVD1eckCrEpGqIppokjMfoIswQsNcgkWZ17ERdr',
									   					 'scope' => '',
									   			        ],
		   	                          ]
		   	 		                );

		   	return json_decode((string) $response->getBody(), true);
           }
		  );
