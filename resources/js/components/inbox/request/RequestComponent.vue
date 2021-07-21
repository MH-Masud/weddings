<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <div class="row">
          <!-- <div class="col-md-2">
            <div class="refine-search mb-3">
              <h5>Filters</h5>
              <div class="bg-body p-2">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="filters1"
                  />
                  <label class="form-check-label" for="filters1"> All </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="filters2"
                    checked
                  />
                  <label class="form-check-label" for="filters2">
                    Photo Requests
                  </label>
                </div>
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    value=""
                    id="filters3"
                    checked
                  />
                  <label class="form-check-label" for="filters3">
                    Phone Requests
                  </label>
                </div>
              </div>
            </div>
          </div> -->
          <div class="col-md-10">
            <h5>Pending Invitations</h5>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
              <li class="nav-item bg-body" role="presentation">
                <button
                  class="nav-link active rounded-0"
                  id="pills-home-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-home"
                  type="button"
                  role="tab"
                  aria-controls="pills-home"
                  aria-selected="true"
                >
                  Pending Requests
                </button>
              </li>
              <li class="nav-item bg-body" role="presentation">
                <button
                  class="nav-link border-start rounded-0"
                  id="pills-profile-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-profile"
                  type="button"
                  role="tab"
                  aria-controls="pills-profile"
                  aria-selected="false"
                  @click="getAcceptedList"
                >
                  Accepted Requests
                </button>
              </li>

              <li class="nav-item bg-body" role="presentation">
                <button
                  class="nav-link border-start rounded-0"
                  id="pills-requests-tab"
                  data-bs-toggle="pill"
                  data-bs-target="#pills-requests"
                  type="button"
                  role="tab"
                  aria-controls="pills-requests"
                  aria-selected="false"
                  @click="getSentRequestList"
                >
                  Sent Requests
                </button>
              </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
              <!-- Pending Request List Start-->
              <div
                class="tab-pane fade show active"
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab"
              >
                <div v-if="pendingRequestList.data" >
                    <div
                    class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
                    v-for="(pendigList, p) in pendingRequestList.data" :key="p.memberId"
                    >
                    <div class="row">
                        <div class="col-md-3">
                        <div class="match-list-image-inbox p-3 mb-2">
                            <a href="my-profile.php"
                            ><img :src="pendigList.images[0]"
                            /></a>
                        </div>
                        </div>
                        <div class="col-md-9 p-3 mv-list-matches-chat2">
                        <div class="row">
                            <div class="col-md-8">
                            <div class="d-flex">
                                <div class="me-2">
                                <a href="my-profile.php">
                                    <h5>{{ pendigList.name }}</h5>
                                </a>
                                </div>
                                <img
                                src="/assets/frontend/img/verified.png"
                                width="16"
                                height="16"
                                />
                                <div class="ms-auto me-2 h8">{{ pendigList.created_at }}</div>
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
                                />{{ pendigList.age }} yrs, {{ pendigList.height }}"</span
                                >
                                <span class="profile-list-images">
                                <img
                                    src="/assets/frontend/img/circle.png"
                                    width="12"
                                    height="12"
                                />{{ pendigList.marital_status }}</span
                                >
                                <span class="profile-list-images">
                                <img
                                    src="/assets/frontend/img/circle.png"
                                    width="12"
                                    height="12"
                                />{{ pendigList.mother_language }}</span
                                >
                                <span class="profile-list-images">
                                <img
                                    src="/assets/frontend/img/circle.png"
                                    width="12"
                                    height="12"
                                />{{ pendigList.country_living_in }}, {{ pendigList.state_living_in }}</span
                                >
                                <span class="profile-list-images">
                                <img
                                    src="/assets/frontend/img/circle.png"
                                    width="12"
                                    height="12"
                                />{{ pendigList.religion }}, {{ pendigList.caste }}</span
                                >
                            </div>
                            </div>
                            <div class="col-md-4 col-12 border-start">
                            <div class="connect-buttons-inbox text-center">
                                <div class="conncet-button-head">
                                <a href="#">
                                    <div class="conncet-now mt-5" v-if="pendigList.request_type == 'photo'">
                                    <img
                                        src="/assets/frontend/img/photo-camera(1).png"
                                        width="40"
                                        height="40"
                                    />
                                    <span class="mb-2">Add Photo</span>
                                    </div>
                                    <div class="conncet-now mt-5" v-else>
                                    <img
                                        src="/assets/frontend/img/call.png"
                                        width="40"
                                        height="40"
                                    />
                                    <span class="mb-2">Verify Phone</span>
                                    </div>
                                </a>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- PAGINATION -->
                    <div class="col-md-12">
                        <div class="result-notfound">
                            <div class="d-grid gap-2 d-md-block">
                            <pagination
                                align="center"
                                size="default"
                                :data="pendingRequestList"
                                @pagination-change-page="getPendingRequestList"
                            ></pagination>
                            </div>
                        </div>
                    </div>
                    <!-- PAGINATION -->
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
                    <h5 class="mt-3">There are no Pending Request</h5>
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
              
              <!-- Pending Request List End-->
              <!-- Accept Request List Start -->
              <div
                class="tab-pane fade"
                id="pills-profile"
                role="tabpanel"
                aria-labelledby="pills-profile-tab"
              >
                <div v-if="acceptedRequestList.data">
                    <div
                    class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
                    v-for="(accepted,acc) in acceptedRequestList.data" :key="acc.memberId"
                    >
                    <div class="row">
                        <div class="col-md-3">
                        <div class="match-list-image-inbox p-3 mb-2">
                            <a href="my-profile.php"
                            ><img :src="accepted.images[0]"
                            /></a>
                        </div>
                        </div>
                        <div class="col-md-9 p-3 mv-list-matches-chat2">
                        <div class="d-flex">
                            <div class="me-2">
                            <a href="my-profile.php">
                                <h5>{{  accepted.name }}</h5>
                            </a>
                            </div>
                            <img
                            src="/assets/frontend/img/verified.png"
                            width="16"
                            height="16"
                            />
                            <div class="ms-auto me-2 h8">{{ accepted.created_at }}</div>
                        </div>
                        <a href="">
                            <div class="mv-list-matches2">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="w-50 tables-ages">
                                    <td>{{ accepted.age }} yrs, {{ accepted.height }}"</td>
                                    <td>{{ accepted.marital_status }}</td>
                                    <td>{{ accepted.religion }}, {{ accepted.caste }}</td>
                                    <td>{{ accepted.profession_name }}</td>
                                    <td>{{ accepted.mother_language }}</td>
                                    <td>{{ accepted.country_living_in }}, {{ accepted.state_living_in }}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </a>
                        <div class="alert alert-primary" role="alert">
                            You accepted her {{ accepted.request_type == 'photo'? accepted.request_type : 'verify phone number' }} Request on {{ accepted.created_at }}
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- PAGINATION -->
                    <div class="col-md-12">
                        <div class="result-notfound">
                            <div class="d-grid gap-2 d-md-block">
                            <pagination
                                align="center"
                                size="default"
                                :data="acceptedRequestList"
                                @pagination-change-page="getAcceptedList"
                            ></pagination>
                            </div>
                        </div>
                    </div>
                    <!-- PAGINATION -->
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
                    <h5 class="mt-3">There are no Accepted Request</h5>
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
              <!-- Accept Request List end -->
              <!-- Send Request List Start -->
              <div
                class="tab-pane fade"
                id="pills-requests"
                role="tabpanel"
                aria-labelledby="pills-requests-tab"
              >
                <div v-if="sentRequestList.data">
                    <div
                    class="match-lists shadow-sm mb-2 bg-body rounded p-3 p-md-0"
                    v-for="(sentRequest,sent) in sentRequestList.data" :key="sent.memberId"
                    >
                    <div class="row">
                        <div class="col-md-3">
                        <div class="match-list-image-inbox p-3 mb-2">
                            <a href="my-profile.php"
                            ><img :src="sentRequest.images[0]"
                            /></a>
                        </div>
                        </div>
                        <div class="col-md-9 p-3 mv-list-matches-chat2">
                        <div class="d-flex">
                            <div class="me-2">
                            <a href="my-profile.php">
                                <h5>{{ sentRequest.name }}</h5>
                            </a>
                            </div>
                            <img
                            src="/assets/frontend/img/verified.png"
                            width="16"
                            height="16"
                            />
                            <div class="ms-auto me-2 h8">{{ sentRequest.created_at }}</div>
                        </div>
                        <a href="">
                            <div class="mv-list-matches2">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="w-50 tables-ages">
                                    <td>{{ sentRequest.age }} yrs, {{ sentRequest.height }}"</td>
                                    <td>{{ sentRequest.marital_status }}</td>
                                    <td>{{ sentRequest.religion }}, {{ sentRequest.caste }}</td>
                                    <td>{{ sentRequest.profession_name }}</td>
                                    <td>{{ sentRequest.mother_language }}</td>
                                    <td>{{ sentRequest.country_living_in }}, {{ sentRequest.state_living_in }}</td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </a>
                        <div class="alert alert-primary" role="alert">
                            You requested her to {{ sentRequest.request_type == 'photo' ? sentRequest.request_type : 'verify Phone No.' }} on {{ sentRequest.created_at }}
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- PAGINATION -->
                    <div class="col-md-12">
                        <div class="result-notfound">
                            <div class="d-grid gap-2 d-md-block">
                            <pagination
                                align="center"
                                size="default"
                                :data="sentRequestList"
                                @pagination-change-page="getSentRequestList"
                            ></pagination>
                            </div>
                        </div>
                    </div>
                    <!-- PAGINATION -->
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
                    <h5 class="mt-3">There are no Sent Request</h5>
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
              <!-- Send Request List end -->
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
      pendingRequestList: {},
      acceptedRequestList: {},
      sentRequestList: {},
      memberID: null,
      resultNotFount: false,
    };
  },
  mounted() {
    this.memberID = localStorage.getItem("memberToken");
    this.getPendingRequestList();
  },
  methods: {
    getPendingRequestList(page = 1) {
      axios
        .get("api/pending-request/" + this.memberID + "?page=" + page)
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.pendingRequestList = response.data;
          } else {
            this.resultNotFount = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getAcceptedList(page = 1){
        axios
        .get("api/accepted-request/" + this.memberID+"?page="+page)
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.acceptedRequestList = response.data;
          } else {
            this.resultNotFount = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getSentRequestList(page = 1){
        axios
        .get("api/sent-request/" + this.memberID+"?page="+page)
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.sentRequestList = response.data;
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