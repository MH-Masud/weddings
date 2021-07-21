<template>
  <div>
    <Header />
    <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-3">
            <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="mobile-refine">
              <a
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
                class="border p-1"
                ><img
                  src="/assets/frontend/img/funnel.png"
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
                        Age
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
                              <label
                                class="form-check-label"
                                for="flexRadioDefault1"
                              >
                                Form:-
                              </label>
                              <input
                              type="range"
                              min="18"
                              max="80"
                              step="1"
                              v-model="from_age"
                              />
                              {{ from_age }} yrs
                              
                            </div>
                            <div class="form-check">
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                To:-
                              </label>
                              <input
                              type="range"
                              min="18"
                              max="80"
                              step="1"
                              v-model="to_age"
                              />
                              {{ to_age }} yrs
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
                        data-bs-target="#refine"
                        aria-expanded="true"
                        aria-controls="refine"
                      >
                        Height
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
                              <label
                                class="form-check-label"
                                for="flexRadioDefault1"
                              >
                                Form:-
                              </label>
                              <input
                              type="range"
                              min="4.0"
                              max="8.0"
                              step="0.1"
                              v-model="from_height"
                              />
                              {{ from_height }}"
                              
                            </div>
                            <div class="form-check">
                              <label
                                class="form-check-label"
                                for="flexRadioDefault2"
                              >
                                To:-
                              </label>
                              <input
                              type="range"
                              min="4.0"
                              max="8.0"
                              step="0.1"
                              v-model="to_height"
                              />
                              {{ to_height }}"
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
                              <multiselect @input="genderEvent" v-model="gender" label="name" track-by="id" :options="genders" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        On Behalf
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
                              <multiselect v-model="on_behalf" label="name" track-by="id" :options="onBehalf" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Marital Status
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
                              <multiselect v-model="marital_status" label="name" track-by="id" :options="maritalStatus" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Have Children
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
                              <multiselect v-model="have_child" label="name" track-by="id" :options="haveChild" :multiple="false" :preselect-first="true">
                              </multiselect>
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
                        Mother Tongue
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
                              <multiselect v-model="mother_tongue" label="name" track-by="id" :options="languageList" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                            <multiselect v-model="religion" label="name" track-by="id" :options="religionList" :multiple="true" :preselect-first="true">
                            </multiselect>
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
                        Caste
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
                            <multiselect v-model="caste" label="name" track-by="id" :options="casteList" :multiple="true" :preselect-first="true">
                            </multiselect>
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
                        Country Living In
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
                              <multiselect v-model="country_living_in" label="name" track-by="id" :options="countryList" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        State Living In
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
                              <multiselect v-model="state_living_in" label="name" track-by="id" :options="stateList" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        City Living In
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
                              <multiselect v-model="city_living_in" label="name" track-by="id" :options="cityList" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Resident Status
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
                              <multiselect v-model="resident_status" label="name" track-by="id" :options="residentStatus" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Grew Up In
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
                              <multiselect v-model="grew_up_in" label="name" track-by="id" :options="countryList" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Height Education
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
                              <multiselect v-model="height_education" label="name" track-by="id" :options="educations" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Profession Type
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
                              <multiselect v-model="profession_type" label="name" track-by="id" :options="professionType" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Profession Name
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
                              <multiselect v-model="profession_name" label="name" track-by="id" :options="occupations" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Annual Income
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
                              <multiselect v-model="annual_income" label="name" track-by="id" :options="incomes" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Diet
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
                              <multiselect v-model="diet" label="name" track-by="id" :options="diets" :multiple="true" :preselect-first="true">
                              </multiselect>
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
                        Photo Settings
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
                              <multiselect v-model="photo_settings" label="name" track-by="id" :options="photoSettings" :multiple="true" :preselect-first="true">
                              </multiselect>
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
          <div class="col-md-9">
            <div class="d-flex">
               <div class="mb-2 m-refine"><h5>Members who match most of your Preferences</h5></div>
               <div class="result-notfound ms-auto">
                  <button v-if="showPreviousButton == true" class="btn btn-blue2 bg-gradient rounded-0" @click="previousButton" type="button">Prev</button>
                  <button v-if="showNextButton == true" class="btn btn-blue2 bg-gradient rounded-0" @click="nextButton" type="button">Next </button>
              </div>
           </div>
            <div v-if="!resultNotFoundError">
              <div class="match-list shadow-sm mb-3 bg-body rounded"  v-for="(result,row) in searchResult" :key="result.memberId">
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
                        <router-link :to="'/my-account/view-profile/'+result.memberId+'/'+(row+start)">
                          <h5>{{ result.name }}</h5>
                        </router-link>
                      </div>
                      <div class="ms-2 fs-6">
                        <a href="#" class="chat online-chat"
                          ><img
                            src="/assets/frontend/img/dots.png"
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
                                src="/assets/frontend/img/more.png"
                                height="16"
                                width="16"
                            /></span>
                          </a>
                          <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                              <button @click="shortList(row,result.memberId)" class="dropdown-item" type="button">
                                Add Shortlist
                              </button>
                            </li>
                            <li>
                              <button @click="dontShowAgain(row,result.memberId)" class="dropdown-item" type="button">
                                Don't show again
                              </button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-bs-toggle="modal"
                                :data-bs-target="'#BlockModal'+result.memberId"
                              >
                                Block Profile
                              </button>
                            </li>
                            <li>
                              <button
                                class="dropdown-item"
                                type="button"
                                data-bs-toggle="modal"
                                :data-bs-target="'#ReportModal'+result.memberId"
                              >
                                Report Profile
                              </button>
                            </li>
                          </ul>
                          <!-- Button trigger modal -->
                          <!-- Block Modal -->
                          <div
                            class="modal fade"
                            :id="'BlockModal'+result.memberId"
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
                                  Profile or contact you any more.
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
                                    @click="blockMember(row,result.memberId)"
                                    type="button"
                                    class="btn btn-blue2 btn-sm"
                                    data-bs-dismiss="modal"
                                  >
                                    Confirm
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Block Modal -->
                          <div
                            class="modal fade"
                            :id="'ReportModal'+result.memberId"
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
                                              v-model="reportReason"
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
                                              value="More than one Profile on hmwedding.com"
                                              id="flexCheckChecked1"
                                              checked
                                              v-model="reportReason"
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
                                              value="Member uses abusive/indecent language"
                                              id="unreachable1"
                                              v-model="reportReason"
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
                                              Looking for dating/casual
                                              relationship
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
                                    data-bs-dismiss="modal"
                                    @click="reportProfile(row,result.memberId)"
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
                                <td>{{ result.age }} yrs {{ result.height ? ', '+result.height+'"': '' }}</td>
                                <td>{{ result.marital_status }}</td>
                                <td>{{ result.religion }} {{ result.caste ? ', '+result.caste : '' }}</td>
                                <td>{{ result.height_education }}</td>
                                <td>{{ result.country_living_in }} {{ result.state_living_in ? ', '+result.state_living_in : '' }}</td>
                                <td>{{ result.profession_name }}</td>
                              </tr>
                          </tbody>
                        </table>
                      </div>
                    </a>
                    <P class="mt-2 mv-details"
                      >{{ result.introduction }}
                    </P>
                    <div class="contact-profiles my-2 my-sm-4">
                      <a v-if="!invitationSend" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#connect-now-'+result.memberId"><span class="contact-profiles2"><img src="/assets/frontend/img/check-mark.png" width="15" height="15">Connect Now</span></a>
                      <a v-if="invitationSend" href="javascript:void(0)" class="contact-profile3"><img src="/assets/frontend/img/chat.png" width="15" height="15">Write Message</a>
                      <a v-if="!invitationSend" @click="connectInvitation(result.memberId,memberID)" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#contact-sms-'+result.memberId"><span class="contact-profile1"><img src="/assets/frontend/img/telephone.png" width="15" height="15">View Contact</span></a>
                      <a v-if="invitationSend" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#contact-sms-'+result.memberId"><span class="contact-profile1"><img src="/assets/frontend/img/telephone.png" width="15" height="15">View Contact</span></a>
                    </div>
                  </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" :id="'connect-now-'+result.memberId" tabindex="-1" aria-labelledby="connect-nows" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content ">
                          <div class="modal-header blue text-light p-2">
                            <h5 class="modal-title" id="connect-nows">Write to {{ result.name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body premium-icon-22s">
                            <div class="row">
                                <div class="col-md-3">
                                  <div class="match-list-image-premium"><img :src="result.images[0]">
                                  </div>
                                </div>
                                <div class="col-md-9">
                                  <label for="exampleFormControlTextarea1" class="form-label">Add a message</label>
                                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="4">Hello, I liked your profile as well. It would be good to communicate and get to know each other better. Best regards, {{ memberName }}</textarea>
                                  <button data-bs-dismiss="modal" @click="contactInvitaion(result.memberId,memberID)" type="button" class="btn btn-blue2 bg-gradient mt-3">Connect</button>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
                <!-- Contact Modal -->
                <div class="modal fade" :id="'contact-sms-'+result.memberId" tabindex="-1" aria-labelledby="premium-icon2" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content ">
                          <div class="modal-header blue text-light">
                            <h5 class="modal-title" id="premium-icon2"></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body premium-icon-22s">
                            <div class="row">
                                <div class="col-md-3">
                                  <div class="match-list-image-premium"><img :src="result.images[0]">
                                  </div>
                                </div>
                                <div class="col-md-9">
                                  <h6>{{ result.name }}</h6>
                                  <span>Profile created by {{ result.on_behalf }}</span>
                                  <p v-if="!invitationSend" class="mt-3">An invitation has been sent to connect.</p>
                                  <p v-if="invitationSend" class="mt-3">You have already sent connect invitaion.</p>
                                  <h6><img src="/assets/frontend/img/email.png" width="16" height="16"><a :href="'mailto:'+result.phone" class="ms-2 text-dark">{{ result.email }}</a></h6>
                                  <h6><img src="/assets/frontend/img/phone.png" width="16" height="16"><a :href="'tel:'+result.phone" class="ms-2 text-dark">{{ result.phone }}</a></h6>
                                  <br>
                                  <label for="exampleFormControlTextarea1" class="form-label">Send SMS</label>
                                  <textarea class="form-control" id="exampleFormControlTextarea1" rows="3">Msg from M Masud (SH66404338): Hi, I liked the Profile that you have posted on Shaadi.com. Please visit my Profile and respond. https://t.shaadi.com/U/z89f7l3</textarea>
                                  <button data-bs-dismiss="modal" type="button" class="btn btn-blue2 bg-gradient mt-3">Send SMS</button>
                                </div>
                            </div>
                          </div>
                      </div>
                    </div>
                </div>
              </div>
            </div>
            <div v-else>
              <div class="result-not-fouond text-center py-5">
                <router-link to="/my-account/advanced-search">
                  <img src="/assets/frontend/img/not-found.png" class="img-fluid">
                </router-link>
              </div>
            </div>
            <div class="mb-2 m-refine">
              <button v-if="showPreviousButton == true" class="btn btn-blue2 bg-gradient rounded-0" type="button" @click="previousButton">Prev</button>
              <button v-if="showNextButton == true" class="btn btn-blue2 bg-gradient rounded-0" type="button" @click="nextButton">Next </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <Footer />
  </div>
</template>
<script>
import Header from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import carousel from 'vue-owl-carousel';
import Multiselect from "vue-multiselect"
import axios from 'axios';

export default {
  components: {
    Header,
    Multiselect,
    Footer,
    carousel,
  },
  data() {
    return {
      reportReason: [],
      memberName: null,
      memberID: null,
      searchQuery: null,
      searchResult: null,
      start: 0,
      limit: 10,
      resultNotFoundError: null,
      showPreviousButton: false,
      showNextButton: false,

      from_age: null,
      to_age: null,
      from_height: null,
      to_height: null,
      marital_status: [],
      religion: [],
      caste: [],
      mother_tongue: [],
      country_living_in: [],
      state_living_in:[],
      city_living_in:[],
      resident_status:[],
      grew_up_in:[],
      height_education: [],
      profession_type: [],
      profession_name: [],
      annual_income: [],
      on_behalf: [],
      have_child: [],
      diet: [],
      photo_settings: [],
      gender:[],

      invitationSend: false,
      invitationMessage: 'Like this profile?',

      maritalStatus: [],
      religionList: [],
      languageList:[],
      countryList: [],
      stateList:[],
      cityList: [],
      educations: [],
      onBehalf: [],
      occupations: [],
      incomes: [],
      casteList: [],
      genders: [
        {'id':'','name': "Doesn't matter"},
        {'id':'Female','name': 'Female'},
        {'id':'Male','name': 'Male'},
      ],
      haveChild: [
          {'id':'','name': "Doesn't matter"},
          {'id':'0','name': '0'},
          {'id':'1','name': '1'},
          {'id':'2','name': '2'},
          {'id':'3','name': '3'},
          {'id':'4','name': '4'},
          {'id':'5','name': '5'},
          {'id':'6','name': '6'},
          {'id':'7','name': '7'},
          {'id':'8','name': '8'},
          {'id':'9','name': '9'},
          {'id':'10','name': '10'},
        ],
        residentStatus: [
            {'id':'','name': "Doesn't matter"},
            {'id':'Citizen','name': 'Citizen'},
            {'id':'Permanent Resident','name': 'Permanent Resident'},
            {'id':'Work Permit','name': 'Work Permit'},
            {'id':'Student Visa','name': 'Student Visa'},
            {'id':'Temporary Visa','name': 'Temporary Visa'},
        ],
        diets:[
              {'id':'','name': "Doesn't matter"},
              {'id':'1','name': 'Veg'},
              {'id':'2','name': 'Non-Veg'},
              {'id':'3','name': 'Occasionally Non-Veg'},
              {'id':'4','name': 'Eggetarian'},
              {'id':'5','name': 'Jain'},
              {'id':'6','name': 'Vegan'},
        ],
        professionType:[
          {'id': '','name': "Doesn't matter"},
          {'id': '1','name': "Private Company"},
          {'id': '2','name': "Government / Public Sector"},
          {'id': '3','name': "Defense / Civil Services"},
          {'id': '4','name': "Business / Self Employed"},
          {'id': '5','name': "Not Working"},
        ],
        photoSettings:[
          {'id': '','name': "Doesn't matter"},
          {'id': 'With Photo','name': "With Photo"},
          {'id': 'Without Photo','name': "Without Photo"},
          {'id': 'Protected Photo','name': "Protected Photo"},
        ],
        pageLoded: null,
    };
  },
  mounted() {
    this.memberName = localStorage.getItem('memberName');
    this.memberID = localStorage.getItem('memberToken');
    this.getSearchResult();
    this.getMaritalStatus();
    this.getOnBehalf();
    this.getReligionList();
    this.getLanguage();
    this.getCountryList();
    this.getEducation();
    this.getOccupation();
    this.getIncomes();
    this.pageLoded = true;
  },
  watch:{
      religion: function(){
          this.getCasteList(this.religion)
      },
      country_living_in: function(){
          this.getStateList(this.country_living_in)
      },
      state_living_in: function(){
          this.getCityList(this.state_living_in)
      }
  },
  methods: {
    shortList(index,memberId){
      axios
        .get('api/shortlist/'+localStorage.getItem('memberToken')+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.searchResult.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    reportProfile(index,memberId){
      axios
        .post('api/report/'+localStorage.getItem('memberToken')+"/"+memberId,{
          'reasons': this.reportReason,
        })
        .then((response) => {
          if (response.data == true) {
            this.searchResult.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    blockMember(index,memberId){
      axios
        .get('api/block/'+localStorage.getItem('memberToken')+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.searchResult.splice(index,1);
          }
        })
        .catch((error) =>{
          console.log(error);
        });
    },
    dontShowAgain(index,memberId){
      axios
        .get("api/ignore/"+localStorage.getItem('memberToken')+"/"+memberId)
        .then((response) => {
          console.log(response.data);
          if(response.data == true){
            this.searchResult.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    genderEvent(){
      if (this.pageLoded) {
        if (this.gender == 0) {
          this.gender.push(
            {'id':'','name': "Doesn't matter"}
          );
        } else if(this.gender.length > 1){
          this.gender.forEach((gen,g) => {
            if (gen.id === '') {
              this.gender.splice(g,1);
            }
          });
        }
      }
    },
    getSearchResult(){
      const advanced_search_query = JSON.parse(localStorage.getItem('advanced_search_query'))
      this.from_age = advanced_search_query.from_age;
      this.to_age = advanced_search_query.to_age;
      this.from_height = advanced_search_query.from_height;
      this.to_height = advanced_search_query.to_height;
      this.gender = advanced_search_query.gender;
      this.on_behalf = advanced_search_query.on_behalf;
      this.marital_status = advanced_search_query.marital_status;
      this.have_child = advanced_search_query.have_child;
      this.mother_tongue = advanced_search_query.mother_tongue;
      this.religion = advanced_search_query.religion;
      this.caste = advanced_search_query.caste;
      this.country_living_in = advanced_search_query.country_living_in;
      this.state_living_in = advanced_search_query.state_living_in;
      this.city_living_in = advanced_search_query.city_living_in;
      this.resident_status = advanced_search_query.resident_status;
      this.grew_up_in = advanced_search_query.grew_up_in;
      this.height_education = advanced_search_query.height_education;
      this.profession_type = advanced_search_query.profession_type;
      this.profession_name = advanced_search_query.profession_name;
      this.annual_income = advanced_search_query.annual_income;
      this.photo_settings = advanced_search_query.country_living_in;
      
      axios
        .post("api/my-account-advanced-search/"+this.start+"/"+this.limit,{
            'search_query': advanced_search_query,
        })
        .then((response) => {
          console.log(response.data);
          if (response.data.length > 0) {
            this.resultNotFoundError = null,
            this.searchResult = response.data;
            this.showNextButton = true;
          } else {
            this.showPreviousButton = false;
            this.showNextButton = false;
            this.resultNotFoundError = 'No Result Found.';
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    nextButton(){
      this.start = parseFloat(this.start + 10);
      const advanced_search_query = JSON.parse(localStorage.getItem('advanced_search_query'))
      axios
        .post("api/my-account-advanced-search/"+this.start+"/"+this.limit,{
            'search_query': advanced_search_query,
        })
        .then((response) => {
          console.log(response.data);
          if (response.data.length > 0) {
            this.resultNotFoundError = null;
            this.searchResult = response.data;
            this.showPreviousButton = true;
            this.showNextButton = true;
          } else {
            this.showNextButton = false;
            this.resultNotFoundError = 'No Result Found.';
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    previousButton(){
      this.start = parseFloat(this.start - 10);
      if (this.start >= 0) {
        const advanced_search_query = JSON.parse(localStorage.getItem('advanced_search_query'))
        axios
          .post("api/my-account-advanced-search/"+this.start+"/"+this.limit,{
              'search_query': advanced_search_query,
          })
          .then((response) => {
            console.log(response.data);
            if (response.data) {
              this.resultNotFoundError = null,
              this.searchResult = response.data;
              this.showNextButton = true;
              this.showPreviousButton = true;
            } else {
              this.showPreviousButton = false;
              this.resultNotFoundError = 'No Result Found.';
            }
          })
          .catch((error) => {
            console.log(error);
          });
      } else {
        this.showPreviousButton = false;
        this.resultNotFoundError = 'No Result Found.';
      }
      
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
    getMaritalStatus(){
        axios
        .get("api/marital-status/")
        .then((response) => {
            this.maritalStatus = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    getOnBehalf() {
      axios
        .get("api/on-behalf/")
        .then((response) => {
          this.onBehalf = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getReligionList() {
        axios
        .get("api/religion/")
        .then((response) => {
            this.religionList = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    getCasteList(rel) {
       const allReligionID = [];
        rel.forEach(element => {
            allReligionID.push(element.id);
        });
        axios
        .post("api/all-caste/",{
           'religion_ids':allReligionID,
        })
        .then((response) => {
            this.casteList = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
    getLanguage(){
      axios
        .get("api/language/")
        .then((response) => {
          this.languageList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCountryList(){
        axios
        .get("api/country-list/")
        .then((response) => {
          this.countryList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getStateList(selectedCountries){
        const allCountryID = [];
        selectedCountries.forEach(element => {
            allCountryID.push(element.id);
        });
        axios
          .post("api/all-state/",{
              'ids': allCountryID
          })
          .then((response) => {
            this.stateList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getCityList(selectedStates){
        const allStateID = [];
        selectedStates.forEach(element => {
            allStateID.push(element.id);
        });
        axios
          .post("api/all-city/",{
              'ids': allStateID
          })
          .then((response) => {
            this.cityList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
    },
    getEducation(){
      axios
        .get("api/education/")
        .then((response) => {
          this.educations = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getOccupation(){
      axios
        .get("api/occupation/")
        .then((response) => {
          this.occupations = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getIncomes(){
      axios
        .get("api/income/")
        .then((response) => {
          this.incomes = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>