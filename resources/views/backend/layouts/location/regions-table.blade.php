<?php
        // $regionColspan = 2+(6 * count($years));
        // $fmtc = new \NumberFormatter( 'mk_MK', \NumberFormatter::CURRENCY );
        // $fmt = new \NumberFormatter( 'mk_MK', \NumberFormatter::DECIMAL );
        // $fmtce = new \NumberFormatter( 'de_DE', \NumberFormatter::CURRENCY );
    ?>

<div style="overflow: overlay" class="table-responsive">
    <table style="text-align: center" class="table table-striped table-dark table-borderless">
        <thead>
            <!-- <colgroup>
                <col span="4" style="background-color:#961313">
                <col style="background-color:yellow">
            </colgroup> -->
            <tr>
                <th rowspan="2">Regions</th>
                @foreach ($years as $year)
                @if($year !== 2015)
                <th style="border-right: 2px solid" colspan="7">{{ $year }}</th>
                @else
                <th style="border-right: 2px solid" colspan="6">{{ $year }}</th>
                @endif
                @endforeach
            </tr>
            
            <tr>
                @foreach ($years as $year)
                <th>Locations</th>
                <th>PayIn</th>
                <th>PayInCount</th>
                <th>PayOut</th>
                <th>PayOutCount</th>
                <th>PayIn-Out</th>
                @if($year !== 2015)
                <th style="border-right: 2px solid">{{ substr($year, 2) }} - {{ substr($year-1, 2) }}</th>
                @endif
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php 

                $region = 0; 
                $total = 0;

                function nonzero($var){ 
                    return ($var > 0); 
                }

            @endphp

            @foreach ($estimates as $key => $data)
                @foreach ($yearsTotal as $yearTotal)
                    @php 
                        $payinTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payin;
                        $payinCountTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payinCount;
                        $payoutTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payout + $data->{$yearTotal}->payoutTax;
                        $payoutCountTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payoutCount;
                        $payinPayoutTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payin - ($data->{$yearTotal}->payout + $data->{$yearTotal}->payoutTax);
                        if($yearTotal !== 2015) {
                            $payinPayoutCountTotal[$data->region][$yearTotal] [] = $data->{$yearTotal}->payinCount - $data->{$yearTotal-1}->payinCount;
                        }
                    @endphp
                @endforeach
            @endforeach
            @foreach($estimates as $key => $data)
            @if ($data->region === 1 && $data->region !== $region)
                <tr class="region">
                    <td>Битолски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 2 && $data->region !== $region)
                <tr class="region">
                    <td>Прилепски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 3 && $data->region !== $region)
                <tr class="region">
                    <td>Кавадаречки Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 4 && $data->region !== $region)
                <tr class="region">
                    <td>Кичевски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 5 && $data->region !== $region)
                <tr class="region">
                    <td>Скопски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 6 && $data->region !== $region)
                <tr class="region">
                    <td>Велешки Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 7 && $data->region !== $region)
                <tr class="region">
                    <td>Струмички Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 8 && $data->region !== $region)
                <tr class="region">
                    <td>Валандовски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 9 && $data->region !== $region)
                <tr class="region">
                    <td>Штипско-Кочански Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 10 && $data->region !== $region)
                <tr class="region">
                    <td>Радовишки Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 11 && $data->region !== $region)
                <tr class="region">
                    <td>Гевгелиски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 12 && $data->region !== $region)
                <tr class="region">
                    <td>Кумановски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 13 && $data->region !== $region)
                <tr class="region">
                    <td>Охридски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 14 && $data->region !== $region)
                <tr class="region">
                    <td>Струшки Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 15 && $data->region !== $region)
                <tr class="region">
                    <td>Дебарски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 16 && $data->region !== $region)
                <tr class="region">
                    <td>Тетовски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 17 && $data->region !== $region)
                <tr class="region">
                    <td>Гостиварски Регион</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 18 && $data->region !== $region)
                <tr class="region">
                    <td>Останати</td>
                    @include('backend.layouts.location.regions-total')
                </tr>
                @php $region = $data->region @endphp
            @endif
                @foreach ($yearsTotal as $yearTotal)
                    @php 
                        $payinTotal[$yearTotal] [] = $data->{$yearTotal}->payin;
                        $payinCountTotal[$yearTotal] [] = $data->{$yearTotal}->payinCount;
                        $payoutTotal[$yearTotal] [] = $data->{$yearTotal}->payout + $data->{$yearTotal}->payoutTax;
                        $payoutCountTotal[$yearTotal] [] = $data->{$yearTotal}->payoutCount;
                        $payinPayoutTotal[$yearTotal] [] = $data->{$yearTotal}->payin - ($data->{$yearTotal}->payout + $data->{$yearTotal}->payoutTax);
                        if($yearTotal !== 2015) {
                            $payinPayoutCountTotal[$yearTotal] [] = $data->{$yearTotal}->payinCount - $data->{$yearTotal-1}->payinCount;
                        }
                    @endphp
                @endforeach
            @endforeach
            <tr class="total">
                <td>Тотал</td>
                    @include('backend.layouts.location.total-table-component')
            </tr>
        </tbody>
    </table>
</div>