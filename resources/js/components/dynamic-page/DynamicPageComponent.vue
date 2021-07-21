<template>
    <div>
        <Header></Header>
        <div class="profile-main">
            <div class="container py-3 py-sm-5">
                <div class="row" v-if="pageContent">
                    <div class="col-md-12">
                    <div class="border p-2 p-sm-3 shadow-sm  text-center" style="   background: linear-gradient(to top left, #12bd85 0%, #086a45 100%); color:#fff;">
                        <h4>{{ pageContent.name }}</h4>
                        <p>{{ pageContent.short_description }}</p>
                    </div>
                    </div>
                    <div class="col-md-12">
                    <div class="border p-4 shadow-sm bg-body  about-height" v-html="pageContent.long_description">
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
            pageContent: null,
        }
    },
    mounted() {
        this.getDynamicPageContent();
    },
    watch: {
        $route () { 
            this.getDynamicPageContent()
        }
    },
    methods: {
        getDynamicPageContent:function(){
            axios
            .get("api/dynamic-page/"+this.$route.params.id)
            .then((response) => {
                this.pageContent = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
        }
    },
}
</script>