<template>
  <div>
    <Header></Header>
    <div class="profile-mobile"><div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-3">
            <div v-if="!shimmerEffect">
            <!-- Button trigger modal -->
            <!--Mobile Filter Modal -->
            <div class="mobile-refine">
              <a
                href="#"
                data-bs-toggle="modal"
                data-bs-target="#staticBackdrop"
                class="border p-1"
                ><img src="/assets/frontend/img/funnel.png" width="10" height="10"
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
                        <h6 class="refine-search-bg border p-2">Filter Result</h6>
                        <div class="refine-accordion mb-2">
                          <div class="accordion" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-photo-setting"
                                  aria-expanded="true"
                                  aria-controls="m-photo-setting"
                                >
                                  Photo Settings
                                </div>
                              </h2>
                              <div
                                id="m-photo-setting"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-photo-setting"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="photoSettingsChange"
                                          v-model="filterData.photo_settings"
                                          label="name"
                                          track-by="id"
                                          :options="photoSettings"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-age"
                                  aria-expanded="true"
                                  aria-controls="m-age"
                                >
                                  Age
                                </div>
                              </h2>
                              <div
                                id="m-age"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-age"
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
                                          v-model="filterData.from_age"
                                          @change="fromAgeChange"
                                        />
                                        {{ filterData.from_age }} yrs
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
                                          v-model="filterData.to_age"
                                          @change="toAgeChange"
                                        />
                                        {{ filterData.to_age }} yrs
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-height"
                                  aria-expanded="true"
                                  aria-controls="m-height"
                                >
                                  Height
                                </div>
                              </h2>
                              <div
                                id="m-height"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-height"
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
                                          v-model="filterData.from_height"
                                          @change="fromHeightChange"
                                        />
                                        {{ filterData.from_height }}"
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
                                          v-model="filterData.to_height"
                                          @change="toHeightChange"
                                        />
                                        {{ filterData.to_height }}"
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-on-behalf"
                                  aria-expanded="true"
                                  aria-controls="m-on-behalf"
                                >
                                  On Behalf
                                </div>
                              </h2>
                              <div
                                id="m-on-behalf"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-on-behalf"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="onBehalfChange"
                                          v-model="filterData.on_behalf"
                                          label="name"
                                          track-by="id"
                                          :options="onBehalf"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-marital-status"
                                  aria-expanded="true"
                                  aria-controls="m-marital-status"
                                >
                                  Marital Status
                                </div>
                              </h2>
                              <div
                                id="m-marital-status"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-marital-status"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="maritalStatusChange"
                                          v-model="filterData.marital_status"
                                          label="name"
                                          track-by="id"
                                          :options="maritalStatus"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-having-child"
                                  aria-expanded="true"
                                  aria-controls="m-having-child"
                                >
                                  Have Children
                                </div>
                              </h2>
                              <div
                                id="m-having-child"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-having-child"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="haveChildChange"
                                          v-model="filterData.have_child"
                                          label="name"
                                          track-by="id"
                                          :options="haveChild"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-mother-tongue"
                                  aria-expanded="true"
                                  aria-controls="m-mother-tongue"
                                >
                                  Mother Tongue
                                </div>
                              </h2>
                              <div
                                id="m-mother-tongue"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-mother-tongue"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="motherTongueChange"
                                          v-model="filterData.mother_tongue"
                                          label="name"
                                          track-by="id"
                                          :options="languages"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-religion"
                                  aria-expanded="true"
                                  aria-controls="m-religion"
                                >
                                  Religion
                                </div>
                              </h2>
                              <div
                                id="m-religion"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-religion"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <multiselect
                                        @input="religionChange"
                                        v-model="filterData.religion"
                                        label="name"
                                        track-by="id"
                                        :options="religions"
                                        :multiple="true"
                                        :preselect-first="true"
                                      >
                                      </multiselect>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-caste"
                                  aria-expanded="true"
                                  aria-controls="m-caste"
                                >
                                  Caste
                                </div>
                              </h2>
                              <div
                                id="m-caste"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-caste"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <multiselect
                                        @input="casteChange"
                                        v-model="filterData.caste"
                                        label="name"
                                        track-by="id"
                                        :options="casteList"
                                        :multiple="true"
                                        :preselect-first="true"
                                      >
                                      </multiselect>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-country"
                                  aria-expanded="true"
                                  aria-controls="m-country"
                                >
                                  Country Living In
                                </div>
                              </h2>
                              <div
                                id="m-country"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-country"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="countryLivingInChange"
                                          v-model="filterData.country_living_in"
                                          label="name"
                                          track-by="id"
                                          :options="countries"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-state"
                                  aria-expanded="true"
                                  aria-controls="m-state"
                                >
                                  State Living In
                                </div>
                              </h2>
                              <div
                                id="m-state"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-state"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="stateLivingInChange"
                                          v-model="filterData.state_living_in"
                                          label="name"
                                          track-by="id"
                                          :options="stateList"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-city"
                                  aria-expanded="true"
                                  aria-controls="m-city"
                                >
                                  City Living In
                                </div>
                              </h2>
                              <div
                                id="m-city"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-city"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="cityLivingInChange"
                                          v-model="filterData.city_living_in"
                                          label="name"
                                          track-by="id"
                                          :options="cityList"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-rasident-status"
                                  aria-expanded="true"
                                  aria-controls="m-rasident-status"
                                >
                                  Resident Status
                                </div>
                              </h2>
                              <div
                                id="m-rasident-status"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-rasident-status"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="residentStatusChange"
                                          v-model="filterData.resident_status"
                                          label="name"
                                          track-by="id"
                                          :options="residentStatus"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-grew-up"
                                  aria-expanded="true"
                                  aria-controls="m-grew-up"
                                >
                                  Grew Up In
                                </div>
                              </h2>
                              <div
                                id="m-grew-up"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-grew-up"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="grewUpChange"
                                          v-model="filterData.grew_up_in"
                                          label="name"
                                          track-by="id"
                                          :options="countries"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-education"
                                  aria-expanded="true"
                                  aria-controls="m-education"
                                >
                                  Height Education
                                </div>
                              </h2>
                              <div
                                id="m-education"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-education"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="heightEducationChange"
                                          v-model="filterData.height_education"
                                          label="name"
                                          track-by="id"
                                          :options="educations"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-profession-type"
                                  aria-expanded="true"
                                  aria-controls="m-profession-type"
                                >
                                  Profession Type
                                </div>
                              </h2>
                              <div
                                id="m-profession-type"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-profession-type"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="professionTypeChange"
                                          v-model="filterData.profession_type"
                                          label="name"
                                          track-by="id"
                                          :options="professionType"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-profession-name"
                                  aria-expanded="true"
                                  aria-controls="m-profession-name"
                                >
                                  Profession Name
                                </div>
                              </h2>
                              <div
                                id="m-profession-name"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-profession-name"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="professionNameChange"
                                          v-model="filterData.profession_name"
                                          label="name"
                                          track-by="id"
                                          :options="occupations"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-annual-income"
                                  aria-expanded="true"
                                  aria-controls="m-annual-income"
                                >
                                  Annual Income
                                </div>
                              </h2>
                              <div
                                id="m-annual-income"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-annual-income"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="annualIncomeChange"
                                          v-model="filterData.annual_income"
                                          label="name"
                                          track-by="id"
                                          :options="incomes"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
                                        </multiselect>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="accordion-item mb-2">
                              <h2
                                class="accordion-header"
                                id="panelsStayOpen-headingOne"
                              >
                                <div
                                  class="accordion-button"
                                  type="button"
                                  data-bs-toggle="collapse"
                                  data-bs-target="#m-diet"
                                  aria-expanded="true"
                                  aria-controls="m-diet"
                                >
                                  Diet
                                </div>
                              </h2>
                              <div
                                id="m-diet"
                                class="accordion-collapse collapse show"
                                aria-labelledby="m-diet"
                              >
                                <div class="accordion-body">
                                  <div class="panels">
                                    <div class="refine-search-checkbox my-3">
                                      <div class="form-check">
                                        <multiselect
                                          @input="dietChange"
                                          v-model="filterData.diet"
                                          label="name"
                                          track-by="id"
                                          :options="diets"
                                          :multiple="true"
                                          :preselect-first="true"
                                        >
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
                  </div>
                </div>
              </div>
            </div>
            <!-- Filter For Desktop -->
            <div class="refine-search desktop-refine">
              <h6 class="refine-search-bg border p-2">Filter Result</h6>
              <div class="refine-accordion mb-2">
                <div class="accordion" id="accordionPanelsStayOpenExample">
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
                              <multiselect
                                @input="photoSettingsChange"
                                v-model="filterData.photo_settings"
                                label="name"
                                track-by="id"
                                :options="photoSettings"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <label class="form-check-label" for="flexRadioDefault1">
                                Form:-
                              </label>
                              <input
                                type="range"
                                min="18"
                                max="80"
                                step="1"
                                v-model="filterData.from_age"
                                @change="fromAgeChange"
                              />
                              {{ filterData.from_age }} yrs
                            </div>
                            <div class="form-check">
                              <label class="form-check-label" for="flexRadioDefault2">
                                To:-
                              </label>
                              <input
                                type="range"
                                min="18"
                                max="80"
                                step="1"
                                v-model="filterData.to_age"
                                @change="toAgeChange"
                              />
                              {{ filterData.to_age }} yrs
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
                              <label class="form-check-label" for="flexRadioDefault1">
                                Form:-
                              </label>
                              <input
                                type="range"
                                min="4.0"
                                max="8.0"
                                step="0.1"
                                v-model="filterData.from_height"
                                @change="fromHeightChange"
                              />
                              {{ filterData.from_height }}"
                            </div>
                            <div class="form-check">
                              <label class="form-check-label" for="flexRadioDefault2">
                                To:-
                              </label>
                              <input
                                type="range"
                                min="4.0"
                                max="8.0"
                                step="0.1"
                                v-model="filterData.to_height"
                                @change="toHeightChange"
                              />
                              {{ filterData.to_height }}"
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
                              <multiselect
                                @input="onBehalfChange"
                                v-model="filterData.on_behalf"
                                label="name"
                                track-by="id"
                                :options="onBehalf"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="maritalStatusChange"
                                v-model="filterData.marital_status"
                                label="name"
                                track-by="id"
                                :options="maritalStatus"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="haveChildChange"
                                v-model="filterData.have_child"
                                label="name"
                                track-by="id"
                                :options="haveChild"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="motherTongueChange"
                                v-model="filterData.mother_tongue"
                                label="name"
                                track-by="id"
                                :options="languages"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                            <multiselect
                              @input="religionChange"
                              v-model="filterData.religion"
                              label="name"
                              track-by="id"
                              :options="religions"
                              :multiple="true"
                              :preselect-first="true"
                            >
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
                            <multiselect
                              @input="casteChange"
                              v-model="filterData.caste"
                              label="name"
                              track-by="id"
                              :options="casteList"
                              :multiple="true"
                              :preselect-first="true"
                            >
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
                              <multiselect
                                @input="countryLivingInChange"
                                v-model="filterData.country_living_in"
                                label="name"
                                track-by="id"
                                :options="countries"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="stateLivingInChange"
                                v-model="filterData.state_living_in"
                                label="name"
                                track-by="id"
                                :options="stateList"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="cityLivingInChange"
                                v-model="filterData.city_living_in"
                                label="name"
                                track-by="id"
                                :options="cityList"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="residentStatusChange"
                                v-model="filterData.resident_status"
                                label="name"
                                track-by="id"
                                :options="residentStatus"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="grewUpChange"
                                v-model="filterData.grew_up_in"
                                label="name"
                                track-by="id"
                                :options="countries"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="heightEducationChange"
                                v-model="filterData.height_education"
                                label="name"
                                track-by="id"
                                :options="educations"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="professionTypeChange"
                                v-model="filterData.profession_type"
                                label="name"
                                track-by="id"
                                :options="professionType"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="professionNameChange"
                                v-model="filterData.profession_name"
                                label="name"
                                track-by="id"
                                :options="occupations"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="annualIncomeChange"
                                v-model="filterData.annual_income"
                                label="name"
                                track-by="id"
                                :options="incomes"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
                              <multiselect
                                @input="dietChange"
                                v-model="filterData.diet"
                                label="name"
                                track-by="id"
                                :options="diets"
                                :multiple="true"
                                :preselect-first="true"
                              >
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
          <div v-if="shimmerEffect">
            <h6 class="refine-search-bg border p-2">Filter Result</h6>
            <div class="bg-body p-2">
              <span class="lines-head shine"></span>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
            </div>
            <div class="bg-body p-2">
              <span class="lines-head shine"></span>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
            </div>
            <div class="bg-body p-2">
              <span class="lines-head shine"></span>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-1 shine"></span>
              </div>
              <div class="">
                <span class="shine-dot shine me-2"></span
                ><span class="lines-2 shine"></span>
              </div>
            </div>
          </div>
          </div>
          <div class="col-md-9" v-if="!shimmerEffect">
            <div class="d-flex">
               <div class="mb-2 m-refine"><h5>Members who match with you</h5></div>
           </div>
            <div class="match-list shadow-sm mb-3 bg-body rounded"  v-for="(result,row) in newMatchs.data" :key="result.memberId">
                <div class="row mposition">
                  <div class="col-md-3">
                    <div class="match-list-image">
                      <div id="gallery" class="gallery-page">
                        <div class="gallery-img">
                          <div class="owl-theme">
                              <carousel :margin="20" :loop="true" :nav="false" :autoplay="true" :dots="true" :autoplayTimeout="3000" :responsive="{0:{items:1},600:{items:1},1000:{items:1}}">
                                  <div class="item profile-ge-img" v-for="(img,imgIndex) in result.images" :key="imgIndex">
                                      <div class="profile-blue"><img :src="img"  class="hover-shadow cursor"></div>
                                      <div class="profile-blue-bg"><img :src="img"  class="hover-shadow cursor"></div>
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
                        <router-link :to="'/my-account/view-profile/'+result.memberId">
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
                      <div class="you_her" v-if="result.you_and_her">
                        <span><img src="/assets/frontend/img/user-couple.png" width="20" height="20" class="me-2">You & Her</span>
                        <div class="you_her-content border">
                            <ul>
                              <li v-for="common in result.you_and_her" :key="common"><img src="/assets/frontend/img/check.png" width="10" height="10" class="me-2"> {{ common }}</li>
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
                      <a v-if="!result.invitationSend" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#connect-now-'+result.memberId"><span class="contact-profiles2"><img src="/assets/frontend/img/check-mark.png" width="15" height="15">Connect Now</span></a>
                      <a v-if="result.invitationSend" href="javascript:void(0)" class="contact-profile3"><img src="/assets/frontend/img/chat.png" width="15" height="15">Write Message</a>
                      <a v-if="!result.invitationSend" @click="contactInvitaion(row,result.memberId,memberID)" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#contact-sms-'+result.memberId"><span class="contact-profile1"><img src="/assets/frontend/img/telephone.png" width="15" height="15">View Contact</span></a>
                      <a v-if="result.invitationSend" href="javascript:void(0)" data-bs-toggle="modal" :data-bs-target="'#contact-sms-'+result.memberId"><span class="contact-profile1"><img src="/assets/frontend/img/telephone.png" width="15" height="15">View Contact</span></a>
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
                                  <button data-bs-dismiss="modal" @click="connectInvitation(row,result.memberId,memberID)" type="button" class="btn btn-blue2 bg-gradient mt-3">Connect</button>
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
                                  <p class="mt-3">An invitation has been sent to connect.</p>
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
            <div>
              <div class="result-notfound">
                <div class="d-grid gap-2 d-md-block">
                <pagination align="center" :limit="limit" container-class="pagination" :data="newMatchs" @pagination-change-page="getNewMatchs"></pagination>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9" v-else>
              <div class="result-not-fouond text-center py-5 bg-white" v-if="noResultFound">
                  <img src="/assets/frontend/img/not-found.jpg" class="img-fluid">
              </div>
              <div v-if="shimmerEffect">
                <div class="d-flex">
                    <div class="mb-2 m-refine"><h5>Members who match with you</h5></div>
                </div>
                <!-- Shine effect -->
                <div class="match-list shadow-sm  mb-3 bg-body rounded">
                    <div class="row mposition p-2">
                      <div class="col-md-3">
                          <div class="match-list-image shine-full shine">
                          </div>
                      </div>
                      <div class="col-md-9 p-4">
                          <div class="d-flex">
                            <div class="lines-title shine mb-3">
                            </div>
                            <hr>
                            <div class="ms-2"><a href="#" class="shine-1 shine"></a></div>
                            <div class="ms-auto block-drop shine-dot shine">
                            </div>
                          </div>
                          <div class="lines-1 shine"></div>
                          <div class="match-list-short-list mv-list-matches"><div class="line-text">
                            <div class="lines-3 shine"></div>
                            <div class="lines-1 shine"></div>
                            <div class="lines-2 shine"></div>
                          </div></div>
                          <div class="lines-100 shine mt-4"></div>
                          <div class="lines-90 shine"></div>
                          <div class="mt-2">
                            <span class="lines-button shine"></span>
                            <span class="lines-button shine"></span>
                            <span class="lines-button shine"></span>
                          </div>
                      </div>
                    </div>
                </div>
                <div class="match-list shadow-sm  mb-3 bg-body rounded">
                    <div class="row mposition p-2">
                      <div class="col-md-3">
                          <div class="match-list-image shine-full shine">
                          </div>
                      </div>
                      <div class="col-md-9 p-4 mv-list-matches-chat">
                          <div class="d-flex">
                            <div class="lines-title shine mb-3">
                            </div>
                            <hr>
                            <div class="ms-2"><a href="#" class="shine-1 shine"></a></div>
                            <div class="ms-auto block-drop shine-dot shine">
                            </div>
                          </div>
                          <div class="lines-1 shine"></div>
                          <div class="match-list-short-list mv-list-matches"><div class="line-text">
                            <div class="lines-3 shine"></div>
                            <div class="lines-1 shine"></div>
                            <div class="lines-2 shine"></div>
                          </div></div>
                          <div class="lines-100 shine mt-4"></div>
                          <div class="lines-90 shine"></div>
                          <div class="mt-2">
                            <span class="lines-button shine"></span>
                            <span class="lines-button shine"></span>
                            <span class="lines-button shine"></span>
                          </div>
                      </div>
                    </div>
                </div>
                <!-- End shine effect -->
              </div>
          </div>
        </div>
      </div>
    </div>
    <Footer></Footer>
  </div>
