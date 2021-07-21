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
        <a href="{{ route('member.create') }}" class="btn btn-success btn-sm" title="Add Member"><i class="fal fa-plus"> Add Member</i></a>&nbsp;
        <a href="{{ route('member.edit',$member->id) }}" class="btn btn-info btn-sm" title="Edit"><i class="fal fa-edit"> Edit</i></a>&nbsp;
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
                            <img src="{{ asset('uploads/profile_image/'.$profile_image[0]->thumb) }}" height="200" width="200" class="rounded-circle shadow-2 img-thumbnail" title="{{ $member->first_name.' '.$member->last_name}}" alt="{{ $member->first_name.' '.$member->last_name}}">
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
            <?php $happy_stories = DB::table('happy_stories')->where('posted_by',$member->id)->get(); ?>
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
                            {{ $member->introduction }}
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>First Name</td>
                                        <td>{{ $member->first_name }}</td>
                                        <td>Last Name</td>
                                        <td>{{ $member->last_name }}</td>
                                        <td>Gender</td>
                                        @if ($member->gender == '1')
                                        <td>Male</td>
                                        @else
                                        <td>Femal</td>
                                        @endif
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $member->email }}</td>
                                        <td>Phone</td>
                                        <td>{{ $member->mobile }}</td>
                                        <td>Age</td>
                                        <td>{{ date('Y') - date('Y',$member->date_of_birth) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Onbehalf</td>
                                        <?php $onBehalf = DB::table('on_behalves')->where('id',$basicInfo[0]->on_behalf)->value('name'); ?>
                                        <td>{{ $onBehalf }}</td>
                                        <td>Marital Status</td>
                                        <?php $maritalStatus = DB::table('marital_statuses')->where('id',$basicInfo[0]->marital_status)->value('name'); ?>
                                        <td>{{ $maritalStatus }}</td>
                                        <td>Area</td>
                                        <td>{{ $basicInfo[0]->area }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Country</td>
                                        <?php $countryName = DB::table('countries')->where('id',$presentAddress[0]->country)->value('name'); ?>
                                        <td>{{ $countryName }}</td>
                                        <?php $cityName = DB::table('cities')->where('id',$presentAddress[0]->city)->value('name'); ?>
                                        <td>City</td>
                                        <td>{{ $cityName }}</td>
                                        <?php $stateName = DB::table('states')->where('id',$presentAddress[0]->state)->value('name'); ?>
                                        <td>State</td>
                                        <td>{{ $stateName }}</td>
                                        <td>Postal-Code</td>
                                        <td>{{ $presentAddress[0]->postal_code }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        @isset($educationCareer[0]->highest_education)
                                        <td>Highest Education</td>
                                        <?php $educationName = DB::table('education')->where('id',$educationCareer[0]->highest_education)->value('name'); ?>
                                        <td>{{ $educationName }}</td>
                                        @endisset
                                        @isset($educationCareer[0]->university)
                                        <td>University</td>
                                        <?php $universityName = DB::table('universities')->where('id',$educationCareer[0]->university)->value('name'); ?>
                                        <td>{{ $universityName }}</td>
                                        @endisset
                                        @isset($educationCareer[0]->occupation)
                                        <?php $occupationName = DB::table('occupations')->where('id',$educationCareer[0]->occupation)->value('name'); ?>
                                        <td>Occupation</td>
                                        <td>{{ $occupationName }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        @isset($educationCareer[0]->annual_income)
                                        <td>Annual Income</td>
                                        <?php $annualIncome = DB::table('incomes')->where('id',$educationCareer[0]->annual_income)->value('name'); ?>
                                        <td><?php echo $annualIncome ;?></td>
                                        @endisset
                                        @isset($educationCareer[0]->post)
                                        <td>Post</td>
                                        <td>{{ $educationCareer[0]->post }}</td>
                                        @endisset
                                        @isset($educationCareer[0]->company_name)
                                        <td>Company Name</td>
                                        <td>{{ $educationCareer[0]->company_name }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        @isset($member->height)
                                        <td>Height</td>
                                        <td>{{ $member->height }} feet</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->weight)
                                        <td>Weight</td>
                                        <td>{{ $physicalAttributes[0]->weight }}</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->eye_color)
                                        <td>Eye Color</td>
                                        <td>{{ $physicalAttributes[0]->eye_color }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        @isset($physicalAttributes[0]->hair_color)
                                        <td>Hair Color</td>
                                        <td>{{ $physicalAttributes[0]->hair_color }}</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->complexion)
                                        <td>Complexion</td>
                                        <td>{{ $physicalAttributes[0]->complexion }}</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->blood_group)
                                        <td>Blood Group</td>
                                        <td>{{ $physicalAttributes[0]->blood_group }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        @isset($physicalAttributes[0]->body_type)
                                        <td>Body Type</td>
                                        <td>{{ $physicalAttributes[0]->body_type }}</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->body_art)
                                        <td>Body Art</td>
                                        <td>{{ $physicalAttributes[0]->body_art }}</td>
                                        @endisset
                                        @isset($physicalAttributes[0]->any_disability)
                                        <td>Any Disability</td>
                                        <td>{{ $physicalAttributes[0]->any_disability }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        @isset($language[0]->mother_tongue)
                                        <?php $mother_tongue = DB::table('languages')->where('id',$language[0]->mother_tongue)->value('name'); ?>
                                        <td>Mother Tongue</td>
                                        <td>{{ $mother_tongue }}</td>
                                        @endisset
                                        @isset($language[0]->language)
                                        <td>Language</td>
                                        <?php $languageName = DB::table('languages')->where('id',$language[0]->language)->value('name'); ?>
                                        <td>{{ $languageName }}</td>
                                        @endisset
                                        @isset($language[0]->speak)
                                        <td>Speak</td>
                                        <?php $speak = DB::table('languages')->where('id',$language[0]->speak)->value('name'); ?>
                                        <td>{{ $speak }}</td>
                                        @endisset
                                        @isset($language[0]->read)
                                        <td>Read</td>
                                        <?php $read = DB::table('languages')->where('id',$language[0]->read)->value('name'); ?>
                                        <td>{{ $read }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Hobby</td>
                                        @isset($hobbiesInterest[0]->hobby)
                                        <td>{{ $hobbiesInterest[0]->hobby }}</td>
                                        @endisset
                                        <td>Interest</td>
                                        @isset($hobbiesInterest[0]->interest)
                                        <td>{{ $hobbiesInterest[0]->interest }}</td>
                                        @endisset
                                        <td>Music</td>
                                        @isset($hobbiesInterest[0]->music)
                                        <td>{{ $hobbiesInterest[0]->music }}</td>
                                        @endisset
                                        <td>Books</td>
                                        @isset($hobbiesInterest[0]->books)
                                        <td>{{ $hobbiesInterest[0]->books }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Movie</td>
                                        @isset($hobbiesInterest[0]->movie)
                                        <td>{{ $hobbiesInterest[0]->movie }}</td>
                                        @endisset
                                        <td>TV Show</td>
                                        @isset($hobbiesInterest[0]->tv_show)
                                        <td>{{ $hobbiesInterest[0]->tv_show }}</td>
                                        @endisset
                                        <td>Sports Show</td>
                                        @isset($hobbiesInterest[0]->sports_show)
                                        <td>{{ $hobbiesInterest[0]->sports_show }}</td>
                                        @endisset
                                        <td>Fitness Activity</td>
                                        @isset($hobbiesInterest[0]->fitness_activity)
                                        <td>{{ $hobbiesInterest[0]->fitness_activity }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Cuisine</td>
                                        @isset($hobbiesInterest[0]->cuisine)
                                        <td>{{ $hobbiesInterest[0]->cuisine }}</td>
                                        @endisset
                                        <td>Dress Style</td>
                                        @isset($hobbiesInterest[0]->dress_style)
                                        <td>{{ $hobbiesInterest[0]->dress_style }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Affection</td>
                                        @isset($personalBehavior[0]->affection)
                                        <td>{{ $personalBehavior[0]->affection }}</td>
                                        @endisset
                                        <td>Humor</td>
                                        @isset($personalBehavior[0]->humor)
                                        <td>{{ $personalBehavior[0]->humor }}</td>
                                        @endisset
                                        <td>Political View</td>
                                        @isset($personalBehavior[0]->political_view)
                                        <td>{{ $personalBehavior[0]->political_view }}</td>
                                        @endisset
                                        <td>Religious</td>
                                        @isset($personalBehavior[0]->religious_service)
                                        <td>{{ $personalBehavior[0]->religious_service }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Birth Country</td>
                                        @isset($residencyInformation[0]->birth_country)
                                        <?php $birthCoutry = DB::table('countries')->where('id',$residencyInformation[0]->birth_country)->value('name'); ?>
                                        <td>{{ $birthCoutry }}</td>
                                        @endisset
                                        <td>Residency Country</td>
                                        @isset($residencyInformation[0]->residency_country)
                                        <?php $residencyCountry = DB::table('countries')->where('id',$residencyInformation[0]->residency_country)->value('name'); ?>
                                        <td>{{ $residencyCountry }}</td>
                                        @endisset
                                        <td>Citizenship Country</td>
                                        @isset($residencyInformation[0]->citizenship_country)
                                        <?php $citizenshipCountry = DB::table('countries')->where('id',$residencyInformation[0]->citizenship_country)->value('name'); ?>
                                        <td>{{ $citizenshipCountry }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Grow Up Country</td>
                                        @isset($residencyInformation[0]->grow_up_country)
                                        <?php $growUpCountry = DB::table('countries')->where('id',$residencyInformation[0]->grow_up_country)->value('name'); ?>
                                        <td>{{ $growUpCountry }}</td>
                                        @endisset
                                        <td>Immigration Status</td>
                                        @isset($residencyInformation[0]->immigration_status)
                                        <td>{{ $residencyInformation[0]->immigration_status }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Religion</td>
                                        @isset($spiritualBackground[0]->religion)
                                        <?php $religionName = DB::table('religions')->where('id',$spiritualBackground[0]->religion)->value('name');?>
                                        <td>{{ $religionName }}</td>
                                        @endisset
                                        <td>Caste / Sect</td>
                                        @isset($spiritualBackground[0]->caste)
                                        <?php $casteName = DB::table('castes')->where('id',$spiritualBackground[0]->caste)->value('name');?>
                                        <td>{{ $casteName }}</td>
                                        @endisset
                                        <td>Sub-Caste</td>
                                        @isset($spiritualBackground[0]->sub_caste)
                                        <?php $subCasteName = DB::table('sub_castes')->where('id',$spiritualBackground[0]->sub_caste)->value('name');?>
                                        <td>{{ $subCasteName }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Ethnicity</td>
                                        @isset($spiritualBackground[0]->ethnicity)
                                        <td>{{ $spiritualBackground[0]->ethnicity }}</td>
                                        @endisset
                                        <td>Personal Value</td>
                                        @isset($spiritualBackground[0]->personal_value)
                                        <td>{{ $spiritualBackground[0]->personal_value }}</td>
                                        @endisset
                                        <td>Family Value</td>
                                        @isset($spiritualBackground[0]->family_value)
                                        <?php $familyValue = DB::table('family_values')->where('id',$spiritualBackground[0]->family_value)->value('name');?>
                                        <td>{{ $familyValue }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Community Value</td>
                                        @isset($spiritualBackground[0]->community_value)
                                        <td>{{ $spiritualBackground[0]->community_value }}</td>
                                        @endisset
                                        <td>Family Status</td>
                                        @isset($spiritualBackground[0]->family_status)
                                        <?php $familyStatus = DB::table('family_statuses')->where('id',$spiritualBackground[0]->family_status)->value('name');?>
                                        <td>{{ $familyStatus }}</td>
                                        @endisset
                                        <td>Manglik </td>
                                        @isset($spiritualBackground[0]->u_manglik)
                                        @if ($spiritualBackground[0]->u_manglik == '1')
                                        <td>Yes</td>
                                        @elseif($spiritualBackground[0]->u_manglik == '2')
                                        <td>No</td>
                                        @elseif($spiritualBackground[0]->u_manglik == '3')
                                        <td>I don't know</td>
                                        @endif
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Diet</td>
                                        @isset($lifeStyle[0]->diet)
                                        <td>{{ $lifeStyle[0]->diet }}</td>
                                        @endisset
                                        <td>Drink</td>
                                        @isset($lifeStyle[0]->drink)
                                        @if ($lifeStyle[0]->drink == '1')
                                        <td>Yes</td>
                                        @elseif($lifeStyle[0]->drink == '2')
                                        <td>No</td>
                                        @elseif($lifeStyle[0]->drink == '3')
                                        <td>Doesn't Matter</td>
                                        @endif
                                        @endisset
                                        <td>Smoke</td>
                                        @isset($lifeStyle[0]->smoke)
                                        @if ($lifeStyle[0]->smoke == '1')
                                        <td>Yes</td>
                                        @elseif($lifeStyle[0]->smoke == '2')
                                        <td>No</td>
                                        @elseif($lifeStyle[0]->smoke == '3')
                                        <td>Doesn't Matter</td>
                                        @endif
                                        @endisset
                                        <td>Living With</td>
                                        @isset($lifeStyle[0]->living_with)
                                        <td>{{ $lifeStyle[0]->living_with }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Sun Sign</td>
                                        @isset($astronomicInformation[0]->sun_sign)
                                        <td>{{ $astronomicInformation[0]->sun_sign }}</td>
                                        @endisset
                                        <td>Moon Sign</td>
                                        @isset($astronomicInformation[0]->moon_sign)
                                        <td>{{ $astronomicInformation[0]->moon_sign }}</td>
                                        @endisset
                                        <td>Time Of Birth</td>
                                        @isset($astronomicInformation[0]->time_of_birth)
                                        <td>{{ $astronomicInformation[0]->time_of_birth }}</td>
                                        @endisset
                                        <td>City Of Birth</td>
                                        @isset($astronomicInformation[0]->city_of_birth)
                                        <td>{{ $astronomicInformation[0]->city_of_birth }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Country</td>
                                        <?php $countryName = DB::table('countries')->where('id',$permanentAddress[0]->permanent_country)->value('name'); ?>
                                        <td>{{ $countryName }}</td>
                                        <?php $cityName = DB::table('cities')->where('id',$permanentAddress[0]->permanent_city)->value('name'); ?>
                                        <td>City</td>
                                        <td>{{ $cityName }}</td>
                                        <?php $stateName = DB::table('states')->where('id',$permanentAddress[0]->permanent_state)->value('name'); ?>
                                        <td>State</td>
                                        <td>{{ $stateName }}</td>
                                        <td>Postal-Code</td>
                                        <td>{{ $permanentAddress[0]->permanent_postal_code }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Father</td>
                                        @isset($familyInfo->father)
                                        <td>{{ $familyInfo->father }}</td>
                                        @endisset
                                        <td>Mother</td>
                                        @isset($familyInfo->mother)
                                        <td>{{ $familyInfo->mother }}</td>
                                        @endisset
                                        <td>Brother / Sister</td>
                                        @isset($familyInfo->brother_sister)
                                        <td>{{ $familyInfo->brother_sister }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>Home District</td>
                                        @isset($additionalDetails[0]->home_district)
                                        <td>{{ $additionalDetails[0]->home_district }}</td>
                                        @endisset
                                        <td>Family Residence</td>
                                        @isset($additionalDetails[0]->family_residence)
                                        <td>{{ $additionalDetails[0]->family_residence }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Fathers Occupation</td>
                                        @isset($additionalDetails[0]->fathers_occupation)
                                        <td>{{ $additionalDetails[0]->fathers_occupation }}</td>
                                        @endisset
                                        <td>Special Circumstances</td>
                                        @isset($additionalDetails[0]->special_circumstances)
                                        <td>{{ $additionalDetails[0]->special_circumstances }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
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
                            <table class="table m-0">
                                <tbody>
                                    <tr>
                                        <td>General Requirement</td>
                                        @isset($partnerExpectation[0]->general_requirement)
                                        <td>{{ $partnerExpectation[0]->general_requirement }}</td>
                                        @endisset
                                        <td>Age</td>
                                        @isset($partnerExpectation[0]->partner_age)
                                        <td>{{ $partnerExpectation[0]->partner_age }}</td>
                                        @endisset
                                        <td>Height</td>
                                        @isset($partnerExpectation[0]->partner_height)
                                        <td>{{ $partnerExpectation[0]->partner_height }}</td>
                                        @endisset
                                        <td>Weight</td>
                                        @isset($partnerExpectation[0]->partner_weight)
                                        <td>{{ $partnerExpectation[0]->partner_weight }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Marital Status</td>
                                        @isset($partnerExpectation[0]->partner_marital_status)
                                        <?php $maritalStatus = DB::table('marital_statuses')->where('id',$partnerExpectation[0]->partner_marital_status)->value('name'); ?>
                                        <td>{{ $maritalStatus }}</td>
                                        @endisset
                                        <td>With Children</td>
                                        @isset($partnerExpectation[0]->with_children_acceptables)
                                        @if ($partnerExpectation[0]->with_children_acceptables == '1')
                                        <td>Yes</td>
                                        @elseif($partnerExpectation[0]->with_children_acceptables == '2')
                                        <td>No</td>
                                        @elseif($partnerExpectation[0]->with_children_acceptables == '3')
                                        <td>Dose't Matter</td>
                                        @endif
                                        @endisset
                                        <td>Residence Country</td>
                                        @isset($partnerExpectation[0]->partner_country_of_residence)
                                        <?php $residenceCountryName = DB::table('countries')->where('id',$partnerExpectation[0]->partner_country_of_residence)->value('name'); ?>
                                        <td>{{ $residenceCountryName }}</td>
                                        @endisset
                                        <td>Diet</td>
                                        @isset($partnerExpectation[0]->partner_diet)
                                        <td>{{ $partnerExpectation[0]->partner_diet }}</td>
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Religion</td>
                                        @isset($partnerExpectation[0]->partner_religion)
                                        <?php $partnerReligion = DB::table('religions')->where('id',$partnerExpectation[0]->partner_religion)->value('name'); ?>
                                        <td>{{ $partnerReligion }}</td>
                                        @endisset
                                        <td>Caste</td>
                                        @isset($partnerExpectation[0]->partner_caste)
                                        <?php $partnerCaste = DB::table('castes')->where('id',$partnerExpectation[0]->partner_caste)->value('name'); ?>
                                        <td>{{ $partnerCaste }}</td>
                                        @endisset
                                        <td>Complexion</td>
                                        @isset($partnerExpectation[0]->partner_complexion)
                                        <td>{{ $partnerExpectation[0]->partner_complexion }}</td>
                                        @endisset
                                        <td>Drink</td>
                                        @isset($partnerExpectation[0]->partner_drinking_habits)
                                        @if ($partnerExpectation[0]->partner_drinking_habits == '1')
                                        <td>Yes</td>
                                        @elseif($partnerExpectation[0]->partner_drinking_habits == '2')
                                        <td>No</td>
                                        @elseif($partnerExpectation[0]->partner_drinking_habits == '3')
                                        <td>Dose't Matter</td>
                                        @endif
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Smoking</td>
                                        @isset($partnerExpectation[0]->partner_smoking_habits)
                                        @if ($partnerExpectation[0]->partner_smoking_habits == '1')
                                        <td>Yes</td>
                                        @elseif($partnerExpectation[0]->partner_smoking_habits == '2')
                                        <td>No</td>
                                        @elseif($partnerExpectation[0]->partner_smoking_habits == '3')
                                        <td>Dose't Matter</td>
                                        @endif
                                        @endisset
                                        <td>Body</td>
                                        @isset($partnerExpectation[0]->partner_body_type)
                                        <td>{{ $partnerExpectation[0]->partner_body_type }}</td>
                                        @endisset
                                        <td>Personal Value</td>
                                        @isset($partnerExpectation[0]->partner_personal_value)
                                        <td>{{ $partnerExpectation[0]->partner_personal_value }}</td>
                                        @endisset
                                        <td>Manglik</td>
                                        @isset($partnerExpectation[0]->manglik)
                                        @if ($partnerExpectation[0]->manglik == '1')
                                        <td>Yes</td>
                                        @elseif($partnerExpectation[0]->manglik == '2')
                                        <td>No</td>
                                        @elseif($partnerExpectation[0]->manglik == '3')
                                        <td>Dose't Matter</td>
                                        @endif
                                        @endisset
                                    </tr>
                                    <tr>
                                        <td>Disability</td>
                                        @isset($partnerExpectation[0]->partner_any_disability)
                                        <td>{{ $partnerExpectation[0]->partner_any_disability }}</td>
                                        @endisset
                                        <td>Mother tongue</td>
                                        @isset($partnerExpectation[0]->partner_mother_tongue)
                                        <?php $partnerMotherTongue = DB::table('languages')->where('id',$partnerExpectation[0]->partner_mother_tongue)->value('name'); ?>
                                        <td>{{ $partnerMotherTongue }}</td>
                                        @endisset
                                        <td>Family Value</td>
                                        @isset($partnerExpectation[0]->partner_family_value)
                                        <td>{{ $partnerExpectation[0]->partner_family_value }}</td>
                                        @endisset
                                        <td>Prefered Status</td>
                                        @isset($partnerExpectation[0]->prefered_status)
                                        <td>{{ $partnerExpectation[0]->prefered_status }}</td>
                                        @endisset
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </a>
                </div>
            </div>
            @endif
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
                        <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="return changeGroup()">Save changes</button>
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
                            "Authorization": "Bearer " + "{{ Cookie::get('laravel_token') }}",
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
        $('#updateGroupForm').attr('action','{{ env("BASE_API_URL") }}member-group/'+id);
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
