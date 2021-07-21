<template>
    <div>
        <!-- ======= Header ======= -->
        <header id="secondHeader" class="d-flex align-items-center" style="position:fixed;background:#1285bd;width:100%;">
            <div class="container d-flex align-items-center justify-content-between">
                <h1 class="logo"><router-link to="/"><img v-if="companyLogo" src="https://www.gcarebd.com/wedding/assets/img/logo-white.png" :title="companyName" :alt="companyName" height="100" width="100"></router-link></h1>
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
    </div>
</template>

<script>
import {mapState} from 'vuex';
export default {
  data() {
    return {
      memberName: null,
    };
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
        let memberDetail = JSON.parse(localStorage.getItem('hmWLoggedIn'));
        this.memberName = memberDetail.name;
    }
    this.$store.dispatch('getCompanyInformation');
    this.$store.dispatch('getSlideMenu');
    this.$store.dispatch('getFollowUsList');
  },
  computed:{
    ...mapState([
      'sideMenus',
      'companyName',
      'companyEmail',
      'companyPhone',
      'companyLogo',
      'companyAddress',
      'followUs',
    ])
  },
  methods: {
    getLogout(){
      this.$store.commit("SET_TOKEN", null);
      localStorage.removeItem("hmWLoggedIn");
      this.$router.push("/");
    }
  },
};
</script>