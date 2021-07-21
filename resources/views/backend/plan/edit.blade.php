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
                            <form class="needs-validation" novalidate method="POST" action="{{ route('plan.update',$plan->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="name">Package name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-object-ungroup fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $plan->name }}" placeholder="Package name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="amount">Amount <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">৳</span>
                                                </div>
                                                <input type="number" class="form-control" id="amount" name="amount" value="{{ $plan->amount }}" placeholder="Amount" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose amount.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="package_duration">Package Duration <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-calendar fs-xl"></i></span>
                                                </div>
                                                <select name="package_duration" id="package_duration" class="form-control">
                                                    <option <?php if($plan->package_duration == ''){ ?> selected <?php } ?> value="">Unlimited</option>
                                                    <option <?php if($plan->package_duration == '30'){ ?> selected <?php } ?> value="30">1 Month</option>
                                                    <option <?php if($plan->package_duration == '60'){ ?> selected <?php } ?> value="60">2 Month</option>
                                                    <option <?php if($plan->package_duration == '90'){ ?> selected <?php } ?> value="90">3 Month</option>
                                                    <option <?php if($plan->package_duration == '120'){ ?> selected <?php } ?> value="120">4 Month</option>
                                                    <option <?php if($plan->package_duration == '150'){ ?> selected <?php } ?> value="150">5 Month</option>
                                                    <option <?php if($plan->package_duration == '180'){ ?> selected <?php } ?> value="180">6 Month</option>
                                                    <option <?php if($plan->package_duration == '210'){ ?> selected <?php } ?> value="210">7 Month</option>
                                                    <option <?php if($plan->package_duration == '240'){ ?> selected <?php } ?> value="240">8 Month</option>
                                                    <option <?php if($plan->package_duration == '270'){ ?> selected <?php } ?> value="270">9 Month</option>
                                                    <option <?php if($plan->package_duration == '300'){ ?> selected <?php } ?> value="300">10 Month</option>
                                                    <option <?php if($plan->package_duration == '330'){ ?> selected <?php } ?> value="330">11 Month</option>
                                                    <option <?php if($plan->package_duration == '360'){ ?> selected <?php } ?> value="360">1 Year</option>
                                                    <option <?php if($plan->package_duration == '720'){ ?> selected <?php } ?> value="720">2 Year</option>
                                                    <option <?php if($plan->package_duration == '1080'){ ?> selected <?php } ?> value="1080">3 Year</option>
                                                    <option <?php if($plan->package_duration == '1440'){ ?> selected <?php } ?> value="1440">4 Year</option>
                                                    <option <?php if($plan->package_duration == '1800'){ ?> selected <?php } ?> value="1800">5 Year</option>
                                                </select>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose package duration.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="express_interest">Express Interest <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-rocket fs-xl"></i></span>
                                                </div>
                                                <input type="number" class="form-control" id="express_interest" name="express_interest" value="{{ $plan->express_interest }}" placeholder="Express interest" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose express interest.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="direct_messages">Direct Messages <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-envelope fs-xl"></i></span>
                                                </div>
                                                <input type="number" class="form-control" id="direct_messages" name="direct_messages" value="{{ $plan->direct_messages }}" placeholder="Direct messages" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose direct messages.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="photo_gallery">Photo Gallery <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-image fs-xl"></i></span>
                                                </div>
                                                <input type="number" class="form-control" id="photo_gallery" name="photo_gallery" value="{{ $plan->photo_gallery }}" placeholder="Photo gallery" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose photo gallery.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="image">Image <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-file-image fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="uploadImage" name="image" value="{{ old('image') }}" placeholder="image">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose image.
                                                </div>
                                            </div>
                                            <br>
                                            <?php $images = json_decode($plan->image); ?>
                                            <img src="{{ asset('uploads/plan_image/'.$images[0]->thumb) }}" alt="Plan Image" id="upload_image" class="" width="100" height="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <a href="{{ route('plan.index') }}" class="btn btn-dark">Package List</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Update Package</button>
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
@endsection
