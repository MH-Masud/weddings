<template>
  <div>
    <Header />
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <!-- mobile chat box -->
        <div
          class="
            mobile-version-chat
            chat-box
            shadow-sm
            mb-2
            p-3
            bg-body
            rounded
          "
        >
          <div action="" class="form-containers">
            <a
              class="opend-button"
              onclick="openFormss()"
              style="cursor: pointer"
            >
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="fas fa-circle"></i></div>
              </div>
            </a>
            <a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="fas fa-circle"></i></div>
              </div>
            </a>
            <a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="far fa-circle"></i></div>
              </div> </a
            ><a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="far fa-circle"></i></div>
              </div> </a
            ><a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="far fa-circle"></i></div>
              </div>
            </a>
            <a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="far fa-circle"></i></div>
              </div>
            </a>
            <a href="">
              <div class="d-flex p-1 chat-head">
                <div class="chat-image">
                  <img src="/assets/frontend/img/testimonials-4.jpg" class="border" />
                </div>
                <div class="chat-name align-self-center">Abjul Jalil</div>
                <div class="ms-auto"><i class="far fa-circle"></i></div>
              </div>
            </a>
          </div>
        </div>

        <!-- end chat box -->
      </div>
    </div>

    <!-- Chatting box -->
    <Footer />
  </div>
</template>
<script>
import Header from "../member-account/MemberAccountHeaderComponent.vue";
import Footer from "../footer/FooterComponent.vue";
export default {
  components: {
    Header,
    Footer,
  },
};
</script>