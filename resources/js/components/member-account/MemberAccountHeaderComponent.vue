<template>
  <div>
    <div class="active-header">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="pro-header-menus profile-logo">
              <router-link to="/"
              v-if="companyLogo"
                ><img
                  src="https://www.gcarebd.com/wedding/assets/img/logo-white.png"
                  :alt="companyName"
                  :title="companyName"
                  height="100"
                  width="100"
              /></router-link>
            </div>
          </div>
          <div class="col-md-5">
            <a class="tablink" @click="activeSubHead('home')"
              >My Home</a
            >
            <a class="tablink" @click="activeSubHead('match')"
              >Matches</a
            >
            <a class="tablink" @click="activeSubHead('search')">Search</a>
            <a class="tablink" @click="activeSubHead('inbox')"
              >Inbox</a
            >
            <div v-if="subHead == 'home'">
              <div class="tab-subtitles">
                <router-link :style="activeChildMenu === '/my-account' ? 'color:#1285bd;' : ''" to="/my-account" class="active"
                  >Dashboard</router-link
                >
                <router-link :style="activeChildMenu === '/my-account/my-profile' ? 'color:#1285bd;' : ''" to="/my-account/my-profile"
                  >My Profile</router-link
                >
                <router-link :style="activeChildMenu === '/my-account/photo' ? 'color:#1285bd;' : ''" to="/my-account/photo">Add Photos</router-link>
                <router-link :style="activeChildMenu === '/my-account/partner-profile' ? 'color:#1285bd;' : ''" to="/my-account/partner-profile"
                  >Partner Preferences</router-link
                >
                <router-link :style="activeChildMenu === '/my-account/contact-details' ? 'color:#1285bd;' : ''" to="/my-account/contact-details"
                  >Contact Details</router-link
                >
                <router-link :style="activeChildMenu === '/my-account/order' ? 'color:#1285bd;' : ''" to="/my-account/order">Order Now</router-link>
                <router-link :style="activeChildMenu === '/my-account/account-settings' ? 'color:#1285bd;' : ''" to="/my-account/account-settings"
                  >Settings</router-link
                >
              </div>
            </div>
            <div v-if="subHead == 'match'">
              <div class="tab-subtitles">
                <router-link :style="activeChildMenu === '/my-account/new-match' ? 'color:#1285bd;' : ''" to="/my-account/new-match">New Matches</router-link>
                <router-link :style="activeChildMenu === '/my-account/today-match' ? 'color:#1285bd;' : ''" to="/my-account/today-match">Todays Matches</router-link>
                <router-link :style="activeChildMenu === '/my-account/my-match' ? 'color:#1285bd;' : ''" to="/my-account/my-match">My Matche</router-link>
                <router-link :style="activeChildMenu === '/my-account/recent-view' ? 'color:#1285bd;' : ''" to="/my-account/recent-view">Recently Viewe</router-link>
                <router-link :style="activeChildMenu === '/my-account/near-me' ? 'color:#1285bd;' : ''" to="/my-account/near-me">Near Me </router-link>
                <router-link :style="activeChildMenu === '/my-account/shortlisted' ? 'color:#1285bd;' : ''" to="/my-account/shortlisted"> Shortlisted</router-link>
                <router-link :style="activeChildMenu === '/my-account/recent-visitor' ? 'color:#1285bd;' : ''" to="/my-account/recent-visitor">
                  Recent Visitor</router-link
                >
              </div>
            </div>
            <div v-if="subHead == 'search'">
              <div class="tab-subtitles">
                <router-link :style="activeChildMenu === '/my-account/regular-search' ? 'color:#1285bd;' : ''" to="/my-account/regular-search"
                  >Regular Search</router-link
                >
                <router-link :style="activeChildMenu === '/my-account/advanced-search' ? 'color:#1285bd;' : ''" to="/my-account/advanced-search"
                  >Advanced Search</router-link
                >
              </div>
            </div>
            <div v-if="subHead == 'inbox'">
              <div class="tab-subtitles">
                <router-link :style="activeChildMenu === '/my-account/invitations' ? 'color:#1285bd;' : ''" to="/my-account/invitations">Invitations</router-link>
                <router-link :style="activeChildMenu === '/my-account/accept-request' ? 'color:#1285bd;' : ''" to="/my-account/accept-request">Accepted</router-link>
                <router-link :style="activeChildMenu === '/my-account/pending-request' ? 'color:#1285bd;' : ''" to="/my-account/pending-request">Requests</router-link>
                <router-link :style="activeChildMenu === '/my-account/sent-request' ? 'color:#1285bd;' : ''" to="/my-account/sent-request">Sent</router-link>
                <router-link :style="activeChildMenu === '/my-account/declined-request' ? 'color:#1285bd;' : ''" to="/my-account/declined-request">Deleted</router-link>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="pro-header-menus user-icon btn-group float-end">
              <a
                type="button"
                class="dropdown-toggle"
                data-bs-toggle="dropdown"
                data-bs-display="static"
                aria-expanded="false"
                v-if="member.image"
              >
                <img :src="member.image" height="35" width="35" />
              </a>
              <div class="dropdown-menu dropdown-menu-lg-end p-3">
                <div class="user-name mb-2">
                  {{ member.name }}
                  <span class="user-id">{{ member.profileId }}</span>
                </div>
                <div class="user-account">
                  Account Type: {{ member.membershipType
                  }}<span class="border-end border-2"></span
                  ><span><router-link to="/premium-plan">Upgrade Account</router-link></span>
                </div>
                <hr />
                <ul class="user-my-profile mt-3">
                  <li>
                    <router-link to="/my-account">
                      <img
                        src="/assets/frontend/img/user.png"
                        width="16"
                        height="16"
                      />My Profile</router-link
                    >
                  </li>
                  <li>
                    <router-link to="/my-account/account-settings"
                      ><img
                        src="/assets/frontend/img/settings.png"
                        width="16"
                        height="16"
                      />
                      Account Settings</router-link
                    >
                  </li>
                  <li>
                    <router-link to="/my-account/contact-details"
                      ><img
                        src="/assets/frontend/img/padlock.png"
                        width="16"
                        height="16"
                      />
                      Contact Details</router-link
                    >
                  </li>
                  <li>
                    <router-link to="/my-account/partner-profile"
                      ><img
                        src="/assets/frontend/img/filter.png"
                        width="16"
                        height="16"
                      />Contact Filters</router-link
                    >
                  </li>
                  <li>
                    <router-link to="/my-account/today-match"
                      ><img
                        src="/assets/frontend/img/email.png"
                        width="16"
                        height="16"
                      />Today Matches</router-link
                    >
                  </li>
                  <li>
                    <a href="javascript:void(0)" @click="getLogout"
                      ><img
                        src="/assets/frontend/img/logout.png"
                        width="16"
                        height="16"
                      />Logout</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="pro-header-menus active-rightside float-end">
              <router-link to="/premium-plan">Upgrade Now</router-link>
              <router-link to="/my-account/notifications"
                >
                <span class="notifications-main"
                  ><img
                    src="/assets/frontend/img/bell.png"
                    width="24"
                    height="20" /></span
                >
                <!-- <span class="notifications-badge"></span> -->
                </router-link
              >
              <div class="btn-group">
                <a
                  type="button"
                  class="dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                >
                  Help
                </a>
                <ul class="dropdown-menu dropdown-menu-end helpdesk">
                  <li>
                    <button class="dropdown-item" type="button">
                      <router-link to="/help">Help Desk</router-link>
                    </button>
                  </li>
                  <li>
                    <button class="dropdown-item" type="button">
                      <router-link to="/help">Customer Services</router-link>
                    </button>
                  </li>
                  <li>
                    <button class="dropdown-item" type="button">
                      <router-link to="/help">Safe Matrimony</router-link>
                    </button>
                  </li>
                  <li>
                    <button class="dropdown-item" type="button">
                      <router-link to="/help">Help Topics</router-link>
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="mobile-version-sidenav">
      <div id="m-sidenav" class="mnav">
        <a
          href="javascript:void(0)"
          class="closebtn border-0"
          onclick="closeNavs()"
          >&times;</a
        >
        <router-link to="/my-account" style="background-color: #1285bd; color: #fff"
          ><img :src="member.image" width="20" height="20" />
          {{ member.name }}</router-link
        >
        <router-link to="/premium-plan">Premium Plans</router-link>
        <div class="mside-menu" id="msidbars">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button
                class="accordion-button collapsed border-bottom"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#msidemenu2"
                aria-expanded="false"
                aria-controls="msidemenu2"
              >
                Help & Support
              </button>
            </h2>
            <div
              id="msidemenu2"
              class="accordion-collapse collapse"
              aria-labelledby="headingTwo"
              data-bs-parent="#msidbars"
            >
              <div class="accordion-body p-0">
                <router-link to="/help">Help Desk</router-link>
                <router-link to="/help">Customer Services</router-link>
                <router-link to="/help">Safe Matrimony</router-link>
                <router-link to="/help">Help Topics</router-link>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button
                class="accordion-button collapsed border-bottom"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#msidemenu3"
                aria-expanded="false"
                aria-controls="msidemenu3"
              >
                Search
              </button>
            </h2>
            <div
              id="msidemenu3"
              class="accordion-collapse collapse"
              aria-labelledby="headingThree"
              data-bs-parent="#msidbars"
            >
              <div class="accordion-body p-0">
                <router-link to="/my-account/regular-search">Regular Search </router-link>
                <router-link to="/my-account/advanced-search">Advanced Search</router-link>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button
                class="accordion-button collapsed border-bottom"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#msidemenu1"
                aria-expanded="false"
                aria-controls="msidemenu1"
              >
                Account Settings
              </button>
            </h2>
            <div
              id="msidemenu1"
              class="accordion-collapse collapse"
              aria-labelledby="headingTwo"
              data-bs-parent="#msidbars"
            >
              <div class="accordion-body p-0">
                <router-link to="/my-account/account-settings">My Account</router-link>
                <router-link to="/my-account/account-settings">Contact Filters</router-link>
                <router-link to="/my-account/account-settings">Privacy Options</router-link>
                <router-link to="/my-account/account-settings">Email / SMS Alerts</router-link>
                <router-link to="/my-account/account-settings">Hide / Delete Profile</router-link>
              </div>
            </div>
          </div>
        </div>

        <a href="#">Notifications</a>
        <a href="javascript:void(0)" @click="getLogout">Log Out</a>
      </div>
    </div>
    <div class="mobile-navbar">
      <a href="#" onclick="openNavs()">
        <div class="m-menu-icon"><span class="m-menu"></span>Menu</div>
      </a>
      <a href="javascript:void(0)" @click="mobileSubHead('my-account')">
        <div class="m-menu-icon"><span class="m-menu-h"></span>Account</div>
      </a>
      <a href="javascript:void(0)" @click="mobileSubHead('metchs')">
        <div class="m-menu-icon"><span class="m-menu-m"></span>Matches</div>
      </a>
      <a href="javascript:void(0)" @click="mobileSubHead('inbox')">
        <div class="m-menu-icon"><span class="m-menu-in"></span>Inbox</div>
      </a>
      <a href="javascript:void(0)" @click="mobileSubHead('chat')">
        <div class="m-menu-icon"><span class="m-menu-chat"></span>Chat</div>
      </a>
    </div>
    <div
      id="homes"
      class="mobile-subnav"
      v-if="activeMobileSubHead == 'my-account'"
    >
      <router-link to="/my-account">Dashboard</router-link>
      <router-link to="/my-account/my-profile">My Profile</router-link>
      <router-link to="/my-account/photo">Add Photos</router-link>
      <router-link to="/my-account/partner-profile"
        >Partner Preferences</router-link
      >
      <router-link to="/my-account/contact-details"
        >Contact Details</router-link
      >
      <router-link to="/my-account/order">Order Now</router-link>
      <router-link to="/my-account/account-settings">Settings</router-link>
    </div>
    <div
      id="Matches"
      class="mobile-subnav"
      v-if="activeMobileSubHead == 'metchs'"
    >
      <router-link  to="/my-account/new-match">New Matches</router-link>
      <router-link  to="/my-account/today-match">Todays Matches</router-link>
      <router-link  to="/my-account/my-match">My Matche</router-link>
      <router-link  to="/my-account/recent-view">Recently Viewe</router-link>
      <router-link  to="/my-account/near-me">Near Me </router-link>
      <router-link  to="/my-account/shortlisted"> Shortlisted</router-link>
      <router-link  to="/my-account/recent-visitor">
        Recent Visitor</router-link
      >
    </div>
    <div id="Inbox" class="mobile-subnav" v-if="activeMobileSubHead == 'inbox'">
      <router-link to="/my-account/invitations">Invitations</router-link>
      <router-link to="/my-account/accept-request">Accepted</router-link>
      <router-link to="/my-account/pending-request">Requests</router-link>
      <router-link to="/my-account/sent-request">Sent</router-link>
      <router-link to="/my-account/declined-request">Deleted</router-link>
    </div>
    <div id="chat" class="mobile-subnav" v-if="activeMobileSubHead == 'chat'">
      <a href="/my-account/chat">Recent Chats</a>
      <a href="/my-account/chat">Active</a>
    </div>
    <!-- chat box -->
    <div class="chat-box desktop-chatbox">
      <button class="open-button" onclick="openForm32()">Active</button>
      <div class="chat-popup" id="myForm">
        <div action="" class="form-container">
          <div class="d-flex chat-head-clr">
            <div class="sdf">Online Now</div>
            <div class="ms-auto" onclick="closeForm32()">X</div>
          </div>
          <a
            class="opend-button"
            onclick="openFormss()"
            style="cursor: pointer"
          >
            <div class="d-flex p-1 chat-head">
              <div class="chat-image">
                <img
                  src="/assets/frontend/img/testimonials-4.jpg"
                  class="border"
                />
              </div>
              <div class="chat-name align-self-center">Abdul Jalil</div>
              <div class="ms-auto"><i class="fas fa-circle"></i></div>
            </div>
          </a>
          <a
            class="opend-button"
            onclick="openFormss()"
            style="cursor: pointer"
          >
            <div class="d-flex p-1 chat-head">
              <div class="chat-image">
                <img
                  src="/assets/frontend/img/testimonials-4.jpg"
                  class="border"
                />
              </div>
              <div class="chat-name align-self-center">Abdul Jalil</div>
              <div class="ms-auto"><i class="fas fa-circle"></i></div>
            </div>
          </a>
          <a
            class="opend-button"
            onclick="openFormss()"
            style="cursor: pointer"
          >
            <div class="d-flex p-1 chat-head">
              <div class="chat-image">
                <img
                  src="/assets/frontend/img/testimonials-4.jpg"
                  class="border"
                />
              </div>
              <div class="chat-name align-self-center">Abdul Jalil</div>
              <div class="ms-auto"><i class="fas fa-circle"></i></div>
            </div>
          </a>
          <a
            class="opend-button"
            onclick="openFormss()"
            style="cursor: pointer"
          >
            <div class="d-flex p-1 chat-head">
              <div class="chat-image">
                <img
                  src="/assets/frontend/img/testimonials-4.jpg"
                  class="border"
                />
              </div>
              <div class="chat-name align-self-center">Abdul Jalil</div>
              <div class="ms-auto"><i class="fas fa-circle"></i></div>
            </div>
          </a>
          <a
            class="opend-button"
            onclick="openFormss()"
            style="cursor: pointer"
          >
            <div class="d-flex p-1 chat-head">
              <div class="chat-image">
                <img
                  src="/assets/frontend/img/testimonials-4.jpg"
                  class="border"
                />
              </div>
              <div class="chat-name align-self-center">Abdul Jalil</div>
              <div class="ms-auto"><i class="fas fa-circle"></i></div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <div class="form-popups" id="chatboxs">
      <div class="chatting-box">
        <div class="container">
          <div class="row pt-3">
            <div class="chat-main shadow">
              <div class="col-md-12 chat-header rounded-top text-white">
                <div class="row">
                  <div class="col-md-9 col-9 username pl-2">
                    <i
                      class="fa fa-circle text-success"
                      aria-hidden="true"
                      style="color: #54f054 !important"
                    ></i>
                    <h6 class="m-0">Abdul Jalil</h6>
                  </div>
                  <div class="col-md-3 col-3 options text-right pr-2">
                    <i class="far fa-arrow-alt-circle-down hide-chat-boxs">&#x274F;</i>
                    <i class="far fa-times-circle" onclick="closeFormss()">&#x2612;</i>
                  </div>
                </div>
              </div>
              <div class="chat-content bg-body">
                <div class="col-md-12 chats border">
                  <ul class="p-2 bg-body">
                    <li
                      class="
                        pl-2
                        pr-2
                        bg-primary
                        rounded
                        text-white text-center
                        send-msg
                        mb-1
                      "
                    >
                      hiii
                    </li>
                    <li class="p-1 rounded mb-1">
                      <div class="receive-msg">
                        <img
                          src="/assets/frontend/img/testimonials-4.jpg"
                          class="border"
                        />
                        <div
                          class="
                            receive-msg-desc
                            text-center
                            mt-1
                            ml-1
                            pl-2
                            pr-2
                          "
                        >
                          <p class="pl-2 pr-2 rounded">hello</p>
                        </div>
                      </div>
                    </li>
                    <li
                      class="
                        pl-2
                        pr-2
                        bg-primary
                        rounded
                        text-white text-center
                        send-msg
                        mb-1
                      "
                    >
                      how are you ???
                    </li>
                    <li class="p-1 rounded mb-1">
                      <div class="receive-msg">
                        <div class="receive-msg-img">
                          <img
                            src="/assets/frontend/img/testimonials-4.jpg"
                            class="border"
                          />
                        </div>
                        <div
                          class="
                            receive-msg-desc
                            rounded
                            text-center
                            mt-1
                            ml-1
                            pl-2
                            pr-2
                          "
                        >
                          <p
                            class="
                              mb-0
                              mt-1
                              pl-2
                              pr-2
                              rounded-top rounded-right
                            "
                          >
                            I'm fine !!!
                          </p>
                          <p
                            class="
                              mb-0
                              mt-1
                              pl-2
                              pr-2
                              rounded-bottom rounded-right
                            "
                          >
                            Where are you ?
                          </p>
                        </div>
                      </div>
                    </li>
                    <li
                      class="
                        pl-2
                        pr-2
                        bg-primary
                        text-white text-center
                        send-msg
                        mb-1
                        rounded-top rounded-left
                      "
                    >
                      at california
                    </li>
                    <li
                      class="
                        pl-2
                        pr-2
                        bg-primary
                        text-white text-center
                        send-msg
                        mb-1
                        rounded-bottom rounded-left
                      "
                    >
                      and where are you ?
                    </li>
                    <li class="p-1 rounded mb-1">
                      <div class="receive-msg">
                        <img
                          src="/assets/frontend/img/testimonials-4.jpg"
                          class="border"
                        />
                        <div
                          class="
                            receive-msg-desc
                            rounded
                            text-center
                            mt-1
                            ml-1
                            pl-2
                            pr-2
                          "
                        >
                          <p class="pl-2 pr-2 rounded">
                            now i'm at new york city
                          </p>
                        </div>
                      </div>
                    </li>
                    <li
                      class="
                        pl-2
                        pr-2
                        bg-primary
                        rounded
                        text-white text-center
                        send-msg
                        mb-1
                      "
                    >
                      Ok
                    </li>
                  </ul>
                </div>
                <div class="col-md-12 message-box border p-2 pr-2 border-top-0">
                  <div class="input-group mb-3">
                    <input
                      type="text"
                      class="form-control border"
                      placeholder="Type your message"
                      aria-label="Reply"
                      aria-describedby="button-addon2"
                    />
                    <button
                      class="btn btn-outline-secondary border"
                      type="submit"
                      id="button-addon2"
                    >
                      <i class="fas fa-paper-plane"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--================================= End Header =====================================-->
  </div>
