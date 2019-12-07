<div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
    <!-- BEGIN: Horizontal Menu -->
    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn">
        <i class="la la-close"></i>
    </button>
    <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
        <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">
            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  data-menu-submenu-toggle="click" data-redirect="true" aria-haspopup="true">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-add"></i>
                    <span class="m-menu__link-text">
                        Actions
                    </span>
                    <i class="m-menu__hor-arrow la la-angle-down"></i>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">
                    <span class="m-menu__arrow m-menu__arrow--adjust"></span>
                    <ul class="m-menu__subnav">

                        @if(hydrogen_authorize('pages-create', true))
                            <li class="m-menu__item "  data-redirect="true" aria-haspopup="true">
                                <a  href="{{ route('pages.create') }}" class="m-menu__link ">
                                    <i class="m-menu__link-icon flaticon-file-1"></i>
                                    <span class="m-menu__link-title">
                                    <span class="m-menu__link-wrap">
                                        <span class="m-menu__link-text">
                                            Create New Page
                                        </span>
                                    </span>
                                </span>
                                </a>
                            </li>
                        @endif

                        {{--@if(hydrogen_authorize('posts-create', true))--}}
                            {{--<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">--}}
                                {{--<a  href="{{ route('posts.create') }}" class="m-menu__link ">--}}
                                    {{--<i class="m-menu__link-icon flaticon-folder-1"></i>--}}
                                    {{--<span class="m-menu__link-title">--}}
                                    {{--<span class="m-menu__link-wrap">--}}
                                        {{--<span class="m-menu__link-text">--}}
                                            {{--Create New Post--}}
                                        {{--</span>--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@endif--}}

                        {{--@if(hydrogen_authorize('products-create', true))--}}
                            {{--<li class="m-menu__item "  data-redirect="true" aria-haspopup="true">--}}
                                {{--<a  href="{{ route('products.create') }}" class="m-menu__link ">--}}
                                    {{--<i class="m-menu__link-icon flaticon-folder-1"></i>--}}
                                    {{--<span class="m-menu__link-title">--}}
                                {{--<span class="m-menu__link-wrap">--}}
                                    {{--<span class="m-menu__link-text">--}}
                                        {{--Create New Post--}}
                                    {{--</span>--}}
                                {{--</span>--}}
                            {{--</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--@endif--}}
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <!-- END: Horizontal Menu -->
    <!-- BEGIN: Topbar -->
    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
        <div class="m-stack__item m-topbar__nav-wrapper">
            <ul class="m-topbar__nav m-nav m-nav--inline">
                <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right 	m-dropdown--mobile-full-width" data-dropdown-toggle="click" data-dropdown-persistent="true">
                    <a href="#" class="m-nav__link m-dropdown__toggle" @if(current_user()->unreadNotifications->count() > 0) id="m_topbar_notification_icon" @endif>
                        <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>
                        <span class="m-nav__link-icon">
                            <i class="flaticon-music-2"></i>
                        </span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-right" style="background: url('{{ asset('backend/images/misc/notification_bg.jpg') }}'); background-size: cover;">
                                <span class="m-dropdown__header-title">
                                    {{ current_user()->unreadNotifications->count() }}
                                </span>
                                <span class="m-dropdown__header-subtitle">
                                    User Notifications
                                </span>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_page" role="tab">
                                                Contacts
                                            </a>
                                        </li>

                                        {{--<li class="nav-item m-tabs__item">--}}
                                            {{--<a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_post" role="tab">--}}
                                                {{--Posts--}}
                                            {{--</a>--}}
                                        {{--</li>--}}
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="topbar_notifications_page" role="tabpanel">
                                            <div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">
                                                <div class="m-list-timeline m-list-timeline--skin-light">
                                                    <div class="m-list-timeline__items">
                                                        @foreach(current_user()->unreadNotifications->sortByDesc('created_at')->forPage(1, 10) as $notification )
                                                            <div class="m-list-timeline__item">
                                                                <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>
                                                                <a href="{{ $notification->data['href'] }}" class="m-list-timeline__text"
                                                                   onclick="return change_notification_status('{{ $notification->id }}')">
                                                                    {{ $notification->data['value'] }}
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        {{--<div class="tab-pane" id="topbar_notifications_post" role="tabpanel">--}}
                                            {{--<div class="m-scrollable" m-scrollabledata-scrollable="true" data-max-height="250" data-mobile-max-height="200">--}}
                                                {{--<div class="m-list-timeline m-list-timeline--skin-light">--}}
                                                    {{--<div class="m-list-timeline__items">--}}
                                                        {{--@foreach(current_user()->unreadNotifications->where('type', 'Hydrogen\Post\Notifications\NewPostNotification')--}}
                                                        {{--->sortByDesc('created_at')->forPage(1, 10) as $notification )--}}
                                                            {{--<div class="m-list-timeline__item">--}}
                                                                {{--<span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>--}}
                                                                {{--<a href="{{ $notification->data['href'] }}" class="m-list-timeline__text"--}}
                                                                   {{--onclick="return change_notification_status('{{ $notification->id }}')">--}}
                                                                    {{--{{ $notification->data['value'] }}--}}
                                                                {{--</a>--}}
                                                            {{--</div>--}}
                                                        {{--@endforeach--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" data-dropdown-toggle="click">
                    <a href="#" class="m-nav__link m-dropdown__toggle">
												<span class="m-topbar__userpic">
													<img src="{{ current_user()->gravatar() }}" class="m--img-rounded m--marginless m--img-centered" alt=""/>
												</span>
                        <span class="m-topbar__username m--hide">
													{{ current_user()->name }}
												</span>
                    </a>
                    <div class="m-dropdown__wrapper">
                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                        <div class="m-dropdown__inner">
                            <div class="m-dropdown__header m--align-center" style="background: url('{{ asset('backend/images/misc/user_profile_bg.jpg') }}'); background-size: cover;">
                                <div class="m-card-user m-card-user--skin-dark">
                                    <div class="m-card-user__pic">
                                        <img src="{{ current_user()->gravatar() }}" class="m--img-rounded m--marginless" alt=""/>
                                    </div>
                                    <div class="m-card-user__details">
																<span class="m-card-user__name m--font-weight-500">
																	{{ current_user()->name }}
																</span>
                                        <a href="" class="m-card-user__email m--font-weight-300 m-link">
                                            {{ current_user()->email }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="m-dropdown__body">
                                <div class="m-dropdown__content">
                                    <ul class="m-nav m-nav--skin-light">
                                        <li class="m-nav__section m--hide">
																	<span class="m-nav__section-text">
																		Section
																	</span>
                                        </li>
                                        <li class="m-nav__item">
                                            <a href="{{ route('admins.show', ['id' => current_user_id()]) }}" class="m-nav__link">
                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                <span class="m-nav__link-title">
																			<span class="m-nav__link-wrap">
																				<span class="m-nav__link-text">
																					My Profile
																				</span>
																			</span>
																		</span>
                                            </a>
                                        </li>
                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                        <li class="m-nav__item">
                                            <a href="{{ route('logout') }}" class="btn m-btn--pill    btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder">
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Topbar -->
</div>