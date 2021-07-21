<template>
  <div>
    <MemberAccountHeader></MemberAccountHeader>
      <div class="profile-mobile">
        <div class="viewprofile-slides container mt-3 mt-sm-5">
        <div class="container my-5">
          <div class="row">
            <div class="col-md-3">
              <div class="match-list-image shadow-sm mb-2 bg-body rounded">
                <img :src="image" />
              </div>
              <!-- <div class="sidebar-matches shadow-sm mb-2 p-2 bg-body rounded">
                <div class="d-flex">
                  <div class="me-auto">Mobile number verified</div>
                  <div class="">
                    <img src="/assets/frontend/img/verified.png" width="24" height="24" />
                  </div>
                </div>
              </div> -->
            </div>
            <!-- side bar  -->
            <div class="col-md-9">
              <div class="match-list shadow-sm mb-2 p-3 bg-body rounded">
                <div class="row">
                  <div class="col-md-9">
                    <div class="d-flex">
                      <div class=""><h5>{{ name }}</h5></div>
                      <div class="ms-auto">
                        <span v-if="Message" class="text-info">{{ Message }}</span>
                        <div class="btn-group">
                          <a
                            class=""
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                          >
                            <span class="block-dots"
                              ><img
                                src="/assets/frontend/img/more.png"
                                height="16"
                                width="16"
                            /></span>
                          </a>
                          
                          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                              <button @click="shortList(member_profile_id)" class="dropdown-item" type="button">
                                Add Shortlist
                              </button>
                            </li>
                            <li>
                              <button @click="dontShowAgain(member_profile_id)" class="dropdown-item" type="button">
                                Don't show again
                              </button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal2s"
                              >
                                Block Profile
                              </button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-bs-toggle="modal"
                                data-bs-target="#exampleModal1"
                              >
                                Report Profile/ Photo
                              </button>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="create-profile-title mb-4">
                      <span class="Verified"
                        ><img
                          src="/assets/frontend/img/verified.png"
                          width="16"
                          height="16"
                        />
                        Verified</span
                      ><span class="border-end border-2"></span
                      ><span>Profile created by friend</span
                      ><span class="border-end border-2"></span
                      ><a href="" class="chat"
                        ><img
                          src="/assets/frontend/img/black-circle.png"
                          width="12"
                          height="12"
                        />
                        Online now</a
                      >
                    </div>
                    <div class="match-list-short-list my-3">
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ age }} yrs, {{ height }}"</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ marital_status }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ mother_language }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ country_living_in }}, {{ city_living_in }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ religion }}, {{ caste }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ height_education }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ profession_name }}</span
                      >
                      <span class="profile-list-images">
                        <img
                          src="/assets/frontend/img/circle.png"
                          width="12"
                          height="12"
                        />{{ annual_income }}</span
                      >
                    </div>
                  </div>
                  <div class="col-md-3 col-12 border-start">
                    <div
                      class="
                        contact-profiles
                        connect-buttons
                        text-center
                        mt-0 mt-sm-5
                      "
                    >
                      <p>{{ invitationMessage }}</p>
                      <a
                        v-if="!invitationSend"
                        href="javascript:void(0)"
                        data-bs-toggle="modal"
                        data-bs-target="#connect-now"
                        @click="connectInvitation(member_profile_id,memberID)"
                        ><span class="contact-profiles2 mb-2"
                          ><img
                            src="/assets/frontend/img/check-mark.png"
                            width="15"
                            height="15"
                          />Connect Now</span
                        ></a
                      >
                      <a
                        href="javascript:void(0)"
                        data-bs-toggle="modal"
                        data-bs-target="#contact-sms"
                        v-if="!invitationSend"
                        @click="contactInvitaion(member_profile_id,memberID)"
                        ><span class="contact-profile1 mb-2"
                          ><img
                            src="/assets/frontend/img/telephone.png"
                            width="15"
                            height="15"
                          />View Contact</span
                        ></a
                      >
                      <a
                        href="javascript:void(0)"
                        data-bs-toggle="modal"
                        data-bs-target="#contact-sms"
                        v-if="invitationSend"
                        ><span class="contact-profile1 mb-2"
                          ><img
                            src="/assets/frontend/img/telephone.png"
                            width="15"
                            height="15"
                          />View Contact</span
                        ></a
                      >
                      <a href="javascript:void(0)"
                        v-if="invitationSend"
                        ><span class="contact-profile3"
                          ><img
                            src="/assets/frontend/img/chat.png"
                            width="15"
                            height="15"
                          />Send Message</span
                        ></a
                      >
                    </div>
                  </div>
                </div>

                <!-- Connect now modal -->

                <div
                  class="modal fade"
                  id="connect-now"
                  tabindex="-1"
                  aria-labelledby="connect-nows"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header blue text-light p-2">
                        <h5 class="modal-title" id="connect-nows">
                          Write to {{ name }}
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body premium-icon-22s">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="match-list-image-premium">
                              <img :src="image" />
                            </div>
                          </div>
                          <div class="col-md-9">
                            <label
                              for="exampleFormControlTextarea1"
                              class="form-label"
                              >Add a message</label
                            >
                            <textarea
                              class="form-control"
                              id="exampleFormControlTextarea1"
                              rows="4"
                            >
