<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $company = DB::table('company_settings')->first();?>
        <meta charset="utf-8">
        <title>
            {{$company->name}} | {{ $menu }} | @yield('title') | {{ Auth::user()->name }}
        </title>
        <meta name="description" content="Marketing Dashboard">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <?php $logo = json_decode($company->logo); ?>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}">
        <link rel="icon" type="image/webp" sizes="32x32" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}">
        <link rel="mask-icon" href="{{ asset('uploads/logo/'.$logo[0]->thumb) }}" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/notifications/sweetalert2/sweetalert2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/formplugins/select2/select2.bundle.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/formplugins/summernote/summernote.css">
        <link rel="stylesheet" media="screen, print" href="{{ asset('assets/backend') }}/css/statistics/chartjs/chartjs.css">
    </head>
    <body class="mod-bg-1 ">
        <?php
        $year = date('Y');
        // $freeMember;
        // $paidMember;
        // $payment;
        for ($i=1; $i <= 12 ; $i++) {
            $start = $year.'-'.$i.'-01';
            $end = $year.'-'.$i.'-31';
            $member = DB::table('members')->where('membership','2')
                           ->where('member_since', '>=', $start)
                           ->where('member_since', '<=', $end)
                           ->get();
            $freeMember[] = count($member);
        }
        for ($i=1; $i <= 12 ; $i++) {
            $start = $year.'-'.$i.'-01';
            $end = $year.'-'.$i.'-31';
            $member = DB::table('members')->where('membership','1')
                           ->where('member_since', '>=', $start)
                           ->where('member_since', '<=', $end)
                           ->get();
            $paidMember[] = count($member);
        }
        for ($i=1; $i <= 12 ; $i++) {
            $start = $year.'-'.$i.'-01';
            $end = $year.'-'.$i.'-31';
            $sell = DB::table('payments')->where('status','paid')
                           ->where('created_at', '>=', $start)
                           ->where('created_at', '<=', $end)
                           ->sum('total');
            $payment[] = $sell;
        }
        ?>
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /**
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /**
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /**
             * Save to localstorage
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /**
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="{{ route('dashboard') }}" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <img style="width:60px;height:60px; border-radius:10%" src="{{ asset('uploads/logo/'.$logo[0]->thumb) }}" alt="{{ $company->name }}" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">{{ $company->name }}</span>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="nav-filter">
                            <div class="position-relative">
                                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                                    <i class="fal fa-chevron-up"></i>
                                </a>
                            </div>
                        </div>
                        <div class="info-card">
                            <img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="{{ Auth::user()->name }}">
                            <div class="info-card-text">
                                <a href="#" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                        {{ Auth::user()->name }}
                                    </span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm">{{ Auth::user()->email }}</span>
                            </div>
                            <img src="{{ asset('assets/backend') }}/img/card-backgrounds/cover-6-lg.png" class="cover" alt="cover">
                            <a href="#" onclick="return false;" class="pull-trigger-btn" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar" data-focus="nav_filter_input">
                                <i class="fal fa-angle-down"></i>
                            </a>
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li <?php if($menu == 'Dashboard'){ ?> class="active" <?php } ?>>
                                <a href="{{ route('dashboard') }}" title="Dashboard" data-filter-tags="application intel">
                                    <i class="fal fa-tachometer"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
                                </a>
                            </li>
                            <li <?php if($menu == 'Admin Settings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Manage Admin" data-filter-tags="theme settings">
                                    <i class="fal fa-lock"></i>
                                    <span class="nav-link-text" data-i18n="nav.theme_settings">Manage Admin</span>
                                </a>
                                <ul>
                                    @can('user-list')
                                    <li <?php if(Request::segment(1) == 'user'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('user.index') }}" title="Admin Users" data-filter-tags="theme settings how it works">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_how_it_works">Admin Users</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('role-list')
                                    <li <?php if(Request::segment(1) == 'role'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('role.index') }}" title="Layout Options" data-filter-tags="theme settings layout options">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_layout_options">Roles</span>
                                        </a>
                                    </li>
                                    @endcan
                                    @can('permission-list')
                                    <li <?php if(Request::segment(1) == 'permission'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('permission.index') }}" title="Skin Options" data-filter-tags="theme settings skin options">
                                            <span class="nav-link-text" data-i18n="nav.theme_settings_skin_options">Permissions</span>
                                        </a>
                                    </li>
                                    @endcan
                                </ul>
                            </li>
                            <li <?php if($menu == 'Members'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Members" data-filter-tags="package info">
                                    <i class="fal fa-users"></i>
                                    <span class="nav-link-text" data-i18n="nav.package_info">Members</span>
                                </a>
                                <ul>
                                    <li <?php if(request()->path() == 'member/create'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('member.create') }}" title="Documentation" data-filter-tags="package info documentation">
                                            <span class="nav-link-text" data-i18n="nav.package_info_documentation">Add Member</span>
                                        </a>
                                    </li>
                                    <li <?php if(request()->path() == 'member' && Request::get('type') == '1'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('member.index','type=1') }}" title="Documentation" data-filter-tags="package info documentation">
                                            <span class="nav-link-text" data-i18n="nav.package_info_documentation">Free Members</span>
                                        </a>
                                    </li>
                                    <li <?php if(request()->path() == 'member' && Request::get('type') == '2'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('member.index','type=2') }}" title="Product Licensing" data-filter-tags="package info product licensing">
                                            <span class="nav-link-text" data-i18n="nav.package_info_product_licensing">Premimum Members</span>
                                        </a>
                                    </li>
                                    <li <?php if(request()->path() == 'deleted-member'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('deleted-member.index') }}" title="Different Flavors" data-filter-tags="package info different flavors">
                                            <span class="nav-link-text" data-i18n="nav.package_info_different_flavors">Deleted Members</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-title">Company Management</li> --}}
                            <li <?php if($menu == 'Company Settings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Company Settings" data-filter-tags="ui components">
                                    <i class="fal fa-building"></i>
                                    <span class="nav-link-text" data-i18n="nav.ui_components">Company Settings</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'company'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('company.index') }}" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Company Information</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('company.show',1) }}" title="Alerts" data-filter-tags="ui components alerts">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_alerts">Google Map</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'social-link'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('social-link.index') }}" title="Accordions" data-filter-tags="ui components accordions">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_accordions">Social Links</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'smtp'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('smtp.index') }}" title="Badges" data-filter-tags="ui components badges">
                                            <span class="nav-link-text" data-i18n="nav.ui_components_badges">SMTP Setting</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Premium Package'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Premium Package" data-filter-tags="uPremimum Packagetilities">
                                    <i class="fal fa-bolt"></i>
                                    <span class="nav-link-text" data-i18n="nav.utilities">Premium Package</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'plan'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('plan.index') }}" title="Borders" data-filter-tags="utilities borders">
                                            <span class="nav-link-text" data-i18n="nav.utilities_borders">Plans</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Profile Attributes'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Font Icons" data-filter-tags="font icons">
                                    <i class="fal fa-id-badge"></i>
                                    <span class="nav-link-text" data-i18n="nav.font_icons">Profile Attributes</span>
                                    <span class="dl-ref bg-primary-500 hidden-nav-function-minify hidden-nav-function-top"></span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'religion'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('religion.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Religion</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'caste'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('caste.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Caste</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'sub-caste'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('sub-caste.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Sub Caste</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'language'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('language.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Language</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'country'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('country.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Country</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'state'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('state.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">State</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'city'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('city.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">City</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'family-status'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('family-status.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Family Status</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'family-value'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('family-value.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Family Value</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'on-behalf'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('on-behalf.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">On Behalf</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'occupation'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('occupation.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Occupation</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'marital-status'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('marital-status.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Marital Status</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'education'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('education.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Education</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'university'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('university.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">University</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'income'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('income.index') }}" title="FontAwesome" data-filter-tags="font icons fontawesome">
                                            <span class="nav-link-text" data-i18n="nav.font_icons_fontawesome">Income</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Frontend Settings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Frontend Settings" data-filter-tags="frontend_settings">
                                    <i class="fal fa-credit-card-front"></i>
                                    <span class="nav-link-text" data-i18n="nav.frontend_settings">Frontend Settings</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'side-menu'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('side-menu.index') }}" title="Side Menu" data-filter-tags="side menu">
                                            <span class="nav-link-text" data-i18n="nav.side_menu">Side Menu</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'slider'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('slider.index') }}" title="Slider" data-filter-tags="slider">
                                            <span class="nav-link-text" data-i18n="nav.slider">Slider</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'how-we-work'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('how-we-work.index') }}" title="How We Work" data-filter-tags="how we work">
                                            <span class="nav-link-text" data-i18n="nav.how_we_work">How We Work</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'happy-story'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('happy-story.index') }}" title="Happy Story" data-filter-tags="happy story">
                                            <span class="nav-link-text" data-i18n="nav.happy_story">Happy Story</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'gallery'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('gallery.index') }}" title="Gallery" data-filter-tags="tables gallery">
                                            <span class="nav-link-text" data-i18n="nav.gallery">Gallery</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Extra Settings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Extra Settings" data-filter-tags="extra settings">
                                    <i class="fal fa-cogs"></i>
                                    <span class="nav-link-text" data-i18n="nav.form_stuff">Extra Settings</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'follow'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('follow.index') }}" title="Follow Us" data-filter-tags="form stuff follow us">
                                            <span class="nav-link-text" data-i18n="nav.form_stuff_basic_inputs">Follow Us</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'contact'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('contact.index') }}" title="Contact Us" data-filter-tags="form stuff contact us">
                                            <span class="nav-link-text" data-i18n="nav.form_stuff_checkbox_&_radio">Contact Us</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'payment-option'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('payment-option.index') }}" title="Payment Options" data-filter-tags="form stuff payment options">
                                            <span class="nav-link-text" data-i18n="nav.form_stuff_checkbox_&_radio">Payment Options</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'footer-link'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('footer-link.index') }}" title="Footer Links" data-filter-tags="form stuff footer links">
                                            <span class="nav-link-text" data-i18n="nav.form_stuff_checkbox_&_radio">Footer Links</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'career'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('career.index') }}" title="Career" data-filter-tags="form stuff career">
                                            <span class="nav-link-text" data-i18n="nav.form_stuff_checkbox_&_radio">Career</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            {{-- <li class="nav-title">Plugins & Addons</li> --}}
                            <li <?php if($menu == 'Email Settings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Email Settings" data-filter-tags="email settings">
                                    <i class="fal fa-envelope"></i>
                                    <span class="nav-link-text" data-i18n="nav.email_settings">Email Settings</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'email-setup'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('email-setup.index') }}" title="Email Setup" data-filter-tags="plugins email setup">
                                            <span class="nav-link-text" data-i18n="nav.email_setup">Email Setup</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Blog'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Blog" data-filter-tags="blog datagrid">
                                    <i class="fal fa-rss-square"></i>
                                    <span class="nav-link-text" data-i18n="nav.blog">Blog</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'blog-category'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('blog-category.index') }}" title="Blog Category" data-filter-tags="datatables datagrid blog category">
                                            <span class="nav-link-text" data-i18n="nav.blog_category">Blog Category</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'blog'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('blog.index') }}" title="Blog Post" data-filter-tags="datatables datagrid blog post">
                                            <span class="nav-link-text" data-i18n="nav.blog_post">Blog Post</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Earnings'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Earnings" data-filter-tags="earnings chart graphs">
                                    <i class="fal fa-lira-sign"></i>
                                    <span class="nav-link-text" data-i18n="nav.earnings">Earnings</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'payment'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('payment.create') }}" title="Sells" data-filter-tags="statistics chart graphs sells bar pie">
                                            <span class="nav-link-text" data-i18n="nav.sells">Add New Payment</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'payment'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('payment.index') }}" title="Sells" data-filter-tags="statistics chart graphs sells bar pie">
                                            <span class="nav-link-text" data-i18n="nav.sells">Sells</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'payment-detail'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('payment-detail.index') }}" title="Payments" data-filter-tags="statistics chart graphs payments bar pie">
                                            <span class="nav-link-text" data-i18n="nav.payments">Payments</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li <?php if($menu == 'Configurations'){ ?> class="active open" <?php } ?>>
                                <a href="#" title="Configurations" data-filter-tags="configurations">
                                    <i class="fal fa-recycle"></i>
                                    <span class="nav-link-text" data-i18n="nav.configurations">Configurations</span>
                                </a>
                                <ul>
                                    <li <?php if(Request::segment(1) == 'recaptcha'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('recaptcha.index') }}" title="reCAPTCHA" data-filter-tags="configurations reCAPTCHA">
                                            <span class="nav-link-text" data-i18n="nav.configurations_reCAPTCHA">reCAPTCHA</span>
                                        </a>
                                    </li>
                                    <li <?php if(Request::segment(1) == 'google-analytics'){ ?> class="active" <?php } ?>>
                                        <a href="{{ route('google-analytics.index') }}" title="Google Analytics" data-filter-tags="configurations google_analytics">
                                            <span class="nav-link-text" data-i18n="nav.configurations_google_analytics">Google Analytics</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" title="SEO Settings" data-filter-tags="SEO Settings">
                                    <i class="fal fa-search"></i>
                                    <span class="nav-link-text" data-i18n="nav.seo_settings">SEO Settings</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Contact Messages" data-filter-tags="contact messages">
                                    <i class="fal fa-comment"></i>
                                    <span class="nav-link-text" data-i18n="nav.contact_messages">Contact Messages</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="Pages" data-filter-tags="pages">
                                    <i class="fal fa-plus-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.pages">Payment Getway Settings</span>
                                </a>
                                <ul>
                                    <li>
                                        <a href="page_chat.html" title="Chat" data-filter-tags="pages chat">
                                            <span class="nav-link-text" data-i18n="nav.pages_chat">Chat</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_contacts.html" title="Contacts" data-filter-tags="pages contacts">
                                            <span class="nav-link-text" data-i18n="nav.pages_contacts">Contacts</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" title="Forum" data-filter-tags="pages forum">
                                            <span class="nav-link-text" data-i18n="nav.pages_forum">Forum</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="page_forum_list.html" title="List" data-filter-tags="pages forum list">
                                                    <span class="nav-link-text" data-i18n="nav.pages_forum_list">List</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_forum_threads.html" title="Threads" data-filter-tags="pages forum threads">
                                                    <span class="nav-link-text" data-i18n="nav.pages_forum_threads">Threads</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_forum_discussion.html" title="Discussion" data-filter-tags="pages forum discussion">
                                                    <span class="nav-link-text" data-i18n="nav.pages_forum_discussion">Discussion</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" title="Inbox" data-filter-tags="pages inbox">
                                            <span class="nav-link-text" data-i18n="nav.pages_inbox">Inbox</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="page_inbox_general.html" title="General" data-filter-tags="pages inbox general">
                                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_general">General</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_inbox_read.html" title="Read" data-filter-tags="pages inbox read">
                                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_read">Read</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_inbox_write.html" title="Write" data-filter-tags="pages inbox write">
                                                    <span class="nav-link-text" data-i18n="nav.pages_inbox_write">Write</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page_invoice.html" title="Invoice (printable)" data-filter-tags="pages invoice (printable)">
                                            <span class="nav-link-text" data-i18n="nav.pages_invoice_(printable)">Invoice (printable)</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" title="Authentication" data-filter-tags="pages authentication">
                                            <span class="nav-link-text" data-i18n="nav.pages_authentication">Authentication</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="page_forget.html" title="Forget Password" data-filter-tags="pages authentication forget password">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_forget_password">Forget Password</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_locked.html" title="Locked Screen" data-filter-tags="pages authentication locked screen">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_locked_screen">Locked Screen</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_login.html" title="Login" data-filter-tags="pages authentication login">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_login">Login</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_login-alt.html" title="Login Alt" data-filter-tags="pages authentication login alt">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_login_alt">Login Alt</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_register.html" title="Register" data-filter-tags="pages authentication register">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_register">Register</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_confirmation.html" title="Confirmation" data-filter-tags="pages authentication confirmation">
                                                    <span class="nav-link-text" data-i18n="nav.pages_authentication_confirmation">Confirmation</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0);" title="Error Pages" data-filter-tags="pages error pages">
                                            <span class="nav-link-text" data-i18n="nav.pages_error_pages">Error Pages</span>
                                        </a>
                                        <ul>
                                            <li>
                                                <a href="page_error.html" title="General Error" data-filter-tags="pages error pages general error">
                                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_general_error">General Error</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_error_404.html" title="Server Error" data-filter-tags="pages error pages server error">
                                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_server_error">Server Error</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="page_error_announced.html" title="Announced Error" data-filter-tags="pages error pages announced error">
                                                    <span class="nav-link-text" data-i18n="nav.pages_error_pages_announced_error">Announced Error</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="page_profile.html" title="Profile" data-filter-tags="pages profile">
                                            <span class="nav-link-text" data-i18n="nav.pages_profile">Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="page_search.html" title="Search Results" data-filter-tags="pages search results">
                                            <span class="nav-link-text" data-i18n="nav.pages_search_results">Search Results</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                    <!-- END PRIMARY NAVIGATION -->
                    <!-- NAV FOOTER -->
                    <div class="nav-footer shadow-top">
                        <a href="#" onclick="return false;" data-action="toggle" data-class="nav-function-minify" class="hidden-md-down">
                            <i class="ni ni-chevron-right"></i>
                            <i class="ni ni-chevron-right"></i>
                        </a>
                        <ul class="list-table m-auto nav-footer-buttons">
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Chat logs">
                                    <i class="fal fa-comments"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Support Chat">
                                    <i class="fal fa-life-ring"></i>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Make a call">
                                    <i class="fal fa-phone"></i>
                                </a>
                            </li>
                        </ul>
                    </div> <!-- END NAV FOOTER -->
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="{{ asset('assets/backend') }}/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">SmartAdmin WebApp</span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="search">
                            {{-- <form class="app-forms hidden-xs-down" role="search" action="page_search.html" autocomplete="off">
                                <a href="https://hmweddings.com" target="_blank" class="text-center"><h1> Visit Home Page</h1></a>
                                <a href="#" onclick="return false;" class="btn-danger btn-search-close js-waves-off d-none" data-action="toggle" data-class="mobile-search-on">
                                    <i class="fal fa-times"></i>
                                </a>
                            </form> --}}
                        </div>
                        <div class="ml-auto d-flex">
                            <!-- activate app search icon (mobile) -->
                            <div class="hidden-sm-up">
                                <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                                    <i class="fal fa-search"></i>
                                </a>
                            </div>
                            <!-- app settings -->
                            <div class="hidden-md-down">
                                <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-settings">
                                    <i class="fal fa-cog"></i>
                                </a>
                            </div>
                            <!-- app shortcuts -->
                            <div>
                                <a href="#" class="header-icon" data-toggle="dropdown" title="My Apps">
                                    <i class="fal fa-cube"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated w-auto h-auto">
                                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top">
                                        <h4 class="m-0 text-center color-white">
                                            Quick Shortcut
                                            <small class="mb-0 opacity-80">User Applications & Addons</small>
                                        </h4>
                                    </div>
                                    <div class="custom-scroll h-100">
                                        <ul class="app-list">
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-2 icon-stack-3x color-primary-600"></i>
                                                        <i class="base-3 icon-stack-2x color-primary-700"></i>
                                                        <i class="ni ni-settings icon-stack-1x text-white fs-lg"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Services
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-2 icon-stack-3x color-primary-400"></i>
                                                        <i class="base-10 text-white icon-stack-1x"></i>
                                                        <i class="ni md-profile color-primary-800 icon-stack-2x"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Account
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-9 icon-stack-3x color-success-400"></i>
                                                        <i class="base-2 icon-stack-2x color-success-500"></i>
                                                        <i class="ni ni-shield icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Security
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-18 icon-stack-3x color-info-700"></i>
                                                        <span class="position-absolute pos-top pos-left pos-right color-white fs-md mt-2 fw-400">28</span>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Calendar
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-7 icon-stack-3x color-info-500"></i>
                                                        <i class="base-7 icon-stack-2x color-info-700"></i>
                                                        <i class="ni ni-graph icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Stats
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-4 icon-stack-3x color-danger-500"></i>
                                                        <i class="base-4 icon-stack-1x color-danger-400"></i>
                                                        <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Messages
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-4 icon-stack-3x color-fusion-400"></i>
                                                        <i class="base-5 icon-stack-2x color-fusion-200"></i>
                                                        <i class="base-5 icon-stack-1x color-fusion-100"></i>
                                                        <i class="fal fa-keyboard icon-stack-1x color-info-50"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Notes
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-16 icon-stack-3x color-fusion-500"></i>
                                                        <i class="base-10 icon-stack-1x color-primary-50 opacity-30"></i>
                                                        <i class="base-10 icon-stack-1x fs-xl color-primary-50 opacity-20"></i>
                                                        <i class="fal fa-dot-circle icon-stack-1x text-white opacity-85"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Photos
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-19 icon-stack-3x color-primary-400"></i>
                                                        <i class="base-7 icon-stack-2x color-primary-300"></i>
                                                        <i class="base-7 icon-stack-1x fs-xxl color-primary-200"></i>
                                                        <i class="base-7 icon-stack-1x color-primary-500"></i>
                                                        <i class="fal fa-globe icon-stack-1x text-white opacity-85"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Maps
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-5 icon-stack-3x color-success-700 opacity-80"></i>
                                                        <i class="base-12 icon-stack-2x color-success-700 opacity-30"></i>
                                                        <i class="fal fa-comment-alt icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Chat
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-5 icon-stack-3x color-warning-600"></i>
                                                        <i class="base-7 icon-stack-2x color-warning-800 opacity-50"></i>
                                                        <i class="fal fa-phone icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Phone
                                                    </span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="app-list-item hover-white">
                                                    <span class="icon-stack">
                                                        <i class="base-6 icon-stack-3x color-danger-600"></i>
                                                        <i class="fal fa-chart-line icon-stack-1x text-white"></i>
                                                    </span>
                                                    <span class="app-list-name">
                                                        Projects
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="w-100">
                                                <a href="#" class="btn btn-default mt-4 mb-2 pr-5 pl-5"> Add more apps </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- app message -->
                            <a href="#" class="header-icon" data-toggle="modal" data-target=".js-modal-messenger">
                                <i class="fal fa-globe"></i>
                                <span class="badge badge-icon">!</span>
                            </a>
                            <!-- app notification -->
                            <div>
                                <a href="#" class="header-icon" data-toggle="dropdown" title="You got 11 notifications">
                                    <i class="fal fa-bell"></i>
                                    <span class="badge badge-icon">11</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-xl">
                                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center rounded-top mb-2">
                                        <h4 class="m-0 text-center color-white">
                                            11 New
                                            <small class="mb-0 opacity-80">User Notifications</small>
                                        </h4>
                                    </div>
                                    <ul class="nav nav-tabs nav-tabs-clean" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-messages" data-i18n="drpdwn.messages">Messages</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-feeds" data-i18n="drpdwn.feeds">Feeds</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link px-4 fs-md js-waves-on fw-500" data-toggle="tab" href="#tab-events" data-i18n="drpdwn.events">Events</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content tab-notification">
                                        <div class="tab-pane active p-3 text-center">
                                            <h5 class="mt-4 pt-4 fw-500">
                                                <span class="d-block fa-3x pb-4 text-muted">
                                                    <i class="ni ni-arrow-up text-gradient opacity-70"></i>
                                                </span> Select a tab above to activate
                                                <small class="mt-3 fs-b fw-400 text-muted">
                                                    This blank page message helps protect your privacy, or you can show the first message here automatically through
                                                    <a href="#">settings page</a>
                                                </small>
                                            </h5>
                                        </div>
                                        <div class="tab-pane" id="tab-messages" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Melissa Ayre <span class="badge badge-primary fw-n position-absolute pos-top pos-right mt-1">INBOX</span></span>
                                                                <span class="msg-a fs-sm">Re: New security codes</span>
                                                                <span class="msg-b fs-xs">Hello again and thanks for being part...</span>
                                                                <span class="fs-nano text-muted mt-1">56 seconds ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li class="unread">
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Adison Lee</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 minutes ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Oliver Kopyuv</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 days ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-warning mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Dr. John Cook PhD</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">2 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <!-- <img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" data-src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-h.png" class="profile-image rounded-circle" alt="Sarah McBrook" /> -->
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Sarah McBrook</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">3 weeks ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-success mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-m.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Anothony Bezyeth</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one month ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="d-flex align-items-center">
                                                            <span class="status status-danger mr-2">
                                                                <span class="profile-image rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-j.png')"></span>
                                                            </span>
                                                            <span class="d-flex flex-column flex-1 ml-1">
                                                                <span class="name">Lisa Hatchensen</span>
                                                                <span class="msg-a fs-sm">Msed quia non numquam eius</span>
                                                                <span class="fs-nano text-muted mt-1">one year ago</span>
                                                            </span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-feeds" role="tabpanel">
                                            <div class="custom-scroll h-100">
                                                <ul class="notification">
                                                    <li class="unread">
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <span class="d-flex flex-column flex-1">
                                                                <span class="name d-flex align-items-center">Administrator <span class="badge badge-success fw-n ml-1">UPDATE</span></span>
                                                                <span class="msg-a fs-sm">
                                                                    System updated to version <strong>4.0.2</strong> <a href="intel_build_notes.html">(patch notes)</a>
                                                                </span>
                                                                <span class="fs-nano text-muted mt-1">5 mins ago</span>
                                                            </span>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">
                                                                    Adison Lee <span class="fw-300 d-inline">replied to your video <a href="#" class="fw-400"> Cancer Drug</a> </span>
                                                                </span>
                                                                <span class="msg-a fs-sm mt-2">Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day...</span>
                                                                <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" data-src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-k.png" class="profile-image rounded-circle" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">
                                                                    Troy Norman'<span class="fw-300">s new connections</span>
                                                                </span>
                                                                <div class="fs-sm d-flex align-items-center mt-2">
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                                    <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                                    <div data-hasmore="+3" class="rounded-circle profile-image-md mr-1">
                                                                        <span class="profile-image-md mr-1 rounded-circle d-inline-block" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                                    </div>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" data-src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-e.png" class="profile-image-sm rounded-circle align-self-start mt-1" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">Dr John Cook <span class="fw-300">sent a <span class="text-danger">new signal</span></span></span>
                                                                <span class="msg-a fs-sm mt-2">Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</span>
                                                                <span class="fs-nano text-muted mt-1">10 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <div class="d-flex flex-column flex-1">
                                                                <span class="name">Lab Images <span class="fw-300">were updated!</span></span>
                                                                <div class="fs-sm d-flex align-items-center mt-1">
                                                                    <a href="#" class="mr-1 mt-1" title="Cell A-0012">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-7.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 saliva">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-8.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 blood cells">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-11.png'); background-size: cover;"></span>
                                                                    </a>
                                                                    <a href="#" class="mr-1 mt-1" title="Patient A-473 Membrane O.C">
                                                                        <span class="d-block img-share" style="background-image:url('img/thumbs/pic-12.png'); background-size: cover;"></span>
                                                                    </a>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">55 minutes ago</span>
                                                            </div>
                                                            <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="d-flex align-items-center show-child-on-hover">
                                                            <!--<img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" data-src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-h.png" class="profile-image rounded-circle align-self-start mt-1" alt="k" />-->
                                                            <div class="d-flex flex-column flex-1">
                                                                <div class="name mb-2">
                                                                    Lisa Lamar<span class="fw-300"> updated project</span>
                                                                </div>
                                                                <div class="row fs-b fw-300">
                                                                    <div class="col text-left">
                                                                        Progress
                                                                    </div>
                                                                    <div class="col text-right fw-500">
                                                                        45%
                                                                    </div>
                                                                </div>
                                                                <div class="progress progress-sm d-flex mt-1">
                                                                    <span class="progress-bar bg-primary-500 progress-bar-striped" role="progressbar" style="width: 45%" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></span>
                                                                </div>
                                                                <span class="fs-nano text-muted mt-1">2 hrs ago</span>
                                                                <div class="show-on-hover-parent position-absolute pos-right pos-bottom p-3">
                                                                    <a href="#" class="text-muted" title="delete"><i class="fal fa-trash-alt"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab-events" role="tabpanel">
                                            <div class="d-flex flex-column h-100">
                                                <div class="h-auto">
                                                    <table class="table table-bordered table-calendar m-0 w-100 h-100 border-0">
                                                        <tr>
                                                            <th colspan="7" class="pt-3 pb-2 pl-3 pr-3 text-center">
                                                                <div class="js-get-date h5 mb-2">[your date here]</div>
                                                            </th>
                                                        </tr>
                                                        <tr class="text-center">
                                                            <th>Sun</th>
                                                            <th>Mon</th>
                                                            <th>Tue</th>
                                                            <th>Wed</th>
                                                            <th>Thu</th>
                                                            <th>Fri</th>
                                                            <th>Sat</th>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted bg-faded">30</td>
                                                            <td>1</td>
                                                            <td>2</td>
                                                            <td>3</td>
                                                            <td>4</td>
                                                            <td>5</td>
                                                            <td><i class="fal fa-birthday-cake mt-1 ml-1 position-absolute pos-left pos-top text-primary"></i> 6</td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td>8</td>
                                                            <td>9</td>
                                                            <td class="bg-primary-300 pattern-0">10</td>
                                                            <td>11</td>
                                                            <td>12</td>
                                                            <td>13</td>
                                                        </tr>
                                                        <tr>
                                                            <td>14</td>
                                                            <td>15</td>
                                                            <td>16</td>
                                                            <td>17</td>
                                                            <td>18</td>
                                                            <td>19</td>
                                                            <td>20</td>
                                                        </tr>
                                                        <tr>
                                                            <td>21</td>
                                                            <td>22</td>
                                                            <td>23</td>
                                                            <td>24</td>
                                                            <td>25</td>
                                                            <td>26</td>
                                                            <td>27</td>
                                                        </tr>
                                                        <tr>
                                                            <td>28</td>
                                                            <td>29</td>
                                                            <td>30</td>
                                                            <td>31</td>
                                                            <td class="text-muted bg-faded">1</td>
                                                            <td class="text-muted bg-faded">2</td>
                                                            <td class="text-muted bg-faded">3</td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <div class="flex-1 custom-scroll">
                                                    <div class="p-2">
                                                        <div class="d-flex align-items-center text-left mb-3">
                                                            <div class="width-5 fw-300 text-primary l-h-n mr-1 align-self-start fs-xxl">
                                                                15
                                                            </div>
                                                            <div class="flex-1">
                                                                <div class="d-flex flex-column">
                                                                    <span class="l-h-n fs-md fw-500 opacity-70">
                                                                        October 2020
                                                                    </span>
                                                                    <span class="l-h-n fs-nano fw-400 text-secondary">
                                                                        Friday
                                                                    </span>
                                                                </div>
                                                                <div class="mt-3">
                                                                    <p>
                                                                        <strong>2:30PM</strong> - Doctor's appointment
                                                                    </p>
                                                                    <p>
                                                                        <strong>3:30PM</strong> - Report overview
                                                                    </p>
                                                                    <p>
                                                                        <strong>4:30PM</strong> - Meeting with Donnah V.
                                                                    </p>
                                                                    <p>
                                                                        <strong>5:30PM</strong> - Late Lunch
                                                                    </p>
                                                                    <p>
                                                                        <strong>6:30PM</strong> - Report Compression
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="py-2 px-3 bg-faded d-block rounded-bottom text-right border-faded border-bottom-0 border-right-0 border-left-0">
                                        <a href="#" class="fs-xs fw-500 ml-auto">view all notifications</a>
                                    </div>
                                </div>
                            </div>
                            <!-- app user menu -->
                            <div>
                                <a href="#" data-toggle="dropdown" title="{{ Auth::user()->email }}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="{{ Auth::user()->name }}">
                                    <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="{{ asset('assets/backend') }}/img/demo/avatars/avatar-m.png" class="rounded-circle profile-image" alt="{{ Auth::user()->name }}">
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg">{{ Auth::user()->name }}</div>
                                                <span class="text-truncate text-truncate-md opacity-80">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="{{ route('user.show',Auth::user()->id) }}" class="dropdown-item">
                                        <span data-i18n="drpdwn.print">Profile</span>
                                        <i class="float-right text-muted fw-n">{{ Auth::user()->name }}</i>
                                    </a>
                                    <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Settings</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="#" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <a href="#" class="dropdown-item" data-action="app-print">
                                        <span data-i18n="drpdwn.print">Print</span>
                                        <i class="float-right text-muted fw-n">Ctrl + P</i>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item fw-500 pt-3 pb-3">
                                            <span data-i18n="drpdwn.page-logout">Logout</span>
                                            <span class="float-right fw-n">{{ Auth::user()->email }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    @yield('mainContent')
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700"><?php echo date('Y') ?> © {{$company->name}}&nbsp; <a href="https://www.hmweddings.com/" target="_blank" class="text-secondary fw-700">hmweddings.com</a></span>
                        </div>
                        <div>
                            <ul class="list-table m-0">
                                <li><a href="https://www.hmweddings.com/" target="_blank" class="text-secondary fw-700">Website</a></li>
                                <li class="pl-3"><a href="{{ route('dashboard') }}" class="text-secondary fw-700">Dashboard</a></li>
                                {{-- <li class="pl-3"><a href="info_app_docs.html" class="text-secondary fw-700">Documentation</a></li>
                                <li class="pl-3 fs-xl"><a href="https://wrapbootstrap.com/user/MyOrange" class="text-secondary" target="_blank"><i class="fal fa-question-circle" aria-hidden="true"></i></a></li> --}}
                            </ul>
                        </div>
                    </footer>
                    <!-- END Page Footer -->
                    <!-- BEGIN Shortcuts -->
                    <div class="modal fade modal-backdrop-transparent" id="modal-shortcut" tabindex="-1" role="dialog" aria-labelledby="modal-shortcut" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-top modal-transparent" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <ul class="app-list w-auto h-auto p-0 text-left">
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-primary-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-home icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Home
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="page_inbox_general.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-3x opacity-100 color-success-500 "></i>
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-success-300 "></i>
                                                    <i class="ni ni-envelope icon-stack-1x text-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Inbox
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="intel_introduction.html" class="app-list-item text-white border-0 m-0">
                                                <div class="icon-stack">
                                                    <i class="base base-7 icon-stack-2x opacity-100 color-primary-300 "></i>
                                                    <i class="fal fa-plus icon-stack-1x opacity-100 color-white"></i>
                                                </div>
                                                <span class="app-list-name">
                                                    Add More
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Shortcuts -->
                    <!-- BEGIN Color profile -->
                    <!-- this area is hidden and will not be seen on screens or screen readers -->
                    <!-- we use this only for CSS color refernce for JS stuff -->
                    <p id="js-color-profile" class="d-none">
                        <span class="color-primary-50"></span>
                        <span class="color-primary-100"></span>
                        <span class="color-primary-200"></span>
                        <span class="color-primary-300"></span>
                        <span class="color-primary-400"></span>
                        <span class="color-primary-500"></span>
                        <span class="color-primary-600"></span>
                        <span class="color-primary-700"></span>
                        <span class="color-primary-800"></span>
                        <span class="color-primary-900"></span>
                        <span class="color-info-50"></span>
                        <span class="color-info-100"></span>
                        <span class="color-info-200"></span>
                        <span class="color-info-300"></span>
                        <span class="color-info-400"></span>
                        <span class="color-info-500"></span>
                        <span class="color-info-600"></span>
                        <span class="color-info-700"></span>
                        <span class="color-info-800"></span>
                        <span class="color-info-900"></span>
                        <span class="color-danger-50"></span>
                        <span class="color-danger-100"></span>
                        <span class="color-danger-200"></span>
                        <span class="color-danger-300"></span>
                        <span class="color-danger-400"></span>
                        <span class="color-danger-500"></span>
                        <span class="color-danger-600"></span>
                        <span class="color-danger-700"></span>
                        <span class="color-danger-800"></span>
                        <span class="color-danger-900"></span>
                        <span class="color-warning-50"></span>
                        <span class="color-warning-100"></span>
                        <span class="color-warning-200"></span>
                        <span class="color-warning-300"></span>
                        <span class="color-warning-400"></span>
                        <span class="color-warning-500"></span>
                        <span class="color-warning-600"></span>
                        <span class="color-warning-700"></span>
                        <span class="color-warning-800"></span>
                        <span class="color-warning-900"></span>
                        <span class="color-success-50"></span>
                        <span class="color-success-100"></span>
                        <span class="color-success-200"></span>
                        <span class="color-success-300"></span>
                        <span class="color-success-400"></span>
                        <span class="color-success-500"></span>
                        <span class="color-success-600"></span>
                        <span class="color-success-700"></span>
                        <span class="color-success-800"></span>
                        <span class="color-success-900"></span>
                        <span class="color-fusion-50"></span>
                        <span class="color-fusion-100"></span>
                        <span class="color-fusion-200"></span>
                        <span class="color-fusion-300"></span>
                        <span class="color-fusion-400"></span>
                        <span class="color-fusion-500"></span>
                        <span class="color-fusion-600"></span>
                        <span class="color-fusion-700"></span>
                        <span class="color-fusion-800"></span>
                        <span class="color-fusion-900"></span>
                    </p>
                    <!-- END Color profile -->
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="#" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="page_login_alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-print" data-toggle="tooltip" data-placement="left" title="Print page">
                <i class="fal fa-print"></i>
            </a>
            <a href="#" class="menu-item btn" data-action="app-voice" data-toggle="tooltip" data-placement="left" title="Voice command">
                <i class="fal fa-microphone"></i>
            </a>
        </nav>
        <!-- END Quick Menu -->
        <!-- BEGIN Messenger -->
        <div class="modal fade js-modal-messenger modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right">
                <div class="modal-content h-100">
                    <div class="dropdown-header bg-trans-gradient d-flex align-items-center w-100">
                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                            <span class="mr-2">
                                <span class="rounded-circle profile-image d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                            </span>
                            <div class="info-card-text">
                                <a href="javascript:void(0);" class="fs-lg text-truncate text-truncate-lg text-white" data-toggle="dropdown" aria-expanded="false">
                                    Tracey Chang
                                    <i class="fal fa-angle-down d-inline-block ml-1 text-white fs-md"></i>
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Send Email</a>
                                    <a class="dropdown-item" href="#">Create Appointment</a>
                                    <a class="dropdown-item" href="#">Block User</a>
                                </div>
                                <span class="text-truncate text-truncate-md opacity-80">IT Director</span>
                            </div>
                        </div>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0 h-100 d-flex">
                        <!-- BEGIN msgr-list -->
                        <div class="msgr-list d-flex flex-column bg-faded border-faded border-top-0 border-right-0 border-bottom-0 position-absolute pos-top pos-bottom">
                            <div>
                                <div class="height-4 width-3 h3 m-0 d-flex justify-content-center flex-column color-primary-500 pl-3 mt-2">
                                    <i class="fal fa-search"></i>
                                </div>
                                <input type="text" class="form-control bg-white" id="msgr_listfilter_input" placeholder="Filter contacts" aria-label="FriendSearch" data-listfilter="#js-msgr-listfilter">
                            </div>
                            <div class="flex-1 h-100 custom-scroll">
                                <div class="w-100">
                                    <ul id="js-msgr-listfilter" class="list-unstyled m-0">
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="tracey chang online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-d.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Tracey Chang
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="oliver kopyuv online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-b.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Oliver Kopyuv
                                                        <small class="d-block font-italic text-success fs-xs">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="dr john cook phd away">
                                                <div class="d-table-cell align-middle status status-warning status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-e.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Dr. John Cook PhD
                                                        <small class="d-block font-italic fs-xs">
                                                            Away
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney online">
                                                <div class="d-table-cell align-middle status status-success status-sm ">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-g.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Ali Amdaney
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="sarah mcbrook online">
                                                <div class="d-table-cell align-middle status status-success status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-h.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        Sarah McBrook
                                                        <small class="d-block font-italic fs-xs text-success">
                                                            Online
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-a.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney busy">
                                                <div class="d-table-cell align-middle status status-danger status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-j.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs text-danger">
                                                            Busy
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney offline">
                                                <div class="d-table-cell align-middle status status-sm">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-c.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        oliver.kopyuv@gotbootstrap.com
                                                        <small class="d-block font-italic fs-xs">
                                                            Offline
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="d-table w-100 px-2 py-2 text-dark hover-white" data-filter-tags="ali amdaney inactive">
                                                <div class="d-table-cell align-middle">
                                                    <span class="profile-image-md rounded-circle d-block" style="background-image:url('img/demo/avatars/avatar-m.png'); background-size: cover;"></span>
                                                </div>
                                                <div class="d-table-cell w-100 align-middle pl-2 pr-2">
                                                    <div class="text-truncate text-truncate-md">
                                                        +714651347790
                                                        <small class="d-block font-italic fs-xs opacity-50">
                                                            Missed Call
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="filter-message js-filter-message"></div>
                                </div>
                            </div>
                            <div>
                                <a class="fs-xl d-flex align-items-center p-3">
                                    <i class="fal fa-cogs"></i>
                                </a>
                            </div>
                        </div>
                        <!-- END msgr-list -->
                        <!-- BEGIN msgr -->
                        <div class="msgr d-flex h-100 flex-column bg-white">
                            <!-- BEGIN custom-scroll -->
                            <div class="custom-scroll flex-1 h-100">
                                <div id="chat_container" class="w-100 p-4">
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 19
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent">
                                        <div class="chat-message">
                                            <p>
                                                Hey Tracey, did you get my files?
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:00 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                Hi
                                            </p>
                                            <p>
                                                Sorry going through a busy time in office. Yes I analyzed the solution.
                                            </p>
                                            <p>
                                                It will require some resource, which I could not manage.
                                            </p>
                                        </div>
                                        <div class="fw-300 text-muted mt-1 fs-xs">
                                            3:24 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Okay
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-sent chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Sending you some dough today, you can allocate the resources to this project.
                                            </p>
                                        </div>
                                        <div class="text-right fw-300 text-muted mt-1 fs-xs">
                                            3:26 pm
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-start">
                                        <div class="chat-message">
                                            <p>
                                                Perfect. Thanks a lot!
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get">
                                        <div class="chat-message">
                                            <p>
                                                I will have them ready by tonight.
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment -->
                                    <div class="chat-segment chat-segment-get chat-end">
                                        <div class="chat-message">
                                            <p>
                                                Cheers
                                            </p>
                                        </div>
                                    </div>
                                    <!--  end .chat-segment -->
                                    <!-- start .chat-segment for timestamp -->
                                    <div class="chat-segment">
                                        <div class="time-stamp text-center mb-2 fw-400">
                                            Jun 20
                                        </div>
                                    </div>
                                    <!--  end .chat-segment for timestamp -->
                                </div>
                            </div>
                            <!-- END custom-scroll  -->
                            <!-- BEGIN msgr__chatinput -->
                            <div class="d-flex flex-column">
                                <div class="border-faded border-right-0 border-bottom-0 border-left-0 flex-1 mr-3 ml-3 position-relative shadow-top">
                                    <div class="pt-3 pb-1 pr-0 pl-0 rounded-0" tabindex="-1">
                                        <div id="msgr_input" contenteditable="true" data-placeholder="Type your message here..." class="height-10 form-content-editable"></div>
                                    </div>
                                </div>
                                <div class="height-8 px-3 d-flex flex-row align-items-center flex-wrap flex-shrink-0">
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl width-1 mr-1" data-toggle="tooltip" data-original-title="More options" data-placement="top">
                                        <i class="fal fa-ellipsis-v-alt color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Attach files" data-placement="top">
                                        <i class="fal fa-paperclip color-fusion-300"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-icon fs-xl mr-1" data-toggle="tooltip" data-original-title="Insert photo" data-placement="top">
                                        <i class="fal fa-camera color-fusion-300"></i>
                                    </a>
                                    <div class="ml-auto">
                                        <a href="javascript:void(0);" class="btn btn-info">Send</a>
                                    </div>
                                </div>
                            </div>
                            <!-- END msgr__chatinput -->
                        </div>
                        <!-- END msgr -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Messenger -->
        <!-- BEGIN Page Settings -->
        <div class="modal fade js-modal-settings modal-backdrop-transparent" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right modal-md">
                <div class="modal-content">
                    <div class="dropdown-header bg-trans-gradient d-flex justify-content-center align-items-center w-100">
                        <h4 class="m-0 text-center color-white">
                            Layout Settings
                            <small class="mb-0 opacity-80">User Interface Settings</small>
                        </h4>
                        <button type="button" class="close text-white position-absolute pos-top pos-right p-2 m-1 mr-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fal fa-times"></i></span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="settings-panel">
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        App Layout
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="fh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="header-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Header</span>
                                <span class="onoffswitch-title-desc">header is in a fixed at all times</span>
                            </div>
                            <div class="list" id="nff">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-fixed"></a>
                                <span class="onoffswitch-title">Fixed Navigation</span>
                                <span class="onoffswitch-title-desc">left panel is fixed</span>
                            </div>
                            <div class="list" id="nfm">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-minify"></a>
                                <span class="onoffswitch-title">Minify Navigation</span>
                                <span class="onoffswitch-title-desc">Skew nav to maximize space</span>
                            </div>
                            <div class="list" id="nfh">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-hidden"></a>
                                <span class="onoffswitch-title">Hide Navigation</span>
                                <span class="onoffswitch-title-desc">roll mouse on edge to reveal</span>
                            </div>
                            <div class="list" id="nft">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-function-top"></a>
                                <span class="onoffswitch-title">Top Navigation</span>
                                <span class="onoffswitch-title-desc">Relocate left pane to top</span>
                            </div>
                            <div class="list" id="mmb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-main-boxed"></a>
                                <span class="onoffswitch-title">Boxed Layout</span>
                                <span class="onoffswitch-title-desc">Encapsulates to a container</span>
                            </div>
                            <div class="expanded">
                                <ul class="">
                                    <li>
                                        <div class="bg-fusion-50" data-action="toggle" data-class="mod-bg-1"></div>
                                    </li>
                                    <li>
                                        <div class="bg-warning-200" data-action="toggle" data-class="mod-bg-2"></div>
                                    </li>
                                    <li>
                                        <div class="bg-primary-200" data-action="toggle" data-class="mod-bg-3"></div>
                                    </li>
                                    <li>
                                        <div class="bg-success-300" data-action="toggle" data-class="mod-bg-4"></div>
                                    </li>
                                </ul>
                                <div class="list" id="mbgf">
                                    <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-fixed-bg"></a>
                                    <span class="onoffswitch-title">Fixed Background</span>
                                </div>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Mobile Menu
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="nmp">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-push"></a>
                                <span class="onoffswitch-title">Push Content</span>
                                <span class="onoffswitch-title-desc">Content pushed on menu reveal</span>
                            </div>
                            <div class="list" id="nmno">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-no-overlay"></a>
                                <span class="onoffswitch-title">No Overlay</span>
                                <span class="onoffswitch-title-desc">Removes mesh on menu reveal</span>
                            </div>
                            <div class="list" id="sldo">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="nav-mobile-slide-out"></a>
                                <span class="onoffswitch-title">Off-Canvas <sup>(beta)</sup></span>
                                <span class="onoffswitch-title-desc">Content overlaps menu</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Accessibility
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mbf">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-bigger-font"></a>
                                <span class="onoffswitch-title">Bigger Content Font</span>
                                <span class="onoffswitch-title-desc">content fonts are bigger for readability</span>
                            </div>
                            <div class="list" id="mhc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-high-contrast"></a>
                                <span class="onoffswitch-title">High Contrast Text (WCAG 2 AA)</span>
                                <span class="onoffswitch-title-desc">4.5:1 text contrast ratio</span>
                            </div>
                            <div class="list" id="mcb">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-color-blind"></a>
                                <span class="onoffswitch-title">Daltonism <sup>(beta)</sup> </span>
                                <span class="onoffswitch-title-desc">color vision deficiency</span>
                            </div>
                            <div class="list" id="mpc">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-pace-custom"></a>
                                <span class="onoffswitch-title">Preloader Inside</span>
                                <span class="onoffswitch-title-desc">preloader will be inside content</span>
                            </div>
                            <div class="mt-4 d-table w-100 px-5">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Global Modifications
                                    </h5>
                                </div>
                            </div>
                            <div class="list" id="mcbg">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-clean-page-bg"></a>
                                <span class="onoffswitch-title">Clean Page Background</span>
                                <span class="onoffswitch-title-desc">adds more whitespace</span>
                            </div>
                            <div class="list" id="mhni">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-nav-icons"></a>
                                <span class="onoffswitch-title">Hide Navigation Icons</span>
                                <span class="onoffswitch-title-desc">invisible navigation icons</span>
                            </div>
                            <div class="list" id="dan">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-disable-animation"></a>
                                <span class="onoffswitch-title">Disable CSS Animation</span>
                                <span class="onoffswitch-title-desc">Disables CSS based animations</span>
                            </div>
                            <div class="list" id="mhic">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-hide-info-card"></a>
                                <span class="onoffswitch-title">Hide Info Card</span>
                                <span class="onoffswitch-title-desc">Hides info card from left panel</span>
                            </div>
                            <div class="list" id="mlph">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-lean-subheader"></a>
                                <span class="onoffswitch-title">Lean Subheader</span>
                                <span class="onoffswitch-title-desc">distinguished page header</span>
                            </div>
                            <div class="list" id="mnl">
                                <a href="#" onclick="return false;" class="btn btn-switch" data-action="toggle" data-class="mod-nav-link"></a>
                                <span class="onoffswitch-title">Hierarchical Navigation</span>
                                <span class="onoffswitch-title-desc">Clear breakdown of nav links</span>
                            </div>
                            <div class="list mt-1">
                                <span class="onoffswitch-title">Global Font Size <small>(RESETS ON REFRESH)</small> </span>
                                <div class="btn-group btn-group-sm btn-group-toggle my-2" data-toggle="buttons">
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-sm" data-target="html">
                                        <input type="radio" name="changeFrontSize"> SM
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text" data-target="html">
                                        <input type="radio" name="changeFrontSize" checked=""> MD
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-lg" data-target="html">
                                        <input type="radio" name="changeFrontSize"> LG
                                    </label>
                                    <label class="btn btn-default btn-sm" data-action="toggle-swap" data-class="root-text-xl" data-target="html">
                                        <input type="radio" name="changeFrontSize"> XL
                                    </label>
                                </div>
                                <span class="onoffswitch-title-desc d-block mb-0">Change <strong>root</strong> font size to effect rem
                                    values</span>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="mt-2 d-table w-100 pl-5 pr-3">
                                <div class="fs-xs text-muted p-2 alert alert-warning mt-3 mb-2">
                                    <i class="fal fa-exclamation-triangle text-warning mr-2"></i>The settings below uses localStorage to load
                                    the external CSS file as an overlap to the base css. Due to network latency and CPU utilization, you may
                                    experience a brief flickering effect on page load which may show the intial applied theme for a split
                                    second. Setting the prefered style/theme in the header will prevent this from happening.
                                </div>
                            </div>
                            <div class="mt-2 d-table w-100 pl-5 pr-3">
                                <div class="d-table-cell align-middle">
                                    <h5 class="p-0">
                                        Theme colors
                                    </h5>
                                </div>
                            </div>
                            <div class="expanded theme-colors pl-5 pr-3">
                                <ul class="m-0">
                                    <li>
                                        <a href="#" id="myapp-0" data-action="theme-update" data-themesave data-theme="" data-toggle="tooltip" data-placement="top" title="Wisteria (base css)" data-original-title="Wisteria (base css)"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-1" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-1.css" data-toggle="tooltip" data-placement="top" title="Tapestry" data-original-title="Tapestry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-2" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-2.css" data-toggle="tooltip" data-placement="top" title="Atlantis" data-original-title="Atlantis"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-3" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-3.css" data-toggle="tooltip" data-placement="top" title="Indigo" data-original-title="Indigo"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-4" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-4.css" data-toggle="tooltip" data-placement="top" title="Dodger Blue" data-original-title="Dodger Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-5" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-5.css" data-toggle="tooltip" data-placement="top" title="Tradewind" data-original-title="Tradewind"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-6" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-6.css" data-toggle="tooltip" data-placement="top" title="Cranberry" data-original-title="Cranberry"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-7" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-7.css" data-toggle="tooltip" data-placement="top" title="Oslo Gray" data-original-title="Oslo Gray"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-8" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-8.css" data-toggle="tooltip" data-placement="top" title="Chetwode Blue" data-original-title="Chetwode Blue"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-9" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-9.css" data-toggle="tooltip" data-placement="top" title="Apricot" data-original-title="Apricot"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-10" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-10.css" data-toggle="tooltip" data-placement="top" title="Blue Smoke" data-original-title="Blue Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-11" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-11.css" data-toggle="tooltip" data-placement="top" title="Green Smoke" data-original-title="Green Smoke"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-12" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-12.css" data-toggle="tooltip" data-placement="top" title="Wild Blue Yonder" data-original-title="Wild Blue Yonder"></a>
                                    </li>
                                    <li>
                                        <a href="#" id="myapp-13" data-action="theme-update" data-themesave data-theme="{{ asset('assets/backend') }}/css/themes/cust-theme-13.css" data-toggle="tooltip" data-placement="top" title="Emerald" data-original-title="Emerald"></a>
                                    </li>
                                </ul>
                            </div>
                            <hr class="mb-0 mt-4">
                            <div class="pl-5 pr-3 py-3 bg-faded">
                                <div class="row no-gutters">
                                    <div class="col-6 pr-1">
                                        <a href="#" class="btn btn-outline-danger fw-500 btn-block" data-action="app-reset">Reset Settings</a>
                                    </div>
                                    <div class="col-6 pl-1">
                                        <a href="#" class="btn btn-danger fw-500 btn-block" data-action="factory-reset">Factory Reset</a>
                                    </div>
                                </div>
                            </div>
                        </div> <span id="saving"></span>
                    </div>
                </div>
            </div>
        </div>
        @include('sweetalert::alert')
        <script src="{{ asset('assets/backend') }}/js/vendors.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/app.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/statistics/chartjs/chartjs.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/statistics/flot/flot.bundle.js"></script>
        <script type="text/javascript">
            /* Activate smart panels */
            $('#js-page-content').smartPanel();
        </script>
        <!-- The order of scripts is irrelevant. Please check out the plugin pages for more details about these plugins below: -->
        <script src="{{ asset('assets/backend') }}/js/statistics/peity/peity.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/statistics/flot/flot.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/statistics/easypiechart/easypiechart.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/datagrid/datatables/datatables.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/notifications/sweetalert2/sweetalert2.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/formplugins/select2/select2.bundle.js"></script>
        <script src="{{ asset('assets/backend') }}/js/formplugins/summernote/summernote.js"></script>
        <script>
            function loadImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#upload_image").attr('class', 'd-block');
                        $('#upload_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#uploadImage").change(function () {
                loadImage(this);
            });

            function mobileImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#mobile_image").attr('class', 'd-block');
                        $('#mobile_image').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#mobileImage").change(function () {
                mobileImage(this);
            });
        </script>
        <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#profileImageUploadBtn').css('display','block');
                        $('#showProfileImage').attr('src', e.target.result);
                        $('#showProfileImage').attr('class', 'd-block');
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#profile_image").change(function () {
                readURL(this);
            });
        </script>

        <script>
            function readPDFURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $("#pdfViewer").attr('class', 'd-block');
                        $('#pdfViewer').attr('data',  e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#pdf-upload").change(function () {
                readPDFURL(this);
            });
        </script>

        <script type="text/javascript">
            $(".show_password").on('click',function(){
                var x = document.getElementById("showPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });
            $(".show_confirm_password").on('click',function(){
                var x = document.getElementById("showConfirmPassword");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });
            function confirm_delete(id) {
                event.preventDefault();
                Swal.fire(
                    {
                        title: "Are you sure?",
                        text: "You won't be able to revert this!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes, delete it!"
                    }).then(function(result)
                    {
                        if (result.value)
                        {
                            $("#delete_form_"+id).submit();
                        }else{
                            event.preventDefault();
                        }
                    });
            }
          </script>
        <script>
            var areaChart = function()
            {
                var config = {
                    type: 'line',
                    data:
                    {
                        labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","Decembmer"],
                        datasets: [
                        {
                            label: "Premium Member",
                            backgroundColor: 'rgba(136,106,181, 0.2)',
                            borderColor: color.primary._500,
                            pointBackgroundColor: color.primary._700,
                            pointBorderColor: 'rgba(0, 0, 0, 0)',
                            pointBorderWidth: 1,
                            borderWidth: 1,
                            pointRadius: 3,
                            pointHoverRadius: 4,
                            data: {{ json_encode($paidMember) }},
                            fill: true
                        },
                        {
                            label: "Free Member",
                            backgroundColor: 'rgba(29,201,183, 0.2)',
                            borderColor: color.success._500,
                            pointBackgroundColor: color.success._700,
                            pointBorderColor: 'rgba(0, 0, 0, 0)',
                            pointBorderWidth: 1,
                            borderWidth: 1,
                            pointRadius: 3,
                            pointHoverRadius: 4,
                            data: {{ json_encode($freeMember) }},
                            fill: true
                        }]
                    },
                    options:
                    {
                        responsive: true,
                        title:
                        {
                            display: false,
                            text: 'Area Chart'
                        },
                        tooltips:
                        {
                            mode: 'index',
                            intersect: false,
                        },
                        hover:
                        {
                            mode: 'nearest',
                            intersect: true
                        },
                        scales:
                        {
                            xAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: '6 months forecast'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }],
                            yAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: 'Profit margin (approx)'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }]
                        }
                    }
                };
                new Chart($("#areaChart > canvas").get(0).getContext("2d"), config);
            }
            
            var barChart = function()
            {
                var barChartData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July","August","September","October","November","Decembmer"],
                    datasets: [
                    {
                        label: "Sell",
                        backgroundColor: '#FF7F50',
                        borderColor: color.success._500,
                        borderWidth: 1,
                        data: {{ json_encode($payment) }}
                    }]

                };
                var config = {
                    type: 'bar',
                    data: barChartData,
                    options:
                    {
                        responsive: true,
                        legend:
                        {
                            position: 'top',
                        },
                        title:
                        {
                            display: false,
                            text: 'Bar Chart'
                        },
                        scales:
                        {
                            xAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: '6 months forecast'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }],
                            yAxes: [
                            {
                                display: true,
                                scaleLabel:
                                {
                                    display: false,
                                    labelString: 'Profit margin (approx)'
                                },
                                gridLines:
                                {
                                    display: true,
                                    color: "#f2f2f2"
                                },
                                ticks:
                                {
                                    beginAtZero: true,
                                    fontSize: 11
                                }
                            }]
                        }
                    }
                }
                new Chart($("#barChart > canvas").get(0).getContext("2d"), config);
            }
            
        </script>
        <script>
            $(document).ready(function()
            {
                areaChart();
                barChart();
            });
        </script>
        <script type="text/javascript">
            $(function () {
                $('#timezone').val(Intl.DateTimeFormat().resolvedOptions().timeZone)
                $('.select2').select2();
                //init default
                $('.js-summernote').summernote(
                {
                    height: 200,
                    tabsize: 2,
                    placeholder: "",
                    dialogsFade: true,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['font', ['bold', 'italic', 'underline', 'clear']],
                        ['fontsize', ['fontsize']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['height', ['height']]
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });

                var table = $('#user_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('user.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'phone', name: 'phone'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#permission_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('permission.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#role_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('role.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#social_link_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('social-link.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'image', name: 'image'},
                        {data: 'url', name: 'url'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#how_we_work_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('how-we-work.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'image', name: 'image'},
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#side_menu_list').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('side-menu.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'url', name: 'url'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#member_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: window.location.href,
                    columns: [
                        {data: 'image', name: 'image', orderable: false, searchable: false,},
                        {data: 'member_profile_id', name: 'member_profile_id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'is_closed', name: 'is_closed'},
                        {data: 'follower', name: 'follower'},
                        {data: 'reported_by', name: 'reported_by'},
                        {data: 'member_group', name: 'member_group'},
                        {data: 'featured', name: 'featured'},
                        {data: 'package_info', name: 'package_info'},
                        {data: 'member_since', name: 'member_since',searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false}
                    ]
                });
                var table = $('#deleted_member_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: window.location.href,
                    columns: [
                        {data: 'image', name: 'image', orderable: false, searchable: false,},
                        {data: 'member_profile_id', name: 'member_profile_id'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'last_name', name: 'last_name'},
                        {data: 'is_closed', name: 'is_closed',searchable: false},
                        {data: 'follower', name: 'follower',searchable: false},
                        {data: 'reported_by', name: 'reported_by',searchable: false},
                        {data: 'featured', name: 'featured',searchable: false},
                        {data: 'member_group', name: 'member_group',searchable: false},
                        {data: 'member_since', name: 'member_since',searchable: false},
                        {data: 'deleted_at', name: 'deleted_at',searchable: false},
                        {data: 'deleted_by', name: 'deleted_by',searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false,width: '100%', targets: 9},
                    ]
                });
                var table = $('#plan_list').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('plan.index') }}",
                    columns: [
                        {data: 'image', name: 'image', orderable: false, searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'package_duration', name: 'package_duration'},
                        {data: 'amount', name: 'amount'},
                        {data: 'express_interest', name: 'express_interest'},
                        {data: 'direct_messages', name: 'direct_messages'},
                        {data: 'photo_gallery', name: 'photo_gallery'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#religion_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('religion.index') }}",
                    columns: [
                        {data: 'id', name: 'id', orderable: false, searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#caste_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('caste.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'religion_id', name: 'religion_id', searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#sub_caste_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('sub-caste.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'caste_id', name: 'caste_id', searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#language_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('language.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#country_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('country.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'phonecode', name: 'phonecode'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#state_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('state.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'country_id', name: 'country_id'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#city_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('city.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'postal_code', name: 'postal_code'},
                        {data: 'state_id', name: 'state_id'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#family_status_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('family-status.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#family_value_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('family-value.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#on_behafl_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('on-behalf.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#occupation_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('occupation.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#marital_status_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('marital-status.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#education_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('education.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#university_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('university.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#income_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('income.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'name', name: 'name'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#slider_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('slider.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'text', name: 'text'},
                        {data: 'desktop_image', name: 'desktop_image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#gallery_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('gallery.index') }}",
                    columns: [
                        {data: 'id', name: 'id', searchable: false},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#happy_story_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('happy-story.index') }}",
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'image1', name: 'image1'},
                        {data: 'image2', name: 'image2'},
                        {data: 'first_name', name: 'first_name'},
                        {data: 'partner_name', name: 'partner_name'},
                        {data: 'approval_status', name: 'approval_status'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#follow_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('follow.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'image', name: 'image'},
                        {data: 'link', name: 'link'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#contact_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('contact.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'image', name: 'image'},
                        {data: 'link', name: 'link'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#payment_option_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('payment-option.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'desktop_image', name: 'desktop_image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#footer_link_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('footer-link.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                        {data: 'parent', name: 'parent'},
                        {data: 'short_description', name: 'short_description'},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#email_setup_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('email-setup.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'subject', name: 'subject'},
                        {data: 'body', name: 'body'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#blog_category_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('blog-category.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'slug', name: 'slug'},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#blog_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('blog.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'slug', name: 'slug'},
                        {data: 'image', name: 'image'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#career_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('career.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'title', name: 'title'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#sell_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('payment.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'member_id', name: 'member_id'},
                        {data: 'plan_id', name: 'plan_id'},
                        {data: 'total', name: 'total'},
                        {data: 'status', name: 'status'},
                        {data: 'expiry_date', name: 'expiry_date'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'payment_by', name: 'payment_by'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#payment_detail_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('payment-detail.index') }}",
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'payment_id', name: 'payment_id'},
                        {data: 'payment_type', name: 'payment_type'},
                        {data: 'amount', name: 'amount'},
                        {data: 'received_by', name: 'received_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
                var table = $('#single_payment_detail_list').DataTable({
                    "aaSorting": [],
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: window.location.href,
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'payment_id', name: 'payment_id'},
                        {data: 'payment_type', name: 'payment_type'},
                        {data: 'amount', name: 'amount'},
                        {data: 'received_by', name: 'received_by'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            });
          </script>
    </body>
</html>
