@extends('COMMON.layout.layout_cusotmer_2')

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"  href= "css/customerDeliveryInfo.css"/>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/customerDeliveryInfo.js" type="text/javascript" defer></script>
    <script src="{{ url('js/customer.js') }}" type="text/javascript" defer></script>
@endsection

@section('title', "$name->site_name | deliveryInfo")

@section('body')
<section>
    <p class="fs-1 text-white fw-bold text-uppercase text-center pt-4"><img src="{{ $name->site_logo }}" class="me-4" width="50px" alt="Logo">{{ $name->site_name }}</p>
    <div class="d-flex ps-5 py-4">
        <div class="me-4">
            <a href="/cart"><i class="fas fa-arrow-left text-white arrows"></i></a>
        </div>
        <div>
            <h1 class="fw-bold heading">{{ __('messageCPPK.Delivery Information') }}</h1>
        </div>
    </div>

    <div class="d-flex flex-column justify-content-center align-items-center">
        <form action="" class="py-3 formDisplay" method="post">
            @csrf
            <div class="d-flex mb-4 forms">
                <div class="text-center labels">
                    <label class="fw-bold" id="details">{{ __('messageCPPK.Name') }}</label>
                </div>
                <div class="inputs">
                    <input type="text" name='username' class="controlForm" value="{{$deliInfo->nickname }}" disabled/>
                </div>
            </div>
            <div class="d-flex mb-4 forms">
                <div class="text-center labels">
                    <label class="fw-bold"id="details">{{ __('messageCPPK.Phone') }}</label>
                </div>
                <div class="inputs">
                    <input type="text" name="phone" class="controlForm phone" id="phone" value="{{$deliInfo->phone }}" required/>
                </div>
            </div>
            <div class="d-flex mb-4 forms">
                <div class="text-center labels">
                    <label class="fw-bold" id="details">{{ __('messageCPPK.Address') }}</label>
                </div>
                <div class="inputs">
                    <textarea class="controlForm" disabled>{{ $deliInfo->address3}} , {{ $deliInfo->township_name }} , {{ $deliInfo->state_name }}</textarea>

                    <p class="fs-6 text-start text-danger">click this button to change name and address.
                        <a href="/editprofile" class="btn btn-warning btn-sm"> User Profile</a></a>
                    </p>

                </div>
            </div>
            <div class="d-flex mb-4 forms">
                <div class="text-center labels">
                    <label class="fw-bold" id="details">{{ __('messageCPPK.Payment') }}</label>
                </div>
                <div class="d-flex justify-content-around align-items-center inputs">
                    <div>
                        <input type="radio" id="coin" class="me-3 vouncher" name="money" value="0" checked/>
                        <label for="coin" class="text-white moneys cursor">{{ __('messageCPPK.Coin') }}</label>
                    </div>
                    <div>
                        <input type="radio" id="cash" class="me-3 vouncher" name="money" value="1"/>
                        <label for="cash" class="text-white moneys cursor">{{ __('messageCPPK.Cash') }}</label>
                    </div>
                </div>
            </div>
            <div class="d-flex mb-4 forms">
                <div class="text-center labels">
                </div>
                <div class="d-flex justify-content-center align-items-center inputs">
                    <div class="text-center amount coin">
                        <p class="moneys">{{ $grandCoin }}</p>
                    </div>
                    <div class="text-center amount cash hide">
                        <p class="moneys"><span class="prices">{{ $grandCash }}</span> Ks</p>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center forms">
                <div>
                    <input type="button" data-bs-toggle="modal" data-bs-target="#modal1" class="order" value="{{ __('messageCPPK.Order') }}">
                </div>
            </div>
        </form>
        {{-- start modal --}}
        <div class="modal" id="modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <a href="/"><button type="button" class="btn-close"></button></a>
                    </div>
                    <div class="modal-body">
                        <p class="mx-4"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>{{ __('messageMK.orderComplete') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/"> <button type="button" class="btn btnCart confirms" >{{ __('messageMK.ok') }}</button></a>
                    </div>
                </div>
            </div>
        </div>
        {{-- end modal --}}
        {{--start order confirm moadal--}}
        <div class="modal" id="modal1" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5 class="modal-title"> <span><i class="fas fa-check-circle text-success mx-2"></i></span>{{ __('messageMK.confirm') }}</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn no_orders" data-bs-dismiss="modal">{{ __('messageMK.no') }}</button>
                        <button type="button" class="btn confirms order-confirms">{{ __('messageMK.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
        {{--start order confirm  moadal--}}

        {{--start no enough moadal--}}
        <div class="modal" id="modal2" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('messageMK.notEnough') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>{{ __('messageMK.moreCoin') }}</p>
                    </div>
                    <div class="modal-footer">
                        <a href="/buycoin"><button type="button" class="btn confirms ">{{ __('messageMK.ok') }}</button></a>
                    </div>
                </div>
            </div>
        </div>
        {{--start no enough moadal--}}

    </div>
   </section>
@endsection

