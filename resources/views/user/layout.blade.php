@include('user.head')

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
      <div class="jumper">
          <div></div>
          <div></div>
          <div></div>
      </div>
  </div>
  <!-- ***** Preloader End ***** -->


  <!-- Header -->
  @include('user.header')
  
  {{-- -- slider -- --}}
  @include('user.slider')
  
  {{-- -- latestProduct -- --}}
 @yield('latest')
  {{-- -- showProduct -- --}}
  @yield('show')




  <!-- Page Content -->
  @include('user.body')


{{-- -- footer --}}
  @include('user.footer')

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <!-- Additional Scripts -->
  <script src="{{asset("assets")}}/js/custom.js"></script>
  <script src="{{asset("assets")}}/js/owl.js"></script>
  <script src="{{asset("assets")}}/js/slick.js"></script>
  <script src="{{asset("assets")}}/js/isotope.js"></script>
  <script src="{{asset("assets")}}/js/accordions.js"></script>


  <script language = "text/Javascript">
    cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
    function clearField(t){                   //declaring the array outside of the
    if(! cleared[t.id]){                      // function makes it static and global
        cleared[t.id] = 1;  // you could use true and false, but that's more typing
        t.value='';         // with more chance of typos
        t.style.color='#fff';
        }
    }
  </script>


</body>

</html>