Hello, I liked your profile as well. It would be good to communicate and get to know each other better. Best regards, {{ memberName }}</textarea
                            >
                            <button
                              type="button"
                              data-bs-dismiss="modal"
                              class="btn btn-blue2 bg-gradient mt-3"
                            >
                              Connect
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- end connect now -->

                <!-- View contact -->
                <div
                  class="modal fade"
                  id="contact-sms"
                  tabindex="-1"
                  aria-labelledby="premium-icon2"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header blue text-light">
                        <h5 class="modal-title" id="premium-icon2"></h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body premium-icon-22s">
                        <div class="row">
                          <div class="col-md-3">
                            <div class="match-list-image-premium">
                              <img :src="image" />
                            </div>
                          </div>
                          <div class="col-md-9">
                            <h6>{{ name }}</h6>
                            <span>Profile created by {{ on_behalf }}</span>
                            <p v-if="!invitationSend" class="mt-3">
                              An invitation has been sent to connect has been sent.
                            </p>
                            <p v-if="invitationSend" class="mt-3">
                              You have send an invitation to connect.
                            </p>
                            <h6>
                              <img
                                src="/assets/frontend/img/email.png"
                                width="16"
                                height="16"
                              /><a
                                :href="'mailto:'+email"
                                class="ms-2 text-dark"
                                >{{ email }}</a
                              >
                            </h6>
                            <h6>
                              <img
                                src="/assets/frontend/img/phone.png"
                                width="16"
                                height="16"
                              /><a
                                href="tel:+88025881149"
                                class="ms-2 text-dark"
                                >+88025881149</a
                              >
                            </h6>
                            <br />
                            <label
                              for="exampleFormControlTextarea1"
                              class="form-label"
                              >Send SMS</label
                            >
                            <textarea
                              class="form-control"
                              id="exampleFormControlTextarea1"
                              rows="3"
                            >
