<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10" v-if="declineList.data">
            <h5>Accepted Invitations</h5>
            <div class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
            v-for="(decline, row) in declineList.data"
              :key="decline.memberId"
            >
              <div class="row">
                <div class="col-md-3">
                  <div class="match-list-image-inbox p-3 mb-2">
                    <a href="my-profile.php"
                      ><img :src="decline.images[0]"
                    /></a>
                  </div>
                </div>
                <div class="col-md-9 p-3 mv-list-matches-chat2">
                  <div class="d-flex">
                    <div class="me-2">
                      <a href="my-profile.php">
                        <h5>{{ decline.name }}</h5>
                      </a>
                    </div>
                    <img
                      src="/assets/frontend/img/verified.png"
                      width="16"
                      height="16"
                    />
                    <div class="ms-auto me-2 h8">{{ decline.created_at }}</div>
                  </div>
                  <a href="">
                    <div class="mv-list-matches2">
                      <table class="table table-borderless">
                        <tbody>
                          <tr class="w-50 tables-ages">
                            <td>{{ decline.age }} yrs, {{ decline.height }}"</td>
                            <td>{{ decline.marital_status }}</td>
                            <td>{{ decline.religion }}, {{ decline.caste }}</td>
                            <td>{{ decline.profession_name }}</td>
                            <td>{{ decline.mother_language }}</td>
                            <td>{{ decline.country_living_in }}, {{ decline.city_living_in }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </a>
                  <P class="mt-2 mv-details"
                    >{{ decline.introduction }}
                  </P>
                  <div class="contact-profiles my-2 my-sm-4">
                    <div class="alert alert-danger" role="alert">
                      This member Declined your Invitation.
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
              <h5 class="mt-3">There are no Decline Invitations</h5>
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
                :data="declineList"
                @pagination-change-page="getDeclineList"
              ></pagination>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
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
    pagination,
    Footer,
  },
  data() {
    return {
      declineList: {},
      memberID: null,
      resultNotFount: null,
    };
  },
  mounted() {
    this.memberID = localStorage.getItem("memberToken");
    this.getDeclineList();
  },
  methods: {
    getDeclineList(page = 1) {
      axios
        .get("api/declined-invitations/" + this.memberID+"?page="+page)
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.declineList = response.data;
          } else {
            this.resultNotFount = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>