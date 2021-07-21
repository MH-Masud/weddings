@extends('backend.layout.app')

@section('title')
    {{ $title }}
@endsection
@section('mainContent')
<meta name="_token" content="{{ csrf_token() }}"/>
<!-- the #js-page-content id is needed for some plugins to initialize -->
<main id="js-page-content" role="main" class="page-content">
    <ol class="breadcrumb page-breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
        <li class="breadcrumb-item">Member</li>
        <li class="breadcrumb-item active">{{ $title }}</li>
        <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
    </ol>
    <div class="subheader">
        <a href="{{ URL::previous() }}" class="btn btn-dark btn-sm" title="Back"><i class="fal fa-backward"> Back</i></a>&nbsp;
        <a href="{{ route('member.create') }}" target="_blank" class="btn btn-success btn-sm" title="Edit"><i class="fal fa-plus"> Add Member</i></a>&nbsp;
        <a href="{{ route('member.destroy',$member->id) }}" onclick="return confirm_delete({{ $member->id }})" class="btn btn-danger btn-sm" title="Delete"><i class="fal fa-trash"> Delete</i></a>
        <form id="delete_form_{{ $member->id }}" action="{{ route('member.destroy',$member->id) }}" method="POST">
            @method('DELETE')
            @csrf
        </form>
    </div>
    <div class="row">
        <div class="col-lg-4 col-xl-4 order-lg-1 order-xl-1">
            <!-- profile summary -->
            <div class="card mb-g rounded-top">
                <div class="row no-gutters row-grid">
                    <div class="col-12">
                        <div class="d-flex flex-column align-items-center justify-content-center p-4">
                            <?php $profile_image = json_decode($member->profile_image); ?>
                            <img src="{{ asset('uploads/profile_image/'.$profile_image[0]->thumb) }}" id="showProfileImage" height="200" width="200" class="rounded-circle shadow-2 img-thumbnail" title="{{ $member->first_name.' '.$member->last_name}}" alt="{{ $member->first_name.' '.$member->last_name}}">
                            <label class="btn-aux" for="profile_image" style="cursor: pointer;">
                                <i class="fa fa-pen"></i>
                            </label>
                            <form action="{{ route('member.update',$member->id) }}" method="POST" enctype="multipart/form-data">
                                @method('PATCH')
                                @csrf
                                <input type="file" accept=".jpg, .jpeg, .png" name="profile_image" style="display: none;" id="profile_image">
                                <button type="submit" id="profileImageUploadBtn" class="btn btn-sm btn-info" style="display: none;">Upload Image</button>
                            </form>

                            <h5 class="mb-0 fw-700 text-center mt-3">
                                Member ID: {{ $member->member_profile_id }}<br>
                                {{ $member->first_name.' '.$member->last_name}}
                                @if ($member->is_closed == 'no')
                                    <span class="badge badge-info">Active</span>
                                @else
                                    <span class="badge badge-danger">Closed</span>
                                @endif
                                <?php $present_address = json_decode($member->present_address); ?>
                                <small class="text-muted mb-0"><?php $cityName = DB::table('cities')->where('id',$present_address[0]->city)->value('name'); ?> {{ $cityName }}, <?php $countryName = DB::table('countries')->where('id',$present_address[0]->country)->value('name'); ?> {{ $countryName }}</small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center py-3">
                            <h5 class="mb-0 fw-700">
                                {{ count(json_decode($member->viewed_by)) }}
                                <small class="text-muted mb-0">Views</small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center py-3">
                            <h5 class="mb-0 fw-700">
                                {{ $member->follower }}
                                <small class="text-muted mb-0">Followers</small>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center py-3">
                            <h5 class="mb-0 fw-700">
                                {{ $member->reported_by }}
                                <small class="text-muted mb-0">Reported</small>
                            </h5>
                        </div>
                    </div>
                    <?php
                    if ($member->member_group == '') {
                        $memberGroup = '0';
                    }
                    if ($member->member_group == 'A') {
                        $memberGroup = '1';
                    }
                    if ($member->member_group == 'B') {
                        $memberGroup = '2';
                    }
                    if ($member->member_group == 'C') {
                        $memberGroup = '3';
                    }
                    if ($member->member_group == 'D') {
                        $memberGroup = '4';
                    }
                    ?>
                    <div class="col-12">
                        <div class="p-3 text-center">
                            <a href="javascript:void(0);" onclick="view_package({{ $member->id }})" class="btn-link font-weight-bold">Package</a> <span class="text-primary d-inline-block mx-3">&#9679;</span>
                            <a href="javascript:void(0);" onclick="return update_group({{ $member->id }},{{ $memberGroup }})" class="btn-link font-weight-bold">Group</a> <span class="text-primary d-inline-block mx-3">&#9679;</span>
                            @if ($member->is_blocked == 'yes')
                                <a href="javascript:void(0);" onclick="return unblock_member({{ $member->id }})" class="btn-link font-weight-bold">Unblock</a>
                            @else
                                <a href="javascript:void(0);" onclick="return block_member({{ $member->id }})" class="btn-link font-weight-bold">Block</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- photos -->
            <?php $galleries = json_decode($member->gallery);?>
            @if($galleries)
            <div class="card mb-g">
                <div class="row row-grid no-gutters">
                    <div class="col-12">
                        <div class="p-3">
                            <h2 class="mb-0 fs-xl">
                                Gallery
                            </h2>
                        </div>
                    </div>
                    @foreach ($galleries as $gallery)
                    <div class="col-6">
                        <img width="150" height="150" src="{{ asset('uploads/gallery_image/'.$gallery->image) }}" alt="Gallery">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            <?php $happy_stories = DB::table('happy_stories')->where('posted_by',$member->id)->get();?>
            @if(count($happy_stories) > 0)
            <div class="card mb-g">
                <div class="row row-grid no-gutters">
                    <div class="col-12">
                        <div class="p-3">
                            <h2 class="mb-0 fs-xl">
                                Happy Story
                            </h2>
                        </div>
                    </div>
                    @foreach ($happy_stories as $happy_stories)
                    <?php $image1 = json_decode($happy_stories->image1); ?>
                    <?php $image2 = json_decode($happy_stories->image2); ?>
                    <div class="col-6">
                        <img width="150" height="150" src="{{ asset('uploads/happy_story_image/'.$image1[0]->thumb) }}" alt="Gallery">
                    </div>
                    <div class="col-6">
                        <img width="150" height="150" src="{{ asset('uploads/happy_story_image/'.$image2[0]->thumb) }}" alt="Gallery">
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
        <div class="col-lg-8 col-xl-8 order-lg-2 order-xl-3">
            <form class="needs-validation" novalidate action="{{ route('member.update',$member->id) }}" method="POST">
                @method('PATCH')
                @csrf()
                <!-- add : -->
                <div class="card mb-2">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-user-secret"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Introduction
                                </strong>
                                <br>
                                <textarea name="introduction" id="introduction" class="form-control" cols="80" rows="5">{{ $member->introduction }}</textarea>
                                <div class="valid-tooltip">
                                    Looks good!
                                </div>
                                <div class="invalid-tooltip">
                                    Please write a introduction.
                                </div>
                                <br><button type="submit" class="btn btn-sm btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-info-circle"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Basic Information
                                </strong>
                                <br>
                                <?php $basicInfo = json_decode($member->basic_info); ?>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="first_name">First name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $member->first_name }}" placeholder="First name" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter first name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="last_name">Last name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $member->last_name }}" placeholder="Last name" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter a last name.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="email">Email </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="email" name="email" value="{{ $member->email }}" placeholder="Email">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter a email.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="mobile">Phone <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $member->mobile }}" placeholder="Phone" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter a phone.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="date_of_birth">Birthday <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ date('Y-m-d',$member->date_of_birth) }}" placeholder="Birthday" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a birthday.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="gender">Gender <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="gender" id="gender" required class="form-control">
                                                <option value="">Choose One</option>
                                                <option <?php if($member->gender == '1'){ ?> selected <?php }?> value="1">Male</option>
                                                <option <?php if($member->gender == '2'){ ?> selected <?php }?> value="2">Female</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a gender.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="on_behalf">On Behalf <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="on_behalf" id="on_behalf" required class="form-control">
                                                <option value="">Choose One</option>
                                                <?php $onBehalves = DB::table('on_behalves')->get(); ?>
                                                @foreach ($onBehalves as $behalf)
                                                    <option <?php if($basicInfo[0]->on_behalf == $behalf->id){ ?> selected <?php } ?> value="{{ $behalf->id }}">{{ $behalf->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a on behalf.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="marital_status">Marital Status <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="marital_status" id="marital_status" required class="form-control">
                                                <option value="">Choose One</option>
                                                <?php $marital_statuses = DB::table('marital_statuses')->get(); ?>
                                                @foreach ($marital_statuses as $m_status)
                                                    <option <?php if($basicInfo[0]->marital_status == $m_status->id){ ?> selected <?php } ?> value="{{ $m_status->id }}">{{ $m_status->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a marital status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="area">Area </label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="area" id="area" value="{{ $basicInfo[0]->area }}">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter a area.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="number_of_children">Number Of Children <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" id="number_of_children" name="number_of_children" value="{{ $basicInfo[0]->number_of_children }}" placeholder="Number of children" required>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please enter number of childrens.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-sm btn-info" type="submit">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-address-card"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Present Address
                                </strong>
                                <br>
                                <?php $presentAddress = json_decode($member->present_address); ?>
                                <div class="form-row">
                                    @isset($presentAddress[0]->country)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="country">Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="country" id="country" onchange="onChangeCountry()" class="select2 form-control">
                                                <option value="">Choose One</option>
                                                <?php $countries = DB::table('countries')->get(); ?>
                                                @foreach ($countries as $country)
                                                    <option <?php if($presentAddress[0]->country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a country.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset

                                    @isset($presentAddress[0]->state)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="state">State <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="state" id="state" onchange="onChangeState()" class="select2 form-control">
                                                <?php $stateName = DB::table('states')->where('id',$presentAddress[0]->state)->value('name'); ?>
                                                <option value="{{ $presentAddress[0]->state }}">{{ $stateName}}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a state.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset

                                    @isset($presentAddress[0]->city)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="city">City <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="city" id="city" onchange="onChangeCity()" class="select2 form-control">
                                                <?php $cityName = DB::table('cities')->where('id',$presentAddress[0]->city)->value('name'); ?>
                                                <option value="{{ $presentAddress[0]->city }}">{{ $cityName }}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a city.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset
                                    @isset($presentAddress[0]->postal_code)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="postal_code">Postal Code<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" name="postal_code" id="postal_code" value="{{ $presentAddress[0]->postal_code }}" class="form-control">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a post code.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset
                                    <button class="btn btn-sm btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <?php $educationCareer = json_decode($member->education_and_career); ?>
                @if($educationCareer)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Education & Career
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="highest_education">Highest Education <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="highest_education" id="highest_education" class="select2 form-control">
                                                <option value="">Choose One</option>
                                                <?php $educations = DB::table('education')->get(); ?>
                                                @foreach ($educations as $education)
                                                    <option <?php if($educationCareer[0]->highest_education == $education->id){ ?> selected <?php } ?> value="{{ $education->id }}">{{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a education.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="universities">University <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="universities" id="universities" class="select2 form-control">
                                                <option value="">Select university</option>
                                                @if (isset($educationCareer[0]->university))
                                                <?php $universities = DB::table('universities')->get(); ?>
                                                @foreach ($universities as $university)
                                                    <option <?php if($educationCareer[0]->university == $university->id){ ?> selected <?php } ?> value="{{ $university->id }}">{{ $university->name }}</option>
                                                @endforeach
                                                @else
                                                <?php $universities = DB::table('universities')->get(); ?>
                                                @foreach ($universities as $university)
                                                    <option value="{{ $university->id }}">{{ $university->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a university.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="occupation">Occupation <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="occupation" id="occupation" class="select2 form-control">
                                                <option value="">Select occupation</option>
                                                @if (isset($educationCareer[0]->occupation))
                                                <?php $occupations = DB::table('occupations')->get(); ?>
                                                @foreach ($occupations as $occupation)
                                                    <option <?php if($educationCareer[0]->occupation == $occupation->id){ ?> selected <?php } ?> value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                                @endforeach
                                                @else
                                                <?php $occupations = DB::table('occupations')->get(); ?>
                                                @foreach ($occupations as $occupation)
                                                    <option value="{{ $occupation->id }}">{{ $occupation->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a occupation.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="incomes">Annual Income <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="incomes" id="incomes" class="select2 form-control">
                                                <option value="">Select income</option>
                                                @if (isset($educationCareer[0]->annual_income))
                                                <?php $incomes = DB::table('incomes')->get(); ?>
                                                @foreach ($incomes as $income)
                                                    <option <?php if($educationCareer[0]->annual_income == $income->id){ ?> selected <?php } ?> value="{{ $income->id }}"><?php echo $income->name; ?></option>
                                                @endforeach
                                                @else
                                                <?php $incomes = DB::table('incomes')->get(); ?>
                                                @foreach ($incomes as $income)
                                                    <option value="{{ $income->id }}"><?php echo $income->name; ?></option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a income.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="job_post">Post <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($educationCareer[0]->post))
                                            <input type="text" name="job_post" id="job_post" class="form-control" value="{{ $educationCareer[0]->post }}">
                                            @else
                                            <input type="text" name="job_post" id="job_post" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a post.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="job_company_name">Company Name <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($educationCareer[0]->company_name))
                                            <input type="text" value="{{ $educationCareer[0]->company_name }}" name="job_company_name" id="job_company_name" class="form-control">
                                            @else
                                            <input type="text" value="" name="job_company_name" id="job_company_name" class="form-control">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a company name.
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $physicalAttributes = json_decode($member->physical_attributes); ?>
                @if($physicalAttributes)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-notes-medical"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Physical Attributes
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="height">Height <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($member->height))
                                            <input type="text" name="height" required class="form-control" id="height" value="{{ $member->height }}">
                                            @else
                                            <input type="text" name="height" required class="form-control" id="height" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a height.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="weight">Weight <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->weight))
                                            <input type="text" name="weight" required class="form-control" id="weight" value="{{ $physicalAttributes[0]->weight }}">
                                            @else
                                            <input type="text" name="weight" required class="form-control" id="weight" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a weight.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="eye_color">Eye Color <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->eye_color))
                                            <input type="text" name="eye_color" required class="form-control" id="eye_color" value="{{ $physicalAttributes[0]->eye_color }}">
                                            @else
                                            <input type="text" name="eye_color" required class="form-control" id="eye_color" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a eye color.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="hair_color">Hair Color <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->hair_color))
                                            <input type="text" name="hair_color" required class="form-control" id="hair_color" value="{{ $physicalAttributes[0]->hair_color }}">
                                            @else
                                            <input type="text" name="hair_color" required class="form-control" id="hair_color" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a hair color.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="complexion">Complexion <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->complexion))
                                            <input type="text" name="complexion" required class="form-control" id="complexion" value="{{ $physicalAttributes[0]->complexion }}">
                                            @else
                                            <input type="text" name="complexion" required class="form-control" id="complexion" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a complexion.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="blood_group">Blood Group <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->blood_group))
                                            <input type="text" name="blood_group" required class="form-control" id="blood_group" value="{{ $physicalAttributes[0]->blood_group }}">
                                            @else
                                            <input type="text" name="blood_group" required class="form-control" id="blood_group" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a blood group.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="body_type">Body Type <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->body_type))
                                            <input type="text" name="body_type" required class="form-control" id="body_type" value="{{ $physicalAttributes[0]->body_type }}">
                                            @else
                                            <input type="text" name="body_type" required class="form-control" id="body_type" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a body type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="body_art">Body Art <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->body_art))
                                            <input type="text" name="body_art" required class="form-control" id="body_art" value="{{ $physicalAttributes[0]->body_art }}">
                                            @else
                                            <input type="text" name="body_art" required class="form-control" id="body_art" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a body art.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="any_disability">Any Disability <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($physicalAttributes[0]->any_disability))
                                            <input type="text" name="any_disability" required class="form-control" id="any_disability" value="{{ $physicalAttributes[0]->any_disability }}">
                                            @else
                                            <input type="text" name="any_disability" required class="form-control" id="any_disability" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a body any disability.
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-sm btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $language = json_decode($member->language); ?>
                @if($language)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-language"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Language
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="mother_tongue">Mother Tongue <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="mother_tongue" id="mother_tongue" class="form-control">
                                                <option value="">Choose One</option>
                                                <?php $motherTongues = DB::table('languages')->get(); ?>
                                                @if (isset($language[0]->mother_tongue))
                                                @foreach ($motherTongues as $motherTongue)
                                                    <option <?php if($language[0]->mother_tongue == $motherTongue->id){ ?> selected <?php } ?> value="{{ $motherTongue->id }}">{{ $motherTongue->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($motherTongues as $motherTongue)
                                                    <option value="{{ $motherTongue->id }}">{{ $motherTongue->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a mother tongue.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="language">Language <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="language" id="language" class="form-control">
                                                <option value="">Choose One</option>
                                                @if (isset($language[0]->language))
                                                @foreach ($motherTongues as $lang)
                                                    <option <?php if($language[0]->language == $lang->id){ ?> selected <?php } ?> value="{{ $lang->id }}">{{ $lang->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($motherTongues as $lang)
                                                    <option value="{{ $lang->id }}">{{ $lang->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a language.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="speak">Speak <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="speak" id="speak" class="form-control">
                                                <option value="">Choose One</option>
                                                @if (isset($language[0]->speak))
                                                @foreach ($motherTongues as $speak)
                                                    <option <?php if($language[0]->speak == $speak->id){ ?> selected <?php } ?> value="{{ $speak->id }}">{{ $speak->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($motherTongues as $speak)
                                                    <option value="{{ $speak->id }}">{{ $speak->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a speak.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="read">Read <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="read" id="read" class="form-control">
                                                <option value="">Choose One</option>
                                                @if (isset($language[0]->read))
                                                @foreach ($motherTongues as $read)
                                                    <option <?php if($language[0]->read == $read->id){ ?> selected <?php } ?> value="{{ $read->id }}">{{ $read->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($motherTongues as $read)
                                                    <option value="{{ $read->id }}">{{ $read->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a read.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $hobbiesInterest = json_decode($member->hobbies_and_interest); ?>
                @if($hobbiesInterest)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-film"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Hobbies & Interest
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="hobby">Hobby <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->hobby))
                                            <input type="text" name="hobby" class="form-control" id="hobby" value="{{ $hobbiesInterest[0]->hobby }}">
                                            @else
                                            <input type="text" name="hobby" class="form-control" id="hobby" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a hobby.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="interest">Interest <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->interest))
                                            <input type="text" name="interest" class="form-control" id="interest" value="{{ $hobbiesInterest[0]->interest }}">
                                            @else
                                            <input type="text" name="interest" class="form-control" id="interest" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a interest.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="music">Music <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->music))
                                            <input type="text" name="music" class="form-control" id="music" value="{{ $hobbiesInterest[0]->music }}">
                                            @else
                                            <input type="text" name="music" class="form-control" id="music" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a music.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="books">Books <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->books))
                                            <input type="text" name="books" class="form-control" id="books" value="{{ $hobbiesInterest[0]->books }}">
                                            @else
                                            <input type="text" name="books" class="form-control" id="books" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a books.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="movie">Movie <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->movie))
                                            <input type="text" name="movie" class="form-control" id="movie" value="{{ $hobbiesInterest[0]->movie }}">
                                            @else
                                            <input type="text" name="movie" class="form-control" id="movie" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a movie.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="tv_show">TV Show <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->tv_show))
                                            <input type="text" name="tv_show" class="form-control" id="tv_show" value="{{ $hobbiesInterest[0]->tv_show }}">
                                            @else
                                            <input type="text" name="tv_show" class="form-control" id="tv_show" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a tv show.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="sports_show">Sports Show <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->sports_show))
                                            <input type="text" name="sports_show" class="form-control" id="sports_show" value="{{ $hobbiesInterest[0]->sports_show }}">
                                            @else
                                            <input type="text" name="sports_show" class="form-control" id="sports_show" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a sports show.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="fitness_activity">Fitness Activity <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->fitness_activity))
                                            <input type="text" name="fitness_activity" class="form-control" id="fitness_activity" value="{{ $hobbiesInterest[0]->fitness_activity }}">
                                            @else
                                            <input type="text" name="fitness_activity" class="form-control" id="fitness_activity" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a fitness activity.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="cuisine">Cuisine <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->cuisine))
                                            <input type="text" name="cuisine" class="form-control" id="cuisine" value="{{ $hobbiesInterest[0]->cuisine }}">
                                            @else
                                            <input type="text" name="cuisine" class="form-control" id="cuisine" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a cuisine.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="dress_style">Dress Style <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($hobbiesInterest[0]->dress_style))
                                            <input type="text" name="dress_style" class="form-control" id="dress_style" value="{{ $hobbiesInterest[0]->dress_style }}">
                                            @else
                                            <input type="text" name="dress_style" class="form-control" id="dress_style" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a dress style.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $personalBehavior = json_decode($member->personal_attitude_and_behavior); ?>
                @if($personalBehavior)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-american-sign-language-interpreting"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Personal Attitude & Behavior
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="affection">Affection <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($personalBehavior[0]->affection))
                                            <input type="text" name="affection" class="form-control" id="affection" value="{{ $personalBehavior[0]->affection }}">
                                            @else
                                            <input type="text" name="affection" class="form-control" id="affection" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a affection.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="humor">Humor <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($personalBehavior[0]->humor))
                                            <input type="text" name="humor" class="form-control" id="humor" value="{{ $personalBehavior[0]->humor }}">
                                            @else
                                            <input type="text" name="humor" class="form-control" id="humor" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a humor.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="political_view">Political View <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($personalBehavior[0]->political_view))
                                            <input type="text" name="political_view" class="form-control" id="political_view" value="{{ $personalBehavior[0]->political_view }}">
                                            @else
                                            <input type="text" name="political_view" class="form-control" id="political_view" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a political view.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="religious_service">Religious Service <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($personalBehavior[0]->religious_service))
                                            <input type="text" name="religious_service" class="form-control" id="religious_service" value="{{ $personalBehavior[0]->religious_service }}">
                                            @else
                                            <input type="text" name="religious_service" class="form-control" id="religious_service" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a religious service.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $residencyInformation = json_decode($member->residency_information); ?>
                @if($residencyInformation)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-building"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Residency Information
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="birth_country">Birth Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <?php $countries = DB::table('countries')->get(); ?>
                                            <select name="birth_country" id="birth_country" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($countries as $country)
                                                @if (isset($residencyInformation[0]->birth_country))
                                                <option <?php if($residencyInformation[0]->birth_country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a birth country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="residency_country">Residency Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="residency_country" id="residency_country" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($countries as $country)
                                                @if (isset($residencyInformation[0]->residency_country))
                                                <option <?php if($residencyInformation[0]->residency_country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a residency country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="citizenship_country">Citizenship Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="citizenship_country" id="citizenship_country" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($countries as $country)
                                                @if (isset($residencyInformation[0]->citizenship_country))
                                                <option <?php if($residencyInformation[0]->citizenship_country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a citizenship country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="grow_up_country">Grow Up Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="grow_up_country" id="grow_up_country" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($countries as $country)
                                                @if (isset($residencyInformation[0]->grow_up_country))
                                                <option <?php if($residencyInformation[0]->grow_up_country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @else
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a grow up country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="immigration_status">Immigration Status <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($residencyInformation[0]->immigration_status))
                                            <input type="text" id="immigration_status" name="immigration_status" class="form-control" value="{{ $residencyInformation[0]->immigration_status }}">
                                            @else
                                            <input type="text" id="immigration_status" name="immigration_status" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a immigration status.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $spiritualBackground = json_decode($member->spiritual_and_social_background); ?>
                @if($spiritualBackground)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-id-card-alt"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Spiritual & Social Background
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="religions">Religion <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <?php $religions = DB::table('religions')->get(); ?>
                                            <select name="religions" id="religions" onchange="onChangeReligion()" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($religions as $relig)
                                                @if (isset($spiritualBackground[0]->religion))
                                                <option <?php if($spiritualBackground[0]->religion == $relig->id){ ?> selected <?php } ?> value="{{ $relig->id }}">{{ $relig->name }}</option>
                                                @else
                                                <option value="{{ $relig->id }}">{{ $relig->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a religion.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="caste">Caste / Sect <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="caste" id="castes" class="form-control select2" onchange="onChangeCast()">
                                                <?php $casteName = DB::table('castes')->where('id',$spiritualBackground[0]->caste)->value('name');?>
                                                <option value="{{ $spiritualBackground[0]->caste }}">{{ $casteName }}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a caste.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="sub_caste">Sub Caste <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="sub_caste" id="sub_castes" class="form-control select2">
                                                <?php $subCasteName = DB::table('sub_castes')->where('id',$spiritualBackground[0]->sub_caste)->value('name');?>
                                                @if ($subCasteName)
                                                <option value="{{ $spiritualBackground[0]->sub_caste }}">{{ $subCasteName }}</option>
                                                @else
                                                <option value="">Choose Cast First</option>
                                                @endif

                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a sub caste.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="ethnicity">Ethnicity <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($spiritualBackground[0]->ethnicity))
                                            <input type="text" id="ethnicity" name="ethnicity" class="form-control" value="{{ $spiritualBackground[0]->ethnicity }}">
                                            @else
                                            <input type="text" id="ethnicity" name="ethnicity" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a ethnicity.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="family_value">Family Value <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <?php $familyValues = DB::table('family_values')->get(); ?>
                                            <select name="family_value" id="family_value" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($familyValues as $familyValue)
                                                @if (isset($spiritualBackground[0]->family_value))
                                                <option <?php if($spiritualBackground[0]->family_value == $familyValue->id){ ?> selected <?php } ?> value="{{ $familyValue->id }}">{{ $familyValue->name }}</option>
                                                @else
                                                <option value="{{ $familyValue->id }}">{{ $familyValue->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a family value.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="family_status">Family Status <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <?php $familyStatuses = DB::table('family_statuses')->get(); ?>
                                            <select name="family_status" id="family_status" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($familyStatuses as $familyStatus)
                                                @if (isset($spiritualBackground[0]->family_status))
                                                <option <?php if($spiritualBackground[0]->family_status == $familyStatus->id){ ?> selected <?php } ?> value="{{ $familyStatus->id }}">{{ $familyStatus->name }}</option>
                                                @else
                                                <option value="{{ $familyStatus->id }}">{{ $familyStatus->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a family status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="personal_value">Personal Value <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($spiritualBackground[0]->personal_value))
                                            <input type="text" id="personal_value" name="personal_value" class="form-control" value="{{ $spiritualBackground[0]->personal_value }}">
                                            @else
                                            <input type="text" id="personal_value" name="personal_value" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a personal value.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="community_value">Community Value <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($spiritualBackground[0]->community_value))
                                            <input type="text" id="community_value" name="community_value" class="form-control" value="{{ $spiritualBackground[0]->community_value }}">
                                            @else
                                            <input type="text" id="community_value" name="community_value" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a community value.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="u_manglik">Manglik <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="u_manglik" id="u_manglik" class="form-control select2">
                                                @if (isset($spiritualBackground[0]->u_manglik))
                                                <option <?php if($spiritualBackground[0]->u_manglik == ''){ ?> selected <?php } ?> value="">Choose One</option>
                                                <option <?php if($spiritualBackground[0]->u_manglik == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($spiritualBackground[0]->u_manglik == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($spiritualBackground[0]->u_manglik == '3'){ ?> selected <?php } ?> value="3">I don't know</option>
                                                @else
                                                <option value="">Choose One</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">I don't know</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a manglik.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $lifeStyle = json_decode($member->life_style); ?>
                @if($lifeStyle)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-hourglass-half"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Life Style
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="diet">Diet <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($lifeStyle[0]->diet))
                                            <input type="text" id="diet" name="diet" class="form-control" value="{{ $lifeStyle[0]->diet }}">
                                            @else
                                            <input type="text" id="diet" name="diet" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a diet.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="drink">Drink <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="drink" id="drink" class="form-control">
                                                @if (isset($lifeStyle[0]->drink))
                                                <option <?php if($lifeStyle[0]->drink == ''){ ?> selected <?php } ?> value="">Choose One</option>
                                                <option <?php if($lifeStyle[0]->drink == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($lifeStyle[0]->drink == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($lifeStyle[0]->drink == '3'){ ?> selected <?php } ?> value="3">Occasionally</option>
                                                @else
                                                <option value="">Choose One</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Occasionally</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a drink.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="smoke">Smoke <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="smoke" id="smoke" class="form-control">
                                                @if (isset($lifeStyle[0]->smoke))
                                                <option <?php if($lifeStyle[0]->smoke == ''){ ?> selected <?php } ?> value="">Choose One</option>
                                                <option <?php if($lifeStyle[0]->smoke == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($lifeStyle[0]->smoke == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($lifeStyle[0]->smoke == '3'){ ?> selected <?php } ?> value="3">Occasionally</option>
                                                @else
                                                <option value="">Choose One</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Occasionally</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a smoke.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="living_with">Living With <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($lifeStyle[0]->living_with))
                                            <input type="text" id="living_with" name="living_with" class="form-control" value="{{ $lifeStyle[0]->living_with }}">
                                            @else
                                            <input type="text" id="living_with" name="living_with" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a smoke.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif

                <?php $astronomicInformation = json_decode($member->astronomic_information); ?>
                @if($astronomicInformation)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-cube"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Astronomic Information
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="sun_sign">Sun Sign <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($astronomicInformation[0]->sun_sign))
                                            <input type="text" id="sun_sign" name="sun_sign" class="form-control" value="{{ $astronomicInformation[0]->sun_sign }}">
                                            @else
                                            <input type="text" id="sun_sign" name="sun_sign" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a sun sign.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="moon_sign">Moon Sign <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($astronomicInformation[0]->moon_sign))
                                            <input type="text" id="moon_sign" name="moon_sign" class="form-control" value="{{ $astronomicInformation[0]->moon_sign }}">
                                            @else
                                            <input type="text" id="moon_sign" name="moon_sign" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a moon sign.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="time_of_birth">Time Of Birth <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($astronomicInformation[0]->time_of_birth))
                                            <input type="text" id="time_of_birth" name="time_of_birth" class="form-control" value="{{ $astronomicInformation[0]->time_of_birth }}">
                                            @else
                                            <input type="text" id="time_of_birth" name="time_of_birth" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a time of birth.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="city_of_birth">City Of Birth <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($astronomicInformation[0]->city_of_birth))
                                            <input type="text" id="city_of_birth" name="city_of_birth" class="form-control" value="{{ $astronomicInformation[0]->city_of_birth }}">
                                            @else
                                            <input type="text" id="city_of_birth" name="city_of_birth" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a city of birth.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                <?php $permanentAddress = json_decode($member->permanent_address); ?>
                @if ($permanentAddress)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-home"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Permanent Address
                                </strong>
                                <br>
                                <div class="form-row">
                                    @isset($permanentAddress[0]->permanent_country)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="permanent_country">Country <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="permanent_country" id="permanent_country" onchange="onChangeCountry('permanent')" class="select2 form-control">
                                                <option value="">Choose One</option>
                                                <?php $countries = DB::table('countries')->get(); ?>
                                                @foreach ($countries as $country)
                                                    <option <?php if($permanentAddress[0]->permanent_country == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a country.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset

                                    @isset($permanentAddress[0]->permanent_state)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="permanent_state">State <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="permanent_state" id="permanent_state" onchange="onChangeState('permanent')" class="select2 form-control">
                                                <?php $stateName = DB::table('states')->where('id',$permanentAddress[0]->permanent_state)->value('name'); ?>
                                                <option value="{{ $permanentAddress[0]->permanent_state }}">{{ $stateName}}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a state.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset

                                    @isset($permanentAddress[0]->permanent_city)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="permanent_city">City <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="permanent_city" id="permanent_city" onchange="onChangeCity('permanent')" class="select2 form-control">
                                                <?php $cityName = DB::table('cities')->where('id',$permanentAddress[0]->permanent_city)->value('name'); ?>
                                                <option value="{{ $permanentAddress[0]->permanent_city }}">{{ $cityName }}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a city.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset
                                    @isset($permanentAddress[0]->permanent_postal_code)
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label" for="permanent_postal_code">Postal Code<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <input type="text" name="permanent_postal_code" id="permanent_postal_code" value="{{ $permanentAddress[0]->permanent_postal_code }}" class="form-control">
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a post code.
                                            </div>
                                        </div>
                                    </div>
                                    @endisset
                                    <button class="btn btn-sm btn-info" type="submit">Update</button>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                <?php $familyInfo = json_decode($member->family_info); ?>
                @if ($familyInfo)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-users"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Family Information
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="father">Father <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($familyInfo[0]->father))
                                            <input type="text" id="father" name="father" class="form-control" value="{{ $familyInfo[0]->father }}">
                                            @else
                                            <input type="text" id="father" name="father" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a father.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="mother">Mother <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($familyInfo[0]->mother))
                                            <input type="text" id="mother" name="mother" class="form-control" value="{{ $familyInfo[0]->mother }}">
                                            @else
                                            <input type="text" id="mother" name="mother" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a mother.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="brother_sister">Brother / Sister <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($familyInfo[0]->brother_sister))
                                            <input type="text" id="brother_sister" name="brother_sister" class="form-control" value="{{ $familyInfo[0]->brother_sister }}">
                                            @else
                                            <input type="text" id="brother_sister" name="brother_sister" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a brother sister.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                <?php $additionalDetails = json_decode($member->additional_personal_details); ?>
                @if ($additionalDetails)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-edit"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Additional Personal Details
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="home_district">Home District <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($additionalDetails[0]->home_district))
                                            <input type="text" id="home_district" name="home_district" class="form-control" value="{{ $additionalDetails[0]->home_district }}">
                                            @else
                                            <input type="text" id="home_district" name="home_district" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a home district.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="family_residence">Family Residence <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($additionalDetails[0]->family_residence))
                                            <input type="text" id="family_residence" name="family_residence" class="form-control" value="{{ $additionalDetails[0]->family_residence }}">
                                            @else
                                            <input type="text" id="family_residence" name="family_residence" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a family residence.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="fathers_occupation">Fathers occupation <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($additionalDetails[0]->fathers_occupation))
                                            <input type="text" id="fathers_occupation" name="fathers_occupation" class="form-control" value="{{ $additionalDetails[0]->fathers_occupation }}">
                                            @else
                                            <input type="text" id="fathers_occupation" name="fathers_occupation" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a fathers occupation.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="special_circumstances">Special Circumstances <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($additionalDetails[0]->special_circumstances))
                                            <input type="text" id="special_circumstances" name="special_circumstances" class="form-control" value="{{ $additionalDetails[0]->special_circumstances }}">
                                            @else
                                            <input type="text" id="special_circumstances" name="special_circumstances" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a special circumstances.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
                <?php $partnerExpectation = json_decode($member->partner_expectation); ?>
                @if ($partnerExpectation)
                <div class="card mb-g">
                    <div class="card-body">
                        <a href="javascript:void(0);" class="d-flex flex-row align-items-center">
                            <div class='icon-stack display-3 flex-shrink-0'>
                                <i class="fal fa-handshake"></i>
                            </div>
                            <div class="ml-3">
                                <strong>
                                    Partner Expectation
                                </strong>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="general_requirement">General Requirement <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->general_requirement))
                                            <input type="text" id="general_requirement" name="general_requirement" class="form-control" value="{{ $partnerExpectation[0]->general_requirement }}">
                                            @else
                                            <input type="text" id="general_requirement" name="general_requirement" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a general requirement.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_age">Partner Age <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_age))
                                            <input type="text" id="partner_age" name="partner_age" class="form-control" value="{{ $partnerExpectation[0]->partner_age }}">
                                            @else
                                            <input type="text" id="partner_age" name="partner_age" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner age.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_weight">Partner Weight <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_weight))
                                            <input type="text" id="partner_weight" name="partner_weight" class="form-control" value="{{ $partnerExpectation[0]->partner_weight }}">
                                            @else
                                            <input type="text" id="partner_weight" name="partner_weight" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner weight.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_height">Partner Height <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_height))
                                            <input type="text" id="partner_height" name="partner_height" class="form-control" value="{{ $partnerExpectation[0]->partner_height }}">
                                            @else
                                            <input type="text" id="partner_height" name="partner_height" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner height.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="with_children_acceptables">With Children Acceptables <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="with_children_acceptables" id="with_children_acceptables" class="form-control">
                                                @if (isset($partnerExpectation[0]->with_children_acceptables))
                                                <option <?php if($partnerExpectation[0]->with_children_acceptables == ''){ ?> selected <?php } ?> value="">Choose one</option>
                                                <option <?php if($partnerExpectation[0]->with_children_acceptables == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($partnerExpectation[0]->with_children_acceptables == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($partnerExpectation[0]->with_children_acceptables == '3'){ ?> selected <?php } ?> value="3">Dosen't Matter</option>
                                                @else
                                                <option value="">Choose one</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Dosen't Matter</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a with children acceptables.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_marital_status">Partner Marital Status<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_marital_status" id="partner_marital_status" class="form-control">
                                                <option value="">Choose one</option>
                                                <?php $marital_statuses = DB::table('marital_statuses')->get(); ?>
                                                @foreach ($marital_statuses as $pms)
                                                    @if (isset($partnerExpectation[0]->partner_marital_status))
                                                    <option <?php if($partnerExpectation[0]->partner_marital_status == $pms->id){ ?> selected <?php } ?> value="{{ $pms->id }}">{{ $pms->name }}</option>
                                                    @else
                                                    <option value="{{ $pms->id }}">{{ $pms->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner weight.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_country_of_residence">Country Of Residence<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_country_of_residence" id="partner_country_of_residence" class="form-control">
                                                <option value="">Choose one</option>
                                                @foreach ($countries as $country)
                                                    @if (isset($partnerExpectation[0]->partner_country_of_residence))
                                                    <option <?php if($partnerExpectation[0]->partner_country_of_residence == $country->id){ ?> selected <?php } ?> value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @else
                                                    <option value="{{ $pmcountry->id }}">{{ $country->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_drinking_habits">Drinking Habits <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_drinking_habits" id="partner_drinking_habits" class="form-control">
                                                @if (isset($partnerExpectation[0]->partner_drinking_habits))
                                                <option <?php if($partnerExpectation[0]->partner_drinking_habits == ''){ ?> selected <?php } ?> value="">Choose one</option>
                                                <option <?php if($partnerExpectation[0]->partner_drinking_habits == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($partnerExpectation[0]->partner_drinking_habits == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($partnerExpectation[0]->partner_drinking_habits == '3'){ ?> selected <?php } ?> value="3">Dosen't Matter</option>
                                                @else
                                                <option value="">Choose one</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Dosen't Matter</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a with partner drinking habits.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_smoking_habits">Smoking Habits <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_smoking_habits" id="partner_smoking_habits" class="form-control">
                                                @if (isset($partnerExpectation[0]->partner_smoking_habits))
                                                <option <?php if($partnerExpectation[0]->partner_smoking_habits == ''){ ?> selected <?php } ?> value="">Choose one</option>
                                                <option <?php if($partnerExpectation[0]->partner_smoking_habits == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($partnerExpectation[0]->partner_smoking_habits == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($partnerExpectation[0]->partner_smoking_habits == '3'){ ?> selected <?php } ?> value="3">Dosen't Matter</option>
                                                @else
                                                <option value="">Choose one</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Dosen't Matter</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a with partner smoking habits.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="manglik">Manglik <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="manglik" id="manglik" class="form-control">
                                                @if (isset($partnerExpectation[0]->manglik))
                                                <option <?php if($partnerExpectation[0]->manglik == ''){ ?> selected <?php } ?> value="">Choose one</option>
                                                <option <?php if($partnerExpectation[0]->manglik == '1'){ ?> selected <?php } ?> value="1">Yes</option>
                                                <option <?php if($partnerExpectation[0]->manglik == '2'){ ?> selected <?php } ?> value="2">No</option>
                                                <option <?php if($partnerExpectation[0]->manglik == '3'){ ?> selected <?php } ?> value="3">Dosen't Matter</option>
                                                @else
                                                <option value="">Choose one</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="3">Dosen't Matter</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a with manglik.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_diet">Partner Diet <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_diet))
                                            <input type="text" id="partner_diet" name="partner_diet" class="form-control" value="{{ $partnerExpectation[0]->partner_diet }}">
                                            @else
                                            <input type="text" id="partner_diet" name="partner_diet" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner diet.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_body_type">Body type <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_body_type))
                                            <input type="text" id="partner_body_type" name="partner_body_type" class="form-control" value="{{ $partnerExpectation[0]->partner_body_type }}">
                                            @else
                                            <input type="text" id="partner_body_type" name="partner_body_type" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a body type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_personal_value">Personal Value <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_personal_value))
                                            <input type="text" id="partner_personal_value" name="partner_personal_value" class="form-control" value="{{ $partnerExpectation[0]->partner_personal_value }}">
                                            @else
                                            <input type="text" id="partner_personal_value" name="partner_personal_value" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a personal value.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_complexion">Complexion <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_complexion))
                                            <input type="text" id="partner_complexion" name="partner_complexion" class="form-control" value="{{ $partnerExpectation[0]->partner_complexion }}">
                                            @else
                                            <input type="text" id="partner_complexion" name="partner_complexion" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner complenxion.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_any_disability">Disability <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->partner_any_disability))
                                            <input type="text" id="partner_any_disability" name="partner_any_disability" class="form-control" value="{{ $partnerExpectation[0]->partner_any_disability }}">
                                            @else
                                            <input type="text" id="partner_any_disability" name="partner_any_disability" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner disability.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_religions">Religion <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_religion" id="partner_religions" onchange="onChangeReligion('partner')" class="form-control select2">
                                                <option value="">Choose One</option>
                                                @foreach ($religions as $relig)
                                                @if (isset($partnerExpectation[0]->partner_religion))
                                                <option <?php if($partnerExpectation[0]->partner_religion == $relig->id){ ?> selected <?php } ?> value="{{ $relig->id }}">{{ $relig->name }}</option>
                                                @else
                                                <option value="{{ $relig->id }}">{{ $relig->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a religion.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_castes">Caste / Sect <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_caste" id="partner_castes" class="form-control select2" onchange="onChangeCast('partner')">
                                                <?php $casteName = DB::table('castes')->where('id',$partnerExpectation[0]->partner_caste)->value('name');?>
                                                <option value="{{ $partnerExpectation[0]->partner_caste }}">{{ $casteName }}</option>
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a caste.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_sub_castes">Sub Caste <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_sub_caste" id="partner_sub_castes" class="form-control select2">
                                                @if (isset($partnerExpectation[0]->partner_sub_caste))
                                                <?php $subCasteName = DB::table('sub_castes')->where('id',$partnerExpectation[0]->partner_sub_caste)->value('name');?>
                                                @if ($subCasteName)
                                                <option value="{{ $partnerExpectation[0]->partner_sub_caste }}">{{ $subCasteName }}</option>
                                                @else
                                                <option value="">Choose Cast First</option>
                                                @endif
                                                @else
                                                <option value="">Choose Cast First</option>
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a sub caste.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="prefered_status">Prefered Status <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->prefered_status))
                                            <input type="text" id="prefered_status" name="prefered_status" class="form-control" value="{{ $partnerExpectation[0]->prefered_status }}">
                                            @else
                                            <input type="text" id="prefered_status" name="prefered_status" class="form-control">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a prefered status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_mother_tongue">Partner Mother Tongue<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_mother_tongue" id="partner_mother_tongue" class="form-control">
                                                <option value="">Choose one</option>
                                                <?php $partnerMotherTongues = DB::table('languages')->get(); ?>
                                                @foreach ($partnerMotherTongues as $pmt)
                                                    @if (isset($partnerExpectation[0]->partner_mother_tongue))
                                                    <option <?php if($partnerExpectation[0]->partner_mother_tongue == $pmt->id){ ?> selected <?php } ?> value="{{ $pmt->id }}">{{ $pmt->name }}</option>
                                                    @else
                                                    <option value="{{ $pmt->id }}">{{ $pmt->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a partner mother tongue.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="prefered_country">Prefered Country<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="prefered_country" id="prefered_country" onchange="onChangeCountry('prefered')" class="form-control select2">
                                                <option value="">Choose one</option>
                                                @foreach ($countries as $pCountry)
                                                    @if (isset($partnerExpectation[0]->prefered_country))
                                                    <option <?php if($partnerExpectation[0]->prefered_country == $pCountry->id){ ?> selected <?php } ?> value="{{ $pCountry->id }}">{{ $pCountry->name }}</option>
                                                    @else
                                                    <option value="{{ $pCountry->id }}">{{ $pCountry->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a prefered country.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="prefered_state">Prefered State<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="prefered_state" id="prefered_state" class="form-control select2">
                                                <option value="">Choose one</option>

                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a prefered state.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="prefered_status">Prefered Status<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            @if (isset($partnerExpectation[0]->prefered_status))
                                            <input type="text" id="prefered_status" name="prefered_status" class="form-control" value="{{ $partnerExpectation[0]->prefered_status }}">
                                            @else
                                            <input type="text" id="prefered_status" name="prefered_status" class="form-control" value="">
                                            @endif
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a prefered status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_family_value">Family Value<span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_family_value" id="partner_family_value" class="form-control">
                                                <option value="">Choose one</option>
                                                @if (isset($partnerExpectation[0]->partner_family_value))
                                                @foreach ($familyValues as $fv)
                                                    <option <?php if($partnerExpectation[0]->partner_family_value == $fv->id){ ?> selected <?php } ?> value="{{ $fv->id }}">{{ $fv->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($familyValues as $fv)
                                                    <option value="{{ $fv->id }}">{{ $fv->name }}</option>
                                                @endforeach
                                                @endif

                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a prefered status.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_education">Education <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_education[]" id="partner_education" multiple class="select2 form-control">
                                                <option value="">Choose One</option>
                                                <?php $partnerEducation = explode(",",$partnerExpectation[0]->partner_education) ?>
                                                @foreach ($educations as $education)
                                                    <option <?php if(in_array($education->id,$partnerEducation)){ ?> selected <?php } ?> value="{{ $education->id }}">{{ $education->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a education.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-4">
                                        <label class="form-label" for="partner_profession">Profession <span class="text-danger">*</span> </label>
                                        <div class="input-group">
                                            <select name="partner_profession[]" multiple id="partner_profession" class="select2 form-control">
                                                <option value="">Select one</option>
                                                @if (isset($partnerExpectation[0]->partner_profession))
                                                @foreach ($occupations as $profession)
                                                    <?php $partnerProfession = explode("," ,$partnerExpectation[0]->partner_profession);  ?>
                                                    <option <?php if(in_array($profession->id,$partnerProfession)){ ?> selected <?php } ?> value="{{ $profession->id }}">{{ $profession->name }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($occupations as $profession)
                                                    <option value="{{ $profession->id }}">{{ $profession->name }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            <div class="valid-tooltip">
                                                Looks good!
                                            </div>
                                            <div class="invalid-tooltip">
                                                Please choose a profession.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info">Update</button>
                            </div>
                        </a>
                    </div>
                </div>
                @endif
            </form>
        </div>
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
                        <?php
                        $package_info = json_decode($member->package_info);
                        $planId = DB::table('plans')->where('name',$package_info[0]->current_package)->value('id');
                        ?>
                        <button type="button" class="btn btn-primary" onclick="return planList({{ $planId }})">Updated Package</button>
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
                                    <label for="package">Choose Package</label>
                                    <select name="package" id="package" class="form-control" required onchange="return getPlanAmount()">
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
    </div>
</main>
<!-- this overlay is activated only when mobile menu is triggered -->
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
    function planList($id){
        // $('#package').val($id).trigger('change');
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
        if (parseFloat(paid) >= parseFloat(total)) {
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
                        }location.reload();
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
<script>
    function onChangeCountry($type){
        if ($type) {
            var countryId = $("#"+$type+'_country').val();
            $("#"+$type+'_state').empty();
            $("#"+$type+'_city').empty();
            $("#"+$type+'_postal_code').val('');
        } else {
            var countryId = $("#country").val();
            $("#state").empty();
            $("#city").empty();
            $("#postal_code").val('');
        }
        if(countryId){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}states/'+countryId,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    var html = '<option value="">Choose one</option>';
                    result.forEach(state => {
                        html += '<option value="'+state.id+'">'+state.name+'</option>';
                    });
                    if ($type) {
                        $('#'+$type+'_state').html(html);
                    } else {
                        $("#state").html(html);
                    }
                }
            });
        }
    }
    function onChangeState($type){
        if ($type) {
            var stateId = $("#"+$type+'_state').val();
        } else {
            var stateId = $("#state").val();
        }

        if(stateId){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}cities/'+stateId,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    var html = '<option  value="">Choose one</option>';
                    result.forEach(city => {
                        html += '<option value="'+city.id+'">'+city.name+'</option>';
                    });
                    if ($type) {
                        var stateId = $("#"+$type+'_city').html(html);
                    } else {
                        var stateId = $("#city").html(html);
                    }
                }
            });
        }
    }
    function onChangeCity($type){
        if ($type) {
            var cityId = $("#"+$type+'_city').val();
        } else {
            var cityId = $("#city").val();
        }

        if(cityId){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}postcode/'+cityId,
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(result){
                    if(result == false){
                        if ($type) {
                            $("#"+$type+'_postal_code').val('');
                        } else {
                            $("#postal_code").val('');
                        }
                    }else{
                        if ($type) {
                            $("#"+$type+'_postal_code').val(result);
                        } else {
                            $("#postal_code").val(result);
                        }
                    }
                }
            });
        }
    }
</script>
<script>
    function onChangeReligion($type){
        if ($type) {
            var religionId = $("#"+$type+"_religions").val();
            $("#"+$type+'_castes').empty();
            $("#"+$type+'_sub_castes').empty();
        } else {
            var religionId = $("#religions").val();
            $('#castes').empty();
            $('#sub_castes').empty();
        }

        if(religionId){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}castes/'+religionId,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    var html = '<option value="">Choose one</option>';
                    result.forEach(caste => {
                        html += '<option value="'+caste.id+'">'+caste.name+'</option>';
                    });
                    if ($type) {
                        $('#'+$type+'_castes').html(html);
                    } else {
                        $("#castes").html(html);
                    }
                }
            });
        }
    }
    function onChangeCast($type){
        if ($type) {
            var casteId = $("#"+$type+"_castes").val();
            $("#"+$type+'_sub_castes').empty();
        } else {
            var casteId = $("#castes").val();
            $('#sub_castes').empty();
        }

        if(casteId){
            $.ajax({
                type: "GET",
                url: '{{ env("BASE_API_URL") }}sub_castes/'+casteId,
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                headers: {
                        "Authorization": "{{ env('API_TOKEN') }}",
                },
                success: function(result){
                    var html = '<option value="">Choose one</option>';
                    result.forEach(subcast => {
                        html += '<option value="'+subcast.id+'">'+subcast.name+'</option>';
                    });
                    if ($type) {
                        $('#'+$type+'_sub_castes').html(html);
                    } else {
                        $("#sub_castes").html(html);
                    }
                }
            });
        }
    }
</script>
@endsection
