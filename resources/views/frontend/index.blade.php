<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<?php $company = DB::table('company_settings')->first(); ?>
	<title>{{ $company->name }}</title>
	<meta content="" name="description">
	<meta content="" name="keywords">
	<?php $logo = json_decode($company->logo);?>
	<link rel="icon" href="{{ asset('uploads/logo/'.$logo[0]->image) }}" />
	{{-- <link href="{{ asset('assets/frontend') }}/css/bootstrap.min.css" rel="stylesheet"> --}}
  	<link href="{{ asset('assets/frontend') }}/css/app_style.css" rel="stylesheet">
  	{{-- <link href="{{ asset('assets/frontend') }}/css/owl.carousel.min.css" rel="stylesheet"> --}}
	<style>
		/*--------------------------------------------------------------
		# General
		--------------------------------------------------------------*/
		body {
			font-family: "Roboto", sans-serif;
			color: #444444;
			font-size: 15px;

		}



		.happy-story-nav a {
		color: #444;
		}

		.happy-story-nav .nav-tabs .nav-link.active {
		background: #1285bd;
		color: #fff;
		border-radius: 0;
		border: none;
		}

		.happy-story-nav .nav-tabs {
		border-bottom: none !important;
		}

		.success-profile-imgs img {
		width: 100%;
		image-rendering: -webkit-optimize-contrast;
		border-radius: 5px;
		border: 1px solid #ddd;
		padding: 5px;
		}

		.success-date span {
		margin-left: 10px;
		}

		.success-story .owl-prev,
		.success-story .owl-next {
		background: #ddd !important;
		padding: 0px 20px !important;
		width: 26px !important;
		color: #333 !important;
		font-size: 20px !important;
		margin-right: 5px;
		}

		.success-story .owl-nav {
		text-align: center;
		margin-top: 5px;
		}

		.ads img {
		width: 100%;
		}

		.all-success-story img {
		width: 100%;
		}

		.all-success-date span {
		margin-left: 10px;
		}


		.login-header-bg {
		background-color: #1285bd;
		}

		.loging-header {
		display: block;
		}

		.loging-header a {
		padding: 10px 10px;
		}

		.login-header-logo img {
		height: 60px;
		object-fit: contain;
		margin: 10px;
		image-rendering: -webkit-optimize-contrast;
		}

		a {
			color: #ed2224;
			text-decoration: none;
		}

		a:hover {
			color: #ed2224;
			text-decoration: none;
		}

		h1,
		h2,
		h3,
		h4,
		h5,
		h6 {
			font-family: "Roboto", sans-serif;
		}

		.btn-danger-2:hover {
			color: #fff;
			background-color: #d00c0e !important;
			border-color: #d00c0e !important;
		}

		.btn-danger-2 {
			color: #fff;
			background-color: #ed2224 !important;
			border-color: #ed2224 !important;
		}

		.btn-blue:hover {
			color: #fff;
			background-color: #1285bd !important;
			border-color: #1285bd !important;
		}

		.btn-blue {
			color: #1285bd;
			border-color: #1285bd !important;
			border-radius: 36px;
			padding: 4px 13px;
			font-size: 13px;
		}

		.btn-blue2:hover {
			color: #fff;
			background-color: #005d8a !important;
			border-color: #1285bd !important;
		}

		.btn-blue2 {
			color: #fff;
			background-color: #1285bd !important;
			border-color: #1285bd !important;
			font-size: 13px;
		}

		.image-rendering: -webkit-optimize-contrast;

		/*--------------------------------------------------------------
		# Preloader
		--------------------------------------------------------------*/
		#preloader {
			position: fixed;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			z-index: 9999;
			overflow: hidden;
			background: #fff;
		}

		#preloader:before {
			content: "";
			position: fixed;
			top: calc(50% - 30px);
			left: calc(50% - 30px);
			border: 6px solid #ed2224;
			border-top-color: #e2eefd;
			border-radius: 50%;
			width: 60px;
			height: 60px;
			-webkit-animation: animate-preloader 1s linear infinite;
			animation: animate-preloader 1s linear infinite;
		}

		@-webkit-keyframes animate-preloader {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		@keyframes animate-preloader {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}


		.member .btn-sm {
			padding: 2px 10px;
			font-size: .875rem;
			color: #fff;
			background: #ed2224;
			border: none;
			border-radius: 36px;
			font-size: 12px;
		}

		/*--------------------------------------------------------------
		# Back to top button
		--------------------------------------------------------------*/
		.back-to-top {
			position: fixed;
			visibility: hidden;
			opacity: 0;
			right: 15px;
			bottom: 15px;
			z-index: 996;
			background: #ed2224;
			width: 40px;
			height: 40px;
			border-radius: 4px;
			transition: all 0.4s;
			color: #fff !important;
		}

		.back-to-top .fas {
			font-size: 20px;
			color: #fff;
			line-height: 0;
		}

		.back-to-top:hover {
			background: #333;
			color: #fff;
		}

		.back-to-top.active {
			visibility: visible;
			opacity: 1;
		}


		.full {
			width: 100%;
			height: auto !important;
			top: 0;
			bottom: 0;
			left: 0;
			right: 0;
			margin: auto;
			display: block;
		}

		.zoom {
			animation: scale 15s linear infinite;
		}

		@keyframes scale {
			50% {
				-webkit-transform: scale(1.2);
				-moz-transform: scale(1.2);
				-ms-transform: scale(1.2);
				-o-transform: scale(1.2);
				transform: scale(1.2);
			}
		}




		/*--------------------------------------------------------------
		# Disable aos animation delay on mobile devices
		--------------------------------------------------------------*/
		@media screen and (max-width: 768px) {
			[data-aos-delay] {
				transition-delay: 0 !important;
			}
		}

		/*--------------------------------------------------------------
		# Top Bar
		--------------------------------------------------------------*/
		#topbar {
			background: #0000;
			height: 1px;
			font-size: 14px;
			transition: all 0.5s;
			color: #fff;
			padding: 0;

		}

		#topbar .contact-info i {
			font-style: normal;
			color: #fff;
		}

		#topbar .contact-info i a,
		#topbar .contact-info i span {
			padding-left: 5px;
			color: #fff;
		}

		#topbar .contact-info i a {
			line-height: 0;
			transition: 0.3s;
			transition: 0.3s;
		}

		#topbar .contact-info i a:hover {
			color: #fff;
			text-decoration: underline;
		}

		#topbar .social-links a {
			color: rgba(255, 255, 255, 0.7);
			line-height: 0;
			transition: 0.3s;
			margin-left: 20px;
		}

		#topbar .social-links a:hover {
			color: white;
		}


		/*--------------------------------------------------------------
		# Header
		--------------------------------------------------------------*/
		#header {
			background: #fff0;
			transition: all 0.5s;
			z-index: 997;
			height: 100px;
			box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
			position: absolute;
			width: 100%;
		}

		.fixed-top .logo img {
			height: 50px !important;
			object-fit: contain;
			image-rendering: -webkit-optimize-contrast
		}

		.fixed-top .navbar a {
			color: #333;
			text-shadow: none;
		}

		.fixed-top .navbar .active,
		.navbar li:hover>a {
			color: #ed2224;
		}


		.mobile-slider {
			display: none;
		}

		@media screen and (max-width: 1000px) {
			.mobile-slider {
				display: block;
			}

			.top-slider {
				display: none;
			}

		}



		#header.fixed-top {
			height: 70px;
			position: fixed !important;
			background: #fff;
		}



		#header .logo {
			font-size: 30px;
			margin: 0;
			padding: 0;
			line-height: 1;
			font-weight: 600;
			letter-spacing: 0.8px;
			font-family: "Poppins", sans-serif;
		}

		#header .logo a {
			color: #222222;
		}

		#header .logo a span {
			color: #ed2224;
		}

		#header .logo img {
			height: 80px;
			object-fit: contain;

		}

		.scrolled-offset {
			margin-top: 70px;
		}

		img {
			image-rendering: -webkit-optimize-contrast;
		}

		/*--------------------------------------------------------------
		# Navigation Menu
		--------------------------------------------------------------*/
		/**
		* Desktop Navigation 
		*/
		.navbar {
			padding: 0;
		}

		.navbar ul {
			margin: 0;
			padding: 0;
			display: flex;
			list-style: none;
			align-items: center;
		}

		.navbar li {
			position: relative;
		}

		.navbar>ul>li {
			white-space: nowrap;
			padding: 10px 0 10px 28px;
		}

		.navbar a {
			display: flex;
			align-items: center;
			justify-content: space-between;
			padding: 0 3px;
			font-size: 15px;
			font-weight: 600;
			color: #fff;
			white-space: nowrap;
			transition: 0.3s;
			position: relative;
			text-shadow: 1px 1px 4px #1f2a1f;
		}

		.navbar a i {
			font-size: 12px;
			line-height: 0;
			margin-left: 5px;
		}

		.navbar>ul>li>a:before {
			content: "";
			position: absolute;
			width: 100%;
			height: 2px;
			bottom: -6px;
			left: 0;
			background-color: #ed2224;
			visibility: hidden;
			width: 0px;
			transition: all 0.3s ease-in-out 0s;
		}

		.navbar a:hover:before,
		.navbar li:hover>a:before,
		.navbar .active:before {
			visibility: visible;
			width: 100%;
		}

		.navbar a:hover,
		.navbar .active,
		.navbar li:hover>a {
			color: #ed2224;
		}

		.navbar .dropdown ul {
			display: block;
			position: absolute;
			left: 28px;
			top: calc(100% + 30px);
			margin: 0;
			padding: 0px;
			z-index: 99;
			opacity: 0;
			visibility: hidden;
			background: #fff;
			box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
			transition: 0.3s;
		}

		.navbar .dropdown ul li {
			min-width: 200px;
			border-bottom: 1px solid #ececec;
		}

		.navbar .dropdown ul a {
			padding: 10px 20px;
			font-weight: 400;
		}

		.navbar .dropdown ul a i {
			font-size: 12px;
		}

		.navbar .dropdown ul a:hover,
		.navbar .dropdown ul .active:hover,
		.navbar .dropdown ul li:hover>a {
			color: #fff;
			background: #ed2224;
		}

		.navbar .dropdown:hover>ul {
			opacity: 1;
			top: 100%;
			visibility: visible;
		}

		.navbar .dropdown .dropdown ul {
			top: 0;
			left: calc(100% - 30px);
			visibility: hidden;
		}

		.navbar .dropdown .dropdown:hover>ul {
			opacity: 1;
			top: 0;
			left: 100%;
			visibility: visible;
		}

		@media (max-width: 1366px) {
			.navbar .dropdown .dropdown ul {
				left: -90%;
			}

			.navbar .dropdown .dropdown:hover>ul {
				left: -100%;
			}
		}

		/**
		* Mobile Navigation 
		*/
		.mobile-nav-toggle {
			color: #222222;
			font-size: 28px;
			cursor: pointer;
			display: none;
			line-height: 0;
			transition: 0.5s;
		}

		.mobile-nav-toggle.bi-x {
			color: #fff;
		}

		@media (max-width: 991px) {
			.mobile-nav-toggle {
				display: block;
			}

			/*.navbar ul {
			display: none;
			}*/


			.navbar>ul>li {
				white-space: nowrap;
				padding: 9px 0 10px 14px;
			}

			.varification-title {
				margin-bottom: 15px;
			}

		}

		.navbar-mobile {
			position: fixed;
			overflow: hidden;
			top: 0;
			right: 0;
			left: 0;
			bottom: 0;
			background: rgba(9, 9, 9, 0.9);
			transition: 0.3s;
			z-index: 999;
		}

		.navbar-mobile .mobile-nav-toggle {
			position: absolute;
			top: 15px;
			right: 15px;
		}

		.navbar-mobile ul {
			display: block;
			position: absolute;
			top: 55px;
			right: 15px;
			bottom: 15px;
			left: 15px;
			padding: 10px 0;
			background-color: #fff;
			overflow-y: auto;
			transition: 0.3s;
		}

		.navbar-mobile a {
			padding: 10px 20px;
			font-size: 15px;
			color: #222222;
		}

		.navbar-mobile>ul>li {
			padding: 0;
		}

		.navbar-mobile a:hover:before,
		.navbar-mobile li:hover>a:before,
		.navbar-mobile .active:before {
			visibility: hidden;
		}

		.navbar-mobile a:hover,
		.navbar-mobile .active,
		.navbar-mobile li:hover>a {
			color: #ed2224;
		}

		.navbar-mobile .getstarted {
			margin: 15px;
		}

		.navbar-mobile .dropdown ul {
			position: static;
			display: none;
			margin: 10px 20px;
			padding: 10px 0;
			z-index: 99;
			opacity: 1;
			visibility: visible;
			background: #fff;
			box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.25);
		}

		.navbar-mobile .dropdown ul li {
			min-width: 200px;
		}

		.navbar-mobile .dropdown ul a {
			padding: 10px 20px;
		}

		.navbar-mobile .dropdown ul a i {
			font-size: 12px;
		}

		.navbar-mobile .dropdown ul a:hover,
		.navbar-mobile .dropdown ul .active:hover,
		.navbar-mobile .dropdown ul li:hover>a {
			color: #ed2224;
		}

		.navbar-mobile .dropdown>.dropdown-active {
			display: block;
		}



		/*--------------------------------------------------------------
		# register-form
		--------------------------------------------------------------*/

		.register-form {
			text-align: center;
			position: absolute;
			left: 50%;
			transform: translate(-50%, -130%);
			color: white;
			width: 55%;
			z-index: 9;
		}

		.register-form h1 {
			text-shadow: 1px 1px 1px #1f2a1f;
			color: #ed2224;
		}

		.register-form .form-select {
			border-radius: 0px !important;
			background-color: #ffffff82 !important;
			border: 1px solid #d5d5d578 !important;
		}

		.register-form .btn {
			border-radius: 0px !important;
			background: #ed2224;
		}


		.register-form-bg {
			background: #00000063;
			padding: 10px 0px;
			border-radius: 5px;
		}

		#search-modal .search-heading,
		#search-modals .search-heading {
			text-align: center;
			font-size: 16px;
			margin: auto;
		}

		#search-modal .modal-content,
		#search-modals .modal-content,
		#search-modal2 .modal-content {
			position: relative;
			display: flex;
			flex-direction: column;
			width: 100%;
			pointer-events: auto;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid rgba(0, 0, 0, .2);
			border-radius: 0;
			outline: 0;
			padding: 0px;
			font-size: 15px !important;
		}

		#search-modal .form-control,
		#search-modal .form-select {
			font-size: 13px !important;
			color: #6f6f6f;
			border-radius: 0;
			padding: 10px;
		}

		#search-modals .form-control,
		#search-modals .form-select {
			font-size: 13px !important;
			color: #6f6f6f;
			border-radius: 0;
			padding: 10px;
		}

		#search-modal2 .form-control,
		#search-moda2 .form-select {
			font-size: 13px !important;
			color: #6f6f6f;
			border-radius: 0;
			padding: 10px;
		}

		#search-modal2 .form-control,
		#search-modal2 .form-select {
			font-size: 13px !important;
			color: #6f6f6f;
			border-radius: 0;
			padding: 10px;
		}

		#search-modals a {
			color: #4d78dd;
		}

		.register-heading h5 {
			text-align: center;
			margin: auto;
			margin-right: 30px
		}

		.register .modal-header,
		.login .modal-header,
		.all-modal .modal-header {
			display: flex;
			flex-shrink: 0;
			align-items: center;
			justify-content: space-between;
			padding: 1rem 1rem;
			border-bottom: 1px solid #dee2e6;
			border-top-left-radius: calc(.3rem - 1px);
			border-top-right-radius: calc(.3rem - 1px);
			background: #b3b3b3;
			border-radius: 0;
			color: #fff;
		}


		.register .modal-body,
		.login .modal-body,
		.all-modal .modal-body,
			{
			position: relative;
			flex: 1 1 auto;
			padding: 30px !important;
		}




		/*--------------------------------------------------------------
		# Create form
		--------------------------------------------------------------*/




		/*--------------------------------------------------------------
		# Hero Section
		--------------------------------------------------------------*/
		#hero {
			width: 100%;
			height: 75vh;
			background: url("../img/hero-bg.jpg") top left;
			background-size: cover;
			position: relative;
		}

		#hero:before {
			content: "";
			background: rgba(255, 255, 255, 0.6);
			position: absolute;
			bottom: 0;
			top: 0;
			left: 0;
			right: 0;
		}

		#hero .container {
			position: relative;
		}

		#hero h1 {
			margin: 0;
			font-size: 48px;
			font-weight: 700;
			line-height: 56px;
			color: #222222;
			font-family: "Poppins", sans-serif;
		}

		#hero h1 span {
			color: #ed2224;
		}

		#hero h2 {
			color: #555555;
			margin: 5px 0 30px 0;
			font-size: 24px;
			font-weight: 400;
		}

		#hero .btn-get-started {
			font-family: "Roboto", sans-serif;
			text-transform: uppercase;
			font-weight: 500;
			font-size: 14px;
			letter-spacing: 1px;
			display: inline-block;
			padding: 10px 28px;
			border-radius: 4px;
			transition: 0.5s;
			color: #fff;
			background: #ed2224;
		}

		#hero .btn-get-started:hover {
			background: #247cf0;
		}

		#hero .btn-watch-video {
			font-size: 16px;
			transition: 0.5s;
			margin-left: 25px;
			color: #222222;
			font-weight: 600;
			display: flex;
			align-items: center;
		}

		#hero .btn-watch-video i {
			color: #ed2224;
			font-size: 32px;
			transition: 0.3s;
			line-height: 0;
			margin-right: 8px;
		}

		#hero .btn-watch-video:hover {
			color: #ed2224;
		}

		#hero .btn-watch-video:hover i {
			color: #666666;
		}

		@media (min-width: 1024px) {
			#hero {
				background-attachment: fixed;
			}
		}

		@media (max-width: 768px) {
			#hero {
				height: 100vh;
			}

			#hero h1 {
				font-size: 28px;
				line-height: 36px;
			}

			#hero h2 {
				font-size: 18px;
				line-height: 24px;
				margin-bottom: 30px;
			}

			#hero .btn-get-started,
			#hero .btn-watch-video {
				font-size: 13px;
			}
		}

		@media (max-height: 500px) {
			#hero {
				height: 120vh;
			}
		}

		.top-slider .carousel-caption {
			bottom: 20% !important;
		}

		.banner-centers {
			text-align: left;
			margin-top: 6%;
		}

		.banner-centers h1 {
			font-size: 40px;
			font-weight: bold;
			text-transform: uppercase;
		}

		/*--------------------------------------------------------------
		# Sections General
		--------------------------------------------------------------*/
		section {
			padding: 60px 0;
			overflow: hidden;
		}

		.section-bg {
			background-color: #f6f9fe;
		}

		.section-title {
			text-align: center;
			padding-bottom: 30px;
		}

		.section-title-left {
			text-align: left;
			padding-bottom: 30px;
		}

		.section-title-left h3 span {
			color: #ed2224;
		}

		.section-title-left h3 {
			margin: 15px 0 0 0;
			font-size: 32px;
			font-weight: 700;
		}

		.section-title-left ul {
			padding: 0px;
			list-style: none;
		}

		.section-title-left .fas {
			color: #ed2224;
			margin-right: 15px;
		}

		.section-title-left ul li {
			line-height: 1.9;
		}



		.section-title h2 {
			font-size: 13px;
			letter-spacing: 1px;
			font-weight: 700;
			padding: 8px 20px;
			margin: 0;
			color: #ed2224;
			display: inline-block;
			text-transform: uppercase;
			border-radius: 50px;
		}

		.section-title h3 {
			margin: 15px 0 0 0;
			font-size: 32px;
			font-weight: 700;
		}

		.section-title-2 h3 {
			margin: 15px 0 0 0;
			font-size: 32px;
			font-weight: 700;
			color: #fff;
		}

		.section-title h3 span {
			color: #ed2224;
		}

		.section-title-2 h3 span {
			color: red;
		}


		.section-title p {
			margin: 15px auto 0 auto;
			font-weight: 600;
		}

		.section-title-2 p {
			margin: 15px auto 0 auto;
			font-weight: 600;
			color: #ddd;
			margin-bottom: 20px;
		}




		@media (min-width: 1024px) {
			.section-title p {
				width: 50%;
			}
		}

		/*--------------------------------------------------------------
		# Featured Services
		--------------------------------------------------------------*/
		@media (min-width: 320px) and (max-width: 736px) {
			#services .icon-bg-img img {
				width: 100%;
				height: 120px !important;
				object-fit: cover;
				border-bottom: 5px solid #ed2224;
				image-rendering: -webkit-optimize-contrast;
			}

		}

		#services .icon-bg-img img {
			width: 100%;
			height: 200px;
			object-fit: cover;
			border-bottom: 5px solid #ed2224;
			image-rendering: -webkit-optimize-contrast;
		}


		.featured-services .icon-box {
			padding: 30px;
			position: relative;
			overflow: hidden;
			background: #fff;
			box-shadow: 0 0 29px 0 rgba(164, 164, 164, 0.17);
			transition: all 0.3s ease-in-out;
			border-radius: 8px;
			z-index: 1;
		}

		#services .icon-box .icon img {
			width: 100%;
			image-rendering: -webkit-optimize-contrast;
		}

		#services .icon-bg-img img {
			width: 100%;
			height: 250px;
			object-fit: cover;
			border-bottom: 5px solid #ed2224;
			image-rendering: -webkit-optimize-contrast;
		}

		#services .icon-bg-img .fas {
			color: #ed2224;
			position: absolute;
			margin-top: 0px;
			text-align: center;
			padding: 18px;
			font-size: 23px;
		}

		.featured-services .icon-box::before {
			content: '';
			position: absolute;
			background: #cbe0fb;
			right: 0;
			left: 0;
			bottom: 0;
			top: 100%;
			transition: all 0.3s;
			z-index: -1;
		}

		.portfolio .owl-dots {
			display: none;
		}

		.featured-services .icon-box:hover::before {
			background: #ed2224;
			top: 0;
			border-radius: 0px;
		}

		.featured-services .icon {
			margin-bottom: 15px;
		}

		.featured-services .icon i {
			font-size: 34px;
			line-height: 1;
			color: #ed2224;
			transition: all 0.3s ease-in-out;
		}

		.featured-services .title {
			font-weight: 700;
			margin-bottom: 15px;
			font-size: 16px;
		}

		.featured-services .title a {
			color: #111;
		}

		.featured-services .description {
			font-size: 15px;
			line-height: 28px;
			margin-bottom: 0;
		}

		.featured-services .icon-box:hover .title a,
		.featured-services .icon-box:hover .description {
			color: #fff;
		}

		.featured-services .icon-box:hover .icon i {
			color: #fff;
		}

		.we-pic {
			margin-right: 30px;
		}

		/*---------------Parralax---------------*/



		.parallax-img-title p {
			color: #fff;
			text-align: center;
		}

		.parallax-img-title h4 {
			color: #fff;
			text-align: center;
			text-transform: uppercase;
		}

		.solutions {
			text-align: center;
		}

		/*End Parallax*/


		/*--------------------------------------------------------------
		# Counts
		--------------------------------------------------------------*/
		.counts {
			padding: 70px 0 60px;
		}

		.counts .count-box {
			padding: 30px 30px 25px 30px;
			width: 100%;
			position: relative;
			text-align: center;
			background: #f1f6fe;
		}

		.counts .count-box i {
			position: absolute;
			top: -28px;
			left: 50%;
			transform: translateX(-50%);
			font-size: 24px;
			background: #ed2224;
			color: #fff;
			width: 56px;
			height: 56px;
			line-height: 0;
			border-radius: 50px;
			border: 5px solid #fff;
			display: inline-flex;
			align-items: center;
			justify-content: center;
		}

		.counts .count-box span {
			font-size: 36px;
			display: block;
			font-weight: 600;
			color: #062b5b;
		}

		.counts .count-box p {
			padding: 0;
			margin: 0;
			font-family: "Roboto", sans-serif;
			font-size: 14px;
		}

		/*--------------------------------------------------------------
		# Clients
		--------------------------------------------------------------*/
		.clients {
			padding: 15px 0;
			text-align: center;
		}

		.clients img {
			max-width: 45%;
			transition: all 0.4s ease-in-out;
			display: inline-block;
			padding: 15px 0;
		}

		.clients img:hover {
			transform: scale(1.15);
		}

		@media (max-width: 768px) {
			.clients img {
				max-width: 40%;
			}

			.happy img {
				height: 150px !important;
			}

			.stories p {
				display: none;
			}

			.stories h5 {
				font-size: 16px !important;
			}

			.morecontent span {
				display: none;
			}

			.section-title h3 {
				margin: 15px 0 0 0;
				font-size: 24px;
				font-weight: 700;
			}

			.section-title p {
				margin: 15px auto 0 auto;
				font-weight: 600;
				font-size: 14px;
			}

			.morelink {
				display: block !important;
			}

			.payment-icon-2 {
				display: none;
			}

			.payment-icon {
				display: block !important;
			}



		}

		.morelink {
			display: none;
		}

		.payment-icon {
			display: none;
		}



		/*--------------------------------------------------------------
		# Services
		--------------------------------------------------------------*/
		.services .icon-box {
			text-align: center;
			border: 1px solid #e2eefd;
			padding: 10px;
			transition: all ease-in-out 0.3s;
			background: #fff;
			border-radius: 5px;
		}

		.services .icon-box .icon {
			margin: 0 auto;
			width: 64px;
			height: 64px;
			background: #fff;
			border-radius: 50%;
			border: 1px solid #fff;
			display: flex;
			align-items: center;
			justify-content: center;
			transition: ease-in-out 0.3s;
			margin-top: -33px;
			display: inline-grid;
		}

		.services .icon-box .icon i {
			color: #666666;
			font-size: 28px;
			transition: ease-in-out 0.3s;
		}

		.services .icon-box h4 {
			font-weight: 700;
			margin-bottom: 15px;
			font-size: 24px;
		}

		.services .icon-box h5 a {
			color: #333;
			transition: ease-in-out 0.3s;
		}

		.services .icon-box p {
			line-height: 24px;
			font-size: 14px;
			margin-bottom: 0;
			padding: 0px 10px;
		}

		.services .icon-box:hover {
			border-color: #fff;
			transition: all .3s cubic-bezier(.02, .54, .58, 1);
			box-shadow: 0 10px 35px 5px rgba(137, 173, 255, .3);
		}

		.services .icon-box:hover h5 a,
		.services .icon-box:hover .icon i {
			color: #ed2224;
		}

		.services .icon-box:hover .icon {
			border-color: #ed2224;
		}


		/*--------------------------------------------------------------
		# Profile create
		--------------------------------------------------------------*/

		#profile-create {
			padding: 200px 0 100px;
			background-color: #388db7;
		}

		.create-profile {
			padding: 20px;
			background-color: #f7f7f7;

		}

		.team {
			padding: 60px 0;
		}

		.member-info h4 {
			color: red;
		}

		.team .member {
			margin-bottom: 20px;
			overflow: hidden;
			border-radius: 4px;
			background: #fff;
			box-shadow: 0px 2px 15px rgba(16, 110, 234, 0.15);
			width: 100%;
		}

		.team .member .member-img {
			position: relative;
			overflow: hidden;
		}

		.team .member .member-info {
			padding: 10px 15px;
			text-align: center;
		}

		.team .member .member-info h4 {
			font-weight: 700;
			margin-bottom: 5px;
			font-size: 18px;
			color: #222222;
		}


		.team .member .member-info p {
			font-style: italic;
			font-size: 14px;
			line-height: 26px;
			color: #777777;
			margin-bottom: 0px;
		}

		.team .member:hover .social {
			opacity: 1;
			bottom: 15px;
		}

		.member-img img {
			height: 250px;
			object-fit: cover;
			image-rendering: -webkit-optimize-contrast;
		}

		.varification {
			background: #f1f1f1;
		}

		.varification img {
			height: 50px;
			object-fit: contain;
			width: 50px;
			margin-bottom: 15px;
			image-rendering: -webkit-optimize-contrast;
		}

		.varification h5 {
			font-size: 16px;
		}

		.varification-title {
			display: block;
			text-align: center;
		}

		.sidebar-text {
			color: #fff;
		}

		.sidebar-text li {
			padding: 0px;
			margin: 0px;
		}

		.sidebar-text li {
			list-style: none;
		}

		.sidebar-text a:hover {
			color: #ed2224 !important;
		}


		/*Happy stories*/


		.happy {
			position: relative;

		}


		.happy img {
			width: 100%;
			height: 277px;
			object-fit: cover;
			image-rendering: -webkit-optimize-contrast;
		}

		.happy-overlay {
			position: absolute;
			bottom: 0;
			left: 0;
			right: 0;
			background-color: #060101a8;
			overflow: hidden;
			width: 100%;
			height: 0;
			transition: .5s ease;
		}


		.happy:hover .happy-overlay {
			height: 100%;
		}

		.stories {
			color: white;
			position: absolute;
			top: 50%;
			left: 50%;
			-webkit-transform: translate(-50%, -50%);
			-ms-transform: translate(-50%, -50%);
			transform: translate(-50%, -50%);
			text-align: center;
			width: 85%;
		}

		.stories p {
			font-size: 14px;
			text-align: justify;
			line-height: 1.4;
		}

		.underline {
			height: 3px;
			width: 154px;
			background: red;
			text-align: center;
			margin: auto;
			margin-bottom: 15px;
		}

		.youtube-icon img {
			position: absolute;
			height: 50px;
			padding-right: 20px;
			width: 50px;
			image-rendering: -webkit-optimize-contrast;
		}

		/*--------------------------------------------------------------
		# About us pages
		--------------------------------------------------------------*/
		.about-title {
			color: #fff;
			text-align: center;
			font-weight: bold;
			margin-top: 30%;
		}

		.about-title span {
			background-color: #0000003b;
			padding: 5px 15px;
		}

		.about-des p {
			font-size: 15px;
			text-align: justify;
			font-family: "Poppins", sans-serif;

		}

		.md-message {
			text-align: center;
		}

		.md-message img {
			width: 90%;
			border: 10px solid #f7f7f7;
			box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
			image-rendering: -webkit-optimize-contrast;
		}

		.md-message p {
			text-align: center;
		}


		/*video */

		.video-icon img {
			position: absolute;
			width: 50px !important;
			padding: 7px;
			border: none !important;
			height: auto !important;
			margin: 10px;
			image-rendering: -webkit-optimize-contrast;
		}

		img {
			image-rendering: -webkit-optimize-contrast;
		}

		.payment-icon img {
			height: 106px;
			image-rendering: -webkit-optimize-contrast;
		}


		/*--------------------------------------------------------------
		# Gallery
		--------------------------------------------------------------*/

		.gallery-img .modal {
			display: none;
			position: fixed;
			padding-top: 100px;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			overflow: auto;
			background-color: black;
		}

		.gallery-img .modal-content {
			position: relative;
			background-color: #fefefe;
			margin: auto;
			padding: 0;
			width: 30%;
			max-width: 1200px;
		}

		.gallery-img .close {
			color: white;
			position: absolute;
			top: 10px;
			right: 25px;
			font-size: 35px;
			font-weight: bold;
		}

		.gallery-img .close:hover,
		.close:focus {
			color: #999;
			text-decoration: none;
			cursor: pointer;
		}

		.gallery-img .mySlides333 {
			display: none;
		}

		.gallery-img .cursor {
			cursor: pointer;
		}

		.gallery-img .prev,
		.next {
			cursor: pointer;
			position: absolute;
			top: 50%;
			width: auto;
			padding: 16px;
			margin-top: -50px;
			color: white;
			font-weight: bold;
			font-size: 20px;
			transition: 0.6s ease;
			border-radius: 0 3px 3px 0;
			user-select: none;
			-webkit-user-select: none;
			background: #0000004d;
		}

		.gallery-part-images img {
			object-fit: cover;
			height: 250px;
			margin-bottom: 20px;
			border-radius: 10px;
			image-rendering: -webkit-optimize-contrast;
		}

		.gallery-img .next {
			right: 0;
			border-radius: 3px 0 0 3px;
		}

		.gallery-img .prev:hover,
		.next:hover {
			background-color: rgba(0, 0, 0, 0.8);
		}

		.gallery-img .numbertext {
			color: #f2f2f2;
			font-size: 12px;
			padding: 8px 12px;
			position: absolute;
			top: 0;
		}

		.gallery-img .caption-container {
			text-align: center;
			background-color: black;
			padding: 2px 16px;
			color: white;
		}

		.gallery-img .demo {
			opacity: 0.6;
		}

		.gallery-img .active,
		.demo:hover {
			opacity: 1;
		}

		.gallery-img img.hover-shadow {
			transition: 0.3s;

		}

		.gallery-img .hover-shadow:hover {
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
		}


		/*--------------------------------------------------------------
		# End Gallery
		--------------------------------------------------------------*/


		#about-home {
			text-align: center;
		}


		/*--------------------------------------------------------------
		# Contact
		--------------------------------------------------------------*/
		.contact .info-box {
			color: #444444;
			text-align: center;
			padding: 20px 0 30px 0;
		}

		.contact .info-box i {
			font-size: 23px;
			color: #1285bd;
			border-radius: 50%;
			padding: 16px;
			border: 2px dotted #1285bd;
			height: 60px;
			width: 60px;
		}

		.contact .info-box h3 {
			font-size: 20px;
			color: #777777;
			font-weight: 700;
			margin: 10px 0;
		}

		.contact .info-box p {
			padding: 0;
			line-height: 24px;
			font-size: 14px;
			margin-bottom: 0;
		}


		.contact .php-email-form .error-message {
			display: none;
			color: #fff;
			background: #ed3c0d;
			text-align: left;
			padding: 15px;
			font-weight: 600;
		}

		.contact .php-email-form .error-message br+br {
			margin-top: 25px;
		}

		.contact .php-email-form .sent-message {
			display: none;
			color: #fff;
			background: #18d26e;
			text-align: center;
			padding: 15px;
			font-weight: 600;
		}

		.contact .php-email-form .loading {
			display: none;
			background: #fff;
			text-align: center;
			padding: 15px;
		}

		.contact .php-email-form .loading:before {
			content: "";
			display: inline-block;
			border-radius: 50%;
			width: 24px;
			height: 24px;
			margin: 0 10px -6px 0;
			border: 3px solid #18d26e;
			border-top-color: #eee;
			-webkit-animation: animate-loading 1s linear infinite;
			animation: animate-loading 1s linear infinite;
		}

		.contact .php-email-form .form-group {
			margin-bottom: 20px;
		}

		.contact .php-email-form input,
		.contact .php-email-form textarea {
			border-radius: 0;
			box-shadow: none;
			font-size: 14px;
		}

		.contact .php-email-form input:focus,
		.contact .php-email-form textarea:focus {
			border-color: #ed2224;
		}

		.contact .php-email-form input {
			padding: 10px 15px;
		}

		.contact .php-email-form textarea {
			padding: 12px 15px;
		}

		.contact .php-email-form button[type="submit"] {
			background: #ed2224;
			border: 0;
			padding: 10px 30px;
			color: #fff;
			transition: 0.4s;
			border-radius: 4px;
		}

		.contact .php-email-form button[type="submit"]:hover {
			background: #666666;
		}

		@-webkit-keyframes animate-loading {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		@keyframes animate-loading {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}

		/*
		.project-view a{
		color: #333;
		}
		.project-view{
		background-color: #e1e8f2;
		background-image: linear-gradient(189deg, rgba(255,255,255,0) 60%,#ffffff 0%);
		}
		.project-box h6{
		text-align: center;
		margin-top: 10px;
		}
		*/

		/*mobile menu*/

		.mobile-v .sidepanel {
			width: 0;
			position: fixed;
			z-index: 9999;
			height: 100%;
			top: 0;
			right: 0;
			background-color: #111111d6;
			overflow-x: hidden;
			transition: 0.5s;
			padding-top: 60px;
		}

		.mobile-v .sidepanel a {
			text-decoration: none;
			color: #fff;
			display: block;
			transition: 0.3s;
			font-size: 14px;
		}

		.mobile-v .sidepanel a:hover {
			color: #f1f1f1;
		}

		.mobile-v .sidepanel .closebtn {
			position: absolute;
			top: 13px;
			left: 20px;
			width: 30px;
			height: 30px;
			background: #ed2224;
			padding: 3px 1px 5px 8px;
			border-radius: 50%;
			font-weight: bold;
		}

		.mobile-v .openbtn {
			font-size: 25px;
			cursor: pointer;
			color: #333;
			border: none;
			margin-right: 20px;
			background: none;
		}

		.mobile-v .openbtn:hover {
			background: #ed2224;
			color: #fff;
		}

		.mobile-v {}

		.sidemenu a {}

			{
			color: #fff;
		}

		.sidemenu {
			color: #fff;
			padding-left: 20px;
		}

		.mobile-v ul {
			list-style: none;
			padding: 0px;
			margin: 0px;
		}

		.mobile-v ul li a {
			margin-left: 20px;
		}

		.mobile-v ul li:hover {
			background-color: #e82123;
			color: #fff;
		}

		.mobile-v ul li {
			padding: 6px 0px;
			border-bottom: 1px solid #6a6a6a3b;
		}

		.mobile-v ul li a:hover {
			background-color: #e82123;
			color: #fff;
		}

		.mobile-v ul li ul {
			background-color: #333;
			width: 100%;
		}

		.sidemenu {
			color: #fff;
		}

		/*--------------------------------------------------------------
		# Footer
		--------------------------------------------------------------*/
		#footer {
			background-color: #fff;
			padding: 0 0 30px 0;
			font-size: 14px;
		}

		#footer .footer-newsletter {
			padding: 50px 0;
			background: #f0f0f0;
			text-align: center;
			font-size: 15px;
		}

		#footer .footer-newsletter h4 {
			font-size: 24px;
			margin: 0 0 20px 0;
			padding: 0;
			line-height: 1;
			font-weight: 600;
		}

		#footer .footer-newsletter form {
			margin-top: 30px;
			background: #fff;
			padding: 6px 10px;
			position: relative;
			border-radius: 4px;
			box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.06);
			text-align: left;
		}

		#footer .footer-newsletter form input[type="email"] {
			border: 0;
			padding: 4px 8px;
			width: calc(100% - 100px);
		}

		#footer .footer-newsletter form input[type="submit"] {
			position: absolute;
			top: 0;
			right: 0;
			bottom: 0;
			border: 0;
			background: none;
			font-size: 16px;
			padding: 0 20px;
			background: #ed2224;
			color: #fff;
			transition: 0.3s;
			border-radius: 0 4px 4px 0;
			box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.1);
		}

		#footer .footer-newsletter form input[type="submit"]:hover {
			background: #0d58ba;
		}

		#footer .footer-top {
			padding: 60px 0 30px 0;

		}

		#footer .footer-top .footer-contact {
			margin-bottom: 30px;
		}

		#footer .footer-top .footer-contact h3 {
			font-size: 24px;
			margin: 0 0 15px 0;
			padding: 2px 0 2px 0;
			line-height: 1;
			font-weight: 700;
		}

		#footer .footer-top .footer-contact h3 span {
			color: #ed2224;
		}

		#footer .footer-top p {
			font-size: 14px;
			line-height: 24px;
			margin-bottom: 0;
			font-family: "Roboto", sans-serif;
			text-align: justify;
		}


		#footer .footer-top .footer-contact p {
			font-size: 14px;
			line-height: 24px;
			margin-bottom: 0;
			font-family: "Roboto", sans-serif;
			color: #333;
		}

		.footer-contact a {
			color: #333;
		}

		.footer-contact a:hover {
			color: #ed2224;
		}

		#footer .footer-top h4 {
			font-size: 16px;
			font-weight: bold;
			color: #333;
			position: relative;
			padding-bottom: 12px;

		}

		#footer .footer-top .footer-links {
			margin-bottom: 10px;
		}

		#footer .footer-top .footer-links ul {
			list-style: none;
			padding: 0;
			margin: 0;
		}

		#footer .footer-top .footer-links ul i {
			padding-right: 13px;
			color: #333;
			font-size: 11px;
			line-height: 1;
		}

		#footer .footer-top .footer-links ul li {
			padding: 6px 0;
			display: flex;
			align-items: center;
		}

		#footer .footer-top .footer-links ul li:first-child {
			padding-top: 0;
		}

		#footer .footer-top .footer-links ul a {
			color: #555;
			transition: 0.3s;
			line-height: 1;
			font-family: 'Poppins', sans-serif;
		}

		#footer .footer-top .footer-links ul a:hover {
			text-decoration: none;
			color: #ed2224;
		}

		#footer .footer-top .social-links a {
			font-size: 17px;
			display: inline-block;
			background: #444;
			color: #fff;
			line-height: 1;
			padding: 9px 0px;
			margin-right: 4px;
			border-radius: 4px;
			text-align: center;
			width: 36px;
			height: 36px;
			transition: 0.3s;
			border-radius: 50%;
		}

		#footer .footer-top .social-links a:hover {
			background: #666666;
			color: #ddd;
			text-decoration: none;
		}

		#footer .copyright {
			text-align: left;
			color: #333;
		}

		.Development {
			text-align: right;
		}

		#footer .credits {
			float: right;
			text-align: center;
			font-size: 13px;
			color: #444444;
		}


		@media (max-width: 768px) {

			#footer .copyright,
			#footer .credits {
				float: none;
				text-align: center;
				padding: 2px 0;
			}
		}

		.underline {}

		.tips p .span {
			font-size: 30px;
		}

		.tips p {
			padding-top: 25%;
		}


		.underline img {
			height: 6px;
			width: 120px;
			margin: 20px;
			image-rendering: -webkit-optimize-contrast;
		}

		.we-pic img {
			border: 10px solid #f7f7f7;
			box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
			image-rendering: -webkit-optimize-contrast;
		}

		.footer-logo img {
			object-fit: cover;
			image-rendering: -webkit-optimize-contrast;
		}

		#faq-page .accordion-button:not(.collapsed) {
			color: #fff;
			background-color: #ed2224;
		}

		.faq-images img {
			width: 100%;
			image-rendering: -webkit-optimize-contrast;
		}

		.about p {
			text-align: justify;
		}

		.office-hours {
			background-color: #fff;
		}

		.office-hours .active {
			background-color: #ed2224;
			color: #fff;
		}

		/*Blogs*/

		.blog-subtitle {
			padding: 10px;
		}

		.blog-subtitle a {
			color: #333;
			font-size: 17px;
		}

		.blog-subtitle a:hover {
			color: #ed2224;
		}

		.blog-subtitle h5 {
			height: 50px;
		}

		.blog-subtitle p {
			line-height: 24px;
			font-size: 14px;
			margin-bottom: 0;
		}

		.icon-bg-img img {
			height: 220px;
			image-rendering: -webkit-optimize-contrast;
		}

		.gallery-bg {
			background-color: #212529;
		}

		.gallery-part-images-2 img {
			height: 160px;
			border: 5px solid #fff9;
			margin-bottom: 10px;
			object-fit: cover;
			image-rendering: -webkit-optimize-contrast;
		}

		.gallery-part-images-2 img:hover {
			image-rendering: -webkit-optimize-contrast;
			border: 5px solid #fff;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19);

		}


		@media (min-width: 320px) and (max-width: 1000px) {





			.top-slider img {
				height: 500px !important;
				object-fit: cover;
				image-rendering: -webkit-optimize-contrast;
			}

			.register-form {
				text-align: center;
				position: absolute;
				left: 50%;
				transform: translate(-50%, -100%);
				color: white;
				width: 100%;
			}


			.mobile-top-head .fa-clock {
				display: none;
			}

			#footer .footer-top h4 {
				padding: 6px 0px;
				border-bottom: 1px solid #ddd;
			}

			.mobile-v {
				display: block !important;
			}

			.we-pic img {
				border: 0px solid #f7f7f7;
				box-shadow: 0 .5rem 1rem rgba(0, 0, 0, .15) !important;
				image-rendering: -webkit-optimize-contrast;
			}

			.gallery-part-images img {
				object-fit: cover;
				height: 120px;
				margin-bottom: 15px;
				border-radius: 10px;
				image-rendering: -webkit-optimize-contrast;
			}

			.gallery-img .modal-content {
				width: 92%;
			}

			.tips p {
				padding-top: auto;
				!important;
				padding: 20px 0px;
			}

			.services .icon-box p {
				display: none;
			}

			.section-title-left h3 {
				font-size: 22px;
			}

			.section-title-left {
				text-align: center;
				padding-bottom: 30px;
			}

			section {
				padding: 40px 0 !important;
				overflow: hidden;
			}

			.we-pic img {
				border-left: none;
				margin-left: 0px;
				image-rendering: -webkit-optimize-contrast;
			}

			.under-titiles h2,
			p {
				text-align: center;
			}

			.about .content h3 {
				font-weight: 600;
				font-size: 22px;
				margin-bottom: 15px;
			}

			.services2 .item-bx {
				padding: 10px;
				text-align: center;
			}

			.services2 .item-bx h6 {
				height: 28px;
				font-weight: bold;
			}

			.portfolio .owl-carousel .owl-item img {
				display: block;
				width: 100%;
				height: 200px;
				object-fit: cover;
				image-rendering: -webkit-optimize-contrast;
			}

			#footer .footer-top p {
				text-align: left;
			}

			#footer .footer-top .footer-contact p {
				text-align: left;
			}

			.sm-header {
				height: 155px !important;
			}

			.about-title {
				color: #fff;
				text-align: center;
				font-weight: bold;
				margin-top: 30%;
			}



			#featured-services .icon-box {
				text-align: center;
			}

			.featured-services .icon-box {
				padding: 10px !important;
			}

			.featured-services .title {
				font-weight: 600;
				margin-bottom: 10px;
				font-size: 15px;
			}

			.services .icon-box {
				padding: 0px;
				border-radius: 0px;
			}

			.services .icon-box h5 {
				font-size: 16px;
			}

			.parallax-img-title h4 {
				color: #fff;
				text-align: center;
				text-transform: uppercase;
				line-height: 1.8;
			}

			.services2 .item-bx {
				margin-top: -1px;
			}

			.tips p .span {
				font-size: 23px;
				font-weight: bold;
			}

			.gets {
				text-align: center;
			}

			#topbar {
				padding: 0px !important;
			}

			.mobile-top-head {
				display: none;
			}

			.navbar-mobile .dropdown ul a:hover,
			.navbar-mobile .dropdown ul .active:hover,
			.navbar-mobile .dropdown ul li:hover>a {
				color: #fff;
			}

			#featured-services {
				padding: 40px 0 30px 0 !important;
			}

			#featured-services .mb-5 {
				margin-bottom: 15px !important;
			}

			.we-pic {
				margin-right: 00px;
			}

			#header {
				height: 60px;
			}

			#header .logo img {
				max-height: 70px;
				object-fit: contain;
				image-rendering: -webkit-optimize-contrast;

			}

			.about-title h3 {
				font-size: 17px;
			}

			.about-title h6 {
				font-size: 14px;
			}

			#topbar .ms-4 {
				margin-left: 0px !important;
			}

			.member-img img {
				height: 200px;
				object-fit: cover;
			}

			.team .member .member-info h4 {
				font-size: 15px;
			}
		}


		@media (min-width: 950px) and (max-width: 1500px) {

			.top-slider .carousel-caption {
				bottom: 15% !important;
			}

			.top-slider .carousel-caption img {
				width: 300px !important;
			}

			.banner-centers h1 {
				font-size: 35px;
				font-weight: bold;
				text-transform: uppercase;
			}

			.banner-centers {
				text-align: left;
				margin-top: 0%;
			}

		}


		@media (max-width: 1440px) {
			.about-title {
				margin-top: 30%;
			}

			.slide-button-profile {
				position: absolute;
				top: 110px;
				right: 5% !important;
			}

		}


		@media (max-width: 1280px) {
			.about-title {
				margin-top: 37%;
			}


		}

		@media (max-width: 414px) {
			.about-title {
				margin-top: 26%;
			}
		}



	</style>
