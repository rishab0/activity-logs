@extends('log::layout.app')
@section('content')
<style>
    .bold {
        font-weight: bold;
        color: grey;
        font-size: 20px;
    }
</style>
<div class="container-fluid">
    <main role="main" class="pt-3">
        <div class="page-header mb-4">
            <h1>Log [{{@$date}}]</h1>
        </div>

        <div class="row">

            <div class="col-lg-3">
                <p class="bold">Type</p>
                <p>{{$activity->model}}</p>
            </div>
            <div class="col-lg-3">
                <p class="bold">class</p>
                <p>{!! $activity->getStatus() !!}</p>
            </div>
            <div class="col-lg-3">
                <p class="bold">Message</p>
                <p>{{$activity->user}}</p>
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
                <p class="bold">TimeZone</p>
                <p>{{$activity->timezone}}</p>
            </div>
            <div class="col-lg-3">
                <p class="bold">Created At</p>
                <p>{{$activity->created_at}}</p>
            </div>
        </div>
    </main>
</div>

@endsection