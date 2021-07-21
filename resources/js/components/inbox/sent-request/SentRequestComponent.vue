<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10" v-if="senRequestList.data">
            <h5>Accepted Invitations</h5>
            <div
              class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
              v-for="(invite, row) in senRequestList.data"
              :key="invite.memberId"
            >
              <div class="row">
                <div class="col-md-3">
                  <div class="match-list-image-inbox p-3 mb-2">
                    <a href="my-profile.php"><img :src="invite.images[0]" /></a>
                  </div>
                </div>
                <div class="col-md-9 p-3 mv-list-matches-chat2">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="d-flex">
                        <div class="me-2">
                          <router-link
                            :to="'/my-account/view-profile/' + invite.memberId"
                          >
                            <h5>{{ invite.name }}</h5>
                          </router-link>
                        </div>
                        <img
                          src="/assets/frontend/img/verified.png"
                          width="16"
                          height="16"
                        />
                        <div class="ms-auto me-2 h8">
                          {{ invite.created_at }}
                        </div>
                      </div>
                      <div class="create-profile-title mb-4">
                        <span class="Verified"
                          ><img
                            src="/assets/frontend/img/verified.png"
                            width="16"
                            height="16"
                          />
                          Verified</span
                        ><span class="border-2"></span
                        ><span class="border-end border-2"></span
                        ><a href="" class="chat"
                          ><img
                            src="/assets/frontend/img/black-circle.png"
                            width="12"
                            height="12"
                          />
                          Online now</a
                        >
                      </div>
                      <div class="match-list-short-list3 my-3">
                        <span class="profile-list-images">
                          <img
                            src="/assets/frontend/img/circle.png"
                            width="12"
                            height="12"
                          />{{ invite.age }} yrs, {{ invite.height }}"</span
                        >
                        <span class="profile-list-images">
                          <img
                            src="/assets/frontend/img/circle.png"
                            width="12"
                            height="12"
                          />{{ invite.marital_status }}</span
                        >
                        <span class="profile-list-images">
                          <img
                            src="/assets/frontend/img/circle.png"
                            width="12"
                            height="12"
                          />{{ invite.mother_language }}</span
                        >
                        <span class="profile-list-images">
                          <img
                            src="/assets/frontend/img/circle.png"
                            width="12"
                            height="12"
                          />{{ invite.country_living_in }} in
                          {{ invite.state_living_in }}</span
                        >
                        <span class="profile-list-images">
                          <img
                            src="/assets/frontend/img/circle.png"
                            width="12"
                            height="12"
                          />{{ invite.religion }}, {{ invite.caste }}</span
                        >
                      </div>
                    </div>
                    <div class="col-md-4 col-12 border-start">
                      <div class="connect-buttons-inbox text-center">
                        <p>Like this profile?</p>
                        <div class="conncet-button-head">
                          <a href="#">
                            <div class="conncet-now">
                              <a href="javascript:void(0)">
                                <img
                                  src="/assets/frontend/img/notification2.png"
                                  width="40"
                                  height="40"
                                />
                              </a>
                              <span class="mb-2"> Send Reminder</span>
                            </div>
                          </a>
                          <a href="#">
                            <div class="conncet-now">
                              <a href="javascript:void(0)">
                                <img
                                  src="/assets/frontend/img/multiply.png"
                                  width="40"
                                  height="40"
                                  @click="cancelRequest(row, invite.memberId)"
                                />
                              </a>
                              <span class="mb-2">Cancel</span>
                            </div>
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            v-else
            class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
          >
            <div class="text-center p-5" v-if="resultNotFount">
              <img
                src="/assets/frontend/img/pending.png"
                class="img-fluid"
                height="300"
                width="300"
              />
              <h5 class="mt-3">There are no Sent Invitations</h5>
              <button type="button" class="btn btn-blue2 btn-sm bg-gradient">
                <router-link to="/my-account/my-match"
                  >View My Matches</router-link
                >
              </button>
            </div>
            <!-- Shine Effect -->
            <div
              v-else
              class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
            >
              <div class="row">
                <div class="col-md-3">
                  <div class="match-list-image-inbox p-3 mb-2">
                    <div id="box" class="shine"></div>
                  </div>
                </div>
                <div class="col-md-9 p-3">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="d-flex">
                        <div class="me-2">
                          <div class="lines-title shine"></div>
                          <br />
                          <div class="lines-2 shine"></div>
                        </div>
                        <div class="ms-auto me-2 h8">
                          <div class="lines-1 shine"></div>
                        </div>
                      </div>
                      <div class="create-profile-title mb-4">
                        <div class="line-text">
                          <div class="lines shine"></div>
                        </div>
                      </div>
                      <div class="match-list-short-list3 my-3">
                        <div class="line-text">
                          <div class="lines-2 shine"></div>
                          <div class="lines-1 shine"></div>
                          <div class="lines-2 shine"></div>
                          <div class="lines-3 shine"></div>
                          <div class="lines-2 shine"></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 col-12 border-start">
                      <div class="connect-buttons-inbox text-center">
                        <div class="lines-2 shine mb-3"></div>
                        <div class="conncet-button-head">
                          <div class="conncet-now">
                            <span class="">
                              <div class="shine-icon shine"></div>
                            </span>
                            <span class="mb-2">
                              <div class="lines-1 shine"></div>
                            </span>
                          </div>
                          <div class="conncet-now">
                            <span class="">
                              <div class="shine-icon shine"></div>
                            </span>
                            <span class="mb-2">
                              <div class="lines-1 shine"></div>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <div class="result-notfound">
            <div class="d-grid gap-2 d-md-block">
              <pagination
                align="center"
                size="default"
                :data="senRequestList"
                @pagination-change-page="getSentRequestList"
              ></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>
<script>
import MemberAccountHeader from "../../member-account/MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import pagination from "laravel-vue-pagination";

export default {
  components: {
    MemberAccountHeader,
    Footer,
    pagination,
  },
  data() {
    return {
      senRequestList: {},
      memberID: null,
      resultNotFount: null,
    };
  },
  mounted() {
    this.memberID = localStorage.getItem("memberToken");
    this.getSentRequestList();
  },
  methods: {
    getSentRequestList(page = 1) {
      axios
        .get("api/sent-invitations/" + this.memberID+"?page="+page)
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.senRequestList = response.data;
          } else {
            this.resultNotFount = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    cancelRequest(index, memberId) {
      axios
        .get("api/cancel-invitation/" + this.memberID + "/" + memberId)
        .then((response) => {
          console.log(response.data);
          if (response.data == true) {
            this.senRequestList.data.splice(index, 1);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>