@extends(env('header_path'))

@section(env('yield_name'))

    <div class="container-fluid">
        <main role="main" class="pt-3">
            <div class="page-header mb-4">
                <h1>Log</h1>
            </div>

            <div class="row">


                <div class="col-lg-12">
                    <form action="{{ url('/activity-log') }}" method="post">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Module</label>
                                    <select name="module" id="" class="form-control">
                                        <option value="">Select Module</option>
                                        @foreach ($moduleList as $module_name)
                                            <option value="{{ $module_name['model'] }}" @if ($module_name['model'] == $module) selected
                                        @endif>{{ $module_name['model'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="">Activity</label>
                                    <select name="activityS" id="" class="form-control">
                                        <option value="">Select Activity</option>
                                        @foreach ($statusList as $status_name)
                                            <option value="{{ $status_name['status'] }}" @if ($status_name['status'] == $activityS) selected
                                        @endif >{{ ucfirst($status_name['status']) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Created at</label>
                                    <input type="date" class="form-control" name="created_at" value="{{ @$created_at }}">
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="">Activity by</label>
                                    <select name="activity_by" id="" class="form-control">
                                        <option value="">Select Activity</option>
                                        @foreach ($createdByList as $created_by)
                                            <option value="{{ $created_by['created_by'] }}" @if ($created_by['created_by'] == $activity_by) selected
                                        @endif>{{ $created_by['created_by'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <input type="submit" value="Search" class="btn btn-success custom_btn">
                                </div>
                            </div>
                            <div class="col-lg-1">
                                <div class="form-group">
                                    <a href="{{ url('/activity-log') }}" class="btn btn-danger custom_btn">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-12">

                    <div class="card mb-4">

                        <div class="table-responsive">
                            <table id="entries" class="table mb-0">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Module</th>
                                        <th>Activity</th>
                                        <th>IP</th>
                                        <th>Location</th>
                                        <th>Activity by</th>
                                        <th>Created at</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse($activity as $key => $log)
                                        <tr>
                                            <td>{{ ($activity->currentpage() - 1) * $activity->perpage() + $key + 1 }}</td>
                                            <td>{{ $log->model }}</td>
                                            <td>{!! $log->getStatus() !!}</td>
                                            <td>{{ $log->ip_address }}</td>
                                            <td>{{ @$log->ip_country ? $log->ip_country . '/' . $log->ip_city . '/' . $log->ip_region : '---' }}
                                            </td>
                                            <td>{{ @$log->created_by }}</td>
                                            <td>{{ @$log->created_at }}</td>
                                            <td><button data-id="{{ $log->_id }}" class="btn btn-default log_view">
                                                    view</button></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" align="center"> No logs Found !</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                            {{-- {{ $activity->links() }} --}}
                            {{ $activity->appends(['module' => $module, 'activityS' => $activityS, 'created_at' => $created_at, 'activity_by' => $activity_by ])->render() }}

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
