<?php

namespace App\Http\Controllers;

use App\Location;
use App\Entries;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function index() {

        $client = new Client(); //GuzzleHttp\Client
        if (request()->has('datefilter') && request()->datefilter) {

            $datefilter = explode(' - ', request()->datefilter);

            $from = date_create($datefilter[0]);
            $from = date_format($from, 'm/d/Y');

            $to = date_create($datefilter[1]);
            $to = date_format($to, 'm/d/Y');

            $year = date('Y', strtotime($to))+0;

        } else {

            $from = date('m/d/Y'); /* "01/01/2020" */
            $to = date('m/d/Y'); /* "12/31/2020" */
            // $from = "01/01/".date('Y');
            // $to = "12/31/".date('Y'); 
            $year = date('Y')+0;

        }

        if (request()->has('regions') && request()->regions) {

            foreach (request()->regions as $key => $value) {
                $reg [] = explode(':', $value);
            }

            foreach ($reg as $region) {
                $regions [] = $region[1];
            }

            $regions = array_map('intval', $regions);

        } else {

            $regions = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18];

        }

        $yearActive = 2015;

        $json = (object) ["location" => 0, "payin" => 0, "payout" => 0, "payoutTax" => 0, "payinCount" => 0, "payoutCount" => 0
        ];

        for ($i=$year; $i >= $yearActive; $i--) { 

            $years [] = $i;
            $yearsTotal [] = $i;

            /* START - getting the results from api */

            // $fromDay = date("d/m/Y", strtotime($from));
            // $toDay = date("d/m/Y", strtotime($to));

            // $result = $client->request('GET', 'http://164.40.250.10:8080/bet-admin-ws/rest/ticketStats.json?uName=al&pWord=klub77bet&fromDay='.$fromDay.'&toDay='.$toDay.''
            // );
            // $response[$year] = json_decode($result->getBody())->entries;
            // $locations[$year] = json_decode($result->getBody())->entries;

            /* END - getting the results from api */

            /* START - For getting the results from database */

            $fromDay = date("Y-m-d", strtotime($from));
            $toDay = date("Y-m-d", strtotime($to));

            $result = DB::table('locations as l')
                ->select('location', 'location_address as address', DB::raw('SUM(payin) as payin'), DB::raw('SUM(payout) as payout'), DB::raw('SUM(payoutTax) as payoutTax'), DB::raw('SUM(payinCount) as payinCount'), DB::raw('SUM(payoutCount) as payoutCount'))
                ->join('entries as e', 'e.location_id', '=', 'l.id' )
                ->whereBetween('date', [$fromDay, $toDay])
                ->groupBy('location', 'location_address')
                ->get();
            
            $response[$year] = json_decode($result);
            $locations[$year] = json_decode($result);

            /* END - For getting the results from database */

            $year--;
            $from = date("m/d/Y",strtotime("-1 year",strtotime($from)));
            $to = date("m/d/Y",strtotime("-1 year",strtotime($to)));
        }
        // return response()->json($response);

        if (request()->has('years') && request()->years) {

            $years = array_map('intval', request()->years);

        }

        $regionsJson = Storage::disk('public')->get('regions.json');
        // $regionsJson = file_get_contents('file:///C:/xampp/htdocs/origin/public/storage/regions.json');
            $regionsJson = json_decode($regionsJson);

            $regionBitola = $regionsJson->regions->regionBitola;
            $regionPrilep = $regionsJson->regions->regionPrilep;
            $regionKavadarci = $regionsJson->regions->regionKavadarci;
            $regionKicevo = $regionsJson->regions->regionKicevo;
            $regionSkopje = $regionsJson->regions->regionSkopje;
            $regionVeles = $regionsJson->regions->regionVeles;
            $regionStrumica = $regionsJson->regions->regionStrumica; 
            $regionValandovo = $regionsJson->regions->regionValandovo; 
            $regionStipKocani = $regionsJson->regions->regionStipKocani; 
            $regionRadovis = $regionsJson->regions->regionRadovis; 
            $regionGevgelija = $regionsJson->regions->regionGevgelija; 
            $regionKumanovo = $regionsJson->regions->regionKumanovo; 
            $regionOhrid = $regionsJson->regions->regionOhrid; 
            $regionStruga = $regionsJson->regions->regionStruga; 
            $regionDebar = $regionsJson->regions->regionDebar; 
            $regionTetovo = $regionsJson->regions->regionTetovo;
            $regionGostivar = $regionsJson->regions->regionGostivar;

        foreach ($locations as $value) {
            foreach ($value as $data) {
                unset($data->payin, $data->payout, $data->payoutTax, $data->payoutCount, $data->payinCount);

                if(strposa($data->address, $regionBitola)) {
                    $data->region = 1;
                } else if (strposa($data->address, $regionPrilep)) {
                    $data->region = 2;
                } else if (strposa($data->address, $regionKavadarci)) {
                    $data->region = 3;
                } else if (strposa($data->address, $regionKicevo)) {
                    $data->region = 4;
                } else if (strposa($data->address, $regionSkopje)) {
                    $data->region = 5;
                } else if (strposa($data->address, $regionVeles)) {
                    $data->region = 6;
                } else if (strposa($data->address, $regionStrumica)) {
                    $data->region = 7;
                } else if (strposa($data->address, $regionValandovo)) {
                    $data->region = 8;
                } else if (strposa($data->address, $regionStipKocani)) {
                    $data->region = 9;
                } else if (strposa($data->address, $regionRadovis)) {
                    $data->region = 10;
                } else if (strposa($data->address, $regionGevgelija)) {
                    $data->region = 11;
                } else if (strposa($data->address, $regionKumanovo)) {
                    $data->region = 12;
                } else if (strposa($data->address, $regionOhrid)) {
                    $data->region = 13;
                } else if (strposa($data->address, $regionStruga)) {
                    $data->region = 14;
                } else if (strposa($data->address, $regionDebar)) {
                    $data->region = 15;
                } else if (strposa($data->address, $regionTetovo)) {
                    $data->region = 16;
                } else if (strposa($data->address, $regionGostivar)) {
                    $data->region = 17;
                } else {
                    $data->region = 18;
                }

                if (!strposa($data->address, 'Test')) {
                    $location [] = $data;
                }
            }
        }

        $location = array_map('json_encode', $location);
        $location = array_unique($location);
        $location = array_map('json_decode', $location);
        // usort($location, fn($a, $b) => $a->region - $b->region ?: $a->location - $b->location);

        usort($location, function($a, $b) {
            return $a->region - $b->region ?: $a->location - $b->location;
        });

        // return response()->json($locations);

        foreach ($location as $info) {
            if(in_array($info->region, $regions)) {
                $estimates [] = $info;
            }
        }

        // return response()->json($estimates);

        foreach ($response as $year => $value) {
            foreach ($value as $data) {
                foreach ($estimates as $info) {
                    if($data->location !== $info->location) {
                        $info->$year = $json;
                    }
                }               
            }
        }

        foreach ($response as $year => $value) {
            if (empty($value)) {
                $value [] = $json;
            }
                // dd($value);
            foreach ($value as $data) {
                foreach ($estimates as $info) {
                    if($data->location === $info->location) {
                        $info->$year = $data;
                    } elseif($data->location === 0) {
                        $info->$year = $json;    
                    }
                }
            }
        }
        // return response()->json($estimates);

        foreach ($response as $year => $value) {
            foreach ($value as $data) {
                unset($data->location, $data->address);
            }
        }

        // return response()->json($estimates);

        return view('backend/auth/location/index')->with([
            'years' => $years,
            'yearsTotal' => $yearsTotal,
            'response' => $response,
            'estimates' => $estimates]);
    }

    public function growth() {
       
        // $fmtc new \NumberFormatter( 'mk_MK', \NumberFormatter::CURRENCY );
        // $fmt new \NumberFormatter( 'mk_MK', \NumberFormatter::DECIMAL );

        $client = new Client(); //GuzzleHttp\Client
        if (request()->has('growth') && request()->growth) {

            $from = "01/01/".date('Y');
            $to = "12/31/".date('Y'); 
            $year = date('Y')+0;

            /*$datefilter = explode(' - ', request()->datefilter);

            $from = date_create($datefilter[0]);
            $from = date_format($from, 'm/d/Y');

            $to = date_create($datefilter[1]);
            $to = date_format($to, 'm/d/Y');

            $year = date('Y', strtotime($to))+0;*/

        } else {
            /* Need to be the day before, for getting data from database */
            $from = date('m/d/Y'); /* "01/01/2020" */
            $to = date('m/d/Y'); /* "12/31/2020" */
            // $from = "01/01/".date('Y');
            // $to = "12/31/".date('Y'); 
            $year = date('Y')+0;

        }

        if (request()->has('regions') && request()->regions) {

            foreach (request()->regions as $key => $value) {
                $reg [] = explode(':', $value);
            }

            foreach ($reg as $region) {
                $regions [] = $region[1];
            }

            $regions = array_map('intval', $regions);

        } else {

            $regions = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18];

        }

        $yearActive = 2015;

        $json = (object) ["location" => 0, "payin" => 0, "payout" => 0, "payoutTax" => 0, "payinCount" => 0, "payoutCount" => 0
        ];

        for ($i=$year; $i >= $yearActive; $i--) { 

            $years [] = $i;
            
            /* START - getting the results from api */

            $fromDay = date("d/m/Y", strtotime($from));
            $toDay = date("d/m/Y", strtotime($to));

            $result = $client->request('GET', 'http://164.40.250.10:8080/bet-admin-ws/rest/ticketStats.json?uName=al&pWord=klub77bet&fromDay='.$fromDay.'&toDay='.$toDay.''
            );
            $response[$year] = json_decode($result->getBody())->entries;
            $locations[$year] = json_decode($result->getBody())->entries;

            /* END - getting the results from api */

            /* START - getting the results from database */

            // $fromDay = date("Y-m-d", strtotime($from));
            // $toDay = date("Y-m-d", strtotime($to));

            // $result = DB::table('locations as l')
                // ->select('location', 'location_address as address', DB::raw('SUM(payin) as payin'), DB::raw('SUM(payout) as payout'), DB::raw('SUM(payoutTax) as payoutTax'), DB::raw('SUM(payinCount) as payinCount'), DB::raw('SUM(payoutCount) as payoutCount'))
                // ->join('entries as e', 'e.location_id', '=', 'l.id' )
                // ->whereBetween('date', [$fromDay, $toDay])
                // ->groupBy('location', 'location_address')
                // ->get();
            
            // $response[$year] = json_decode($result);
            // $locations[$year] = json_decode($result);

            /* END - getting the results from database */

            $year--;
            $from = date("m/d/Y",strtotime("-1 year",strtotime($from)));
            $to = date("m/d/Y",strtotime("-1 year",strtotime($to)));
        }

        if (request()->has('years') && request()->years) {

            $years = array_map('intval', request()->years);

        }

            $regionsJson = Storage::disk('public')->get('regions.json');
            $regionsJson = json_decode($regionsJson);

            $regionBitola = $regionsJson->regions->regionBitola;
            $regionPrilep = $regionsJson->regions->regionPrilep;
            $regionKavadarci = $regionsJson->regions->regionKavadarci;
            $regionKicevo = $regionsJson->regions->regionKicevo;
            $regionSkopje = $regionsJson->regions->regionSkopje;
            $regionVeles = $regionsJson->regions->regionVeles;
            $regionStrumica = $regionsJson->regions->regionStrumica; 
            $regionValandovo = $regionsJson->regions->regionValandovo; 
            $regionStipKocani = $regionsJson->regions->regionStipKocani; 
            $regionRadovis = $regionsJson->regions->regionRadovis; 
            $regionGevgelija = $regionsJson->regions->regionGevgelija; 
            $regionKumanovo = $regionsJson->regions->regionKumanovo; 
            $regionOhrid = $regionsJson->regions->regionOhrid; 
            $regionStruga = $regionsJson->regions->regionStruga; 
            $regionDebar = $regionsJson->regions->regionDebar; 
            $regionTetovo = $regionsJson->regions->regionTetovo;
            $regionGostivar = $regionsJson->regions->regionGostivar;

        foreach ($locations as $value) {
            foreach ($value as $data) {
                unset($data->payin, $data->payout, $data->payoutTax, $data->payoutCount, $data->payinCount);

                if(strposa($data->address, $regionBitola)) {
                    $data->region = 1;
                } else if (strposa($data->address, $regionPrilep)) {
                    $data->region = 2;
                } else if (strposa($data->address, $regionKavadarci)) {
                    $data->region = 3;
                } else if (strposa($data->address, $regionKicevo)) {
                    $data->region = 4;
                } else if (strposa($data->address, $regionSkopje)) {
                    $data->region = 5;
                } else if (strposa($data->address, $regionVeles)) {
                    $data->region = 6;
                } else if (strposa($data->address, $regionStrumica)) {
                    $data->region = 7;
                } else if (strposa($data->address, $regionValandovo)) {
                    $data->region = 8;
                } else if (strposa($data->address, $regionStipKocani)) {
                    $data->region = 9;
                } else if (strposa($data->address, $regionRadovis)) {
                    $data->region = 10;
                } else if (strposa($data->address, $regionGevgelija)) {
                    $data->region = 11;
                } else if (strposa($data->address, $regionKumanovo)) {
                    $data->region = 12;
                } else if (strposa($data->address, $regionOhrid)) {
                    $data->region = 13;
                } else if (strposa($data->address, $regionStruga)) {
                    $data->region = 14;
                } else if (strposa($data->address, $regionDebar)) {
                    $data->region = 15;
                } else if (strposa($data->address, $regionTetovo)) {
                    $data->region = 16;
                } else if (strposa($data->address, $regionGostivar)) {
                    $data->region = 17;
                } else {
                    $data->region = 18;
                }

                if (!strposa($data->address, 'Test')) {
                    $location [] = $data;
                }
            }
        }

        $location = array_map('json_encode', $location);
        $location = array_unique($location);
        $location = array_map('json_decode', $location);
        // usort($location, fn($a, $b) => $a->region - $b->region ?: $a->location - $b->location);

        usort($location, function($a, $b) {
            return $a->region - $b->region ?: $a->location - $b->location;
        });

        foreach ($location as $info) {
            if(in_array($info->region, $regions)) {
                $estimates [] = $info;
            }
        }

        // return response()->json($estimates);

        foreach ($response as $year => $value) {
            foreach ($value as $data) {
                foreach ($estimates as $info) {
                    if($data->location !== $info->location) {
                        $info->$year = $json;
                    }
                }               
            }
        }

        foreach ($response as $year => $value) {
            if (empty($value)) {
                $value [] = $json;
            }
                // dd($value);
            foreach ($value as $data) {
                foreach ($estimates as $info) {
                    if($data->location === $info->location) {
                        $info->$year = $data;
                    } elseif($data->location === 0) {
                        $info->$year = $json;    
                    }
                }
            }
        }

        foreach ($response as $year => $value) {
            foreach ($value as $data) {
                unset($data->location, $data->address);
            }
        }

        foreach ($estimates as $key => $data) {
            foreach ($years as $year) {
            
                $payinTotal[$year] [] = $data->{$year}->payin;
                $payinCountTotal[$year] [] = $data->{$year}->payinCount;
                $payoutTotal[$year] [] = $data->{$year}->payout + $data->{$year}->payoutTax;
                $payoutCountTotal[$year] [] = $data->{$year}->payoutCount;
                $payinPayoutTotal[$year] [] = $data->{$year}->payin - ($data->{$year}->payout + $data->{$year}->payoutTax);
                if($year !== 2015) {
                    $payinPayoutCountTotal[$year] [] = $data->{$year}->payinCount - $data->{$year-1}->payinCount;
                }
            
                $total[$year]['payinTotal'] = array_sum($payinTotal[$year]);
                $total[$year]['payinCountTotal'] = array_sum($payinCountTotal[$year]);
                $total[$year]['payoutTotal'] = array_sum($payoutTotal[$year]);
                $total[$year]['payoutCountTotal'] = array_sum($payoutCountTotal[$year]);
                $total[$year]['payinPayoutTotal'] = array_sum($payinPayoutTotal[$year]);
                if($year !== 2015) {
                    $total[$year]['payinPayoutCountTotal'] = array_sum($payinPayoutCountTotal[$year]);
                }
            }
        }

        if(request()->growth) {
            $total = array_reverse($total, true);
            $chartdata = new \stdClass();
            $growth = new \stdClass();
            $chartdata->datasets = [];
            foreach ($total as $key => $value) {
                $chartdata->labels [] = $key;
                $growth->label = 'Profit Growth';
                $growth->data [] = round($value['payinPayoutTotal'], 2);
                // $growth->backgroundColor = '#'.substr(md5(rand()), 0, 6);
                // $growth->borderColor = '#'.substr(md5(rand()), 0, 6);
                // $growth->lineTension = 0;
                // $growth->borderWidth = 3;
                // $growth->fill = false;
            }
                $chartdata->datasets [] = $growth;

            return response()->json($chartdata);

        } elseif(request()->todayTotal) {
            
            $todayTotal = new \stdClass();

            $todayTotal->payinTotal ['name'] = 'Уплата';
            $todayTotal->payinTotal ['number'] = fmtc_format($total[date('Y')]['payinTotal']);

            $todayTotal->payinCountTotal ['name'] = 'Тикети-Уплата';
            $todayTotal->payinCountTotal ['number'] = fmt_format($total[date('Y')]['payinCountTotal']);

            $todayTotal->payoutTotal ['name'] = 'Исплата';
            $todayTotal->payoutTotal ['number'] = fmtc_format($total[date('Y')]['payoutTotal']);

            $todayTotal->payoutCountTotal ['name'] = 'Тикети-Исплата';
            $todayTotal->payoutCountTotal ['number'] = fmt_format($total[date('Y')]['payoutCountTotal']);


            return response()->json($todayTotal);
        }

        return ([
            'years' => $years,
            'response' => $response,
            'estimates' => $estimates,
            'total' => $total]);
    }

