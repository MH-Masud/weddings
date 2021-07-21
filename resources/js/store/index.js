import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    memberProfileInfo: null,
    memberToken: null,
    companyName: null,
    companyEmail: null,
    companyPhone: null,
    companyLogo: null,
    companyAddress: null,
    sliders: null,
    howWeWork:null,
    premiumMembers: [],
    happyStories: [],
    sideMenus: null,
    followUs: null,
    footerLinks: null,
    desktopPayWithImage: null,
    mobilePayWithImage: null,

    onBehalf: [],
    countries: [],
    maritalStatus: [],
    religions: [],
    languages: [],
    familyValues: [],
    familyStatus: [],
    educations: [],
    occupations: [],
    incomes: [],

    activeMenu: 'home',
  },
  mutations: {
    SET_MENU(state,payload){
      state.activeMenu = payload;
    },
    SET_MEMBER_PROFILE_INFO(state,payload){
      state.memberProfileInfo = payload;
    },
    SET_TOKEN(state, payload) {
        state.memberToken = payload;
    },
    SET_FOLLOWS(state,payload){
      state.followUs = payload;
    },
    SET_SLIDER(state,payload){
      state.sliders = payload
    },
    SET_COMPANY_INFO(state,payload){
      state.companyLogo = JSON.parse(payload.logo)[0].image;
      state.companyName = payload.name;
      state.companyEmail = payload.email.split(",");
      state.companyPhone = payload.phone.split(",");
      state.companyAddress = payload.address;
    },
    SET_SIDE_MENU(state,payload){
      state.sideMenus = payload;
    },
    SET_HOW_WE_WORK(state,payload){
      state.howWeWork = payload;
    },
    SET_PREMIUM_MEMBERS(state,payload){
      state.premiumMembers = payload;
    },
    SET_HAPPY_STORY(state,payload){
      state.happyStories = payload;
    },
    SET_FOOTER_LINKS(state,payload){
      state.footerLinks = payload;
    },
    SET_PAY_WITH(state,payload){
      state.desktopPayWithImage = JSON.parse(
          payload.desktop_image
      )[0].image;
      state.mobilePayWithImage = JSON.parse(
          payload.mobile_image
      )[0].image;
    },
    SET_ON_BEHALF(state,payload){
      state.onBehalf = payload;
    },
    SET_COUNTRY(state,payload){
      state.countries = payload;
    },
    SET_MARITAL_STATUS(state,payload){
      state.maritalStatus = payload;
    },
    SET_RELIGION(state,payload){
      state.religions = payload;
    },
    SET_LANGUAGE(state,payload){
      state.languages = payload;
    },
    SET_FAMILY_VALUE(state,payload){
      state.familyValues = payload;
    },
    SET_FAMILY_STATUS(state,payload){
      state.familyStatus = payload
    },
    SET_EDUCATION(state,payload){
      state.educations = payload
    },
    SET_OCCUPATION(state,payload){
      state.occupations = payload
    },
    SET_INCOME(state,payload){
      state.incomes = payload
    },
  },
  actions:{
    getCompanyInformation({commit,state}){
      if (!state.companyName) {
        axios
          .get("api/company-info")
          .then((response) => {
            let company = response.data;
            commit('SET_COMPANY_INFO',company);
          })
          .catch((error) => {
              console.log(error);
          });
      }
    },
    getSlider: function({commit,state}){
        if (!state.sliders) {
          axios
            .get('api/slider')
            .then(response => {
                let sliders = response.data;
                commit('SET_SLIDER',sliders);
            })
            .catch(error => {
                console.log(error)
            })
        } else {
          commit('SET_SLIDER',state.sliders);
        }
    },
    getHowWeWork:function({commit,state}){
      if (!state.howWeWork) {
        axios
          .get("api/how-work")
          .then((response) => {
            let how_We_Work = response.data;
            commit('SET_HOW_WE_WORK',how_We_Work);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        commit('SET_HOW_WE_WORK',state.howWeWork);
      }
    },
    getSlideMenu: function({commit,state}){
      if (!state.sideMenus) {
        axios
          .get("api/side-menu")
          .then((response) => {
            let side_menu = response.data;
            commit('SET_SIDE_MENU',side_menu);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        commit('SET_SIDE_MENU',state.sideMenus);
      }
    },
    getPremiumMember: function({commit,state}){
      if (state.premiumMembers.length > 0) {
        commit('SET_PREMIUM_MEMBERS',state.premiumMembers);
      } else {
        axios
          .get('api/premium-member')
          .then(response => {
              let premium_members = response.data
              commit('SET_PREMIUM_MEMBERS',premium_members);
          })
          .catch(error => {
              console.log(error)
          })
      }
    },
    getHappyStory: function({commit,state}){
      if (state.happyStories.length > 0) {
        commit('SET_HAPPY_STORY',state.happyStories);
      } else {
        axios
          .get('api/happy-story')
          .then(response => {
              let happy_stories = response.data
              commit('SET_HAPPY_STORY',happy_stories);
          })
          .catch(error => {
              console.log(error)
          })
        
      }
    },
    getFollowUsList({commit,state}){
      if (!state.followUs) {
        axios
        .get("api/follow-us")
        .then((response) => {
          let follows = response.data;
          commit('SET_FOLLOWS',follows);
        })
        .catch((error) => {
          console.log(error);
        });
      }else{
        commit('SET_FOLLOWS',state.followUs);
      }
    },
    getFooterLink: function({commit,state}){
      if (!state.footerLinks) {
        axios
          .get("api/footer-link")
          .then((response) => {
            let footer_links = response.data;
            commit('SET_FOOTER_LINKS',footer_links);
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        commit('SET_FOOTER_LINKS',state.footerLinks);
      }
    },
    getPayWith: function({commit,state}){
      if (!state.desktopPayWithImage) {
        axios
          .get("/api/pay-with")
          .then((response) => {
            let payWith = response.data;
            commit('SET_PAY_WITH',payWith);
          })
          .catch((error) => {
              console.log(error);
          });
      }
    },
    getOnBehalf: function({commit,state}){
      if (state.onBehalf.length > 0) {
        commit('SET_ON_BEHALF',state.onBehalf);
        
      } else {
        axios
        .get('api/on-behalf')
        .then(response => {
          let behalf = response.data
          commit('SET_ON_BEHALF',behalf);
        })
        .catch(error => {
            console.log(error)
        })
        axios
      }
    },
    getCountry: function({commit,state}){
      if (state.countries.length > 0) {
        commit('SET_COUNTRY',state.countries)
      } else {
        axios
        .get('api/country-list')
        .then(response => {
          let country = response.data;
          commit('SET_COUNTRY',country);
        })
        .catch(error => {
            console.log(error)
        })
      }
    },
    getMaritalStatus: function({commit,state}){
      if (state.maritalStatus.length > 0) {
        commit('SET_MARITAL_STATUS',state.maritalStatus)
        
      } else {
        axios
          .get("api/marital-status/")
          .then((response) => {
            let married = response.data;
            commit('SET_MARITAL_STATUS', married);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getReligion: function({commit,state}){
      if (state.religions.length > 0) {
        commit('SET_RELIGION',state.religions)
      } else {
        axios
          .get("api/religion/")
          .then((response) => {
            let religion = response.data;
            commit('SET_RELIGION',religion);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getLanguage: function({commit,state}){
      if (state.languages.length > 0) {
        commit('SET_LANGUAGE',state.languages)
      } else {
        axios
          .get("api/language/")
          .then((response) => {
            let languageList = response.data;
            commit('SET_LANGUAGE',languageList);
          })
          .catch((error) => {
              console.log(error);
          });
      }
    },
    getFamilyValue: function({commit,state}){
      if (state.familyValues.length > 0) {
        commit('SET_FAMILY_VALUE',state.familyValues)
      } else {
        axios
          .get("api/family-value/")
          .then((response) => {
            let family_value = response.data;
            commit('SET_FAMILY_VALUE',family_value);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getFamilyStatus: function({commit,state}){
      if (state.familyStatus.length > 0) {
        commit('SET_FAMILY_STATUS',state.familyStatus)
      } else {
        axios
          .get("api/family-status/")
          .then((response) => {
            let family_status = response.data;
            commit('SET_FAMILY_STATUS',family_status)
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getEducation: function({commit,state}){
      if (state.educations.length > 0) {
        commit('SET_EDUCATION',state.educations)
      } else {
        axios
          .get("api/education/")
          .then((response) => {
            let education = response.data;
            commit('SET_EDUCATION',education);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getOccupation: function({commit,state}){
      if (state.occupations.length > 0) {
        commit('SET_OCCUPATION',state.occupations)
      } else {
        axios
          .get("api/occupation/")
          .then((response) => {
            let occupation = response.data;
            commit('SET_OCCUPATION',occupation);
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    getIncomes: function({commit,state}){
      if (state.incomes.length > 0) {
        commit('SET_INCOME',state.incomes)
      } else {
        axios
          .get("api/income/")
          .then((response) => {
            let income = response.data;
            commit('SET_INCOME',income)
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  }
})

export default store;