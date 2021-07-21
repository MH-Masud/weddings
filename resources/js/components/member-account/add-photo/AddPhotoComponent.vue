<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
      <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10 offset-md-2">
            <div class="row">
              <div class="col-md-10">
                <!-- Button trigger modal -->
                <div class="refine-search">
                  <div class="d-flex">
                    <div class="">
                      <h6>My Photos</h6>
                    </div>
                  </div>
                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="editprofileheading2">
                      <div
                        class="
                          accordion-button
                          btn-blue2
                          p-2
                          text-white
                          rounded-top
                        "
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#editprofile1"
                        aria-expanded="true"
                        aria-controls="editprofile1"
                      >
                        Photo Album
                      </div>
                    </h2>
                    <div
                      id="editprofile1"
                      class="accordion-collapse collapse show"
                      aria-labelledby="editprofileheading2"
                    >
                      <div class="accordion-body bg-white">
                        <div class="panels py-3">
                          <div class="text-center">
                            <h4>
                              Get more responses by uploading up to 20 photos on
                              your profile.
                            </h4>
                          </div>
                          <div class="d-flex justify-content-center mt-3">
                            <div>
                              <div class="border">
                                <div class="button-wrapper2">
                                  <p>Upload photos from your computer</p>
                                  <span class="label"> Browse Photo </span>
                                  <input
                                    type="file"
                                    name="upload"
                                    id="upload"
                                    class="upload-box"
                                    placeholder="Upload File"
                                    @change="getImage"
                                  />
                                </div>
                              </div>
                            </div>
                            <!-- <div class="p-3 align-middle">Or</div>
                            <div>
                              <div class="border">
                                <div class="button-wrapper2">
                                  <p>Add your best photos from Facebook</p>
                                  <span class="label label-blue">
                                    <img
                                      src="/assets/frontend/img/facebook.png"
                                      width="20"
                                      height="20"
                                    />
                                    Inport Photos
                                  </span>
                                  <input
                                    type="file"
                                    name="upload"
                                    id="upload"
                                    class="upload-box"
                                    placeholder="Upload File"
                                  />
                                </div>
                              </div>
                            </div> -->
                          </div>
                          <div v-if="imgeValidationError" class="h8 text-center text-danger">
                            {{ imgeValidationError }}
                          </div>
                          <div class="h8 text-center">
                            Note: You can upload 20 photos to your profile. Each
                            photos must be less than 10 MB and in jpg, jpeg, png,
                            format.
                          </div>
                          <hr />
                          <div v-if="galleryImages" class="row mt-3 p-3">
                            <h5>Your photos</h5>
                            <div class="col-md-3" v-for="(gallery,row) in galleryImages" :key="gallery.thumb">
                              <img :src="'/uploads/profile_image/'+gallery.thumb" width="100" height="100" /><br><br>
                              <div class="flex mb-2">
                                <button v-if="!gallery.avatar" @click="removeProfilePhoto(row)" class="btn btn-sm btn-danger" type="button">Remove</button>
                                <button v-if="!gallery.avatar" @click="makeProfilePhoto(row)" class="btn btn-sm btn-success" type="button">Profile Pic</button>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-3 p-3">
                            <h5>Other ways to upload your photos</h5>
                            <div class="col-md-6 border p-2">
                              <p>
                                E-mail your photos to
                                <a v-for="email in companyEmail" :key="email" :href="'mailto:'+email"
                                  >{{ email }}</a
                                >
                              </p>
                            </div>
                            <div class="col-md-6 border p-2">
                              <p class="">
                                Send your photos through post office to our
                                <router-link to="/contact-us">office</router-link>
                                Mention your Profile ID and Name at the back of
                                the photos.
                              </p>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-md-4">
                              <span class="right-icon mb-2"
                                ><img src="/assets/frontend/img/right-icon.jpg" />Photos
                                you should upload</span
                              >
                              <div class="close-img mt-2">
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic.jpg" />
                                  <div class="h8">Close Up</div>
                                </div>
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic-2.jpg" />
                                  <div class="h8">Full View</div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-8">
                              <span class="right-icon mb-2"
                                ><img src="/assets/frontend/img/right-icon-2.jpg" />Photos
                                you should not upload</span
                              >
                              <div class="close-img mt-2">
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic-3.jpg" />
                                  <div class="h8">Side Face</div>
                                </div>
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic-4.jpg" />
                                  <div class="h8">Blur</div>
                                </div>
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic-6.jpg" />
                                  <div class="h8">Group</div>
                                </div>
                                <div class="close-img-title text-center">
                                  <img src="/assets/frontend/img/chose-pic-5.jpg" />
                                  <div class="h8">Watermark</div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="editprofileheading3">
                      <div
                        class="
                          accordion-button
                          btn-blue2
                          p-2
                          text-white
                          rounded-top
                        "
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#editprofile2"
                        aria-expanded="true"
                        aria-controls="editprofile2"
                      >
                        Settings
                      </div>
                    </h2>
                    <div
                      id="editprofile2"
                      class="accordion-collapse collapse show"
                      aria-labelledby="editprofileheading3"
                    >
                      <div class="accordion-body bg-white">
                        <div class="panels py-3">
                          <div class="mb-2 edit-profile-imput row">
                            <label
                              for="staticEmail"
                              class="col-sm-3 col-form-label"
                              >Choose display option
                            </label>
                            <div class="col-sm-9 mt-2">
                              <div class="form-check form-check-inline">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="inlineRadioOptions"
                                  id="inlineRadio1"
                                  value="1"
                                  v-model="photoSettings"
                                />
                                <label
                                  class="form-check-label"
                                  for="inlineRadio1"
                                  >Visible to all Members</label
                                >
                              </div>
                              <div class="form-check form-check-inline">
                                <input
                                  class="form-check-input"
                                  type="radio"
                                  name="inlineRadioOptions"
                                  id="inlineRadio2"
                                  v-model="photoSettings"
                                  value="2"
                                />
                                <label
                                  class="form-check-label"
                                  for="inlineRadio2"
                                  >Visible to Members I like and to all Premium
                                  Members</label
                                >
                              </div>
                            </div>
                          </div>
                          <span v-if="photoSettingsMessage" class="text-center text-info">{{ photoSettingsMessage }}</span>
                          <div class="d-grid gap-2 d-md-block mt-3">
                            <button
                              class="btn btn-blue2 bg-gradient"
                              type="button"
                              @click="updatePhotoSettings"
                            >
                              Save my settings
                            </button>
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
      </div>
    </div>
    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>
