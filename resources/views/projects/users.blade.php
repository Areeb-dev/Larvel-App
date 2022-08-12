@foreach($project->users as $user)
    <tr>
        <th scope="row">
            <div class="media align-items-center">
                <div>
                    <img data-original-title="{{(!empty($user)?$user->name:'')}}" @if($user->avatar) src="{{asset('/storage/uploads/avatar/'.$user->avatar)}}" @else src="{{asset('assets/img/avatar/avatar-1.png')}}" @endif  class="avatar rounded-circle avatar-sm">
                </div>
                <div class="media-body ml-3">
                    <a class="name mb-0 h6 text-sm">{{ $user->name }}</a>
                    <br>
                    <a class="text-sm text-muted">{{ $user->email }}</a>
                </div>
            </div>
        </th>

        <th>
            <div class="col-auto">

                <a href="#!" class="action-item text-danger trigger--fire-modal-1 trigger--fire-modal-11" data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('project-user-delete-form-{{$user->id}}').submit();">
                    <i class="fas fa-trash-alt"></i>
                </a>
                {!! Form::open(['method' => 'DELETE', 'route' => ['project.user.destroy', [$project->id,$user->id]],'id'=>'project-user-delete-form-'.$user->id]) !!}
                {!! Form::close() !!}

            </div>
        </th>
    </tr>
@endforeach