Msg from {{ memberName }} ({{ memberID }}): Hi, I liked the Profile that you have posted on hmweddings.com. Please visit my Profile and respond.</textarea
                            >
                            <button
                              type="button"
                              class="btn btn-blue2 bg-gradient mt-3"
                              data-bs-dismiss="modal"
                            >
                              Send SMS
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!--End veiw contact -->

                <!-- Block profile modal -->
                <div
                  class="modal fade"
                  id="exampleModal2s"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          Are you sure you want to Block this Member?
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body">
                        Blocked Members will not be able to view your Profile or
                        contact you any more.
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary btn-sm"
                          data-bs-dismiss="modal"
                        >
                          Close
                        </button>
                        <button @click="blockMember(member_profile_id)" data-bs-dismiss="modal" type="button" class="btn btn-blue2 btn-sm">
                          Confirm
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- report profile -->
                <div
                  class="modal fade"
                  id="exampleModal1"
                  tabindex="-1"
                  aria-labelledby="exampleModalLabel"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                          Report to our Security Team
                        </h5>
                        <button
                          type="button"
                          class="btn-close"
                          data-bs-dismiss="modal"
                          aria-label="Close"
                        ></button>
                      </div>
                      <div class="modal-body misleading">
                        <div
                          class="accordion accordion-flush"
                          id="accordionFlushExample"
                        >
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne">
                              <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseOne"
                                aria-expanded="false"
                                aria-controls="flush-collapseOne"
                              >
                                Fake/Misleading Profile
                              </button>
                            </h2>
                            <div
                              id="flush-collapseOne"
                              class="accordion-collapse collapse"
                              aria-labelledby="flush-headingOne"
                              data-bs-parent="#accordionFlushExample"
                            >
                              <div class="accordion-body">
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Incorrect Profile information"
                                    id="flexCheckDefault"
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexCheckDefault"
                                  >
                                    Incorrect Profile information
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Phone number is incorrect/unreachable"
                                    id="flexCheckChecked"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexCheckChecked"
                                  >
                                    Phone number is incorrect/unreachable
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="More than one Profile on hmwedding.com"
                                    id="flexCheckChecked1"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexCheckChecked1"
                                  >
                                    More than one Profile on hmwedding.com
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Photo belongs to someone else"
                                    id="flexCheckChecked2"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexCheckChecked2"
                                  >
                                    Photo belongs to someone else
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingTwo">
                              <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseTwo"
                                aria-expanded="false"
                                aria-controls="flush-collapseTwo"
                              >
                                Inappropriate/Unacceptable behaviour
                              </button>
                            </h2>
                            <div
                              id="flush-collapseTwo"
                              class="accordion-collapse collapse"
                              aria-labelledby="flush-headingTwo"
                              data-bs-parent="#accordionFlushExample"
                            >
                              <div class="accordion-body">
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Member uses abusive/indecent language"
                                    v-model="reportReason"
                                    id="unreachable1"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="unreachable1"
                                  >
                                    Member uses abusive/indecent language
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Member calls/texts me repeatedly"
                                    id="unreachable2"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="unreachable2"
                                  >
                                    Member calls/texts me repeatedly
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Looking for dating/casual relationship"
                                    id="unreachable3"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="unreachable3"
                                  >
                                    Looking for dating/casual relationship
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Asking for money/Scammer"
                                    id="unreachable4"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="unreachable4"
                                  >
                                    Asking for money/Scammer
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="accordion-item">
                            <h2
                              class="accordion-header"
                              id="flush-headingThree"
                            >
                              <button
                                class="accordion-button collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#flush-collapseThree"
                                aria-expanded="false"
                                aria-controls="flush-collapseThree"
                              >
                                Member is already married/engaged
                              </button>
                            </h2>
                            <div
                              id="flush-collapseThree"
                              class="accordion-collapse collapse"
                              aria-labelledby="flush-headingThree"
                              data-bs-parent="#accordionFlushExample"
                            >
                              <div class="accordion-body">
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="I know this person"
                                    id="information1"
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="information1"
                                  >
                                    I know this person
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Told by Member over chat/phone"
                                    id="information2"
                                    checked
                                    v-model="reportReason"
                                  />
                                  <label
                                    class="form-check-label"
                                    for="information2"
                                  >
                                    Told by Member over chat/phone
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value="Found through social media/acquaintance"
                                    v-model="reportReason"
                                    id="information3"
                                    checked
                                  />
                                  <label
                                    class="form-check-label"
                                    for="information3"
                                  >
                                    Found through social media/acquaintance
                                  </label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button
                          type="button"
                          class="btn btn-secondary btn-sm"
                          data-bs-dismiss="modal"
                        >
                          Close
                        </button>
                        <button 
                        data-bs-dismiss="modal"
                        @click="reportProfile(member_profile_id)"
                        type="button" class="btn btn-blue2 btn-sm">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end dot modal -->
              </div>
              <div class="match-lists shadow-sm mb-2 p-3 bg-body rounded">
                <div class="profile-about-titile">
                  <h5>About Abdul Jalil</h5>
                </div>
                <div class="profile-about-titile-sub">
                  <p>{{ introduction }}</p>
                </div>
                <hr />
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Contact Details</h5>
                  </div>
                  <div class="match-list-short-list-sub my-3">
                    <div class="contact-details-main">
                      <div class="contact-details-main-left">
                        <ul>
                          <li>
                            <span class="edu-icon-9 educ-icon"></span>Email ID:
                            XXXX@XXXX.com
                          </li>
                          <li>
                            <span class="edu-icon-10 educ-icon"></span>
                            Contact Number: +01XXXXXXXXX
                          </li>
                        </ul>
                      </div>
                      <div
                        class="contact-details-main-right border-start p-3"
                        data-bs-toggle="modal"
                        data-bs-target="#contact-sms"
                      >
                        <a
                          href="#"
                          type="button"
                          class="btn btn-outline-secondary"
                          ><span class="edu-icon-11 educ-icon"></span>View
                          Details</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <!-- <hr />
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Contact Details</h5>
                  </div>
                  <div class="match-list-short-list-sub my-3">
                    <div class="contact-details-main">
                      <div class="contact-details-main-left">
                        <ul>
                          <li>
                            <span class="edu-icon-8 educ-icon"></span>Her Mobile
                            No: +880 19XXXXXXX
                          </li>
                          <li>
                            <span class="edu-icon-9 educ-icon"></span>Her Email:
                            your@gmail.com
                          </li>
                          <li>
                            <span class="edu-icon-10 educ-icon"></span>Parent's
                            Contact: +880 1XXXXXXXX
                          </li>
                        </ul>
                      </div>
                      <div class="contact-details-main-right border-start p-3">
                        <a
                          href="#"
                          type="button"
                          class="btn btn-outline-secondary"
                          ><span class="edu-icon-11 educ-icon"></span>Upgrade
                          Now</a
                        >
                        to view details
                      </div>
                    </div>
                  </div>
                </div> -->
                <hr />
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Background</h5>
                  </div>
                  <div class="match-list-short-list-sub my-3">
                    <ul>
                      <li><span class="edu-icon-2 educ-icon"></span>{{ mother_language }}</li>
                      <li>
                        <span class="edu-icon-3 educ-icon"></span>{{ religion }}, {{ caste }}
                      </li>
                      <li><span class="edu-icon-5 educ-icon"></span>Living in {{ country_living_in }}, {{ state_living_in }}, {{ city_living_in }}</li>
                    </ul>
                  </div>
                </div>
                <hr />
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Education & Career</h5>
                  </div>
                  <div class="match-list-short-list-sub my-3">
                    <ul>
                      <li>
                        <span class="edu-icon-4 educ-icon"></span>{{ height_education }}
                      </li>
                      <li>
                        <span class="edu-icon-7 educ-icon"></span>{{ profession_name }}
                      </li>
                    </ul>
                  </div>
                </div>
                <hr />
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Family Details</h5>
                  </div>
                  <div class="match-list-short-list-sub my-3">
                    <div class="contact-details-main">
                      <div class="contact-details-main-left">
                        <ul>
                          <li>
                            {{ family_type }} {{ family_status }} Family With {{ family_value }} Values
                          </li>
                          <li>Father is {{ father_status }}, Mother is {{ mother_status }}</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="match-lists shadow-sm mb-2 p-3 bg-body rounded">
                <div class="profile-about-titile-sub">
                  <div class="profile-about-titile">
                    <h5>Her basic preferences</h5>
                  </div>
                  <div class="looking-title mt-4">
                    <div class="looking-for">
                      <img src="/assets/frontend/img/images.png" />
                      <p>Her Preferences</p>
                    </div>
                    <div class="looking-for-match">
                      <p>Match Score {{ match_percentage }}%</p>
                    </div>
                    <div class="looking-for">
                      <img src="/assets/frontend/img/testimonials-4.jpg" />
                      <p>You match</p>
                    </div>
                  </div>
                  <hr />
                  <div class="profile-about-titile-sub">
                    <table class="table table-borderless table-striped border">
                      <tbody>
                        <tr v-if="age_match">
                          <td class="her-per">Age:</td>
                          <td>{{ partner_from_age }} - {{ partner_to_age }} yrs</td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="height_match">
                          <td>Height:</td>
                          <td>{{ partner_from_height }}" - {{ partner_to_height }}"</td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                         </tr>
                        <tr v-if="marital_status_match">
                          <td>Marital Status:</td>
                          <td><span  v-for="pms in partner_marital_status" :key="pms">{{ pms }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="having_child_match">
                          <td>Have Child:</td>
                          <td>{{ partner_having_child }}</td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="mother_tongue_match">
                          <td>Mother Tongue :</td>
                          <td><span v-for="pmt in partner_mother_tongue" :key="pmt">{{ pmt }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="religion_match">
                          <td>Religion</td>
                          <td>{{ partner_partner_religion }}</td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="caste_match">
                          <td>Cast / Community :</td>
                          <td>{{ partner_partner_caste }}</td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="country_match">
                          <td>Country Living in:</td>
                          <td><span v-for="pcli in partner_country_living_in" :key="pcli">{{ pcli }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="state_match">
                          <td>State Living in :</td>
                          <td><span v-for="psli in partner_state_living_in" :key="psli">{{ psli }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="city_match">
                          <td>City Living in :</td>
                          <td><span v-for="pcli in partner_city_living_in" :key="pcli">{{ pcli }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="education_match">
                          <td>Height Education :</td>
                          <td><span v-for="phe in partner_height_education" :key="phe">{{ phe }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="work_with_match">
                          <td>Profession Type :</td>
                          <td><span v-for="ppt in partner_profession_type" :key="ppt">{{ ppt }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="profession_match">
                          <td>Profession Name :</td>
                          <td><span v-for="ppn in partner_profession_name" :key="ppn">{{ ppn }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="salary_match">
                          <td>Annual Income :</td>
                          <td><span v-for="pai in partner_annual_income" :key="pai">{{ pai }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="behalf_match">
                          <td>On Behalf :</td>
                          <td><span v-for="pob in partner_on_behalf" :key="pob">{{ pob }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                        <tr v-if="eat_match">
                          <td>Diet :</td>
                          <td><span v-for="pdiet in partner_diet" :key="pdiet">{{ pdiet }},</span></td>
                          <td style="width: 5%;"><img src="/assets/frontend/img/check.png" width="16" height="16"></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- main div -->
    </div>
    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>


<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import axios from 'axios';

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data() {
    return {
      reportReason: [],
      phone_number: null,
      introduction: null,
      image: null,
      email: null,
      member_profile_id: null,
      name: null,
      age: null,
      date_of_birth: null,
      height: null,
      marital_status: null,
      have_child: null,
      on_behalf: null,
      blood_group: null,
      health_information: null,
      disability: null,
      diet: null,
      religion: null,
      caste: null,
      sub_caste: null,
      mother_language: null,
      father_status: null,
      mother_status: null,
      family_location: null,
      family_type: null,
      family_value: null,
      family_status: null,
      brother: null,
      sister: null,
      height_education: null,
      height_education_college_name: null,
      profession_type: null,
      profession_name: null,
      employer_name: null,
      annual_income: null,
      country_living_in: null,
      state_living_in: null,
      grew_up_in: null,
      city_living_in: null,
      residency_status: null,
      ethnic_origin: null,
      zip_code: null,
      partner_from_age: null,
      partner_to_age: null,
      partner_from_height: null,
      partner_to_height: null,
      partner_marital_status: null,
      partner_having_child: null,
      partner_mother_tongue: null,
      partner_partner_religion: null,
      partner_partner_caste: null,
      partner_country_living_in: null,
      partner_state_living_in: null,
      partner_city_living_in: null,
      partner_height_education: null,
      partner_profession_type: null,
      partner_profession_name: null,
      partner_annual_income: null,
      partner_on_behalf: null,
      partner_diet: null,
      contact_name: null,
      relation: null,
      time_from: null,
      from_hour: null,
      time_to: null,
      to_hour: null,
      display_setting: null,
      my_details: null,

      match_percentage: 0,
      age_match: false,
      height_match: false,
      marital_status_match: false,
      having_child_match: false,
      mother_tongue_match: false,
      religion_match: false,
      caste_match: false,
      country_match: false,
      state_match: false,
      city_match: false,
      education_match: false,
      work_with_match: false,
      profession_match: false,
      salary_match: false,
      behalf_match: false,
      eat_match: false,

      start: 0,
      limit: 1,
      Message: false,
      showPreviousButton: false,
      memberName: null,
      memberID: null,

      invitationSend: false,
      invitationMessage: 'Like this profile?',
      memberDetails: null,
    };
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
      this.memberDetails = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberName = this.memberDetails.name;
      this.memberID = this.memberDetails.member_profile_id;
    }
    this.getMemberDetails(this.$route.params.id);
    this.myDetail(this.memberID);
  },
  methods: {
    reportProfile(memberId){
      axios
        .post('api/report/'+this.memberID+"/"+memberId,{
          'reasons': this.reportReason,
        })
        .then((response) => {
          if (response.data == true) {
            this.Message = 'Profile Reported Successfully';
            setTimeout(() => this.Message = false, 2000);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    blockMember(memberId){
      axios
        .get('api/block/'+this.memberID+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.Message = 'Profile Blocked Successfully';
            setTimeout(() => this.Message = false, 2000);
          }
        })
        .catch((error) =>{
          console.log(error);
        });
    },
    shortList(memberId){
      axios
        .get('api/shortlist/'+this.memberID+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.Message = 'Member Shortlisted Successfully';
            setTimeout(() => this.Message = false, 2000);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    dontShowAgain(memberId){
      axios
      .get("api/ignore/"+this.memberID+"/"+memberId)
      .then((response) => {
        console.log(response.data);
        if(response.data == true){
          this.Message = 'Member ignored successfully';
          setTimeout(() => this.Message = false, 2000);
        }
      })
      .catch((error) => {
        console.log(error);
      });
    },
    getMemberDetails(memberId) {
      axios
        .get("api/member-profile/" + memberId)
        .then((response) => {
          console.log(response.data);
          this.phone_number = response.data.phone_number;
          this.introduction = response.data.introduction;
          this.email = response.data.email;
          this.image = response.data.image;
          this.member_profile_id = response.data.member_profile_id;
          this.name = response.data.name;
          this.age = response.data.age;
          this.date_of_birth = response.data.date_of_birth;
          this.height = response.data.height;
          this.marital_status = response.data.marital_status;
          this.have_child = response.data.have_child;
          this.on_behalf = response.data.on_behalf;
          this.blood_group = response.data.blood_group;
          this.health_information = response.data.health_information;
          this.disability = response.data.disability;
          this.diet = response.data.diet;
          this.religion = response.data.religion;
          this.caste = response.data.caste;
          this.sub_caste = response.data.sub_caste;
          this.mother_language = response.data.mother_language;
          this.father_status = response.data.father_status;
          this.mother_status = response.data.mother_status;
          this.family_location = response.data.family_location;
          this.family_type = response.data.family_type;
          this.family_value = response.data.family_value;
          this.family_status = response.data.family_status;
          this.brother = response.data.brother;
          this.sister = response.data.sister;
          this.height_education = response.data.height_education;
          this.height_education_college_name =
            response.data.height_education_college_name;
          this.profession_type = response.data.profession_type;
          this.profession_name = response.data.profession_name;
          this.employer_name = response.data.employer_name;
          this.annual_income = response.data.annual_income;
          this.country_living_in = response.data.country_living_in;
          this.state_living_in = response.data.state_living_in;
          this.grew_up_in = response.data.grew_up_in;
          this.city_living_in = response.data.city_living_in;
          this.residency_status = response.data.residency_status;
          this.ethnic_origin = response.data.ethnic_origin;
          this.zip_code = response.data.zip_code;
          this.partner_from_age = response.data.partner_from_age;
          this.partner_to_age = response.data.partner_to_age;
          this.partner_from_height = response.data.partner_from_height;
          this.partner_to_height = response.data.partner_to_height;
          this.partner_marital_status = response.data.partner_marital_status;
          this.partner_having_child = response.data.partner_having_child;
          this.partner_mother_tongue = response.data.partner_mother_tongue;
          this.partner_partner_religion =
            response.data.partner_partner_religion;
          this.partner_partner_caste = response.data.partner_partner_caste;
          this.partner_country_living_in =
            response.data.partner_country_living_in;
          this.partner_state_living_in = response.data.partner_state_living_in;
          this.partner_city_living_in = response.data.partner_city_living_in;
          this.partner_height_education =
            response.data.partner_height_education;
          this.partner_profession_type = response.data.partner_profession_type;
          this.partner_profession_name = response.data.partner_profession_name;
          this.partner_annual_income = response.data.partner_annual_income;
          this.partner_on_behalf = response.data.partner_on_behalf;
          this.partner_diet = response.data.partner_diet;
          this.contact_name = response.data.contact_name;
          this.relation = response.data.relation;
          this.time_from = response.data.time_from;
          this.from_hour = response.data.from_hour;
          this.time_to = response.data.time_to;
          this.to_hour = response.data.to_hour;
          this.display_setting = response.data.display_setting;
          this.checkInvitation(this.memberID, this.member_profile_id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    myDetail(myId){
      axios
        .get("api/member-profile/" + myId)
        .then((response) => {
          const my_details = response.data;
          if (my_details.age >= this.partner_from_age && my_details.age <= this.partner_to_age) {
            this.age_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }

          if (my_details.height >= this.partner_from_height  && my_details.height <= this.partner_to_height) {
            this.height_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.partner_having_child == my_details.have_child) {
            this.having_child_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.partner_partner_religion == my_details.religion) {
            this.religion_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.partner_partner_caste == my_details.caste) {
            this.caste_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_marital_status,my_details.marital_status)) {
            this.marital_status_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_mother_tongue,my_details.mother_language)) {
            this.mother_tongue_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          
          if (this.isExist(this.partner_country_living_in,my_details.country_living_in)) {
            this.country_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_state_living_in,my_details.state_living_in)) {
            this.state_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_city_living_in,my_details.city_living_in)) {
            this.city_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_height_education,my_details.height_education)) {
            this.education_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_profession_type,my_details.profession_type)) {
            this.work_with_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_profession_name,my_details.profession_name)) {
            this.profession_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_annual_income,my_details.annual_income)) {
            this.salary_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_on_behalf,my_details.on_behalf)) {
            this.behalf_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
          if (this.isExist(this.partner_diet,my_details.diet)) {
            this.eat_match = true;
            this.match_percentage = parseFloat(this.match_percentage + 6.25);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    isExist : function(array,item){
      for(var i=0; i < array.length; i++){
        if( array[i] == item){
          return true
        }
      }
      return false
    },
    connectInvitation(to,from){
      axios
        .get("api/connect-invitation/"+to+"/"+from)
        .then((response) => {
          if (response.data == true) {
            this.invitationMessage = 'Invitaion send.'
          }
          this.invitationSend = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    contactInvitaion(to,from){
      axios
        .get("api/contact-invitation/"+to+"/"+from)
        .then((response) => {
          if (response.data == true) {
            this.invitationMessage = 'Invitaion send.'
          }
          this.invitationSend = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    checkInvitation(from,to){
      axios
        .get("api/check-invitation/"+from+"/"+to)
        .then((response) => {
          console.log(response.data);
          if (response.data == true) {
            this.invitationSend = true;
            this.invitationMessage = 'Invitation send.';
          } else {
            this.invitationSend = false;
            this.invitationMessage = 'Like this profile?';
          }
        })
    }
  },
};
</script>
