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

@section('title', "$name->site_name | Message Detail")
@section('body')


    <div class="d-flex ps-5 py-4">
        <div class="me-4 mt-3">
            <a href="{{ url()->previous() }}"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <img src="{{ $name->site_logo }}" width="50px" />
        </div>
    </div>
    <h1 class=" fw-bold text-center heading">{{ __('messageZY.messageDetail') }}</h1>
    <div class="allNews">
        @php
            $color = '';
        @endphp

        @if ($message->title == 'APPROVED')
            @php
                $color = 'cgreen';
            @endphp
        @endif
        @if ($message->title == 'REQUEST')
            @php
                $color = 'cyellow';
            @endphp
        @endif
        @if ($message->title == 'WAITING')
            @php
                $color = 'cyellow';
            @endphp
        @endif
        @if ($message->title == 'REJECTED')
            @php
                $color = 'cgray';
            @endphp
        @endif
        <div class="d-flex flex-column newsDetailContainer  align-self-center">
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto">{{ __('messageZY.title') }}</label>

                <p class="titleInfo {{ $color }}">{{ $message->title }}</p>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto ">{{ __('messageZY.detail') }}</label>

                <p class=" titleInfo  fs-5 ">{{ $message->detail }}</p>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital  me-auto">{{ __('messageZY.rqcoin') }}</label>

                <p class=" titleInfo  ">{{ $message->request_coin }} <i class="fas fa-coins pe-2 coins"></i></p>
            </div>
            <div class="d-flex flex-row justify-content-center roe ms-3 align-center">
                <label for="detailTital" class="detailTital me-auto ">{{ __('messageZY.requestedat') }}</label>

                <p class=" titleInfo date dateM">{{ $message->messageUpdated }}</p>
            </div>
        </div>
    </div>
@endsection
