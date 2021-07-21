<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
      <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-9">
                        <div class="shadow-sm  mb-2 p-3 bg-body rounded partner-profiles">
                           <form>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Age</label>
                                 <div class="col-sm-3">
                                    <input
                                    type="range"
                                    min="18"
                                    max="80"
                                    step="1"
                                    v-model="formData.from_age"
                                    />
                                    {{ formData.from_age }}
                                 </div>
                                 <div class="col-md-1">
                                    To
                                 </div>
                                 <div class="col-sm-3">
                                    <input
                                    type="range"
                                    min="18"
                                    max="80"
                                    step="1"
                                    v-model="formData.to_age"
                                    />
                                    {{ formData.to_age }}
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Height</label>
                                 <div class="col-sm-3">
                                    <input
                                    type="range"
                                    min="4.0"
                                    max="8.0"
                                    step="0.1"
                                    v-model="formData.from_height"
                                    />
                                    {{ formData.from_height+'"' }}
                                 </div>
                                 <div class="col-md-1">
                                    To
                                 </div>
                                 <div class="col-sm-3">
                                    <input
                                    type="range"
                                    min="4.0"
                                    max="8.0"
                                    step="0.1"
                                    v-model="formData.to_height"
                                    />
                                    {{ formData.to_height+'"' }}
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">On Behalf</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.on_behalf" label="name" track-by="id" :options="onBehalf" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Marital status</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.marital_status" label="name" track-by="id" :options="maritalStatus" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Have Children
                                 </label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.have_child" label="name" track-by="id" :options="haveChild" :multiple="false" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Mother tongue</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.mother_tongue" label="name" track-by="id" :options="languages" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Religion</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.religion" label="name" track-by="id" :options="religions" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Caste</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.caste" label="name" track-by="id" :options="casteList" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <h5 class="mt-5 mb-3">Location Details</h5>
                              <hr>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Country living in</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.country_living_in" label="name" track-by="id" :options="countries" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">State / District</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.state_living_in" label="name" track-by="id" :options="stateList" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">City / Upazila</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.city_living_in" label="name" track-by="id" :options="cityList" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Resident Status</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.resident_status" label="name" track-by="id" :options="residentStatus" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Grew up in</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.grew_up_in" label="name" track-by="id" :options="countries" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <h5 class="mt-5">Education & Profession Details</h5>
                              <hr>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Height Education</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.height_education" label="name" track-by="id" :options="educations" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Profession Type</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.profession_type" label="name" track-by="id" :options="professionType" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Profession Name</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.profession_name" label="name" track-by="id" :options="occupations" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Annual income</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.annual_income" label="name" track-by="id" :options="incomes" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <h5 class="mt-5">Diet</h5>
                              <hr>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Eating habits</label>
                                 <div class="col-sm-9">
                                    <multiselect v-model="formData.diet" label="name" track-by="id" :options="diets" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <h5 class="mt-5 mb-3">Photo</h5>
                              <hr>
                              <div class="mb-3 row">
                                 <label for="staticEmail" class="col-sm-3 col-form-label">Photo Settings</label>
                                 <div class="col-sm-9 pt-2">
                                    <multiselect v-model="formData.photo_settings" label="name" track-by="id" :options="photoSettings" :multiple="true" :preselect-first="true">
                                    </multiselect>
                                 </div>
                              </div>
                              <div class="d-grid gap-2 d-md-block text-center">
                                 <button class="btn btn-success" type="button" @click="submitAdvancedSearch">
                                 Search
                                 </button>
                              </div>
                           </form>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="sidebar-matches shadow-sm  mb-2 p-3 bg-body rounded">
                           <h5>Search by ID</h5>
                           <div class="input-group">
                              <form class="search-bar" action="/action_page.php">
                                 <input type="text" placeholder="Enter Profile ID" name="search">
                                 <button type="submit"><img src="/assets/frontend/img/search.png" height="15" width="15"></button>
                              </form>
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
import Multiselect from "vue-multiselect"

