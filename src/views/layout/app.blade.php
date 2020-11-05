<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="LogViewer">
    <meta name="author" content="ARCANEDEV">
    <title>Activity logs - Created by Softuvo</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700|Source+Sans+Pro:400,600' rel='stylesheet' type='text/css'>
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            font-size: .875rem;
            margin-bottom: 60px;
        }

        .main-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 60px;
            line-height: 60px;
            background-color: #E8EAF6;
        }

        .main-footer p {
            margin-bottom: 0;
        }

        .main-footer .fa.fa-heart {
            color: #C62828;
        }

        .page-header {
            border-bottom: 1px solid #8a8a8a;
        }

        /*
         * Navbar
         */

        .navbar-brand {
            padding: .75rem 1rem;
            font-size: 1rem;
        }

        .navbar-nav .nav-link {
            padding-right: .5rem;
            padding-left: .5rem;
        }

        /*
         * Boxes
         */

        .box {
            display: block;
            padding: 0;
            min-height: 70px;
            background: #fff;
            width: 100%;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: .25rem;
        }

        .box>.box-icon>i,
        .box .box-content .box-text,
        .box .box-content .box-number {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .box>.box-icon {
            border-radius: 2px 0 0 2px;
            display: block;
            float: left;
            height: 70px;
            width: 70px;
            text-align: center;
            font-size: 40px;
            line-height: 70px;
            background: rgba(0, 0, 0, 0.2);
        }

        .box .box-content {
            padding: 5px 10px;
            margin-left: 70px;
        }

        .box .box-content .box-text {
            display: block;
            font-size: 1rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            font-weight: 600;
        }

        .box .box-content .box-number {
            display: block;
        }

        .box .box-content .progress {
            background: rgba(0, 0, 0, 0.2);
            margin: 5px -10px 5px -10px;
        }

        .box .box-content .progress .progress-bar {
            background-color: #FFF;
        }

        /*
         * Log Menu
         */

        .log-menu .list-group-item.disabled {
            cursor: not-allowed;
        }

        .log-menu .list-group-item.disabled .level-name {
            color: #D1D1D1;
        }

        /*
         * Log Entry
         */

        .stack-content {
            color: #AE0E0E;
            font-family: consolas, Menlo, Courier, monospace;
            white-space: pre-line;
            font-size: .8rem;
        }

        /*
         * Colors: Badge & Infobox
         */

        .badge.badge-env,
        .badge.badge-level-all,
        .badge.badge-level-emergency,
        .badge.badge-level-alert,
        .badge.badge-level-critical,
        .badge.badge-level-error,
        .badge.badge-level-warning,
        .badge.badge-level-notice,
        .badge.badge-level-info,
        .badge.badge-level-debug,
        .badge.empty {
            color: #FFF;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.3);
        }

        .badge.badge-level-all,
        .box.level-all {
            background-color: #8A8A8A;
        }

        .badge.badge-level-emergency,
        .box.level-emergency {
            background-color: #B71C1C;
        }

        .badge.badge-level-alert,
        .box.level-alert {
            background-color: #D32F2F;
        }

        .badge.badge-level-critical,
        .box.level-critical {
            background-color: #F44336;
        }

        .badge.badge-level-error,
        .box.level-error {
            background-color: #FF5722;
        }

        .badge.badge-level-warning,
        .box.level-warning {
            background-color: #FF9100;
        }

        .badge.badge-level-notice,
        .box.level-notice {
            background-color: #4CAF50;
        }

        .badge.badge-level-info,
        .box.level-info {
            background-color: #1976D2;
        }

        .badge.badge-level-debug,
        .box.level-debug {
            background-color: #90CAF9;
        }

        .badge.empty,
        .box.empty {
            background-color: #D1D1D1;
        }

        .badge.badge-env {
            background-color: #6A1B9A;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark sticky-top bg-dark p-0">
        <a href="{{url('/activity-log')}}" class="navbar-brand mr-0">
            <i class="fa fa-fw fa-book"></i> Activity logs
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a href="{{url('/activity-log')}}" class="nav-link">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{env('APP_URL')}}" target="_blank" class="nav-link">
                        <i class="fa fa-home"></i> {{env('APP_NAME')}}
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    @yield('content')

    <footer class="main-footer">
        <div class="container-fluid">
            <p class="text-muted pull-left">
                LogReporting - <span class="badge badge-info">version 2.2.2</span>
            </p>
            <p class="text-muted pull-right">
                Created with <i class="fa fa-heart"></i> Softuvo <sup>&copy;</sup>
            </p>
        </div>
    </footer>


    <script src="https://code.jquery.com/jquery-3.2.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>

   
</body>

</html>