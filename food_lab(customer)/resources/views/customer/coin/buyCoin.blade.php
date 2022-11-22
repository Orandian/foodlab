@extends('COMMON.layout.layout_customer')

@section('script')

    
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link href="{{ url('css/buyCoin.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('title')
    {{ $name->site_name }} | Buy Coin
@endsection

@section('header')
    <section>

        <div class="container">
            <div class="coinchargeformdiv">
                <h2 class="coincharge">{{ __('messageCPPK.Coin Charge') }}</h2>
                <form action="" id="coinchargeform" enctype="multipart/form-data">
                    @csrf
                    <div class="col-8 d-flex coininput">
                        <span class="col-7"><i class="coinCal fas fa-coins"></i>
                            {{ __('messageCPPK.Coin') }}</span>
                        <div id="coindiv"class="col-7">
                            <input type="number" id="coinChargeinput" name="coinput">
                           
                        </div>
                    </div>
                    <div class="col-8 d-flex choosephoto">
                        <span class="col-7 "><i class="fileUpload far fa-file-alt"></i>
                            {{ __('messageCPPK.Screenshot') }}</span>
                        <div id="imagediv" class="col-7">
                            <input class="fileuploadInput form-control" type="file" accept="image/*" id="formFile"
                                name="fileimage">
                           
                        </div>
                    </div>
                    <button type="buttton" id="reset"
                        class="cancelbtn btn btn-light">{{ __('messageCPPK.Reset') }}</button>
                    <button type="button" name="submit" id="submitbtn" class="submitbtn btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal5" disabled>{{ __('messageCPPK.Charge') }}</button>
               
            </div>
            <div class="coinrule">
                <h2 class="coinRule">{{ __('messageCPPK.Coin Rule') }}</h2>
                <ul class="coinList">
                    <li>1 coin equal <span id="coinratedata" class="coinratedata">{{ $coinrateData->rate }}</span>
                        Kyats
                    </li>
                    <li>This coin can be used only on this website</li>
                    <li>This coin cannot be transfered</li>
                </ul>
                <h2 class="coinRule">{{ __('messageCPPK.Payment Accounts') }}</h2>
                <ul class="coinList">
                    @forelse ($paymentAccount as $accounts)
                        <li>{{ $accounts->payment_name }} <span><i class="fas fa-arrow-right"></i></span>
                            {{ $accounts->account_name }}</li>
                    @empty
                    @endforelse
                </ul>
                <hr class="coinRulehr">
                <h2 class="coinCalculator">{{ __('messageCPPK.Coin Calculator') }}</h2>
                <div class="coinCaldiv">
                    <input type="number" name="" id="ccalcul" class="ccalcul" placeholder="Coin">
                    <span class="equalIcon">=</span>
                    <input type="number" name="" id="mmkcalcul" class="ccalcul" placeholder="MMK">
                </div>
            </div>
        </div>
        <br>


          {{-- start modal --}}
      <div id="modal5" class="modal fade"  data-bs-backdrop="static" data-bs-keyboard="false"
      tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
            <div class="modal-content">
              
                <p id="coins" class="m-5 text-dark "></p>
                
              <div class="modal-footer">
                <button type="button" class="btn backBtn" data-bs-dismiss="modal" >Cancel</button>
                <button type="submit" name="submit" class="btn chargeBtn" data-bs-toggle="modal" >Charge</button>
              </div>
            </div>
          </div>
        </div>
    </form>


    <div id="modal6" class="modal fade" role="dialog"  data-bs-backdrop="static" data-easein="bounceIn" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="col-sm-4 modal-dialog modal-dialog-centered " role="document">
          <div class="modal-content">
        
            <div class="icon-box mt-4">
                <div><i class="fa-solid fa-handshake text-muted icons"></i></div>
            </div>

            <div class="modal-body">
                <div class="request text-muted"><span><i class="fas fa-check-circle text-success mx-2"></i></span> Your Request has been received.
                    We will be in touch and contact you soon!
                </div>
            </div>
           
            <div class="d-flex justify-content-center m-3">
            <button type="button" id="backSite" class="btn btn-primary cancelbutton" data-bs-dismiss="modal" >Back to site</button>
              
            </div>
          </div>
        </div>
      </div>


      
{{-- end modal --}}
        <div class="copys">
            <p>Copyright &copy; {{ $name->site_name }}</p>
        </div>
    </section>

    
        <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//cdn.jsdelivr.net/velocity/1.1.0/velocity.min.js"></script>
    <script src="{{ url('js/buyCoin.js') }}" type="text/javascript" defer></script>
    
@endsection
