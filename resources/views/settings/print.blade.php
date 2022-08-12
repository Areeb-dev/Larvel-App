@extends('layouts.admin')
@section('page-title')
    {{__('Settings')}}
@endsection
@php
    $logo=asset(Storage::url('uploads/logo/'));
    $company_logo=Utility::getValByName('company_logo');
    $company_favicon=Utility::getValByName('company_favicon');
 $lang=\App\Utility::getValByName('default_language');
@endphp
@push('script-page')
    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '{{url('/invoices/preview')}}/' + template + '/' + color);
        });

        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '{{url('/proposal/preview')}}/' + template + '/' + color);
        });

        $(document).on("change", "select[name='bill_template'], input[name='bill_color']", function () {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '{{url('/bill/preview')}}/' + template + '/' + color);
        });
    </script>
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <section class="nav-tabs">
                <div class="col-lg-12 our-system">
                    <div class="row">
                        <ul class="nav nav-tabs my-4">
                            <li class="">
                                <a data-toggle="tab" href="#proposal-template-setting" class="active">{{__('Proposal Print Setting')}} </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#invoice-template-setting" class="">{{__('Invoice Print Setting')}} </a>
                            </li>
                            <li class="annual-billing">
                                <a data-toggle="tab" href="#bill-template-setting" class="">{{__('Bill Print Setting')}} </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="proposal-template-setting" class="tab-pane in active">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Proposal Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">{{__('Proposal Template')}}</label>
                                                    <select class="form-control select2" name="proposal_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['proposal_template']) && $settings['proposal_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="proposal_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['proposal_color']) && $settings['proposal_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['proposal_template']) && isset($settings['proposal_color']))
                                                <iframe id="proposal_frame" class="w-100 h-1300" frameborder="0" src="{{route('proposal.preview',[$settings['proposal_template'],$settings['proposal_color']])}}"></iframe>
                                            @else
                                                <iframe id="proposal_frame" class="w-100 h-1300" frameborder="0" src="{{route('proposal.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div id="invoice-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Invoice Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">{{__('Invoice Template')}}</label>
                                                    <select class="form-control select2" name="invoice_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['invoice_template']) && $settings['invoice_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label form-control-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="invoice_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['invoice_color']) && $settings['invoice_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['invoice_template']) && isset($settings['invoice_color']))
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="{{route('invoice.preview',[$settings['invoice_template'],$settings['invoice_color']])}}"></iframe>
                                            @else
                                                <iframe id="invoice_frame" class="w-100 h-1450" frameborder="0" src="{{route('invoice.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div id="bill-template-setting" class="tab-pane">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                <h4 class="h4 font-weight-400 float-left pb-2">{{__('Bill Print Settings')}}</h4>
                            </div>
                        </div>
                        <div class="card">
                            <form id="setting-form" method="post" action="{{route('proposal.template.setting')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <form id="setting-form" method="post" action="{{route('bill.template.setting')}}">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label ">{{__('Bill Template')}}</label>
                                                    <select class="form-control select2" name="bill_template">
                                                        @foreach(Utility::templateData()['templates'] as $key => $template)
                                                            <option value="{{$key}}" {{(isset($settings['bill_template']) && $settings['bill_template'] == $key) ? 'selected' : ''}}>{{$template}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group form-control-label">
                                                    <label class="form-label">{{__('Color Input')}}</label>
                                                    <div class="row gutters-xs">
                                                        @foreach(Utility::templateData()['colors'] as $key => $color)
                                                            <div class="col-auto">
                                                                <label class="colorinput">
                                                                    <input name="bill_color" type="radio" value="{{$color}}" class="colorinput-input" {{(isset($settings['bill_color']) && $settings['bill_color'] == $color) ? 'checked' : ''}}>
                                                                    <span class="colorinput-color" style="background: #{{$color}}"></span>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <button class="btn btn-sm btn-primary rounded-pill">
                                                    {{__('Save')}}
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-10">
                                            @if(isset($settings['bill_template']) && isset($settings['bill_color']))
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="{{route('bill.preview',[$settings['bill_template'],$settings['bill_color']])}}"></iframe>
                                            @else
                                                <iframe id="bill_frame" class="w-100 h-1450" frameborder="0" src="{{route('bill.preview',['template1','fffff'])}}"></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <!-- <div id="payment-setting" class="tab-pane">

                        <div class="col-md-12">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-md-6 col-sm-6 mb-3 mb-md-0">
                                    <h4 class="h4 font-weight-400 float-left pb-2">{{__('Payment settings')}}</h4>
                                </div>
                            </div>
                            <div class="card bg-none company-setting">
                                {{Form::model($settings,['route'=>'company.payment.settings', 'method'=>'POST'])}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <small>{{__("This detail will use for collect payment on invoice from clients. On invoice client will find out pay now button based on your below configuration.")}}</small>
                                    </div>
                                    <div class="col-6 py-2">
                                        <h5 class="h5">{{__('Stripe')}}</h5>
                                    </div>
                                    <div class="col-6 py-2 text-right">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_stripe" id="enable_stripe" {{ isset($settings['enable_stripe']) && $settings['enable_stripe'] == 'on' ? 'checked="checked"' : '' }}>
                                            <label class="custom-control-label form-control-label" for="enable_stripe">{{__('Enable Stripe')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{Form::label('stripe_key',__('Stripe Key'),array('class'=>'form-control-label')) }}
                                            {{Form::text('stripe_key',(isset($settings['stripe_key'])?$settings['stripe_key']:''),['class'=>'form-control','placeholder'=>__('Enter Stripe Key')])}}
                                            @error('stripe_key')
                                            <span class="invalid-stripe_key" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                         </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{Form::label('stripe_secret',__('Stripe Secret'),array('class'=>'form-control-label')) }}
                                            {{Form::text('stripe_secret',(isset($settings['stripe_secret'])?$settings['stripe_secret']:''),['class'=>'form-control ','placeholder'=>__('Enter Stripe Secret')])}}
                                            @error('stripe_secret')
                                            <span class="invalid-stripe_secret" role="alert">
                                             <strong class="text-danger">{{ $message }}</strong>
                                         </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <hr>
                                    </div>
                                    <div class="col-6 py-2">
                                        <h5 class="h5">{{__('PayPal')}}</h5>
                                    </div>
                                    <div class="col-6 py-2 text-right">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" name="enable_paypal" id="enable_paypal" {{  isset($settings['enable_paypal']) && $settings['enable_paypal'] == 'on' ? 'checked="checked"' : '' }}>
                                            <label class="custom-control-label form-control-label" for="enable_paypal">{{__('Enable Paypal')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 pb-4">
                                        <label class="paypal-label form-control-label" for="paypal_mode">{{__('Paypal Mode')}}</label> <br>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-primary btn-sm {{ isset($settings['paypal_mode']) &&  $settings['paypal_mode'] == '' || isset($settings['paypal_mode']) && $settings['paypal_mode'] == 'sandbox' ? 'active' : '' }}">
                                                <input type="radio" name="paypal_mode" value="sandbox">{{__('Sandbox')}}
                                            </label>
                                            <label class="btn btn-primary btn-sm {{ isset($settings['paypal_mode']) &&  $settings['paypal_mode'] == 'live' ? 'active' : '' }}">
                                                <input type="radio" name="paypal_mode" value="live">{{__('Live')}}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paypal_client_id">{{ __('Client ID') }}</label>
                                            <input type="text" name="paypal_client_id" id="paypal_client_id" class="form-control" value="{{isset($settings['paypal_client_id'])?$settings['paypal_client_id']:''}}" placeholder="{{ __('Client ID') }}"/>
                                            @if ($errors->has('paypal_client_id'))
                                                <span class="invalid-feedback d-block">
                                            {{ $errors->first('paypal_client_id') }}
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="paypal_secret_key">{{ __('Secret Key') }}</label>
                                            <input type="text" name="paypal_secret_key" id="paypal_secret_key" class="form-control" value="{{isset($settings['paypal_secret_key'])?$settings['paypal_secret_key']:''}}" placeholder="{{ __('Secret Key') }}"/>
                                            @if ($errors->has('paypal_secret_key'))
                                                <span class="invalid-feedback d-block">
                                            {{ $errors->first('paypal_secret_key') }}
                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12  text-right">
                                    <input type="submit" value="{{__('Save Changes')}}" class="btn-submit text-white">
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div> -->
                </div>
            </section>
        </div>
    </div>
@endsection
