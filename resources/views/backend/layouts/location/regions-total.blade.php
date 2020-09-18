@foreach ($years as $year)
    <td>{{ count(array_filter($payinTotal[$data->region][$year], "nonzero")) }}</td>
    <td
        title="{{ $year === 2015 ? '' : (array_sum($payinTotal[$data->region][$year-1]) == 0 || array_sum($payinTotal[$data->region][$year]) == 0 ? '' : round( ((array_sum($payinTotal[$data->region][$year]) - array_sum($payinTotal[$data->region][$year-1]))*100)/array_sum($payinTotal[$data->region][$year-1]),2) .'%') }}"

        style="{{ $year === 2015 ? '' : (array_sum($payinTotal[$data->region][$year]) > array_sum($payinTotal[$data->region][$year-1]) ? 'background: green !important' : 'background: #961313 !important') }}"
    >{{ fmtc_format(array_sum($payinTotal[$data->region][$year])) }}</td>
    <td
        style="{{ $year === 2015 ? '' : (array_sum($payinCountTotal[$data->region][$year]) > array_sum($payinCountTotal[$data->region][$year-1]) ? 'background: green !important' : 'background: #961313 !important') }}"
    >{{ fmt_format(array_sum($payinCountTotal[$data->region][$year])) }}</td>
    <td>{{ fmtc_format(array_sum($payoutTotal[$data->region][$year])) }}</td>
    <td>{{ fmt_format(array_sum($payoutCountTotal[$data->region][$year])) }}</td>
    <td>{{ fmtc_format(array_sum($payinPayoutTotal[$data->region][$year])) }}</td>
    @if($year !== 2015)
    <td style="border-right: 2px solid">{{ fmt_format(array_sum($payinPayoutCountTotal[$data->region][$year])) }}</td>
    @endif
@endforeach