</template>

<script>
import Header from "../member-account/MemberAccountHeaderComponent.vue";
import Footer from '../footer/FooterComponent.vue';
import carousel from 'vue-owl-carousel';
import pagination from 'laravel-vue-pagination';
import Multiselect from "vue-multiselect";
import {mapState} from 'vuex'
export default {
  components: {
    Header,
    Footer,
    carousel,
    pagination,
    Multiselect,
  },
  data() {
    return {
      reportReason: [
        'Incorrect Profile information'
      ],
      memberName: null,
      memberID: null,
      searchQuery: null,
      newMatchs: {},
      start: 0,
      limit: 2,
      noResultFound: false,
      shimmerEffect: true,
      invitationMessage: 'Like this profile?',

      filterData: {
        from_age: 18,
        to_age: 80,
        from_height: 4,
        to_height: 8,
        marital_status: [{ id: "", name: "Doesn't matter" }],
        religion: [{ id: "", name: "Doesn't matter" }],
        caste: [{ id: "", name: "Doesn't matter" }],
        mother_tongue: [{ id: "", name: "Doesn't matter" }],
        country_living_in: [{ id: "", name: "Doesn't matter" }],
        state_living_in: [{ id: "", name: "Doesn't matter" }],
        city_living_in: [{ id: "", name: "Doesn't matter" }],
        resident_status: [{ id: "", name: "Doesn't matter" }],
        grew_up_in: [{ id: "", name: "Doesn't matter" }],
        height_education: [{ id: "", name: "Doesn't matter" }],
        profession_type: [{ id: "", name: "Doesn't matter" }],
        profession_name: [{ id: "", name: "Doesn't matter" }],
        annual_income: [{ id: "", name: "Doesn't matter" }],
        on_behalf: [{ id: "", name: "Doesn't matter" }],
        have_child: [{ id: "", name: "Doesn't matter" }],
        diet: [{ id: "", name: "Doesn't matter" }],
        photo_settings: [{ id: "", name: "Doesn't matter" }],
      },
      pageLoded: null,
      stateList: [],
      cityList: [],
      casteList: [],
      haveChild: [
        { id: "", name: "Doesn't matter" },
        { id: "0", name: "0" },
        { id: "1", name: "1" },
        { id: "2", name: "2" },
        { id: "3", name: "3" },
        { id: "4", name: "4" },
        { id: "5", name: "5" },
        { id: "6", name: "6" },
        { id: "7", name: "7" },
        { id: "8", name: "8" },
        { id: "9", name: "9" },
        { id: "10", name: "10" },
      ],
      residentStatus: [
        { id: "", name: "Doesn't matter" },
        { id: "Citizen", name: "Citizen" },
        { id: "Permanent Resident", name: "Permanent Resident" },
        { id: "Work Permit", name: "Work Permit" },
        { id: "Student Visa", name: "Student Visa" },
        { id: "Temporary Visa", name: "Temporary Visa" },
      ],
      diets: [
        { id: "", name: "Doesn't matter" },
        { id: "1", name: "Veg" },
        { id: "2", name: "Non-Veg" },
        { id: "3", name: "Occasionally Non-Veg" },
        { id: "4", name: "Eggetarian" },
        { id: "5", name: "Jain" },
        { id: "6", name: "Vegan" },
      ],
      professionType: [
        { id: "", name: "Doesn't matter" },
        { id: "1", name: "Private Company" },
        { id: "2", name: "Government / Public Sector" },
        { id: "3", name: "Defense / Civil Services" },
        { id: "4", name: "Business / Self Employed" },
        { id: "5", name: "Not Working" },
      ],
      photoSettings: [
        { id: "", name: "Doesn't matter" },
        { id: "With Photo", name: "With Photo" },
        { id: "Without Photo", name: "Without Photo" },
        { id: "Protected Photo", name: "Protected Photo" },
      ],
    };
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
      let memberDetail = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberName = memberDetail.name;
      this.memberID = memberDetail.member_profile_id;
    }
    this.getNewMatchs();
    this.$store.dispatch('getOnBehalf')
    this.$store.dispatch('getCountry')
    this.$store.dispatch('getMaritalStatus')
    this.$store.dispatch('getReligion')
    this.$store.dispatch('getLanguage')
    this.$store.dispatch('getFamilyValue')
    this.$store.dispatch('getFamilyStatus')
    this.$store.dispatch('getEducation')
    this.$store.dispatch('getOccupation')
    this.$store.dispatch('getIncomes')
    this.pageLoded = true;
  },
  computed:{
    ...mapState([
        'onBehalf',
        'countries',
        'maritalStatus',
        'religions',
        'languages',
        'familyValues',
        'familyStatus',
        'educations',
        'occupations',
        'incomes',
    ])
  },
  watch: {
    "filterData.religion": function () {
      this.getCasteList(this.filterData.religion);
    },
    "filterData.country_living_in": function () {
      this.getStateList(this.filterData.country_living_in);
    },
    "filterData.state_living_in": function () {
      this.getCityList(this.filterData.state_living_in);
    },
  },
  methods: {
    /** Quick Links **/
    shortList(index,memberId){
      axios
        .get('api/shortlist/'+this.memberID+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.newMatchs.data.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    reportProfile(index,memberId){
      axios
        .post('api/report/'+this.memberID+"/"+memberId,{
          'reasons': this.reportReason,
        })
        .then((response) => {
          if (response.data == true) {
            this.newMatchs.data.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error)
        });
    },
    blockMember(index,memberId){
      axios
        .get('api/block/'+this.memberID+"/"+memberId)
        .then((response) => {
          if (response.data == true) {
            this.newMatchs.data.splice(index,1);
          }
        })
        .catch((error) =>{
          console.log(error);
        });
    },
    dontShowAgain(index,memberId){
      axios
        .get("api/ignore/"+this.memberID+"/"+memberId)
        .then((response) => {
          console.log(response.data);
          if(response.data == true){
            this.newMatchs.data.splice(index,1);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    /** Get Members **/
    getNewMatchs(page = 1){ 
      axios
        .post("api/new-match?page="+page,{
          'memberID' : this.memberID
        })
        .then((response) => {
          console.log(response.data);
          if (response.data.data.length > 0) {
            this.newMatchs = response.data;
            let parsed = JSON.stringify(response.data.data[0].partnerInfo);
            localStorage.setItem('partnerInfo',parsed);
            this.shimmerEffect = false;
          } else {
            this.shimmerEffect = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    /** Connect Invitation **/
    connectInvitation(index,to,from){
      axios
        .get("api/connect-invitation/"+to+"/"+from)
        .then((response) => {
          if (response.data == true) {
            this.invitationMessage = 'Invitaion send.'
            this.newMatchs.data[index]['invitationSend'] = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    contactInvitaion(index,to,from){
      axios
        .get("api/contact-invitation/"+to+"/"+from)
        .then((response) => {
          if (response.data == true) {
            this.invitationMessage = 'Invitaion send.'
            this.newMatchs.data[index]['invitationSend'] = true;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },

    /** Get Filter Result */
    getFilterResult(filterData){
      this.newMatchs = filterData;
      // console.log(filterData);
    },

    getCasteList(rel) {
      const allReligionID = [];
      rel.forEach((element) => {
        allReligionID.push(element.id);
      });
      axios
        .post("api/all-caste/", {
          religion_ids: allReligionID,
        })
        .then((response) => {
          this.casteList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getStateList(selectedCountries) {
      const allCountryID = [];
      selectedCountries.forEach((element) => {
        allCountryID.push(element.id);
      });
      axios
        .post("api/all-state/", {
          ids: allCountryID,
        })
        .then((response) => {
          this.stateList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCityList(selectedStates) {
      const allStateID = [];
      selectedStates.forEach((element) => {
        allStateID.push(element.id);
      });
      axios
        .post("api/all-city/", {
          ids: allStateID,
        })
        .then((response) => {
          this.cityList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    /** Filter Option On Change **/
    fromAgeChange() {
      this.getFilterResult();
    },
    toAgeChange() {
      this.getFilterResult();
    },
    fromHeightChange() {
      this.getFilterResult();
    },
    toHeightChange() {
      this.getFilterResult();
    },
    onBehalfChange() {
      if (this.pageLoded) {
        if (this.filterData.on_behalf == 0) {
          this.filterData.on_behalf.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.on_behalf.length > 1) {
          this.filterData.on_behalf.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.on_behalf.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    maritalStatusChange() {
      if (this.pageLoded) {
        if (this.filterData.marital_status == 0) {
          this.filterData.marital_status.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.marital_status.length > 1) {
          this.filterData.marital_status.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.marital_status.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    haveChildChange() {
      if (this.pageLoded) {
        if (this.filterData.have_child == 0) {
          this.filterData.have_child.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.have_child.length > 1) {
          this.filterData.have_child.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.have_child.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    motherTongueChange() {
      if (this.pageLoded) {
        if (this.filterData.mother_tongue == 0) {
          this.filterData.mother_tongue.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.mother_tongue.length > 1) {
          this.filterData.mother_tongue.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.mother_tongue.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    religionChange() {
      if (this.pageLoded) {
        if (this.filterData.religion == 0) {
          this.filterData.religion.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.religion.length > 1) {
          this.filterData.religion.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.religion.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    casteChange() {
      if (this.pageLoded) {
        if (this.filterData.caste == 0) {
          this.filterData.caste.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.caste.length > 1) {
          this.filterData.caste.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.caste.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    countryLivingInChange() {
      if (this.pageLoded) {
        if (this.filterData.country_living_in == 0) {
          this.filterData.country_living_in.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.country_living_in.length > 1) {
          this.filterData.country_living_in.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.country_living_in.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    stateLivingInChange() {
      if (this.pageLoded) {
        if (this.filterData.state_living_in == 0) {
          this.filterData.state_living_in.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.state_living_in.length > 1) {
          this.filterData.state_living_in.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.state_living_in.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    cityLivingInChange() {
      if (this.pageLoded) {
        if (this.filterData.city_living_in == 0) {
          this.filterData.city_living_in.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.city_living_in.length > 1) {
          this.filterData.city_living_in.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.city_living_in.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    residentStatusChange() {
      if (this.pageLoded) {
        if (this.filterData.resident_status == 0) {
          this.filterData.resident_status.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.resident_status.length > 1) {
          this.filterData.resident_status.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.resident_status.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    grewUpChange() {
      if (this.pageLoded) {
        if (this.filterData.grew_up_in == 0) {
          this.filterData.grew_up_in.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.grew_up_in.length > 1) {
          this.filterData.grew_up_in.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.grew_up_in.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    heightEducationChange() {
      if (this.pageLoded) {
        if (this.filterData.height_education == 0) {
          this.filterData.height_education.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.height_education.length > 1) {
          this.filterData.height_education.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.height_education.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    professionTypeChange() {
      if (this.pageLoded) {
        if (this.filterData.profession_type == 0) {
          this.filterData.profession_type.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.profession_type.length > 1) {
          this.filterData.profession_type.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.profession_type.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    professionNameChange() {
      if (this.pageLoded) {
        if (this.filterData.profession_name == 0) {
          this.filterData.profession_name.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.profession_name.length > 1) {
          this.filterData.profession_name.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.profession_name.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    annualIncomeChange() {
      if (this.pageLoded) {
        if (this.filterData.annual_income == 0) {
          this.filterData.annual_income.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.annual_income.length > 1) {
          this.filterData.annual_income.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.annual_income.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    dietChange() {
      if (this.pageLoded) {
        if (this.filterData.diet == 0) {
          this.filterData.diet.push({ id: "", name: "Doesn't matter" });
        } else if (this.filterData.diet.length > 1) {
          this.filterData.diet.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.diet.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },
    photoSettingsChange() {
      if (this.pageLoded) {
        if (this.filterData.photo_settings == 0) {
          this.filterData.photo_settings.push({
            id: "",
            name: "Doesn't matter",
          });
        } else if (this.filterData.photo_settings.length > 1) {
          this.filterData.photo_settings.forEach((gen, g) => {
            if (gen.id == "" || gen.id == null) {
              this.filterData.photo_settings.splice(g, 1);
            }
          });
        }
        this.getFilterResult();
      }
    },

    /** Get Filter Result */
    getFilterResult(page = 1) {
      axios
        .post("api/filter-result?page="+page, {
          filterData: this.filterData,
          memberID: this.memberID,
        })
        .then((response) => {
          console.log(response.data);
          if (response.data) {
            this.newMatchs = response.data
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>