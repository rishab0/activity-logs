@extends(env('header_path'))

@section(env('yield_name'))
<style>
    .log_view {
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

                                @forelse($activity as $key => $log)
                                <tr>
                                    <td>{{($activity->currentpage()-1) * $activity->perpage() + $key + 1}}</td>
                                    <td>{{$log->model}}</td>
                                    <td>{!! $log->getStatus() !!}</td>
                                    <td><button data-id="{{$log->_id}}" class="btn btn-default log_view"> view</button></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" align="center"> No logs Found !</td>
                                </tr>
                                @endforelse


                            </tbody>
                        </table>
                        {{$activity->links()}}
                    </div>
                </div>


            </div>
        </div>
    </main>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog" style="max-width: 1000px;">

        <!-- Modal content-->
        <div class="modal-content">
        </div>

    </div>
</div>

<script>
    $('.log_view').click(function() {
        $('.log_view').attr('disabled', true)
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
                $('.modal-content').html(result)
                $('#myModal').modal('show')
                
            }
        });
        $('.log_view').attr('disabled', false)
    });

    function DownloadJSON() {
        //Build a JSON array containing Customer records.
        var customers = $('.response').data('response')

        //Convert JSON Array to string.
        var json = JSON.stringify(customers);

        console.log(customers)

        //Convert JSON string to BLOB.
        json = [json];
        var blob1 = new Blob(json, {
            type: "text/plain;charset=utf-8"
        });

        //Check the Browser.
        var isIE = false || !!document.documentMode;
        if (isIE) {
            window.navigator.msSaveBlob(blob1, "Customers.txt");
        } else {
            var url = window.URL || window.webkitURL;
            link = url.createObjectURL(blob1);
            var a = document.createElement("a");
            a.download = "response.txt";
            a.href = link;
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }
    }
</script>


@endsection