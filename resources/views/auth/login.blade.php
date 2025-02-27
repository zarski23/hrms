@extends('layouts.app')
@section('content')

<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap");
    @import url("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css");
    * {
    margin: 0px;
    padding: 0px;
    box-sizing: border-box;
    }

    body {
        font-family: "Poppins", sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        font-size: 14px;
        background: url("{{ asset('assets/img/deped_backgroundimage.jpg') }}");
        background-position: top;
	    background-size: cover;
    }

    .container {
        background-color: #fff;
        width: 1060px;
        max-width: 100vw;
        height: 520px;
        position: relative;
        overflow-x: hidden;
        padding: 0;
        display: flex; 
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.9);
    }
    .container .forms-container {
        /* position: relative; */
        width: 50%;
        text-align: center;
    }
    .container .forms-container .form-control {
        /* position: absolute; */
        position: relative; /* Changed */
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 520px;
        transition: all 0.5s ease-in;
    }
    .container .forms-container .form-control h2 {
    font-size: 2rem;
    }
    .container .forms-container .form-control form {
    display: flex;
    flex-direction: column;
    margin: 0px 30px;
    }
    .container .forms-container .form-control form input {
    margin: 10px 0px;
    border: none;
    padding: 15px;
    background-color: #efefef;
    border-radius: 5px;
    }
    .container .forms-container .form-control form button {
    border: none;
    padding: 20px;
    margin-top: 5px;
    background-color: #03451d;
    border-radius: 5px;
    color: #fff;
    cursor: pointer;
    }
    .container .forms-container .form-control form button:focus {
    outline: none;
    }
    .container .forms-container .form-control span {
    margin: 10px 0px;
    }
    .container .forms-container .form-control .socials i {
    margin: 0 5px;
    color: #fff;
    border-radius: 50%;
    }
    .container .forms-container .form-control .socials .fa-facebook-f {
    padding: 5px 8px;
    background-color: #3b5998;
    }
    .container .forms-container .form-control .socials .fa-google-plus-g {
    padding: 5px 4px;
    background-color: #db4a39;
    }
    .container .forms-container .form-control .socials .fa-linkedin-in {
    padding: 5px 6px;
    background-color: #0e76a8;
    }
    .container .forms-container .form-control.signin-form {
    opacity: 1;
    z-index: 2;
    left: 0%;
    }
    .container .intros-container {
        /* position: relative;
        left: 50%; */
        width: 50%;
        text-align: center;
        
    }
    .container .intros-container .intro-control {
        /* position: absolute; */
        position: relative; /* Changed */
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
        height: 520px;
        color: #fff;
        background-image: url("{{ asset('assets/img/pdms-logo.png') }}");
        background-size: cover;
        /* background: linear-gradient(170deg, #b80000, #006837); */
        transition: all 0.5s ease-in;
    }
    .container .intros-container .intro-control .intro-control__inner {
    margin: 0px 30px;
    }
    .container .intros-container .intro-control button {
    border: none;
    padding: 15px 30px;
    background-color: #006837;
    border-radius: 15px;
    color: #fff;
    margin: 10px 0px;
    cursor: pointer;
    }
    /* .container .intros-container .intro-control button:focus, .container .intros-container .intro-control button:hover {
    outline: none;
    background-color: #620909;
    } */
    .container .intros-container .intro-control h3,
    .container .intros-container .intro-control p {
    margin: 10px 0px;
    }
    .container .intros-container .intro-control.signin-intro {
    opacity: 1;
    z-index: 2;
    }

    .change .forms-container .form-control.signin-form {
    opacity: 0;
    z-index: 1;
    transform: translateX(-100%);
    }
    .change .intros-container .intro-control {
    transform: translateX(-100%);
    background: linear-gradient(170deg, #3b82f6, #2563eb);
    }
    .change .intros-container .intro-control #signin-btn {
    background-color: #2563eb;
    }
    .change .intros-container .intro-control.signin-intro {
    opacity: 0;
    z-index: 1;
    }

    /* @media screen and (max-width: 480px) {
        .container {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .container .forms-container {
            order: 2;
            width: 100%;
            height: 50vh;
        }
        .container .forms-container .form-control {
            position: absolute;
            height: 50vh;
        }
        .container .intros-container {
            order: 1;
            width: 100%;
            left: 0%;
            height: 40vh;
        }
        .container .intros-container .intro-control {
            position: absolute;
            height: 40vh;
        }

        .change .forms-container .form-control.signin-form {
            transform: translateX(0%);
        }
        .change .intros-container .intro-control {
            transform: translateX(0%);
        }
    } */

    @media screen and (max-width: 520px) {
        .container {
            height: 100vh;
            flex-direction: column;
        }
        .container .forms-container,
        .container .intros-container {
            width: 100%;
            height: 50vh;
            padding: 15px;
        }

        .container .forms-container .form-control,
        .container .intros-container .intro-control {
            position: relative; /* Changed */
            height: 50vh;
        }
    }

    .main-wrapper {
        /* display: flex;
        flex-wrap: wrap; */
    }

    .datetime,
    .account-content {
        width: 100%;
        padding: 10px 45px 10px 45px;
        font-size: 17px;
    }

    .intro-control__inner {
        text-align: center; /* Center align the content */
    }

    .datetime {
        display: flex;
        flex-direction: column;
        align-items: center; /* Center align items horizontally */
        /* padding: 15px; */
    }

    .date,
    .time {
        text-align: center; /* Center align the text within date and time */
    }

    /* ----- mobile view lofo ----- */
    .logo-container {
        display: flex;
        justify-content: space-around;
        align-items: center;
        flex-wrap: wrap; /* This ensures images wrap on small screens if needed */
    }

    .logo {
        height: 100px;
        width: 100px;
    }

    @media only screen and (max-width: 768px) {
        .logo {
            height: 60px;
            width: 60px;
        }
    }

    @media only screen and (max-width: 480px) {
        .logo {
            margin-top: 70px;
            height: 60px;
            width: 60px;
        }
    }

