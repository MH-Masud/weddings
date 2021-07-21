<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
        <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10 offset-md-1">
            <div class="shadow-sm mb-2 p-3 bg-body rounded partner-profiles">
              <h5 class="mb-3">
                Tell us what you are looking for in a life partner
              </h5>
              <form>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Age</label
                  >
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-md-6">
                        <input
                          type="range"
                          min="18"
                          max="80"
                          step="1"
                          v-model="formData.from_age"
                        />
                        {{ formData.from_age+' years' }}
                        <br />
                        <label for="">From</label>
                      </div>
                      <div class="col-md-6">
                        <input
                          type="range"
                          min="18"
                          max="80"
                          step="1"
                          v-model="formData.to_age"
                        />
                        {{ formData.to_age+' years' }}
                        <br />
                        <label for="">To</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Height
                  </label>
                  <div class="col-sm-10">
                    <div class="row">
                      <div class="col-md-6">
                        <input
                          type="range"
                          min="4.0"
                          max="8.0"
                          step="0.1"
                          v-model="formData.from_height"
                        />
                        {{ formData.from_height+'"' }}
                        <br />
                        <label for="">From</label>
                      </div>
                      <div class="col-md-6">
                        <input
                          type="range"
                          min="4.0"
                          max="8.0"
                          step="0.1"
                          v-model="formData.to_height"
                        />
                        {{ formData.to_height+'"' }}
                        <br />
                        <label for="">To</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Marital status</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="maritalStatusChange" v-model="formData.marital_status" label="name" track-by="id" :options="maritalStatus" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Have children</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="haveChildChange" v-model="formData.having_child" label="name" track-by="id" :options="haveChild" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Mother tongue</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="motherTongueChange" v-model="formData.mother_tongue" label="name" track-by="id" :options="languages" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Religion</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="religionChange" v-model="formData.religion" label="name" track-by="id" :options="religions" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>

                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Cast / Community</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="casteChange" v-model="formData.caste" label="name" track-by="id" :options="castes" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>

                <h5 class="mt-5 mb-3 border-bottom bg-light p-2 fs-6">
                  Location Details
                </h5>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Country living in</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="countryLivingInChange" v-model="formData.country_living_in" label="name" track-by="id" :options="countries" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >State / District</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="stateLivingInChange" v-model="formData.state_living_in" label="name" track-by="id" :options="stateList" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >City / Thana / Upazila</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="cityLivingInChange" v-model="formData.city_living_in" label="name" track-by="id" :options="cityList" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <h5 class="mt-5 border-bottom bg-light p-2 fs-6">
                  Education & Profession Details
                </h5>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Education</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="heightEducationChange" v-model="formData.height_education" label="name" track-by="id" :options="educations" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Profession Type</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="professionTypeChange" v-model="formData.profession_type" label="name" track-by="id" :options="professionType" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Profession Name</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="professionNameChange" v-model="formData.profession_name" label="name" track-by="id" :options="occupations" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Annual income</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="annualIncomeChange" v-model="formData.annual_income" label="name" track-by="id" :options="incomes" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                
                <h5 class="mt-5 mb-3 border-bottom bg-light p-2 fs-6">
                  Other Details
                </h5>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Profile created by</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="onBehalfChange" v-model="formData.on_behalf" label="name" track-by="id" :options="onBehalf" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="mb-3 row">
                  <label for="staticEmail" class="col-sm-2 col-form-label"
                    >Diet</label
                  >
                  <div class="col-sm-10">
                    <multiselect @input="dietChange" v-model="formData.diet" label="name" track-by="id" :options="diets" :multiple="true" :preselect-first="true">
                    </multiselect>
                  </div>
                </div>
                <div class="d-grid gap-2 d-md-block text-center">
                  <button class="btn btn-blue2 bg-gradient" type="button" @click="fromSubmit">
                    Save & Continue
                  </button>
                </div>
              </form>
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
import {mapState} from 'vuex';
import Multiselect from "vue-multiselect";

