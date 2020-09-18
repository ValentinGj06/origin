<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\ClientInfo;
use App\ClientDetail;
use NumberFormatter;

use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{

	public function clientsByGender(Client $client) {

    	$labels = ClientInfo::select('gender as label', DB::raw('COUNT(gender) as data'))->groupBy('gender')->get();

    	$chartdata = new \stdClass();
    	$dataset = new \stdClass();
    	$chartdata->datasets = [];
    	foreach ($labels as $key => $value) {
    		if($value->label){
	    		if($value->label === 'M') {
	    			$chartdata->labels [] = 'Male';
	    		} elseif ($value->label === 'F'){
	    			$chartdata->labels [] = 'Female';
	    		}
	    		$dataset->data [] = $value->data;
	    		$dataset->backgroundColor [] = '#'.substr(md5(rand()), 0, 6);
	    	}
    	}
    		$chartdata->datasets [] = $dataset;

    	return response()->json($chartdata);
    }

    public function estimateByCategory(Client $client) {

        $query = DB::select("SELECT name as label, COUNT(*) as total, SUM(win) as loss, SUM(pay_in) as profit from `clients` 
        JOIN `category_client` ON `clients`.`id` = `category_client`.`client_id`
        JOIN `categories` ON `category_client`.`category_id` = `categories`.`id`
        JOIN `client_details` ON `clients`.`id` = `client_details`.`client_id`
        WHERE `clients`.`id` = `category_client`.`client_id`
        GROUP BY `name`");

        $chartdata = new \stdClass();
        $loss = new \stdClass();
        $profit = new \stdClass();
        $chartdata->datasets = [];
        foreach ($query as $key => $value) {
            $chartdata->labels [] = ucwords(str_replace('_', ' ', $value->label));
            $loss->label = 'Loss';
            $loss->data [] = $value->loss;
            $loss->backgroundColor = '#'.substr(md5(rand()), 0, 6);
            $profit->label = 'Profit';
            $profit->data [] = $value->profit;
            $profit->backgroundColor = '#'.substr(md5(rand()), 0, 6);
        }
            $chartdata->datasets [] = $loss;
            $chartdata->datasets [] = $profit;

        return response()->json($chartdata);

    }

    public function clientsByCity(Client $client) {

    	$labels = ClientInfo::select('city as label', DB::raw('COUNT(city) as data'))->groupBy('city')->get();

    	$chartdata = new \stdClass();
    	$dataset = new \stdClass();
    	$chartdata->datasets = [];
    	foreach ($labels as $key => $value) {
    		$chartdata->labels [] = $value->label;
    		$dataset->data [] = $value->data;
    		$dataset->backgroundColor [] = '#'.substr(md5(rand()), 0, 6);
    	}
    		$chartdata->datasets [] = $dataset;

    	return response()->json($chartdata);

    }

    public function topTen(Client $client) {

        // $fmtc = new NumberFormatter( 'mk_MK', \NumberFormatter::CURRENCY );
        // $fmt = new NumberFormatter( 'mk_MK', \NumberFormatter::DECIMAL );

        $query = DB::table('client_info')
            ->select('client_info.first_name', 'client_info.last_name', 'client_details.pay_in', 'client_details.win')
            ->join('client_details', 'client_info.client_id', '=', 'client_details.client_id')->take(5);
        if(request()->pay_in){
            $clients = $query->orderBy('pay_in', 'desc')->get();
        } else if(request()->win) {
            $clients = $query->orderBy('win', 'desc')->get();
        } 

        foreach ($clients as $key => $client) {
            $client->pay_in = fmtc_format($client->pay_in);
            $client->win = fmtc_format($client->win);
        } 

    	return $clients;

    }

    public function clientsByAge(Client $client) {

        $query = DB::select("SELECT
        CASE
            WHEN age < 20 THEN 'Под 20г'
            WHEN age BETWEEN 20 and 29 THEN '20 - 29г'
            WHEN age BETWEEN 30 and 39 THEN '30 - 39г'
            WHEN age BETWEEN 40 and 49 THEN '40 - 49г'
            WHEN age BETWEEN 50 and 59 THEN '50 - 59г'
            WHEN age BETWEEN 60 and 69 THEN '60 - 69г'
            WHEN age BETWEEN 70 and 79 THEN '70 - 79г'
            WHEN age >= 80 THEN 'Над 80г'
            WHEN age IS NULL THEN 'Not Filled In (NULL)'
        END as age_range,
        COUNT(*) AS count,
         CASE
            WHEN age < 20 THEN 1
            WHEN age BETWEEN 20 and 29 THEN 2
            WHEN age BETWEEN 30 and 39 THEN 3
            WHEN age BETWEEN 40 and 49 THEN 4
            WHEN age BETWEEN 50 and 59 THEN 5
            WHEN age BETWEEN 60 and 69 THEN 6
            WHEN age BETWEEN 70 and 79 THEN 7
            WHEN age >= 80 THEN 8
            WHEN age IS NULL THEN 9
        END as ordinal

        FROM (SELECT TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) AS age FROM client_info) as derived

        GROUP BY age_range

        ORDER BY ordinal");

        $chartdata = new \stdClass();
        $dataset = new \stdClass();
        $chartdata->datasets = [];
        foreach ($query as $key => $value) {
            $chartdata->labels [] = $value->age_range;
            $dataset->label = 'Број на корисници';
            $dataset->data [] = $value->count;
            $dataset->backgroundColor [] = '#'.substr(md5(rand()), 0, 6);
        }
            $chartdata->datasets [] = $dataset;

        return response()->json($chartdata);

    }

}
