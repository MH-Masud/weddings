import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
import store from '../store/index';
import Home from '../components/home/HomeComponent.vue';
import MyAccount from '../components/member-account/my-account/MyAccountComponent.vue';
import EditMyAccount from '../components/member-account/edit/EditMyAccountComponent.vue';
import AppLogin from '../components/login/LoginComponent.vue';
import AppRegistration from '../components/registration/RegistrationComponent.vue';
import AppRegisterNext from '../components/registration/RegisterNextComponent.vue';
import ContactUs from '../components/contact-us/ContactUsComponent.vue';
import AboutUs from '../components/about-us/AboutUsComponent.vue';
import AllHappyStory from '../components/happy-story/AllHappyStoryComponent.vue';
import SingleHappyStory from '../components/happy-story/SingleHappyStoryComponent.vue';
import PremiumPlan from '../components/plan/PremiumPlanComponent.vue';
import TermCondition from '../components/term-condition/TermConditionComponent.vue';
import PrivacyPolicy from '../components/privacy-policy/PrivacyPolicyComponent.vue';
import HelpComponent from '../components/help/HelpComponent.vue';
import AdvanceSearch from '../components/advance-search/AdvanceSearchComponent.vue';
import BlogList from '../components/blog/BlogListComponent.vue';
import BlogDetail from '../components/blog/BlogDetailComponent';
import SearchResult from '../components/advance-search/SearchResultComponent.vue';
import EditSuccess from '../components/member-account/edit/EditSuccessComponent.vue';
import PartnerProfile from '../components/member-account/partner-profile/PartnerProfileComponent.vue';
import MyProfile from '../components/member-account/my-profile/MyProfileComponent.vue';
import AddPhoto from '../components/member-account/add-photo/AddPhotoComponent.vue';
import Order from '../components/member-account/order/OrderComponent.vue';
import ContactDetails from '../components/member-account/contact-details/ContactDetailsComponent.vue';
import AccountSettings from '../components/member-account/settings/AccountSettingsComponent.vue';
import ContactFilters from '../components/member-account/settings/ContactFiltersComponent.vue';
import Hobby from '../components/member-account/hobby/HobbyComponent.vue';
import PasswordSuccess from '../components/member-account/settings/PasswordSuccessComponent';
import PasswordFailed from '../components/member-account/settings/PasswordFailComponent.vue';
import EmailSuccess from '../components/member-account/settings/EmailSuccessComponent';
import EmailFailed from '../components/member-account/settings/EmailFailComponent.vue';
import AdvancedSearch from '../components/member-account/advanced-search/AdvancedSearchComponent.vue';
import AdvancedSearchResult from '../components/member-account/advanced-search/AdvancedSearchResultComponent.vue';
import ViewProfile from '../components/member-account/view-profile/ViewProfileComponent.vue';
import RegularSearch from '../components/member-account/regular-search/RegularSearchComponent.vue';
import ProfileSearchResult from '../components/member-account/search-result/SearchResultComponent.vue';
import Invitation from '../components/inbox/invitation/InvitationComponent.vue';
import SentRequest from '../components/inbox/sent-request/SentRequestComponent.vue';
import AcceptRequest from '../components/inbox/accept-request/AcceptRequestComponent.vue';
import PendingRequest from '../components/inbox/request/RequestComponent.vue';
import DeclinedRequest from '../components/inbox/declined-request/DeclinedRequestComponent.vue';
import NewMatch from '../components/matches/NewMatchComponent.vue';
import TodayMatch from '../components/matches/TodayMatchComponent.vue';
import MyMatch from '../components/matches/MyMatchComponent.vue';
import PremiumMatch from '../components/matches/PremiumMatchComponent.vue';
import Shortlisted from '../components/matches/ShortlistedComponent.vue';
import NearMe from '../components/matches/NearMeComponent.vue';
import RecentVisitor from '../components/matches/RecentVisitorComponent.vue';
import RecentlyViewed from '../components/matches/RecentlyViewedComponent.vue';
import Checkout from '../components/checkout/CheckoutComponent.vue';
import Chat from '../components/chat/ChatComponent.vue';
import DynamicPage from '../components/dynamic-page/DynamicPageComponent.vue';

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
        },
        {
            path: '/checkout/:id',
            component: Checkout,
        },
        {
            path: '/my-account',
            component: MyAccount,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/chat',
            component: Chat,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/my-profile',
            component: MyProfile,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/edit',
            component: EditMyAccount,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/partner-profile',
            component: PartnerProfile,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/photo',
            component: AddPhoto,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/order',
            component: Order,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/contact-details',
            component: ContactDetails,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/account-settings',
            component: AccountSettings,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/settings/privacy-options',
            component: AccountSettings,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/settings/hide-delete-profile',
            component: AccountSettings,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/password-success',
            component: PasswordSuccess,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/password-fail',
            component: PasswordFailed,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/email-success',
            component: EmailSuccess,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/email-fail',
            component: EmailFailed,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/contact-filters',
            component: ContactFilters,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/hobby',
            component: Hobby,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/edit-success',
            component: EditSuccess,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/edit-failed',
            component: EditSuccess,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/advanced-search',
            component: AdvancedSearch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/advanced-search-result',
            component: AdvancedSearchResult,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/view-profile/:id/',
            component: ViewProfile,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/regular-search',
            component: RegularSearch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/search-result',
            component: ProfileSearchResult,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/invitations',
            component: Invitation,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/sent-request',
            component: SentRequest,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/accept-request',
            component: AcceptRequest,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/pending-request',
            component: PendingRequest,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/declined-request',
            component: DeclinedRequest,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/new-match',
            component: NewMatch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/today-match',
            component: TodayMatch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/my-match',
            component: MyMatch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/premium-match',
            component: PremiumMatch,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/shortlisted',
            component: Shortlisted,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/near-me',
            component: NearMe,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/recent-visitor',
            component: RecentVisitor,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/my-account/recent-view',
            component: RecentlyViewed,
            meta: {
                requiresAuth: true,
            },
        },
        {
            path: '/app-login',
            component: AppLogin,
            meta: {
                requiresAuthCheck: true,
            }
        },
        {
            path: '/app-registration',
            component: AppRegistration,
            meta: {
                requiresAuthCheck: true,
            }
        },
        {
            path: '/app-forgot-password',
            component: MyAccount,
        },
        {
            path: '/contact-us',
            component: ContactUs,
        },
        {
            path: '/about-us',
            component: AboutUs,
        },
        {
            path: '/happy-story',
            component: AllHappyStory,
        },
        {
            path: '/happy-story/:id',
            component: SingleHappyStory,
        },
        {
            path: '/premium-plan',
            component: PremiumPlan,
        },
        {
            path: '/term-of-uses',
            component: TermCondition,
        },
        {
            path: '/privacy-policy',
            component: PrivacyPolicy,
        },
        {
            path: '/help',
            component: HelpComponent,
        },
        {
            path: '/advance-search',
            component: AdvanceSearch,
        },
        {
            path: '/search-result',
            name: 'search',
            component: SearchResult,
        },
        {
            path: '/blog',
            component: BlogList,
        },
        {
            path: '/blog/:id',
            component: BlogDetail,
        },

        //Footer links
        {
            path: '/page/:id',
            component: DynamicPage,
        },
        
    ]
});

routes.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
      if (store.state.memberToken || localStorage.getItem('hmWLoggedIn')) {
        next()
      } else {
        next('/app-login')
      }
    } else {
      next()
    }
});

routes.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuthCheck)) {
      if (store.state.memberToken || localStorage.getItem('hmWLoggedIn')) {
        next('/my-account/my-match')
      } else {
        next()
      }
    } else {
      next()
    }
});

export default routes;