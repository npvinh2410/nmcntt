@extends('dashboard::layouts.main')

@section('title')
    {{  $user->name }}
@endsection


@section('content')

    <div class="row">
        <div class="col-md-12">
            @if($type == 0)
                <div class="m-portlet">

                    <div class="m-portlet__body">

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Name
                            </h3>
                            <div class="m-section__content">
                                {!! $user->admin->name !!}
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed"></div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Email
                            </h3>
                            <div class="m-section__content">
                                {!! $user->email !!}
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed"></div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Role
                            </h3>
                            <div class="m-section__content">
                                {{ $user->roles[0]->display_name }}
                            </div>
                        </div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Status
                            </h3>
                            <div class="m-section__content">
                                @if($user->status == true)
                                    <span class="m-badge  m-badge--info m-badge--wide">Publish</span>
                                @else
                                    <span class="m-badge  m-badge--danger m-badge--wide">Publish</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="m-portlet__foot">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                @if(hydrogen_authorize('users-index', true))<a href="{{ route('users.index') }}" class="btn btn-brand">Back</a>@endif
                                @if(current_user_id() == $user->id || hydrogen_authorize('admins-edit', true))<a href="{{ route('admins.edit', ['id' => $user->id]) }}" class="btn btn-success">Edit</a>@endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="m-portlet">

                    <div class="m-portlet__body">

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Name
                            </h3>
                            <div class="m-section__content">
                                {!! $user->client->name !!}
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed"></div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Email
                            </h3>
                            <div class="m-section__content">
                                {!! $user->email !!}
                            </div>
                        </div>
                        <div class="m-separator m-separator--dashed"></div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Phone
                            </h3>
                            <div class="m-section__content">
                                {{ $user->client->phone }}
                            </div>
                        </div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Address
                            </h3>
                            <div class="m-section__content">
                                {{ $user->client->address }}
                            </div>
                        </div>

                        <div class="m-section">
                            <h3 class="m-section__heading">
                                Status
                            </h3>
                            <div class="m-section__content">
                                @if($user->status == true)
                                    <span class="m-badge  m-badge--info m-badge--wide">Active</span>
                                @else
                                    <span class="m-badge  m-badge--danger m-badge--wide">Deactive</span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="m-portlet__foot">
                        <div class="row align-items-center">
                            <div class="col-lg-12">
                                @if(hydrogen_authorize('users-index', true))<a href="{{ route('users.index') }}" class="btn btn-brand">Back</a>@endif
                                @if(current_user_id() == $user->id || hydrogen_authorize('clients-edit', true))<a href="{{ route('clients.edit', ['id' => $user->id]) }}" class="btn btn-success">Edit</a>@endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection