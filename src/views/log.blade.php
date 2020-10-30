@extends(env('header_path'))

@section(env('yield_name'))
<style>
    .log_view{
        cursor: pointer;
    }
</style>
    <div class="container-fluid">
        <main role="main" class="pt-3">
            <div class="page-header mb-4">
                <h1>Log</h1>
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
                                        <td><a class="log_view" data-id="{{$log->_id}}">view</a></td>
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

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h2>View log</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Some text in the modal.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('.log_view').click(function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/view-log',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    'id': id
                },
                success: function(result) {
                    $('.modal-body').html(result)
                    $('#myModal').modal('show')
                }
            });
        });
    </script>


@endsection
