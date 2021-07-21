<template>
    <div>
        <MemberAccountHeader></MemberAccountHeader>
        <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
                <div class="row">
                <div class="col-md-3 mb-3 d-none d-sm-block">
                    <h6>Quick Links</h6>
                    <div class="list-group">
                        <a href="match-list.php" class="list-group-item list-group-item-action list-group-item-light">   New Matches</a>
                        <a href="my-matches.php" class="list-group-item list-group-item-action list-group-item-light">My Matches</a>
                        <a href="near-matches.php" class="list-group-item list-group-item-action list-group-item-light">Near Me</a>
                        <a href="near-matches.php" class="list-group-item list-group-item-action list-group-item-light">My Saved Searches</a>
                        <a href="#" class="list-group-item list-group-item-action list-group-item-light">Shortlists & more</a>
                        <a href="#" class="list-group-item list-group-item-action list-group-item-light">My Help</a>
                    </div>
                    <div class="sidebar-matches shadow-sm mt-3 p-3 bg-body rounded">
                        <h5>Search by ID</h5>
                        <div class="input-group">
                            <form class="search-bar" action="/action_page.php">
                            <input type="text" placeholder="Enter Profile ID" name="search">
                            <button type="submit"><img src="assets/img/search.png" height="15" width="15"></button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <h6> Thank You </h6>
                    <div class="shadow-sm  mb-2 p-3 bg-body rounded partner-profiles">
                        <div class="p-2">
                            <p>{{ memberName }}</p>
                            <p>Your email has been updated.</p>
                            <p><router-link to="/my-account/account-settings">Click here</router-link> to view your updated profile.<br>
                            We also recommend you to edit your Partner Preferences accordingly & find the right Matches 
                            </p>
                            <p><router-link to="/my-account/partner-profile">Edit Partner Preferences</router-link></p>
                            <p>
                            Good luck for your partner search! 
                            </p>
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
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
export default {
    components: {
        MemberAccountHeader,
        Footer,
    },
    data(){
        return{
            memberName: null,
        }
    },
    mounted(){
        this.memberName = localStorage.getItem('memberName');
    }
}
</script>