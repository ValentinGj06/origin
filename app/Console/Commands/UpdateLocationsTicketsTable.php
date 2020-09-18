<?php

namespace App\Console\Commands;

use App\Location;
use App\Ticket;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;

class UpdateLocationsTicketsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:locationsTickets';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert or Update Locations Tickets Data';

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
    public function handle(Location $location, Ticket $ticket)
    {
        // $regionsJson = Storage::disk('public')->get('regions.json');

        // $regionsJson = json_decode($regionsJson);
        
            $result = Storage::disk('public')->get('01.12.2015.json');


            $result = json_decode($result);

        foreach ($result->ETicketStatList as $key => $value) {

            $locationsId = '';
                $locationModel = $location->firstOrCreate(
                    ['location' => $value->location],[
                        'location_address' => $value->locationAddress,
                        'date_opened' => date('Y-m-d'),
                        'date_closed' => date('Y-m-d'),
                    ]);
                $locationsId = $locationModel->id;

                $ticket->firstOrCreate(
                    [   
                        'location_id' => $locationsId,
                        'date' => $value->day
                    ],
                    [
                        'terminal' => $value->terminal,
                        'pay_in' => $value->payIn,
                        'win' => $value->win,
                        'difference' => $value->difference,
                        'pay_out' => $value->payout,
                        'balance' => $value->balance,
                        'storno' => $value->storno,
                        'pay_in_count' => $value->payinCount,
                        'pay_out_count' => $value->payoutCount,
                        'storno_count' => $value->stornoCount,
                        'ccy' => $value->ccy,
                        'win_count' => $value->winCount,
                        'win_tax_amount' => $value->winTaxAmount,
                        'source' => $value->source,
                        'date' => $value->day,
                        'payoutUntaxed' => $value->payoutUntaxed,
                        'paymentTax' => $value->paymentTax
                    ]);
        }

        // return response()->json();

    }
}
