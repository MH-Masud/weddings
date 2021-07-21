<template>
    <div>
        <Header/>
        <section id="register-title" style="background-color:#f1f1f2;">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 my-5" v-if="!memberId">
                        <h5 class="text-center mb-3">Let's create your account,<br>
                        to find your life partner by hmweddings.com 
                        </h5>
                        <div class="register hadow-sm p-4  mb-2 bg-body shadow-sm">
                            <div class="login">
                                <form class="row g-3" id="appRegistrationForm" @submit="checkRegistration" novalidate="true">
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">First Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="fName" class="form-control" placeholder="First name" aria-label="First name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Last Name <span class="text-danger">*</span></label>
                                        <input type="text" v-model="lName" class="form-control" placeholder="Last name" aria-label="Last name">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputGender" class="form-label">Select Gender <span class="text-danger">*</span></label>
                                        <select class="form-select" v-model="gender" aria-label="Default select example">
                                        <option value=""  disabled>Gender</option>
                                        <option value="1">Male</option>
                                        <option value="2">Female</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputEmail4" class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" v-model="email" class="form-control" id="email" placeholder="Enter Your Email">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                        <label for="inputEmail4" class="form-label">Your date of birth <span class="text-danger">*</span></label>
                                        <div class="col">
                                            <select class="form-select" v-model="year" aria-label="Default select example">
                                                <option value="" selected disabled>Year</option>
                                                <option  v-for="year in years" :key="year" :value="year">{{ year }}</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" v-model="month" aria-label="Default select example">
                                                <option value="" selected disabled>Month</option>
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
                                        <div class="col">
                                            <select class="form-select" v-model="day" aria-label="Default select example">
                                                <option value="" selected disabled>Day</option>
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="inputGender" class="form-label">On Behalf <span class="text-danger">*</span></label>
                                        <select class="form-select" v-model="formdata.onBehalf" aria-label="Default select example">
                                            <option value="" selected disabled>On Behalf</option>
                                            <option v-for="behalf in onBehalf" :key="behalf.id" :value="behalf.name">{{ behalf.name }}</option>
                                        </select>
                                    </div>
                                    <input type="hidden" v-model="timezone" value="timezone">
                                    <div class="col-md-6">
                                        <label for="inputGender" class="form-label">Country Code <span class="text-danger">*</span></label>
                                        <select class="form-select" v-model="countryCode" aria-label="Default select example">
                                            <option v-for="coun in countries" :key="coun.id" :value="coun.phonecode" selected="">{{ coun.name }} (+{{ coun.phonecode }})</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="mobile" class="form-label">Mobile No <span class="text-danger">*</span></label>
                                        <input type="number" v-model="mobile" class="form-control" placeholder="Mobile" aria-label="mobile">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                        <input type="password" v-model="password" class="form-control" id="password" placeholder="Password">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="conPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" v-model="conPassword" class="form-control" id="conPassword" placeholder="Confirm Password ">
                                    </div>
                                    <p class="text-danger" style="text-align: center;"><strong>{{ emailExist }}</strong></p>
                                    <p v-if="errors.length" class="text-danger">
                                        <b>Please fill the following field(s):</b>
                                        <ul>
                                        <li v-for="error in errors" :key="error">{{ error }}</li>
                                        </ul>
                                    </p>
                                    <div class="col-12 text-center mt-5">
                                        <button type="submit" class="btn btn-info w-50 rounded-pill">REGISTER</button>
                                    </div>
                                    <span class="text-center">Already have Account ? <router-link to="/app-login">Login</router-link></span>
                                    <span class="text-center">By Clicking REGISTER You Agree To Our <router-link to="/term-of-uses">Terms And Conditions</router-link></span>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 offset-md-2" v-if="memberId">
                        <h5 class="text-center mb-3">Please provide us with your basic details </h5>
                        <div class="create-profile border p-3 shadow-sm bg-body">
                            <form>
                                <div v-if="step === 1">
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="inputEmail4" class="form-label">Height Education</label>
                                                    <select class="form-select" v-model="formdata.height_education" aria-label="Default select example">
                                                        <option value="">Select</option>
                                                        <option v-for="education in educations" :key="education.id" :value="education.name">{{ education.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="collage_name" class="form-label">Highest Education College Name</label>
                                                    <input type="text" v-model="formdata.height_education_college_name" value="" id="college_name" class="form-control" placeholder="Highest Education College Name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="inputEmail4" class="form-label">Profession Type</label>
                                                    <select class="form-select" v-model="formdata.profession_type" aria-label="Default select example">
                                                        <option value="">Select</option>
                                                        <option value="Private Company" label="Private Company">Private Company</option>
                                                        <option value="Government / Public Sector" label="Government / Public Sector">Government / Public Sector</option>
                                                        <option value="Defense / Civil Services" label="Defense / Civil Services">Defense / Civil Services</option>
                                                        <option value="Business / Self Employed" label="Business / Self Employed">Business / Self Employed</option>
                                                        <option value="Non Working" label="Not Working">Not Working</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="inputEmail4" class="form-label">Profession Name</label>
                                                    <select class="form-select" v-model="formdata.profession_name" aria-label="Default select example">
                                                        <option value="">Select</option>
                                                        <option v-for="occupation in occupations" :key="occupation.id" :value="occupation.name">
                                                            {{ occupation.name }}
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="employer_name" class="form-label">Employer Name</label>
                                                    <input type="text" v-model="formdata.employer_name" value="" class="form-control" id="employer_name" placeholder="Employer Name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="mb-2">
                                                    <label for="inputEmail4" class="form-label">Annual Income</label>
                                                    <select class="form-select" v-model="formdata.annual_income" aria-label="Default select example">
                                                        <option value="">Select</option>
                                                        <option v-for="income in incomes" :key="income.id" :value="income.name">{{ income.name }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.prevent="next()">Next</button>
                                </div>

                                <div v-if="step === 2">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Height</label>
                                                <select class="form-select" v-model="formdata.height" aria-label="Default select example">
                                                    <option value="">Select</option>
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
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Marital Status</label>
                                                <select class="form-select" v-model="formdata.marital_status" @change="changeMaritalStatus">
                                                    <option value="">Marital status</option>
                                                    <option v-for="marital in maritalStatus" :key="marital.id" :value="marital.name">{{ marital.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" v-if="haveChild">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Have children</label>
                                                <select class="form-select" v-model="formdata.have_child" @change="changeHaveChild">
                                                    <option value="">Select</option>
                                                    <option value="Yes. Living together" label="Yes. Living together">Yes. Living together</option>
                                                    <option value="No" label="No" selected="selected">No</option>
                                                    <option value="Yes. Not living together" label="Yes. Not living together">Yes. Not living together</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" v-if="childNumber">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Children Number</label>
                                                <select class="form-select" v-model="formdata.child_number" aria-label="Default select example">
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
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Health Information</label>
                                                <select class="form-select" v-model="formdata.health_information" aria-label="Default select example">
                                                    <option value="">Select</option>
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
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Disability</label>
                                                <select class="form-select" v-model="formdata.disability" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="None">None</option>
                                                    <option value="Physical Disability">Physical Disability</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Blood Group</label>
                                                <select class="form-select" v-model="formdata.blood_group" aria-label="Default select example">
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
                                    <button @click.prevent="prev()">Previous</button>
                                    <button @click.prevent="next()">Next</button>
                                </div>

                                <div v-if="step === 3">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label for="inputEmail4" class="form-label">Religion</label>
                                                <select class="form-select" v-model="formdata.religion" aria-label="Default select example" @change="getCaste">
                                                    <option value="">Select</option>
                                                    <option v-for="religion in religions" :key="religion.id" :value="religion.id">{{ religion.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Caste / Community</label>
                                                <select class="form-select" v-model="formdata.caste" aria-label="Default select example" @change="getSubCaste">
                                                    <option value="">Select</option>
                                                    <option v-for="caste in castes" :key="caste.id" :value="caste.id">{{ caste.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Sub-Caste / Sub-Community</label>
                                                <select class="form-select" v-model="formdata.sub_caste" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="subCaste in subCastes" :key="subCaste.id" :value="subCaste.name">{{ subCaste.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Mother Language</label>
                                                <select class="form-select" v-model="formdata.mother_language" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="laguage in languages" :key="laguage.id" :value="laguage.name">{{ laguage.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Diet</label>
                                                <select class="form-select" v-model="formdata.diet" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="Veg">Veg</option>
                                                    <option value="Non-Veg">Non-Veg</option>
                                                    <option value="Occasionally Non-Veg">Occasionally Non-Veg</option>
                                                    <option value="Eggetarian">Eggetarian</option>
                                                    <option value="Jain">Jain</option>
                                                    <option value="Vegan">Vegan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.prevent="prev()">Previous</button>
                                    <button @click.prevent="next()">Next</button>
                                </div>
                                <div v-if="step === 4">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Father's Status</label>
                                                <select class="form-select" v-model="formdata.father_status" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="Employed" label="Employed">Employed</option>
                                                    <option value="Business" label="Business">Business</option>
                                                    <option value="Retired" label="Retired">Retired</option>
                                                    <option value="Not Employed" label="Not Employed">Not Employed</option>
                                                    <option value="Passed Away" label="Passed Away">Passed Away</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Mothers's Status</label>
                                                <select class="form-select" v-model="formdata.mother_status" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="Employed" label="Employed">Employed</option>
                                                    <option value="Business" label="Business">Business</option>
                                                    <option value="Retired" label="Retired">Retired</option>
                                                    <option value="Not Employed" label="Not Employed">Not Employed</option>
                                                    <option value="Passed Away" label="Passed Away">Passed Away</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Family Location</label>
                                                <input type="text" v-model="formdata.family_location" class="form-control" placeholder="Ex: Dhaka, Bangladesh">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Family Type</label>
                                                <select class="form-select" v-model="formdata.family_type" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="Joint">Joint </option>
                                                    <option value="Nuclear">Nuclear </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Family Value</label>
                                                <select class="form-select" v-model="formdata.family_value" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="familyValue in familyValues" :key="familyValue.id" :value="familyValue.name">{{ familyValue.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Family Status</label>
                                                <select class="form-select" v-model="formdata.family_status" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="familyStatu in familyStatus" :key="familyStatu.id" :value="familyStatu.name">{{ familyStatu.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-md-3 col-3">
                                                <label for="inputEmail4" class="form-label">Married Brother</label>
                                                <select class="form-select" v-model="formdata.married_brother" aria-label="Default select example">
                                                    <option value="0">0 </option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                    <option value="6">6 </option>
                                                    <option value="7">7 </option>
                                                    <option value="8">8 </option>
                                                    <option value="9">9 </option>
                                                    <option value="10">10 </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-3">
                                                <label for="inputEmail4" class="form-label">Married Sister</label>
                                                <select class="form-select" v-model="formdata.married_sister" aria-label="Default select example">
                                                    <option value="0">0 </option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                    <option value="6">6 </option>
                                                    <option value="7">7 </option>
                                                    <option value="8">8 </option>
                                                    <option value="9">9 </option>
                                                    <option value="10">10 </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-3">
                                                <label for="inputEmail4" class="form-label">Unmarried Brother</label>
                                                <select class="form-select" v-model="formdata.unmarried_brother" aria-label="Default select example">
                                                    <option value="0">0 </option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                    <option value="6">6 </option>
                                                    <option value="7">7 </option>
                                                    <option value="8">8 </option>
                                                    <option value="9">9 </option>
                                                    <option value="10">10 </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3 col-3">
                                                <label for="inputEmail4" class="form-label">Unmarried Sister</label>
                                                <select class="form-select" v-model="formdata.unmarried_sister" aria-label="Default select example">
                                                    <option value="0">0 </option>
                                                    <option value="1">1 </option>
                                                    <option value="2">2 </option>
                                                    <option value="3">3 </option>
                                                    <option value="4">4 </option>
                                                    <option value="5">5 </option>
                                                    <option value="6">6 </option>
                                                    <option value="7">7 </option>
                                                    <option value="8">8 </option>
                                                    <option value="9">9 </option>
                                                    <option value="10">10 </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.prevent="prev()">Previous</button>
                                    <button @click.prevent="next()">Next</button>
                                </div>
                                <div v-if="step === 5">
                                    <div class="row">
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Country Living In</label>
                                                <select @change="getStateList" class="form-select" v-model="formdata.country_living_in" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="country in countries" :key="country.id" :value="country.id">{{ country.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">State Living In</label>
                                                <select @change="getCityList" class="form-select" v-model="formdata.state_living_in" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="state in stateList" :key="state.id" :value="state.id">{{ state.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">City Living In</label>
                                                <select class="form-select" v-model="formdata.city_living_in" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="city in cityList" :key="city.id" :value="city.name">{{ city.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Residency status</label>
                                                <select class="form-select" v-model="formdata.residency_status" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option value="Citizen">Citizen</option>
                                                    <option value="Permanent Resident">Permanent Resident</option>
                                                    <option value="Work Permit">Work Permit</option>
                                                    <option value="Student Visa">Student Visa</option>
                                                    <option value="Temporary Visa">Temporary Visa</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Grew up in</label>
                                                <select class="form-select" v-model="formdata.grew_up_in" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="coun in countries" :key="coun.id" :value="coun.name">{{ coun.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Ethnic Origin</label>
                                                <select class="form-select" v-model="formdata.ethnic_origin" aria-label="Default select example">
                                                    <option value="">Select</option>
                                                    <option v-for="coun in countries" :key="coun.id" :value="coun.name">{{ coun.name }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 co-12">
                                            <div class="mb-2">
                                                <label for="inputEmail4" class="form-label">Zip/Pin Code</label>
                                                <input type="text" v-model="formdata.zip_code" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <button @click.prevent="prev()">Previous</button>
                                    <button @click.prevent="next()">Next</button>
                                </div>
                                <div v-if="step === 6">
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">About Yourself And Family</label>
                                        <textarea class="form-control" v-model="formdata.introduction" id="exampleFormControlTextarea1" rows="3" placeholder=""></textarea>
                                    </div>
                                    <button @click.prevent="prev()">Previous</button>
                                    <button @click.prevent="submit()">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <Footer/>
    </div>
</template>


<script>
import Header from '../home/HomeHeaderComponent.vue'
import Footer from '../footer/FooterComponent.vue'
import {mapState} from 'vuex'

export default {
    components:{
        Header,
        Footer
    },
    data: function() {
         return  {
            fName: null,
            lName: null,
            gender: '',
            email: null,
            year: '',
            month: '',
            day: '',
            countryCode: 880,
            mobile: null,
            password: null,
            conPassword: null,
            errors: [],
            emailExist: null,
            step:1,
            memberId: null,
            formdata:{
                onBehalf: '',
                height_education: '',
                height_education_college_name: null,
                profession_type: '',
                profession_name: '',
                employer_name: null,
                annual_income: '',
                height: '',
                marital_status: '',
                health_information: '',
                disability: '',
                blood_group: '',
                mother_language: '',
                religion: '',
                caste: '',
                sub_caste: '',
                diet: '',
                father_status: '',
                mother_status: '',
                family_location: null,
                family_type: '',
                family_value: '',
                family_status: '',
                married_brother: 0,
                married_sister: 0,
                unmarried_brother: 0,
                unmarried_sister: 0,
                country_living_in: '',
                state_living_in: '',
                city_living_in: '',
                residency_status: '',
                grew_up_in: '',
                ethnic_origin: '',
                zip_code: null,
                introduction: null,
                have_child: '',
                child_number: 0,
            },
            haveChild: false,
            childNumber: false,
            castes: null,
            subCastes: null,
            stateList: null,
            cityList: null,
         }
    },
    mounted () {
        this.$store.dispatch('getOnBehalf')
        this.$store.dispatch('getCountry')
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
    methods:{
        checkRegistration: function(e) {
            e.preventDefault();
            if (this.password === this.conPassword && this.fName && this.lName && this.gender && this.email && this.year && this.month && this.day && this.formdata.onBehalf && this.countryCode && this.mobile && this.password && this.conPassword) {
                this.errors = [];
                axios
                .post('api/app-registration',{
                    fName: this.fName,
                    lName: this.lName,
                    gender: this.gender,
                    email: this.email,
                    dateOfBirth: this.year+"-"+this.month+"-"+this.day,
                    onBehalf: this.formdata.onBehalf,
                    countryCode: this.countryCode,
                    phoneNumber: this.mobile,
                    password: this.password,
                    timezone: this.timezone,
                })
                .then(response => {
                    // console.log(response.data);
                    if (response.data == 'email') {
                        this.emailExist = 'Email is already exist ! Try another one.'
                    } else if(response.data == 'phone'){
                        this.emailExist = 'Phone Number is already exist ! Try another one.'
                    } else {
                        this.emailExist = '';
                        this.memberId = response.data
                        this.$router.push('/app-login')
                        // this.afterRegistration();
                    }
                })
                .catch(error => {
                    console.log(error)
                })
            } else {
                this.errors = [];
                if (!this.fName) {
                    this.errors.push('First Name required.');
                }
                if (!this.lName) {
                    this.errors.push('Last Name required.');
                }
                if (!this.gender) {
                    this.errors.push('Gender required.');
                }
                if (!this.email) {
                    this.errors.push('Email required.');
                } else if (!this.validEmail(this.email)) {
                    this.errors.push('Valid Email required.');
                }
                if (!this.year) {
                    this.errors.push('Birth Year required.');
                }
                if (!this.month) {
                    this.errors.push('Birth Month required.');
                }
                if (!this.day) {
                    this.errors.push('Birth Date required.');
                }
                if (!this.formdata.onBehalf) {
                    this.errors.push('On Behalf required.');
                }
                if (!this.countryCode) {
                    this.errors.push('Country Code required.');
                }
                if (!this.mobile) {
                    this.errors.push('Mobile Number required.');
                }
                if (!this.password) {
                    this.errors.push('Password required.');
                }
                if (!this.conPassword) {
                    this.errors.push('Confirm Password required.');
                }
                if (this.password != this.conPassword) {
                    this.errors.push('Password and Confirm Password not match.');
                }
                
                if (!this.errors.length) {
                    return true;
                }
            }
            
        },
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        prev() {
            this.step--;
        },
        next() {
            this.step++;
        },
        submit() {
            axios
            .post('api/registration-next/'+this.memberId,{
                formdata: this.formdata,
            })
            .then(response => {
                if (response.data) {
                    this.$router.push('/app-login')
                } else {
                    this.emailExist = 'Failed ! Try Again.';
                }
            })
            .catch(error => {
                console.log(error)
            })      
        },
        changeMaritalStatus(){
            if (this.formdata.marital_status != 'Single') {
                this.haveChild = true;
            } else {
                this.haveChild = false;
            }
        },
        changeHaveChild(){
            if (this.formdata.have_child != 'No') {
                this.childNumber = true;
            } else {
                this.childNumber = false;
            }
        },
        afterRegistration(){
            this.$store.dispatch('getEducation')
            this.$store.dispatch('getOccupation')
            this.$store.dispatch('getIncomes')
            this.$store.dispatch('getMaritalStatus')
            this.$store.dispatch('getReligion')
            this.$store.dispatch('getLanguage')
            this.$store.dispatch('getFamilyValue')
            this.$store.dispatch('getFamilyStatus')
            this.$store.dispatch('getCountry')
        },
        getCaste(){
        axios
            .get("api/caste/"+this.formdata.religion)
            .then((response) => {
            this.castes = response.data;
            this.subCastes = null;
            })
            .catch((error) => {
            console.log(error);
            });
        },
        getSubCaste(){
        axios
            .get("api/sub-caste/"+this.formdata.caste)
            .then((response) => {
            this.subCastes = response.data;
            })
            .catch((error) => {
            console.log(error);
            });
        },
        getStateList(){
        axios
            .get("api/state/"+this.formdata.country_living_in)
            .then((response) => {
                this.stateList = response.data;
                this.cityList = null;
            })
            .catch((error) => {
                console.log(error);
            });
        },
        getCityList(){
        axios
            .get("api/city/"+this.formdata.state_living_in)
            .then((response) => {
                this.cityList = response.data;
            })
            .catch((error) => {
                console.log(error);
            });
        },
    }
}
</script>