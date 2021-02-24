@extends('log::layout.app')
@section('content')
<div class="container-fluid">
    <main role="main" class="pt-3">
        <div class="page-header mb-4">
            <h1>Log [{{@$data['date']}}]</h1>
        </div>

        <div class="row">
            <div class="col-lg-2">
                <div class="date-col">

                    <ul>
                        <li class="date-head"><a>Date</a></li>
                        @isset($data['available_log_dates'])
                        @foreach($data['available_log_dates'] as $logDate)
                        <li @if($data['date']==$logDate) class="active" @endif><a href="{{url('system-log')}}?log={{$logDate}}">{{$logDate}}</a></li>
                        @endforeach
                        @endisset
                    </ul>
                </div>
            </div>

            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-10"></div>
                    <div class="col-lg-2">
                        <a href="{{url('download-log')}}/{{@$data['date']}}" class="btn btn-sm btn-success download_btn">
                            <i class="fa fa-download"></i> DOWNLOAD
                        </a>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="table-responsive">
                        <table id="entries" class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Environment</th>
                                    <th>Date</th>
                                    <th>type</th>
                                    <th>message</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data['logs'])
                                @foreach($data['logs'] as $key => $log)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><span class="{{env('APP_ENV') == 'production' ?  'badge badge-danger' : 'badge badge-primary'}}">{{$log['env']}}</span></td>
                                    <td>{{$log['timestamp']}}</td>
                                    <td><span class="{{$log['type'] == 'ERROR' ?  'badge badge-danger' : 'badge badge-primary'}}">{{$log['type']}}</span></td>
                                    <td>{{$log['message']}}</td>
                                </tr>
                                @endforeach
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </main>
</div>

@endsection