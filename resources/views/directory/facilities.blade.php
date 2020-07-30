@extends('layouts.app')
@section('title', 'Facilities')

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
            $('#facilities-dt').DataTable({
                processing: true, // loading icon
                serverSide: true, // this means the datatable is no longer client side
                ajax: '{{ route('ajax-facilities') }}', // the route to be called via ajax
                columns: [ // datatable columns
                    {data: 'mfl_code', name: 'mfl_code'},
                    {data: 'facility_name', name: 'facility_name'},
                    {data: 'county', name: 'county'},
                    {data: 'sub_county', name: 'sub_county'},
                    {data: 'facility_phone', name: 'facility_phone'},
                    {data: 'actions', name: 'actions'}
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
                    searchPlaceholder: "Search Facility",
                },
                order: [[0, 'desc']]
            });//end datatable

            var seasonModalTitle = $('#facility-modal-title'),
                seasonSpoofInput = $('#facility-spoof-input'),
                seasonForm = $('#facility-form');

            // add  season
            $('#add-facility-btn').on('click', function() {
                seasonModalTitle.text('Add');
                seasonSpoofInput.attr('disabled', 'disabled');
                // productForm.find('input.form-control, select').val('');
                seasonForm.attr('action', seasonForm.attr('source'));
            });
            // edit   product
            $(document).on('click', '.edit-facility-btn', function() {
                var seasonBtn = $(this);
                var season_id = seasonBtn.attr('acs-id'),
                    seasonForm = $('#facility-form');

                if (season_id !== '') {
                    $.ajax({
                        url: seasonBtn.attr('source'),
                        type: 'get',
                        dataType: 'json',
                        beforeSend: function() {
                            seasonModalTitle.text('Edit');
                            seasonSpoofInput.removeAttr('disabled');
                        },
                        success: function(data) {
                            console.log(data);
                            // populate the modal fields using data from the server
                            $('#facility_name').val(data['facility_name']);
                            $('#mfl_code').val(data['mfl_code']);
                            $('#facility_phone').val(data['facility_phone']);
                            $('#partner').val(data['partner']);
                            $('#county').val(data['county']);
                            $('#sub_county').val(data['sub_county']);
                            $('#location').val(data['location']);
                            $('#sub_location').val(data['sub_location']);
                            $('#alt_facility_phone').val(data['alt_facility_phone']);
                            $('#email_address').val(data['email_address']);
                            $('#clinic').val(data['clinic']);
                            $('#id').val(data['id']);

                            // set the update url
                            var action =  seasonForm .attr('action');
                            // action = action + '/' + season_id;
                            console.log(action);
                            seasonForm .attr('action', action);

                            // open the modal
                            $('#facility-modal').modal('show');
                        }
                    });
                }
            });

            $(document).on('submit', '.del_facility_form', function() {
                if (confirm('Are you sure you want to delete this facility?')) {
                    return true;
                }
                return false;
            });
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
                            <a href="{{ url('directory') }}" class="text-muted">All Facilities</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        @if(auth()->user()->role->has_perm([6]))
                            <div class="toolbar">
                                <button class="btn btn-primary btn-sm" id="add-facility-btn" data-toggle="modal" data-target="#facility-modal">
                                    <i class="fa fa-plus"></i> Add Facility
                                </button>
                            </div>
                        @endif


                        @include('layouts.common.success')
                        @include('layouts.common.warnings')
                        @include('layouts.common.warning')
                            <div class="loader" style="display: none;">Loading...</div>
                        <div class="material-datatables">
                            <table id="facilities-dt"
                                   class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                <tr>
                                    <th>MFL CODE</th>
                                    <th>NAME</th>
                                    <th>COUNTY</th>
                                    <th>SUB-COUNTY</th>
                                    <th>PHONE NO.</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>MFL CODE</th>
                                    <th>NAME</th>
                                    <th>COUNTY</th>
                                    <th>SUB-COUNTY</th>
                                    <th>PHONE NO.</th>
                                    <th class="disabled-sorting text-right">Actions</th>
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

    {{--modals--}}
    <div class="modal fade" id="facility-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><span id="facility-modal-title">Add </span> Facility</h4>
                </div>
                <div class="modal-body" >
                    <form action="{{ url('facilities') }}" method="post" id="facility-form"  enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" id="facility-spoof-input" value="PUT" disabled/>

                        <div class="form-group">
                            <label class="control-label" for="facility_name">Facility Name <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="facility_name" name="facility_name"required/>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label" for="mfl_code">MFL Code <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="mfl_code" name="mfl_code"required/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" for="facility_phone">Phone No. <span style="color: red">*</span></label>
                                    <input type="number" class="form-control" id="facility_phone" name="facility_phone"required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="alt_facility_phone">Alternate Phone No. </label>
                            <input type="number" class="form-control" id="alt_facility_phone" name="alt_facility_phone"/>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="email_address">E-mail Address <span style="color: red">*</span></label>
                            <input type="email" class="form-control" id="email_address" name="email_address" required/>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label" for="county">County <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="county" name="county"required/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" for="sub_county">Sub County <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="sub_county" name="sub_county"required/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label" for="county">Location </label>
                                    <input type="text" class="form-control" id="location" name="location"/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" for="sub_location">Sub Location</label>
                                    <input type="text" class="form-control" id="sub_location" name="sub_location"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="control-label" for="clinic">Clinic <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="clinic" name="clinic"required/>
                                </div>

                                <div class="col-sm-6">
                                    <label class="control-label" for="partner">Partner <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" id="partner" name="partner"required/>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="id" id="id"/>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                            <button class="btn btn-success" id="save-brand"><i class="material-icons">save</i> Save</button>
                        </div>
                    </form>
                </div>

                <!--<div class="modal-footer">-->
                <!---->
                <!--</div>-->
            </div>
        </div>
    </div>
@endsection
