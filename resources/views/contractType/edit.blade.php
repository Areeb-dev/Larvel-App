<div class="card bg-none card-box">

{{ Form::model($contractType, array('route' => array('contractType.update', $contractType->id), 'method' => 'PUT')) }}
<div class="form-group">
    {{ Form::label('name', __('Name')) }}
    {{ Form::text('name', null, array('class' => 'form-control','required'=>'required')) }}
</div>
<div class="col-12 text-right">
    <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
    <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
</div>

{{ Form::close() }}
</div>
