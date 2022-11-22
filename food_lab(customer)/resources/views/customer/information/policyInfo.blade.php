@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('title', "$name->site_name | Policy Info")

@section('body')
    {{-- Start Policy Section --}}
    <section class="policys">
        <div class="d-flex ps-5 py-4">
            <div class="me-4 mt-3">
                <a href="/home"><i class="fas fa-arrow-left text-white arrows"></i></a>
            </div>
            <div>
                <img src="{{ $name->site_logo }}" width="50px"/>
            </div>
        </div>

        <div class="text-white fw-bolder policy-infos">
            <p class="policyheaders">{{ __('messageMK.policyInfo') }}</p>
            <div>
                <p>{{ $policys->privacy_policy }}</p>
            </div>
        </div>
    </section>
@endsection
