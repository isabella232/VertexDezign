@extends('layout/backend')
@section('content')
    <div class="pad">
        <h2>Project management</h2>
        <a href="{{ route('add_project') }}"><button class="btn blue" style="float:right;position:relative;" >Create new</button></a>
        <table class="tbl">
            <thead>
            <tr>
                <th style="text-align:center;"><input type="checkbox" /></th>
                <th>Title</th>
                <th>Author</th>
                <th>Last updated at</th>
                <th>Posted on</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($entry as $project)
                <tr>
                    <td style="text-align:center;"><input type="checkbox" /></td>
                    <td>{{$project->title}}</td>
                    <?php echo '<td>' . Auth::user()->find($project->user_id)->username . '</td>' ?>
                    <td>{{$project->updated_at}}</td>
                    <td>{{$project->created_at}}</td>
                    <td>
                        <a href="{{ URL::route('edit_project', $project->id) }}"><button class="btn blue"><img src="{{URL('/images/backend/edit.png')}}" class="edit-icon"/></button></a>
                        <button class="btn red" style="font-weight:bold;" onclick="openModal('delete{{$project->id}}')">X</button>
                    </td>
                </tr>

                <div class="modal red" id="delete{{$project->id}}">
                    <form action="{!! URL::route('delete_project', $project->id) !!}" method="post">
                        <input name="file" value="{{$project->title}}" style="display:none;" />
                        <div class="left">
                            <p>Weet u zeker dat u dit bestand wilt verwijderen?</p>
                            <span>{{$project->title}}</span>
                        </div>
                        <div class="right" style="padding-top:30px;">
                            <button>Delete</button>
                            <button onclick="closeModal('delete{{$project->id}}');return false;">Cancel</button>
                        </div>
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    </form>
                </div>
            @endforeach
            </tbody>
        </table>
        @if (Session::has('error'))
            <p class="error">{{Session::get('error')}}</p>
        @elseif (Session::has('success'))
            <p class="error">{{Session::get('success')}}</p>
        @endif
    </div>
@endsection