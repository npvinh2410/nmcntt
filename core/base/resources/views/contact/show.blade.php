@extends('dashboard::layouts.main')

@section('title')
    {{ $contact->the_name() }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-9">

            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Contact Info
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Name
                        </h3>
                        <div class="m-section__content">
                            {{ $contact->the_name() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Phone
                        </h3>
                        <div class="m-section__content">
                            {{ $contact->the_phone() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Mail
                        </h3>
                        <div class="m-section__content">
                            {{ $contact->the_mail() }}
                        </div>
                    </div>
                    <div class="m-separator m-separator--dashed"></div>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="m-portlet">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                Action
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="m-section">
                        <h3 class="m-section__heading">
                            Status
                        </h3>
                        <div id="contact-status" class="m-section__content">
                            @if($contact->status)
                                <span style="width: 132px;"><span class="m-badge  m-badge--info m-badge--wide">{{ $contact->the_status() }}</span></span>
                            @else
                                <span style="width: 132px;"><span class="m-badge  m-badge--danger m-badge--wide">{{ $contact->the_status() }}</span></span>
                            @endif
                        </div>
                    </div>

                </div>

                <div class="m-portlet__foot">
                    <a href="javascript:void(0)" onclick="make_seen('{{ $contact->id }}', '-1')" class="btn btn-brand">Make Seen</a>
                    @if(hydrogen_authorize('contacts-index', true))<a href="{{ route('contacts.index') }}" class="btn btn-brand">Back</a>@endif
                </div>
            </div>

        </div>
    </div>
@endsection