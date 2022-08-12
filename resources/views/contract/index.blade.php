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
        <a href="{{ route('contract.grid') }}" class="btn btn-xs btn-white btn-icon-only width-auto">
            <span class="btn-inner--icon">{{__('Grid View')}}</span>
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
    <div class="card">
        <div class="table-responsive">
            <table class="table align-items-center dataTable">
                <thead>
                <tr>
                    <th scope="col">{{__('Subject')}}</th>
                    @if(\Auth::user()->type!='client')
                        <th scope="col">{{__('Client')}}</th>
                    @endif
                    <th scope="col">{{__('Contract Type')}}</th>
                    <th scope="col">{{__('Contract Value')}}</th>
                    <th scope="col">{{__('Start Date')}}</th>
                    <th scope="col">{{__('End Date')}}</th>
                    <th scope="col">{{__('Description')}}</th>
                    @if(\Auth::user()->type=='company')
                        <th scope="col" class="text-right">{{__('Action')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody class="list">
                @foreach ($contracts as $contract)

                    <tr class="font-style">
                        <td>{{ $contract->subject}}</td>
                        @if(\Auth::user()->type!='client')
                            <td>{{ !empty($contract->clients)?$contract->clients->name:'' }}</td>
                        @endif
                        <td>{{ !empty($contract->types)?$contract->types->name:'' }}</td>
                        <td>{{ \Auth::user()->priceFormat($contract->value) }}</td>
                        <td>{{  \Auth::user()->dateFormat($contract->start_date )}}</td>
                        <td>{{  \Auth::user()->dateFormat($contract->end_date )}}</td>
                        <td>
                            <a href="#" class="action-item" data-url="{{ route('contract.description',$contract->id) }}" data-ajax-popup="true" data-toggle="tooltip" data-title="{{__('Desciption')}}"><i class="fa fa-comment"></i></a>
                        </td>
                        @if(\Auth::user()->type=='company')
                            <td class="action text-right">
                                <a href="#" data-url="{{ route('contract.edit',$contract->id) }}" data-ajax-popup="true" data-title="{{__('Edit Contract')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#!" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$contract->id}}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['contract.destroy', $contract->id],'id'=>'delete-form-'.$contract->id]) !!}
                                {!! Form::close() !!}
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

