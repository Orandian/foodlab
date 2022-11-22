@extends('COMMON.layout.layout_customer')

@section('title')
  {{ $name->site_name }} | Food Detail
@endsection

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customerProductDetail.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{ url('js/customerShop.js') }}" type="text/javascript"></script>

    {{-- <script src="{{ url('js/commonCustomer.js') }}" type="text/javascript" defer></script> --}}

@endsection

@section('title', 'Food Lab')

@section('header')

    <div class="container-fluid">
        <div class="d-flex mt-2 align-items-baseline">
            <a href="/">
                <i class="fas fa-arrow-left fs-2 text-white arrows"></i>
            </a>
            <div class="mx-5 details">Food Details</div>
        </div>

        <div class="container mt-3">
            <div class="row">
                <div class="col-md-6 col-sm-10 m-auto">

                        <div class="col-sm-10 mb-3 m-auto text-center">
                            <div class="m-auto mainblocks">
                                    <img src="@isset($photos[0]->path){{ $photos[0]->path }}@endisset" id="mainimg"
                                    class="img-fluid mainimgs" alt="">

                                </div>

                            </div>
                            <div class="col-md-12 col-sm-12  p-2 ">
                                <div class="d-flex col-md-12 col-sm-12   blocks">
                                    <div class="d-flex justify-content-center  customBlock border">
                                        <img src="@isset($photos[1]->path){{ $photos[1]->path }}@endisset"
                                                class="img-fluid images" onclick="changeImage(this)">
                                        </div>
                                        <div class="d-flex justify-content-center customBlock border">
                                            <img src="@isset($photos[2]->path){{ $photos[2]->path }}@endisset"
                                                    class="img-fluid  images" onclick="changeImage(this)" alt="">
                                            </div>
                                            <div class="d-flex justify-content-center   customBlock border">
                                                <img src="@isset($photos[3]->path){{ $photos[3]->path }}@endisset"
                                                        class="img-fluid  images" onclick="changeImage(this)" alt="">
                                                </div>
                                                <div class="d-flex justify-content-center   customBlock border">
                                                    <img src="@isset($photos[4]->path){{ $photos[4]->path }}@endisset"
                                                            class="img-fluid  images" onclick="changeImage(this)" alt="">
                                                    </div>
                                                    <div class="d-flex justify-content-center   customBlock border">
                                                        <img src="@isset($photos[5]->path){{ $photos[5]->path }}@endisset"
                                                                class="img-fluid images" onclick="changeImage(this)" alt="">
                                                        </div>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="col-md-6 col-sm-10 ms-auto">
                                            <form action="/cartOne" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-10 col-sm-10 m-auto mt-2">
                                                        <p class="pdname">{{ $productId->product_name }}</p>
                                                        <div class="d-flex justify-content-between m-auto">
                                                            <p class="pcoin">Coin :</p>
                                                            <p class="coins"> <i class="fas fa-coins pe-2 icons"></i>{{ $productId->coin }}</p>
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <p class="pamount">Amount :</p>
                                                            <p class="amount"><i class="fa-solid fa-money-bill money text-success"></i> {{ number_format($productId->amount) }} Ks</p>
                                                        </div>

                                                        <div class="d-flex  justify-content-between">
                                                            <p class="ptype">Type :</p>
                                                            <p class="type">{{ $productId->favourite_food }}</p>
                                                        </div>

                                                        <div class="d-flex justify-content-between">
                                                            <p class="ptaste">Taste :</p>

                                                            <p class="taste">{{ $productId->taste }}</p>
                                                        </div>

                                                        <div class="">
                                                            <p class="pingredients">Ingredients :</p>
                                                            <span class="col-md-10 col-sm-10  mx-4   m-auto ingredients">
                                                                {{ $productId->list }} </span>
                                                        </div>

                                                        <div class="col-md-10">
                                                            <p class="pdesc">Description :</p>
                                                            {{-- <input type="text" class="form-control border-0 bg-dark text-light" value="{{ $productId->description }}" readonly> --}}
                                                            <span class="col-md-10 col-sm-10 mx-4 mt-2 mb-2 text-justify   desc ">
                                                                {{ $productId->description }} </span>
                                                        </div>
                                                    </div>


                                                    <div class="d-flex col-md-12 col-sm-10 ">
                                                        <div class="container-fluid col-md-7 col-sm-6 d-flex  justify-content-between mb-3">
                                                            <div class="d-flex justify-content-center  col-md-5 bg-light  rounded mt-3 qty ">
                                                                <span class="minus">-</span>
                                                                <input type="number" class="counts" id="qty" name="qty" value="1">
                                                                <span class="plus">+</span>
                                                            </div>

                                                        </div>


                                                    </div>


                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                @php
                                    $count = 0;
                                    $label = '';
                                    $countId = 1;
                                @endphp
                            @if (count($detail) > 0)
                            <div class="container-fluid mt-5">
                                <div class="row">
                                    @for ($i = 0; $i < count($detail); $i++)
                                        @php
                                            $label = $detail[$i]->label;
                                        @endphp
                                        <div class="col-md-3 d-flex ms-auto lab">
                                            <p class="ptopping  ptop">{{ $detail[$i]->label }}</p>
                                        </div>
                                        <div class="col-md-8 col-sm-10  d-flex flex-wrap ">
                                            @foreach ($detail as $item1)
                                                @if ($label == $item1->label && $item1->category == 2)
                                                    <div class="col-md-3 col-sm-2 form-check m-2">
                                                        <input type="checkbox" name="check{{ $countId }}" id="" class="form-check-input "
                                                            value="{{ $item1->value }}">
                                                        <label for="" class="form-check-label labels">{{ $item1->value }}</label>
                                                    </div>
                                                    @php
                                                        $count++;
                                                        $countId++;
                                                    @endphp
                                                @elseif ($item1->label == $label && $item1->category === 1)
                                                    <div class="col-md-3 col-sm-2  m-2">
                                                        <select name="select{{ $countId }}" id="" class="form-select">
                                                            <option value="0" selected disabled>Choose any type</option>
                                                            @php

                                                                $countId++;
                                                            @endphp
                                                            @foreach ($detail as $item2)
                                                                @if ($item2->label == $label && $item2->category === 1)
                                                                    <option value="{{ $item2->value }}">{{ $item2->value }}</option>
                                                                    @php
                                                                        $count++;

                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                @break
                                            @endif
                                    @endforeach
                                </div>
                                @php
                                    $i = $count;
                                @endphp
                                @endfor
                            </div>
                        </div>
                            @endif




                            @if (session()->has('customerId'))
                                <div class="d-flex justify-content-end col-md-6 col-sm-6 mt-3 mx-auto  ">
                                    <button class="btn btns" data-bs-toggle="modal" data-bs-target="#modal4">Buy Now</button>
                                  <button id="{{ $productId->pid }}" class="btn btns buy" data-bs-toggle="modal" data-bs-target="#modal">Add to Cart</button>

                                </div>


                            @else
                            <div class="d-flex justify-content-end col-md-6 col-sm-6 mt-3 m-auto  ">
                                <button class="btn btns" data-bs-toggle="modal" data-bs-target="#modal3">Buy Now</button>

                            </div>

                            @endif



                            <div class="container-fluid mt-5 p-3">
                                <div class="d-flex justify-content-center">
                                    <p class="copy">Copyright &copy; {{ $name->site_name }}</p>
                                </div>
                            </div>
                            </div>



                                {{-- start modal --}}
                            <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
                                <div class="modal-content">


                                    <div class="d-flex justify-content-end ">
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                    </div>

                                    <p class="mx-4"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>A new item has been added
                                        to your Shopping Cart. You now have item in your Shopping Cart.</p>

                                    <div class="modal-footer">
                                        <a href="/cart"> <button type="button" class="btn btnCart">View Shopping Cart</button></a>
                                        <button type="button" class="btn btnShopping" data-bs-dismiss="modal">Continue Shopping</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end modal --}}

                        {{--start model --}}
                        <div id="modal3" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
                            <div class="modal-content">


                                <div class="d-flex justify-content-end ">
                                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="fs-3 mx-4">Welcome! Please Login to continue.</p>
                                    <small class="mx-4 mb-4">New member? <a href="/access">Register</a> here </small>
                                </div>
                                <div class="modal-footer">
                                   <button type="button" class="btn border-primary btncancel" data-bs-dismiss="modal">Cancel</button></a>
                                   <a href="/signin"> <button type="button" class="btn btn-primary btnlogin" >Login</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                     {{--end model --}}

                     {{--start model --}}
                     <div id="modal4" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                     aria-labelledby="staticBackdropLabel" aria-hidden="true">
                     <div class="col-sm-6  modal-dialog modal-dialog-centered " role="document">
                         <div class="modal-content">


                             <div class="d-flex justify-content-end ">
                                 <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">&times;</button>
                             </div>

                             <div class="d-flex flex-column">
                                 <p class="fs-5 mx-4"> <span><i class="fas fa-check-circle text-success mx-2"></i></span> Are you sure? You want to buy this.</p>

                             </div>
                             <div class="modal-footer d-flex justify-content-end">
                                <button type="button" class="btn btnShopping" data-bs-dismiss="modal">No</button></a>
                                <a href="/cart"> <button type="button" class="btn btnCart buy" >Yes</button></a>
                             </div>
                         </div>
                     </div>
                 </div>
                  {{--end model --}}

                        </div>

                            <script>
                                let pid = @json($productId->pid);

                            </script>

                            <script src="{{ url('js/productDetail.js') }}" type="text/javascript" defer></script>
                        @endsection