function test(Location $location, Entries $entries) {
        $client = new Client(); //GuzzleHttp\Client

        $fromDay = '17/09/2020';/*date("d/m/Y", strtotime($from));*/
        $toDay = '17/09/2020';/*date("d/m/Y", strtotime($to));*/

        $result = $client->request('GET', 'http://164.40.250.10:8080/bet-admin-ws/rest/ticketStats.json?uName=al&pWord=klub77bet&fromDay='.$fromDay.'&toDay='.$toDay.''
        );

        $result = json_decode($result->getBody())->entries;

        foreach ($result as $value) {

            $locationsId = '';
                $locationModel = $location->firstOrCreate(
                    ['location' => $value->location],[
                        'location_address' => $value->address,
                        'date_opened' => date('Y-m-d'),
                        'date_closed' => date('Y-m-d'),
                    ]);
                $locationsId = $locationModel->id;

                $entries->firstOrCreate(
                    [   
                        'location_id' => $locationsId,
                        'date' => '2020-09-17'
                    ],
                    [
                        'payin' => $value->payin,
                        'payout' => $value->payout,
                        'payoutTax' => $value->payoutTax,
                        'payinCount' => $value->payinCount,
                        'payoutCount' => $value->payoutCount,
                        'date' => '2020-09-17'
                    ]);
        }
        
        return "Updated Successful";

    }
}