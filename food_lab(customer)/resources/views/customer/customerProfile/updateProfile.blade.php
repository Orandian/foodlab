@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customerUpdateProfile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ url('js/updateProfile.js') }}" type="text/javascript" defer></script>
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>

@endsection

@section('title', "$name->site_name | Update Profile")

@section('body')
    {{-- Start Profile Edit Section --}}
    <div class="body">

        <div class="editProfile absolute">
            <div class="headerEditProfile absolute ms-5 mt-5">
                <a href="{{ url('/') }}"><i class="fas fa-arrow-circle-left fs-1 me-4 text-light"></i></a>
                <a href="{{ url('/') }}"><img src="{{ url('img/logo.png') }}" /></a>
            </div>
            <div class="titleEditProfile absolute d-flex justify-content-center ">
                <p class="fw-bold">{{ __('messageZY.updateprofile') }}</p>
            </div>
            <div class="welcome absolute ">
                <p class="fw-bold">{{ __('messageZY.welcomfrom') }}</p>
                <p class="fw-bold foodLab">{{ __('messageZY.outfoodlab') }}</p>
            </div>
        </div>
        @if ($errors->any())
            <input type="text" value="1" id="error" class="hide">
        @else
            <input type="text" value="0" id="error" class="hide">
        @endif

        <div class="alertBox" id="alertBox">
            <i class="fas fa-arrow-circle-left fs-1 mt-3 ms-3 text-light" id="back"></i>
            <form action="{{ route('updateprofile.update', $user->cid) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="absolute d-flex flex-column justify-content-center alertUpdate">
                    @error('oldpassword')
                        <span class="errorIcon"><i
                                class="fas fa-exclamation-circle fs-3 mt-2 errorPassword text-danger"></i></span>
                    @enderror
                    <p class="InputTitle" id="old">{{ __('messageZY.oldpassword') }}</p>
                    <div class="d-flex  me-3 ms-3  infos">
                        <div class="InputParentAlert">
                            <input type="text" name="oldpassword" class="InputChild" autocomplete="off">

                        </div>
                    </div>
                    @error('newpassword')
                        <span class="errorIcon"><i
                                class="fas fa-exclamation-circle fs-3 mt-2 errorPassword text-danger"></i></span>
                    @enderror
                    <p class="InputTitle" id="new">{{ __('messageZY.newpassword') }}</p>
                    <div class="d-flex  me-3 ms-3  infos">

                        <div class="InputParentAlert">

                            <input type="text" name="newpassword" class="InputChild" autocomplete="off">
                        </div>
                    </div>
                    @error('confirmpassword')
                        <span class="errorIcon"><i
                                class="fas fa-exclamation-circle fs-3 mt-2 errorPassword text-danger"></i></span>
                    @enderror
                    <p class="InputTitle" id="confirm">{{ __('messageZY.confirmnewpassword') }}</p>
                    <div class="d-flex  me-3 ms-3  infos">
                        <div class="InputParentAlert">
                            <input type="text" name="confirmpassword" class="InputChild" autocomplete="off">

                        </div>
                    </div>

                </div>
                <button class="btn updateButtonAlert " id="updatePassword">{{ __('messageZY.updatepassword') }}</button>
            </form>
        </div>
        <div class="bodyEditProfile absolute">

            <div class="d-flex me-3 ms-3   infos">
                <i class="fas fa-user fs-3 me-4 mt-2 text-light"></i>
                <div class="InputParent">
                    <input type="text" name="username" id="username" class="InputChild" value="{{ $user->nickname }}"
                        disabled>
                </div>
            </div>
            <div class="d-flex  me-3 ms-3  infos">
                <i class="fas fa-phone-alt fs-3 me-4 mt-2 text-light"></i>
                <div class="InputParent">
                    <input type="number" name="phonenumber" id="phonenumber" class="InputChild"
                        value="{{ $user->phone }}" disabled>
                </div>
            </div>
            <div class="d-flex  me-3 ms-3  infos">
                <i class="fas fa-address-book fs-3 me-4 mt-2 text-light"></i>
                <div class="InputParent">
                    <input type="text" id="address" class="InputChild"
                        value="{{ $user->township_name }}/{{ $user->state_name }}/ ({{ $user->address3 }})"
                        disabled>
                </div>
            </div>
            <div class="d-flex  me-3 ms-3  infos">
                <i class="fas fa-envelope fs-3 me-4 mt-2 text-light"></i>
                <div class="InputParent">
                    <input type="text" name="email" id="email" class="InputChild" value="{{ $user->email }}"
                        disabled>
                </div>
            </div>
            <div class="d-flex  me-3   infos">

                <div class="InputParent">
                    <button class="btn updateButton me-5"
                        id="changePassword">{{ __('messageZY.changepassword') }}</button>
                </div>
            </div>

        </div>
    </div>

    {{-- End Profile Edit Section --}}
@endsection