<body>
	<!-- ======= Top Bar ======= -->
	<section id="topbar" class="d-flex align-items-center">
		<div class="container d-flex justify-content-center justify-content-md-between"> </div>
	</section>
	<!-- ======= Header ======= -->
	<header id="header" class="d-flex align-items-center">
		<div class="container d-flex align-items-center justify-content-between">
			<h1 class="logo"><a href="/"><img src="{{ asset('uploads/logo/'.$logo[0]->image) }}" alt="{{ $company->name }}" title="{{ $company->name }}" height="100" width="100"></a></h1>
			<nav id="navbar" class="navbar">
				<ul>
					<li><a class="active" href="/">Home</a></li>
					<li><a href="/app-login">Login</a></li>
					<li><a href="/app-registration">Register</a></li>
					<li><a href="javascript:void(0)" class="openbtn" onclick="openNav()"><span class="fs-3">☰</span></a></li>
				</ul>
			</nav>
			<!-- .navbar -->
		</div>
		<div class="mobile-v">
			<div id="mySidepanel" class="sidepanel"> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&#8644;</a>
				<div class="d-grid gap-2 m-3">
					<a class="btn btn-blue" href="/app-login" type="button">Login</a>
					<a class="btn btn-blue" href="/app-registration" type="button">Register</a>
				</div>
				<ul>
					<li><a class="active" href="/">Home</a></li>
					<?php $sideMenus = DB::table('side_menus')->get(); ?>
					@foreach ($sideMenus as $sideMenu)
					<li><a href="{{ '/'.$sideMenu->name }}">{{ $sideMenu->name }}</a></li>
					@endforeach
				</ul>
				<div class="sidebar-text m-3">
					<p>Give Us Your Feedback Need any help? Write to us at</p>
					<?php $emails = explode(",",$company->email); ?>
					@foreach ($emails as $email)
					<li><a href="mailto:{{ $email }}">{{ $email }}</a></li>
					@endforeach
					
					<h6 class="mt-2">Call Us On </h6>
					<?php $phones = explode(",",$company->phone); ?>
					@foreach ($phones as $phone)
					<li><a href="tel:{{ $phone }}">{{ $phone }}</a></li>
					@endforeach
				</div>
				<div class="">
					<div class="social-linkd d-flex m-3">
						<?php $follows = DB::table('follows')->get(); ?>
						@foreach ($follows as $follow)
						<?php $followImage = json_decode($follow->image); ?>
						<a href="{{ $follow->link }}"><img src="{{ asset('uploads/follow_image/'.$followImage[0]->image) }}" alt="{{ $follow->title }}" title="{{ $follow->title }}" width="24" height="24" class="me-2"></a>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Header -->
	<?php $sliders = DB::table('sliders')->get(); ?>
	<div class="top-slider">
		<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				@foreach ($sliders as $ds=> $dSlider)
				<?php $dSliderImage = json_decode($dSlider->desktop_image); ?>
				<div class="carousel-item {{ $ds == '0' ? 'active' : '' }}"> <img src="{{ asset('uploads/slider_image/'.$dSliderImage[0]->image) }}" class="d-block w-100" title="{{ $dSlider->text }}" alt="{{ $dSlider->text }}"> </div>
				@endforeach
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
			<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
		</div>
	</div>
	<div class="mobile-slider">
		<div id="slider-mvr" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-inner">
				@foreach ($sliders as $mS=> $mSlider)
				<?php $mSliderImage = json_decode($mSlider->mobile_image); ?>
				<div class="carousel-item {{ $mS == '0' ? 'active' : '' }}"> <img src="{{ asset('uploads/slider_image/'.$mSliderImage[0]->image) }}" class="d-block w-100" title="{{ $mSlider->text }}" alt="{{ $mSlider->text }}"> </div>
				@endforeach
			</div>
			<button class="carousel-control-prev" type="button" data-bs-target="#slider-mvr" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
			<button class="carousel-control-next" type="button" data-bs-target="#slider-mvr" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
		</div>
	</div>
	<style type="text/css">
	@media screen and (max-width: 1000px) {
		.fineyour {
			font-size: 18px !important;
		}
		.fineyour {
			font-size: 33px;
		}
	}
	</style>
	<div class="register-form d-none d-sm-block">
		<div class="container">
			<h1 class="mb-3">Find your perfect life partner</h1>
			<form action="/search" method="get">
				<div class="row register-form-bg">
					<div class="col-md-3 col-6 mb-2">
						<select	name="gender" required class="form-select" aria-label="Default select example">
							<option selected value="">Looking For</option>
							<option value="1">Woman</option>
							<option value="2">Man</option>
						</select>
					</div>
					<?php $religions = DB::table('religions')->get(); ?>
					<div class="col-md-3 col-6">
						<select name="religion" required class="form-select" aria-label="Default select example">
							<option selected value="">Religion</option>
							@foreach ($religions as $religion)
								<option value="{{ $religion->id }}">{{ $religion->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3 col-6 mb-2">
						<select name="from_age" required class="form-select" aria-label="Default select example">
							<option selected value="">From Age</option>
							@for ($fg = 18; $fg <= 80; $fg++)
								<option value="{{ $fg }}">{{ $fg }}</option>
							@endfor
						</select>
					</div>
					<div class="col-md-3 col-6 mb-2">
						<select name="to_age" required class="form-select" aria-label="Default select example">
							<option selected value="">To Age</option>
							@for ($ta = 18; $ta <= 80; $ta++)
								<option value="{{ $ta }}">{{ $ta }}</option>
							@endfor
						</select>
					</div>
					<div class="col-md-3 col-6 mb-2">
						<select name="from_height" required class="form-select" aria-label="Default select example">
							<option selected value="">From Height</option>
							@for ($fh = 4; $fh <= 8; $fh+=.1)
								<option value="{{ $fh }}">{{ strlen($fh) < 2 ? $fh.'.0' : $fh }}"</option>
							@endfor
						</select>
					</div>
					<div class="col-md-3 col-6 mb-2">
						<select name="to_height" required class="form-select" aria-label="Default select example">
							<option selected value="">To Height</option>
							@for ($fh = 4; $fh <= 8; $fh+=.1)
								<option value="{{ $fh }}">{{ strlen($fh) < 2 ? $fh.'.0' : $fh }}"</option>
							@endfor
						</select>
					</div>
					<?php $countries = DB::table('countries')->get(); ?>
					<div class="col-md-3 col-6 mb-2">
						<select name="country" required class="form-select" aria-label="Default select example">
							<option selected value="">Country</option>
							@foreach ($countries as $country)
								<option value="{{ $country->id }}">{{ $country->name }}</option>
							@endforeach
						</select>
					</div>
					<div class="col-md-3 col-6">
						<div class="d-grid gap-2">
							<button type="submit" class="btn btn-primary border-0">Search</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php $howWeWork = DB::table('how_we_works')->get(); ?>
	<div class="varification py-5 bg-white">
		<div class="container">
		  <div class="row">
			@foreach ($howWeWork as $howWe)
			<?php $howWeWorkImg = json_decode($howWe->image); ?>
			<div class="col-lg-4 center">
			  <div class="varification-title">      
				<img src="{{ asset('uploads/how_we_work/'.$howWeWorkImg[0]->image) }}" class="img-fluid" alt="" width="100" height="100">
				<h4>{{ $howWe->title }}</h4>
				<p>{{ $howWe->description }}</p>
			  </div>
			</div>
			@endforeach
		  </div>
		</div>
	  </div>
	<!-- ======= Team Section ======= -->
	<?php $premiumMembers = DB::table('members')->select('id','member_profile_id','profile_image','date_of_birth')->where('membership','2')->inRandomOrder()->limit(6)->get(); ?>
	<section id="premium-members" class="team" style="background-image: url({{ asset('assets/frontend') }}/img/pattern-2.png);">
		<div class="container">
			<div class="section-title">
				<h3>Premium<span> Members</span></h3>
			</div>
			<div class="row">
				<div class="donors owl-carousel owl-theme">
					@foreach ($premiumMembers as $premiumMember)
					<div class="item">
						<div class="col-lg-12 col-md-12 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
							<div class="member">
								<?php $memberImage = json_decode($premiumMember->profile_image) ?>
								<div class="member-img"> <img src="{{ asset('uploads/profile_image/'.$memberImage[0]->thumb) }}" alt="{{ $premiumMember->member_profile_id }}" title="{{ $premiumMember->member_profile_id }}" class="img-fluid" alt="Hasan Rubel" width="100%" height="100%"> </div>
								<div class="member-info">
									<?php
									$now = strtotime('now');
									$difference = ($now - $premiumMember->date_of_birth);
									$age = floor($difference / 31556926);
									?>
									<h4>ID:{{ $premiumMember->member_profile_id }} </h4>
									<p>{{ $age }} Years</p>
									<a href="">
										<button type="button" class="btn btn-primary btn-sm">Full Profile</button>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>
	<style type="text/css">
	.owl-carousel .owl-stage,
	.owl-carousel.owl-drag .owl-item {
		-ms-touch-action: pan-y !important;
		touch-action: pan-y !important;
	}
	</style>
	<?php $happyStory = DB::table('happy_stories')->limit(6)->get(); ?>
	<section id="happy-story">
		<div class="container">
			<div class="row">
				<div class="section-title">
					<h3>Happy <span> Stories</span></h3>
				</div>
				<div class="gallery owl-carousel owl-theme">
					@foreach ($happyStory as $story)
					<?php $storyImage = json_decode($story->image1);?>
					<div class="item">
						<div class="happy mb-4"> <img src="{{ asset('uploads/happy_story_image/'.$storyImage[0]->image) }}" alt="hm" class="image">
							<div class="happy-overlay">
								<div class="stories">
									<?php $storyMemberName = DB::table('members')->where('id',$story->id)->value('first_name'); ?>
									<h5> {{ $story->partner_name }} & {{ $storyMemberName }}</h5>
									<div class="underline"></div>
									<p>{{ $story->title }}</p>
									<a href="/happy-story/{{ $story->id }}">
										<button type="button" class="btn btn-danger-2 btn-sm">Read more</button>
									</a>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

	<section id="about-home" class="bg-light">
		<div class="container">
			<div class="row">
				<div class="col-md-12"> <span><img src="{{ asset('assets/frontend') }}/img/logo.png" width="60" height="60" class="mb-3"></span>
					<!--  <h4 class="mb-3">About HM Weddings</h4> -->
					<p>Welcome to HMWEDDINGS.COM, we are the world’s best international matrimony website. HMWEDDINGS is here, offering you the unrivalled matchmaking service to help you find your perfect life partner. HMWEDDINGS turned into a one-stop answer for individuals who are looking for their perfect life partner. Our committed team is continually endeavoring to help you find the right and perfect life partner for yourself.</p>
				</div>
			</div>
		</div>
	</section>
	<?php $footerLink = DB::table('footer_links')->whereNull('parent')->get(); ?>
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">
					@foreach ($footerLink as $fLink)
					<div class="col-lg-3 col-md-6 col-6 footer-links">
						<h4>{{ $fLink->name }}</h4>
						<ul class="expandible">
							<?php $childLiks = DB::table('footer_links')->where('parent',$fLink->id)->get(); ?>
							@foreach ($childLiks as $cLink)
							<li><a href="{{ "/".$cLink->slug }}">&#187; {{ $cLink->name }}</a></li>
							@endforeach
						</ul>
					</div>
					@endforeach
				</div>
				<div class="row">
					<div class="col-md-3 col-12">
						<h4 class="mt-4">Follow Us on</h4>
						<div class="social-linkd d-flex m-3">
							<?php $follows = DB::table('follows')->get(); ?>
							@foreach ($follows as $follow)
							<?php $followImage = json_decode($follow->image); ?>
							<a href="{{ $follow->link }}"><img src="{{ asset('uploads/follow_image/'.$followImage[0]->image) }}" alt="{{ $follow->title }}" title="{{ $follow->title }}" width="24" height="24" class="me-2"></a>
							@endforeach
						</div>
					</div>
					<div class="col-md-9">
						<h4 class="mt-4">Pay With</h4>
						<?php $payment = DB::table('payment_options')->first();
						$desktopImage = json_decode($payment->desktop_image);
						$mobileImage = json_decode($payment->mobile_image);
						?>
						<div class="payment-icon"> <img src="{{ asset('uploads/payment_option_image/'.$mobileImage[0]->image) }}" alt="{{ $payment->title }}" title="{{ $payment->title }}" class="img-fluid"> </div>
						<div class="payment-icon-2"> <img src="{{ asset('uploads/payment_option_image/'.$desktopImage[0]->image) }}" alt="{{ $payment->title }}" title="{{ $payment->title }}" class="img-fluid"> </div>
					</div>
					<div class="col-md-12">
						<p class="text-center mt-5"><strong>Address:</strong> {{ $company->address }}</p>
					</div>
				</div>
			</div>
		</div>
		</div>
		<div class="container py-2">
			<div class="row">
				<div class="col-md-6">
					<div class="copyright"> Copyright © 2020-2021, HM WEDDINGS. All Rights Reserved </div>
				</div>
				<div class="col-md-6">
					<div class="Development copyright">Design & Development :
						<a href=""> <b>HM Expo Private Ltd</b></a>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!-- End Footer -->
	<script src="{{ asset('assets/frontend') }}/js/app_script.js"></script>
</body>

</html>