<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
            <div class="row">
               <div class="col-md-10 offset-md-1">
                  <div class="row">
                     <div class="col-md-3 mb-3">
                        <h6>Quick Links</h6>
                        <div class="list-group">
                           <a href="match-list.php" class="list-group-item list-group-item-action list-group-item-light">   New Matches</a>
                           <a href="my-matches.php" class="list-group-item list-group-item-action list-group-item-light">My Matches</a>
                           <a href="near-matches.php" class="list-group-item list-group-item-action list-group-item-light">Near Me</a>
                           <a href="near-matches.php" class="list-group-item list-group-item-action list-group-item-light">My Saved Searches</a>
                           <a href="near-matches.php" class="list-group-item list-group-item-action list-group-item-light">Shortlists & more</a>
                           <a href="support.php" class="list-group-item list-group-item-action list-group-item-light">My Help</a>
                        </div>
                        <div class="sidebar-matches shadow-sm mt-3 p-3 bg-body rounded">
                           <h5>Search by ID</h5>
                           <div class="input-group">
                              <form class="search-bar" action="/action_page.php">
                                 <input type="text" placeholder="Enter Profile ID" name="search">
                                 <button type="submit"><img src="/assets/frontend/img/search.png" width="15" height="15"></button>
                              </form>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-9">
                        <h5>Order Now</h5>
                        <div class="bg-body p-3 mb-2 rounded ">
                           <div class="h7">
                              This section provides details about orders for our Premium Services.<br>
                              You have not placed any orders with us..<br>
                              Become a Premium member through any other following services and enjoy the benefits:.<br><br>
                           </div>
                           Premium Packages:
                           <ul class="h7">
                              <li> <a href="payment.php">Diamond Membership </a></li>
                              <li> <a href="payment.php">Gold Membership  </a></li>
                              <li> <a href="payment.php">Platinum Plus Membership </a></li>
                              <li> <a href="payment.php">Diamond Plus Membership</a></li>
                              <li> <a href="payment.php">Gold Plus Membership</a></li>
                           </ul>
                           <span class="h7">If you need any further help or information please feel free to <a href="#">Write to Customer Support</a> or call us
                           at +88 xxxxxxxxx with your Order ID and specifying the problem.</span>
                        </div>
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
import "../../../axios/index";

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
};
</script>