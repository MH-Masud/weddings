<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <Footer></Footer>
  </div>
</template>

<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import "../../../axios/index";

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data() {
    return {
    };
  },
  mounted() {
  },
  methods: {
  },
};
</script>