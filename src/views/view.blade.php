<style>
    .bold {
        font-weight: bold;
        color: grey;
        font-size: 20px;
    }
</style>
<div class="modal-header">
    <h2>View log</h2>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">

    <div class="container-fluid">
        <main role="main" class="pt-3">
            <div class="row">

                <div class="col-lg-3">
                    <p class="bold">Module</p>
                    <p>{{$activity->model}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">Activity</p>
                    <p>{!! $activity->getStatus() !!}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">Message</p>
                    <p>{{$activity->msz}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">IP</p>
                    <p>{{$activity->ip_address}}</p>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p class="bold">Country</p>
                    <p>{{$activity->ip_country}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">City</p>
                    <p>{{$activity->ip_city}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">Region</p>
                    <p>{{$activity->ip_region}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">lat</p>
                    <p>{{$activity->ip_lat}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <p class="bold">long</p>
                    <p>{{$activity->ip_long}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">URL</p>
                    <p><a href="{{@$activity->url}}" target="_blank">Link to edit</a></p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">TimeZone</p>
                    <p>{{$activity->timezone}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">Created at</p>
                    <p>{{$activity->created_at}}</p>
                </div>
                <div class="col-lg-3">
                    <p class="bold">Activity by</p>
                    <p>{{$activity->created_by}}</p>
                </div>
            </div>
        </main>
    </div>

</div>
<div class="modal-footer">
    <a data-response="{{json_encode($activity->response)}}" class="response" onclick="DownloadJSON()">
         Download response <i class="fa fa-download"></i>
    </a>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>