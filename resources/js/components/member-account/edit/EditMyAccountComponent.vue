<template>
  <div>
    <!-- header -->
    <MemberAccountHeader></MemberAccountHeader>
    <div class="profile-mobile">
            <div class="container mt-3 mt-sm-5">
        <div class="row">
          <div class="col-md-10 offset-md-2">
            <div class="row">
              <div class="col-md-10">
                <!-- Button trigger modal -->
                <div class="refine-search">
                  <div class="d-flex editprofiles">
                    <div class="">
                      <h4>Edit Personal Profile</h4>
                    </div>
                  </div>
                  <form @submit.prevent="getEditData">
                    <div class="refine-accordion mb-2">
                      <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#refine"
                              aria-expanded="true"
                              aria-controls="refine"
                            >
                              Basic Info
                            </div>
                          </h2>
                          <div
                            id="refine"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label"
                                    >Profile created by</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.on_behalf"
                                    >
                                      <option value="">Choose one</option>
                                      <option v-for="behalf in onBehalf" :key="behalf.id" :value="behalf.name">{{ behalf.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Gender</label
                                  >
                                  <div class="col-sm-6 pt-2">
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.gender"
                                        id="male"
                                        value="1"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="male"
                                        >Male</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        id="femal"
                                        value="2"
                                        v-model="editInfo.gender"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="femal"
                                        >Female</label
                                      >
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Date of Birth
                                  </label>
                                  <div class="col-sm-2 col-4">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.day"
                                    >
                                      <option value="">Day</option>
                                      <option value="01">01</option>
                                      <option value="02">02</option>
                                      <option value="03">03</option>
                                      <option value="04">04</option>
                                      <option value="05">05</option>
                                      <option value="06">06</option>
                                      <option value="07">07</option>
                                      <option value="08">08</option>
                                      <option value="09">09</option>
                                      <option value="10">10</option>
                                      <option value="11">11</option>
                                      <option value="12">12</option>
                                      <option value="13">13</option>
                                      <option value="14">14</option>
                                      <option value="15">15</option>
                                      <option value="16">16</option>
                                      <option value="17">17</option>
                                      <option value="18">18</option>
                                      <option value="19">19</option>
                                      <option value="20">20</option>
                                      <option value="21">21</option>
                                      <option value="22">22</option>
                                      <option value="23">23</option>
                                      <option value="24">24</option>
                                      <option value="25">25</option>
                                      <option value="26">26</option>
                                      <option value="27">27</option>
                                      <option value="28">28</option>
                                      <option value="29">29</option>
                                      <option value="30">30</option>
                                      <option value="31">31</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-2 col-4">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.month"
                                    >
                                      <option value="">Month</option>
                                      <option value="01">January</option>
                                      <option value="02">February</option>
                                      <option value="03">March</option>
                                      <option value="04">April</option>
                                      <option value="05">May</option>
                                      <option value="06">June</option>
                                      <option value="07">July</option>
                                      <option value="08">August</option>
                                      <option value="09">September</option>
                                      <option value="10">October</option>
                                      <option value="11">November</option>
                                      <option value="12">December</option>
                                    </select>
                                  </div>
                                  <div class="col-sm-2 col-4">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.year"
                                    >
                                      <option value="">Year</option>
                                      <option v-for="y in years" :key="y" :value="y">{{ y }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label"
                                    >Marital status</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.marital_status"
                                    >
                                      <option value="">Marital status</option>
                                      <option v-for="marital in maritalStatus" :key="marital.id" :value="marital.name">{{ marital.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label"
                                    >Any Child</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.have_child"
                                    >
                                      <option value="">Select</option>
                                      <option value="Yes. Living together" label="Yes. Living together">Yes. Living together</option>
                                      <option value="No" label="No" selected="selected">No</option>
                                      <option value="Yes. Not living together" label="Yes. Not living together">Yes. Not living together</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label"
                                    >Child Number</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.child_number"
                                    >
                                      <option value="">Choose one</option>
                                      <option value="0">0</option>
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Height</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.height"
                                    >
                                      <option value="">Choose one</option>
                                      <option value="4.0" title="4.0">4.0"</option>
                                      <option value="4.1" title="4.1">4.1"</option>
                                      <option value="4.2" title="4.2">4.2"</option>
                                      <option value="4.3" title="4.3">4.3"</option>
                                      <option value="4.4" title="4.4">4.4"</option>
                                      <option value="4.5" title="4.5">4.5"</option>
                                      <option value="4.6" title="4.6">4.6"</option>
                                      <option value="4.7" title="4.7">4.7"</option>
                                      <option value="4.8" title="4.8">4.8"</option>
                                      <option value="4.9" title="4.9">4.9"</option>
                                      <option value="4.10" title="4.10">4.10"</option>
                                      <option value="4.11" title="4.11">4.11"</option>
                                      <option value="5.0" title="5.0">5.0"</option>
                                      <option value="5.1" title="5.1">5.1"</option>
                                      <option value="5.2" title="5.2">5.2"</option>
                                      <option value="5.3" title="5.3">5.3"</option>
                                      <option value="5.4" title="5.4">5.4"</option>
                                      <option value="5.5" title="5.5">5.5"</option>
                                      <option value="5.6" title="5.6">5.6"</option>
                                      <option value="5.7" title="5.7">5.7"</option>
                                      <option value="5.8" title="5.8">5.8"</option>
                                      <option value="5.9" title="5.9">5.9"</option>
                                      <option value="5.10" title="5.10">5.10"</option>
                                      <option value="5.11" title="5.11">5.11"</option>
                                      <option value="6.0" title="6.0">6.0"</option>
                                      <option value="6.1" title="6.1">6.1"</option>
                                      <option value="6.2" title="6.2">6.2"</option>
                                      <option value="6.3" title="6.3">6.3"</option>
                                      <option value="6.4" title="6.4">6.4"</option>
                                      <option value="6.5" title="6.5">6.5"</option>
                                      <option value="6.6" title="6.6">6.6"</option>
                                      <option value="6.7" title="6.7">6.7"</option>
                                      <option value="6.8" title="6.8">6.8"</option>
                                      <option value="6.9" title="6.9">6.9"</option>
                                      <option value="6.10" title="6.10">6.10"</option>
                                      <option value="6.11" title="6.11">6.11"</option>
                                      <option value="7.0" title="7.0">7.0"</option>
                                      <option value="7.1" title="7.1">7.1"</option>
                                      <option value="7.2" title="7.2">7.2"</option>
                                      <option value="7.3" title="7.3">7.3"</option>
                                      <option value="7.4" title="7.4">7.4"</option>
                                      <option value="7.5" title="7.5">7.5"</option>
                                      <option value="7.6" title="7.6">7.6"</option>
                                      <option value="7.7" title="7.7">7.7"</option>
                                      <option value="7.8" title="7.8">7.8"</option>
                                      <option value="7.9" title="7.9">7.9"</option>
                                      <option value="7.10" title="7.10">7.10"</option>
                                      <option value="7.11" title="7.11">7.11"</option>
                                      <option value="8.0" title="8.0">8.0"</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label"
                                    >Health Information</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.health_information"
                                    >
                                      <option value="" selected="selected">Select</option>
                                      <option value="No Health Problems" label="No Health Problems">No Health Problems</option>
                                      <option value="HIV positive" label="HIV positive">HIV positive</option>
                                      <option value="Diabetes" label="Diabetes">Diabetes</option>
                                      <option value="Low BP" label="Low BP">Low BP</option>
                                      <option value="High BP" label="High BP">High BP</option>
                                      <option value="Heart Ailments" label="Heart Ailments">Heart Ailments</option>
                                      <option value="Other" label="Other">Other</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Any Disability?</label
                                  >
                                  <div class="col-sm-6 pt-2">
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        id="None"
                                        value="None"
                                        v-model="editInfo.disability"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="None"
                                        >None</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        id="disable"
                                        value="Physical Disability"
                                        v-model="editInfo.disability"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="disable"
                                        >Physical Disability
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 row edit-profile-imput">
                                  <label for="" class="col-sm-3 col-form-label">
                                    Blood Group</label
                                  >
                                  <div class="col-sm-6">
                                    <select
                                      class="form-select" 
                                      aria-label="Default select example"
                                      v-model="editInfo.blood_group"
                                    >
                                      <option value="">Select</option>
                                      <option value="Don't Know" label="Don't Know">Don't Know</option>
                                      <option value="A+" label="A+">A+</option>
                                      <option value="A-" label="A-">A-</option>
                                      <option value="B+" label="B+">B+</option>
                                      <option value="B-" label="B-">B-</option>
                                      <option value="AB+" label="AB+">AB+</option>
                                      <option value="AB-" label="AB-">AB-</option>
                                      <option value="O+" label="O+">O+</option>
                                      <option value="O-" label="O-">O-</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading1">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#edit-profile1"
                              aria-expanded="true"
                              aria-controls="edit-profile1"
                            >
                              Religious Background
                            </div>
                          </h2>
                          <div
                            id="edit-profile1"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading1"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Religion</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.religion"
                                      @change="getCaste"
                                    >
                                      <option value="">Choose one</option>
                                      <option v-for="religion in religions" :key="religion.id" :value="religion.id">{{ religion.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Caste / Community</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.caste"
                                      @change="getSubCaste"
                                    >
                                      <option value="">Choose one</option>
                                      <option v-for="caste in castes" :key="caste.id" :value="caste.id">{{ caste.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Sub Caste / Sub-Community</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.sub_caste"
                                    >
                                      <option  value="">Choose one</option>
                                      <option v-for="subCaste in subCastes" :key="subCaste.id" :value="subCaste.name">{{ subCaste.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- end panel -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading5">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile5"
                              aria-expanded="true"
                              aria-controls="editprofile5"
                            >
                              Language
                            </div>
                          </h2>
                          <div
                            id="editprofile5"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading5"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 row edit-profile-imput">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Mother Tongue
                                  </label>
                                  <div class="col-sm-9 mt-2">
                                    <select
                                    class="form-select"
                                    aria-label="Default select example"
                                    v-model="editInfo.mother_language"
                                    >
                                    <option value="">Select</option>
                                    <option v-for="laguage in languages" :key="laguage.id" :value="laguage.name">{{ laguage.name }}</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading2">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile2"
                              aria-expanded="true"
                              aria-controls="editprofile2"
                            >
                              Family
                            </div>
                          </h2>
                          <div
                            id="editprofile2"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading2"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Father's Status</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.father_status"
                                    >
                                      <option value="">Select</option>
                                      <option value="Employed" label="Employed">Employed</option>
                                      <option value="Business" label="Business">Business</option>
                                      <option value="Retired" label="Retired">Retired</option>
                                      <option value="Not Employed" label="Not Employed">Not Employed</option>
                                      <option value="Passed Away" label="Passed Away">Passed Away</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Mother's Status</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.mother_status"
                                    >
                                      <option value="">Select</option>
                                      <option value="Employed" label="Employed">Employed</option>
                                      <option value="Business" label="Business">Business</option>
                                      <option value="Retired" label="Retired">Retired</option>
                                      <option value="Not Employed" label="Not Employed">Not Employed</option>
                                      <option value="Passed Away" label="Passed Away">Passed Away</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Family Location</label
                                  >
                                  <div class="col-sm-9">
                                    <input type="text" class="form-select" v-model="editInfo.family_location" placeholder="Ex: Dhaka, Bangladesh">
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >No. of Siblings</label
                                  >
                                  <div class="col-sm-9">
                                    <div class="row">
                                      <div class="col-md-2">
                                        <select
                                          class="form-select"
                                          aria-label="Default select example"
                                          v-model="editInfo.unmarried_sister"
                                        >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                        </select>
                                        <label for="">Unmarried</label>
                                      </div>
                                      <div class="col-md-1 col-2">
                                        <img src="/assets/frontend/img/girl.png" height="24" width="24">
                                      </div>
                                      <div class="col-md-2">
                                        <select
                                          class="form-select"
                                          aria-label="Default select example"
                                          v-model="editInfo.married_sister"
                                        >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                        </select>
                                        <label for="">Married</label>
                                      </div>
                                      
                                      <div class="col-md-2">
                                        <select
                                          class="form-select"
                                          aria-label="Default select example"
                                          v-model="editInfo.unmarried_brother"
                                        >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                        </select>
                                        <label for="">Unmarried</label>
                                      </div>
                                      <div class="col-md-1 col-2">
                                        <img src="/assets/frontend/img/boy.png" height="24" width="24">
                                      </div>
                                      <div class="col-md-2">
                                        <select
                                          class="form-select"
                                          aria-label="Default select example"
                                          v-model="editInfo.married_brother"
                                        >
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                        </select>
                                        <label for="">Married</label>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Family Type
                                  </label>
                                  <div class="col-sm-9 mt-2">
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.family_type"
                                        id="Joint"
                                        value="Joint"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Joint"
                                        >Joint</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.family_type"
                                        id="Nuclear"
                                        value="Nuclear"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Nuclear"
                                        >Nuclear</label
                                      >
                                    </div>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Family values
                                  </label>
                                  <div class="col-sm-9 mt-2">
                                    <select 
                                    class="form-select"
                                    aria-label="Default select example"
                                    v-model="editInfo.family_value">
                                      <option value="">Choose one</option>
                                      <option v-for="familyValue in familyValues" :key="familyValue.id" :value="familyValue.name">{{ familyValue.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Family Status</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.family_status"
                                    >
                                      <option value="">Choose one</option>
                                      <option v-for="familyStatu in familyStatus" :key="familyStatu.id" :value="familyStatu.name">{{ familyStatu.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <!-- end panel -->
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading3">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile3"
                              aria-expanded="true"
                              aria-controls="editprofile3"
                            >
                              Education & Career
                            </div>
                          </h2>
                          <div
                            id="editprofile3"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading3"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Highest Education
                                  </label>
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.height_education"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="education in educations" :key="education.id" :value="education.name">{{ education.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Hight College Name</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="editInfo.height_education_college_name"
                                      placeholder="Enter highest degree college name"
                                    />
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Profession Type</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.profession_type"
                                    >
                                      <option value="">Select</option>
                                      <option value="Private Company" label="Private Company">Private Company</option>
                                      <option value="Government / Public Sector" label="Government / Public Sector">Government / Public Sector</option>
                                      <option value="Defense / Civil Services" label="Defense / Civil Services">Defense / Civil Services</option>
                                      <option value="Business / Self Employed" label="Business / Self Employed">Business / Self Employed</option>
                                      <option value="Non Working" label="Not Working">Not Working</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Profession Name</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.profession_name"
                                    >
                                      <option value="">Choose one</option>
                                      <option v-for="occupation in occupations" :key="occupation.id" :value="occupation.name">
                                        {{ occupation.name }}
                                      </option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Employer Name</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      class="form-control"
                                      id="Enter native place"
                                      placeholder="Enter employer name"
                                      v-model="editInfo.employer_name"
                                    />
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Annual Income</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.annual_income"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="income in incomes" :key="income.id" :value="income.name">{{ income.name }}</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading5">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile5"
                              aria-expanded="true"
                              aria-controls="editprofile5"
                            >
                              Lifestyle
                            </div>
                          </h2>
                          <div
                            id="editprofile5"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading5"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 row edit-profile-imput">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Diet
                                  </label>
                                  <div class="col-sm-9 mt-2">
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Veg"
                                        value="Veg"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="inlineRadio1"
                                        >Veg
                                      </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Non-Veg"
                                        value="Non-Veg"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Non-Veg"
                                        >Non-Veg</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Occasionally Non-Veg"
                                        value="Occasionally Non-Veg"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Occasionally Non-Veg"
                                        >Occasionally Non-Veg</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Eggetarian"
                                        value="Eggetarian"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Eggetarian"
                                        >Eggetarian</label
                                      >
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Jain"
                                        value="Jain"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Jain"
                                        >Jain
                                      </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                      <input
                                        class="form-check-input"
                                        type="radio"
                                        v-model="editInfo.diet"
                                        id="Vegan"
                                        value="Vegan"
                                      />
                                      <label
                                        class="form-check-label"
                                        for="Vegan"
                                        >Vegan</label
                                      >
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading6">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile6"
                              aria-expanded="true"
                              aria-controls="editprofile4"
                            >
                              Location
                            </div>
                          </h2>
                          <div
                            id="editprofile6"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading6"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Country living in</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.country_living_in"
                                      @change="getStateList"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >State / District</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.state_living_in"
                                      @change="getCityList"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="state in stateList" :key="state.id" :value="state.id">{{ state.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >City / Upazila / Thana</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.city_living_in"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="city in cityList" :key="city.id" :value="city.name">{{ city.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                    >Residency status</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.residency_status"
                                    >
                                      <option value="">Select</option>
                                      <option value="Citizen">Citizen</option>
                                      <option value="Permanent Resident">Permanent Resident</option>
                                      <option value="Work Permit">Work Permit</option>
                                      <option value="Student Visa">Student Visa</option>
                                      <option value="Temporary Visa">Temporary Visa</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Grew up in</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.grew_up_in"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="coun in countries" :key="coun.id" :value="coun.name">{{ coun.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Ethnic Origin</label
                                  >
                                  <div class="col-sm-9">
                                    <select
                                      class="form-select"
                                      aria-label="Default select example"
                                      v-model="editInfo.ethnic_origin"
                                    >
                                      <option value="">Select</option>
                                      <option v-for="coun in countries" :key="coun.id" :value="coun.name">{{ coun.name }}</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="mb-2 edit-profile-imput row">
                                  <label
                                    for="staticEmail"
                                    class="col-sm-3 col-form-label"
                                  >
                                    Zip/Pin Code</label
                                  >
                                  <div class="col-sm-9">
                                    <input
                                      type="text"
                                      class="form-control"
                                      v-model="editInfo.zip_code"
                                      placeholder="Enter zip/pin code"
                                    />
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item mb-2">
                          <h2 class="accordion-header" id="editprofileheading7">
                            <div
                              class="accordion-button btn-blue2 text-white"
                              type="button"
                              data-bs-toggle="collapse"
                              data-bs-target="#editprofile7"
                              aria-expanded="true"
                              aria-controls="editprofile7"
                            >
                              More About Yourself, Partner and Family
                            </div>
                          </h2>
                          <div
                            id="editprofile7"
                            class="accordion-collapse collapse show"
                            aria-labelledby="editprofileheading7"
                          >
                            <div class="accordion-body bg-white">
                              <div class="panels py-3">
                                <p class="h8">
                                  This section will help you make a strong
                                  impression on your potential partner. So,
                                  express yourself. (NOTE: This section will be
                                  screened everytime you update it. Allow upto 24
                                  hours for it to go live. )
                                </p>
                                <div class="form-floating">
                                  <textarea
                                    class="form-control"
                                    placeholder="Personality, Family Details, Career, Partner
                                    Expectations etc."
                                    v-model="editInfo.introduction"
                                  ></textarea>
                                </div>
                                <div class="d-grid gap-2 d-md-block mt-3">
                                  <button class="btn btn-blue2" type="submit">
                                    Submit
                                  </button>
                                </div>
                                <!-- end panel -->
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <Footer></Footer>
  </div>
</template>

<script>
import MemberAccountHeader from "../MemberAccountHeaderComponent.vue";
import Footer from "../../footer/FooterComponent.vue";
import {mapState} from 'vuex'

export default {
  components: {
    MemberAccountHeader,
    Footer,
  },
  data: function () {
    return {
      memberID: null,
      editInfo:{
          introduction: null,
          on_behalf: null,
          gender: null,
          year: null,
          month: null,
          day: null,
          marital_status: null,
          height:null,
          health_information: null,
          disability: null,
          blood_group: null,
          have_child: null,
          child_number: null,
          religion: null,
          caste: null,
          sub_caste: null,
          mother_language: null,
          diet: null,
          father_status: null,
          mother_status: null,
          family_location: null,
          family_type: null,
          family_value: null,
          family_status: null,
          married_brother: null,
          married_sister: null,
          unmarried_brother: null,
          unmarried_sister: null,
          height_education: null,
          height_education_college_name: null,
          profession_type: null,
          profession_name: null,
          employer_name: null,
          annual_income: null,
          country_living_in: null,
          state_living_in: null,
          city_living_in: null,
          residency_status: null,
          grew_up_in: null,
          ethnic_origin: null,
          zip_code: null,
      },
      castes: null,
      subCastes: null,
      stateList: null,
      cityList: null,
    };
  },
  mounted() {
    if (localStorage.getItem('hmWLoggedIn')) {
      let memberDetails = JSON.parse(localStorage.getItem('hmWLoggedIn'));
      this.memberID = memberDetails.member_profile_id;
    }
    this.getCustomerInfo();
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
  },
  computed : {
      years () {
          const year = new Date().getFullYear() - 18;
          return Array.from({length: year - 1900}, (value, index) => 1901 + index)
      },
      timezone (){
          return Intl.DateTimeFormat().resolvedOptions().timeZone
      },
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
  methods: {
    getCustomerInfo(){
      axios
        .get("api/member-detail/"+this.memberID)
        .then((response) => {
          console.log(response.data);
          const memberDetail = response.data;
          this.editInfo.on_behalf = memberDetail.basic_information.on_behalf;
          this.editInfo.gender = memberDetail.gender;
          this.editInfo.year = memberDetail.date_of_birth[0];
          this.editInfo.month = memberDetail.date_of_birth[1];
          this.editInfo.day = memberDetail.date_of_birth[2];
          this.editInfo.marital_status = memberDetail.basic_information.marital_status;
          this.editInfo.have_child = memberDetail.basic_information.have_child;
          this.editInfo.child_number = memberDetail.basic_information.child_number;
          this.editInfo.height = memberDetail.height;
          this.editInfo.health_information = memberDetail.basic_information.health_information;
          this.editInfo.disability = memberDetail.basic_information.disability;
          this.editInfo.blood_group = memberDetail.basic_information.blood_group;
          this.editInfo.religion = memberDetail.religion_information.religion;
          axios
          .get("api/caste/"+this.editInfo.religion)
          .then((response) => {
            this.castes = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
          this.editInfo.caste = memberDetail.religion_information.caste;
          axios
          .get("api/sub-caste/"+this.editInfo.caste)
          .then((response) => {
            this.subCastes = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
          this.editInfo.sub_caste = memberDetail.religion_information.sub_caste;
          this.editInfo.mother_language = memberDetail.language_information.mother_language;
          this.editInfo.father_status = memberDetail.family_information.father_status;
          this.editInfo.mother_status = memberDetail.family_information.mother_status;
          this.editInfo.family_location = memberDetail.family_information.family_location;
          this.editInfo.unmarried_sister = memberDetail.family_information.unmarried_sister;
          this.editInfo.married_sister = memberDetail.family_information.married_sister;
          this.editInfo.unmarried_brother = memberDetail.family_information.unmarried_brother;
          this.editInfo.married_brother = memberDetail.family_information.married_brother;
          this.editInfo.family_type = memberDetail.family_information.family_type;
          this.editInfo.family_value = memberDetail.family_information.family_value;
          this.editInfo.family_status = memberDetail.family_information.family_status;
          this.editInfo.height_education = memberDetail.education_and_career_information.height_education;
          this.editInfo.height_education_college_name = memberDetail.education_and_career_information.height_education_college_name;
          this.editInfo.profession_type = memberDetail.education_and_career_information.profession_type;
          this.editInfo.profession_name = memberDetail.education_and_career_information.profession_name;
          this.editInfo.employer_name = memberDetail.education_and_career_information.employer_name;
          this.editInfo.annual_income = memberDetail.education_and_career_information.annual_income;
          this.editInfo.diet = memberDetail.diet_information.diet;
          this.editInfo.country_living_in = memberDetail.location_information.country_living_in;
          axios
          .get("api/state/"+this.editInfo.country_living_in)
          .then((response) => {
            this.stateList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
          this.editInfo.state_living_in = memberDetail.location_information.state_living_in;
          axios
          .get("api/city/"+this.editInfo.state_living_in)
          .then((response) => {
            this.cityList = response.data;
          })
          .catch((error) => {
            console.log(error);
          });
          this.editInfo.city_living_in = memberDetail.location_information.city_living_in;
          this.editInfo.residency_status = memberDetail.location_information.residency_status;
          this.editInfo.grew_up_in = memberDetail.location_information.grew_up_in;
          this.editInfo.ethnic_origin = memberDetail.location_information.ethnic_origin;
          this.editInfo.zip_code = memberDetail.location_information.zip_code;
          this.editInfo.introduction = memberDetail.introduction;
          
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCaste(){
      axios
        .get("api/caste/"+this.editInfo.religion)
        .then((response) => {
          this.castes = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getSubCaste(){
      axios
        .get("api/sub-caste/"+this.editInfo.caste)
        .then((response) => {
          this.subCastes = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getStateList(){
      axios
        .get("api/state/"+this.editInfo.country_living_in)
        .then((response) => {
          this.stateList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getCityList(){
      axios
        .get("api/city/"+this.editInfo.state_living_in)
        .then((response) => {
          this.cityList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getEditData(){
      axios
        .post("api/update-info/"+this.memberID,{
            'updateData': this.editInfo
        })
        .then((response) => {
          if (response.data == true) {
            this.$router.push('/my-account/edit-success');
          } else {
            this.$router.push('/my-account/edit-failed');
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>