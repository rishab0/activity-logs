@extends('log::layout.app')
@section('content')
    <div class="container-fluid">
        <main role="main" class="pt-3">
            <div class="page-header mb-4">
                <h1>Log [{{@$date}}]</h1>
            </div>

            <div class="row">
                
                <div class="col-lg-12">

                    


                    <div class="card mb-4">

                        <div class="table-responsive">
                            <table id="entries" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>model</th>                                                                                
                                        <th>Log</th>                                                                                
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($activity as $key => $log)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$log->model}}</td>
                                        <td>{!! $log->getStatus() !!}</td>
                                        <td><a href="{{url('view-log')}}/{{$log->_id}}">edit</a></td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </main>
    </div>

@endsection