</style>

<div class="container">
    {{-- message --}}
    {!! Toastr::message() !!}
  <div class="intros-container">
    <div class="intro-control signin-intro">
      <div class="intro-control__inner">
        <!-- <h2 style="font-family: 'Anton', 'Arial Black', sans-serif; font-size: 40px; font-weight:500;">DepEd Leyte Division</h2>
        <button id="signup-btn">
            <div class="datetime">
                <div class="date">
                    <span id="dayname" style="font-weight: bold; text-transform: uppercase;">Day</span><br>
                    <span id="month">Month</span>
                    <span id="daynum">00</span>,
                    <span id="year">Year</span>
                </div>
                <div class="time">
                    <span id="hour">00</span>:
                    <span id="minutes">00</span>:
                    <span id="seconds">00</span>
                    <span id="period">AM</span>
                </div>
            </div>
        </button> -->
        <p></p>
        <!-- <button id="signup-btn">&nbsp;&nbsp;&nbsp;&nbsp; Help? &nbsp;&nbsp;&nbsp;&nbsp;</button> -->
      </div>
    </div>
  </div>
  <div class="forms-container">
    <div class="form-control signin-form">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="logo-container">
                <a href="https://depedleytedivision.com/"><img src="{{ URL::to('assets/img/deped_leyte_logo.png') }}" alt="DepEd Logo" class="logo"></a>
                <a href="/"><img src="{{ URL::to('assets/img/deped_matatag.png') }}" alt="Matatag Logo" class="logo"></a>
                <a href="/"><img src="{{ URL::to('assets/img/bagong_pilipinas.png') }}" alt="Bagong Pilipinas Logo" class="logo"></a>
                <a href="https://depedleytedivision.com/transparency-seal/"><img src="{{ URL::to('assets/img/transparency_seal.png') }}" alt="Transparency Seal" class="logo"></a>
            </div>
        
            <br>
                <h2>Login</h2>
                <input type="text" placeholder="Username" name="username" autocomplete="off" required />
                <input type="password" placeholder="Password" name="password" autocomplete="off" required />
                <button>Signin</button>
            <br>
            <div class="form-group">
                <div class="row">
                    <div class="col" style="text-align: left;">
                        @if (Route::has('password.request'))
                        <a class="text-muted" href="{{ route('password.request') }}">
                            Forgot password?
                        </a>
                        @endif
                    </div>
                    <div class="col-auto">
                        <a class="text-muted" href="#" >
                            Help?
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <p>Don't have an account yet? <a href="{{ route('pds-register') }}">Sign up here</a></p>
            </div>
            <br>
        </form>
    </div>
  </div>
</div>


<script type="text/javascript">
    function updateClock() {
        var now = new Date();
        var dname = now.getDay(),
            mo = now.getMonth(),
            dnum = now.getDate(),
            yr = now.getFullYear(),
            hou = now.getHours(),
            min = now.getMinutes(),
            sec = now.getSeconds(),
            pe = "AM";

        if (hou == 0) {
            hou = 12;
        }
        if (hou > 12) {
            hou = hou - 12;
            pe = "PM";
        }

        Number.prototype.pad = function (digits) {
            for (var n = this.toString(); n.length < digits; n = 0 + n);
            return n;
        }

        var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var week = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        var ids = ["dayname", "month", "daynum", "year", "hour", "minutes", "seconds", "period"];
        var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];

        for (var i = 0; i < ids.length; i++)
            document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }

    function initClock() {
        updateClock();
        window.setInterval("updateClock()", 1000);
    }

    initClock(); // Call the function to start the clock immediately
</script>
@endsection
