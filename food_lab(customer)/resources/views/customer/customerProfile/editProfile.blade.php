@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customerEditProfile.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/bootstrap-tagsinput.css') }}" rel="stylesheet" type="text/css">

@endsection
@section('js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js" defer></script>
    <script src="{{ url('js/bootstrap-tagsinput.min.js') }}" defer></script>
    <script src="{{ url('js/adminProductTagsInput.js') }}" defer></script>
    <script src="{{ url('js/adminTypeAhead.js') }}" defer></script>
    <script src="{{ url('js/updateProfile.js') }}" type="text/javascript" defer></script>
    {{-- <script src="{{ url('js/customertags.js') }}" type="text/javascript" defer></script> --}}
    <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
@endsection
@section('title', " $name->site_name | Edit Profile")

@section('body')
    {{-- Start Profile Edit Section --}}
    <div class="body">

        {{-- <div class="headerEditProfile ms-5 mt-3">
            <a href="{{ url('/') }}"><i class="fas fa-arrow-circle-left fs-1 me-4 text-light" id="back"></i></a>
            <a href="{{ url('/') }}"><img src="{{ url('img/logo.png') }}" /></a>
        </div> --}}
        <div class="d-flex ps-5 py-4">
            <div class="me-4 mt-3">
                <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
            </div>
            <div>
                <img src="{{ $name->site_logo }}" width="50px" />
            </div>

        </div>
        {{-- edit profile --}}
        <h1 class=" fw-bold text-center titleEditProfile">{{ __('messageZY.editprofile') }}</h1>
        <p class=" fw-bold text-end  remaincoin">{{ __('messageZY.Remaincoin') }} <i
                class="coinCalInform fas fa-coins "></i>
            <span class="fs-5">{{ $remaincoin->remain_coin }}</span>
        </p>
        {{-- <p class="fw-bold  titleEditProfile">{{ __('messageZY.editprofile') }}</p> --}}
        <div id="editProfile">

            <form action="{{ route('editprofile.update', $user->cid) }}" method="POST"
                onkeydown="return event.key != 'Enter';">
                @csrf
                @method('PUT')
                <div class="bodyEditProfile d-flex flex-row justify-content-center">

                    <div class="d-flex me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-user fs-3 me-4 mt-2 iconColor"></i>
                        <div class="InputParent">
                            <input type="text" name="username" id="username" class="InputChild"
                                value="{{ $user->nickname }}" autocomplete="off">
                        </div>
                        @error('username')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>
                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-envelope fs-3 me-4 mt-2  iconColor"></i>
                        <div class="InputParent">
                            <input type="text" id="email" class="InputChild" value="{{ $user->email }}" readonly>
                        </div>
                        @error('email')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>

                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-address-book fs-3 me-4 mt-2  iconColor"></i>
                        <div class="InputParent">
                            <select name="state" id="addressState" class="InputChild selectBoxWidth">
                                @php
                                    $userState = $user->address1;
                                @endphp
                                @forelse($states as $state)
                                    @if ($userState == $state->id)
                                        <option value="{{ $state->id }}" class="text-dark" selected>
                                            {{ $state->state_name }}</option>
                                    @else
                                        <option value="{{ $state->id }}" class="text-dark">
                                            {{ $state->state_name }}
                                        </option>
                                    @endif
                                @empty
                                    <option>{{ __('messageZY.notstate') }} .</option>
                                @endforelse
                            </select>
                        </div>
                        @error('state')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>
                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">

                        <i class="fas fa-address-book fs-3 me-4 mt-2 iconColor "></i>
                        <div class="InputParent">
                            <select name="township" id="addressTownship" class="InputChild selectBoxWidth">
                                @php
                                    $userTownship = $user->address2;
                                @endphp
                                <input type="text" value="{{ $userTownship }}" class="hide" id="oldts">
                            </select>
                        </div>
                        @error('township')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>
                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-address-book fs-3 me-4 mt-2 iconColor "></i>
                        <div class="InputParent">
                            <input type="text" name="addressNumber" id="addressNumber" class="InputChild"
                                value="{{ $user->address3 }}" autocomplete="off">
                        </div>
                        @error('addressNumber')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>
                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-phone-alt fs-3 me-4 mt-2  iconColor"></i>
                        <div class="InputParent">
                            <input type="number" name="phonenumber" id="phonenumber" class="InputChild"
                                value="{{ $user->phone }}" autocomplete="off">
                        </div>
                        @error('phonenumber')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>


                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-utensils fs-3 me-4 mt-2 iconColor "></i>
                        <div class="InputParent">
                            <select name="Taste" id="Taste" class="InputChild selectBoxWidth">
                                @php
                                    $userTaste = $user->taste;
                                @endphp
                                @forelse($tastes as $taste)
                                    @if ($userTaste == $taste->id)
                                        <option value="{{ $taste->id }}" class="text-dark" selected>
                                            {{ $taste->taste }}</option>
                                    @else
                                        <option value="{{ $taste->id }}" class="text-dark">{{ $taste->taste }}
                                        </option>
                                    @endif
                                @empty
                                    <option>{{ __('messageZY.notaste') }} .</option>
                                @endforelse
                            </select>

                        </div>
                        @error('Taste')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>

                    {{-- <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-pen-square fs-3 me-4 mt-2 iconColor "></i>
                        <div class="InputParent">
                            <input type="text" name="bio" id="nickname" class="InputChild" value="{{ $user->bio }}"
                                autocomplete="off">

                        </div>
                        @error('bio')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div> --}}
                    <div class="d-flex  me-3 ms-3 mt-0 mb-1 infos">
                        <i class="fas fa-dizzy fs-3 me-4 mt-2 iconColor "></i>
                        <div class="InputParent">
                            <input type="text" name="Allergic" id="Allergic" class="InputChild"
                                value="{{ $user->allergic }}" autocomplete="off">
                        </div>
                        @error('Allergic')
                            <span class="errorIcon"><i
                                    class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                        @enderror
                    </div>
                    <div class="d-flex  me-3 ms-3 mt-0 mb-2 infos" id="favType">
                        <i class="fas fa-grin-hearts fs-3 me-4 mt-2  iconColor"></i>

                        @php
                            $favtypes = $user->fav_type;
                            $favArrays = explode(',', $favtypes);
                        @endphp
                        {{-- <div class="InputParent" id="favType2">
                            <select multiple data-role="tagsinput" name="favtype" id="favTypesInput">
                                @forelse ($favArrays as $favArray)
                                    <option value="{{ $favArray }}">{{ $favArray }}</option>
                                @empty
                                    <option disabled>No data</option>
                                @endforelse

                            </select>
                        </div> --}}
                        <div class="InputParent" id="favType2">
                            <input type="text" value="{{ $user->fav_type }}" name="favtype" id="favTypesInput"
                                data-role="tagsinput">
                        </div>
                    </div>


                    <div class="btnDiv">
                        <button class="btn updateButton" value="Update1">{{ __('messageZY.updateprofile') }}</button>
                        <button class="btn  changePassword" id="changePassword" value="Update2">
                            {{ __('messageZY.changepassword') }}

                        </button>
                    </div>
            </form>
        </div>


        {{-- Update Profile --}}




        {{-- to change password --}}
        @if ($errors->has('oldpassword') || $errors->has('newpassword') || $errors->has('confirmpassword'))
            <input type="text" value="1" id="error" class="hide">
        @else
            <input type="text" value="0" id="error" class="hide">
        @endif

        @if (session()->has('error'))
            <input type="text" value="1" id="error2" class="hide">
        @else
            <input type="text" value="0" id="error2" class="hide">
        @endif
        @if (session()->has('success'))
            <div class="passwordSuccess">
                {{ session()->get('success') }}
            </div>
        @endif

        <div class="alertBox" id="alertBox">


            <form action="{{ route('updateprofile.update', $user->cid) }}" method="POST">
                @csrf
                @method('PUT')



                <div class="absolute d-flex flex-column justify-content-center gap-5 alertUpdate">
                    {{-- <i class="fas fa-arrow-circle-left fs-1  text-light" id="backProfileAlert"></i> --}}
                    <div class="d-flex  me-3 ms-3  my-4 infos1">

                        <div class="InputParentAlert">
                            <p class="InputTitle  " id="old">{{ __('messageZY.oldpassword') }}</p>
                            <input type="text" name="oldpassword" class="InputChild1" autocomplete="off">
                            @if (session()->has('error'))
                                <span class="errorIcon"><i
                                        class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                            @endif
                            @error('oldpassword')
                                <span class="errorIcon"><i
                                        class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex  me-3 ms-3 my-4 infos1">

                        <div class="InputParentAlert">
                            <p class="InputTitle " id="new">{{ __('messageZY.newpassword') }}</p>
                            <input type="text" name="newpassword" class="InputChild1" autocomplete="off">
                            @error('newpassword')
                                <span class="errorIcon"><i
                                        class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex  me-3 ms-3  my-4 infos1">

                        <div class="InputParentAlert">
                            <p class="InputTitle " id="confirm">{{ __('messageZY.confirmnewpassword') }}</p>
                            <input type="text" name="confirmpassword" class="InputChild1" autocomplete="off">
                            @error('confirmpassword')
                                <span class="errorIcon"><i
                                        class="fas fa-exclamation-circle fs-3 ms-2 errorPassword text-danger"></i></span>
                            @enderror
                        </div>

                    </div>
                    <div class="d-flex flex-row ms-auto gap-3 me-4 justify-content-center infos2">

                        <button class="btn updateButtonAlert backbtn"
                            id="backUpdatePassword">{{ __('messageZY.toback') }}
                        </button>
                        <button class="btn updateButtonAlert fs-6"
                            id="updatePassword">{{ __('messageZY.updatepassword') }}</button>

                    </div>
                </div>



            </form>
        </div>
    </div>
    {{-- @if (session()->has('message'))
                <div class="alert alert-success alert-dismissible" role="alert">

                    {{ session()->get('message') }}
                </div>
            @endif --}}
    {{-- End Profile Edit Section --}}
@endsection
