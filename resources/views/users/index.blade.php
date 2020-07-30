@extends('layouts.app')
@section('title', 'All Users')
@push('js')
    <script>

        $(function() {
            // server side - lazy loading
            $('#users-dt').DataTable({
                processing: true, // loading icon
                serverSide: true, // this means the datatable is no longer client side
                ajax: '{{ route('users-dt') }}', // the route to be called via ajax
                columns: [ // datatable columns
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'role', name: 'role'},
                    {data: 'email', name: 'email'},
                ],
                /*columnDefs: [
                    {searchable: false, targets: [5]},
                    {orderable: false, targets: [5]}
                ],*/
                "pagingType": "full_numbers",
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                responsive: true,
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search Users",
                },
                "order": [[0, "desc"]]
            });

            // live search



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
                            <i class="material-icons">list</i>
                        </div>
                        <h4 class="card-title">All Users</h4>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#user-modal">
                                <i class="fa fa-plus"></i> Add New User
                            </button>
                        </div>
                        @include('layouts.common.success')
                        @include('layouts.common.warnings')
                        <div id="successView" class="alert alert-success" style="display:none;">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <strong>Success!</strong><span id="successData"></span>
                        </div>
                        <div class="material-datatables">
                            <table id="users-dt" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Email</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>

    {{--modal--}}
    <div class="modal fade" id="user-modal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"> {{ $edit ?'Edit' : 'Add' }} New User</h4>
                </div>
                <div class="modal-body" >
                    <form id="userform" action="{{ url('enroll') }}" method="post" id="edit-product-form" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{--spoofing--}}
                        @if($edit)
                            {{ method_field('PUT') }}
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="mobile_no2">Name</label>
                                    <input type="text" value="{{ $edit ? $selected_user->name : old('name') }}" class="form-control" id="name" name="name" required" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    {{--<label class="control-label" for="user_role" style="line-height: 6px;">User Role</label>--}}

                                    <div class="col-lg-6 col-md-6 col-sm-3">
                                        <div class="dropdown bootstrap-select show-tick">
                                            <select class="selectpicker" data-style="select-with-transition" title="Choose User Group" data-size="7" tabindex="-98"
                                                    name="user_role" id="user_role" required>
                                                @foreach( $user_roles as $user_role)
                                                    <option value="{{ $user_role->id  }}">{{ $user_role->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-lg-6 col-md-6 col-sm-3">
                                <div class="dropdown bootstrap-select show-tick">
                                    <select class="selectpicker" data-style="select-with-transition" title="Choose Sub County" data-size="7" tabindex="-98"
                                            name="sub_county_id" id="sub_county_id" required>
                                        @foreach( \App\SubCounty::all() as $subcounty)
                                            <option value="{{ $subcounty->id  }}">{{ $subcounty->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                            <div class="col-lg-6 col-md-6 col-sm-3">
                                <div class="dropdown bootstrap-select show-tick">
                                    <select class="selectpicker" data-style="select-with-transition" title="Choose Sub County" data-size="7" tabindex="-98"
                                            name="sub_county_id" id="sub_county_id" required>
                                        @foreach( \App\SubCounty::all() as $subcounty)
                                            <option value="{{ $subcounty->id  }}">{{ $subcounty->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="email">Email</label>
                                    <input type="email" value="{{$edit ? $selected_user->email :  old('email') }}" class="form-control pb-0 mt-2" name="email" id="email" required/>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="password"> Password </label>
                                    <input type="password" class="form-control" id="password" name="password" />
                                </div>
                            </div>
                        </div>



                        <input type="hidden" name="id"/>
                        <div class="form-group">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="material-icons">close</i> Close</button>
                            <button class="btn btn-success" id="save-brand"><i class="material-icons">save</i> Save</button>
                        </div>

                    </form>
                    {{--hidden fields--}}

                </div>

                <!--<div class="modal-footer">-->
                <!---->
                <!--</div>-->
            </div>
        </div>
    </div>
@endsection
