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
                <a href="{{ route('member.create')}}" class="btn btn-success btn-md" title="Add New Member">Add New Member</a>
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
                            <table id="member_list" class="table table-bordered table-hover table-striped w-100">
                                <thead class="bg-primary-600">
                                    <tr>
                                        <th>Image</th>
                                        <th>Member ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Follower</th>
                                        <th>Profile Reported</th>
                                        <th>Group</th>
                                        <th>Featured</th>
                                        <th>Package</th>
                                        <th>Member Since</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Image</th>
                                        <th>Member ID</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Follower</th>
                                        <th>Profile Reported</th>
                                        <th>Group</th>
                                        <th>Featured</th>
                                        <th>Package</th>
                                        <th>Member Since</th>
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
    <!--Group Modal Start-->
    <div class="modal fade" id="groupModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
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
                    <button type="submit" data-dismiss="modal" onclick="return changeGroup()" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--Group Modal End-->
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
            <form name="updatePackageModalForm" onsubmit="return updatePackageModalFormSubmit(event)">
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
                                <label for="package">Choose Package <span class="text-danger"> *</span></label>
                                <select name="package" id="package" class="form-control" onchange="return getPlanAmount()" required>
                                    <?php $plans = DB::table('plans')->get(); ?>
                                    <option value="">Choose one</option>
                                    @foreach ($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="timezone" id="timezone">
                            </div>
                            <div class="col-md-12">
                                <label for="total">Package Price <span class="text-danger"> *</span></label>
                                <input type="text" name="total" id="total" class="form-control" readonly>
                            </div>
                            <div class="col-md-12">
                                <label for="paid">Paid Amount <span class="text-danger"> *</span></label>
                                <input type="text" name="paid" id="paid" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="payment_type">Payment Type <span class="text-danger"> *</span></label>
                                <select name="payment_type" id="payment_type" class="form-control" required>
                                    <option value="">Choose one</option>
                                    <option value="cash">Cash</option>
                                    <option value="check">Check</option>
                                    @foreach ($paymentOption as $payOption)
                                        <option value="{{ $payOption->name }}">{{ $payOption->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- update package modal end --}}
    <!-- this overlay is activated only when mobile menu is triggered -->
    <script>
        function updatePackageModalFormSubmit(event){
            event.preventDefault();
            updatePackage()
        }
        function getPlanAmount(){
            var planId = $("#package").val();
            if (planId) {
                $.ajax({
                    url: '{{ env("BASE_API_URL") }}plan-detail/'+planId,
                    type: 'get',
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                    },
                    success: function( data ) {
                        if(data){
                            var planAmount = data.amount;
                            $("#total").val(planAmount);
                            var paid = $("#paid").val();
                            var due = parseFloat(parseFloat(planAmount) - parseFloat(paid));
                            $("#due").val(due);
                        }
                    }
                });
            }
        }
    </script>
    <script>
        function planList(){
            var packageId = $("#packageId").val();
            // $('#package').val(packageId).trigger('change');
            $("#packageInfoModal").modal('hide');
            $('#updatePackageModal form')[0].reset();
            $("#updatePackageModal").modal('show');
        }
        function updatePackage(){
            var packageId = $("#package").val();
            var memberId = $("#memberId").val();
            var timezone = $("#timezone").val();
            var total = $("#total").val();
            var paid = $("#paid").val();
            var payment_type = $("#payment_type").val();
            if ( parseFloat(paid) >= parseFloat(total)) {
                $.ajax({
                    type: "POST",
                    url: '{{ env("BASE_API_URL") }}update-package',
                    data:{
                        'timezone': timezone,
                        'memberId': memberId,
                        'packageId': packageId,
                        'total': total,
                        'paid': paid,
                        'payment_type': payment_type,
                    },
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(result){
                        if (result == true)
                        {
                            $("#updatePackageModal").modal('hide');
                            Swal.fire("Updated!", "Package is updated.", "success");
                        }
                        location.reload();
                    }
                });
            } else {
                alert("Paid amount can't be less then package price");
            }
        }
        function block_member(id){
            Swal.fire(
            {
                title: "Are you sure?",
                text: "You want to block this memeber!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, block it!"
            }).then(function(result)
            {
                if (result.value)
                {
                    $.ajax({
                        type: "GET",
                        url: '{{ env("BASE_API_URL") }}member-block/'+id,
                        headers: {
                            "Authorization": "{{ env('API_TOKEN') }}",
                        },
                        success: function(result){
                            if (result == true)
                            {
                                Swal.fire("Blocked!", "This memeber is blocked.", "success");
                            }location.reload();
                        },
                    });
                }else{
                    event.preventDefault();
                }
            });
        }
        function unblock_member(id){
            Swal.fire(
            {
                title: "Are you sure?",
                text: "You want to unblock this memeber!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, unblock it!"
            }).then(function(result)
            {
                if (result.value)
                {
                    $.ajax({
                        type: "GET",
                        url: '{{ env("BASE_API_URL") }}member-unblock/'+id,
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        headers: {
                            "Authorization": "{{ env('API_TOKEN') }}",
                        },
                        success: function(result){
                            if (result == true)
                            {
                                Swal.fire("Unblocked!", "This memeber is unblocked.", "success");
                            }
                            location.reload();
                        }
                    });
                }else{
                    event.preventDefault();
                }
            });
        }
        function featured_member(id){
            Swal.fire(
            {
                title: "Are you sure?",
                text: "You want to featured this memeber!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, featured it!"
            }).then(function(result)
            {
                if (result.value)
                {
                    $.ajax({
                        type: "GET",
                        url: '{{ env("BASE_API_URL") }}member-featured/'+id,
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        headers: {
                            "Authorization": "{{ env('API_TOKEN') }}",
                        },
                        success: function(result){
                            if (result == true)
                            {
                                Swal.fire("Featured!", "This memeber is featured.", "success");
                            }
                            location.reload();
                        }
                    });
                }else{
                    event.preventDefault();
                }
            });
        }
        function unfeatured_member(id){
            Swal.fire(
            {
                title: "Are you sure?",
                text: "You want to unfeatured this memeber!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, unfeatured it!"
            }).then(function(result)
            {
                if (result.value)
                {
                    $.ajax({
                        type: "GET",
                        url: '{{ env("BASE_API_URL") }}member-unfeatured/'+id,
                        contentType: "application/json; charset=utf-8",
                        dataType: "json",
                        headers: {
                            "Authorization": "{{ env('API_TOKEN') }}",
                        },
                        success: function(result){
                            if (result == true)
                            {
                                Swal.fire("Unfeatured!", "This memeber is unfeatured.", "success");
                            }
                            location.reload();
                        }
                    });
                }else{
                    event.preventDefault();
                }
            });
        }
        function view_package(id){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}member-package/'+id,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                    "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    $("#packageInfoBody").html(result);
                    $("#packageInfoModal").modal('show');
                }
            });
        }
        function update_group(id,member_group){
            $('#groupModal').modal('show');
            var groupBody = '<div class="form-group"><input type="hidden" name"memberId" id="memberId" value="'+id+'">'+
                            '<select class="form-control" name="group" id="group">';
                            if (member_group == '0') {
                                groupBody += '<option value="" selected>No Group</option>';
                            } else {
                                groupBody += '<option value="" >No Group</option>';
                            }
                            if (member_group == '1') {
                                groupBody +='<option value="A" selected >Group A</option>';
                            }else{
                                groupBody +='<option value="A">Group A</option>';
                            }
                            if (member_group == '2') {
                                groupBody +='<option value="B" selected >Group B</option>';
                            } else {
                                groupBody +='<option value="B">Group B</option>';
                            }
                            if (member_group == '3') {
                                groupBody +='<option value="C" selected >Group C</option>';
                            } else {
                                groupBody +='<option value="C">Group C</option>';
                            }
                            if (member_group == '4') {
                                groupBody +='<option value="D" selected >Group D</option>';
                            } else {
                                groupBody +='<option value="D">Group D</option>';
                            }
                            groupBody +='</select></div>';
            $('#groupModalBody').html(groupBody);
        }
        function changeGroup(){
            var groupId = $("#group").val();
            var memberId = $("#memberId").val();
            var timezone = $("#timezone").val();
            $.ajax({
                type: "POST",
                url: '{{ env("BASE_API_URL") }}member-group/'+memberId,
                data:{
                    'timezone': timezone,
                    'group': groupId,
                },
                headers: {
                    "Authorization": "{{ env('API_TOKEN') }}",
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function(result){
                    if (result == true)
                    {
                        Swal.fire("Updated!", "Group is updated.", "success");
                    }
                    location.reload();
                }
            });
        }
    </script>
@endsection
