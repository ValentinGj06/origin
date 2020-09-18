<?php

namespace App\Console\Commands;

use App\Location;
use App\Entries;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class UpdateLocationsEntriesTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:locationsEntries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert or Update Locations Entries Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Location $location, Entries $entries)
    {
        $client = new Client(); //GuzzleHttp\Client

        $fromDay = '01/12/2015';/*date("d/m/Y", strtotime($from));*/
        $toDay = '01/12/2015';/*date("d/m/Y", strtotime($to));*/

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
                        'date' => '2015-12-01'
                    ],
                    [
                        'payin' => $value->payin,
                        'payout' => $value->payout,
                        'payoutTax' => $value->payoutTax,
                        'payinCount' => $value->payinCount,
                        'payoutCount' => $value->payoutCount,
                        'date' => '2015-12-01'
                    ]);
        }
    }
}
