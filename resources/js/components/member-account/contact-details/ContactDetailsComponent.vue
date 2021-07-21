<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10 offset-md-2">
            <div class="row">
              <div class="col-md-10">
                <div class="bg-body p-3 mb-2 rounded">
                  <div class="d-flex border-bottom">
                    <div class="text-black-50">
                      <h5>
                        Contact Number
                        <span class="text-danger">
                          (Note: To updat your number you need to verify
                          it.)</span
                        >
                      </h5>
                    </div>
                    <div class="ms-auto">
                      <div class="profile-edit float-end">
                        <a href="javascript:void(0)" @click="updatePhoneNumber">Update</a>
                      </div>
                    </div>
                  </div>
                  <div class="row p-2">
                    <label for="inputPassword" class="col-sm-3 col-form-label"
                      >Mobile</label
                    >
                    <div class="col-sm-9">
                      <div class="row">
                        <div class="col-md-6">
                          <select
                            v-model="country_code"
                            id="country_code"
                            class="form-control form-control-sm"
                          >
                            <option
                              v-for="country in countries"
                              :key="country.id"
                              :value="country.phonecode"
                            >
                              {{
                                country.name + " (+" + country.phonecode + ")"
                              }}
                            </option>
                          </select>
                        </div>
                        <div class="col-md-6">
                          <input
                            class="form-control form-control-sm"
                            type="text"
                            aria-label=".form-control-sm example"
                            v-model="mobile_number"
                          />
                        </div>
                        <br><br>
                        <strong v-if="mobileChange" class="text-info">{{ mobileChange }}</strong>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="bg-body p-3 mb-2 rounded">
                  <div class="d-flex border-bottom">
                    <div class="text-black-50">
                      <h5>Contact details and display status</h5>
                    </div>
                    <!-- <div class="ms-auto">
                      <div class="profile-edit float-end">
                        <a @click="contactDetails" href="javascript:void(0)">Update</a>
                      </div>
                    </div> -->
                  </div>
                  <div class="row p-2">
                    <label for="inputPassword" class="col-sm-3 col-form-label"
                      >Name of contact person
                    </label>
                    <div class="col-sm-6">
                      <input
                        class="form-control form-control-sm"
                        type="text"
                        placeholder=""
                        aria-label=".form-control-sm example"
                        v-model="contact_name"
                      />
                    </div>
                  </div>
                  <div class="mb-2 row">
                    <label for="" class="col-sm-3 col-form-label"
                      >Relationship with the member</label
                    >
                    <div class="col-sm-6">
                      <select
                        class="form-select form-select-sm"
                        aria-label="Default select example"
                        v-model="relation"
                      >
                        <option value="" label="Select">Select</option>
                        <option value="Self" label="Self">Self</option>
                        <option value="Parent" label="Parent">Parent</option>
                        <option value="Guardian" label="Guardian">
                          Guardian
                        </option>
                        <option value="Sibling" label="Sibling">Sibling</option>
                        <option value="Friend" label="Friend">Friend</option>
                        <option value="Relative" label="Relative">
                          Relative
                        </option>
                        <option value="Other" label="Other">Other</option>
                      </select>
                    </div>
                  </div>
                  <div class="mb-2 row">
                    <label
                      for="staticEmail"
                      class="col-sm-3 col-12 col-form-label"
                      >Convenient time to call</label
                    >
                    <div class="col-sm-2 col-6 mb-1">
                      <select
                        class="form-select form-select-sm"
                        aria-label="Default select example"
                        v-model="time_from"
                      >
                        <option value="">From</option>
                        <option value="1.00">1.00</option>
                        <option value="2.00">2:00</option>
                        <option value="3.00">3:00</option>
                        <option value="4.00">4:00</option>
                        <option value="5.00">5:00</option>
                        <option value="6.00">6:00</option>
                        <option value="7.00">7:00</option>
                        <option value="8.00">8:00</option>
                        <option value="9.00">9:00</option>
                        <option value="10.00">10:00</option>
                        <option value="11.00">11:00</option>
                        <option value="12.00">12:00</option>
                      </select>
                    </div>
                    <div class="col-sm-2 col-6 mb-1">
                      <select
                        class="form-select form-select-sm"
                        aria-label="Default select example"
                        v-model="from_hour"
                      >
                        <option value="">Doesn't matter</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                      </select>
                    </div>
                    <div class="col-sm-2 col-6 mb-1">
                      <select
                        class="form-select form-select-sm"
                        aria-label="Default select example"
                        v-model="time_to"
                      >
                        <option value="">To</option>
                        <option value="1.00">1.00</option>
                        <option value="2.00">2:00</option>
                        <option value="3.00">3:00</option>
                        <option value="4.00">4:00</option>
                        <option value="5.00">5:00</option>
                        <option value="6.00">6:00</option>
                        <option value="7.00">7:00</option>
                        <option value="8.00">8:00</option>
                        <option value="9.00">9:00</option>
                        <option value="10.00">10:00</option>
                        <option value="11.00">11:00</option>
                        <option value="12.00">12:00</option>
                      </select>
                    </div>
                    <div class="col-sm-2 col-6 mb-1">
                      <select
                        class="form-select form-select-sm"
                        aria-label="Default select example"
                        v-model="to_hour"
                      >
                        <option value="">Doesn't matter</option>
                        <option value="AM">AM</option>
                        <option value="PM">PM</option>
                      </select>
                    </div>
                  </div>
                  <div class="mb-2 row edit-profile-imput">
                    <label for="staticEmail" class="col-sm-3 col-form-label"
                      >Contact display setting
                    </label>
                    <div class="col-sm-8 mt-2">
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions2"
                          id="inlineRadio1"
                          value="Visible to all Premium Members"
                          v-model="display_setting"
                        />
                        <label class="form-check-label" for="inlineRadio1"
                          >Visible to all Premium Members
                        </label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions2"
                          id="inlineRadio2"
                          value="Visible to Premium Members you wish to connect
                          to"
                          v-model="display_setting"
                        />
                        <label class="form-check-label" for="inlineRadio2"
                          >Visible to Premium Members you wish to connect
                          to</label
                        >
                      </div>
                      <div class="form-check form-check-inline">
                        <input
                          class="form-check-input"
                          type="radio"
                          name="inlineRadioOptions2"
                          id="inlineRadio3"
                          value="Hide my Phone number"
                        />
                        <label class="form-check-label" for="inlineRadio2"
                          >Hide my Phone number</label
                        >
                      </div>
                    </div>
                  </div>
                  <div class="mb-2 row">
                      <div class="float-end col-md-3">
                          <a @click="contactDetails" class="btn btn-blue2 bg-gradient" href="javascript:void(0)">Update</a>
                        </div>
                        <div class="col-md-8" v-if="contactDetailsChange">
                          <strong class="text-info text-center">{{ contactDetailsChange }}</strong>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import {mapState} from 'vuex'

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data() {
    return {
      memberID: null,
      country_code: null,
      mobile_number: null,
      contact_name: null,
      relation: '',
      time_from: '',
      from_hour: '',
      time_to: '',
      to_hour: '',
      display_setting: 'Visible to all Premium Members',
      mobileChange: null,
      contactDetailsChange: null,
    };
  },
  computed: {
    ...mapState([
        'countries',
    ])
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
      let memberDetails = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberID = memberDetails.member_profile_id;
    }
    this.getContactDetails();
    this.$store.dispatch('getCountry')
  },
  methods: {
    getContactDetails() {
      axios
        .get("api/contact-details/"+this.memberID)
        .then((response) => {
          this.country_code = response.data.country_code;
          this.mobile_number = response.data.mobile;
          this.contact_name = response.data.contact_details.contact_name;
          this.relation = response.data.contact_details.relation;
          this.time_from = response.data.contact_details.time_from;
          this.from_hour = response.data.contact_details.from_hour;
          this.time_to = response.data.contact_details.time_to;
          this.to_hour = response.data.contact_details.to_hour;
          this.display_setting = response.data.contact_details.display_setting;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    updatePhoneNumber(){
        axios
        .post("api/update-contact-number/"+this.memberID,{
            'country_code': this.country_code,
            'mobile_number': this.mobile_number,
        })
        .then((response) => {
          if (response.data == true) {
              this.mobileChange = 'Mobile Number is updated successfully';
              setTimeout(() => this.mobileChange = false, 2000);
          } else {
              this.mobileChange = 'Failed to update Mobile Number. Try again!';
              setTimeout(() => this.mobileChange = false, 2000);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    contactDetails(){
        const contact_detail = {
            'contact_name': this.contact_name,
            'relation': this.relation,
            'time_from': this.time_from,
            'from_hour': this.from_hour,
            'time_to': this.time_to,
            'to_hour': this.to_hour,
            'display_setting': this.display_setting,
        };
        axios
        .post("api/update-contact-details/"+this.memberID,{
            'contact_detail': contact_detail,
        })
        .then((response) => {
          if (response.data == true) {
              this.contactDetailsChange = 'Contact Details is updated successfully';
              setTimeout(() => this.contactDetailsChange = false, 2000);
          } else {
              this.contactDetailsChange = 'Failed to update Contact Details. Try again!';
              setTimeout(() => this.contactDetailsChange = false, 2000);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>