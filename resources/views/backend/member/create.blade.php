@extends('backend.layout.app')
@section('title')
    {{ $title }}
@endsection

@section('mainContent')
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
                        <form class="needs-validation" novalidate method="POST" action="{{ route('member.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="panel-content">
                                <div class="form-row">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="fname">First name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" placeholder="First name" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a first name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="lname">Last name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                            </div>
                                            <input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" placeholder="Last name" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a last name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="phone">Phone <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-phone fs-xl"></i></span>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <select required name="country" id="country" class="form-control">
                                                        <option value="">Country Code</option>
                                                        <?php $coutries = DB::table('countries')->orderBy('phonecode','DESC')->get(); ?>
                                                        @foreach ($coutries as $country)
                                                            <option {{ old('country') == $country->id ? 'selected' : '' }} value="{{ $country->id }}">+{{ $country->phonecode }}</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="valid-tooltip">
                                                        Looks good!
                                                    </div>
                                                    <div class="invalid-tooltip">
                                                        Please choose a code.
                                                    </div>
                                                </div>
                                            </div>
                                            &nbsp;
                                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Phone" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a phone.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="email">Email <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="email">@</span>
                                            </div>
                                            <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="gender">Gender <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-male fs-xl"></i></span>
                                            </div>
                                            <select class="form-control" required name="gender" id="gender">
                                                <option {{ (old('gender') == '') ? "selected" : "" }} value="">Choose one</option>
                                                <option {{ (old('gender') == '1') ? 'selected' : ""}} value="1">Male</option>
                                                <option {{ (old('gender') == '2') ? 'selected' : ""}} value="2">Female</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a gender.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="date_of_birth">Date of Birth <?php $minYear = date('Y') - 18;?><span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-birthday-cake fs-xl"></i></span>
                                            </div>
                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" max="<?php echo date($minYear.'-m-d') ?>" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a birthday.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="gender">On Behalf  <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-adjust fs-xl"></i></span>
                                            </div>
                                            <?php $on_behalves = DB::table('on_behalves')->get(); ?>
                                            <select class="form-control" required name="on_behalf" id="on_behalf">
                                                <option value="">Choose one</option>
                                                @foreach ($on_behalves as $behalf)
                                                    <option {{ (old('on_behalf') == $behalf->id) ? 'selected' : ""}} value="{{ $behalf->id }}">{{ $behalf->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose on behalf.
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="timezone" id="timezone">
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="password">Password <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text show_password" id="password"><i class="fal fa-lock fs-xl"></i></span>
                                            </div>
                                            <input type="password" class="form-control" id="showPassword" name="password" value="{{ old('password') }}" placeholder="Password" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a password.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text show_confirm_password" id="password_confirmation"><i class="fal fa-lock fs-xl"></i></span>
                                            </div>
                                            <input type="password" class="form-control" id="showConfirmPassword" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Password confirmation" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="image">Image</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="image"><i class="fal fa-image fs-xl"></i></span>
                                            </div>
                                            <input type="file" id="uploadImage" accept="image/jpg,image/jpeg,image/png" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="Image">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a image.
                                            </div>
                                        </div><br>
                                        <img alt="image" id="upload_image" class="d-none" width="150" height="150">
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="cv">CV (pdf) </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="cv"><i class="fal fa-file-pdf fs-xl"></i></span>
                                            </div>
                                            <input type="file" accept="application/pdf" class="form-control" id="pdf-upload" name="cv" value="{{ old('cv') }}" placeholder="cv">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a cv.
                                            </div>
                                        </div><br>
                                        <object type="application/pdf" class="d-none" data ="#" id="pdfViewer">
                                            <embed id="preview-3_1" type="application/pdf">
                                        </object>
                                    </div>
                                    <div class="col-md-6 mb-6">
                                        <label class="form-label" for="gender">Plan <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fal fa-credit-card fs-xl"></i></span>
                                            </div>
                                            <?php $plans = DB::table('plans')->get(); ?>
                                            <select class="form-control" required name="plan" id="plan" onchange="return getPlanAmount()">
                                                <option value="">Choose one</option>
                                                @foreach ($plans as $plan)
                                                    <option {{ (old('plan') == $plan->id) ? 'selected' : ""}} value="{{ $plan->id }}">{{ $plan->name }}</option>
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
                                            <input type="number" min="0" step="any" class="form-control"  id="total" name="total" placeholder="Total amount" required>
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
                                <a class="btn btn-dark" href="{{ URL::previous() }}" title="Back">Back</a>
                                <button class="btn btn-primary ml-auto" type="submit">Add New Member</button>
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
<script>
    function getPlanAmount(){
            var planId = $("#plan").val();
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
