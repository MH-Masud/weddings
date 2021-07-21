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
                            @if ($company)
                            <form class="needs-validation" novalidate method="POST" action="{{ route('company.update',$company->id) }}" enctype="multipart/form-data">
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            @csrf
                                            @method('PATCH')
                                            <label class="form-label" for="name">Company name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-building fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" placeholder="Company name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-phone fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" value="{{ $company->phone }}" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a phone number.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="email">@</span>
                                                </div>
                                                <input type="text" class="form-control" id="email" placeholder="Email" value="{{ $company->email }}" name="email" aria-describedby="inputGroupPrepend2" required>
                                                <div class="invalid-tooltip">
                                                    Please choose a email.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-map-marker fs-xl"></i></span>
                                                </div>
                                                <textarea required name="address" class="form-control" id="address">{{ $company->address }}</textarea>
                                                <div class="invalid-tooltip">
                                                    Please provide a address.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="logo">Logo <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-image fs-xl"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="uploadImage" placeholder="Select image" accept="image/png,image/jpg,image/jpeg" name="logo">
                                                <div class="invalid-tooltip">
                                                    Please provide a logo.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <br>
                                            <?php $image = json_decode($company->logo);?>
                                            <img id="upload_image"
                                            src="{{asset('uploads/logo/'.$image[0]->thumb) }}"
                                            width="40%"
                                            height="100px" alt="your image"/>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Working Day </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-calendar-check fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="working_day" value="{{ $company->working_day }}" class="form-control" id="working_day">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Working Hour </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-clock fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="working_hour" value="{{ $company->working_hour }}" class="form-control" id="working_hour">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="app_store_link">App Store Link </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-link fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="app_store_link" value="{{ $company->app_store_link }}" class="form-control" id="app_store_link">
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="play_store_link">Google Play Link </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-link fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="play_store_link" value="{{ $company->play_store_link }}" class="form-control" id="play_store_link">
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="admin_approval">Member Approvel By Admin </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-users fs-xl"></i></span>
                                                </div>
                                                <select name="admin_approval" id="admin_approval" class="form-control">
                                                    <option <?php if($company->admin_approval == 'yes'){ ?> selected <?php } ?> value="yes">Yes</option>
                                                    <option <?php if($company->admin_approval == 'no'){ ?> selected <?php } ?> value="no">No</option>
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <button class="btn btn-primary ml-auto" type="submit">Update General Information</button>
                                </div>
                            </form>
                            @else
                            <form class="needs-validation" novalidate method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            @csrf
                                            <label class="form-label" for="name">Company name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-building fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Company name" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a name.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="phone">Phone <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-phone fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="phone" placeholder="Phone number" name="phone" value="{{ old('phone') }}" required>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                                <div class="invalid-tooltip">
                                                    Please choose a phone number.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row form-group">
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="email">Email <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="email">@</span>
                                                </div>
                                                <input type="text" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" name="email" aria-describedby="inputGroupPrepend2" required>
                                                <div class="invalid-tooltip">
                                                    Please choose a email.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="address">Address <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-map-marker fs-xl"></i></span>
                                                </div>
                                                <textarea required name="address" class="form-control" id="address"></textarea>
                                                <div class="invalid-tooltip">
                                                    Please provide a address.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="logo">Logo <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-image fs-xl"></i></span>
                                                </div>
                                                <input required type="file" class="form-control" id="uploadImage" placeholder="Select image" accept="image/png,image/jpg,image/jpeg" name="logo">
                                                <div class="invalid-tooltip">
                                                    Please provide a logo.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <br>
                                            <img id="upload_image"
                                            src=""
                                            class="d-none"
                                            width="40%"
                                            height="100px" alt="your image"/>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Working Day </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-calendar-check fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="working_day" class="form-control" id="working_day">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Working Hour </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-clock fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="working_hour" class="form-control" id="working_hour">
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="app_store_link">App Store Link </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-link fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="app_store_link" class="form-control" id="app_store_link">
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="play_store_link">Google Play Link </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-link fs-xl"></i></span>
                                                </div>
                                                <input type="text" name="play_store_link" class="form-control" id="play_store_link">
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="admin_approval">Member Approvel By Admin </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-users fs-xl"></i></span>
                                                </div>
                                                <select name="admin_approval" id="admin_approval" class="form-control">
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                                <div class="invalid-tooltip">
                                                    Please choose role.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-content border-faded border-left-0 border-right-0 border-bottom-0 d-flex flex-row align-items-center">
                                    <button class="btn btn-primary ml-auto" type="submit">Save General Information</button>
                                </div>
                            </form>
                            @endif
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
