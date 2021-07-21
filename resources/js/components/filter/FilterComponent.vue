<template>
  <div>
    <div v-if="!isShimmer">
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
                                    :options="languageList"
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
                                  :options="religionList"
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
                                    :options="countryList"
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
                                    :options="countryList"
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
                          :options="languageList"
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
                        :options="religionList"
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
                          :options="countryList"
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
                          :options="countryList"
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
    <div v-if="isShimmer">
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
</template>

<script>
import Multiselect from "vue-multiselect";
export default {
  props: {
    isShimmer: Boolean,
  },
  components: {
    Multiselect,
  },
  data() {
    return {
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
      maritalStatus: [],
      religionList: [],
      languageList: [],
      countryList: [],
      stateList: [],
      cityList: [],
      educations: [],
      onBehalf: [],
      occupations: [],
      incomes: [],
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
    const partnerInfo = JSON.parse(localStorage.getItem("partnerInfo"));
    if (partnerInfo) {
      this.filterData.from_age = partnerInfo.from_age;
      this.filterData.to_age = partnerInfo.to_age;
      this.filterData.from_height = partnerInfo.from_height;
      this.filterData.to_height = partnerInfo.to_height;
      this.filterData.on_behalf = partnerInfo.on_behalf;
      this.filterData.marital_status = partnerInfo.marital_status;
      this.filterData.having_child = partnerInfo.have_child;
      this.filterData.mother_tongue = partnerInfo.mother_tongue;
      this.filterData.religion = partnerInfo.religion;
      this.filterData.caste = partnerInfo.caste;
      this.filterData.country_living_in = partnerInfo.country_living_in;
      this.filterData.state_living_in = partnerInfo.state_living_in;
      this.filterData.city_living_in = partnerInfo.city_living_in;
      this.filterData.height_education = partnerInfo.height_education;
      this.filterData.profession_type = partnerInfo.profession_type;
      this.filterData.profession_name = partnerInfo.profession_name;
      this.filterData.annual_income = partnerInfo.annual_income;
      this.filterData.diet = partnerInfo.diet;
    }
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
    /** Get Filter Options **/
    getMaritalStatus() {
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
    getLanguage() {
      axios
        .get("api/language/")
        .then((response) => {
          this.languageList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCountryList() {
      axios
        .get("api/country-list/")
        .then((response) => {
          this.countryList = response.data;
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
    getEducation() {
      axios
        .get("api/education/")
        .then((response) => {
          this.educations = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getOccupation() {
      axios
        .get("api/occupation/")
        .then((response) => {
          this.occupations = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getIncomes() {
      axios
        .get("api/income/")
        .then((response) => {
          this.incomes = response.data;
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
    getFilterResult() {
      axios
        .post("api/filter-result", {
          filterData: this.filterData,
          memberID: localStorage.getItem("memberToken"),
        })
        .then((response) => {
          console.log(response.data);
          this.$emit("filterOnChange", response.data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>