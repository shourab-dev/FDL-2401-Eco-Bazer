@extends('layouts.AuthLayout')
  @section('authContent')



    <!-- *Main Part  START HERE -->
     <main>
              <!-- *Breadcrumbs Start Here -->
      <section id="Breadcrumbs">
        <div class="container">
           <ul>
              <li class="d-flex align-items-center">
                 <a href="index.html" class="homeIcom">
                   <i class="bi bi-house"></i>
                 </a>
                 <i class="bi bi-caret-right-fill right "></i>
              </li>
              <li class="d-flex align-items-center">
                 <a href="#" class="active">Contact Us</a>
              </li>
           </ul>
        </div>
     </section>
     <!-- *Breadcrumbs End Hear -->


    <!-- *Details fill Section start -->
     <section id="details">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-12 leftSide">
                    <div class="row">
                        <div class="col-12">
                            <div class="cntBox text-center">
                           
                                <img class="img-fluid" src="{{asset('frontend/assets/images/Map pin.png')}}" alt="">
                                <p>2715 Ash Dr. San Jose, South Dakota 83475</p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="cntBox text-center">
                                <img class="img-fluid" src="./assets/img/Email.png" alt="">
                                <a href="mailto:ecobazar@gmail.com" target="_blank">
                                   <p>Proxy@gmail.com
                                       Help.proxy@gmail.com</p>
                                </a>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="cntBox text-center">
                                <img class="img-fluid" src="./assets/img/PhoneCall.png" alt="">
                                <a href="tel:2195550114">
                                   <p>(219) 555-0114</p>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 rightSide">
                    <div class="formCnt">
                        <div class="formd">
                            <h4>Just Say Hello!</h4>
                            <p>Do you fancy saying hi to me or you want to get started with your project and you need my help? Feel free to contact me.</p>
                            <form method="post" action="{{route('storeContact')}}">
                                @csrf
                                <div class="form-group my-3 ">
                                    <input class="form-control" name="name" type="text" placeholder="Full Name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                    <input class="form-control"  name="email" type="email" placeholder="Enter your email">
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                <input name="subject" class="sub" type="text" placeholder="Subject">
                                 @error('subject')
                                    <span class="text-danger">{{$message}}</span>
                                   @enderror
                                </div>
                                <div class="form-group">
                                <textarea name="message" id="" placeholder="Message"></textarea>
                                 @error('message')
                                    <span class="text-danger">{{$message}}</span>
                                   @enderror
                                </div>
                                <button class=".btnSaved">Send Message</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
     <!-- *Details fill Section end -->


      <!-- *Map Section start -->
     <section id="Map">
         <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3689.8700197525127!2d91.83677857434643!3d22.35853624078379!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad277ab0cff8a7%3A0x13eb8ccef8a22dde!2sCreative%20IT%20Institute%2C%20Chattogram%20Branch!5e0!3m2!1sen!2sbd!4v1733474173038!5m2!1sen!2sbd" width="100%" height="400px" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
         </div>
     </section>
     <!-- *Map Section end -->
      
    @endsection
