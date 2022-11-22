@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link href="css/commonCustomer.css" rel="stylesheet" type="text/css"/>
    {{--  join link to customerCart.css  --}}
    <link href="css/customerCart.css" rel="stylesheet" type="text/css"/>
    {{--  coin icon cdn  --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    {{--  jquery cdn  --}}
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    {{--  coin icon cdn  --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" ></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" ></script>
    {{--  join link to customerCart.js  --}}
    <script src="js/customerCart.js" type="text/javascript" defer></script>
    <script src="{{ url('js/customer.js') }}" type="text/javascript" defer></script>
@endsection

@section('title',"$name->site_name | Cart")

@section('body')
    {{--  Start Cart Session  --}}
    <section class="cart-section">
        <div class="cartTitle">
            <div class="d-flex ps-5 py-4">
                <div class="me-4 mt-3">
                    <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
                </div>
                <div>
                    <p class="fs-1 fw-bolder cart-label">{{ __('messageCPPK.yourCart') }}</p>
                </div>
            </div>

            @if(session()->has('cart'))
                <div class="row text-uppercase text-center">
                    <div class="col-1"></div>
                    <div class="col-5 my-auto">
                        <p id="productTitle">{{ __('messageCPPK.Product') }}</p>
                    </div>
                    <div class="col-3 my-auto">
                        <p id="qtyTitle">{{ __('messageCPPK.Quantity') }}</p>
                    </div>
                    <div class="col-3">
                        <div class="button-box">
                            <div id="btnSwitch"></div>
                            <button type="button" class="toggle-btn" onclick="leftClick()" >{{ __('messageCPPK.Coin') }}</button>
                            <button type="button" class="toggle-btn" onclick="rightClick()">{{ __('messageCPPK.Cash') }}</button>
                        </div>
                    </div>
                </div>

                {{-- Start Added Buy Products  --}}
                @php
                    $i = 1;
                @endphp

                @foreach ($products as $product)

                    <div class="row justify-content-center align-items-center mt-3 products">
                        <div class="col-1 text-center">
                            <ion-icon name="close-sharp" class="fs-1 delete" data-bs-toggle="modal" data-bs-target="#modal1" id="{{ $i++ }}"></ion-icon>
                        </div>
                        <div class="col-3 mb-3 product-img">
                            <img src="{{ $product['path'] }}" alt = "{{ $product['product_name'] }}"/>
                        </div>
                        <div class="col-2">
                            <p class="fw-bold text-uppercase" id="pname">{{ $product['product_name'] }}</p>
                            <p class="fw-bold" id="code">#{{ $product['id'] }}</p>
                        </div>
                        <div class="col-3 text-center">
                            <div class="mx-auto wrapper">
                                <span class="minus">-</span>
                                <span class="num">{{ $product['quantity'] }}</span>
                                <span class="plus">+</span>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            @php
                                $totalCoin = $product['quantity'] * $product['coin'];
                                $totalCash = $product['quantity'] * $product['amount'];
                            @endphp
                            <span class="coinBox"><i class="fas fa-coins fa-1x mt-1 me-2"></i><span class="coin">{{ $totalCoin }}</span></span>
                            <span class="cashBox"><i class="fa-solid fa-money-bill fa-1x money text-success me-2"></i><span class="cash prices">{{ $totalCash }}</span> Ks</span>
                        </div>
                    </div>
                @endforeach
                {{-- End Added Buy Products  --}}
            @else
                <div class="fs-1 fw-bolder my-3 no-datas">
                    <p class="text-white text-center">Plesae Buy First item . <a href="/" class="btn">Buy now</a></p>
                </div>
            @endif
        </div>
        @if(session()->has('cart'))
            <div class="row my-4 bouchers">
            <div class="col-lg-6 d-flex align-items-center justify-content-center cart-icons">
                <img src="img/shopCart.png" alt="" style="width: 40%">
            </div>
            <div class="col-lg-6 col-md-12 text-center">
                <div class="row mb-2">
                    <div class="col-6">
                        <p id="amounttitle">{{ __('messageCPPK.originalTotal') }}</p>
                    </div>
                    <div class="col-6">
                        <p class="coinDiv" id="coinSubTotal"><i class="fas fa-coins fa-1x me-2" id="coinIcon"></i><span class="totalCoin"></span></p>
                        <p class="cashBox"><i class="fa-solid fa-money-bill fa-1x money text-success me-2"></i><span class="totalCash prices"></span> Ks</p>
                    </div>
                </div>
                <div class="row mb-2 totals">
                    <div class="col-6">
                        <p class="deliverytitle">{{ __('messageCPPK.DeliveryFee') }}</p>
                    </div>
                    <div class="col-6">
                        <p class="coinDiv" id="coinDeliPrice"><i class="fas fa-coins fa-1x me-2" id="coinIcon"></i><span class="delCoin">{{ $delCoin }}</span></p>
                        <p class="cashBox"><i class="fa-solid fa-money-bill fa-1x money text-success me-2"></i><span class="delCash prices">{{ $delCash }}</span> Ks</p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <p class="grandtitle">{{ __('messageCPPK.GrandTotal') }}</p>
                    </div>
                    <div class="col-6">
                        <p class="coinDiv" id="coinTotalPrice"><i class="fas fa-coins fa-1x me-2" id="coinIcon"></i><span class="grandCoin"></span></p>
                        <p class="cashBox"><i class="fa-solid fa-money-bill fa-1x money text-success me-2"></i><span class="grandCash prices"></span> Ks</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="btn order" id="order">{{ __('messageCPPK.Delivery') }}</a>
                </div>
            </div>
        </div>
        @endif
        {{-- start modal --}}
        <div class="modal" id="modal1" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>{{ __('messageMK.cancels') }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn no_delete" data-bs-dismiss="modal">{{ __('messageMK.no') }}</button>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <button type="button" class="btn confirms delete-confirms">{{ __('messageMK.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}
    </section>
    {{--  End Cart Session   --}}
@endsection
