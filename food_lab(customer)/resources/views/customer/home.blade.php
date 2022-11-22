@extends('COMMON.layout.layout_customer')

@section('css')
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css" />
    {{-- aos library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
@endsection


@section('script')
    <script src="{{ url('js/commonCustomer.js') }}" type="text/javascript" defer></script>
    <script src="{{ url('js/customer.js') }}" type="text/javascript" defer></script>
    {{-- aos library --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
@endsection

@section('title', "$name->site_name | home")

@section('header')
    {{-- start carousel --}}
    <div id="carouselExampleIndicators" class="carousel slide carousels mt-5" data-bs-ride="">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            @forelse($sliderInfos as $sliderInfo)
                <div class="carousel-item @if ($loop->first) active @endif" style="background-image:url('{{ $sliderInfo->image }}');background-size:cover">
                    <div class="row align-items-center items ms-2 justify-content-center">
                        <div class="col-9  flex-column slidertx p-4 text-center">
                            <h1 class="fw-bolder  tastes text-uppercase">{{ $sliderInfo->banner_title }}</h1>
                            <p class=" fs-4  w-70  text-light lead text-left">
                                {{ $sliderInfo->banner_detail }}
                            </p>
                            @if ($sliderInfo->button_state == 1)
                                <a href="/{{ $sliderInfo->button_link }}"
                                    class="btn delivery-btns">{{ $sliderInfo->button_text }}</a>
                            @endif
                        </div>

                        {{-- <div class="col-4">
                            <img src="/storage/sliderImageFile/{{ $sliderInfo->image }}" class="carousel-photos"
                                alt="{{ $sliderInfo->image }}" />
                        </div> --}}
                    </div>
                </div>
            @empty
                <div class="text-center">
                    <p>No data</p>
                </div>
            @endforelse

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    {{-- end carousel --}}
@endsection

@section('section')

    {{-- Start Welcome Section --}}
    <section class="d-flex flex-column justify-content-center align-items-center welcomes" id="welcomes">
        <p class="fs-1 p-3 fw-bolder text-uppercase text-center welcometexts" data-aos="zoom-out-up"
            data-aos-easing="linear" data-aos-duration="900">{{ __('messageMK.welcome') }}{{ $name->site_name }}</p>
        <p class="fs-3 p-3 text-break companyinfos" data-aos="zoom-out-up" data-aos-easing="linear" data-aos-duration="900">
            <i class="fas fa-quote-left falefts me-5"></i>{{ $name->intro }}<i
                class="fas fa-quote-right farights ms-5"></i></p>
    </section>
    {{-- End Welcome Section --}}

    {{-- Start Best Seller Item Section --}}
    <section class="best-items">
                <div class="bg-black menulist my-5 p-2"  data-aos="fade-up" data-aos-easing="linear" data-aos-duration="900">
            <div class="foods my-5">
                   <div class="img-container">
                 <img src="{{ url('img/menu.png') }}" />
                   </div>
                   <p class="fw-bold my-2 fs-4 text-white text-center ">
                      Chinese Food
                  </p>
                  <p class="text-muted text-center lead ">
                      Try these delicious Chinese recipes at home for your next meal.
                  </p>
            </div>
            <div class="foods my-5">
                   <div class="img-container">
                  <img src="{{ url('img/menu2.png') }}" />
                   </div>
                   <p class="fw-bold  my-2 fs-4 text-white text-center ">
                      Korean Food
                  </p>
                  <p class="text-muted text-center lead ">
                    There are over 100 different types of kimchi should tell you something about the pride Koreans have in their food.
                  </p>
            </div>
            <div class="foods my-5">
                <div class="img-container">
                 <img src="{{ url('img/menu5.png') }}" />
                 </div>
                   <p class="fw-bold  my-2 fs-4 text-white text-center ">
                      Burmese Food
                  </p>
                  <p class="text-muted text-center lead ">
                    Visitors are discovering a cuisine that's been largely hidden from sight for the past 50 years.
                  </p>
            </div>
            <div class="foods my-5">
                   <div class="img-container">
                 <img src="{{ url('img/menu4.png') }}" />
                   </div>
                   <p class="fw-bold  my-2 fs-4 text-white text-center ">
                      Thai Food
                  </p>
                  <p class="text-muted text-center lead ">
                     Whatever type of Thai you're in the mood for, you'll find it here at its tantalizing best!
                  </p>
            </div>

        </div>
        <div class="seller-headers" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="900">
            <img src="{{ url('img/Best_Seller_Item1.png') }}" />
        </div>

        <div class="d-flex flex-wrap justify-content-around align-items-center text-light sellers">
            {{-- start items --}}
            @forelse ($sellProducts as $sellProduct)
                <div class="d-flex flex-column justify-content-center align-items-center fw-bold my-3 py-5"
                    id="{{ $sellProduct->product_id }}">
                    <div class="product-imgs">
                        <img src="{{ $sellProduct->path }}" alt="bestitem1" width="100%" />
                    </div>
                    <p class="fs-3 pt-2 text-uppercase">{{ $sellProduct->product_name }}</p>
                    <p class="fs-5"><i class="fas fa-coins pe-2 coins"></i> {{ $sellProduct->coin }}</p>
                    <p class="fs-5"><i class="fa-solid fa-money-bill money text-success"></i><span
                            class="prices"> {{ $sellProduct->amount }}</span> Ks</p>
                    @if (session()->has('customerId'))
                        <button type="button" id="{{ $sellProduct->product_id }}" class="btn shopbtns shopcart"
                            data-bs-toggle="modal" data-bs-target="#modal">{{ __('messageMK.shopnow') }}</button>
                    @else
                        <a href="/signin"><button type="button"
                                class="btn shopbtns">{{ __('messageAMK.shopnow') }}</button></a>
                    @endif
                </div>
            @empty
                <div class="text-center">
                    <p class="fs-2 fw-bolder my-3">No product</p>
                </div>
            @endforelse
            {{-- end items --}}

        </div>
    </section>
    {{-- End Best Seller Item Section --}}

    {{-- Start Recommand Item Section --}}
    @if (session()->has('customerId'))
        <section class="recommand-items">
            <div class="seller-headers" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="900">
                <img src="{{ url('img/recommand_item.png') }}" />
            </div>
            <div class="d-flex flex-wrap justify-content-around align-items-center text-light recommands"
                data-aos="fade-up" data-aos-easing="linear" data-aos-duration="900">
                {{-- start items --}}
                @foreach ($recomProducts as $recomProduct)
                    @foreach ($recomProduct as $product)
                        <div class="d-flex flex-column justify-content-center align-items-center fw-bold my-3 py-5"
                            id="{{ $product->id }}">
                            <div class="product-imgs">
                                <img src="{{ $product->path }}" width="100%" alt="bestitem1" />
                            </div>
                            <p class="fs-3 pt-2">{{ $product->product_name }}</p>
                            <p class="fs-5"><i class="fas fa-coins me-2 coins"></i>{{ $product->coin }}</p>
                            <p class="fs-5"><i class="fa-solid fa-money-bill money text-success"></i><span
                                    class="prices"> {{ $product->amount }}</span> Ks</p>
                            <button type="button" id="{{ $product->link_id }}" class="btn shopbtns shopcart"
                                data-bs-toggle="modal" data-bs-target="#modal">{{ __('messageMK.shopnow') }}</button>
                        </div>
                    @endforeach
                @endforeach
                {{-- end items --}}
            </div>
        </section>
    @endif
    {{-- End Recommand Item Section --}}
    {{-- Start Delivery Section --}}
    <section class="deliverys">
        <div class="text-center delivery-headers" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="900">
            <img src="{{ url('img/delivery.png') }}" />
        </div>
        <div class="row" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="900">
            {{-- start delivery Informaiton --}}
            <div class="col-12 township-infos">
                <div class="row justify-content-center align-items-center text-center text-white">
                    <p class="col-5 fw-bolder del-headers">{{ __('messageMK.townships') }}</p>
                    <p class="col-2 pt-2"><i class="fas fa-arrow-right"></i></p>
                    <p class="col-5 fw-bolder del-headers">{{ __('messageMK.prices') }}</p>
                </div>
                @foreach ($townships as $township)
                    <div class="row justify-content-center align-items-center text-center text-white">
                        <p class="col-5 townships">{{ $township->township_name }}</p>
                        <p class="col-2 pt-2"><i class="fas fa-arrow-right"></i></p>
                        @if ($township->delivery_price == 0)
                            <p class="col-5"><span class="prices">Free</span></p>
                        @else
                            <p class="col-5"><span class="prices">{{ $township->delivery_price }}</span>
                                Ks</p>
                        @endif
                    </div>
                @endforeach
            </div>
            {{-- end delivery Informaiton --}}
        </div>
    </section>
    {{-- End Delivery Section --}}
    {{-- Start Contact Section --}}
    <section>
        <div class="d-flex flex-row justify-content-center align-items-center my-5 contacts">
            <div class="d-flex  justify-content-center align-items-center p-5">
                <div class="company-infos">
                    <p class="fw-bolder mb-5" data-aos="fade-right" data-aos-easing="linear" data-aos-duration="900">
                        {{ __('messageMK.getcontact') }}</p>
                    <div class="company-details" data-aos="fade-left" data-aos-easing="linear" data-aos-duration="900">
                        <div class="row">
                            <div class="col-2 text-center">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="col-10">
                                <p>{{ $name->address }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-center">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="col-10">
                                <p>
                                    <a href="tel:{{ $name->phone1 }}" class="d-block">{{ $name->phone1 }}</a>
                                    @if ($name->phone2 != 'null')
                                        <a href="tel:{{ $name->phone2 }}"
                                            class="d-block">{{ $name->phone2 }}</a>
                                    @endif
                                    @if ($name->phone3 != 'null')
                                        <a href="tel:{{ $name->phone3 }}"
                                            class="d-block">{{ $name->phone3 }}</a>
                                    @endif

                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 text-center">
                                <p><i class="fas fa-envelope"></i></p>
                            </div>
                            <div class="col-10">
                                <a href="mailto:{{ $name->gmail }}">{{ $name->gmail }}</a>
                            </div>
                        </div>
                    </div>
                </div>
                  <div class="text-center contact_img" data-aos="fade-down" data-aos-easing="linear" data-aos-duration="900">
            <img src="{{ url('img/contact.png') }}" />
        </div>
            </div>
       

        </div>
    </section>
    {{-- End Contact Section --}}
    {{-- Start Footer Section --}}
    <footer>
        <div class="pt-5 ps-3 footer-infos">
            <div class="d-flex align-items-center footer-logos">
                <img src="{{ $name->site_logo }}" width="80px" />
                <p class="fw-bolder text-uppercase ms-2 footer-names">{{ $name->site_name }}</p>
            </div>
            <div class="d-flex flex-wrap justify-content-around align-items-start mt-5 pb-3 footer-details">
                <div class="footer-navs">
                    <p><a href="/home">{{ __('messageMK.home') }}</a></p>
                    <p><a href="#welcomes">{{ __('messageMK.aboutus') }}</a></p>
                    <p><a href="/">{{ __('messageMK.Food') }}</a></p>
                    @if (session()->has('customerId'))
                        <p><a href="/buycoin">{{ __('messageMK.buy coin') }}</a></p>
                    @endif
                    @if (!session()->has('customerId'))
                        <p><a href="/signin">{{ __('messageMK.access') }}</a></p>
                    @endif
                </div>
                @if (session()->has('customerId'))
                    <div>
                        <p>{{ __('messageMK.feedback') }}</p>
                        <p><a href="/contact">{{ __('messageMK.contact') }}</a></p>
                        <p><a href="/suggest">{{ __('messageMK.suggest') }}</a></p>
                        <p><a href="/report">{{ __('messageMK.report') }}</a></p>
                    </div>
                @endif
                <div>
                    <div>
                        <p>{{ __('messageMK.information') }}</p>
                        <p><a href="/policyinfo">{{ __('messageMK.privacy') }}</a></p>
                        <p><a href="/delivery">{{ __('messageMK.deliveryinfo') }}</a></p>
                    </div>
                </div>
                <div>
                    <p>{{ __('messageMK.powerby') }}</p>
                    <p class="mailTeams"><a href="mailto:https://www.teamx.com">Team x</a></p>
                </div>
            </div>
        </div>
    </footer>
    <div class="copys">
        <p>Copyright &copy; {{ $name->site_name }}</p>
    </div>
    {{-- End Footer Section --}}


    {{-- start model --}}
    <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">

                <div class="d-flex justify-content-end ">
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">&times;</button>
                </div>

                <p class="mx-4"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>A new item
                    has been added to your Shopping Cart. You now have item in your Shopping Cart.</p>

                <div class="modal-footer">
                    <a href="/cart"> <button type="button" class="btn btnCart shop">View Shopping Cart</button></a>
                    <button type="button" class="btn btnShopping" data-bs-dismiss="modal">Continue Shopping</button>
                </div>
            </div>
        </div>
    </div>

    {{-- end model --}}

    <script src="{{ url('js/customerShop.js') }}" type="text/javascript" defer></script>
    <script>
        AOS.init();
    </script>
@endsection
