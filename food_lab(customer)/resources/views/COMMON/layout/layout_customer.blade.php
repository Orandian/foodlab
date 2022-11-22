<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="{{ $name->site_logo }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('js/commonCustomer.js') }}" type="text/javascript" defer></script>
    <script src="{{ url('js/forInformAlert.js') }}" type="text/javascript" defer></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap/bootstrap-dropdown.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @yield('script')
    @yield('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
</head>

<body>

    {{-- Start Marquee --}}
    <marquee class="mt-3">
        @foreach ($news as $new)
            <p class="d-inline mx-5 importantnews p-3 fs-5" id="{{ $new->category }}"><img
                    src="{{ $new->source }}" class="me-2" width="50px"
                    alt="{{ $new->source }}" />{{ $new->title }}</p>
        @endforeach
    </marquee>
    {{-- End Marquee --}}

    {{-- Start Header --}}
    <header class="headers">
        {{-- start navbar --}}
        <nav class="navbar navbar-expand-lg container-fluid py-3 nav-containers">

            <a href="/" class="navbar-brand d-lg-none">
                <img src="{{ $name->site_logo }}" width="80px" class="pe-2" />
                <span class="text-uppercase comapanynames">{{ $name->site_name }}</span>
            </a>

            @if (session()->has('customerId'))
                <script>
                    var customerid = {{ session('customerId') }}
                    var sessionHas = true
                </script>
            @else
                <script>
                    var customerid = null;
                    var sessionHas = false
                </script>
            @endif

            <div class="d-flex ms-auto">
                @if (session()->has('customerId'))
                    <p class="nav-link d-lg-none mt-1 texts" id="">
                        <a href="/cart" class="d-lg-none position-relative texts"><i
                                class="fas fa-shopping-cart fs-3"></i>
                            <span id="cartCount1"
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartout cartcount"></span></a>
                    </p>
                    {{-- <p class="nav-link d-lg-none me-2 texts" id="profileButton2"><i class="fas fa-user-circle fs-1"></i>
                    </p> --}}
                    <div class="dropdown d-lg-none mx-3 mt-2" id="profileButton2">

                        <i class="fas fa-user-circle fs-1 dropdown-toggle  texts" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false"></i>

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="profileButton2">
                            <li><a class="dropdown-item"
                                    href="{{ route('editprofile.index') }}">{{ __('messageZY.profileSetting') }}</a>
                            </li>
                            <li><a class="dropdown-item" data-bs-toggle="modal"
                                    data-bs-target="#modal2">{{ __('messageZY.logout') }}</a></li>

                        </ul>
                    </div>
                @endif

                <button class="navbar-toggler nav-buttons" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation" id="closeInform">
                    <div class="bg-light line1"></div>
                    <div class="bg-light line2"></div>
                    <div class="bg-light line3"></div>
                </button>
            </div>

            <div class="collapse navbar-collapse text-uppercase fw-bolder" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-around align-items-center border-0 rounded py-3 navs">
                    @if ($nav == 'home')
                        <li class="nav-item actives px-2">
                            <a class="nav-link texts" href="/home">{{ __('messageMK.home') }}</a>
                        </li>
                    @else
                        <li class="nav-item px-2">
                            <a class="nav-link texts" href="/home">{{ __('messageMK.home') }}</a>
                        </li>
                    @endif
                    @if ($nav == 'product')
                        <li class="nav-item actives px-2">
                            <a class="nav-link texts" href="/">{{ __('messageMK.Food') }}</a>
                        </li>
                    @else
                        <li class="nav-item px-2">
                            <a class="nav-link texts" href="/">{{ __('messageMK.Food') }}</a>
                        </li>
                    @endif
                    @if (session()->has('customerId'))
                        @if ($nav == 'coin')
                            <li class="nav-item actives px-2">
                                <a class="nav-link texts " href="/buycoin">{{ __('messageMK.buy coin') }}</a>
                            </li>
                        @else
                            <li class="nav-item px-2">
                                <a class="nav-link texts" href="/buycoin">{{ __('messageMK.buy coin') }}</a>
                            </li>
                        @endif
                    @endif
                    <li class="nav-item companys">
                        <a href="/" class="navbar-brand d-lg-inline">
                            <img src="{{ $name->site_logo }}" width="80px"
                                class="pe-2" />
                            <span class="comapanynames">{{ $name->site_name }}</span>
                        </a>
                    </li>
                    @if ($nav == 'inform')
                        <li class="nav-item px-2">
                            <p class="nav-link texts actives position-relative" id="informButton">
                                {{ __('messageMK.inform') }}
                                <span id="alertCount"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{-- {{ $count }} --}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </p>

                        </li>
                    @else
                        <li class="nav-item px-2">
                            <p class="nav-link texts  position-relative" id="informButton">
                                {{ __('messageMK.inform') }}
                                <span id="alertCount"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    {{-- {{ $count }} --}}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </p>
                            <div id="informAlert" class="informAlert bg-dark">
                                @if (session()->has('customerId'))
                                    <div
                                        class="headerInform d-flex flex-row justify-content-center align-items-center  ">
                                        <div class="topNotch "></div>
                                        <div class="position-relative">
                                            <p class="   infromTitle" id="clickNews">
                                                {{ __('messageZY.new') }}
                                            </p>
                                        </div>
                                        <div class="position-relative" id="informTitleCountShowForMessage">
                                            <p class="  infromTitle" id="clickMessages">
                                                {{ __('messageZY.message') }}
                                            </p>
                                        </div>
                                        <div class="position-relative" id="informTitleCountShowForTrack">
                                            <p class=" infromTitle" id="clickTracks">
                                                {{ __('messageZY.track') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="forNews d-flex flex-column bg-dark" id="forNews">
                                        {{-- <a href="/customerNews" class="ms-auto me-2"><button class="btn mb-2 alertButton">
                                                {{ __('messageZY.more') }}</button></a> --}}
                                    </div>
                                    <div class="forMessages d-flex flex-column" id="forMessages">
                                        {{-- <a href="/messages" class="ms-auto me-2"><button class="btn mb-2 alertButton">
                                                {{ __('messageZY.more') }}</button></a> --}}
                                    </div>
                                    <div class="forTracks d-flex flex-column" id="forTracks">
                                        {{-- <a href="/tracks" class="ms-auto me-2"><button class="btn mb-2 alertButton">
                                                {{ __('messageZY.more') }}</button></a> --}}
                                    </div>
                                @else
                                    <div
                                        class="headerInform d-flex flex-row justify-content-center align-items-center ">
                                        <div class="topNotch"></div>
                                        <p class="fw-bolder fs-5 text-center  infromTitle" id="clickNews">
                                            {{ __('messageZY.new') }}
                                        </p>
                                    </div>
                                    <div class="forNews d-flex flex-column bg-dark" id="forNews">
                                    </div>
                                @endif
                            </div>
                        </li>
                    @endif

                    @if (session()->has('customerId'))
                        <li class="nav-item" id="cartButton">
                            <a href="/cart" class="nav-link texts "><i class="fas fa-shopping-cart fs-3"></i>
                                <span id="cartCount2"
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartcount"></span></a>
                        </li>
                        <li class="nav-item">
                            {{-- <p class="nav-link texts" id="profileButton"><i class="fas fa-user-circle fs-2"></i></p> --}}
                            <div class="dropdown " id="profileButton">

                                <i class="fas fa-user-circle fs-2 dropdown-toggle  texts" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false"></i>

                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark"
                                    aria-labelledby="profileButton">
                                    <li><a class="dropdown-item"
                                            href="{{ route('editprofile.index') }}">{{ __('messageZY.profileSetting') }}</a>
                                    </li>
                                    <li><a class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#modal2">{{ __('messageZY.logout') }}</a></li>

                                </ul>
                            </div>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link texts" href="/signin">{{ __('messageMK.access') }}</a>
                        </li>
                    @endif
                </ul>
            </div>

            {{-- /*
                * Create:zayar(2022/01/17)
                * Update:
                */ --}}
            {{-- start profile alert box --}}

            {{-- <div id="profileAlert">
                <div class="d-flex flex-row justify-content-center profileAlertHeader">

                    <p class="userProfile text-center">User Profile</p>
                    <a href="/logout"><i class="fas fa-sign-out-alt fs-4 mt-2 me-2 text-light" id="logout"></i></a>
                </div>
                <div class="profileAlertBody" id="profileAlertBody">
                    <div class="d-flex flex-row gap-4 justify-content-center  profileAlertfooter">
                        <a href="{{ route('editprofile.index') }}" class="mb-3 "><button
                                class="btn fs-5  editProfile">Edit
                                Profile</button></a>
                        <a href="{{ route('updateprofile.index') }}" class="mb-3 "><button
                                class="btn fs-5  updatePassword">Change
                                Password</button></a>
                    </div>
                </div>
            </div> --}}
            {{-- Start model --}}
            <div id="modal2" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
                    <div class="modal-content">
                        <div class="d-flex justify-content-end ">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="d-flex flex-column">
                            <p class="fs-3 mx-4">{{ __('messageZY.yousure') }}</p>
                            <small class="mx-4 mb-4">{{ __('messageZY.logging') }}.Your cart item will be
                                lost.</small>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn border-secondary"
                                data-bs-dismiss="modal">{{ __('messageZY.back') }}</button></a>
                            <a href="/logout"> <button type="button"
                                    class="btn  btnlogout">{{ __('messageZY.logout') }}</button></a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End model --}}
            {{-- <div id="informAlert" class="informAlert">
                @if (session()->has('customerId'))
                    <div class="headerInform d-flex flex-row justify-content-center align-items-center  ">
                        <div class="topNotch "></div>
                        <div>
                            <p class="fw-bolder fs-5  infromTitle" id="clickNews">{{ __('messageZY.new') }}</p>
                        </div>
                        <div>
                            <p class="fw-bolder fs-5 infromTitle" id="clickMessages">
                                {{ __('messageZY.message') }}
                            </p>
                        </div>
                        <div>
                            <p class="fw-bolder fs-5 infromTitle" id="clickTracks">{{ __('messageZY.track') }}
                            </p>
                        </div>
                    </div>
                    <div class="forNews d-flex flex-column" id="forNews">
                        
                    </div>
                    <div class="forMessages d-flex flex-column" id="forMessages">
                        
                    </div>
                    <div class="forTracks d-flex flex-column" id="forTracks">
                        
                    </div>
                @else
                    <div class="headerInform d-flex flex-row justify-content-center align-items-center ">
                        <div class="topNotch"></div>
                        <p class="fw-bolder fs-5 text-center  infromTitle" id="clickNews">
                            {{ __('messageZY.new') }}
                        </p>
                    </div>
                    <div class="forNews d-flex flex-column" id="forNews">
                    </div>
                @endif
            </div> --}}
            {{-- End Inform Alert --}}
        </nav>
        {{-- end navbar --}}

        @yield('header')
    </header>
    {{-- End Header --}}

    @yield('section')

</body>

</html>
