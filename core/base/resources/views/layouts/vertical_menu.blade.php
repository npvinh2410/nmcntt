<!-- BEGIN: Left Aside -->
<button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
</button>
<div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
    <div
            id="m_ver_menu"
            class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark "
            data-menu-vertical="true"
            data-menu-scrollable="false" data-menu-dropdown-timeout="500"
    >
        <ul class="m-menu__nav m-menu__nav--dropdown-submenu-arrow h-no-padding-top">

            <li class="m-menu__section">
                <h4 class="m-menu__section-text">
                    Components
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
            </li>

            @if(hydrogen_authorize('clients-index', true) || hydrogen_authorize('admins-index', true) || hydrogen_authorize('roles-index', true) || hydrogen_authorize('permissions-index', true))
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-users"></i>
                        <span class="m-menu__link-text">
                            User Management
                        </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            @if(hydrogen_authorize('clients-index', true) || hydrogen_authorize('admins-index', true))
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{ route('users.index') }}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">Users</span>
                                </a>
                            </li>
                            @endif
                            @if(hydrogen_authorize('roles-index', true))
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{ route('roles.index') }}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">Roles</span>
                                </a>
                            </li>
                            @endif
                            @if(hydrogen_authorize('permissions-index', true))
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{ route('permissions.index') }}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">Permissions</span>
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </li>
            @endif
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="{{ route('media.index') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-attachment"></i>
                    <span class="m-menu__link-text">Media</span>
                </a>
            </li>
            @if(hydrogen_authorize('menus-index', true))
            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="#" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-menu-button"></i>
                    <span class="m-menu__link-text">
                                    Menus
                                </span>
                    <i class="m-menu__ver-arrow la la-angle-right"></i>
                </a>
                <div class="m-menu__submenu">
                    <span class="m-menu__arrow"></span>
                    <ul class="m-menu__subnav">
                        <li class="m-menu__item " aria-haspopup="true" >
                            <a  href="{{ route('menus.index') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">All Menus</span>
                            </a>
                        </li>
                        @if(hydrogen_authorize('menus-create', true))
                        <li class="m-menu__item " aria-haspopup="true" >
                            <a  href="{{ route('menus.create') }}" class="m-menu__link ">
                                <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                    <span></span>
                                </i>
                                <span class="m-menu__link-text">Create New Menu</span>
                            </a>
                        </li>
                        @endif
                    </ul>

                </div>
            </li>
            @endif
            @if(hydrogen_authorize('pages-index', true))
                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                    <a  href="#" class="m-menu__link m-menu__toggle">
                        <i class="m-menu__link-icon flaticon-file-1"></i>
                        <span class="m-menu__link-text">
										Pages
									</span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i>
                    </a>
                    <div class="m-menu__submenu">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            @if(hydrogen_authorize('pages-index', true))
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{ route('pages.index') }}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">All Pages</span>
                                </a>
                            </li>
                            @endif
                            @if(hydrogen_authorize('pages-create', true))
                            <li class="m-menu__item " aria-haspopup="true" >
                                <a  href="{{ route('pages.create') }}" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                        <span></span>
                                    </i>
                                    <span class="m-menu__link-text">Create New Page</span>
                                </a>
                            </li>
                            @endif
                        </ul>

                    </div>
                </li>
            @endif
            {{--@if(hydrogen_authorize('posts-index', true) || hydrogen_authorize('categories-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="#" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-folder-1"></i>--}}
                        {{--<span class="m-menu__link-text">--}}
                            {{--Posts--}}
                        {{--</span>--}}
                        {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                    {{--</a>--}}
                    {{--<div class="m-menu__submenu">--}}
                        {{--<span class="m-menu__arrow"></span>--}}
                        {{--<ul class="m-menu__subnav">--}}
                            {{--@if(hydrogen_authorize('categories-index', true))--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('categories.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Categories</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                {{--<a  href="{{ route('posts.index') }}" class="m-menu__link ">--}}
                                    {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                        {{--<span></span>--}}
                                    {{--</i>--}}
                                    {{--<span class="m-menu__link-text">All Posts</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--@if(hydrogen_authorize('posts-create', true))--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('posts.create') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Create New Post</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}

                    {{--</div>--}}
                {{--</li>--}}
            {{--@endif--}}

            {{--@if(hydrogen_authorize('products-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="#" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-file-1"></i>--}}
                        {{--<span class="m-menu__link-text">--}}
                            {{--Products--}}
                        {{--</span>--}}
                        {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                    {{--</a>--}}
                    {{--<div class="m-menu__submenu">--}}
                        {{--<span class="m-menu__arrow"></span>--}}
                        {{--<ul class="m-menu__subnav">--}}
                            {{--@if(hydrogen_authorize('catalogs-index', true))--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('catalogs.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Catalogs</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('tags.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Tags</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            {{--@if(hydrogen_authorize('products-index', true))--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('products.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Products</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            {{--@if(hydrogen_authorize('taxes-index', true))--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('taxes.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Tax</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                            {{--@if(hydrogen_authorize('attributes-index', true) && get_setting('shop') == 'on')--}}
                                {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                    {{--<a  href="{{ route('attributes.index') }}" class="m-menu__link ">--}}
                                        {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                            {{--<span></span>--}}
                                        {{--</i>--}}
                                        {{--<span class="m-menu__link-text">Attributes</span>--}}
                                    {{--</a>--}}
                                {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}

                    {{--</div>--}}
                {{--</li>--}}
            {{--@endif--}}



            {{--@if(hydrogen_authorize('sliders-index', true))--}}
            {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                {{--<a  href="#" class="m-menu__link m-menu__toggle">--}}
                    {{--<i class="m-menu__link-icon flaticon-paper-plane"></i>--}}
                    {{--<span class="m-menu__link-text">--}}
										{{--Sliders--}}
									{{--</span>--}}
                    {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                {{--</a>--}}
                {{--<div class="m-menu__submenu">--}}
                    {{--<span class="m-menu__arrow"></span>--}}
                    {{--<ul class="m-menu__subnav">--}}

                        {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                            {{--<a  href="{{ route('sliders.index') }}" class="m-menu__link ">--}}
                                {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                    {{--<span></span>--}}
                                {{--</i>--}}
                                {{--<span class="m-menu__link-text">All Sliders</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}

                        {{--@if(hydrogen_authorize('sliders-index', true))--}}
                        {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                            {{--<a  href="{{ route('sliders.create') }}" class="m-menu__link ">--}}
                                {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                    {{--<span></span>--}}
                                {{--</i>--}}
                                {{--<span class="m-menu__link-text">Create New Slider</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--@endif--}}
                    {{--</ul>--}}

                {{--</div>--}}
            {{--</li>--}}
            {{--@endif--}}

            {{--@if(hydrogen_authorize('widgets-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="#" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-network"></i>--}}
                        {{--<span class="m-menu__link-text">--}}
										{{--Widgets--}}
									{{--</span>--}}
                        {{--<i class="m-menu__ver-arrow la la-angle-right"></i>--}}
                    {{--</a>--}}
                    {{--<div class="m-menu__submenu">--}}
                        {{--<span class="m-menu__arrow"></span>--}}
                        {{--<ul class="m-menu__subnav">--}}
                            {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                {{--<a  href="{{ route('widgets.index') }}" class="m-menu__link ">--}}
                                    {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                        {{--<span></span>--}}
                                    {{--</i>--}}
                                    {{--<span class="m-menu__link-text">All Widgets</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--@if(hydrogen_authorize('widgets-create', true))--}}
                            {{--<li class="m-menu__item " aria-haspopup="true" >--}}
                                {{--<a  href="{{ route('widgets.create') }}" class="m-menu__link ">--}}
                                    {{--<i class="m-menu__link-bullet m-menu__link-bullet--dot">--}}
                                        {{--<span></span>--}}
                                    {{--</i>--}}
                                    {{--<span class="m-menu__link-text">Create New Widgets</span>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                            {{--@endif--}}
                        {{--</ul>--}}

                    {{--</div>--}}
                {{--</li>--}}
            {{--@endif--}}

            {{--@if(hydrogen_authorize('seos-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="{{ route('seoUpdate.index') }}" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-network"></i>--}}
                        {{--<span class="m-menu__link-text">Seo Overwrite</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endif--}}

            {{--@if(hydrogen_authorize('contacts-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="{{ route('contacts.index') }}" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-music-2"></i>--}}
                        {{--<span class="m-menu__link-text">Contacts</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endif--}}

            {{--@if(hydrogen_authorize('settings-index', true))--}}
                {{--<li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">--}}
                    {{--<a  href="{{ route('settings.index') }}" class="m-menu__link m-menu__toggle">--}}
                        {{--<i class="m-menu__link-icon flaticon-cogwheel-1"></i>--}}
                        {{--<span class="m-menu__link-text">Settings</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--@endif--}}


            <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  data-menu-submenu-toggle="hover">
                <a  href="{{ route('logout') }}" class="m-menu__link m-menu__toggle">
                    <i class="m-menu__link-icon flaticon-logout"></i>
                    <span class="m-menu__link-text">Logout</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->