<template>
    <div>
        <Header/>
        <div class="profile-main">
            <div class="container py-5">
                <div class="row ">
                <div class="col-md-12">
                    <h4 class="text-center">Premium Plans</h4>
                    <div class="price-table" v-for="plan in plans" :key="plan.id">
                        <ul class="price text-center p-2">
                            <img :src="'/uploads/plan_image/'+JSON.parse(plan.image)[0].image" alt="" width="60" height="60">
                            <li class="header">{{ plan.name }} <span class="price-month">{{ (plan.package_duration / 30) >= 12 ? ((plan.package_duration / 30) / 12 )+' Year' : (plan.package_duration / 30 == 0) ? 'Free' : (plan.package_duration / 30)+' Month' }}</span></li>
                            <li class="grey">BDT {{ plan.amount }}</li>
                            <li>Send unlimited Messages</li>
                            <li>Express Interest: {{ plan.express_interest }}</li>
                            <li>Direct Messages {{ plan.express_interest }}</li>
                            <li>Photo Gallery {{ plan.photo_gallery }}</li>
                            <li class="grey"><router-link :to="'/checkout/'+plan.id" class="button">Continue</router-link></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
        </div>
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
    data(){
        return{
            plans: null,
        }
    },
    mounted(){
        this.getPlans();
    },
    methods:{
        getPlans: function () {
        /** Premium Plans */
        axios
            .get("/api/premium-plan")
            .then((response) => {
                this.plans = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
        },
    }
}
</script>