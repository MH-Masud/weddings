<template>
  <div>
    <Header />
    <!-- End Header -->
    <div class="container subheader-top">
      <div class="row">
        <div class="col-md-10 offset-md-1">
          <div class="row">
            <div class="col-md-8">
              <div class="cart-pages mb-3">
                <h5>Select Your Payment Method</h5>
                <div
                  class="
                    d-flex
                    align-items-start
                    shadow-sm
                    bg-body
                    rounded
                    cart-display
                  "
                >
                  <div
                    class="nav flex-column nav-pills me-3 cart-left-part"
                    id="v-pills-tab"
                    role="tablist"
                    aria-orientation="vertical"
                  >
                    <button
                      class="nav-link active width bg-light"
                      id="v-pills-home-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#v-pills-home"
                      type="button"
                      role="tab"
                      aria-controls="v-pills-home"
                      aria-selected="true"
                    >
                      <img
                        src="/assets/frontend/img/bkash.png"
                        class="img-fluid"
                        alt=""
                        width="70"
                        height="30"
                      />
                    </button>
                    <!-- <button
                      class="nav-link"
                      id="v-pills-profile-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#v-pills-profile"
                      type="button"
                      role="tab"
                      aria-controls="v-pills-profile"
                      aria-selected="false"
                    >
                      <img
                        src="/assets/frontend/img/credit-card.png"
                        class="img-fluid"
                        alt=""
                        width="24"
                        height="24"
                      />
                      Debit Card
                    </button>
                    <button
                      class="nav-link"
                      id="v-pills-messages-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#v-pills-messages"
                      type="button"
                      role="tab"
                      aria-controls="v-pills-messages"
                      aria-selected="false"
                    >
                      <img
                        src="/assets/frontend/img/bkash.png"
                        class="img-fluid"
                        alt=""
                        width="70"
                        height="30"
                      />
                    </button>
                    <button
                      class="nav-link"
                      id="v-pills-settings-tab"
                      data-bs-toggle="pill"
                      data-bs-target="#v-pills-settings"
                      type="button"
                      role="tab"
                      aria-controls="v-pills-settings"
                      aria-selected="false"
                    >
                      <img
                        src="/assets/frontend/img/rocket.png"
                        class="img-fluid"
                        alt=""
                        width="70"
                        height="35"
                      />
                    </button> -->
                  </div>

                  <div class="tab-content p-3" id="v-pills-tabContent">
                    <div
                      class="tab-pane fade show active"
                      id="v-pills-home"
                      role="tabpanel"
                      aria-labelledby="v-pills-home-tab"
                    >
                      <div class="credits">
                        <div class="row">
                            You have to pay through our marchent bKash account: 
                            +880-1711353034.
                            <br>
                            And then send us the transaction id. We will update your plan.
                          <!-- <div class="col">
                            <label>Pay using bKash</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Card Number"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div> -->
                        </div>
                        <!-- <div class="row mb-3">
                          <div class="col">
                            <label>Valid upto</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Valid upto"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>

                          <div class="col">
                            <label>CVV</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="CVV"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                            <label
                              ><em class="font-10"
                                >Usually found on the back of your card
                              </em></label
                            >
                          </div>
                        </div>
                        <div class="d-grid gap-2">
                          <button
                            class="btn btn-blue2 bg-gradient"
                            type="submit"
                          >
                            Pay Now
                          </button>
                        </div> -->
                      </div>
                    </div>
                    <!-- <div
                      class="tab-pane fade"
                      id="v-pills-profile"
                      role="tabpanel"
                      aria-labelledby="v-pills-profile-tab"
                    >
                      <div class="credits">
                        <div class="row">
                          <div class="col">
                            <label>Pay using Credit/Debit Card</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Card Number"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <label>Valid upto</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Valid upto"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                          <div class="col">
                            <label>CVV</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="CVV"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                            <label
                              ><em class="font-10"
                                >Usually found on the back of your card
                              </em></label
                            >
                          </div>
                        </div>
                        <div class="d-grid gap-2">
                          <button
                            class="btn btn-blue2 bg-gradient"
                            type="submit"
                          >
                            Pay Now
                          </button>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="v-pills-messages"
                      role="tabpanel"
                      aria-labelledby="v-pills-messages-tab"
                    >
                      <div class="credits">
                        <div class="row">
                          <div class="col">
                            <label>Your Bkash Accouont Number</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder=""
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <label>Valid upto</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Valid upto"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                          <div class="col">
                            <label>CVV</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="CVV"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                            <label
                              ><em class="font-10"
                                >Usually found on the back of your card
                              </em></label
                            >
                          </div>
                        </div>
                        <div class="d-grid gap-2">
                          <button
                            class="btn btn-blue2 bg-gradient"
                            type="submit"
                          >
                            Pay Now
                          </button>
                        </div>
                      </div>
                    </div>
                    <div
                      class="tab-pane fade"
                      id="v-pills-settings"
                      role="tabpanel"
                      aria-labelledby="v-pills-settings-tab"
                    >
                      <div class="credits">
                        <div class="row">
                          <div class="col">
                            <label>Pay using Credit/Debit Card</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Card Number"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <label>Valid upto</label>
                            <div class="input-group mb-3">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="Valid upto"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                          </div>
                          <div class="col">
                            <label>CVV</label>
                            <div class="input-group">
                              <span class="input-group-text" id="basic-addon1"
                                ><img
                                  src="/assets/frontend/img/credit-card.png"
                                  class="img-fluid"
                                  alt=""
                                  width="16"
                                  height="16"
                              /></span>
                              <input
                                type="text"
                                class="form-control"
                                placeholder="CVV"
                                aria-label="Username"
                                aria-describedby="basic-addon1"
                              />
                            </div>
                            <label
                              ><em class="font-10"
                                >Usually found on the back of your card
                              </em></label
                            >
                          </div>
                        </div>
                        <div class="d-grid gap-2">
                          <button
                            class="btn btn-blue2 bg-gradient"
                            type="submit"
                          >
                            Pay Now
                          </button>
                        </div>
                      </div>
                    </div> -->
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <h5>Order Summary</h5>
              <div class="shadow-sm p-3 bg-body rounded">
                <p>PREMIUM ACCOUNT - 1 Year</p>
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between">
                    <b>Plan Price</b><span><b>BDT ৳ 600</b></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between">
                    <b>Total Amount</b
                    ><span
                      ><h5><b>BDT ৳ 600</b></h5></span
                    >
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-10 offset-md-1 mt-3">
          <div class="any-ques shadow-sm bg-body rounded p-3 text-center">
            <h6>Have any queries or need help in making payment?</h6>
            <a v-for="phone in phones" :key="phone" :href="'tel:'+phone">{{ phone }},</a>
          </div>
        </div>
      </div>
    </div>
    <!-- Main Div -->
    <Footer />
  </div>
</template>
<script>
import Header from "../home/HomeHeaderComponent.vue";
import Footer from "../footer/FooterComponent.vue";
export default {
  components: {
    Header,
    Footer,
  },
  data() {
      return {
          phones:null,
      }
  },
  mounted() {
      this.phones = this.$store.state.companyPhone;
  },
};
</script>