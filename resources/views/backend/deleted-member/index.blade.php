@extends('backend.layout.app')

@section('title')
    {{ $title }}
@endsection
@section('mainContent')
<meta name="_token" content="{{ csrf_token() }}"/>
    <!-- the #js-page-content id is needed for some plugins to initialize -->
    <main id="js-page-content" role="main" class="page-content">
        <ol class="breadcrumb page-breadcrumb">
            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            <li class="breadcrumb-item">{{ $menu }}</li>
            <li class="breadcrumb-item active">{{ $title }}</li>
            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
        </ol>
        <div class="subheader">
            <h1 class="subheader-title">
                <a href="{{ route('member.create')}}" class="edit btn btn-success btn-md">Create Member</a>
            </h1>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div id="panel-1" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            <i class='subheader-icon fal fa-table'></i>{{ $title }}
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content">
                            <!-- datatable start -->
                            <table id="deleted_member_list" class="table table-bordered table-hover table-striped w-100">
                                <thead class="bg-primary-600">
                                    <tr>
                                        <th>Image</th>
                                        <th>Member ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Status</th>
                                        <th>Follower</th>
                                        <th>Profile Reported</th>
                                        <th>Featured</th>
                                        <th>Group</th>
                                        <th>Member Since</th>
                                        <th>Deleted At</th>
                                        <th>Deleted By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Member ID</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Status</th>
                                        <th>Follower</th>
                                        <th>Profile Reported</th>
                                        <th>Featured</th>
                                        <th>Group</th>
                                        <th>Member Since</th>
                                        <th>Deleted At</th>
                                        <th>Deleted By</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- datatable end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Modal center -->
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="" method="POST" id="updateGroupForm">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Updated Group
                            <small class="m-0 text-muted">
                                Select group to updated
                            </small>
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body" id="groupModalBody">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Package Modal Start --}}
    <div class="modal fade"  id="packageInfoModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Package Information
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="packageInfoBody">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="return planList()">Updated Package</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Package Modal End --}}
    {{-- update package modal start --}}
    <div class="modal fade"  id="updatePackageModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        Updated Package
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fal fa-times"></i></span>
                    </button>
                </div>
                <div class="modal-body" id="updatePackageBody">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="package">Choose Package</label>
                            <select name="package" id="package" class="form-control">
                                <?php $plans = DB::table('plans')->get(); ?>
                                @foreach ($plans as $plan)
                                    <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="timezone" id="timezone">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="return updatePackage()">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- update package modal end --}}
    <!-- this overlay is activated only when mobile menu is triggered -->
    <script>
        function restore(id){
            Swal.fire(
            {
                title: "Are you sure?",
                text: "You want to restore this memeber!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, restore it!"
            }).then(function(result)
            {
                if (result.value)
                {
                    window.location.href = '/weddings/deleted-member/'+id+'/edit';
                }else{
                    event.preventDefault();
                }
            });
        }

    </script>
@endsection
