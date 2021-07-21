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
        <div class="row">
            <div class="col-xl-12">
                <div id="panel-5" class="panel">
                    <div class="panel-hdr">
                        <h2>
                            {{ $title }}
                        </h2>
                        <div class="panel-toolbar">
                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                        </div>
                    </div>
                    <div class="panel-container show">
                        <div class="panel-content p-0">
                            <form class="needs-validation" novalidate method="POST" action="{{ route('payment.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="customer_name">Customer Name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control"  id="customer_name" name="customer_name" value="{{ old('customer_name') }}" placeholder="Customer name" required>
                                                <input type="hidden" name="customer_id" id="selectuser_id">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a customer name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="plan_id">Plan <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <select name="plan_id" id="plan_id" class="form-control" required onchange="return getPlanAmount()">
                                                    <option value="">Choose one</option>
                                                    @foreach ($plan as $package)
                                                        <option value="{{ $package->id }}">{{ $package->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a plan.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="total">Total Amount<span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="number" min="0" step="any" class="form-control"  id="total" name="total" value="0" placeholder="Total amount" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a total amount.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="paid">Paid Amount<span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="number" min="0" step="any" onkeyup="return calculateDue()" class="form-control"  id="paid" name="paid" value="0" placeholder="Paid amount" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a paid amount.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="due">Due Amount<span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="hidden" name="timezone" id="timezone">
                                                <input type="number" min="0" step="any" class="form-control"  id="due" name="due" value="0" placeholder="Due amount" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a due amount.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="payment_type">Payment Type <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <select name="payment_type" id="payment_type" class="form-control" required>
                                                    <option value="">Choose one</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="check">Check</option>
                                                    @foreach ($paymentOption as $payOption)
                                                        <option value="{{ $payOption->name }}">{{ $payOption->name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a payment type.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('payment.index') }}" class="btn btn-dark">Payment List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Add Payment</button>
                                </div>
                            </form>
                            <script>
                                // Example starter JavaScript for disabling form submissions if there are invalid fields
                                (function()
                                {
                                    'use strict';
                                    window.addEventListener('load', function()
                                    {
                                        // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                        var forms = document.getElementsByClassName('needs-validation');
                                        // Loop over them and prevent submission
                                        var validation = Array.prototype.filter.call(forms, function(form)
                                        {
                                            form.addEventListener('submit', function(event)
                                            {
                                                if (form.checkValidity() === false)
                                                {
                                                    event.preventDefault();
                                                    event.stopPropagation();
                                                }
                                                form.classList.add('was-validated');
                                            }, false);
                                        });
                                    }, false);
                                })();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- this overlay is activated only when mobile menu is triggered -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script>
        $( "#customer_name" ).autocomplete({
            source: function( request, response ) {
                $.ajax({
                    url: '{{ env("BASE_API_URL") }}member-info',
                    type: 'post',
                    data: {
                        'search': request.term
                    },
                    headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function( data ) {
                        if(data){
                            data = JSON.parse(data)
                            response( data );
                        }
                    }
                });
            },
            minLength: 2,
            select: function (event, ui) {
                $('#customer_name').val(ui.item.label);
                $('#selectuser_id').val(ui.item.value);
                return false;
            },
            focus: function(event, ui){
                $( "#customer_name" ).val( ui.item.label );
                $( "#selectuser_id" ).val( ui.item.value );
                return false;
            },
        });
        function getPlanAmount(){
            var planId = $("#plan_id").val();
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
        function calculateDue(){
            var total = $("#total").val();
            var paid = $("#paid").val();
            var due = parseFloat(parseFloat(total) - parseFloat(paid));
            $("#due").val(due);
        }
        </script>
@endsection
