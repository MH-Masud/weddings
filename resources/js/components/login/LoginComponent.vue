<template>
    <div>
        <HomeHeader></HomeHeader>
        <section id="register-title" style="background-color:#f1f1f2;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 offset-md-4 mt-5">
                        <h6 class="text-center mb-3"><strong>Welcome To HM Weddings! Login Here</strong></h6>
                        <div class="register hadow-sm p-4  mb-2 bg-body shadow-sm">
                        <div class="login">
                            <form id="appLoginForm" @submit="checkForm" novalidate="true">
                                <div class="mb-3">
                                    <input type="email" class="form-control" v-model="email"  aria-describedby="emailHelp" placeholder="Email or Phone">
                                    <span class="text-danger">{{ emailError }}</span>
                                </div>
                                <div class="mb-2">
                                    <input type="password" class="form-control" v-model="password" placeholder="Password">
                                    <span class="text-danger">{{ passwordError }}</span>
                                </div>
                                <div class="row">
                                    <div class="col">
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" v-model="rememberme">
                                        <label class="form-check-label" for="rememberme">Remember Me</label>
                                    </div>
                                    </div>
                                    <div class="col" style="text-align: right;"><router-link to="/app-forgot-password" >Forgot Password?</router-link></div>
                                </div>
                                <p class="text-danger" style="text-align: center;"><strong>{{ inValidLogin }}</strong></p>
                                <div class="d-grid gap-2 mb-3">
                                    <button class="btn btn-secondary" type="submit">Login</button>
                                </div>
                                <p style="text-align: center;"><router-link to="/app-registration">Create a new account</router-link></p>
                            </form>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br><br>
        <Footer/>
    </div>
</template>
<script>
import HomeHeader from '../home/HomeHeaderComponent.vue'
import Footer from '../footer/FooterComponent.vue'
import {mapState} from 'vuex'

export default {
    components:{
        HomeHeader,
        Footer
    },
    data: function() {
        return  {
            rememberme: null,
            email: null,
            password: null,
            emailError: null,
            passwordError: null,
            inValidLogin: null,
        }
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
    methods:{
        checkForm: function(e) {
            e.preventDefault();
            if (this.password && this.email) {
                this.passwordError = '';
                this.emailError = '';
                axios
                .post('api/app-login',{
                    email: this.email,
                    password: this.password,
                    rememberme: this.rememberme,
                })
                .then(response => {
                    if (response.data == false) {
                        this.inValidLogin = 'Invalid credentials ! Try again.'
                    } else {
                        // console.log(response.data);
                        this.inValidLogin = '';
                        let memberDetail = response.data;
                        this.$store.commit('SET_TOKEN', memberDetail.member_profile_id);
                        this.$store.commit('SET_MEMBER_PROFILE_INFO', memberDetail);
                        localStorage.setItem('hmWLoggedIn',JSON.stringify(memberDetail));
                        this.$router.push('/my-account/my-match')
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            } else {
                if (!this.password) {
                    this.passwordError = "Enter valid password.";
                }else{
                    this.passwordError = '';
                }
                if (!this.email) {
                    this.emailError = 'Enter valid Email or Phone No.';
                }else{
                    this.emailError = '';
                }
            }
            
        }
    }
}
</script>