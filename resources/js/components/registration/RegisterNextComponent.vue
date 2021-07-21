<template>
    <div>
        <Header/>
        <section id="profile-create">
            <div class="container my-5">
                <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h5 class="text-center mb-3">Please provide us with your basic details </h5>
                    <div class="create-profile border p-3 shadow-sm bg-body">
                        <form>
                            <div v-if="step === 1">
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Height Education</label>
                                                <select class="form-select" v-model="formdata.height_education" aria-label="Default select example">
                                                    <option selected>Select</option>
                                                    <option value="">B A </option>
                                                    <option value="1">M A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="collage_name" class="form-label">Highest Education College Name</label>
                                                <input type="text" v-model="formdata.height_education_college_name" value="" id="college_name" class="form-control" placeholder="Highest Education College Name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Profession Type</label>
                                                <select class="form-select" v-model="formdata.profession_type" aria-label="Default select example">
                                                    <option selected>Select</option>
                                                    <option value="">Private Company</option>
                                                    <option value="1">Government / Public Sector</option>
                                                    <option value="1">Defense / Civil Services</option>
                                                    <option value="1">Business / Self Employed</option>
                                                    <option value="1">Not Working</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Profession Name</label>
                                                <select class="form-select" v-model="formdata.profession_name" aria-label="Default select example">
                                                    <option selected>Select</option>
                                                    <option value="">Doctor</option>
                                                    <option value="1">Engineer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="employer_name" class="form-label">Employer Name</label>
                                                <input type="text" v-model="formdata.employer_name" value="" class="form-control" id="employer_name" placeholder="Employer Name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Annual Income</label>
                                                <select class="form-select" v-model="formdata.annual_income" aria-label="Default select example">
                                                    <option selected>Select</option>
                                                    <option value="">1000USD</option>
                                                    <option value="1">5000USD</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button @click.prevent="next()">Next</button>
                            </div>
                            
                            <div v-if="step === 2">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Height</label>
                                            <select class="form-select" v-model="formdata.height" aria-label="Default select example">
                                                <option selected>Feet / Inches  </option>
                                                <option value="">4ft 7in / 139 cms</option>
                                                <option value="1">4ft 7in / 139 cms</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Marital Status</label>
                                            <select class="form-select" v-model="formdata.marital_status" @change="changeMaritalStatus">
                                                <option selected>Select</option>
                                                <option value="1">Never Married </option>
                                                <option value="2">Widowed </option>
                                                <option value="3">Divorced  </option>
                                                <option value="4">Awaiting divorce  </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" v-if="haveChild">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Have children</label>
                                            <select class="form-select" v-model="formdata.have_child" @change="changeHaveChild">
                                                <option selected>Select</option>
                                                <option value="1">No </option>
                                                <option value="2">Yes.Living with me</option>
                                                <option value="3">Yes.Not Living with me  </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12" v-if="childNumber">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Children Number</label>
                                            <select class="form-select" v-model="formdata.child_number" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2 </option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Health Information</label>
                                            <select class="form-select" v-model="formdata.health_information" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">No Health Problem</option>
                                                <option value="1">HIV Positive</option>
                                                <option value="1">Diabetes</option>
                                                <option value="1">Low BP</option>
                                                <option value="1">High BP</option>
                                                <option value="1">Heart disease</option>
                                                <option value="1">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Disability</label>
                                            <select class="form-select" v-model="formdata.disability" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="1">None</option>
                                                <option value="1">Physical Disability</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Blood Group</label>
                                            <select class="form-select" v-model="formdata.blood_group" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="1">Don't Know</option>
                                                <option value="1">A+</option>
                                                <option value="1">A-</option>
                                                <option value="1">B+</option>
                                                <option value="1">B-</option>
                                                <option value="1">AB+</option>
                                                <option value="1">AB-</option>
                                                <option value="1">O+</option>
                                                <option value="1">O+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button @click.prevent="prev()">Previous</button>
                                <button @click.prevent="next()">Next</button>
                            </div>

                            <div v-if="step === 3">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label for="inputEmail4" class="form-label">Religion</label>
                                            <select class="form-select" v-model="formdata.religion" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Muslim ansari</option>
                                                <option value="1">Muslim Arain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Caste / Community</label>
                                            <select class="form-select" v-model="formdata.caste" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Muslim ansari</option>
                                                <option value="1">Muslim Arain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Sub-Caste / Sub-Community</label>
                                            <select class="form-select" v-model="formdata.sub_caste" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Muslim ansari</option>
                                                <option value="1">Muslim Arain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Mother Language</label>
                                            <select class="form-select" v-model="formdata.mother_language" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Muslim ansari</option>
                                                <option value="1">Muslim Arain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Speak Language</label>
                                            <select class="form-select" v-model="formdata.speak_language" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Muslim ansari</option>
                                                <option value="1">Muslim Arain</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Diet</label>
                                            <select class="form-select" v-model="formdata.diet" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Veg</option>
                                                <option value="1">Non-Veg</option>
                                                <option value="">Occasionally Non-Veg</option>
                                                <option value="1">Eggetarian</option>
                                                <option value="1">Jain</option>
                                                <option value="1">Vegan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div v-if="step === 4">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Father's Status</label>
                                            <select class="form-select" v-model="formdata.father_status" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Employed </option>
                                                <option value="1">Business </option>
                                                <option value="1">Retired </option>
                                                <option value="1">Not Employed </option>
                                                <option value="1">Passed Away </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Mothers's Status</label>
                                            <select class="form-select" v-model="formdata.mother_status" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Employed </option>
                                                <option value="1">Business </option>
                                                <option value="1">Retired </option>
                                                <option value="1">Not Employed </option>
                                                <option value="1">Passed Away </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Family Location</label>
                                            <input type="text" v-model="formdata.family_location" class="form-control" placeholder="Ex: Dhaka, Bangladesh">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Family Type</label>
                                            <select class="form-select" v-model="formdata.family_type" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Joint </option>
                                                <option value="1">Nuclear </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Family Value</label>
                                            <select class="form-select" v-model="formdata.family_value" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Orthodox </option>
                                                <option value="1">Traditional </option>
                                                <option value="1">Moderate  </option>
                                                <option value="1">Liberal  </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Family Affluence</label>
                                            <select class="form-select" v-model="formdata.family_affluence" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Middle Class </option>
                                                <option value="1">Upper Middle Class</option>
                                                <option value="1">Lower Middle Class</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-md-3 col-3">
                                            <label for="inputEmail4" class="form-label">Married Brother</label>
                                            <select class="form-select" v-model="formdata.married_brother" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">1 </option>
                                                <option value="1">2 </option>
                                                <option value="1">3 </option>
                                                <option value="1">4 </option>
                                                <option value="1">5 </option>
                                                <option value="">6 </option>
                                                <option value="1">7 </option>
                                                <option value="1">8 </option>
                                                <option value="1">9 </option>
                                                <option value="1">10 </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <label for="inputEmail4" class="form-label">Married Sister</label>
                                            <select class="form-select" v-model="formdata.married_sister" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">1 </option>
                                                <option value="1">2 </option>
                                                <option value="1">3 </option>
                                                <option value="1">4 </option>
                                                <option value="1">5 </option>
                                                <option value="">6 </option>
                                                <option value="1">7 </option>
                                                <option value="1">8 </option>
                                                <option value="1">9 </option>
                                                <option value="1">10 </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <label for="inputEmail4" class="form-label">Unmarried Brother</label>
                                            <select class="form-select" v-model="formdata.unmarried_brother" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">1 </option>
                                                <option value="1">2 </option>
                                                <option value="1">3 </option>
                                                <option value="1">4 </option>
                                                <option value="1">5 </option>
                                                <option value="">6 </option>
                                                <option value="1">7 </option>
                                                <option value="1">8 </option>
                                                <option value="1">9 </option>
                                                <option value="1">10 </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-3">
                                            <label for="inputEmail4" class="form-label">Unmarried Sister</label>
                                            <select class="form-select" v-model="formdata.unmarried_sister" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">1 </option>
                                                <option value="1">2 </option>
                                                <option value="1">3 </option>
                                                <option value="1">4 </option>
                                                <option value="1">5 </option>
                                                <option value="">6 </option>
                                                <option value="1">7 </option>
                                                <option value="1">8 </option>
                                                <option value="1">9 </option>
                                                <option value="1">10 </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="step === 5">
                                <div class="row">
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Country Living In</label>
                                            <select class="form-select" v-model="formdata.country_living_in" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Government/PSU</option>
                                                <option value="1">Private</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">State Living In</label>
                                            <select class="form-select" v-model="formdata.state_living_in" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">HM Expo</option>
                                                <option value="1">HM Wedding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">City Living In</label>
                                            <select class="form-select" v-model="formdata.city_living_in" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">HM Expo</option>
                                                <option value="1">HM Wedding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Residency status</label>
                                            <select class="form-select" v-model="formdata.residency_status" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">HM Expo</option>
                                                <option value="1">HM Wedding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Grew up in</label>
                                            <select class="form-select" v-model="formdata.grew_up_in" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">HM Expo</option>
                                                <option value="1">HM Wedding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Ethnic Origin</label>
                                            <select class="form-select" v-model="formdata.ethnic_origin" aria-label="Default select example">
                                                <option selected>Select</option>
                                                <option value="">Dhaka</option>
                                                <option value="1">Gazipur</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 co-12">
                                        <div class="mb-2">
                                            <label for="inputEmail4" class="form-label">Zip/Pin Code</label>
                                            <input type="text" v-model="formdata.zip_code" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-if="step === 6">
                                <h1>Step Three</h1>
                                <div class="mb-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">About Yourself And Family</label>
                                    <textarea class="form-control" v-model="formdata.about_yourself" id="exampleFormControlTextarea1" rows="3" placeholder=""></textarea>
                                </div>
                                <button @click.prevent="prev()">Previous</button>
                                <button @click.prevent="submit()">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </section>
        <Footer/>
    </div>
</template>

<script>
import Header from '../home/HomeHeaderComponent.vue'
import Footer from '../footer/FooterComponent.vue'
export default {
    components:{
        Header,
        Footer
    },
      data() {
    return {
      step:1,
      registration:{
        name:null,
        email:null,
        street:null,
        city:null,
        state:null,
        numtickets:0,
        shirtsize:'XL'
      }
    }
  },
  methods:{
    prev() {
      this.step--;
    },
    next() {
      this.step++;
    },
    submit() {
      alert('Submit to blah and show blah and etc.');      
    }
  }

}
</script>