export default {
  components: {
    MemberAccountHeader,
    Multiselect,
    Footer,
  },
  data(){
      return{
          formData:{
            from_age: 18,
            to_age: 30,
            from_height: 4.0,
            to_height: 7.0,
            marital_status: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            religion: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            caste: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            mother_tongue: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            country_living_in: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            state_living_in:[
                { 'id': '','name' : "Doesn't matter"}
            ],
            city_living_in:[
                { 'id': '','name' : "Doesn't matter"}
            ],
            resident_status:[
                { 'id': '','name' : "Doesn't matter"}
            ],
            grew_up_in:[
                { 'id': '','name' : "Doesn't matter"}
            ],
            height_education: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            profession_type: [
                {'id': '','name': "Doesn't matter"}
            ],
            profession_name: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            annual_income: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            on_behalf: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            have_child: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            diet: [
                { 'id': '','name' : "Doesn't matter"}
            ],
            photo_settings: [
               {'id': '','name': "Doesn't matter"}
            ],
            gender:[
               {'id': '','name': "Doesn't matter"}
            ],
          },
          stateList:[],
          cityList: [],
          casteList: [],

          haveChild: [
            {'id':'','name': "Doesn't matter"},
            {'id':'0','name': '0'},
            {'id':'1','name': '1'},
            {'id':'2','name': '2'},
            {'id':'3','name': '3'},
            {'id':'4','name': '4'},
            {'id':'5','name': '5'},
            {'id':'6','name': '6'},
            {'id':'7','name': '7'},
            {'id':'8','name': '8'},
            {'id':'9','name': '9'},
            {'id':'10','name': '10'},
          ],
          residentStatus: [
             {'id':'','name': "Doesn't matter"},
             {'id':'Citizen','name': 'Citizen'},
             {'id':'Permanent Resident','name': 'Permanent Resident'},
             {'id':'Work Permit','name': 'Work Permit'},
             {'id':'Student Visa','name': 'Student Visa'},
             {'id':'Temporary Visa','name': 'Temporary Visa'},
          ],
          diets:[
               {'id':'','name': "Doesn't matter"},
               {'id':'1','name': 'Veg'},
               {'id':'2','name': 'Non-Veg'},
               {'id':'3','name': 'Occasionally Non-Veg'},
               {'id':'4','name': 'Eggetarian'},
               {'id':'5','name': 'Jain'},
               {'id':'6','name': 'Vegan'},
          ],
          professionType:[
            {'id': '','name': "Doesn't matter"},
            {'id': '1','name': "Private Company"},
            {'id': '2','name': "Government / Public Sector"},
            {'id': '3','name': "Defense / Civil Services"},
            {'id': '4','name': "Business / Self Employed"},
            {'id': '5','name': "Not Working"},
          ],
          photoSettings:[
            {'id': '','name': "Doesn't matter"},
            {'id': 'With Photo','name': "With Photo"},
            {'id': 'Without Photo','name': "Without Photo"},
            {'id': 'Protected Photo','name': "Protected Photo"},
          ],
      };
  },
  mounted(){
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
  computed:{
        ...mapState([
            'onBehalf',
            'countries',
            'maritalStatus',
            'religions',
            'languages',
            'familyValues',
            'familyStatus',
            'educations',
            'occupations',
            'incomes',
        ])
    },
  watch:{
      'formData.religion': function(){
          this.getCasteList(this.formData.religion)
      },
      'formData.country_living_in': function(){
          this.getStateList(this.formData.country_living_in)
      },
      'formData.state_living_in': function(){
          this.getCityList(this.formData.state_living_in)
      }
  },
  methods:{
    getCasteList(rel) {
       const allReligionID = [];
        rel.forEach(element => {
            allReligionID.push(element.id);
        });
        axios
        .post("api/all-caste/",{
           'religion_ids':allReligionID,
        })
        .then((response) => {
            this.casteList = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    getStateList(selectedCountries){
        const allCountryID = [];
        selectedCountries.forEach(element => {
            allCountryID.push(element.id);
        });
        axios
          .post("api/all-state/",{
              'ids': allCountryID
          })
          .then((response) => {
            this.stateList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getCityList(selectedStates){
        const allStateID = [];
        selectedStates.forEach(element => {
            allStateID.push(element.id);
        });
        axios
          .post("api/all-city/",{
              'ids': allStateID
          })
          .then((response) => {
            this.cityList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    submitAdvancedSearch(){
      //   console.log(this.formData)
        let parsed = JSON.stringify(this.formData);
        localStorage.setItem('advanced_search_query',parsed);
        this.$router.push('/my-account/advanced-search-result');
    },
  }
};
</script>