<header class="">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html"><h2>{{__("message.E-commerce")}}</h2></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="{{url('redirect')}}">{{__("message.Home")}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url("mycart")}}">{{__('message.My Cart')}}</a>
            </li>
            @if (session()->has("lang") && session()->get("lang") == "ar")
            <li class="nav-item">
                <a class="nav-link" href=" {{url("change/en")}}">English</a>
            </li>
            @else
            <li class="nav-item">
                <a class="nav-link" href="{{url("change/ar")}}">Arabic</a>
            </li>
        </li>
            @endif
            @guest

            <li class="nav-item">
                <a class="nav-link" href="{{url("dashboard")}}">{{__('message.Login')}}</a>
            </li>
            @endguest
            @auth


            <li class="nav-item">
                <a class="nav-link" href="{{url("dashboard")}}">{{__('message.Logout')}}</a>
            </li>
            @endauth

          </ul>
        </div>

    </nav>
  </header>