export default {
  components: {
    MemberAccountHeader,
    Footer,
    Multiselect,
  },
  data() {
    return {
      memberID: null,
      formData:{
          from_age: 18,
          to_age: 80,
          from_height: 4.0,
          to_height: 8.0,
          marital_status: [
              { 'id': '','name' : "Doesn't matter"}
          ],
          having_child: [
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
          diet: [
              { 'id': '','name' : "Doesn't matter"}
          ],
      },
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
      professionType:[
          {'id': '','name': "Doesn't matter"},
          {'id': '1','name': "Private Company"},
          {'id': '2','name': "Government / Public Sector"},
          {'id': '3','name': "Defense / Civil Services"},
          {'id': '4','name': "Business / Self Employed"},
          {'id': '5','name': "Not Working"},
      ],
      castes: [],
      stateList:[],
      cityList: [],
      diets:[
          {'id':'','name': "Doesn't matter"},
          {'id':'1','name': 'Veg'},
          {'id':'2','name': 'Non-Veg'},
          {'id':'3','name': 'Occasionally Non-Veg'},
          {'id':'4','name': 'Eggetarian'},
          {'id':'5','name': 'Jain'},
          {'id':'6','name': 'Vegan'},
      ],
      pageLoded: null,
    };
  },
  watch:{
      'formData.religion': function(){
          this.getSubCaste(this.formData.religion)
      },
      'formData.country_living_in': function(){
          this.getStateList(this.formData.country_living_in)
      },
      'formData.state_living_in': function(){
          this.getCityList(this.formData.state_living_in)
      }
  },
  mounted(){
    if (localStorage.getItem('hmWLoggedIn')) {
      let memberDetails = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberID = memberDetails.member_profile_id;
    }
    this.getPartnerProfileData();
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
    this.pageLoded = true;
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
  methods: {
    /** Get Partner Profile Data **/
    getPartnerProfileData(){
      axios
        .get("api/partner-profile/"+this.memberID)
        .then((response) => {
            console.log(response.data);
            const partnerProfileInfo = response.data;
            this.formData.from_age = partnerProfileInfo.from_age;
            this.formData.to_age = partnerProfileInfo.to_age;
            this.formData.from_height = partnerProfileInfo.from_height;
            this.formData.to_height = partnerProfileInfo.to_height;
            this.formData.marital_status = partnerProfileInfo.marital_status;
            this.formData.having_child = partnerProfileInfo.having_child;
            this.formData.mother_tongue = partnerProfileInfo.mother_tongue;
            this.formData.religion = partnerProfileInfo.religion;
            axios
            .get("api/caste/"+this.formData.religion)
            .then((response) => {
              this.castes = response.data;
            })
            .catch((error) => {
              console.log(error);
            });
            this.formData.caste = partnerProfileInfo.caste;
            this.formData.country_living_in = partnerProfileInfo.country_living_in;
            this.formData.state_living_in = partnerProfileInfo.state_living_in;
            this.formData.city_living_in = partnerProfileInfo.city_living_in;
            this.formData.height_education = partnerProfileInfo.height_education;
            this.formData.profession_type = partnerProfileInfo.profession_type;
            this.formData.profession_name = partnerProfileInfo.profession_name;
            this.formData.on_behalf = partnerProfileInfo.on_behalf;
            this.formData.diet = partnerProfileInfo.diet;
            this.formData.country_living_in = partnerProfileInfo.country_living_in;
            this.formData.state_living_in = partnerProfileInfo.state_living_in;
            this.formData.city_living_in = partnerProfileInfo.city_living_in;
        })
        .catch((error) => {
            console.log(error);
        });
    },

    /** Filter Option On Change **/

    onBehalfChange(){
      if (this.pageLoded) {
        if (this.formData.on_behalf == 0) {
          this.formData.on_behalf.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.on_behalf.length > 1){
          this.formData.on_behalf.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.on_behalf.splice(g,1);
            }
          });
        }
      }
    },
    maritalStatusChange(){
      if (this.pageLoded) {
        if (this.formData.marital_status == 0) {
          this.formData.marital_status.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.marital_status.length > 1){
          this.formData.marital_status.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.marital_status.splice(g,1);
            }
          });
        }
      }
    },
    haveChildChange(){
      if (this.pageLoded) {
        if (this.formData.having_child == 0) {
          this.formData.having_child.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.having_child.length > 1){
          this.formData.having_child.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.having_child.splice(g,1);
            }
          });
        }
      }
    },
    motherTongueChange(){
      if (this.pageLoded) {
        if (this.formData.mother_tongue == 0) {
          this.formData.mother_tongue.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.mother_tongue.length > 1){
          this.formData.mother_tongue.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.mother_tongue.splice(g,1);
            }
          });
        }
      }
    },
    religionChange(){
      if (this.pageLoded) {
        if (this.formData.religion == 0) {
          this.formData.religion.push(
            {'id':'','name': "Doesn't matter"}
          );
          this.formData.caste = [
            {'id':'','name': "Doesn't matter"}
          ];
        } else if(this.formData.religion.length > 1){
          this.formData.religion.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.religion.splice(g,1);
            }
          });
        }
      }
    },
    casteChange(){
      if (this.pageLoded) {
        if (this.formData.caste == 0) {
          this.formData.caste.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.caste.length > 1){
          this.formData.caste.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.caste.splice(g,1);
            }
          });
        }
      }
    },
    countryLivingInChange(){
      if (this.pageLoded) {
        if (this.formData.country_living_in == 0) {
          this.formData.country_living_in.push(
            {'id':'','name': "Doesn't matter"}
          );
          this.formData.city_living_in = [
            {'id':'','name': "Doesn't matter"}
          ];
          this.formData.state_living_in = [
            {'id':'','name': "Doesn't matter"}
          ];
        } else if(this.formData.country_living_in.length > 1){
          this.formData.country_living_in.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.country_living_in.splice(g,1);
            }
          });
        }
      }
    },
    stateLivingInChange(){
      if (this.pageLoded) {
        if (this.formData.state_living_in == 0) {
          this.formData.state_living_in.push(
            {'id':'','name': "Doesn't matter"}
          );
          this.formData.city_living_in = [
            {'id':'','name': "Doesn't matter"}
          ];
        } else if(this.formData.state_living_in.length > 1){
          this.formData.state_living_in.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.state_living_in.splice(g,1);
            }
          });
        }
      }
    },
    cityLivingInChange(){
      if (this.pageLoded) {
        if (this.formData.city_living_in == 0) {
          this.formData.city_living_in.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.city_living_in.length > 1){
          this.formData.city_living_in.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.city_living_in.splice(g,1);
            }
          });
        }
      }
    },
    heightEducationChange(){
      if (this.pageLoded) {
        if (this.formData.height_education == 0) {
          this.formData.height_education.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.height_education.length > 1){
          this.formData.height_education.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.height_education.splice(g,1);
            }
          });
        }
      }
    },
    professionTypeChange(){
      if (this.pageLoded) {
        if (this.formData.profession_type == 0) {
          this.formData.profession_type.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.profession_type.length > 1){
          this.formData.profession_type.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.profession_type.splice(g,1);
            }
          });
        }
      }
    },
    professionNameChange(){
      if (this.pageLoded) {
        if (this.formData.profession_name == 0) {
          this.formData.profession_name.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.profession_name.length > 1){
          this.formData.profession_name.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.profession_name.splice(g,1);
            }
          });
        }
      }
    },
    annualIncomeChange(){
      if (this.pageLoded) {
        if (this.formData.annual_income == 0) {
          this.formData.annual_income.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.annual_income.length > 1){
          this.formData.annual_income.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.annual_income.splice(g,1);
            }
          });
        }
      }
    },
    dietChange(){
      if (this.pageLoded) {
        if (this.formData.diet == 0) {
          this.formData.diet.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.formData.diet.length > 1){
          this.formData.diet.forEach((gen,g) => {
            if (gen.id == '' || gen.id == null) {
              this.formData.diet.splice(g,1);
            }
          });
        }
      }
    },
    
    /** Get Filter Option Data **/
    getSubCaste(rel) {
       const allReligionID = [];
        rel.forEach(element => {
            allReligionID.push(element.id);
        });
        axios
        .post("api/all-caste/",{
           'religion_ids':allReligionID,
        })
        .then((response) => {
            this.castes = response.data;
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

    /** Save Partner Profile Info**/
    fromSubmit(){
        axios
        .post("api/update-partner-profile/"+this.memberID,{
          'data': this.formData
        })
        .then((response) => {
          if (response.data == true) {
            this.$router.push('/my-account/my-match');
          } else {
            console.log(response.data)
          }
        })
        .catch((error) => {
          console.log(error);
        });
    }
  },
};
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>