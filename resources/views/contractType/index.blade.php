@extends('layouts.admin')
@push('script-page')
@endpush
@section('page-title')
    {{__('Contract Type')}}
@endsection
@section('title')
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Contract Type')}}</h5>
    </div>
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('dashboard')}}">{{__('Dashboard')}}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Constant')}}</li>
    <li class="breadcrumb-item active" aria-current="page">{{__('Contract Type')}}</li>
@endsection




@section('action-button')
    <div class="all-button-box row d-flex justify-content-end">
        @can('create label')
            <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
                <a href="#" data-url="{{ route('contractType.create') }}" data-ajax-popup="true" data-title="{{__('Create New Contract Type')}}" class="btn btn-xs btn-white btn-icon-only width-auto"><i class="fas fa-plus"></i> {{__('Create')}} </a>
            </div>
        @endcan
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
                    <th scope="col">{{__('Name')}}</th>
                    @if(\Auth::user()->type=='company')
                        <th scope="col" class="">{{__('Action')}}</th>
                    @endif
                </tr>
                </thead>
                <tbody class="list">
                @foreach ($types as $type)
                    <tr class="font-style">
                        <td>{{ $type->name }}</td>
                        @if(\Auth::user()->type=='company')
                            <td class="">
                                <a href="#" data-url="{{ route('contractType.edit',$type->id) }}" data-ajax-popup="true" data-title="{{__('Edit Contract Type')}}" class="edit-icon" data-toggle="tooltip" data-original-title="{{__('Edit')}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="#!" class="delete-icon" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$type->id}}').submit();">
                                    <i class="fas fa-trash"></i>
                                </a>
                                {!! Form::open(['method' => 'DELETE', 'route' => ['contractType.destroy', $type->id],'id'=>'delete-form-'.$type->id]) !!}
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

