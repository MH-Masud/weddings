<template>
    <div>
        <Header/>
        <div class="profile-main">
            <div class="container py-5">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="shadow-sm p-3  mb-2 bg-body rounded support-link-color">
                        <div class="save-metrimonials mb-5">
                            <img src="/assets/frontend/img/slider-1.jpg">
                        </div>
                        <h5><u>Why Safe Matrimony?</u></h5>
                        <p>Today, millions use online matrimony services to search for a life partner and millions have successfully found their life partner online. There have been a few instances reported in the media about fraudsters cheating some people on online matrimony sites. While we take every possible step to make your search on our site safe, we strongly recommend you to be aware and follow a few guidelines during this journey. Safe Matrimony is our initiative to guide you to a safe search.</p>
                        <h2 class="text-center mt-5" style="color: #1285bd;">Frequently Asked Questions</h2>
                        <div class="ask-meet">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq1">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                    What is hmwedding Meet?
                                    </button>
                                    </h2>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="faq1" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">hmwedding Meet is a video calling feature for premium members. With the tap of a button, you can now video meet your match.</div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne22" aria-expanded="false" aria-controls="flush-collapseOne22">
                                    Is hmwedding Meet a Paid feature?
                                    </button>
                                    </h2>
                                    <div id="flush-collapseOne22" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">You can receive incoming calls through hmwedding Meet for Free. However, if you want to start a call, you need to be a Paid Member.</div>
                                    </div>
                                </div>



                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq3">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                    How does it work? 
                                    </button>
                                    </h2>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">In your hmwedding Chat, you will see blue colored video thumbnails next to the names of your matches, that indicate which matches are available for a video call. Click on the name of the match you wish to call. Inside the Chat window, on the top right you will find a video icon with a green dot. Click on that to start a video call.</div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="faq4">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                    I am on Android and a premium member, I don't see any hmwedding Meet feature?
                                    </button>
                                    </h2>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">You might be using the old app version. All you need to do is update your app and you should start seeing the video calling feature in hmwedding Chat. </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        Footer,
    },
}
</script>