<template>
    <div>
        <MemberAccountHeader></MemberAccountHeader>
        <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="shadow-sm  mb-2 p-3 bg-body rounded">
                        <div  class="row">
                            <div class="col-md-3 col-12">
                                <div class="my-profile-img text-center border">
                                    <img :src="image">
                                    <router-link to="/my-account/photo">
                                    <p>Add / Edit Photos</p>
                                    </router-link>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-12">
                                    <span class="my-profile-title">{{ name }}</span> <span class="my-profile-title-id">( {{ member_profile_id }} )</span>
                                    <div class="my-profile-sub-title mt-md-3">
                                        <span><i class="far fa-circle"></i> {{ age }} years, {{ height }}"</span>
                                        <span><i class="far fa-circle"></i> {{ profession_name }}</span>
                                        <span><i class="far fa-circle"></i> {{ marital_status }}</span>
                                        <span><i class="far fa-circle"></i> {{ height_education }}</span>
                                        <span><i class="far fa-circle"></i> {{ mother_language }}</span>
                                        <span><i class="far fa-circle"></i> {{ country_living_in }}, {{ state_living_in }}</span>
                                    </div>
                                    </div>
                                    <div class="col-md-12">
                                    <div class="profile-link-pages">
                                        <h5 class="mt-3">Manage your Profile</h5>
                                        <ul>
                                            <router-link to="/my-account/edit">
                                                <li>Edit Personal Profile</li>
                                            </router-link>
                                            <router-link to="/my-account/partner-profile">
                                                <li>Edit Partner Profile</li>
                                            </router-link>
                                            <router-link to="/my-account/contact-details">
                                                <li>Edit Contact Details</li>
                                            </router-link>
                                            <router-link to="/my-account/">
                                                <li>View Profile Stats</li>
                                            </router-link>
                                            <router-link to="/my-account/photo">
                                                <li>Add Photos</li>
                                            </router-link>
                                            <router-link to="/my-account/account-settings">
                                                <li>Account Settings</li>
                                            </router-link>
                                        </ul>
                                    </div>
                                    </div>
                                    <!-- <div class="preview-my-profile mt-2"><a href="profile-view.php"><img src="/assets/frontend/img/view.png" width="20" height="20" class="me-2 border">Preview your profile</a></div> -->
                                </div>
                            </div>
                        </div>
                        </div>
                        <h5 class="my-3 ">Personal Information</h5>
                        <div class="shadow-sm  mb-2 p-3 bg-body rounded">
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Personality</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <p class="text-justify">{{ introduction }}</p>
                        <div class="my-profile-title-heading d-flex mb-2 mt-3 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Basics & Lifestyle</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">On Behalf</td>
                                    <td>: {{ on_behalf }} </td>
                                </tr>
                                <tr>
                                    <td class="her-per">Age</td>
                                    <td>: {{ age }} years </td>
                                </tr>
                                <tr>
                                    <td>Height</td>
                                    <td>: {{ height }}"</td>
                                </tr>
                                <tr>
                                    <td>Marital Status</td>
                                    <td>: {{ marital_status }}</td>
                                </tr>
                                <tr>
                                    <td>Mother Tongue </td>
                                    <td>: {{ mother_language }}</td>
                                </tr>
                                <tr>
                                    <td>Health Information  </td>
                                    <td>: {{ health_information }}</td>
                                </tr>
                                <tr>
                                    <td>Disability  </td>
                                    <td>: {{ disability }}</td>
                                </tr>
                                <tr>
                                    <td>Diet</td>
                                    <td>: {{ diet }}</td>
                                </tr>
                                <tr>
                                    <td>Blood Group</td>
                                    <td>: {{ blood_group }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 mt-3 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Religious Background</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Religion</td>
                                    <td>: {{ religion }}</td>
                                </tr>
                                <tr>
                                    <td>Community</td>
                                    <td>: {{ caste }}</td>
                                </tr>
                                <tr>
                                    <td>Sub Community</td>
                                    <td>: {{ sub_caste }}</td>
                                </tr>
                                <tr>
                                    <td>Mother Tongue </td>
                                    <td>: {{ mother_language }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 mt-3 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Family details</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Father's Status</td>
                                    <td>: {{ father_status }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Mother's Status</td>
                                    <td>: {{ mother_status }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">No. of Brothers</td>
                                    <td>: {{ brother }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">No. of Sisters</td>
                                    <td>: {{ sister }}</td>
                                </tr>
                                <tr>
                                    <td>Family Location</td>
                                    <td>: {{ family_location }}</td>
                                </tr>
                                <tr>
                                    <td>Family Type</td>
                                    <td>: {{ family_type }}</td>
                                </tr>
                                <tr>
                                    <td>Family Value</td>
                                    <td>: {{ family_value }}</td>
                                </tr>
                                <tr>
                                    <td>Family Status</td>
                                    <td>: {{ family_status }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 mt-3 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Education & Career</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Highest Qualification</td>
                                    <td>: {{ height_education }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">College Name</td>
                                    <td>: {{ height_education_college_name }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Annual Income</td>
                                    <td>: {{ annual_income }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Profession Type</td>
                                    <td>: {{ profession_type }}</td>
                                </tr>
                                <tr>
                                    <td>Profession Name</td>
                                    <td>: {{ profession_name }}</td>
                                </tr>
                                <tr>
                                    <td>Employer Name</td>
                                    <td>: {{ employer_name }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 mt-3 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Location of Groom</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/edit">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Country Living In</td>
                                    <td>: {{ country_living_in }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">State Living In</td>
                                    <td>: {{ state_living_in }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">City Living In</td>
                                    <td>: {{ city_living_in }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Grew Up In</td>
                                    <td>: {{ grew_up_in }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Residency Status</td>
                                    <td>: {{ residency_status }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Ethnic Origin</td>
                                    <td>: {{ ethnic_origin }}</td>
                                </tr>
                                <tr>
                                    <td class="her-per">Zip / Pin code</td>
                                    <td>: {{ zip_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <h5 class="my-3">Partner Preferences</h5>
                        <div class="shadow-sm  mb-2 p-3 bg-body rounded">
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Basic & Religion Preferences</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/partner-profile">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Age</td>
                                    <td>: {{ partner_from_age }} - {{ partner_to_age }} years</td>
                                </tr>
                                <tr>
                                    <td>Height</td>
                                    <td>: {{ partner_from_height }} - {{ partner_to_height }}"</td>
                                </tr>
                                <tr>
                                    <td>Marital Status</td>
                                    <td>:
                                        <span v-for="ms in partner_marital_status" :key="ms">{{ ms }},</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Mother Tongue </td>
                                    <td>: <span v-for="mt in partner_mother_tongue" :key="mt">{{ mt }},</span></td>
                                </tr>
                                <tr>
                                    <td>On Behalf </td>
                                    <td>: <span v-for="ob in partner_on_behalf" :key="ob">{{ ob }},</span></td>
                                </tr>
                                <tr>
                                    <td>Diet</td>
                                    <td>: <span v-for="pd in partner_diet" :key="pd">{{ pd }},</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight mt-3 color-blue-2">Education & Career</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/partner-profile">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Highest Qualification</td>
                                    <td>: <span v-for="he in partner_height_education" :key="he">{{ he }},</span></td>
                                </tr>
                                <tr>
                                    <td class="her-per">Annual Income</td>
                                    <td>: <span v-for="ai in partner_annual_income" :key="ai">{{ ai }},</span></td>
                                </tr>
                                <tr>
                                    <td class="her-per">Profession Type</td>
                                    <td>: <span v-for="pt in partner_profession_type" :key="pt">{{ pt }},</span></td>
                                </tr>
                                <tr>
                                    <td>Profession Name</td>
                                    <td>: <span v-for="pn in partner_profession_name" :key="pn">{{ pn }},</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2 mt-3">Religion</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/partner-profile">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Religion</td>
                                    <td>: <span v-for="ppr in partner_partner_religion" :key="ppr">{{ ppr }}</span></td>
                                </tr>
                                <tr>
                                    <td class="her-per">Caste / Community</td>
                                    <td>: <span v-for="ppc in partner_partner_caste" :key="ppc">{{ ppc }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2 mt-3">Location Preferences</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/partner-profile">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Country Living In</td>
                                    <td>: <span v-for="cl in partner_country_living_in" :key="cl">{{ cl }},</span></td>
                                </tr>
                                <tr>
                                    <td class="her-per">State Living In</td>
                                    <td>: <span v-for="sl in partner_state_living_in" :key="sl">{{ sl }},</span></td>
                                </tr>
                                <tr>
                                    <td class="her-per">City Living In</td>
                                    <td>: <span v-for="city in partner_city_living_in" :key="city">{{ city }},</span></td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                        <h5 class="my-3">My Contact Detail</h5>
                        <div class="shadow-sm  mb-2 p-3 bg-body rounded">
                        <div class="my-profile-title-heading d-flex mb-2 border-bottom">
                            <h5 class="w-100 bd-highlight color-blue-2">Basic & Religion Preferences</h5>
                            <div class="profile-edit flex-shrink-1"><router-link to="/my-account/contact-details">Edit</router-link></div>
                        </div>
                        <table class="table table-borderless my-table">
                            <tbody>
                                <tr>
                                    <td class="her-per">Mobile</td>
                                    <td>: {{ phone_number}}</td>
                                </tr>
                                <tr>
                                    <td>Contact Person:-</td>
                                    <td>:{{ contact_name }}</td>
                                </tr>
                                <tr>
                                    <td>Relationship with the member</td>
                                    <td>: {{ relation }}</td>
                                </tr>
                                <tr>
                                    <td>Convenient Time to Call </td>
                                    <td>: {{ time_from }} {{ from_hour }} to {{ time_to }} {{ to_hour }}</td>
                                </tr>
                                <tr>
                                    <td>Display Option</td>
                                    <td>: {{ display_setting }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    data(){
        return{
            'phone_number': null,
            'introduction': null,
            'image': null,
            'member_profile_id': null,
            'name': null,
            'age': null,
            'date_of_birth': null,
            'height': null,
            'marital_status': null,
            'on_behalf': null,
            'blood_group': null,
            'health_information': null,
            'disability': null,
            'diet': null,
            'religion': null,
            'caste': null,
            'sub_caste': null,
            'mother_language': null,
            'father_status': null,
            'mother_status': null,
            'family_location': null,
            'family_type': null,
            'family_value': null,
            'family_status': null,
            'brother': null,
            'sister': null,
            'height_education': null,
            'height_education_college_name': null,
            'profession_type': null,
            'profession_name': null,
            'employer_name': null,
            'annual_income': null,
            'country_living_in': null,
            'state_living_in' : null,
            'grew_up_in' : null,
            'city_living_in': null,
            'residency_status': null,
            'ethnic_origin': null,
            'zip_code': null,
            'partner_from_age': null,
            'partner_to_age': null,
            'partner_from_height': null,
            'partner_to_height': null,
            'partner_marital_status': null,
            'partner_having_child': null,
            'partner_mother_tongue' :null,
            'partner_partner_religion' :null,
            'partner_partner_caste' : null,
            'partner_country_living_in' : null,
            'partner_state_living_in': null,
            'partner_city_living_in' : null,
            'partner_height_education' : null,
            'partner_profession_type' : null,
            'partner_profession_name' : null,
            'partner_annual_income' : null,
            'partner_on_behalf' : null,
            'partner_diet' : null,
            'contact_name': null,
            'relation': null,
            'time_from': null,
            'from_hour': null,
            'time_to': null,
            'to_hour': null,
            'display_setting': null,
            memberId: null,
        };
    },
    mounted() {
        if (localStorage.getItem('hmWLoggedIn')) {
            let memberDetails = JSON.parse(localStorage.getItem('hmWLoggedIn'));
            this.memberId = memberDetails.member_profile_id;
        }
        this.getMemberDetails();
    },
    methods:{
        getMemberDetails(){
            axios
            .get("api/member-profile/"+this.memberId)
            .then((response) => {
                console.log(response.data);
                this.phone_number = response.data.phone_number ;
                this.introduction = response.data.introduction ;
                this.image = response.data.image ;
                this.member_profile_id = response.data.member_profile_id ;
                this.name = response.data.name ;
                this.age = response.data.age ;
                this.date_of_birth = response.data.date_of_birth ;
                this.height = response.data.height ;
                this.marital_status = response.data.marital_status ;
                this.on_behalf = response.data.on_behalf ;
                this.blood_group = response.data.blood_group ;
                this.health_information = response.data.health_information ;
                this.disability = response.data.disability ;
                this.diet = response.data.diet ;
                this.religion = response.data.religion ;
                this.caste = response.data.caste ;
                this.sub_caste = response.data.sub_caste ;
                this.mother_language = response.data.mother_language ;
                this.father_status = response.data.father_status ;
                this.mother_status = response.data.mother_status ;
                this.family_location = response.data.family_location ;
                this.family_type = response.data.family_type ;
                this.family_value = response.data.family_value ;
                this.family_status = response.data.family_status ;
                this.brother = response.data.brother ;
                this.sister = response.data.sister ;
                this.height_education = response.data.height_education ;
                this.height_education_college_name = response.data.height_education_college_name ;
                this.profession_type = response.data.profession_type ;
                this.profession_name = response.data.profession_name ;
                this.employer_name = response.data.employer_name ;
                this.annual_income = response.data.annual_income ;
                this.country_living_in = response.data.country_living_in ;
                this.state_living_in = response.data.state_living_in ;
                this.grew_up_in = response.data.grew_up_in ;
                this.city_living_in = response.data.city_living_in ;
                this.residency_status = response.data.residency_status ;
                this.ethnic_origin = response.data.ethnic_origin ;
                this.zip_code = response.data.zip_code ;
                this.partner_from_age = response.data.partner_from_age ;
                this.partner_to_age = response.data.partner_to_age ;
                this.partner_from_height = response.data.partner_from_height ;
                this.partner_to_height = response.data.partner_to_height ;
                this.partner_marital_status = response.data.partner_marital_status ;
                this.partner_having_child = response.data.partner_having_child ;
                this.partner_mother_tongue = response.data.partner_mother_tongue ;
                this.partner_partner_religion = response.data.partner_partner_religion ;
                this.partner_partner_caste = response.data.partner_partner_caste ;
                this.partner_country_living_in = response.data.partner_country_living_in ;
                this.partner_state_living_in = response.data.partner_state_living_in ;
                this.partner_city_living_in = response.data.partner_city_living_in ;
                this.partner_height_education = response.data.partner_height_education ;
                this.partner_profession_type = response.data.partner_profession_type ;
                this.partner_profession_name = response.data.partner_profession_name;
                this.partner_annual_income = response.data.partner_annual_income ;
                this.partner_on_behalf = response.data.partner_on_behalf ;
                this.partner_diet = response.data.partner_diet ;
                this.contact_name = response.data.contact_name ;
                this.relation = response.data.relation ;
                this.time_from = response.data.time_from ;
                this.from_hour = response.data.from_hour ;
                this.time_to = response.data.time_to ;
                this.to_hour = response.data.to_hour ;
                this.display_setting = response.data.display_setting ;
            })
            .catch((error) => {
                console.log(error);
            });
        },
    },
}
</script>