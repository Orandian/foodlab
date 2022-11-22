@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/newsAll.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="{{ url('js/forAllMessages.js') }}" type="text/javascript" defer></script>

@endsection

@section('title', "$name->site_name | Messages")
@section('body')

    <div class="d-flex ps-5 py-4 position-sticky fixed-top bg-black">
        <div class="me-4 mt-3">
            <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <img src="{{ $name->site_logo }}" width="50px" />
        </div>
    </div>
    <h1 class=" fw-bold text-center heading position-sticky bg-black">{{ __('messageZY.messages') }}</h1>
    @php
    $ldate = date('Y-m-d H:i:s');
    $currentdate = strtotime($ldate);
    @endphp
    <div class="allNews">
        @forelse ($allmessages as $allmessage)
            @php
                $messagecolor = '';
                if ($allmessage->title == 'APPROVED') {
                    $messagecolor = 'green';
                }
                if ($allmessage->title == 'REQUEST') {
                    $messagecolor = 'yellow';
                }
                if ($allmessage->title == 'WAITING') {
                    $messagecolor = 'yellow';
                }
                if ($allmessage->title == 'REJECT') {
                    $messagecolor = 'gray';
                }
                $date2 = strtotime($allmessage->messagecreated);
                $totalSecondsDiff = abs($date2 - $currentdate);
                $message = '';
                $totalDaysDiff = $totalSecondsDiff / 60 / 60 / 24; //493.05
                $totalDaysDiffPlus = $totalDaysDiff;
                $totalTimesDiff = $totalSecondsDiff / 60 / 60;
                $totalMinutesDiff = $totalSecondsDiff / 60;
                $diff = (int) $totalDaysDiff;
                $tdiff = (int) $totalTimesDiff;
                $mdiff = (int) $totalMinutesDiff;
                if ($diff == 0) {
                    if ($tdiff == 0) {
                        $message = $mdiff == 0 ? '1 minute ago' : ($mdiff == 1 ? '1 minute ago' : $mdiff . 'minutes ago');
                    } elseif ($tdiff == 1) {
                        $message = $tdiff . 'hour ago';
                    } else {
                        $message = $tdiff . 'hours ago';
                    }
                } elseif ($diff == 1) {
                    $message = 'Yesterday';
                } else {
                    $message = $diff . ' ' . ' days ago';
                }
            @endphp
            @if ($allmessage->seen == 0)
                <div class="newsAll d-flex flex-row justify-content-center messageClick align-items-center mb-4"
                    id="{{ $allmessage->id }}">
                    <p class="fs-4 fw-bolder me-auto ms-5 mt-3 text-truncate  ">{{ $allmessage->detail }}</p>
                    <div class="d-flex flex-column me-5 ms-auto ">
                        <p
                            class="fs-5 fw-bolder me-4 w-100 titleStatus ms-auto mt-2 rounded text-center {{ $messagecolor }}">
                            {{ $allmessage->title }}
                        </p>
                        <p class=" fw-bold fs-5  mb-1 me-3">
                            {{-- {{ $diff == 0 ? 'Today' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}</p> --}}
                            {{ $message }}
                        </p>
                    </div>
                    {{-- <img src="img/new.png" alt="" class="newsLogoMessage" width="45vw"> --}}
                    <div class="bottomLine"></div>
                    <div class="newsLine"></div>
                </div>
            @else
                <div class="newsAll d-flex flex-row justify-content-center messageClick align-items-center mb-4"
                    id="{{ $allmessage->id }}">
                    <p class="fs-4 fw-bolder me-auto ms-5 mt-3 text-truncate  ">{{ $allmessage->detail }}</p>
                    <div class="d-flex flex-column me-5 ms-auto ">
                        <p
                            class="fs-5 fw-bolder me-4 w-100 titleStatus ms-auto mt-2 rounded text-center {{ $messagecolor }}">
                            {{ $allmessage->title }}
                        </p>
                        <p class=" fw-bold fs-5  mb-1 me-3">
                            {{-- {{ $diff == 0 ? 'Today' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}</p> --}}
                            {{ $message }}
                        </p>
                    </div>
                    <img src="" alt="" class="newsLogoMessage" width="45vw">
                    <div class="bottomLine"></div>
                </div>
            @endif

        @empty
            <div class="news d-flex flex-row justify-content-center align-items-center mb-4">
                <p class="fs-5 fw-bolder me-auto ms-5 mt-3">{{ __('messageZY.nomessage') }} </p>
            </div>
        @endforelse

    </div>
    <div class="d-flex justify-content-center mt-4">{{ $allmessages->links() }}</div>
@endsection
