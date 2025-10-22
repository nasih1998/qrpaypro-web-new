@extends('user.layouts.master')

@push('css')

@endpush

@section('breadcrumb')
    @include('user.components.breadcrumb',['breadcrumbs' => [
        [
            'name'  => __("Dashboard"),
            'url'   => setRoute("user.dashboard"),
        ]
    ], 'active' => __(@$page_title)])
@endsection

@section('content')
<div class="body-wrapper">
    <div class="dashboard-area mt-10">
        <div class="dashboard-header-wrapper">
            <h3 class="title">{{__(@$page_title)}}</h3>
        </div>
    </div>
    <div class="row mb-30-none">
        <div class="col-xl-6 mb-30">
            <div class="dash-payment-item-wrapper">
                <div class="dash-payment-item active">
                    <div class="dash-payment-title-area">
                        <span class="dash-payment-badge">!</span>
                        <h5 class="title">{{ __(@$page_title) }}</h5>
                    </div>
                    <div class="dash-payment-body">
                        <form class="card-form" action="{{ setRoute('user.request.money.submit') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 form-group text-center">
                                    <div class="exchange-area">
                                        <code class="d-block text-center">
                                            <span>{{ __("Exchange Rate") }} <span class="exchange-rate">--</span></span>
                                        </code>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-12 col-lg-6 form-group paste-wrapper">
                                    <label>{{ __("Phone/Email") }} ({{ __("User") }})<span class="text--base">*</span></label>
                                    <div class="input-group">
                                        <input type="text" name="credentials" class="form--control checkUser" id="username" placeholder="{{ __('Enter Email/Phone') }}" value="{{ old('credentials') }}" />
                                    </div>
                                    <button type="button" class="paste-badge scan"  data-toggle="tooltip" title="Scan QR"><i class="fas fa-camera"></i></button>
                                    <label class="exist text-start"></label>
                                </div>

                                <div class="col-xxl-6 col-xl-12 col-lg-6 form-group">
                                    <label>{{ __("Amount") }}<span>*</span></label>
                                    <div class="input-group">
                                        <input type="text" class="form--control number-input" required placeholder="{{ __("Enter Request Amount") }}" name="request_amount" value="{{ old("request_amount") }}">
                                        <select class="form--control nice-select currency" name="currency">
                                            @foreach ($sender_wallets as  $wallet)
                                                <option value="{{ $wallet->currency->code}}"
                                                     data-rate="{{ $wallet->currency->rate }}"
                                                     data-sender-country-name="{{ $wallet->currency->name }}"
                                                     data-type="{{ $wallet->currency->type }}"
                                                     data-id="{{ $wallet->currency->id }}"
                                                     >{{ $wallet->currency->code}}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <code class="d-block mt-10 text-end text--warning balance-show">--</code>
                                </div>
                                <div class="col-xl-12 col-lg-12 form-group">
                                    @include('admin.components.form.textarea',[
                                        'label'         => __("Remarks")." (".__("Optional").")",
                                        'name'          => "remark",
                                        'placeholder'   => __("explain Trx"),
                                        'value'         => old("remark"),
                                    ])
                                </div>

                                <div class="col-xl-12 col-lg-12">
                                    <button type="submit" class="btn--base w-100 btn-loading transfer">{{ __("confirm") }} <i class="fas fa-paper-plane ms-1"></i></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 mb-30">
            <div class="dash-payment-item-wrapper">
                <div class="dash-payment-item active">
                    <div class="dash-payment-title-area">
                        <span class="dash-payment-badge">!</span>
                        <h5 class="title">{{__("Request Money Preview")}}</h5>
                    </div>
                    <div class="dash-payment-body">
                        <div class="preview-list-wrapper">
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-wallet"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Request Wallet") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="fw-bold sending-wallet">--</span>
                                </div>
                            </div>
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-coins"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Entered Amount") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="fw-bold request-amount">--</span>
                                </div>
                            </div>
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-battery-half"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Transfer Fee") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="fees-show">--</span>
                                </div>
                            </div>
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-receipt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Will Get") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="recipient-get">--</span>
                                </div>
                            </div>
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-money-check-alt"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{__("Total Payable")}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="last payable-total text-warning">--</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            {{-- limit section  --}}
            <div class="dash-payment-item-wrapper limit">
                <div class="dash-payment-item active">
                    <div class="dash-payment-title-area">
                        <span class="dash-payment-badge">!</span>
                        <h5 class="title">{{__("Limit Information")}}</h5>
                    </div>
                    <div class="dash-payment-body">
                        <div class="preview-list-wrapper">
                            <div class="preview-list-item">
                                <div class="preview-list-left">
                                    <div class="preview-list-user-wrapper">
                                        <div class="preview-list-user-icon">
                                            <i class="las la-wallet"></i>
                                        </div>
                                        <div class="preview-list-user-content">
                                            <span>{{ __("Transaction Limit") }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="preview-list-right">
                                    <span class="limit-show">--</span>
                                </div>
                            </div>
                            @if ($charges->daily_limit > 0)
                                <div class="preview-list-item">
                                    <div class="preview-list-left">
                                        <div class="preview-list-user-wrapper">
                                            <div class="preview-list-user-icon">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <div class="preview-list-user-content">
                                                <span>{{ __("Daily Limit") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list-right">
                                        <span class="limit-daily">--</span>
                                    </div>
                                </div>
                                <div class="preview-list-item">
                                    <div class="preview-list-left">
                                        <div class="preview-list-user-wrapper">
                                            <div class="preview-list-user-icon">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <div class="preview-list-user-content">
                                                <span>{{ __("Remaining Daily Limit") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list-right">
                                        <span class="daily-remaining">--</span>
                                    </div>
                                </div>
                            @endif
                            @if ($charges->monthly_limit > 0)
                                <div class="preview-list-item">
                                    <div class="preview-list-left">
                                        <div class="preview-list-user-wrapper">
                                            <div class="preview-list-user-icon">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <div class="preview-list-user-content">
                                                <span>{{ __("Monthly Limit") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list-right">
                                        <span class="limit-monthly">--</span>
                                    </div>
                                </div>
                                <div class="preview-list-item">
                                    <div class="preview-list-left">
                                        <div class="preview-list-user-wrapper">
                                            <div class="preview-list-user-icon">
                                                <i class="las la-wallet"></i>
                                            </div>
                                            <div class="preview-list-user-content">
                                                <span>{{ __("Remaining Monthly Limit") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="preview-list-right">
                                        <span class="monthly-remaining">--</span>
                                    </div>
                                </div>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-list-area mt-20">
        <div class="dashboard-header-wrapper">
            <h4 class="title ">{{__("request Money Log")}}</h4>
            <div class="dashboard-btn-wrapper">
                <div class="dashboard-btn mb-2">
                    <a href="{{  setRoute('user.request.money.log.list') }}" class="btn--base">{{__("View More")}}</a>
                </div>
            </div>
        </div>
        <div class="dashboard-list-wrapper">
            @include('user.components.transaction-log',compact("transactions"))
        </div>
    </div>
</div>
<div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
            <div class="modal-body text-center">
                <video id="preview" class="p-1 border" style="width:300px;"></video>
            </div>
            <div class="modal-footer justify-content-center">
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">{{ __("Close") }}</button>
            </div>
      </div>
    </div>
</div>
@endsection

@push('script')
<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script>
    // 'use strict'
    (function ($) {
        $('.scan').click(function(){
            var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
            scanner.addListener('scan',function(content){
                var route = '{{url('user/qr/scan/')}}'+'/'+content
                $.get(route, function( data ) {
                    if(data.error){
                        // alert(data.error)
                        throwMessage('error',[data.error]);
                    } else {
                        $("#username").val(data);
                        $("#username").focus()
                    }
                    $('#scanModal').modal('hide')
                });
            });

            Instascan.Camera.getCameras().then(function (cameras){
                if(cameras.length>0){
                    $('#scanModal').modal('show')
                        scanner.start(cameras[0]);
                } else{
                //    alert('No cameras found.');
                    throwMessage('error',["No camera found "]);
                }
            }).catch(function(e){
                // alert('No cameras found.');
                throwMessage('error',["No camera found "]);
            });
        });
        $('.checkUser').on('keyup',function(e){
            var url = '{{ route('user.request.money.check.exist') }}';
            var value = $(this).val();
            var token = '{{ csrf_token() }}';
            if ($(this).attr('name') == 'credentials') {
                var data = {credentials:value,_token:token}

            }
            $.post(url,data,function(response) {
                if(response.own){
                    if($('.exist').hasClass('text--success')){
                        $('.exist').removeClass('text--success');
                    }
                    $('.exist').addClass('text--danger').text(response.own);
                    $('.transfer').attr('disabled',true)
                    return false
                }
                if(response['data'] != null){
                    if($('.exist').hasClass('text--danger')){
                        $('.exist').removeClass('text--danger');
                    }
                    $('.exist').text(`Valid user for transaction.`).addClass('text--success');
                    $('.transfer').attr('disabled',false)
                } else {
                    if($('.exist').hasClass('text--success')){
                        $('.exist').removeClass('text--success');
                    }
                    $('.exist').text('User doesn\'t  exists.').addClass('text--danger');
                    $('.transfer').attr('disabled',true)
                    return false
                }

            });
        });
    })(jQuery);
</script>
<script>
        $(document).ready(function(){
            senderBalance();
            getLimit();
            getDailyMonthlyLimit();
            getFees();
            getExchangeRate();
            getPreview();
            get_remaining_limits();
        });
        $("input[name=request_amount]").keyup(function(){
            senderBalance();
            getFees();
            getExchangeRate();
            getPreview();
            get_remaining_limits();
        });
        $("select[name=currency]").change(function(){
            senderBalance();
            getLimit();
            getDailyMonthlyLimit();
            getFees();
            getExchangeRate();
            getPreview();
            get_remaining_limits();
        });
        function acceptVar() {
            var selectedVal             = $("select[name=currency] :selected");
            var currencyCode            = $("select[name=currency] :selected").val();
            var currencyRate            = $("select[name=currency] :selected").data('rate');
            var senderCurrencyType      = $("select[name=currency] :selected").data('type');
            var currencyMinAmount       = "{{getAmount($charges->min_limit)}}";
            var currencyMaxAmount       = "{{getAmount($charges->max_limit)}}";
            var currencyFixedCharge     = "{{getAmount($charges->fixed_charge)}}";
            var currencyPercentCharge   = "{{getAmount($charges->percent_charge)}}";
            var currencyDailyLimit      = "{{getAmount($charges->daily_limit)}}";
            var currencyMonthlyLimit      ="{{getAmount($charges->monthly_limit)}}";
            var defualCurrency          = "{{ get_default_currency_code() }}";
            var defualCurrencyRate      = "{{ get_default_currency_rate() }}";

            if(senderCurrencyType == "CRYPTO"){
                var senderPrecison = "{{ get_precision_from_admin()['crypto_precision_value'] }}";
            }else{
                var senderPrecison = "{{  get_precision_from_admin()['fiat_precision_value'] }}";
            }

            return {
                defualCurrency:defualCurrency,
                defualCurrencyRate:defualCurrencyRate,
                currencyCode:currencyCode,
                currencyRate:currencyRate,
                sPrecison:senderPrecison,
                currencyMinAmount:currencyMinAmount,
                currencyMaxAmount:currencyMaxAmount,
                currencyFixedCharge:currencyFixedCharge,
                currencyDailyLimit:currencyDailyLimit,
                currencyMonthlyLimit:currencyMonthlyLimit,
                currencyPercentCharge:currencyPercentCharge,
                selectedVal:selectedVal,

            };
        }
        function getLimit() {
            var currencyCode = acceptVar().currencyCode;
            var currencyRate = acceptVar().currencyRate;

            var min_limit = acceptVar().currencyMinAmount;
            var max_limit = acceptVar().currencyMaxAmount;

            if($.isNumeric(min_limit) || $.isNumeric(max_limit)) {
                var min_limit_calc = parseFloat(min_limit*currencyRate);
                var max_limit_clac = parseFloat(max_limit*currencyRate);
                $('.limit-show').html( min_limit_calc.toFixed(acceptVar().sPrecison) + " " + currencyCode + " - " + max_limit_clac.toFixed(acceptVar().sPrecison) + " " + currencyCode);
                return {
                    minLimit:min_limit_calc,
                    maxLimit:max_limit_clac,
                };
            }else {
                $('.limit-show').html("--");
                return {
                    minLimit:0,
                    maxLimit:0,
                };
            }
        }
        function getDailyMonthlyLimit(){
            var sender_currency = acceptVar().currencyCode;
            var sender_currency_rate = acceptVar().currencyRate;
            var daily_limit = acceptVar().currencyDailyLimit;
            var monthly_limit = acceptVar().currencyMonthlyLimit

            if($.isNumeric(daily_limit) && $.isNumeric(monthly_limit)) {
                if(daily_limit > 0 ){
                    var daily_limit_calc = parseFloat(daily_limit * sender_currency_rate).toFixed(acceptVar().sPrecison);
                    $('.limit-daily').html( daily_limit_calc + " " + sender_currency);
                }else{
                    $('.limit-daily').html("");
                }

                if(monthly_limit > 0 ){
                    var montly_limit_clac = parseFloat(monthly_limit * sender_currency_rate).toFixed(acceptVar().sPrecison);
                    $('.limit-monthly').html( montly_limit_clac + " " + sender_currency);

                }else{
                    $('.limit-monthly').html("");
                }

            }else {
                $('.limit-daily').html("--");
                $('.limit-monthly').html("--");
                return {
                    dailyLimit:0,
                    monthlyLimit:0,
                };
            }

        }
        function feesCalculation() {
            var currencyCode = acceptVar().currencyCode;
            var currencyRate = acceptVar().currencyRate;
            var sender_amount = $("input[name=request_amount]").val();
            (sender_amount == "" || isNaN(sender_amount)) ? (sender_amount = 0) : (sender_amount = sender_amount);

            var fixed_charge    = acceptVar().currencyFixedCharge;
            var percent_charge  = acceptVar().currencyPercentCharge;
            if ($.isNumeric(percent_charge) && $.isNumeric(fixed_charge) && $.isNumeric(sender_amount)) {
                // Process Calculation
                var fixed_charge_calc   = parseFloat(currencyRate * fixed_charge);
                var percent_charge_calc = (parseFloat(sender_amount) / 100) * parseFloat(percent_charge);
                var total_charge        = parseFloat(fixed_charge_calc) + parseFloat(percent_charge_calc);
                    total_charge        = parseFloat(total_charge);
                // return total_charge;
                return {
                    total: parseFloat(total_charge),
                    fixed: parseFloat(fixed_charge_calc),
                    percent: parseFloat(percent_charge),
                };
            } else {
                // return "--";
                return false;
            }
        }
        function getFees() {
            var currencyCode = acceptVar().currencyCode;
            var percent = acceptVar().currencyPercentCharge;
            var charges = feesCalculation();
            if (charges == false) {
                return false;
            }
            $(".fees-show").html( parseFloat(charges.fixed).toFixed(acceptVar().sPrecison) + " " + currencyCode + " + " + parseFloat(percent).toFixed(acceptVar().sPrecison) + "%  = "+ parseFloat(charges.total).toFixed(acceptVar().sPrecison)+ " "+ currencyCode);
        }
        function getPreview() {
            var senderAmount = $("input[name=request_amount]").val();
            var sender_currency = acceptVar().currencyCode;
            var sender_currency_rate = acceptVar().currencyRate;
            (senderAmount == "" || isNaN(senderAmount)) ? senderAmount = 0 : senderAmount = senderAmount;
            // Sending Amount
            $('.request-amount').text(parseFloat(senderAmount).toFixed(acceptVar().sPrecison) + " " + sender_currency);

            $(".sending-wallet").text(sender_currency + " (" + acceptVar().selectedVal.data('sender-country-name') + ")");
            // Fees
            var charges = feesCalculation();
            var total_charge = 0;
            if(senderAmount == 0){
                total_charge = parseFloat(0).toFixed(acceptVar().sPrecison);
            }else{
                total_charge = charges.total;
            }

            $('.fees').text(total_charge + " " + sender_currency);
            // // recipient received
            var recipient = parseFloat(senderAmount)
            var recipient_get = 0;
            if(senderAmount == 0){
                    recipient_get = 0;
            }else{
                    recipient_get =  parseFloat(recipient);
            }
            $('.recipient-get').text(parseFloat(recipient_get).toFixed(acceptVar().sPrecison) + " " + sender_currency);

                // Pay In Total
            var totalPay = parseFloat(senderAmount)
            var pay_in_total = 0;
            if(senderAmount == 0){
                    pay_in_total = 0;
            }else{
                    pay_in_total =  parseFloat(totalPay) + parseFloat(charges.total);
            }
            $('.payable-total').text(parseFloat(pay_in_total).toFixed(acceptVar().sPrecison) + " " + sender_currency);

        }
        function senderBalance() {
            var senderCurrency = acceptVar().currencyCode;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'POST',
                url: "{{ route('user.wallets.balance') }}",
                data: {
                    target: senderCurrency,
                    _token: csrfToken
                },
                success: function(response) {
                    $('.balance-show').html("{{ __('Available Balance') }}: " + parseFloat(response.data).toFixed(acceptVar().sPrecison) + " " + senderCurrency);
                }
            });
        }
        function getExchangeRate(){
            var sender_currency = acceptVar().currencyCode;
            var sender_currency_rate = acceptVar().currencyRate;

            var default_currency = acceptVar().defualCurrency;
            var default_currency_rate = acceptVar().defualCurrencyRate;

            var rate = parseFloat(default_currency_rate) * parseFloat(sender_currency_rate);
            $('.exchange-rate').html("1 " + default_currency + " = " + parseFloat(rate).toFixed(acceptVar().sPrecison) + " " + sender_currency);

            return rate;
        }
        function get_remaining_limits(){
            var csrfToken           = $('meta[name="csrf-token"]').attr('content');
            var user_field          = "user_id";
            var user_id             = "{{ userGuard()['user']->id }}";
            var transaction_type    = "{{ payment_gateway_const()::REQUESTMONEY }}";
            var currency_id         = acceptVar().selectedVal.data('id');
            var sender_amount       = $("input[name=request_amount]").val();

            (sender_amount == "" || isNaN(sender_amount)) ? sender_amount = 0 : sender_amount = sender_amount;

            var charge_id           = "{{ $charges->id }}";
            var attribute           = "{{ payment_gateway_const()::SEND }}"

            $.ajax({
                type: 'POST',
                url: "{{ route('global.get.total.transactions') }}",
                data: {
                    _token:             csrfToken,
                    user_field:         user_field,
                    user_id:            user_id,
                    transaction_type:   transaction_type,
                    currency_id:        currency_id,
                    sender_amount:      sender_amount,
                    charge_id:          charge_id,
                    attribute:          attribute,
                },
                success: function(response) {
                    var sender_currency = acceptVar().currencyCode;

                    var status  = response.status;
                    var message = response.message;
                    var amount_data = response.data;

                    if(status == false){
                        $('.transfer').attr('disabled',true);
                        $('.daily-remaining').html(amount_data.remainingDailyTxnSelected + " " + sender_currency);
                        $('.monthly-remaining').html(amount_data.remainingMonthlyTxnSelected + " " + sender_currency);
                        throwMessage('error',[message]);
                        return false;
                    }else{
                        $('.transfer').attr('disabled',false);
                        $('.daily-remaining').html(amount_data.remainingDailyTxnSelected + " " + sender_currency);
                        $('.monthly-remaining').html(amount_data.remainingMonthlyTxnSelected + " " + sender_currency);
                    }
                },
            });
        }

</script>

@endpush
