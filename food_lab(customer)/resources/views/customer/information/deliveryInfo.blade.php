@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('title',"$name->site_name | Delivery Information")

@section('body')
    {{-- Start Delivery Section --}}
    <section class="deliverys">
        <div class="d-flex ps-5 py-4">
            <div class="me-4 mt-3">
                <a href="/home"><i class="fas fa-arrow-left text-white arrows"></i></a>
            </div>
            <div style="width: 50px">
                <img src="{{ $name->site_logo }}" width="100%" alt="logo"/>
            </div>
        </div>

        <p class="fw-bolder text-center pt-5 pb-3 del-infos">{{ __('messageMK.Delivery Information') }}</p>
        <div class="row">
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
@endsection
