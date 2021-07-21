<template>
    <div>
        <!-- Header  -->
        <!-- ======= Top Bar ======= -->
        <section id="topbar" class="d-flex align-items-center">
            <div class="container d-flex justify-content-center justify-content-md-between"></div>
        </section>
        <!-- ======= Header ======= -->
        <header id="header" class="d-flex align-items-center">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo"><router-link to="/"><img v-if="companyLogo" :src="'/uploads/logo/'+companyLogo" :title="companyName" :alt="companyName" height="100" width="100"></router-link></h1>
                <nav id="navbar" class="navbar">
                    <ul v-if="memberName">
                        <li><router-link to="/advance-search">Search</router-link></li>
                        <li><router-link to="/my-account">My Account</router-link></li>
                        <li><a href="javascript:void(0)" class="openbtn" onclick="openNav()"><span class="fs-3">☰</span></a></li>
                    </ul>
                    <ul v-else>
                        <li><router-link to="/advance-search">Search</router-link></li>
                        <li><router-link to="/app-login">Login</router-link></li>
                        <li><router-link to="/app-registration">Register</router-link></li>
                        <li><a href="javascript:void(0)" class="openbtn" onclick="openNav()"><span class="fs-3">☰</span></a></li>
                    </ul>
                </nav>
                <!-- .navbar -->
            </div>
            <div class="mobile-v">
                <div id="mySidepanel" class="sidepanel"> <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">⇄</a>
                    <div class="d-grid gap-2 m-3" v-if="memberName">
                        <router-link class="btn btn-blue" to="/my-account" type="button">{{ memberName }}</router-link>
                        <button class="btn btn-blue" @click="getLogout" type="button">Logout</button>
                    </div>
                    <div class="d-grid gap-2 m-3" v-else>
                        <router-link class="btn btn-blue" to="/app-login" type="button">Login</router-link>
                        <router-link class="btn btn-blue" to="/app-registration" type="button">Register</router-link>
                    </div>
                    <ul>
                        <li><router-link to="/">Home</router-link></li>
                        <li v-for="menu in sideMenus" :key="menu.id">
                            <router-link :to="'/'+menu.url">{{ menu.name }}</router-link>
                        </li>
                    </ul>
                    <div class="sidebar-text m-3">
                        <p>Give Us Your Feedback Need any help? Write to us at</p>
                        <li v-for="email in companyEmail" :key="email">
                            <a :href="'mailto:'+email">{{ email }}</a>
                        </li>
                        <h6 class="mt-2">Call Us On </h6>
                        <li v-for="phone in companyPhone" :key="phone">
                            <a :href="'tel:'+phone">{{ phone }}</a>
                        </li>
                    </div>
                    <div class="">
                        <div class="social-linkd d-flex m-3">
                            <a v-for="follow in followUs" :key="follow.id" :href="follow.link">
                                <img :src="'/uploads/follow_image/'+JSON.parse(follow.image)[0].image" width="32" height="32" class="me-2">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Header End -->
        <!-- Desktop Slider -->
        <div class="top-slider">
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item" v-for="(slider,dS) in sliders" :key="slider.id" :class="{ 'active': dS === 0 }">
                        <img :src="'uploads/slider_image/'+JSON.parse(slider.desktop_image)[0].image" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
            </div>
        </div>
        <!-- Desktop Slider End-->
        <!-- Mobile Slider -->
        <div class="mobile-slider">
            <div id="slider-mvr" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item"  v-for="(mobileSlider,mS) in sliders" :key="mobileSlider.id" :class="{ 'active': mS === 0 }">
                        <img :src="'uploads/slider_image/'+JSON.parse(mobileSlider.mobile_image)[0].image" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#slider-mvr" data-bs-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="visually-hidden">Previous</span> </button>
                <button class="carousel-control-next" type="button" data-bs-target="#slider-mvr" data-bs-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="visually-hidden">Next</span> </button>
            </div>
        </div>
        <!-- Mobile Slider End -->
        <!-- How We Work -->
        <div class="varification py-5 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 center" v-for="work in howWeWork" :key="work.id">
                        <div class="varification-title"> <img :src="'uploads/how_we_work/'+JSON.parse(work.image)[0].image" class="img-fluid" alt="" width="100" height="100">
                            <h4>{{ work.title }}</h4>
                            <p>{{ work.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- How We Work End -->
        <!-- Premium Member -->
        <section id="premium-members" class="team" style="background-image: url(https://dev.hmweddings.com/assets/frontend/img/pattern-2.png);">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h3>Premium<span> Members</span></h3>
                </div>
                <div class="row">
                    <carousel v-if="premiumMembers.length" :items="5" :margin="20" :loop="true" :nav="false" :autoplay="true" :dots="false" :autoplayTimeout="3000" :responsive="{0:{items:1},600:{items:4},1000:{items:5}}">
                        <div class="col-lg-12 col-md-12 d-flex align-items-stretch" v-for="premiumMember in premiumMembers" :key="premiumMember.member_profile_id">
                            <div class="member">
                                <div class="member-img">
                                    <img :src="premiumMember.image" class="img-fluid" alt="karim" width="100%" height="100%">
                                </div>
                                <div class="member-info">
                                    <h4>{{ premiumMember.member_profile_id }} </h4>
                                    <div v-if="memberName">
                                        <router-link :to="'/my-account/view-profile/'+premiumMember.member_profile_id"><button type="button" class="btn btn-primary btn-sm">Full Profile</button></router-link>
                                    </div>
                                    <div v-else>
                                        <router-link to="/app-login"><button type="button" class="btn btn-primary btn-sm">Full Profile</button></router-link>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </carousel>
                </div>
            </div>
        </section>
        <!-- Premium Member End -->
        <!-- Happy Story -->
        <section id="happy-story">
            <div class="container">
                <div class="row">
                    <div class="section-title">
                        <h3>Happy <span> Stories</span></h3>
                    </div>
                    <carousel v-if="happyStories.length" :items="5" :margin="20" :loop="true" :nav="false" :autoplay="true" :dots="false" :autoplayTimeout="3000" :responsive="{0:{items:1},600:{items:3},1000:{items:4}}">
                        <div class="happy mb-4" v-for="happyStory in happyStories" :key="happyStory.id">
                            <img :src="happyStory.image" alt="hm" class="image">
                            <div class="happy-overlay">
                                <div class="stories">
                                    <h5>{{ happyStory.name }}</h5>
                                    <div class="underline"></div>
                                    <p>{{ happyStory.title }}</p>
                                    <router-link :to="'/happy-story/'+happyStory.id">Read more</router-link>
                                </div>
                            </div>
                        </div>
                    </carousel>
                </div>
            </div>
        </section>
        <!-- Happy Story End -->
        <!-- About HM Wedding -->
        <section id="about-home" class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-12"> <span><img src="assets/frontend/img/logo.png" width="60" height="60" class="mb-3"></span>
                        <!--  <h4 class="mb-3">About HM Weddings</h4> -->
                        <p>Welcome to HMWEDDINGS.COM, we are the world’s best international matrimony website. HMWEDDINGS is here, offering you the unrivalled matchmaking service to help you find your perfect life partner. HMWEDDINGS turned into a one-stop answer for individuals who are looking for their perfect life partner. Our committed team is continually endeavoring to help you find the right and perfect life partner for yourself.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- About HM Wedding End -->
        <footer id="footer">
            <div class="footer-top">
                <div class="container">
                <div class="row">
                    <div
                    class="col-lg-3 col-md-6 col-6 footer-links"
                    v-for="footerLink in footerLinks"
                    :key="footerLink.id"
                    >
                    <h4>{{ footerLink.name }}</h4>
                    <ul class="expandible">
                        <li
                        v-for="childFooter in footerLink.child"
                        :key="childFooter.id"
                        >
                        <router-link :to="childFooter.slug">
                            {{ childFooter.name }}</router-link
                        >
                        </li>
                    </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-12">
                    <h4 class="mt-4">Follow Us on</h4>
                    <div class="social-linkd mt-3">
                        <a
                        v-for="follow in followUs"
                        :key="follow.id"
                        :href="follow.link"
                        >
                        <img
                            :src="
                            '/uploads/follow_image/' +
                            JSON.parse(follow.image)[0].image
                            "
                            width="32"
                            height="32"
                        />
                        </a>
                    </div>
                    </div>
                    <div class="col-md-9">
                    <h4 class="mt-4">Pay With</h4>
                    <div class="payment-icon" v-if="mobilePayWithImage">
                        <img
                        :src="'/uploads/payment_option_image/'+mobilePayWithImage"
                        class="img-fluid"
                        />
                    </div>
                    <div class="payment-icon-2" v-if="desktopPayWithImage">
                        <img
                        :src="'/uploads/payment_option_image/'+desktopPayWithImage"
                        class="img-fluid"
                        />
                    </div>
                    </div>
                    <div class="col-md-12">
                    <p class="text-center mt-5">
                        <strong>Address:</strong>
                        {{ companyAddress }}
                    </p>
                    </div>
                </div>
                </div>
            </div>

            <div class="container py-2">
                <div class="row">
                <div class="col-md-6">
                    <div class="copyright">
                    Copyright © 2020-2021, HM WEDDINGS. All Rights Reserved
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="Development copyright">
                    Design & Development :<a href=""> <b>HM Expo Private Ltd</b></a>
                    </div>
                </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
import {mapState} from 'vuex'
import carousel from 'vue-owl-carousel'
export default {
    components:{
        carousel,
    },
    data () {
        return {
            memberName: null,
        }
    },
    mounted () {
        if (localStorage.getItem('hmWLoggedIn')) {
            let memberDetail = JSON.parse(localStorage.getItem('hmWLoggedIn'));
            this.memberName = memberDetail.name;
        }
        this.$store.dispatch('getCompanyInformation');
        this.$store.dispatch('getSlider');
        this.$store.dispatch('getHowWeWork');
        this.$store.dispatch('getSlideMenu');
        this.$store.dispatch('getPremiumMember');
        this.$store.dispatch('getFollowUsList');
        this.$store.dispatch('getHappyStory');
        this.$store.dispatch('getFooterLink');
        this.$store.dispatch('getPayWith');
    },
    computed:{
        ...mapState([
            'companyName',
            'companyEmail',
            'companyPhone',
            'companyLogo',
            'companyAddress',
            'sliders',
            'sideMenus',
            'howWeWork',
            'premiumMembers',
            'happyStories',
            'footerLinks',
            'followUs',
            'mobilePayWithImage',
            'desktopPayWithImage',
        ])
    },
    methods:{
        getLogout(){
         this.$store.commit("SET_TOKEN", null);
        localStorage.removeItem("hmWLoggedIn");
        this.$router.push("/");
       }
    }
}
</script>
