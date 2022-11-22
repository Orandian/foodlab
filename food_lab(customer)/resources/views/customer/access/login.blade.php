@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
        {{-- custom css 2 --}}
        <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{ url('js/customerLogin.js') }}" type="text/javascript" defer></script>
@endsection

@section('title',"$name->site_name | Sign In")

@section('body')
    {{-- Start Login Section--}}
    <section class="login">
        <div class="d-flex ps-5 py-4">
            <div class="me-4 mt-3">
                <a href="/"><i class="fas fa-arrow-left text-white arrows"></i></a>
            </div>
            <div>
                <img src="{{ $name->site_logo }}" width="50px"/>
            </div>
        </div>

        {{-- start register header --}}
        <div class="d-flex ms-5 register-headers">
            {{-- <div class="welcome-registers">
                <p class="text-center creates">{{ __('messageMK.welcomeFrom') }} <span class="d-block ms-5 ps-5">{{ __('messageMK.ourFoodLab') }}</span></p>
            </div> --}}
            <div>
                <p class="fw-bolder pb-3 creates">{{ __('messageMK.signinForm') }}</p>
            </div>
        </div>
        {{-- end register header --}}

        {{-- start register form --}}
        <div class="d-flex register-forms">
            <div  class="access-imgs">
                <img src="{{ url('img/menu4.png') }}" />
            </div>
            <form action="/login" method="post" class="d-flex flex-column align-items-center justify-content-center">
                @csrf
                <div class="inputs">
                    <input type="email" id="email" class="form-inputs" name="email" placeholder="{{ __('messageMK.email') }}" value="{{ old('email') }}"maxlength="128" autocomplete="off"/>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputs">
                    <div class="passwords">
                        <input type="password" id="password" class="form-inputs" name="password" placeholder="{{ __('messageMK.password') }}" value="{{ old('password') }}" maxlength="30" autocomplete="off"/>
                        <i class="fas fa-eye-slash pwd-eye-slash"></i>
                        <i class="far fa-eye pwd-eye"></i>
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="inputs">
                    <input type="submit" class="form-control text-center createAccs" value="{{ __('messageMK.signIn') }}"/>
                </div>
                <div class="py-2 have-accs">
                    <p>{{ __('messageMK.Ifyoudoesn\'thaveAnyaccount') }} ? <br><a href="/signup" class="ms-2 text-decoration-underline">{{ __('messageMK.signUpHere') }}</a></p>
                </div>
            </form>
        </div>
        {{-- end register form --}}
    </section>
    {{-- End Login Section--}}
    <div class="copys">
        <p>Copyright &copy; {{ $name->site_name }}</p>
    </div>
@endsection
