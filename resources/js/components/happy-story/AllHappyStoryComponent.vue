<template>
  <div>
    <Header />
    <div class="profile-main">
      <div class="container">
        <div class="row mt-sm-5 mb-5">
          <div class="col-md-10 offset-md-1">
            <div class="shadow-sm bg-body">
              <div class="happy-story-nav">
                <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                      Featured success stories
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="your-story.html">
                      Post Your Success Story</a
                    >
                  </li>
                </ul>
              </div>
            </div>
            <div class="text-center mt-5">
              <h4>Welcome to Hmwedding Pride.</h4>
              <p>This is where we celebrate Hmwedding.com Success Stories.</p>
            </div>
            <div class="">
              <div class="row">
                <div class="col-md-4" v-for="story in happyStories" :key="story.id">
                  <div class="border p-3 mb-3 shadow-sm bg-body rounded">
                    <div class="success-profile-imgss mt-2">
                      <h5>{{ story.title }}</h5>
                      <div class="all-success-date mb-3">
                        <img
                          src="/assets/frontend/img/calendar.png"
                          width="16"
                          height="16"
                        /><span class="md-2">27 September 2020</span>
                      </div>
                      <div class="story-card">
                        <div class="story-card-img-wrap">
                          <router-link :to="'happy-story/'+story.id" class="story-card-img">
                            <img
                              :src="'/uploads/happy_story_image/'+JSON.parse(story.image1)[0].image"
                              :alt="story.title"
                              :title="story.title"
                              class="image"
                            />
                          </router-link>
                        </div>
                      </div>
                      <p class="mt-2">
                        {{ story.description }}
                      </p>
                      <router-link
                        :to="'happy-story/'+story.id"
                        type="button"
                        class="btn btn-blue btn-sm"
                        >Read More</router-link
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import Header from "../home/HomeHeaderComponent.vue";
import Footer from "../footer/FooterComponent.vue";
export default {
  components: {
    Header,
    Footer,
  },
  data() {
    return {
      happyStories: null,
    };
  },
  mounted() {
    this.happyStoryList();
  },
  methods: {
    happyStoryList: function () {
      /** Happy Story */
      axios
        .get("/api/happy-story-list")
        .then((response) => {
          this.happyStories = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>