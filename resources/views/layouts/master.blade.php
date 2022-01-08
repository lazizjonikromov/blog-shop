<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Breeze_blog</title>
</head>

<style>
  .navbar-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 100%;
    padding: 20px 5px;
    background-color: grey;
    color: #fff;
  }

  .navbar-sub-flex {
    display: flex;
    align-items: center;
    height: 100%;
  }

  .navbar-sub-flex a {
    color: #fff;
  }

  .navbar-sub-flex a:hover {
    color: #000;
  }

  .navbar-sub-flex2 {
    display: flex;
    align-items: center;
    height: 100%;
  }
</style>

<body>
  <div class="navbar-flex">
    <div class="">
      <div class="navbar-sub-flex">
        <a class="nav-link" href="{{url('/')}}">Home</a>  
        @php
          $categories = \App\Models\Category::orderBy('created_at', 'DESC')->get();
        @endphp
        <li class="nav-item dropdown" style="list-style: none;">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            @foreach($categories as $category)
              <li><a class="dropdown-item" href="{{url( '/category',['product'=>$category->id])}}" style="color: black;">{{$category->name}}</a></li>
            @endforeach
          </ul>
        </li>
      </div>
    </div>
    <div class="">
      <form type="get" action="{{url('/search')}}">
        <div class="d-flex">
          <div class="" style="margin-right:10px;">
            <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
          </div>
          <div class="">
            <button class="btn btn-primary" type="submit">Search Products</button>
          </div>
        </div>
      </form>
    </div>
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" style="text-decoration: none; color:white; font-size:17px;" class="text-sm text-gray-700">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" style="text-decoration: none; color:white; font-size:17px;margin-right:10px;" class="text-sm text-gray-700 underline">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="text-decoration: none; color:white; font-size:17px;" class="ml-4 text-sm text-gray-700 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
  </div>


  <div class="container mt-5">
    @yield('content')
  </div>

  <footer>
    <div class="" style="padding: 20px; margin-top: 20px; background-color: dimgray; width:100%;text-align:center;">
      <h6>Copyright © 2021 built the best work <span style="color: red;font-size:20px;">♥</span> web devoloper</h6>
    </div>
  </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

</html>