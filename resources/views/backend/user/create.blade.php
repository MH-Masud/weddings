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
                            <form class="needs-validation" novalidate method="POST" action="{{ route('user.store') }}">
                                <div class="panel-content">
                                    <div class="form-row">
                                        <div class="col-md-6 mb-6">
                                            @csrf
                                            <label class="form-label" for="name">Full name <span class="text-danger">*</span> </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-user fs-xl"></i></span>
                                                </div>
                                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full name" required>
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
                                                <input type="email" class="form-control" id="email" placeholder="Email" value="{{ old('email') }}" name="email" aria-describedby="inputGroupPrepend2" required>
                                                <div class="invalid-tooltip">
                                                    Please choose a email.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-lock fs-xl"></i></span>
                                                </div>
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid password.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Confirm Password <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fal fa-lock fs-xl"></i></span>
                                                </div>
                                                <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" name="password_confirmation" required>
                                                <div class="invalid-tooltip">
                                                    Please provide a valid password.
                                                </div>
                                                <div class="valid-tooltip">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-6">
                                            <label class="form-label" for="password_confirmation">Role <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select required name="roles[]" class="select2 form-control" multiple="multiple" id="multiple-label">
                                                    <optgroup label="Choose roles">
                                                        @foreach ($roles as $role)
                                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                                        @endforeach
                                                    </optgroup>
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
                                    <a href="{{ route('user.index') }}" class="btn btn-dark">Back</a>
                                    <button class="btn btn-primary ml-auto" type="submit">Save User</button>
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