<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import {mapState} from 'vuex'
import axios from 'axios';

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data() {
    return {
      memberID: null,
      galleryImages: null,
      imgeValidationError: null,
      photoSettings: '1',
      photoSettingsMessage: null,
    }
  },
  computed:{
    ...mapState([
      'companyEmail'
    ])
  },
  mounted() {
    this.$store.dispatch('getCompanyInformation')
    if (localStorage.getItem('hmWLoggedIn')) {
        let memberInfo = JSON.parse(localStorage.getItem('hmWLoggedIn'));
        this.memberID = memberInfo.member_profile_id;
    }
    this.getPhoto();
  },
  methods: {
    getImage(e){
        let image = e.target.files[0];
        if(image.size > 10 * 1024 * 1024){
          this.imgeValidationError = "Image can't be more then 10 MB."
        }else{
          if (image.type == 'image/jpeg' || image.type == 'image/jpg' || image.type == 'image/png') {
              let reader = new FileReader();
              reader.readAsDataURL(image);
              reader.onload = () => {
                axios
                .post("api/upload-gallery-image/"+this.memberID,{
                    'image': reader.result
                })
                .then((response) => {
                    console.log(response.data)
                    if(response.data != false){
                      this.galleryImages = response.data
                    }
                })
                .catch((error) => {
                    console.log(error);
                });
              }
          } else {
              this.imgeValidationError = "Image must be JPG,JPEG,PNG formate."
          }
        }
    },
    getPhoto(){
      axios
        .get('api/member-galley/'+this.memberID)
        .then((response) => {
          console.log(response.data)
          if (response.data) {
            this.galleryImages = response.data[0]
            this.photoSettings = response.data[1]
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    removeProfilePhoto(index){
      axios
        .get('api/remove-photo/'+this.memberID+"/"+index)
        .then((response) => {
          console.log(response.data)
          if (response.data != false) {
            this.galleryImages = response.data
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    makeProfilePhoto(index){
      axios
        .get('api/make-profile-photo/'+this.memberID+"/"+index)
        .then((response) => {
          console.log(response.data)
          if (response.data != false) {
            this.galleryImages = response.data
            if (localStorage.getItem('hmWLoggedIn')) {
                let memberInfo = JSON.parse(localStorage.getItem('hmWLoggedIn'));
                memberInfo.image = '/uploads/profile_image/'+this.galleryImages[index].thumb;
                localStorage.setItem('hmWLoggedIn',JSON.stringify(memberInfo));
            }
          }
        })
        .catch((error) => {
          console.log(error)
        })
    },
    updatePhotoSettings(){
      axios
        .get('api/update-photo-settings/'+this.memberID+"/"+this.photoSettings)
        .then((response) => {
          if (response.data == true) {
            this.photoSettingsMessage = 'Photo settings is updated successfully!';
            setTimeout(() => this.photoSettingsMessage = false, 2000);
          } else {
            this.photoSettingsMessage = 'Faild to update.Try again!';
            setTimeout(() => this.photoSettingsMessage = false, 2000);
          }
        })
        .catch((errror) =>{
          console.log(errror)
        })
    }
  },
};
</script>