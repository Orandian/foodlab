@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/newsAll.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script')
    {{-- <script src="{{ url('js/customer.js') }}" type="text/javascript" defer></script> --}}

@endsection

@section('title', "$name->site_name | News")
@section('body')



    <div class="d-flex ps-5 py-4">
        <div class="me-4 mt-3">
            <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <img src="{{ $name->site_logo }}" width="50px" />
        </div>
    </div>
    <h1 class=" fw-bold text-center heading">{{ __('messageZY.news') }}</h1>
    <div class="allNews">

        <div class="newsForAll mt-4 d-flex flex-column gap-3">
            @php
                $ldate = date('Y-m-d H:i:s');
                $currentdate = strtotime($ldate);
            @endphp
            @forelse ($allnews as $allnew)
                @php
                    $date2 = strtotime($allnew->newscreated);
                    $totalSecondsDiff = abs($date2 - $currentdate);
                    $totalDaysDiff = $totalSecondsDiff / 60 / 60 / 24; //493.05
                    $diff = (int) $totalDaysDiff;
                @endphp
                @if ($diff < 3)
                    <div class="  newsA d-flex flex-row  justify-content-between align-items-center">
                        <img src="{{ $allnew->source }}" alt="" class="ms-3 rounded" width="60vw">
                        <div class="titleDateBox">
                            <div class="d-flex flex-row mt-2">
                                <p class=" fs-5 fw-bolder Wtruncate">{{ $allnew->title }}
                                </p>
                                <p class="  fs-5 fw-bolder Wtruncate">
                                    {{ $allnew->detail }}
                                </p>

                            </div>
                            <p class="fs-5 fw-bold  Mtruncate dateDiv">
                                {{ $diff == 0 ? 'Today' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}
                            </p>
                        </div>
                        {{-- <img src="img/new.png" alt="" class="newsLogoMessage" width="40vw"> --}}
                        <div class="bottomLine"></div>
                        <div class="newsLine"></div>
                    </div>
                @else
                    <div class="  newsA d-flex flex-row  justify-content-between align-items-center">
                        <img src="{{ $allnew->source }}" alt="" class="ms-3 mb-4 rounded" width="60vw">
                        <div class="titleDateBox">
                            <div class="d-flex flex-row mt-2  ">
                                <p class=" fs-5 fw-bolder  Wtruncate ">{{ $allnew->title }}
                                </p>
                                <p class="  fs-5 fw-bolder Wtruncate ">
                                    {{ $allnew->detail }}
                                </p>

                            </div>
                            <p class="fs-5 fw-bold Mtruncate dateDiv">
                                {{ $diff == 0 ? 'Today' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}
                            </p>
                        </div>
                        <img src="" alt="" class="newsLogoMessage" width="40vw">
                        <div class="bottomLine"></div>
                    </div>
                @endif

            @empty
                <div class="newsForAll mb-4">
                    <div class="news d-flex flex-row justify-content-center align-items-center">
                        <p class="fs-5 fw-bolder mt-2 me-auto">{{ __('messageZY.nonews') }} </p>
                    </div>
                </div>
            @endforelse
        </div>
        <div class="d-flex justify-content-center mt-4">{{ $allnews->links() }}</div>

    @endsection
