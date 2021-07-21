<template>
    <div>
        <Header></Header>
        <div class="profile-main">
            <div class="container">
                <div class="row my-sm-5">
                    <div class="col-md-10 offset-md-1">
                        <div class="shadow-sm p-3 mb-2 bg-body rounded">
                            <div class="row mt-3">
                                <div class="col-md-5">
                                    <div class="success-date"><img :src="'/uploads/happy_story_image/'+JSON.parse(happyStoryInfo.image1)[0].image" class="img-fluid" /><br><span>Posted On: 27 September 2020</span></div>
                                </div>
                                <div class="col-md-7">
                                    <h4>{{ happyStoryInfo.title }}</h4>
                                    <p>
                                        {{ happyStoryInfo.description }}
                                    </p>
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
import Header from '../home/HomeHeaderComponent.vue'
import Footer from '../footer/FooterComponent.vue'
export default {
    components:{
        Header,
        Footer
    },
    data() {
        return {
            happyStoryInfo: null,
            happyStoryId: null,
        };
    },
    mounted() {
        this.happyStoryId = this.$route.params.id;
        this.happyStoryDetail();
    },
    methods: {
        happyStoryDetail: function () {
        /** Happy Story */
        axios
            .get("api/happy-story-detail/"+this.happyStoryId)
            .then((response) => {
                this.happyStoryInfo = response.data;
                console.log(this.happyStoryInfo);
            })
            .catch((error) => {
                console.log(error);
            });
        },
    },
}
</script>