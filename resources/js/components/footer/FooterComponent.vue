<template>
  <div>
    <footer id="footer">
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div
              class="col-lg-3 col-md-6 col-6 footer-links"
              v-for="footerLink in footerLinks"
              :key="footerLink.id"
            >
              <h4>{{ footerLink.name }}</h4>
              <ul class="expandible">
                <li
                  v-for="childFooter in footerLink.child"
                  :key="childFooter.id"
                >
                  <router-link :to="'/'+childFooter.slug">
                    {{ childFooter.name }}</router-link
                  >
                </li>
              </ul>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 col-12">
              <h4 class="mt-4">Follow Us on</h4>
              <div class="social-linkd mt-3">
                <a
                  v-for="follow in followUs"
                  :key="follow.id"
                  :href="follow.link"
                >
                  <img
                    :src="
                      '/uploads/follow_image/' +
                      JSON.parse(follow.image)[0].image
                    "
                    width="32"
                    height="32"
                  />
                </a>
              </div>
            </div>
            <div class="col-md-9">
              <h4 class="mt-4">Pay With</h4>
              <div class="payment-icon" v-if="mobilePayWithImage">
                <img
                  :src="'/uploads/payment_option_image/'+mobilePayWithImage"
                  class="img-fluid"
                />
              </div>
              <div class="payment-icon-2" v-if="desktopPayWithImage">
                <img
                  :src="'/uploads/payment_option_image/'+desktopPayWithImage"
                  class="img-fluid"
                />
              </div>
            </div>
            <div class="col-md-12">
              <p class="text-center mt-5">
                <strong>Address:</strong>
                {{ companyAddress }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="container py-2">
        <div class="row">
          <div class="col-md-6">
            <div class="copyright">
              Copyright © 2020-2021, HM WEDDINGS. All Rights Reserved
            </div>
          </div>
          <div class="col-md-6">
            <div class="Development copyright">
              Design & Development :<a href=""> <b>HM Expo Private Ltd</b></a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import {mapState} from 'vuex';
export default {
  props:{
    address: String
  },
  data: function () {
    return {
    };
  },
  mounted() {
    this.$store.dispatch('getFooterLink');
    this.$store.dispatch('getFollowUsList');
    this.$store.dispatch('getPayWith');
  },
  computed: {
    ...mapState([
      'companyName',
      'companyEmail',
      'companyPhone',
      'companyLogo',
      'companyAddress',
      'footerLinks',
      'followUs',
      'mobilePayWithImage',
      'desktopPayWithImage',
    ])
  },
};
</script>