@extends('layouts.admin')
@push('script-page')
@endpush
@section('page-title')
    {{__('Contract')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Contract')}}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Contract')}}</li>
@endsection





@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
            <a href="{{ route('contract.index') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
                <span class="btn-inner--icon">{{__('List View')}}</span>
            </a>
        </div>


        @if(\Auth::user()->type=='company')

            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('contract.create') }}" data-ajax-popup="true" data-title="{{__('Create New Contract')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> {{__('Create')}} </a>
            </div>
        @endif

    </div>
@endsection


@section('filter')
@endsection
@section('content')
    <div class="row">
        @foreach ($contracts as $contract)
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-0">{{ $contract->subject}}</h6>
                            </div>
                            @if(\Auth::user()->type=='company')
                                <div class="text-right">
                                    <div class="actions">
                                        <div class="dropdown action-item">
                                            <a href="#" class="action-item" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a href="#" data-url="{{ route('contract.edit',$contract->id) }}" data-ajax-popup="true" data-title="{{__('Edit Contract')}}" class="dropdown-item" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                                    {{__('Edit')}}
                                                </a>
                                                <a href="#!" class="dropdown-item" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$contract->id}}').submit();">
                                                    {{__('Delete')}}
                                                </a>
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body py-3 flex-grow-1">

                        <p class="text-sm mb-0">
                            {{ $contract->description}}
                        </p>
                    </div>
                    <div class="card-footer py-0">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">{{__('Contract Type')}}:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge badge-secondary badge-pill">{{ !empty($contract->types)?$contract->types->name:'' }}</span>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="form-control-label">{{__('Contract Value')}}:</span>
                                    </div>
                                    <div class="col-6 text-right">
                                        <span class="badge badge-secondary badge-pill">{{ \Auth::user()->priceFormat($contract->value) }}</span>
                                    </div>
                                </div>
                            </li>
                            @if(\Auth::user()->type!='client')
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center">
                                        <div class="col-6">
                                            <span class="form-control-label">{{__('Client')}}:</span>
                                        </div>
                                        <div class="col-6 text-right">
                                            {{ !empty($contract->clients)?$contract->clients->name:'' }}
                                        </div>
                                    </div>
                                </li>
                            @endif
                            <li class="list-group-item px-0">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <small>{{__('Start Date')}}:</small>
                                        <div class="h6 mb-0">{{  \Auth::user()->dateFormat($contract->start_date )}}</div>
                                    </div>
                                    <div class="col-6">
                                        <small>{{__('End Date')}}:</small>
                                        <div class="h6 mb-0">{{  \Auth::user()->dateFormat($contract->end_date )}}</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection

