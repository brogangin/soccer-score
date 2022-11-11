@extends('layouts.main')

{{-- @php
    $collapseCount = 1;
@endphp --}}

@section('container')
    <div class="row mt-5 mb-5" id="collapse-parent">
        <div class="col-3"></div>
        <div class="container-fluid col-5 py-2 border-top border-5 border-white overflow-scroll rounded-3" style="height: 75vh; box-shadow: 0px 1.5px 10px 1px rgba(0, 0, 0, 0.3)">
            @include('partials.navtop')
        @foreach ($scores as $day)
        @foreach ($day as $country)
        @foreach ($country as $league)
        @php
            $i=null;
        @endphp
            <div class="container mb-2 pb-2 pt-1 bg-light rounded-3">
            @foreach ($league as $match)
                @empty($i)    
                <div class="row align-items-center mb-1">
                    <div class="ms-1 me-1 col-1">
                        @if ($match['league']['flag'] == null)
                        <img src="{{ $match['league']['logo'] }}" style="max-height: 30px; max-width: 30px;">                                        
                        @else
                        <img src="{{ $match['league']['flag'] }}" style="max-height: 30px; max-width: 30px;"> 
                        @endif
                    </div>
                    <div class="col ms-1">
                        <div class="fs-5 fw-bold">{{ $match['league']['name'] }}</div>
                        <div class="small">{{ $match['league']['country'] }}</div>
                    </div>
                </div>
                @php
                    $i=1;
                    @endphp
                @endempty
                <div class="row align-items-center mt-1 rounded-3 shadow-sm" style="height: 65px; background-color: #fff;">
                    <div class="col-2 text-center small">
                        @if ($match['fixture']['status']['short'] == 'TBD')
                            {{ date('H:i', $match['fixture']['timestamp']) }}
                        @elseif ($match['fixture']['status']['short'] == 'NS')
                            {{ date('H:i', $match['fixture']['timestamp']) }}    
                        @elseif ($match['fixture']['status']['short'] == '1H')
                            {{ $match['fixture']['status']['elapsed'] }}'
                        @elseif ($match['fixture']['status']['short'] == 'HT')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == '2H')
                            {{ $match['fixture']['status']['elapsed'] }}'
                        @elseif ($match['fixture']['status']['short'] == 'ET')
                            {{ $match['fixture']['status']['elapsed'] }}'
                        @elseif ($match['fixture']['status']['short'] == 'BT')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'P')
                            {{ $match['fixture']['status']['short'] }}'
                        @elseif ($match['fixture']['status']['short'] == 'FT')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'AET')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'PEN')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'SUSP')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'INT')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'PST')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'CANC')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'ABD')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'AWD')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'WO')
                            {{ $match['fixture']['status']['short'] }}
                        @elseif ($match['fixture']['status']['short'] == 'LIVE')
                            {{ $match['fixture']['status']['short'] }}
                        @endif
                    </div>
                    <div class="col-1 justify-content-end" style="margin-left: -0.75rem">
                        <div class="" ><img src="{{ $match['teams']['home']['logo']; }}" style="max-height: 20px; max-width: 20px;"></div>
                        <div style="height: 5px"></div>
                        <div class="" ><img src="{{ $match['teams']['away']['logo']; }}" style="max-height: 20px; max-width: 20px;"></div>    
                    </div>
                    <div class="col justify-content-start" style="margin-left: -0.25rem">
                        <div class="small">{{ $match['teams']['home']['name']; }}</div>
                        <div style="height: 5px"></div>
                        <div class="small">{{ $match['teams']['away']['name']; }}</div>   
                    </div>
                    <div class="col-2 text-center justify-content-end" style="margin-left: -0.25rem">
                        @if ($match['fixture']['timestamp'] <= time() && $match['fixture']['status']['short'] == 'NS')
                        <div class="small">RO</div>
                        @endif
                        <div class="small">{{ $match['goals']['home'] }}</div>
                        <div style="height: 5px"></div>
                        <div class="small">{{ $match['goals']['away'] }}</div>
                    </div>
                </div>
                
                
            @endforeach
            </div>
        @endforeach
        @endforeach
        @endforeach
        </div>
        {{-- <div class="col">
            <div class="row collapse collapse-horizontal rounded-3 shadow ms-1 text-center py-1" id="collapse{{ $collapseCount }}" data-bs-parent="#collapse-parent" style="width: 300px">
                
                    <div class="col-2">
                        <img src="{{ $statistic[0]['team']['logo'] }}" alt="{{ $statistic[0]['team']['name'] }}" class="mb-1" style="max-height: 20px; max-width: 20px;">
                        <small>
                        @foreach ($statistic[0]['statistics'] as $val1)
                            @if ($val1['value'] == null)
                                <div class="mt-1">0</div>
                            @else    
                                <div class="mt-1">{{ $val1['value'] }}</div>
                            @endif
                        @endforeach
                        </small>
                    </div>
                    <div class="col">
                        <br class="mb-1">
                        <small>
                        @foreach ($statistic[0]['statistics'] as $type)
                            <div class="mt-1">{{ $type['type'] }}</div>
                        @endforeach
                        </small>
                    </div>
                    <div class="col-2">
                        <img src="{{ $statistic[1]['team']['logo'] }}" alt="{{ $statistic[1]['team']['name'] }}" class="mb-1" style="max-height: 20px; max-width: 20px;">
                        <small>
                        @foreach ($statistic[1]['statistics'] as $val2)
                            @if ($val2['value'] == null)
                                <div class="mt-1">0</div>
                            @else    
                                <div class="mt-1">{{ $val2['value'] }}</div>
                            @endif
                        @endforeach
                        </small>
                    </div>
                
            </div>
            @php
                $collapseCount++;
            @endphp
        </div> --}}
    </div>
    {{-- @include('partials.navbot') --}}
@endsection 


{{-- @section('container')
<table class="table">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
      </tr>
    </thead>
    <tbody>
        @php
            $i=1;
        @endphp
    @foreach ($leagues as $league)
      <tr>
        <th scope="row">{{ $i }}</th>
        @php
            $i++;
        @endphp
        <td>{{ $league['league']['id'] }}</td>
        <td>{{ $league['league']['name'] }}</td>
        <td>{{ $league['league']['type'] }}</td>
        <td><img src="{{ $league['league']['logo'] }}" width="50"></td>
        <td>{{ $league['country']['name'] }}</td>
        <td>{{ $league['country']['code'] }}</td>
        <td>{{ $league['country']['flag'] }}</td>
      </tr>
    @endforeach
    </tbody>
  </table>
@endsection --}}

{{-- <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CUSTOM WIDGET</title>
        <link rel="stylesheet" href="api-football.css">
    </head>
    <body>
        <div id="wg-api-football-fixtures"
                    data-host="v3.football.api-sports.io"
                    data-refresh="0"
                    data-date="2022-05-02"
                    data-key="9ea5d11f76a81a70af58e71dcb667f81"
                    data-theme=""
                    data-show-errors="false"
                    class="api_football_loader">
        </div>
        <script
                    type="module"
                    src="https://widgets.api-sports.io/football/1.1.8/widget.js">
                </script>
    </body>
</html> --}}