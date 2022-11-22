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

@section('title', "$name->site_name | Tracks")
@section('body')



    <div class="d-flex ps-5 py-4">
        <div class="me-4 mt-3">
            <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <img src="{{ $name->site_logo }}" width="50px" />
        </div>
    </div>
    <h1 class=" fw-bold text-center heading">{{ __('messageZY.tracks') }}</h1>
    @php
    $ldate = date('Y-m-d H:i:s');
    $currentdate = strtotime($ldate);
    @endphp
    @forelse ($alltracks as $alltrack)
        @php
            $allcolor = ['yellow', 'red', 'green', 'red', 'green', 'green'];
            $statusMessage = $alltrack->order_status;
            $messagecolor = $allcolor[$statusMessage - 1];
            
            $date2 = strtotime($alltrack->trackscreated);
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
        @if ($alltrack->seen == 0)
            <div class="tracks d-flex flex-row justify-content-center align-items-center my-2" id="{{ $alltrack->tid }}">

                <div class="d-flex flex-column  me-auto ms-5 mt-4  ">
                    <p class=" fw-bolder fs-4 productname">

                        {{ $alltrack->title }}
                    </p>
                    <p class=" fw-bold fs-4">{{ $alltrack->coin }} <i class="coinCalInform fas fa-coins"></i>
                        ({{ $alltrack->amount }} {{ __('messageZY.mmk') }})
                    </p>
                </div>
                <div class="d-flex flex-column  me-5 mt-4 ">
                    <p class="fs-3 me-3 fw-bolder titleStatus rounded {{ $messagecolor }} w-100 text-center">
                        {{ $alltrack->status }}
                    </p>
                    <p class=" fw-bold fs-5 mb-3 ">
                        {{-- {{ $diff == 0 ? 'Today' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}</p> --}}
                        {{ $message }}
                    </p>
                </div>
                {{-- <img src="img/new.png" alt="" class="newsLogoMessage" width="45vw"> --}}
                <div class="bottomLine"></div>
                <div class="newsLine"></div>
            </div>
        @else
            <div class="tracks d-flex flex-row justify-content-center align-items-center my-2" id="{{ $alltrack->tid }}">

                <div class="d-flex flex-column  me-auto ms-5 mt-4  ">
                    <p class=" fw-bolder fs-4 productname">

                        {{ $alltrack->title }}
                    </p>
                    <p class=" fw-bold fs-4">{{ $alltrack->coin }} <i class="coinCalInform fas fa-coins"></i>
                        ({{ $alltrack->amount }} {{ __('messageZY.mmk') }})
                    </p>
                </div>
                <div class="d-flex flex-column  me-5 mt-4 ">
                    <p class="fs-3 me-3 fw-bolder titleStatus rounded {{ $messagecolor }} w-100 text-center">
                        {{ $alltrack->status }}
                    </p>
                    <p class=" fw-bold fs-5 mb-3 ">
                        {{-- {{ $diff == 0 ? $tdiff . 'hours ago' : ($diff == 1 ? 'Yesterday' : $diff . 'days ago') }}</p> --}}
                        {{ $message }}
                    </p>
                </div>
                <img src="" alt="" class="newsLogoMessage" width="45vw">
                <div class="bottomLine"></div>

            </div>
        @endif

    @empty
        <div class="news d-flex flex-row justify-content-center align-items-center my-4">

            <div class="d-flex flex-column w-100 ms-5 mt-4">
                <p class=" fw-bolder fs-5 ">{{ __('messageZY.notrack') }} </p>

            </div>

        </div>
    @endforelse
    <div class="d-flex justify-content-center mt-4">{{ $alltracks->links() }}</div>
@endsection
