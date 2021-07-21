<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="row">
              <div class="col-md-3 mb-3">
                <div class="list-group">
                  <a
                    href="javascript:void(0)"
                    class="
                      list-group-item
                      list-group-item-action
                      list-group-item-light
                    "
                    >Settings</a
                  >
                  <router-link
                    to="/my-account/account-settings"
                    class="
                      list-group-item
                      list-group-item-action
                      list-group-item-light
                      active
                    "
                    >Account Settings</router-link
                  >
                  <router-link
                    to="/settings/privacy-options"
                    class="
                      list-group-item
                      list-group-item-action
                      list-group-item-light
                    "
                    >Privacy Options</router-link
                  >
                  <router-link
                    to="/settings/hide-delete-profile"
                    class="
                      list-group-item
                      list-group-item-action
                      list-group-item-light
                    "
                    >Hide / Delete Profile</router-link
                  >
                </div>
              </div>
              <div class="col-md-9">
                <h5>My Account</h5>
                <div class="bg-body p-3 rounded">
                  <div class="my-account-edit py-2 border-bottom">
                    <div class="row" v-if="!showEditEmail">
                      <div class="col-md-3 text-black-50">Email</div>
                      <div class="col-md-5">: {{ email }}</div>
                      <div class="col-md-3">
                        <div class="profile-edit auto float-end">
                          <a
                            href="javascript:void(0)"
                            @click="editEmailEvent(true)"
                            >Edit</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="edit-form" id="edit" v-if="showEditEmail">
                      <div class="row bg-body py-2 border-bottom">
                        <div class="col-md-3 text-black-50">New Email</div>
                        <div class="col-md-5">
                          <input
                            class="form-control form-control-sm"
                            type="email"
                            placeholder="Enter email"
                            v-model="new_email"
                          />
                          <br>
                        <strong v-if="emailError" class="text-danger">{{ emailError }}</strong>
                        </div>
                        <div class="col-md-3">
                          <div class="profile-edit auto float-end bg-body">
                            <button
                              type="submit"
                              class="btn btn-success btn-sm"
                              @click="changeEamil"
                            >
                              Save
                            </button>
                            <button
                              type="button"
                              class="btn btn-outline-secondary btn-sm cancel"
                              @click="editEmailEvent(false)"
                            >
                              Cancel
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="my-account-edit py-2">
                    <div class="row" v-if="!showEditPassword">
                      <div class="col-md-3 text-black-50">Password</div>
                      <div class="col-md-5">: ******************</div>
                      <div class="col-md-3">
                        <div class="profile-edit auto float-end">
                          <a
                            href="javascript:void(0)"
                            @click="editPasswordEvent(true)"
                            >Edit</a
                          >
                        </div>
                      </div>
                    </div>
                    <div class="edit-form" id="edit" v-if="showEditPassword">
                      <div class="row bg-body py-2 border-bottom">
                        <div class="row g-3">
                            <div class="col-auto">
                                <label for="old_password">Old Password</label>
                                <input v-model="old_password" type="password" placeholder="Old password" class="form-control" id="old_password">
                            </div>
                            <div class="col-auto">
                                <label for="new_password">New Password</label>
                                <input v-model="new_password" type="password" class="form-control" id="new_password" placeholder="New password">
                            </div>
                            <div class="col-auto">
                                <br>
                                <button
                                type="submit"
                                class="btn btn-success btn-sm"
                                @click="changePassword"
                                >
                                Save
                                </button>
                                <button
                                type="button"
                                class="btn btn-outline-secondary btn-sm cancel"
                                @click="editPasswordEvent(false)"
                                >
                                Cancel
                                </button>
                            </div>
                        </div>
                        <br><br><br><br><br>
                        <strong class="text-danger" v-if="passwordMatchError">{{ passwordMatchError }}</strong>
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
    <Footer></Footer>
  </div>
</template>

<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import "../../../axios/index";

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data() {
    return {
      memberDetail: null,
      memberID: null,
      showEditEmail: false,
      showEditPassword: false,
      email: null,
      new_email : null,
      old_password: null,
      new_password: null,
      passwordMatchError: null,
      emailError: null,
    };
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
      this.memberDetail = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberID = this.memberDetail.member_profile_id
      this.email = this.memberDetail.email
    }
  },
  methods: {
    editEmailEvent(emailEvent) {
      this.showEditEmail = emailEvent;
    },
    editPasswordEvent(passwordEvent) {
      this.showEditPassword = passwordEvent;
    },
    changePassword(){
        if (this.old_password == this.new_password) {
            axios
            .post("api/change-password/"+this.memberID,{
                'password': this.new_password,
            })
            .then((response) => {
                if (response.data == true) {
                    this.$router.push('/my-account/password-success');
                } else {
                    this.$router.push('/my-account/password-fail');
                }
            })
            .catch((error) => {
                console.log(error);
            });
        } else {
            this.showEditPassword = true;
            this.passwordMatchError = "Old And New Password Did Not Match!"
        }
    },
    changeEamil(){
        if (!this.new_email) {
            this.emailError = 'Email required.';
        } else if (!this.validEmail(this.new_email)) {
            this.emailError = 'Valid email required.';
        } else{
            axios
            .post("api/change-email/"+this.memberID,{
                'email': this.new_email,
            })
            .then((response) => {
                if (response.data == true) {
                    this.memberDetail.email = this.new_email
                    localStorage.setItem('hmWLoggedIn',JSON.stringify(this.memberDetail));
                    this.$router.push('/my-account/email-success');
                } else {
                    this.$router.push('/my-account/email-fail');
                }
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },
    validEmail: function (email) {
      var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
  },
};
</script>