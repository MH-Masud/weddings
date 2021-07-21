<template>
  <div>
    <Header></Header>
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-12">
            <h5>Recently Viewed Members (251)</h5>
            <carousel
                :items="5"
                :margin="20"
                :loop="true"
                :nav="false"
                :autoplay="true"
                :dots="false"
                :autoplayTimeout="3000"
                :responsive="{
                  0: { items: 2 },
                  600: { items: 3 },
                  1000: { items: 4 },
                }"
              >
                <div class="item">
                  <div class="recent-list shadow-sm mb-3 bg-body rounded">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="recentview-image">
                          <a href="#"
                            ><img src="/assets/frontend/img/member-4.png"
                          /></a>
                        </div>
                        <div class="p-3">
                          <a href="viewprofile.php">
                            <h5>Supanaz Mazumdar</h5>
                          </a>
                          <div class="fs-6">
                            <a href="#" class="chat online-chat"
                              >&#x2609; Online 6h ago</a
                            >
                          </div>
                          <div class="connect-lists">
                            <span>30 yrs, 5' 2"</span><span>Never Married</span
                            ><span>Muslim, Sunni</span><span>Dhaka, Dhaka</span
                            ><span>Bengali</span><span>Teacher</span>
                          </div>
                          <hr />
                          <div class="contact-profiles text-center mt-2">
                            <a
                              href="#"
                              data-bs-toggle="modal"
                              data-bs-target="#connect-now"
                              ><span class="contact-profiles2"
                                >Connect Now</span
                              ></a
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </carousel>
            <a
              href="#"
              type="button"
              class="btn btn-blue2 bg-gradient btn-sm float-end"
              >See more</a
            >

            <!-- Connect now modal -->
            <div
              class="modal fade"
              id="connect-now"
              tabindex="-1"
              aria-labelledby="connect-nows"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header blue text-light p-2">
                    <h5 class="modal-title" id="connect-nows">
                      Write to Koly Anwar
                    </h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                    ></button>
                  </div>
                  <div class="modal-body premium-icon-22s">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="match-list-image-premium">
                          <img src="/assets/frontend/img/member-4.png" />
                        </div>
                      </div>
                      <div class="col-md-9">
                        <label
                          for="exampleFormControlTextarea1"
                          class="form-label"
                          >Add a message</label
                        >
                        <textarea
                          class="form-control"
                          id="exampleFormControlTextarea1"
                          rows="4"
                        >
Hello, I liked your profile as well. It would be good to communicate and get to know each other better. Please feel free to contact me to take this conversation ahead. Warm Regards,</textarea
                        >
                        <button
                          type="button"
                          class="btn btn-blue2 bg-gradient mt-3"
                        >
                          Connect
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end connect now -->
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>

<script>
import Header from "../member-account/MemberAccountHeaderComponent.vue";
import Footer from "../footer/FooterComponent.vue";
import carousel from "vue-owl-carousel";

export default {
  components: {
    Header,
    Footer,
    carousel,
  },
};
</script>