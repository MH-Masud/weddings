<template>
    <div>
      <!-- header -->
      <MemberAccountHeader></MemberAccountHeader>
      <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
            <div class="row">
               <div class="col-md-3">
                  <div class="shadow-sm  mb-2 p-2 bg-body rounded">
                     <div class="deshboard-icon text-center purple-color" >
                        <img :src="member.image">
                        <div class="deshboard-plus">
                           <div class="upload-btn-wrapper">
                              <button class="btn">+</button>
                              <input type="file" name="myfile" @change="getImage" />
                           </div>
                        </div>
                     </div>
                     <span v-if="imgeValidationError" class="text-danger text-center">{{ imgeValidationError }}</span>
                     <div class="deshboard-titile">
                        <div class="deshboard-name">
                           <span>
                              <h6 >{{ member.name }}</h6>
                           </span>
                           <span class="deshboard-name-id">{{ member.profileId }}</span>
                        </div>
                        <div class="deshboard-edit"><router-link to="/my-account/edit">Edit</router-link></div>
                     </div>
                     <div class="deshboard-titile">
                        <div class="deshboard-name">
                           <span>{{ member.packageName }}</span><span class="deshboard-name-id">Valid till {{ member.packageExpDate }}</span>
                        </div>
                        <div class="deshboard-edit"><img src="/assets/frontend/img/crown.png" width="20" height="20"></div>
                     </div>
                     <div class="deshboard-titile">
                        <div class="deshboard-name">
                           <span>Account Type</span>
                           <span class="deshboard-name-id" >{{ member.membershipType }}</span>
                        </div>
                        <div class="deshboard-edit"><router-link to="premium-plan">Upgrade</router-link></div>
                     </div>
                  </div>
               </div>
               <div class="col-md-9">
                  <div  class="row">
                     <div class="col-md-12">
                        <div class="row pending-invitations">
                           <div class="col-md-4">
                              <a href="#">
                                 <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                    <span class="deshboard--recent-title">{{ member.pending_invitation }}</span><br>
                                    <span>Pending Invitations</span>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-4">
                              <a href="#">
                                 <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                    <span class="deshboard--recent-title">{{ member.accepted_invitation }}</span><br>
                                    <span>Accepted Invitations</span>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-4">
                              <a href="#">
                                 <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                    <span class="deshboard--recent-title">{{ member.recent_visitor }}</span><br>
                                    <span>Recent Visitors</span>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-4">
                              <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                 <span>{{ member.shortlisted }}</span><br>
                                 <span>Shortlisted</span>
                              </div>
                           </div>
                           <div class="col-md-4">
                              <a href="#">
                                 <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                    <span class="deshboard--recent-title">{{ member.view_contact }}</span><br>
                                    <span>Contacts viewed</span>
                                 </div>
                              </a>
                           </div>
                           <div class="col-md-4">
                              <a href="#">
                                 <div class="sidebar-matches shadow-sm  mb-2 p-2 bg-body rounded">
                                    <span class="deshboard--recent-title">{{ member.sent_invitation }}</span><br>
                                    <span>Sent Invitaions</span>
                                 </div>
                              </a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="sidebar-matches2 shadow-sm  mb-2 p-2 mt-3 bg-body rounded">
                           <div class="d-flex">
                              <h6 class="w-100 bd-highlight">Shortlisted</h6>
                              <div class="flex-shrink-1">
                                 <div class="view-all-my"><router-link to="/my-account/shortlisted">View All</router-link></div>
                              </div>
                           </div>

                           <div class="d-flex side-new-matches" v-for="(short,row) in shortlistedList" :key="short.member_profile_id">
                              <div class="new-matches-images">
                                 <img :src="short.image">
                              </div>
                              <div class="new-matches-title">
                                 <div class="new-matches-name">{{ short.name }}</div>
                                 <div class="new-matches-title-sub">{{ short.age }}, {{ short.height }}", {{ short.religion }},{{ short.caste }}</div>
                                 <div class="new-matches-title-sub">{{ short.country_living_in }}, {{ short.state_living_in }}</div>
                              </div>
                              <div class="ms-auto" v-if="!short.invitationSend">
                                 <a href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#short-list-'+short.member_profile_id">
                                    <div class="connect-now-icon"><img src="/assets/frontend/img/check-mark.png" width="27" height="27"><br>Connect Now</div>
                                 </a>
                              </div>
                              <!--Short List Modal -->
                              <div class="modal fade" :id="'short-list-'+short.member_profile_id" tabindex="-1" aria-labelledby="connect-nows" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                       <div class="modal-header blue text-light p-2">
                                          <h5 class="modal-title" id="connect-nows">Write to {{ short.name }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body premium-icon-22s">
                                          <div class="row">
                                             <div class="col-md-3">
                                                <div class="match-list-image-premium"><img :src="short.image">
                                                </div>
                                             </div>
                                             <div class="col-md-9">
                                                <label for="exampleFormControlTextarea1" class="form-label">Add a message</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4">Hello, I liked your profile as well. It would be good to communicate and get to know each other better. Best regards, {{ member.name }}</textarea>
                                                <button data-bs-dismiss="modal" @click="shortlistConnectInvitation(row,short.member_profile_id,member.profileId)" type="button" class="btn btn-blue2 bg-gradient mt-3">Connect</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Short List Modal -->
                           </div>

                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="sidebar-matches2 shadow-sm  mb-2 p-2 mt-3 bg-body rounded">
                           <div class="d-flex">
                              <h6 class="w-100 bd-highlight">Recently viewd</h6>
                              <div class="flex-shrink-1">
                                 <div class="view-all-my"><router-link to="/my-account/recent-view">View All</router-link></div>
                              </div>
                           </div>
                           
                           <div class="d-flex side-new-matches" v-for="(viewed,row) in viewedList" :key="viewed.member_profile_id">
                              <div class="new-matches-images">
                                 <img :src="viewed.image">
                              </div>
                              <div class="new-matches-title">
                                 <div class="new-matches-name">{{ viewed.name }}</div>
                                 <div class="new-matches-title-sub">{{ viewed.age }}, {{ viewed.height }}", {{ viewed.religion }},{{ viewed.caste }}</div>
                                 <div class="new-matches-title-sub">{{ viewed.country_living_in }} {{ viewed.state_living_in }}</div>
                              </div>
                              <div class="ms-auto" v-if="!viewed.invitationSend">
                                 <a href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#viewed-list-'+viewed.member_profile_id">
                                    <div class="connect-now-icon"><img src="/assets/frontend/img/check-mark.png" width="27" height="27"><br>Connect Now</div>
                                 </a>
                              </div>
                              <!--Viewed List Modal -->
                              <div class="modal fade" :id="'viewed-list-'+viewed.member_profile_id" tabindex="-1" aria-labelledby="connect-nows" aria-hidden="true">
                                 <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content ">
                                       <div class="modal-header blue text-light p-2">
                                          <h5 class="modal-title" id="connect-nows">Write to {{ viewed.name }}</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body premium-icon-22s">
                                          <div class="row">
                                             <div class="col-md-3">
                                                <div class="match-list-image-premium"><img :src="viewed.image">
                                                </div>
                                             </div>
                                             <div class="col-md-9">
                                                <label for="exampleFormControlTextarea1" class="form-label">Add a message</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="4">Hello, I liked your profile as well. It would be good to communicate and get to know each other better. Best regards, {{ member.name }}</textarea>
                                                <button data-bs-dismiss="modal" @click="viewedConnectInvitation(row,viewed.member_profile_id,member.profileId)" type="button" class="btn btn-blue2 bg-gradient mt-3">Connect</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <!-- Viewed List Modal -->
                           </div>

                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="sidebar-matches shadow-sm  mb-2 p-2 mt-3 bg-body rounded">
                           <div class="d-flex">
                              <h6 class="w-100 bd-highlight">Notifications</h6>
                              <div class="flex-shrink-1">
                                 <div class="view-all-my"><router-link to="/my-account/notifications">View All</router-link></div>
                              </div>
                           </div>

                           <div class="d-flex side-new-matches" v-for="notify in notificationList" :key="notify.member_profile_id">
                              <div class="new-matches-images">
                                 <img :src="notify.image">
                              </div>
                              <div class="new-matches-title">
                                 <div class="new-matches-title-sub">{{ notify.name }} {{ notify.text }}</div>
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
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue"
import Footer from '../../footer/FooterComponent.vue'

export default {
    components:{
      MemberAccountHeader,
      Footer,
    },
    data: function () {
       return{
          memberInfo: null,
          member:{
             name:null,
             profileId:null,
             image:null,
             packageName: null,
             packageExpDate: null,
             membershipType: null,
             shortlisted: null,
             view_contact: null,
             recent_visitor: null,
             pending_invitation: null,
             accepted_invitation: null,
             sent_invitation: null,
          },
         shortlistedList: null,
         viewedList: null,
         notificationList: null,
         imgeValidationError: null,
       }
    },
    mounted () {
      if (localStorage.getItem('hmWLoggedIn')) {
         let memberInfo = JSON.parse(localStorage.getItem('hmWLoggedIn'));
         this.member.name = memberInfo.name;
         this.member.profileId = memberInfo.member_profile_id;
         this.member.membershipType = memberInfo.membership == '2' ? 'Premium Member' : 'Free Member';
         this.member.image = memberInfo.image;
         this.member.packageName = memberInfo.package_info.current_package;
         this.member.packageExpDate = memberInfo.package_info.expire_date ? memberInfo.package_info.expire_date : '';
         this.member.shortlisted = memberInfo.shortlisted;
         this.member.view_contact = memberInfo.view_contact;
         this.member.recent_visitor = memberInfo.recent_visitor;
         this.member.accepted_invitation = memberInfo.accepted_invitation;
         this.member.pending_invitation = memberInfo.pending_invitation;
         this.member.sent_invitation = memberInfo.sent_invitation;
      }
      this.getMemberData()
      this.$store.dispatch('getOnBehalf')
      this.$store.dispatch('getCountry')
      this.$store.dispatch('getMaritalStatus')
      this.$store.dispatch('getReligion')
      this.$store.dispatch('getLanguage')
      this.$store.dispatch('getFamilyValue')
      this.$store.dispatch('getFamilyStatus')
      this.$store.dispatch('getEducation')
      this.$store.dispatch('getOccupation')
      this.$store.dispatch('getIncomes')
    },
    methods:{
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
                  .post("api/upload-image/"+this.member.profileId,{
                     'image': reader.result
                  })
                  .then((response) => {
                     if(response.data != false){
                        this.member.image = response.data
                        if (localStorage.getItem('hmWLoggedIn')) {
                           let memberInfo = JSON.parse(localStorage.getItem('hmWLoggedIn'));
                           memberInfo.image = response.data;
                           localStorage.setItem('hmWLoggedIn',JSON.stringify(memberInfo));
                        }
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
      getMemberData(){
         axios
         .get("api/my-account-data/"+this.member.profileId)
         .then((response) => {
         if (response.data) {
            this.shortlistedList = response.data[0];
            this.viewedList = response.data[1];
            this.notificationList = response.data[2];
         }
         })
         .catch((error) => {
         console.log(error);
         });
      },
      /** Connect Invitation **/
      shortlistConnectInvitation(index,to,from){
         axios
         .get("api/connect-invitation/"+to+"/"+from)
         .then((response) => {
            console.log(response.data);
            if (response.data == true) {
               this.shortlistedList[index]['invitationSend'] = true;
            }
         })
         .catch((error) => {
            console.log(error);
         });
      },
      /** Connect Invitation **/
      viewedConnectInvitation(index,to,from){
         axios
         .get("api/connect-invitation/"+to+"/"+from)
         .then((response) => {
            if (response.data == true) {
               this.viewedList[index]['invitationSend'] = true;
            }
         })
         .catch((error) => {
            console.log(error);
         });
      },
    }
}
</script>