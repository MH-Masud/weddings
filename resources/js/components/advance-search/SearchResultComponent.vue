<template>
  <div>
    <Header />
    <div class="profile-main">
      <!-- End Header -->
      <div class="container subheader-top">
        <div class="row">
          <div class="col-md-2">
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="mobile-refine">
              <a
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
                class="border p-1"
                ><img
                  src="assets/frontend/img/funnel.png"
                  width="10"
                  height="10"
              /></a>
              <div
                class="modal fade"
                id="staticBackdrop"
                data-bs-backdrop="static"
                data-bs-keyboard="false"
                tabindex="-1"
                aria-labelledby="staticBackdropLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                      ></button>
                    </div>
                    <!-- Filter For Mobile -->
                    <div class="modal-body">
                      <div class="refine-search">
                        <h6 class="refine-search-bg border p-2">
                          Refine Search
                        </h6>
                        <div class="refine-accordion mb-2">
                          <div
                            class="accordion"
                            id="accordionPanelsStayOpenExample"
                          >
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="m-refine2">
                                <button
                                  class="accordion-button collapsed"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-refine2s"
                                  aria-expanded="false"
                                  aria-controls="m-refine2s"
                                >
                                  Photo Settings
                                </button>
                              </h2>
                              <div
                                id="m-refine2s"
                                class="accordion-collapse collapse"
                                aria-labelledby="m-refine2"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault1"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault1"
                                        >
                                          All
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault2"
                                          checked
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault2"
                                        >
                                          With photo
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault2"
                                          checked
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault2"
                                        >
                                          Without photo
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item">
                              <h2 class="accordion-header" id="m-refine1">
                                <button
                                  class="accordion-button collapsed"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-refine1s"
                                  aria-expanded="false"
                                  aria-controls="m-refine1s"
                                >
                                  Recently Joined
                                </button>
                              </h2>
                              <div
                                id="m-refine1s"
                                class="accordion-collapse collapse"
                                aria-labelledby="m-refine1"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault1"
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault1"
                                        >
                                          All
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault2"
                                          checked
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault2"
                                        >
                                          Within a day(4)
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault2"
                                          checked
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault2"
                                        >
                                          Within a week(23)
                                        </label>
                                      </div>
                                      <div class="form-check">
                                        <input
                                          class="form-check-input"
                                          type="radio"
                                          name="search-2"
                                          id="flexRadioDefault2"
                                          checked
                                        />
                                        <label
                                          class="form-check-label"
                                          for="flexRadioDefault2"
                                        >
                                          Within a month(30)
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Filter For Desktop -->
            <div class="refine-search desktop-refine">
              <h6 class="refine-search-bg border p-2">Refine Search</h6>
              <div class="refine-accordion mb-2">
                <div class="accordion" id="accordionPanelsStayOpenExample">
                  
                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine"
                        aria-expanded="true"
                        aria-controls="refine"
                      >
                        Photo
                      </div>
                    </h2>
                    <div
                      id="refine"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault1"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault1"
                              >
                                All
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault2"
                                checked
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                With photo
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault2"
                                checked
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Without photo
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine2"
                        aria-expanded="true"
                        aria-controls="refine2"
                      >
                        Gender
                      </div>
                    </h2>
                    <div
                      id="refine2"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine2"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine3"
                        aria-expanded="true"
                        aria-controls="refine3"
                      >
                        Age
                      </div>
                    </h2>
                    <div
                      id="refine3"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine3"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine4"
                        aria-expanded="true"
                        aria-controls="refine4"
                      >
                        Height
                      </div>
                    </h2>
                    <div
                      id="refine4"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine4"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine5"
                        aria-expanded="true"
                        aria-controls="refine5"
                      >
                        Religion
                      </div>
                    </h2>
                    <div
                      id="refine5"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine5"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Religion
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine6"
                        aria-expanded="true"
                        aria-controls="refine6"
                      >
                        Marital Status
                      </div>
                    </h2>
                    <div
                      id="refine6"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine6"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault1"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault1"
                              >
                                All
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault2"
                                checked
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                With photo
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="search-2"
                                id="flexRadioDefault2"
                                checked
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Without photo
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine7"
                        aria-expanded="true"
                        aria-controls="refine7"
                      >
                        Profession
                      </div>
                    </h2>
                    <div
                      id="refine7"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine7"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine8"
                        aria-expanded="true"
                        aria-controls="refine8"
                      >
                        Education
                      </div>
                    </h2>
                    <div
                      id="refine8"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine8"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine9"
                        aria-expanded="true"
                        aria-controls="refine9"
                      >
                        Country
                      </div>
                    </h2>
                    <div
                      id="refine9"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine9"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Female
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="accordion-item mb-2">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                      <div
                        class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#refine10"
                        aria-expanded="true"
                        aria-controls="refine10"
                      >
                        Profile ID
                      </div>
                    </h2>
                    <div
                      id="refine10"
                      class="accordion-collapse collapse show"
                      aria-labelledby="refine10"
                    >
                      <div class="accordion-body">
                        <div class="panels">
                          <div class="refine-search-checkbox my-3">
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="gender"
                              >
                                Religion
                              </label>
                            </div>
                            <div class="form-check">
                              <input
                                class="form-check-input"
                                type="radio"
                                name="gender"
                                id="gender"
                              />
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                Male
                              </label>
                            </div>

                          </div>
                        </div>
                      </div>
                    </div>
                    
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-10">
            <h5 class="mb-2 m-refine">
              Members who match most of your Preferences
            </h5>
            <div class="match-list shadow-sm mb-3 bg-body rounded"  v-for="result in searchResult" :key="result.memberId">
              <div class="row mposition">
                <div class="col-md-3">
                  <div class="match-list-image">
                    <div id="gallery" class="gallery-page">
                      <div class="gallery-img">
                        <div class="owl-theme">
                            <carousel :margin="20" :loop="true" :nav="false" :autoplay="true" :dots="true" :autoplayTimeout="3000" :responsive="{0:{items:1},600:{items:1},1000:{items:1}}">
                                <div class="item profile-ge-img" v-for="(img,imgIndex) in result.images" :key="imgIndex">
                                    <img :src="img"  class="hover-shadow cursor">
                                </div>
                            </carousel>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-9 p-2 p-sm-4 mv-list-matches-chat">
                  <div class="d-flex">
                    <div class="">
                      <a href="viewprofile.php">
                        <h5>{{ result.name }}</h5>
                      </a>
                    </div>
                    <div class="ms-2 fs-6">
                      <a href="#" class="chat online-chat"
                        ><img
                          src="assets/frontend/img/dots.png"
                          width="10"
                          height="10"
                        />
                        Online 6h ago</a
                      >
                    </div>
                    <div class="ms-auto block-drop">
                      <div class="btn-group">
                        <a
                          class=""
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <span class="block-dots"
                            ><img
                              src="assets/frontend/img/more.png"
                              height="16"
                              width="16"
                          /></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                          <li>
                            <button class="dropdown-item" type="button">
                              Don't show again
                            </button>
                          </li>
                          <li>
                            <button
                              class="dropdown-item"
                              type="button"
                              data-bs-toggle="modal"
                              data-bs-target="#exampleModal22"
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
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div
                          class="modal fade"
                          id="exampleModal22"
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
                                Blocked Members will not be able to view your
                                Profile or contact you on Shaadi.com.
                                <div class="form-check mt-3">
                                  <input
                                    class="form-check-input"
                                    type="checkbox"
                                    value=""
                                    id="flexCheckChecked"
                                    checked
                                  />
                                  <label
                                    class="form-check-label"
                                    for="flexCheckChecked"
                                  >
                                    Also, report this profile for Misuse.
                                  </label>
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
                                  type="button"
                                  class="btn btn-blue2 btn-sm"
                                >
                                  Confirm
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
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
                                    <h2
                                      class="accordion-header"
                                      id="flush-headingOne"
                                    >
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
                                            value=""
                                            id="flexCheckDefault"
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
                                            value=""
                                            id="flexCheckChecked"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="flexCheckChecked"
                                          >
                                            Phone number is
                                            incorrect/unreachable
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="flexCheckChecked1"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="flexCheckChecked1"
                                          >
                                            More than one Profile on
                                            hmwedding.com
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="flexCheckChecked2"
                                            checked
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
                                    <h2
                                      class="accordion-header"
                                      id="flush-headingTwo"
                                    >
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
                                            value=""
                                            id="unreachable1"
                                          />
                                          <label
                                            class="form-check-label"
                                            for="unreachable1"
                                          >
                                            Member uses abusive/indecent
                                            language
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="unreachable2"
                                            checked
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
                                            value=""
                                            id="unreachable3"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="unreachable3"
                                          >
                                            Looking for dating/casual
                                            relationship
                                          </label>
                                        </div>
                                        <div class="form-check">
                                          <input
                                            class="form-check-input"
                                            type="checkbox"
                                            value=""
                                            id="unreachable4"
                                            checked
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
                                            value=""
                                            id="information1"
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
                                            value=""
                                            id="information2"
                                            checked
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
                                            value=""
                                            id="information3"
                                            checked
                                          />
                                          <label
                                            class="form-check-label"
                                            for="information3"
                                          >
                                            Found through social
                                            media/acquaintance
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
                                  type="button"
                                  class="btn btn-blue2 btn-sm"
                                >
                                  Submit
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- You & Her -->
                    <div class="you_her">
                      <span><img src="/assets/frontend/img/user-couple.png" width="20" height="20" class="me-2">You & Her</span>
                      <div class="you_her-content border">
                          <ul>
                            <li><img src="/assets/frontend/img/check.png" width="10" height="10" class="me-2"> You both enjoy non-vegetarian food</li>
                            <li><img src="/assets/frontend/img/check.png" width="10" height="10" class="me-2"> She lives in dhaka as well</li>
                            <li><img src="/assets/frontend/img/check.png" width="10" height="10" class="me-2"> You both are from the Bengali community</li>
                          </ul>
                      </div>
                    </div>
                    <hr>
                    <!-- End you & Her -->
                  <a href="">
                    <div class="mv-list-matches">
                      <table class="table table-borderless">
                        <tbody>
                            <tr class="w-100 tables-ages">
                              <td>{{ result.age }} yrs {{ result.height ? ', '+result.height: '' }}</td>
                              <td>{{ result.marital_status }}</td>
                              <td>{{ result.religion }} {{ result.cast ? ', '+result.cast : '' }}</td>
                              <td>{{ result.profession_name }}</td>
                              <td>{{ result.height_education }}</td>
                              <td>{{ result.country_living_in }} {{ result.state_living_in ? ', '+result.state_living_in : '' }}</td>
                            </tr>
                        </tbody>
                      </table>
                    </div>
                  </a>
                  <P class="mt-2 mv-details"
                    >{{ result.introduction }}
                  </P>
                  <div class="contact-profiles my-2 my-sm-4">
                    <a
                      href="#"
                      data-bs-toggle="modal"
                      :data-bs-target="'#premium-icon-'+result.memberId"
                      ><span class="contact-profile1"
                        ><img
                          src="assets/frontend/img/telephone.png"
                          width="15"
                          height="15"
                        />Call</span
                      ></a
                    >
                    <a
                      href="#"
                      data-bs-toggle="modal"
                      :data-bs-target="'#premium-icon-'+result.memberId"
                      ><span class="contact-profiles2"
                        ><img
                          src="assets/frontend/img/whatsapp.png"
                          width="15"
                          height="15"
                        />WhatsApp</span
                      ></a
                    >
                    <a
                      href="#"
                      data-bs-toggle="modal"
                      :data-bs-target="'#premium-icon-'+result.memberId"
                      ><span class="contact-profile3"
                        ><img
                          src="assets/frontend/img/chat.png"
                          width="15"
                          height="15"
                        />Chat</span
                      ></a
                    >
                  </div>
                </div>
              </div>
              <!-- Modal -->
              <div
                class="modal fade"
                :id="'premium-icon-'+result.memberId"
                tabindex="-1"
                aria-labelledby="premium-icon2"
                aria-hidden="true"
              >
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header blue text-light">
                      <h5 class="modal-title" id="premium-icon2">
                        To contact her directly, Upgrade Now
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
                            <img src="assets/frontend/img/member-4.png" />
                          </div>
                        </div>
                        <div class="col-md-9">
                          <h6>{{ result.name }}</h6>
                          <span>+880-1********* </span>
                          <div class="contact-profiles mt-4">
                            <span class="contact-profile1"
                              ><img
                                src="assets/frontend/img/telephone.png"
                                width="15"
                                height="15"
                              />Call</span
                            >
                            <span class="contact-profiles2"
                              ><img
                                src="assets/frontend/img/whatsapp.png"
                                width="15"
                                height="15"
                              />WhatsApp</span
                            >
                            <span class="contact-profile3"
                              ><img
                                src="assets/frontend/img/chat.png"
                                width="15"
                                height="15"
                              />Chat</span
                            >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <router-link to="/premium-plan" class="m-auto"
                        ><button type="button" class="btn btn-blue2">
                          View Plans
                        </button></router-link
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
import carousel from 'vue-owl-carousel';

export default {
  components: {
    Header,
    Footer,
    carousel,
  },
  data() {
    return {
      searchQuery: null,
      searchResult: null,
    };
  },
  mounted() {
    this.getSearchResult();
  },
  methods: {
    getSearchResult() {
      this.searchQuery = this.$route.query;
      /** Search Result */
      axios
        .post("api/search-result", {
          searchQuery: this.searchQuery,
        })
        .then((response) => {
          this.searchResult = response.data;
          console.log(this.searchResult);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>