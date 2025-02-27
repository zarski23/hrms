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
            <form method="POST" action="#">
                @csrf

                <!-- Personal Information -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">I. Personal Information</h2>
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-2" colspan="2"><x-input-label for="fname" :value="__('First Name:')" /></td>
                        <td class="p-2"><x-input-label for="mname" :value="__('Middle Name:')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="lname" :value="__('Last Name:')" /></td>
                        <td class="p-2"><x-input-label for="xname" :value="__('Extension Name:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="2"><x-text-input id="fname" class="w-full" type="text" name="fname" required /></td>
                        <td class="p-2"><x-text-input id="mname" class="w-full" type="text" name="mname" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="lname" class="w-full" type="text" name="lname" required /></td>
                        <td class="p-2"><x-text-input id="xname" class="w-full" type="text" name="xname" /></td>
                    </tr>

                    <tr>
                        <td class="p-2"><x-input-label for="dob" :value="__('Date of Birth:')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="pob" :value="__('Place of Birth:')" /></td>
                        <td class="p-2"><x-input-label for="gender" :value="__('Gender:')" /></td>
                        <td class="p-2"><x-input-label for="civil_status" :value="__('Civil Status:')" /></td>
                        <td class="p-2"><x-input-label for="citizenship" :value="__('Citizenship:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="dob" class="w-full" type="date" name="dob" required /></td>
                        <td class="p-2" colspan="2"><x-text-input id="pob" class="w-full" type="text" name="pob" required /></td>
                        <td class="p-2">
                            <select id="gender" name="gender" class="w-full border-gray-300 rounded-md">
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
                        <td class="p-2"><x-text-input id="citizenship" class="w-full" type="text" name="citizenship" required /></td>
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
                        <td class="p-2"><x-text-input id="height" class="w-full" type="text" name="height" required /></td>
                        <td class="p-2"><x-text-input id="weight" class="w-full" type="text" name="weight" required /></td>
                        <td class="p-2"><x-text-input id="blood_type" class="w-full" type="text" name="blood_type" required /></td>
                        <td class="p-2"><x-text-input id="mobile_no" class="w-full" type="text" name="mobile_no" required /></td>
                        <td class="p-2"><x-text-input id="telephone_no" class="w-full" type="text" name="telephone_no" required /></td>
                        <td class="p-2"><x-text-input id="email_address" class="w-full" type="text" name="email_address" required /></td>
                    </tr>

                    <tr>
                        <td class="p-2"><x-input-label for="gsis" :value="__('GSIS ID No:')" /></td>
                        <td class="p-2"><x-input-label for="pagibig" :value="__('Pag-ibig ID No:')" /></td>
                        <td class="p-2"><x-input-label for="philhealth" :value="__('Philhealth No:')" /></td>
                        <td class="p-2"><x-input-label for="sss" :value="__('SSS No:')" /></td>
                        <td class="p-2"><x-input-label for="tin" :value="__('TIN No:')" /></td>
                        <td class="p-2"><x-input-label for="agency_employee_no" :value="__('Agency Employee No:')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="gsis" class="w-full" type="text" name="gsis" required /></td>
                        <td class="p-2"><x-text-input id="pagibig" class="w-full" type="text" name="pagibig" required /></td>
                        <td class="p-2"><x-text-input id="philhealth" class="w-full" type="text" name="philhealth" required /></td>
                        <td class="p-2"><x-text-input id="sss" class="w-full" type="text" name="sss" required /></td>
                        <td class="p-2"><x-text-input id="tin" class="w-full" type="text" name="tin" required /></td>
                        <td class="p-2"><x-text-input id="agency_employee_no" class="w-full" type="text" name="agency_employee_no" required /></td>
                    </tr>
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
                        <td class="p-2"><x-text-input id="res_house_no" class="w-full" type="text" name="res_house_no" required /></td>
                        <td class="p-2"><x-text-input id="res_street" class="w-full" type="text" name="res_street" /></td>
                        <td class="p-2"><x-text-input id="res_subdivision" class="w-full" type="text" name="res_subdivision" /></td>
                        <td class="p-2"><x-text-input id="res_barangay" class="w-full" type="text" name="res_barangay" required /></td>
                        <td class="p-2"><x-text-input id="res_city" class="w-full" type="text" name="res_city" required /></td>
                        <td class="p-2"><x-text-input id="res_province" class="w-full" type="text" name="res_province" required /></td>
                        <td class="p-2"><x-text-input id="res_zip" class="w-full" type="text" name="res_zip" required /></td>
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
                        <td class="p-2"><x-text-input id="perm_house_no" class="w-full" type="text" name="perm_house_no" required /></td>
                        <td class="p-2"><x-text-input id="perm_street" class="w-full" type="text" name="perm_street" /></td>
                        <td class="p-2"><x-text-input id="perm_subdivision" class="w-full" type="text" name="perm_subdivision" /></td>
                        <td class="p-2"><x-text-input id="perm_barangay" class="w-full" type="text" name="perm_barangay" required /></td>
                        <td class="p-2"><x-text-input id="perm_city" class="w-full" type="text" name="perm_city" required /></td>
                        <td class="p-2"><x-text-input id="perm_province" class="w-full" type="text" name="perm_province" required /></td>
                        <td class="p-2"><x-text-input id="perm_zip" class="w-full" type="text" name="perm_zip" required /></td>
                    </tr>
                </table>


                <!-- Family Background -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">II. Family Background</h2>
                <table class="w-full border-collapse">
                    <tr>
                        <td class="p-2" colspan="2"><x-input-label for="spouse_name" :value="__('Spouse’s Name')" /></td>
                        <td class="p-2"><x-input-label for="spouse_occupation" :value="__('Occupation')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="spouse_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2"><x-input-label for="spouse_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="spouse_tel_no" :value="__('Telephone No.')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="2"><x-text-input id="spouse_name" class="w-full" type="text" name="spouse_name" /></td>
                        <td class="p-2"><x-text-input id="spouse_occupation" class="w-full" type="text" name="spouse_occupation" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="spouse_employer" class="w-full" type="text" name="spouse_employer" /></td>
                        <td class="p-2"><x-text-input id="spouse_business_address" class="w-full" type="text" name="spouse_business_address" /></td>
                        <td class="p-2"><x-text-input id="spouse_tel_no" class="w-full" type="text" name="spouse_tel_no" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-input-label for="father_name" :value="__('Father’s Name')" /></td>
                        <td class="p-2"><x-input-label for="father_occupation" :value="__('Occupation')" /></td>
                        <td class="p-2"><x-input-label for="father_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="father_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="father_tel_no" :value="__('Telephone No.')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="father_name" class="w-full" type="text" name="father_name" required /></td>
                        <td class="p-2"><x-text-input id="father_occupation" class="w-full" type="text" name="father_occupation" /></td>
                        <td class="p-2"><x-text-input id="father_employer" class="w-full" type="text" name="father_employer" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="father_business_address" class="w-full" type="text" name="father_business_address" /></td>
                        <td class="p-2"><x-text-input id="father_tel_no" class="w-full" type="text" name="father_tel_no" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-input-label for="mother_name" :value="__('Mother’s Maiden Name')" /></td>
                        <td class="p-2"><x-input-label for="mother_occupation" :value="__('Occupation')" /></td>
                        <td class="p-2"><x-input-label for="mother_employer" :value="__('Employer / Business Name')" /></td>
                        <td class="p-2" colspan="2"><x-input-label for="mother_business_address" :value="__('Business Address')" /></td>
                        <td class="p-2"><x-input-label for="mother_tel_no" :value="__('Telephone No.')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2"><x-text-input id="mother_name" class="w-full" type="text" name="mother_name" required /></td>
                        <td class="p-2"><x-text-input id="mother_occupation" class="w-full" type="text" name="mother_occupation" /></td>
                        <td class="p-2"><x-text-input id="mother_employer" class="w-full" type="text" name="mother_employer" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="mother_business_address" class="w-full" type="text" name="mother_business_address" /></td>
                        <td class="p-2"><x-text-input id="mother_tel_no" class="w-full" type="text" name="mother_tel_no" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-input-label :value="__('Children’s Name (Write full name and list all)')" /></td>
                        <td class="p-2" colspan="2"><x-input-label :value="__('Date of Birth (MM/DD/YYYY)')" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="children_name_1" class="w-full" type="text" name="children_name_1" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="children_dob_1" class="w-full" type="date" name="children_dob_1" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="children_name_2" class="w-full" type="text" name="children_name_2" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="children_dob_2" class="w-full" type="date" name="children_dob_2" /></td>
                    </tr>
                    <tr>
                        <td class="p-2" colspan="3"><x-text-input id="children_name_3" class="w-full" type="text" name="children_name_3" /></td>
                        <td class="p-2" colspan="2"><x-text-input id="children_dob_3" class="w-full" type="date" name="children_dob_3" /></td>
                    </tr>
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
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_school" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_year_graduated" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_dates_attended" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="elementary_honors" /></td>
                        </tr>
                        
                        <!-- Secondary -->
                        <tr>
                            <td class="p-2 border border-gray-300">Secondary</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_school" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_year_graduated" required /></td>
                            <td class="p-2 border border-gray-300"></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_dates_attended" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="secondary_honors" /></td>
                        </tr>
                        
                        <!-- Vocational/Trade Course -->
                        <tr>
                            <td class="p-2 border border-gray-300">Vocational/Trade Course</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_school" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_course" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_year_graduated" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_units" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_dates_attended" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vocational_honors" /></td>
                        </tr>

                        <!-- College -->
                        <tr>
                            <td class="p-2 border border-gray-300">College</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_school" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_course" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_year_graduated" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_units" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_dates_attended" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="college_honors" /></td>
                        </tr>

                        <!-- Graduate Studies -->
                        <tr>
                            <td class="p-2 border border-gray-300">Graduate Studies</td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_school" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_course" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_year_graduated" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_units" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_dates_attended" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="graduate_honors" /></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Civil Service Eligibility -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">IV. Civil Service Eligibility</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Career Service/RA 1080 (Board/Bar) Under Special Laws/CES/CSEE</th>
                            <th class="p-2 border border-gray-300">Rating (If applicable)</th>
                            <th class="p-2 border border-gray-300">Date of Examination/Conferment</th>
                            <th class="p-2 border border-gray-300">Place of Examination/Conferment</th>
                            <th class="p-2 border border-gray-300">License Number (If applicable)</th>
                            <th class="p-2 border border-gray-300">Date of Validity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_type" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_rating" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="eligibility_exam_date" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_exam_place" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_license_number" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="eligibility_validity_date" /></td>
                        </tr>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_type" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_rating" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="eligibility_exam_date" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_exam_place" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="eligibility_license_number" /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="date" name="eligibility_validity_date" /></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Work Experience -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">V. Work Experience</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Position Title</th>
                            <th class="p-2 border border-gray-300">Department/Agency/Office/Company</th>
                            <th class="p-2 border border-gray-300">Monthly Salary</th>
                            <th class="p-2 border border-gray-300">Salary/Job/Pay Grade & Step</th>
                            <th class="p-2 border border-gray-300">Status of Appointment</th>
                            <th class="p-2 border border-gray-300">Gov’t Service (Yes/No)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300">
                                <x-text-input class="w-full" type="date" name="work_exp_from" required />
                                <x-text-input class="w-full mt-1" type="date" name="work_exp_to" required />
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="work_position" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="work_agency" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="work_salary" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="work_salary_grade" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="work_status" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="work_gov_service" class="w-full border-gray-300 rounded-md">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>


                <!-- Voluntary Work -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">VI. Voluntary Work</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Name & Address of Organization</th>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Number of Hours</th>
                            <th class="p-2 border border-gray-300">Position / Nature of Work</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vol_org" required /></td>
                            <td class="p-2 border border-gray-300">
                                <x-text-input class="w-full" type="date" name="vol_from" required />
                                <x-text-input class="w-full mt-1" type="date" name="vol_to" required />
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="vol_hours" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="vol_position" required /></td>
                        </tr>
                    </tbody>
                </table>


                <!-- Learning and Development -->
                <h2 class="text-xl font-semibold mt-6 mb-4 border-b pb-2 px-4">VII. Learning & Development (L&D) Programs</h2>
                <table class="w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="p-2 border border-gray-300">Title of Learning & Development Programs</th>
                            <th class="p-2 border border-gray-300">Inclusive Dates (From - To)</th>
                            <th class="p-2 border border-gray-300">Number of Hours</th>
                            <th class="p-2 border border-gray-300">Type of L&D</th>
                            <th class="p-2 border border-gray-300">Conducted / Sponsored By</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="ld_title" required /></td>
                            <td class="p-2 border border-gray-300">
                                <x-text-input class="w-full" type="date" name="ld_from" required />
                                <x-text-input class="w-full mt-1" type="date" name="ld_to" required />
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="number" name="ld_hours" required /></td>
                            <td class="p-2 border border-gray-300">
                                <select name="ld_type" class="w-full border-gray-300 rounded-md">
                                    <option value="Managerial">Managerial</option>
                                    <option value="Supervisory">Supervisory</option>
                                    <option value="Technical">Technical</option>
                                </select>
                            </td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="ld_sponsor" required /></td>
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
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="skills_hobbies" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="distinctions" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="membership" required /></td>
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
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="ref_name" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="ref_address" required /></td>
                            <td class="p-2 border border-gray-300"><x-text-input class="w-full" type="text" name="ref_contact" required /></td>
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
</body>
</html>
