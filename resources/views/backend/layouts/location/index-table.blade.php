<?php
        // $regionColspan = 2+(6 * count($years));
        // $fmtc new \NumberFormatter( 'mk_MK', \NumberFormatter::CURRENCY );
        // $fmt new \NumberFormatter( 'mk_MK', \NumberFormatter::DECIMAL );
        // $fmtce new \NumberFormatter( 'de_DE', \NumberFormatter::CURRENCY );
    ?>

<div style="overflow: overlay" class="table-responsive">
    <table style="text-align: center" class="table table-striped table-dark table-borderless">
        <thead>
            <!-- <colgroup>
                <col span="4" style="background-color:#961313">
                <col style="background-color:yellow">
            </colgroup> -->
            <tr>
                <th rowspan="2" colspan="4">Locations</th>
                @foreach ($years as $year)
                @if($year !== 2015)
                <th style="border-right: 2px solid" colspan="6">{{ $year }}</th>
                @else
                <th style="border-right: 2px solid" colspan="5">{{ $year }}</th>
                @endif
                @endforeach
            </tr>
            <tr>
                @foreach ($years as $year)
                @if($year !== 2015)
                <th style="border-right: 2px solid" colspan="6">Вкупно Локации: {{ count($response[$year]) }}</th>
                @else
                <th style="border-right: 2px solid" colspan="5">Вкупно Локации: {{ count($response[$year]) }}</th>
                @endif
                @endforeach
            </tr>
            <tr>
                <th>Location</th>
                <th style="min-width: 200px">Address</th>
                <th style="min-width: 79px">Started</th>
                <th style="min-width: 74px">Closed</th>
                @foreach ($years as $year)
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
            
            @endphp

            @foreach ($estimates as $key => $data)

            @if ($data->region === 1 && $data->region !== $region)
                <tr>
                    <td colspan="4">Битолски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 2 && $data->region !== $region)
                <tr>
                    <td colspan="4">Прилепски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 3 && $data->region !== $region)
                <tr>
                    <td colspan="4">Кавадаречки Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 4 && $data->region !== $region)
                <tr>
                    <td colspan="4">Кичевски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 5 && $data->region !== $region)
                <tr>
                    <td colspan="4">Скопски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 6 && $data->region !== $region)
                <tr>
                    <td colspan="4">Велешки Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 7 && $data->region !== $region)
                <tr>
                    <td colspan="4">Струмички Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 8 && $data->region !== $region)
                <tr>
                    <td colspan="4">Валандовски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 9 && $data->region !== $region)
                <tr>
                    <td colspan="4">Штипско-Кочански Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 10 && $data->region !== $region)
                <tr>
                    <td colspan="4">Радовишки Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 11 && $data->region !== $region)
                <tr>
                    <td colspan="4">Гевгелиски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 12 && $data->region !== $region)
                <tr>
                    <td colspan="4">Кумановски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 13 && $data->region !== $region)
                <tr>
                    <td colspan="4">Охридски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 14 && $data->region !== $region)
                <tr>
                    <td colspan="4">Струшки Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 15 && $data->region !== $region)
                <tr>
                    <td colspan="4">Дебарски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 16 && $data->region !== $region)
                <tr>
                    <td colspan="4">Тетовски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 17 && $data->region !== $region)
                <tr>
                    <td colspan="4">Гостиварски Регион</td>
                </tr>
                @php $region = $data->region @endphp
            @elseif ($data->region === 18 && $data->region !== $region)
                <tr>
                    <td colspan="4">Останати</td>
                </tr>
                @php $region = $data->region @endphp
            @endif

            <tr>
                <td>{{ $data->location }}</td>
                <td style="min-width: 200px">{{ $data->address }}</td>
                <td style="min-width: 79px">{{ $data->date_start ?? '*' }}</td>
                <td style="min-width: 74px">{{ $data->date_end ?? '*' }}</td>
                @foreach ($years as $year)
                <td 
                    title="{{ $year === 2015 ? '' : ($data->{$year-1}->payin == 0 || $data->{$year}->payin == 0 ? '' : round( (($data->{$year}->payin - $data->{$year-1}->payin)*100)/$data->{$year-1}->payin,2) .'%') }}"

                    style="{{ $year === 2015 ? '' : ($data->{$year-1}->payin === 0 || $data->{$year}->payin === 0 ? '' :($data->{$year}->payin > $data->{$year-1}->payin ? 'background: green' : 'background: #961313')) }}"
                >{{ fmtc_format($data->{$year}->payin) }}</td>
                <td 
                    style="{{ $year === 2015 ? '' : ($data->{$year-1}->payinCount === 0 || $data->{$year}->payinCount === 0 ? '' :($data->{$year}->payinCount > $data->{$year-1}->payinCount ? 'background: green' : 'background: #961313')) }}"
                >{{ fmt_format($data->{$year}->payinCount) }}</td>
                <td>{{ fmtc_format($data->{$year}->payout + $data->{$year}->payoutTax) }}</td>
                <td>{{ fmt_format($data->{$year}->payoutCount) }}</td>
                <td>{{ fmtc_format($data->{$year}->payin - ($data->{$year}->payout + $data->{$year}->payoutTax)) }}</td>
                @if($year !== 2015)
                <td style="border-right: 2px solid">{{ fmt_format($data->{$year}->payinCount - $data->{$year-1}->payinCount) }}</td>
                @endif
                
                @endforeach
            </tr>
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
                <td colspan="4">Тотал</td>
                @foreach ($years as $year)
                    <td
                        title="{{ $year === 2015 ? '' : (array_sum($payinTotal[$year-1]) == 0 || array_sum($payinTotal[$year]) == 0 ? '' : round( ((array_sum($payinTotal[$year]) - array_sum($payinTotal[$year-1]))*100)/array_sum($payinTotal[$year-1]),2) .'%') }}"

                        style="{{ $year === 2015 ? '' : (array_sum($payinTotal[$year]) > array_sum($payinTotal[$year-1]) ? 'background: green !important' : 'background: #961313 !important') }}"
                    >{{ fmtc_format(array_sum($payinTotal[$year])) }}</td>
                    <td
                        style="{{ $year === 2015 ? '' : (array_sum($payinCountTotal[$year]) > array_sum($payinCountTotal[$year-1]) ? 'background: green !important' : 'background: #961313 !important') }}"
                    >{{ fmt_format(array_sum($payinCountTotal[$year])) }}</td>
                    <td>{{ fmtc_format(array_sum($payoutTotal[$year])) }}</td>
                    <td>{{ fmt_format(array_sum($payoutCountTotal[$year])) }}</td>
                    <td>{{ fmtc_format(array_sum($payinPayoutTotal[$year])) }}</td>
                    @if($year !== 2015)
                    <td style="border-right: 2px solid">{{ fmt_format(array_sum($payinPayoutCountTotal[$year])) }}</td>
                    @endif

                    @php
                        
                        $total += array_sum($payinPayoutTotal[$year]); 

                    @endphp
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div id="filter_message" class="col-md-3">Total:&nbsp;
    <span style="color: black" id="total" type="button" class="btn badge badge-pill badge-success mr-1">{{ fmtc_format($total/61.5, "€") }}</span>
</div>