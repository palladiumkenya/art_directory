@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">local_hospital</i>
                        </div>
                        <p class="card-category">Facilities</p>
                        <h3 class="card-title"> {{\App\Directory::count()}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons text-dark">list</i>
                            <a href="{{url('facilities')}}">View All Facilities</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-dark card-header-icon">
                        <div class="card-icon bg-dark">
                            <i class="material-icons">chat</i>
                        </div>
                        <p class="card-category">Incoming Messages</p>
                        <h3 class="card-title">{{\App\IncomingMsg::count()}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">list</i> <a href="{{url('messages/incoming')}}">
                                View All Incoming</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">chat_bubble_outline</i>
                        </div>
                        <p class="card-category">Outgoing Messages</p>
                        <h3 class="card-title">{{\App\OutgoingMsg::count()}}</h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">list</i> <a href="{{url('messages/outgoing')}}">View Outgoing</a>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                <div class="card card-stats">--}}
{{--                    <div class="card-header card-header-success card-header-icon">--}}
{{--                        <div class="card-icon">--}}
{{--                            <i class="material-icons">account_circle</i>--}}
{{--                        </div>--}}
{{--                        <p class="card-category">All Responses</p>--}}
{{--                        <h3 class="card-title"></h3>--}}
{{--                    </div>--}}
{{--                    <div class="card-footer">--}}
{{--                        <div class="stats">--}}
{{--                            <i class="material-icons">list</i> <a href="#">View Questionnaire responses</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
