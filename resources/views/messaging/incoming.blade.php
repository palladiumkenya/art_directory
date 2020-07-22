@extends('layouts.app')
@section('title', 'Incoming Messages')

@push('css')
    <style>
        .loader,
        .loader:after {
            border-radius: 50%;
            width: 10em;
            height: 10em;
            text-align: center;
            z-index: 1060;
            top: 45%;
            left: 45%;
            padding: 0 !important;
            margin: 0 !important;
        }
        .loader {
            margin: 0 auto;
            font-size: 10px;
            position: absolute;
            text-indent: -9999em;
            border-top: 1.1em solid rgba(255,0,0, 0.2);
            border-right: 1.1em solid rgba(255,0,0, 0.2);
            border-bottom: 1.1em solid rgba(255,0,0, 0.2);
            border-left: 1.1em solid #ff0000;
            -webkit-transform: translateZ(0);
            -ms-transform: translateZ(0);
            transform: translateZ(0);
            -webkit-animation: load8 1.1s infinite linear;
            animation: load8 1.1s infinite linear;
        }
        @-webkit-keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }
        @keyframes load8 {
            0% {
                -webkit-transform: rotate(0deg);
                transform: rotate(0deg);
            }
            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

    </style>
@endpush

@push('js')
    <script>
        $(function() {
            // server side - lazy loading
            $('#incoming-dt').DataTable({
                processing: true, // loading icon
                serverSide: true, // this means the datatable is no longer client side
                ajax: '{{ route('ajax-incoming-messages') }}', // the route to be called via ajax
                columns: [ // datatable columns
                    {data: 'source', name: 'source'},
                    {data: 'destination', name: 'destination'},
                    {data: 'msg', name: 'msg'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'processed', name: 'processed'},
                ],
                // columnDefs: [
                //     { searchable: false, targets: [5] },
                //     { orderable: false, targets: [5] }
                // ],
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Incoming",
                },
                order: [[0, 'desc']]
            });//end datatable
        });
    </script>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary card-header-icon">
                        <div class="card-icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <h4 class="card-title">
                            <a href="{{ url('messages/incoming') }}" class="text-muted">Incoming Messages</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        @include('layouts.common.success')
                        @include('layouts.common.warnings')
                        @include('layouts.common.warning')
                            <div class="loader" style="display: none;">Loading...</div>
                        <div class="material-datatables">
                            <table id="incoming-dt"
                                   class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>SOURCE</th>
                                    <th>DESTINATION</th>
                                    <th>MESSAGE</th>
                                    <th>CREATED AT</th>
                                    <th>PROCESSED</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>SOURCE</th>
                                    <th>DESTINATION</th>
                                    <th>MESSAGE</th>
                                    <th>CREATED AT</th>
                                    <th>PROCESSED</th>
                                </tr>
                                </tfoot>
                            </table>
                            <!-- end content-->
                        </div>
                        <!--  end card  -->
                    </div>
                </div>
                <!-- end col-md-12 -->
            </div>
            <!-- end row -->
        </div>
    </div>

@endsection
