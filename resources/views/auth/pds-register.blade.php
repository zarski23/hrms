<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="{{ URL::to('assets/img/deped_leyte_logo.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Button -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: url("{{ asset('assets/img/bagong-pilipinas-bg.png') }}") no-repeat top center;
            background-size: cover;
            background-attachment: fixed;
            height: 100vh;
            margin: 0;
            position: relative;
        }

        .container-full {
            width: 90%;
            max-width: 100%;
        }
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            width: 250px;
            height: auto;
        }
        .heading {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 2rem;
            font-weight: bold;
            text-shadow: 
                -2px -2px 0 white,  
                2px -2px 0 white,  
                -2px  2px 0 white,  
                2px  2px 0 white; /* White outline effect */
        }
        
    </style>
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-100">

    <!-- Home Button -->
    <div style="position: absolute; top: 0; left: 0; margin: 10px; color: red;">
        <a href="home"><button class="btn"><i class="fa fa-home"></i> Login Page</button></a>
    </div>

    <div class="logo-container">
        <a href="https://depedleytedivision.com/"><img src="{{ asset('assets/img/deped_leyte_logo.png') }}" style="max-width: 60px; margin: 5px 7px 0 0;"></a>
        <a href="https://depedleytedivision.com/transparency-seal/"><img src="{{ asset('assets/img/transparency_seal.png') }}" style="max-width: 60px; margin: 5px 7px 0 0;"></a>
        <a href="home"><img src="{{ asset('assets/img/deped-logo.png') }}" style="max-width: 100px; margin: 8px 8px 0 8px;"></a>
        <a href="https://dasp.website/public/"><img src="{{ asset('assets/img/dasp-logo.png') }}" style="max-width: 85px;"></a>
        <a href="https://pdms.website/public/"><img src="{{ asset('assets/img/pdms-logo1.png') }}" style="max-width: 65px; margin: 3px 0 0 -5px;"></a>
    </div>


    <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0 ">
        <h1 class="text-center font-extrabold mb-6 heading">
            PERSONAL DATA SHEET
        </h1>


        <div class="container-full bg-white shadow-lg rounded-lg px-16 py-10">
            <form method="POST" action="{{ route('store') }}" enctype="multipart/form-data">
                @csrf

                <button type="button" onclick="populateFakeData()" class="px-4 rounded-md mt-4">Auto-Fill Test Data</button>

                <!-- Personal Information -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">I. Personal Information</h2>
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-2" colspan="2"><x-input-label for="fname" :value="__('First Name:')"/></td>
                        <td class="p-2"><x-input-label for="mname" :value="__('Middle Name:')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="lname" :value="__('Last Name:')" /></td>
                        <td class="p-2"><x-input-label for="xname" :value="__('Extension Name:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="2"><x-text-input id="fname" class="w-full" type="text" name="first_name" pattern="^[A-Za-z]+$" placeholder="Jane" required /></td>
                        <td class="p-2"><x-text-input id="mname" class="w-full" type="text" name="middle_name" pattern="^[A-Za-z]+$" placeholder="Smith (Optional)"/></td>
                        <td class="p-2" colspan="2"><x-text-input id="lname" class="w-full" type="text" name="last_name" pattern="^[A-Za-z]+$"  placeholder="Doe" required /></td>
                        <td class="p-2"><x-text-input id="xname" class="w-full" type="text" name="name_extension" pattern="^[A-Za-z]+$" placeholder="Junior/Jr. (Optional)" /></td>
                    </tr>

                    <tr>
                        <td class="p-2"><x-input-label for="dob" :value="__('Date of Birth:')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="pob" :value="__('Place of Birth:')" /></td>
                        <td class="p-2"><x-input-label for="gender" :value="__('Gender:')" /></td>
                        <td class="p-2"><x-input-label for="civil_status" :value="__('Civil Status:')" /></td>
                        <td class="p-2"><x-input-label for="citizenship" :value="__('Citizenship:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="dob" class="w-full" type="date" name="date_of_birth" required /></td>
                        <td class="p-2" colspan="2"><x-text-input id="pob" class="w-full" type="text" name="place_of_birth" maxlength=100 placeholder="Tacloban City, Leyte" required /></td>
                        <td class="p-2">
                            <select id="gender" name="sex" class="w-full border-gray-300 rounded-md">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </td>
                        <td class="p-2">
                            <select id="civil_status" name="civil_status" class="w-full border-gray-300 rounded-md">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Separated">Separated</option>
                                <option value="Others">Others</option>
                            </select>
                        </td>
                        <td class="p-2"><x-text-input id="citizenship" class="w-full" type="text" name="citizenship" pattern="^[A-Za-z]+$" maxlength=45 placeholder="Filipino" required /></td>
                    </tr>

                    <tr>
                        <td class="p-2"><x-input-label for="height" :value="__('Height (m):')" /></td>
                        <td class="p-2"><x-input-label for="weight" :value="__('Weight (kg):')" /></td>
                        <td class="p-2"><x-input-label for="blood_type" :value="__('Blood Type:')" /></td>
                        <td class="p-2"><x-input-label for="mobile_no" :value="__('Mobile No:')" /></td>
                        <td class="p-2"><x-input-label for="telephone_no" :value="__('Telephone No:')" /></td>
                        <td class="p-2"><x-input-label for="email_address" :value="__('Email Address:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2">
                            <x-text-input id="height" class="w-full" type="text" name="height_cm" pattern="^\d{1,6}\.\d{2}$" maxlength="7" placeholder="170.50" required />
                        </td>
                        <td class="p-2">
                            <x-text-input id="weight" class="w-full" type="text" name="weight_kg" pattern="^\d{1,6}\.\d{2}$" maxlength="7" placeholder="65.75" required />
                        </td>
                        
                        <td class="p-2"><x-text-input id="blood_type" class="w-full" type="text" name="blood_type" pattern="^(A|B|AB|O)[+-]?$ " maxlength=3 placeholder="A+" required /></td>
                        <td class="p-2">
                            <x-text-input id="mobile_no" class="w-full" type="text" name="mobile_no" pattern="^\d{11}$" placeholder="09123456789" required />
                        </td>
                        <td class="p-2">
                            <x-text-input id="telephone_no" class="w-full" type="text" name="telephone_no" pattern="^[\d\s]+$" maxlength="20" placeholder="02 123 4567" required />
                        </td>
                        
                        <td class="p-2"><x-text-input id="email_address" class="w-full" type="email" name="email_address" placeholder="jane.doe@email.com" required /></td>
                    </tr>

                    <tr>
                        <td class="p-2"><x-input-label for="gsis" :value="__('GSIS ID No:')" /></td>
                        <td class="p-2"><x-input-label for="pagibig" :value="__('Pag-ibig ID No:')" /></td>
                        <td class="p-2"><x-input-label for="philhealth" :value="__('Philhealth No:')" /></td>
                        <td class="p-2"><x-input-label for="sss" :value="__('SSS No:')" /></td>
                        <td class="p-2"><x-input-label for="tin" :value="__('TIN No:')" /></td>
                        <td class="p-2"><x-input-label for="agency_employee_no" :value="__('Agency Employee No:')" /></td>
                    </tr>
    


                    <td class="p-2">
                        <x-text-input id="gsis" class="w-full" type="text" name="gsis_no" pattern="^\d{1,3}( ?\d{3}){3}$" placeholder="123 456 789 01"  />
                    </td>
                    <td class="p-2">
                        <x-text-input id="pagibig" class="w-full" type="text" name="pagibig_no" pattern="^\d{1,3}( ?\d{3}){3}$" placeholder="123 456 789 012"  />
                    </td>
                    <td class="p-2">
                        <x-text-input id="philhealth" class="w-full" type="text" name="philhealth_no" pattern="^\d{1,3}( ?\d{3}){3}$" placeholder="123 456 789 012"  />
                    </td>
                    <td class="p-2">
                        <x-text-input id="sss" class="w-full" type="text" name="sss_no" pattern="^\d{1,3}( ?\d{3}){3}$" placeholder="123 456 789 012"  />
                    </td>
                    <td class="p-2">
                        <x-text-input id="tin" class="w-full" type="text" name="tin_no" pattern="^\d{1,3}( ?\d{3}){3}$" placeholder="123 456 789 012"  />
                    </td>
                    <td class="p-2">
                        <x-text-input id="agency_employee_no" class="w-full" type="number" name="agency_employee_no" maxlength="6" placeholder="123456" />
                    </td>

                </table>
                <table>

                    <!-- Residential Address -->
                    <tr>
                        <td class="p-2" colspan="6" class="font-bold"><b>Residential Address:</b></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-input-label for="res_house_no" :value="__('House/Block/Lot No.:')" /></td>
                        <td class="p-2"><x-input-label for="res_street" :value="__('Street:')" /></td>
                        <td class="p-2"><x-input-label for="res_subdivision" :value="__('Subdivision/Village:')" /></td>
                        <td class="p-2"><x-input-label for="res_barangay" :value="__('Barangay:')" /></td>
                        <td class="p-2"><x-input-label for="res_city" :value="__('City/Municipality:')" /></td>
                        <td class="p-2"><x-input-label for="res_province" :value="__('Province:')" /></td>
                        <td class="p-2"><x-input-label for="res_zip" :value="__('Zip Code:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="res_house_no" class="w-full" type="text" name="res_house_no" placeholder="101" /></td>
                        <td class="p-2"><x-text-input id="res_street" class="w-full" type="text" name="res_street"  maxlength=45 placeholder="Jose Rizal Street/St." required/></td>
                        <td class="p-2"><x-text-input id="res_subdivision" class="w-full" type="text" name="res_subdivision"  maxlength=45 placeholder="Camella Homes" /></td>
                        <td class="p-2"><x-text-input id="res_barangay" class="w-full" type="text" name="res_barangay" maxlength=45 placeholder="Barangay 101" required /></td>
                        <td class="p-2"><x-text-input id="res_city" class="w-full" type="text" name="res_city"  maxlength=75 placeholder="Tacloban City" required /></td>
                        <td class="p-2"><x-text-input id="res_province" class="w-full" type="text" name="res_province" maxlength=45 placeholder="Leyte" required /></td>
                        <td class="p-2"><x-text-input id="res_zip" class="w-full" type="text" name="res_zip" maxlength=4 placeholder="1010" required /></td>
                    </tr>

                    <!-- Permanent Address -->
                    <tr>
                        <td class="p-2" colspan="6" class="font-bold"><b>Permanent Address:</b></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-input-label for="perm_house_no" :value="__('House/Block/Lot No.:')" /></td>
                        <td class="p-2"><x-input-label for="perm_street" :value="__('Street:')" /></td>
                        <td class="p-2"><x-input-label for="perm_subdivision" :value="__('Subdivision/Village:')" /></td>
                        <td class="p-2"><x-input-label for="perm_barangay" :value="__('Barangay:')" /></td>
                        <td class="p-2"><x-input-label for="perm_city" :value="__('City/Municipality:')" /></td>
                        <td class="p-2"><x-input-label for="perm_province" :value="__('Province:')" /></td>
                        <td class="p-2"><x-input-label for="perm_zip" :value="__('Zip Code:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="perm_house_no" class="w-full" type="text" name="perm_house_no" placeholder="101" /></td>
                        <td class="p-2"><x-text-input id="perm_street" class="w-full" type="text" name="perm_street"  maxlength=45 placeholder="Jose Rizal Street/St." /></td>
                        <td class="p-2"><x-text-input id="perm_subdivision" class="w-full" type="text" name="perm_subdivision" maxlength=45 placeholder=" Camella Homes" /></td>
                        <td class="p-2"><x-text-input id="perm_barangay" class="w-full" type="text" name="perm_barangay"  maxlength=75 placeholder="Barangay 101" required /></td>
                        <td class="p-2"><x-text-input id="perm_city" class="w-full" type="text" name="perm_city" maxlength=45 placeholder="Tacloban City" required /></td>
                        <td class="p-2"><x-text-input id="perm_province" class="w-full" type="text" name="perm_province" maxlength=45 placeholder="Leyte" required /></td>
                        <td class="p-2"><x-text-input id="perm_zip" class="w-full" type="text" name="perm_zip" maxlength=4 placeholder="1010" required /></td>
                    </tr>
                </table>


                <!-- Family Background -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">II. Family Background</h2>
                <table class="w-full border-collapse" id="children-table">
                    <tr>
                        <td class="p-2" colspan="3"><x-input-label for="spouse_name" :value="__('Spouse’s Name')"  /></td>
                        <td class="p-2"><x-input-label for="spouse_occupation" :value="__('Occupation')" maxlength=100 /></td>
                        <td class="p-2" colspan="2"><x-input-label for="spouse_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2"><x-input-label for="spouse_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="spouse_tel_no" :value="__('Telephone No.')"/></td>
                    </tr>

                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="spouse_name" class="w-full" type="text" name="spouse_name" maxlength="100" pattern="[A-Za-zÀ-ž\\-\\' ]+" placeholder=" John A. Smith" /></td>
                        <td class="p-2"><x-text-input id="spouse_occupation" class="w-full" type="text" name="spouse_occupation" maxlength="100" placeholder=" Policeman" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="spouse_employer" class="w-full" type="text" name="spouse_employer" maxlength="100" pattern="[A-Za-z0-5,.&\\- ]+" placeholder=" PNP-Tacloban" oninput="this.value = this.value.replace(/[^A-Za-z0-9,.&\- ]/g, '')"/></td>
                        <td class="p-2"><x-text-input id="spouse_business_address" class="w-full" type="text" name="spouse_business_address" placeholder=" Tacloban City, Leyte" maxlength="100"/></td>
                        <td class="p-2"><x-text-input id="spouse_tel_no" class="w-full" type="text" name="spouse_tel_no" maxlength="20" pattern="[0-9\-]+" placeholder=" 02 123 4567" oninput="this.value = this.value.replace(/[^0-9\-]/g, '')"/></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-input-label for="father_name" :value="__('Father’s Name')" /></td>
                        <td class="p-2"><x-input-label for="father_occupation" :value="__('Occupation')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="father_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2"><x-input-label for="father_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="father_tel_no" :value="__('Telephone No.')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="father_name" class="w-full" type="text" name="father_name" placeholder=" Juan A. Doe" required /></td>
                        <td class="p-2"><x-text-input id="father_occupation" class="w-full" type="text" name="father_occupation" placeholder=" Teacher"  /></td>
                        <td class="p-2" colspan="2"><x-text-input id="father_employer" class="w-full" type="text" name="father_employer" placeholder=" Tacloban National High School"/></td>
                        <td class="p-2"><x-text-input id="father_business_address" class="w-full" type="text" name="father_business_address" placeholder=" Tacloban City, Leyte"/></td>
                        <td class="p-2"><x-text-input id="father_tel_no" class="w-full" type="text" name="father_tel_no" placeholder=" 02 123 4567" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-input-label for="mother_name" :value="__('Mother’s Maiden Name')"/></td>
                        <td class="p-2"><x-input-label for="mother_occupation" :value="__('Occupation')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="mother_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2"><x-input-label for="mother_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="mother_tel_no" :value="__('Telephone No.')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="mother_name" class="w-full" type="text" name="mother_name" placeholder=" Juanita B. Doe" required /></td>
                        <td class="p-2"><x-text-input id="mother_occupation" class="w-full" type="text" name="mother_occupation" placeholder=" Teacher" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="mother_employer" class="w-full" type="text" name="mother_employer" placeholder=" Tacloban National High School"/></td>
                        <td class="p-2"><x-text-input id="mother_business_address" class="w-full" type="text" name="mother_business_address" placeholder=" Tacloban City, Leyte"/></td>
                        <td class="p-2"><x-text-input id="mother_tel_no" class="w-full" type="text" name="mother_tel_no" placeholder=" 02 123 4567" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="6"><x-input-label :value="__('Children’s Name (Write full name and list all)')" /></td>
                        <td class="p-2"><x-input-label :value="__('Date of Birth (MM/DD/YYYY)')" /></td>
                    </tr>
                        <td class="p-2" colspan="6"><x-text-input class="w-full" type="text" name="children[0][fullname]" placeholder=" Allen Alfred D. Beato" required /></td>
                        <td class="p-2"><x-text-input class="w-full" type="date" name="children[0][birthdate]" /></td>
                        <td class="p-2">
                        <button type="button" id="add-child" class="bg-blue-500 text-black px-2 py-1 rounded">Add Child</button>
                        </td>
                </table>

            
               <!-- Educational Background -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">III. Educational Background</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Level</th>
                            <th class="p-2 border border-gray-300">Name of School</th>
                            <th class="p-2 border border-gray-300">Degree/Course</th>
                            <th class="p-2 border border-gray-300">Year Graduated</th>
                            <th class="p-2 border border-gray-300">Highest Level/Units Earned</th>
                            <th class="p-2 border border-gray-300">Inclusive Dates of Attendance</th>
                            <th class="p-2 border border-gray-300">Scholarship/Academic Honors Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Elementary -->
                        <tr>
                            <td class="p-2 border border-gray-300">Elementary</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_school" placeholder="Tacloban Elementary School" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_year_graduated" placeholder="2005" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_dates_attended" placeholder="1999-2005" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_honors" placeholder="With Honor"/></td>
                        </tr>
                        
                        <!-- Secondary -->
                        <tr>
                            <td class="p-2 border border-gray-300">Secondary</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_school" placeholder="Tacloban National High School" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_year_graduated" placeholder="2009" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_dates_attended" placeholder="2005-2009"  required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_honors" placeholder="With Honor" /></td>
                        </tr>
                        
                        <!-- Vocational/Trade Course -->
                        <tr>
                            <td class="p-2 border border-gray-300">Vocational/Trade Course</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_school" placeholder="--Optional--"/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_course" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_year_graduated" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_units" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_dates_attended" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_honors" /></td>
                        </tr>

                        <!-- College -->
                        <tr>
                            <td class="p-2 border border-gray-300">College</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_school" placeholder="University of Tacloban" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_course" placeholder="Bachelor of Secondary Education" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_year_graduated" placeholder="2013" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="college_units" placeholder="180" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_dates_attended" placeholder="2009-2013" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_honors" placeholder="Cum Laude" /></td>
                        </tr>

                        <!-- Graduate Studies -->
                        <tr>
                            <td class="p-2 border border-gray-300">Graduate Studies</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_school" placeholder="University of Tacloban"/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_course" placeholder="Master of Arts in Education"/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_year_graduated" placeholder="2016" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="graduate_units" placeholder="42" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_dates_attended" placeholder="2014-2016"/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_honors" placeholder="Academic Execellence Awardee"/></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Civil Service Eligibility -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">IV. Civil Service Eligibility</h2>
                <table class="w-full border-collapse border border-gray-300" id="csc-table">
                    <thead class="bg-gray-200" >
                        <tr>
                            <th class="p-2 border border-gray-300">Career Service/RA 1080 (Board/Bar) Under Special Laws/CES/CSEE</th>
                            <th class="p-2 border border-gray-300">Rating (If applicable)</th>
                            <th class="p-2 border border-gray-300">Date of Examination/Conferment</th>
                            <th class="p-2 border border-gray-300">Place of Examination/Conferment</th>
                            <th class="p-2 border border-gray-300">License Number (If applicable)</th>
                            <th class="p-2 border border-gray-300">Date of Validity</th>
                            <th class="p-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[0][eligibility_type]" placeholder="CSEE" required /></td>
                            <td class="p-2 border border-gray-300">
                                <x-text-input class="w-full" type="text" name="csc_children[0][eligibility_rating]" maxlength="7" pattern="^\d{1,3}\.\d{2}$" placeholder=" 85.00%" required />
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="csc_children[0][eligibility_exam_date]" placeholder="March 1, 2018" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[0][eligibility_exam_place]" placeholder="Cebu City" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[0][eligibility_license_number]" placeholder="CSC-CSEE-2025-00123"/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="csc_children[0][eligibility_validity_date]" placeholder="January 1, 2025"/></td>
                            <td class="p-2 border border-gray-300"><button type="button" id="add-csc" class="bg-green-500 text-black px-2 py-1 rounded">Add More</button></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Work Experience -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">V. Work Experience</h2>
                <table class="w-full border-collapse border border-gray-300" id="workexperiences-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Position Title</th>
                            <th class="p-2 border border-gray-300">Department/Agency/Office/Company</th>
                            <th class="p-2 border border-gray-300">Monthly Salary</th>
                            <th class="p-2 border border-gray-300">Salary/Job/Pay Grade & Step</th>
                            <th class="p-2 border border-gray-300">Status of Appointment</th>
                            <th class="p-2 border border-gray-300">Gov’t Service (Yes/No)</th>
                            <th class="p-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300">
                                <div class="flex space-x-2">
                                    <x-text-input class="w-full mt-1" type="date" name="workexp_children[0][work_exp_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="workexp_children[0][work_exp_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[0][work_position]" placeholder="Teacher I" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[0][work_agency]" placeholder="Tacloban National High School" required /></td>
                            <td class="p-2 border border-gray-300">
                                <x-text-input class="w-full" type="text" name="workexp_children[0][work_salary]" pattern="^\d{1,6}\.\d{2}$" maxlength="10" placeholder="25,000.00" required />
                            </td>
                            
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[0][work_salary_grade]" placeholder="20,000.00-30,000.00" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[0][work_status]" placeholder="Permamnent" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="workexp_children[0][work_gov_service]" class="w-full border-gray-300 rounded-md">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </td>
                            <td class="p-2 border border-gray-300"><button type="button" id="add-workexperiences" class=" bg-blue-500 text-black px-2 py-1 rounded ">Add More</button></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Voluntary Work -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">VI. Voluntary Work</h2>
                <table class="w-full border-collapse border border-gray-300" id="voluntarywork-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Name & Address of Organization</th>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Number of Hours</th>
                            <th class="p-2 border border-gray-300">Position / Nature of Work</th>
                            <th class="p-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="volunteerwork_children[0][vol_org]" placeholder="Education Foundation of the Philippines" required /></td>
                            <td class="p-2 border border-gray-300">
                                <div class="flex items-center space-x-2">
                                    <x-text-input class="w-full" type="date" name="volunteerwork_children[0][vol_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="volunteerwork_children[0][vol_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="volunteerwork_children[0][vol_hours]" placeholder="120" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="volunteerwork_children[0][vol_position]" placeholder="Treasurer" required /></td>
                            <td class="p-2 border border-gray-300"><button type="button" id="add-voluntarywork" class="bg-blue-500 text-black px-2 py-1 rounded">Add More</button></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Learning and Development -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">VII. Learning & Development (L&D) Programs</h2>
                <table class="w-full border-collapse border border-gray-300" id="trainingprogram-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Title of Learning & Development Programs</th>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Number of Hours</th>
                            <th class="p-2 border border-gray-300">Type of L&D</th>
                            <th class="p-2 border border-gray-300">Conducted / Sponsored By</th>
                            <th class="p-2 border border-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="trainingprogram_children[0][ld_title]" placeholder="Career Progression Program" required /></td>
                            <td class="p-2 border border-gray-300">
                                <div class="flex items-center space-x-2">
                                    <x-text-input class="w-full" type="date" name="trainingprogram_children[0][ld_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="trainingprogram_children[0][ld_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="trainingprogram_children[0][ld_hours]" placeholder="120" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="trainingprogram_children[0][ld_type]" class="w-full border-gray-300 rounded-md">
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option>
                                </select>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="trainingprogram_children[0][ld_sponsor]" placeholder="DEPED" required /></td>
                            <td class="p-2 border border-gray-300"><button type="button" id="add-trainingprogram" class="bg-blue-500 text-black px-2 py-1 rounded">Add More</button></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Other Information -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">VIII. Other Information</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Special Skills and Hobbies</th>
                            <th class="p-2 border border-gray-300">Non-Academic Distinctions / Recognition</th>
                            <th class="p-2 border border-gray-300">Membership in Association / Organization</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="skills_hobbies" placeholder="Cooking, Chess" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="distinctions" placeholder="Intern Growth Awardee " required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="membership" placeholder="PAFTE" required /></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Last Page: Questions -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">Additional Questions</h2>
                @foreach (['Are you related by consanguinity or affinity to the appointing authority?' => 'q1', 
                        'Have you ever been convicted of any crime?' => 'q2', 
                        'Have you ever been separated from service for cause?' => 'q3'] as $question => $name)
                    <div class="mb-4">
                        <label class="block text-gray-700">{{ $question }}</label>
                        <div class="mt-1">
                            <label class="inline-flex items-center">
                                <input type="radio" class="form-radio" name="{{ $name }}" value="Yes" required>
                                <span class="ml-2">Yes</span>
                            </label>
                            <label class="inline-flex items-center ml-4">
                                <input type="radio" class="form-radio" name="{{ $name }}" value="No" required>
                                <span class="ml-2">No</span>
                            </label>
                        </div>
                    </div>
                @endforeach



                <!-- References -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">References</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Name</th>
                            <th class="p-2 border border-gray-300">Address</th>
                            <th class="p-2 border border-gray-300">Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <tr>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[0][reference_name]" placeholder="Alfred A. Dela Cruz" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[0][reference_address]" placeholder="Mayorga, Leyte" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[0][contact_no]" placeholder="09123456789" required />
                                </td>
                            </tr>

                            <tr>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[1][reference_name]" placeholder="Marco B. Dela Torre" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[1][reference_address]" placeholder="Alang-Alang, Leyte" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[1][contact_no]" placeholder="09123456789" required />
                                </td>
                            </tr>

                            <tr>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[2][reference_name]" placeholder="Angelo C. Dela Rosa" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[2][reference_address]" placeholder="Jaro, Leyte" required />
                                </td>
                                <td class="p-2 border border-gray-300">
                                    <x-text-input class="w-full" type="text" name="references[2][contact_no]" placeholder="09123456789" required />
                                </td>
                            </tr>
                            
                        </tr>
                    </tbody>
                </table>

                <!-- File Upload -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">File Upload</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Personal Data Sheet</th>
                            <th class="p-2 border border-gray-300">Appointment</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300">
                                <input class="w-full border-gray-300 rounded-md" type="file" name="pdf_file" accept=".pdf"  />
                            </td>
                            <td class="p-2 border border-gray-300">
                                <input class="w-full border-gray-300 rounded-md" type="file" name="appointment_file" accept=".pdf"  />
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- APPOINTMENT TITLE -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">Appoinment Form</h2>

                <table class="w-full border-collapse border border-gray-300" id="csc-table">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Plantilla No</th>
                            {{-- <th class="p-2 border border-gray-300">Employee No</th> --}}
                            <th class="p-2 border border-gray-300">School ID</th>
                            <th class="p-2 border border-gray-300">School Name</th>
                            <th class="p-2 border border-gray-300">District</th>
                            <th class="p-2 border border-gray-300">Appointment Status</th>
                            <th class="p-2 border border-gray-300">Date of Effectivity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_platilla/></td>
                            {{-- <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_/></td> --}}
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_schoolId/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_schooName/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_district/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name=appointment_status/></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name=appointment_/></td>
                        </tr>
                    </tbody>
                </table>




                <!-- Submit Button -->
                <br>
                <div class="flex justify-center mt-8">
                    <x-primary-button class="py-3 text-lg flex justify-center" style="width: 300px; background-color: green; color: white; transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor='#006400'"
                        onmouseout="this.style.backgroundColor='green'">
                        {{ __('Submit') }}
                    </x-primary-button>
                </div>
                <br>
            </form>
        </div>
        <div class="w-full shadow-lg px-2 py-2 mt-4" style="background: rgba(255, 255, 255, 0.5);">
            <p class="text-center">© 2025 DJ § Jovie . All rights reserved.</p>
        </div>


    </div>

    <script>
        function populateFakeData() {
            document.getElementById("fname").value = "John";
            document.getElementById("mname").value = "Doe";
            document.getElementById("lname").value = "Smith";
            document.getElementById("xname").value = "Jr";
            document.getElementById("dob").value = "1990-05-15";
            document.getElementById("pob").value = "New York";
            document.getElementById("gender").value = "Male";
            document.getElementById("civil_status").value = "Single";
            document.getElementById("citizenship").value = "American";
            document.getElementById("height").value = "1.75";
            document.getElementById("weight").value = "70.65";
            document.getElementById("blood_type").value = "O+";
            document.getElementById("mobile_no").value = "09123456789";
            document.getElementById("telephone_no").value = "123 4567 123";
            document.getElementById("email_address").value = "john.smith@example.com";
            document.getElementById("gsis").value = "123 456 789 011";
            document.getElementById("pagibig").value = "123 456 789 011";
            document.getElementById("philhealth").value = "123 456 789 011";
            document.getElementById("sss").value = "123 456 789 011";
            document.getElementById("tin").value = "123 456 789 011";
            document.getElementById("agency_employee_no").value = "EMP-001";

            // Residential Address
            document.getElementById("res_house_no").value = "123";
            document.getElementById("res_street").value = "Main Street";
            document.getElementById("res_subdivision").value = "Green Village";
            document.getElementById("res_barangay").value = "Barangay Uno";
            document.getElementById("res_city").value = "Metro City";
            document.getElementById("res_province").value = "Central Province";
            document.getElementById("res_zip").value = "1000";

            // Permanent Address
            document.getElementById("perm_house_no").value = "456";
            document.getElementById("perm_street").value = "Second Street";
            document.getElementById("perm_subdivision").value = "Blue Subdivision";
            document.getElementById("perm_barangay").value = "Barangay Dos";
            document.getElementById("perm_city").value = "Urban City";
            document.getElementById("perm_province").value = "Northern Province";
            document.getElementById("perm_zip").value = "2000";

            // Family Background
            document.getElementById("spouse_name").value = "Jane Doe";
            document.getElementById("spouse_occupation").value = "Engineer";
            document.getElementById("spouse_employer").value = "Tech Corp";
            document.getElementById("spouse_business_address").value = "123 Tech Park";
            document.getElementById("spouse_tel_no").value = "123-4567";

            document.getElementById("father_name").value = "John Doe Sr.";
            document.getElementById("father_occupation").value = "Businessman";
            document.getElementById("father_employer").value = "Doe Enterprises";
            document.getElementById("father_business_address").value = "Business Street";
            document.getElementById("father_tel_no").value = "987-6543";

            document.getElementById("mother_name").value = "Mary Doe";
            document.getElementById("mother_occupation").value = "Teacher";
            document.getElementById("mother_employer").value = "ABC School";
            document.getElementById("mother_business_address").value = "School Road";
            document.getElementById("mother_tel_no").value = "654-7890";

            // Children Fields
            document.querySelector('input[name="children[0][fullname]"]').value = 'John Doe Jr.';
            document.querySelector('input[name="children[0][birthdate]"]').value = '2020-05-15';


            // Elementary
            document.getElementsByName("elementary_school")[0].value = "ABC Elementary School";
            document.getElementsByName("elementary_year_graduated")[0].value = "2008";
            document.getElementsByName("elementary_dates_attended")[0].value = "2002 - 2008";
            document.getElementsByName("elementary_honors")[0].value = "With Honors";

            // Secondary
            document.getElementsByName("secondary_school")[0].value = "XYZ High School";
            document.getElementsByName("secondary_year_graduated")[0].value = "2012";
            document.getElementsByName("secondary_dates_attended")[0].value = "2008 - 2012";
            document.getElementsByName("secondary_honors")[0].value = "Top 10%";

            // Vocational
            document.getElementsByName("vocational_school")[0].value = "Tech Voc Institute";
            document.getElementsByName("vocational_course")[0].value = "Computer Programming";
            document.getElementsByName("vocational_year_graduated")[0].value = "2013";
            document.getElementsByName("vocational_units")[0].value = "Complete";
            document.getElementsByName("vocational_dates_attended")[0].value = "2012 - 2013";
            document.getElementsByName("vocational_honors")[0].value = "Best in Programming";

            // College
            document.getElementsByName("college_school")[0].value = "State University";
            document.getElementsByName("college_course")[0].value = "Bachelor of Science in Information Technology";
            document.getElementsByName("college_year_graduated")[0].value = "2017";
            document.getElementsByName("college_units")[0].value = "Complete";
            document.getElementsByName("college_dates_attended")[0].value = "2013 - 2017";
            document.getElementsByName("college_honors")[0].value = "Cum Laude";

            // Graduate Studies
            document.getElementsByName("graduate_school")[0].value = "National Graduate University";
            document.getElementsByName("graduate_course")[0].value = "Master of Science in Data Science";
            document.getElementsByName("graduate_year_graduated")[0].value = "2021";
            document.getElementsByName("graduate_units")[0].value = "Complete";
            document.getElementsByName("graduate_dates_attended")[0].value = "2019 - 2021";
            document.getElementsByName("graduate_honors")[0].value = "Dean's List";

            document.querySelector('input[name="csc_children[0][eligibility_type]"]').value = 'Professional License'; // Dummy eligibility type
            document.querySelector('input[name="csc_children[0][eligibility_rating]"]').value = '89.75'; // Dummy rating
            document.querySelector('input[name="csc_children[0][eligibility_exam_date]"]').value = '2025-03-03'; // Dummy date
            document.querySelector('input[name="csc_children[0][eligibility_exam_place]"]').value = 'Sample Place';
            document.querySelector('input[name="csc_children[0][eligibility_license_number]"]').value = '123456789';
            document.querySelector('input[name="csc_children[0][eligibility_validity_date]"]').value = '2026-03-03'; // Dummy validity date

            // Training Program Fields
            document.querySelector('input[name="trainingprogram_children[0][ld_title]"]').value = 'Leadership Training';
            document.querySelector('input[name="trainingprogram_children[0][ld_from]"]').value = '2025-03-01';
            document.querySelector('input[name="trainingprogram_children[0][ld_to]"]').value = '2025-03-03';
            document.querySelector('input[name="trainingprogram_children[0][ld_hours]"]').value = '16';
            document.querySelector('select[name="trainingprogram_children[0][ld_type]"]').value = 'Technical'; // Matching option value
            document.querySelector('input[name="trainingprogram_children[0][ld_sponsor]"]').value = 'XYZ Training Center';

            // Volunteer Work Fields
            document.querySelector('input[name="volunteerwork_children[0][vol_org]"]').value = 'Community Helpers';
            document.querySelector('input[name="volunteerwork_children[0][vol_from]"]').value = '2024-06-01';
            document.querySelector('input[name="volunteerwork_children[0][vol_to]"]').value = '2024-06-10';
            document.querySelector('input[name="volunteerwork_children[0][vol_hours]"]').value = '40';
            document.querySelector('input[name="volunteerwork_children[0][vol_position]"]').value = 'Volunteer Assistant';

            // Work Experience Fields
            document.querySelector('input[name="workexp_children[0][work_exp_from]"]').value = '2024-01-01';
            document.querySelector('input[name="workexp_children[0][work_exp_to]"]').value = '2024-12-31';
            document.querySelector('input[name="workexp_children[0][work_position]"]').value = 'Software Developer';
            document.querySelector('input[name="workexp_children[0][work_agency]"]').value = 'Tech Solutions Inc.';
            document.querySelector('input[name="workexp_children[0][work_salary]"]').value = '25000.00';
            document.querySelector('input[name="workexp_children[0][work_salary_grade]"]').value = 'SG-18';
            document.querySelector('input[name="workexp_children[0][work_status]"]').value = 'Permanent';
            document.querySelector('select[name="workexp_children[0][work_gov_service]"]').value = '1'; // 1 = Yes, 0 = No

            //  Other Information Fields
            document.querySelector('input[name="skills_hobbies"]').value = "Programming, Music, Sports";
            document.querySelector('input[name="distinctions"]').value = "Best Employee of the Year 2021";
            document.querySelector('input[name="membership"]').value = "IEEE, PMI";

             // Additional Questions Fields
            document.querySelector('input[name="q1"][value="No"]').checked = true;
            document.querySelector('input[name="q2"][value="No"]').checked = true;
            document.querySelector('input[name="q3"][value="No"]').checked = true;

            // References Fields
            for(let x = 0; x<3; x++) {
                document.querySelector(`input[name="references[${x}][reference_name]"]`).value = `AllenBeato${x}`;
                document.querySelector(`input[name="references[${x}][reference_address]"]`).value = `123 Main Street, Metro City${x}`;
                document.querySelector(`input[name="references[${x}][contact_no]"]`).value = `0912345678${x}`;
            }

            // 

        }

        //ADD CHILDREN
        document.addEventListener("DOMContentLoaded", function() {
            let childIndex = 1; // Start with index 1 since the first row exists

            document.getElementById("add-child").addEventListener("click", function() {
                let table = document.getElementById("children-table");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td class="p-2" colspan="6">
                        <x-text-input class="w-full" type="text" name="children[${childIndex}][fullname]" required />
                    </td>
                    <td class="p-2">
                        <x-text-input class="w-full" type="date" name="children[${childIndex}][birthdate]" required />
                    </td>
                    <td class="p-2">
                        <button type="button" class="remove-child bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </td>
                `;

                table.appendChild(newRow);
                childIndex++;

                // Add event listener to remove the child row
                newRow.querySelector(".remove-child").addEventListener("click", function() {
                    newRow.remove();
                });
            });
        });


        //ADD CSC
        document.addEventListener("DOMContentLoaded", function() {
            let childIndex = 1; // Start with index 1 since the first row exists

            document.getElementById("add-csc").addEventListener("click", function() {
                let table = document.getElementById("csc-table");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[${childIndex}][eligibility_type]" required /></td>
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[${childIndex}][eligibility_rating]" /></td>
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="csc_children[${childIndex}][eligibility_exam_date]" required /></td>
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[${childIndex}][eligibility_exam_place]" required /></td>
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="csc_children[${childIndex}][eligibility_license_number]" /></td>
                    <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="csc_children[${childIndex}][eligibility_validity_date]" /></td>
                    <td class="p-2">
                        <button type="button" class="remove-child bg-red-500 text-white px-2 py-1 rounded">Remove</button>
                    </td>
                `;

                table.appendChild(newRow);
                childIndex++;

                // Add event listener to remove the child row
                newRow.querySelector(".remove-child").addEventListener("click", function() {
                    newRow.remove();
                });
            });
        });


        //WORK EXPERIENCES
        document.addEventListener("DOMContentLoaded", function() {
            let childIndex = 1; // Start with index 1 since the first row exists

            document.getElementById("add-workexperiences").addEventListener("click", function() {
                let table = document.getElementById("workexperiences-table");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td class="p-2 border border-gray-300">
                                <div class="flex space-x-2">
                                    <x-text-input class="w-full mt-1" type="date" name="workexp_children[${childIndex}][work_exp_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="workexp_children[${childIndex}][work_exp_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[${childIndex}][work_position]" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[${childIndex}][work_agency]" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[${childIndex}][work_salary]" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[${childIndex}][work_salary_grade]" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="workexp_children[${childIndex}][work_status]" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="workexp_children[${childIndex}][work_gov_service]" class="w-full border-gray-300 rounded-md">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </td>
                            <td class="p-2">
                        <button type="button" class="remove-child bg-red-500 text-white py-1 rounded">Remove</button>
                    </td>
                `;

                table.appendChild(newRow);
                childIndex++;

                // Add event listener to remove the child row
                newRow.querySelector(".remove-child").addEventListener("click", function() {
                    newRow.remove();
                });
            });
        });


        //VOLUNTARTY WORK
        document.addEventListener("DOMContentLoaded", function() {
            let childIndex = 1; // Start with index 1 since the first row exists

            document.getElementById("add-voluntarywork").addEventListener("click", function() {
                let table = document.getElementById("voluntarywork-table");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="volunteerwork_children[${childIndex}][vol_org]" required /></td>
                            <td class="p-2 border border-gray-300">
                                <div class="flex items-center space-x-2">
                                    <x-text-input class="w-full" type="date" name="volunteerwork_children[${childIndex}][vol_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="volunteerwork_children[${childIndex}][vol_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="volunteerwork_children[${childIndex}][vol_hours]" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="volunteerwork_children[${childIndex}][vol_position]" required /></td>
                            <td class="p-2"><button type="button" class="remove-child bg-red-500 text-white py-1 rounded">Remove</button></td>
                        </tr>
                `;

                table.appendChild(newRow);
                childIndex++;

                // Add event listener to remove the child row
                newRow.querySelector(".remove-child").addEventListener("click", function() {
                    newRow.remove();
                });
            });
        });


        // L&D
        document.addEventListener("DOMContentLoaded", function() {
            let childIndex = 1; // Start with index 1 since the first row exists

            document.getElementById("add-trainingprogram").addEventListener("click", function() {
                let table = document.getElementById("trainingprogram-table");

                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="trainingprogram_children[${childIndex}][ld_title]" required /></td>
                            <td class="p-2 border border-gray-300">
                                <div class="flex items-center space-x-2">
                                    <x-text-input class="w-full" type="date" name="trainingprogram_children[${childIndex}][ld_from]" required />
                                    <x-text-input class="w-full mt-1" type="date" name="trainingprogram_children[${childIndex}][ld_to]" required />
                                </div>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="trainingprogram_children[${childIndex}][ld_hours]" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="trainingprogram_children[${childIndex}][ld_type]" class="w-full border-gray-300 rounded-md">
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option>
                                </select>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="trainingprogram_children[${childIndex}][ld_sponsor]" required /></td>
                            <td class="p-2"><button type="button" class="remove-child bg-red-500 text-white px-2 py-1 rounded">Remove</button></td>
                        </tr>
                            `;

                table.appendChild(newRow);
                childIndex++;

                // Add event listener to remove the child row
                newRow.querySelector(".remove-child").addEventListener("click", function() {
                    newRow.remove();
                });
            });
        });

    </script>
</body>
</html>
