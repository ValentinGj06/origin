@foreach ($years as $year)
@if(function_exists("nonzero"))
<td>{{ count(array_filter($payinTotal[$year], "nonzero")) }}</td>@endif
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
@endforeach