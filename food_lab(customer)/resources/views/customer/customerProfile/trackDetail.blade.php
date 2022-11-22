@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/newsDetail.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    {{-- <script src="{{ url('js/customer.js') }}" type="text/javascript" defer></script> --}}

@endsection

@section('title', "$name->site_name | Track Detail")
@section('body')

    <div class="d-flex ps-5 py-4">
        <div class="me-4 mt-3">
            <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <img src="{{ $name->site_logo }}" width="50px" />
        </div>
    </div>
    <h1 class=" fw-bold text-center heading">{{ __('messageZY.trackDetail') }}</h1>
    <div class="allNews  m-auto ">
        <div class="d-flex flex-column trackDetailContainer mt-5 m-auto">
            @php
                $names = $track->title;
                $namesA = explode(' ', $names);
                $namesArray = array_slice($namesA, 1);
                $c = 0;
                
                $allcolor = ['cyellow', 'cgray', 'cgreen', 'cred', 'cgreen', 'cgreen'];
                $statusMessage = $track->order_status;
                $messagecolor = $allcolor[$statusMessage - 1];
            @endphp

            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto  ms-1 w-25">{{ __('messageZY.product') }}</label>

                <div class="d-flex flex-column titleInfo ms-1 w-50 namesShow">
                    @foreach ($namesArray as $nameB)
                        @php
                            $c++;
                        @endphp
                        <p class=" titleInfo  names">
                            {{ $c }}. {{ $nameB }}</p>
                    @endforeach
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto  ms-1">{{ __('messageZY.coin') }}</label>
                <p class="  titleInfo ms-auto">{{ $track->total_coin }} <i class="fas fa-coins pe-2 coins"></i></p>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto  ms-1">{{ __('messageZY.status') }}</label>
                <p class=" titleInfo ms-auto {{ $messagecolor }}">{{ $track->status }}</p>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital  me-auto ms-1">{{ __('messageZY.requestedat') }}</label>
                <p class=" titleInfo ms-auto date ">{{ $track->tracksupdated }}</p>
            </div>
        </div>
    </div>
@endsection
