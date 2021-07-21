<template>
    <div>
        <Header/>
        <div class="profile-main">
            <div class="container my-sm-5">
                <div class="row">
                    <div class="col-md-12 about-top">
                        <div class="border p-3 shadow-sm  text-center" style="   background: linear-gradient(to top left, #12bd85 0%, #086a45 100%); color:#fff;">
                            <h4>Contact Us</h4>
                            <p>We always love to hear from our customers! We are happy to answer your questions and assist you</p>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="border p-2 shadow-sm bg-body about-height">
                            <div id="contact" class="contact py-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="info-box mb-4 text-center"> <i class="fas fa-map-marker-alt"></i>
                                                <h3>Our Address</h3>
                                                <p class="text-center">Twin Brooks, House No-08, Road: 2B, Block: J
                                                    <br> level: 2, Flat B2 Baridhara, Vatara Gulshan 2 Dhaka 1212</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="info-box  mb-4"> <i class="fas fa-envelope"></i>
                                                <h3>Email Us</h3>
                                                <p class="text-center">hmexpoprivateltd@gmail.com
                                                    <br>hmltdbd@gmail.com</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-6">
                                            <div class="info-box  mb-4"> <i class="fas fa-phone-alt"></i>
                                                <h3>Call Us</h3>
                                                <p class="text-center">+8801711353034, +8801775281033
                                                    <br>+8801310588491</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                                                <div class="row">
                                                    <div class="col-md-6 col-12 form-group">
                                                        <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required> </div>
                                                    <div class="col-md-6 col-12 form-group">
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required> </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required> </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                                </div>
                                                <div class="my-3">
                                                    <div class="loading">Loading</div>
                                                    <div class="error-message"></div>
                                                    <div class="sent-message">Your message has been sent. Thank you!</div>
                                                </div>
                                                <div class="mb-3">
                                                    <button class="btn btn-blue2" type="submit">Send Message</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-4 ">
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14602.270445544722!2d90.42194549871795!3d23.798406906101015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7b97d7c8ef3%3A0xe504b80311272e0c!2sHM%20Expo%20Private%20Limited!5e0!3m2!1sen!2sbd!4v1616569400452!5m2!1sen!2sbd" width="100%" height="280" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
        Footer
    },
}
</script>