</template>

<script>
import {mapState} from 'vuex';
export default {
  data: function () {
    return {
      memberInfo: null,
      subHead: "home",
      activeMobileSubHead: 'my-account',
      activeChildMenu: null,
      member: {
        name: null,
        profileId: null,
        image: null,
        packageName: null,
        packageExpDate: null,
        membershipType: null,
      },
    };
  },
  mounted() {
    this.$store.dispatch('getCompanyInformation')
    if (localStorage.getItem('hmWLoggedIn')) {
        let memberInfo = JSON.parse(localStorage.getItem('hmWLoggedIn'));
        this.member.name = memberInfo.name;
        this.member.profileId = memberInfo.member_profile_id;
        this.member.membershipType = memberInfo.membership == '2' ? 'Premium' : 'Free';
        this.member.image = memberInfo.image;
        this.member.packageName = memberInfo.package_info.current_package;
        this.member.packageExpDate = memberInfo.package_info.expire_date ? memberInfo.package_info.expire_date : '';
    }
    
    this.subHead = this.$store.state.activeMenu;
    this.activeChildMenu = this.$route.fullPath;
  },
  methods: {
    activeSubHead(submenu) {
      this.subHead = submenu;
      this.$store.commit('SET_MENU',submenu)
    },
    mobileSubHead(menu) {
      this.activeMobileSubHead = menu;
    },
    getLogout() {
      this.$store.commit("SET_TOKEN", null);
      localStorage.removeItem("hmWLoggedIn");
      this.$router.push("/");
    },
  },
  computed:{
    ...mapState([
      'companyName',
      'companyLogo',
    ])
  },
};
</script>
