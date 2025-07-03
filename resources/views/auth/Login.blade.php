@extends('layouts.AuthLayout')
@section('authContent')


<section id="Breadcrumbs">
   <div class="container">
      <ul>
         <li class="d-flex align-items-center">
            <a href="index.html" class="homeIcom">
               <iconify-icon icon="fluent:home-16-regular" width="20" height="22"></iconify-icon>
            </a>
            <iconify-icon icon="formkit:right" width="15" height="15" style="color: #999"></iconify-icon>
         </li>
         <li class="d-flex align-items-center">
            <a href="#">Account</a>
            <iconify-icon icon="formkit:right" width="15" height="15" style="color: #999"></iconify-icon>
         </li>
         <li>
            <a href="#" class="active">Login</a>
         </li>
      </ul>
   </div>
</section>
<!-- *Breadcrumbs End Hear -->


<!-- *Sign In Start Here -->
<section id="signIn" class="signIn">
   <div class="container">
      <form action="{{ request()->routeIs('login') ? route('login') : route('customer.login.req') }}" method="POST">
         @csrf
         <h1 class="text-center">Sign In</h1>
         <input type="email" name="email" placeholder="Email">
         @error('email')
         <span class="error">{{ $message }}</span>
         @enderror
         <div class="passwordBox">
            <input name="password" type="password" id="passwordInputSignIn" placeholder="Password" required>
            <span class="pasToggl">
               <iconify-icon icon="ion:eye-off-outline" width="25" height="25" style="color: #000"></iconify-icon>
            </span>
         </div>
         @error('password')
         <span class="error">{{ $message }}</span>
         @enderror

         <div class="d-flex justify-content-between align-items-center checkbox">
            <label for="checkboxSignIn" class="d-flex align-items-center">
               <input type="checkbox" id="checkboxSignIn">
               Remember me
            </label>
            <a href="#" class="text-end">Forget Password</a>
         </div>
         <button class="d-inline-block">Login</button>
         <p class="text-center">Don’t have an account?
            <a href="{{ route('register') }}" class="RegisterBtn">Register</a>
         </p>
         <div class="d-flex justify-content-center align-items-center mt-3">
            <a href="{{ route('customer.google.login') }}"><img width="200px" src="https://programtom.com/dev/wp-content/uploads/2023/12/1_u0bwdudgoyKjSLntsRcqiw.png" alt=""> </a>
            <a href="{{ route('customer.facebook.login') }}"><img width="200px" src="{{ asset('frontend/assets/img/facebook_login_btn.webp') }}" alt=""> </a>
         </div>
      </form>


   </div>
</section>
<!-- *Sign In End Here -->



@endsection