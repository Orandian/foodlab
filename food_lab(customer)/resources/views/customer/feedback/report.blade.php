@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link href="{{ url('css/commonCustomer.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('css/customer.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title',"$name->site_name | Report")

@section('body')
    {{-- Start Report Form Section --}}
    <section class="forms">
        <div class="d-flex ps-5 py-4">
            <div class="me-4 mt-3">
                <a href="/home"><i class="fas fa-arrow-left text-white arrows"></i></a>
            </div>
            <div>
                <img src="{{ $name->site_logo }}" width="50px"/>
            </div>
        </div>

        <div class="d-flex flex-column justify-content-center align-items-center reports">
            <p class="fw-bolder form-headers">{{ __('messageMK.reportForm') }}</p>
            <form action="/report" method="post">
                @csrf
                <div class="d-flex mb-5 errors">
                    <label class="fw-bold">{{ __('messageMK.reportOrder') }}</label>
                    <select class="form-select" aria-label="Default select example" name='order'>
                        <option selected disabled>Open this select menu</option>
                        @foreach ($orderlists as $orderlist)
                            <option value="{{ $orderlist->id }}">#{{ $orderlist->id }} {{ $orderlist->order_date }} {{  $orderlist->order_time }}</option>
                        @endforeach
                    </select>
                    @error('order')
                        <span class="fw-bloder text-danger error-spans">Plesae Choose one</span>
                    @enderror
                </div>
                <div class="d-flex mb-5 errors">
                    <label class="fw-bold" id="details">{{ __('messageMK.reportDetails') }}</label>
                    <textarea class="form-control" id="details" name="message"></textarea>
                    @error('message')
                        <span class="fw-bolder text-danger error-spans">{{ $message }}</span>
                    @enderror
                </div>
                <div class="float-end">
                    <button type="submit" class="btn me-5">{{ __('messageMK.report') }}</button>
                </div>
            </form>
        </div>
    </section>
    {{-- End Report Form Section --}}
@endsection
