<div class="rv-media-container">
    <div class="rv-media-wrapper">
        <input type="checkbox" id="media_aside_collapse" class="fake-click-event hidden">
        <input type="checkbox" id="media_details_collapse" class="fake-click-event hidden">
        <div class="rv-media-main-wrapper">
            <header class="rv-media-header">
                <div class="rv-media-top-header">
                    <div class="rv-media-actions">
                        <label for="media_aside_collapse" class="btn btn-danger collapse-sidebar no-margin-bottom">
                            <i class="fa fa-bars"></i>
                        </label>
                        @if (hydrogen_authorize('media-files-create', true))
                            <button class="btn btn-primary js-dropzone-upload">
                                <i class="fa fa-cloud-upload"></i> <span class="lblbtn">{{ trans('media::media.upload') }}</span>
                            </button>
                        @endif
                        @if (config('media.allow_external_services') && hydrogen_authorize('media-files-create', true))
                            <div class="btn-group" role="group">
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                        <i class="fa fa-plus"></i> <span class="lblbtn">{{ trans('media::media.add_from') }}</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="#" data-toggle="modal" data-target="#modal_add_from_youtube">
                                                <i class="fa fa-youtube"></i> {{ trans('media::media.youtube') }}
                                            </a>
                                        </li>
                                        @if (app()->environment() == 'demo')
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modal_coming_soon">
                                                    <i class="fa fa-vimeo"></i> {{ trans('media::media.vimeo') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modal_coming_soon">
                                                    <i class="fa fa-vine"></i> {{ trans('media::media.vine') }}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" data-toggle="modal" data-target="#modal_coming_soon">
                                                    <i class="fa fa-youtube-play"></i> {{ trans('media::media.daily_motion') }}
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif
                        @if (hydrogen_authorize('media-folders-create', true))
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_add_folder">
                                <i class="fa fa-folder"></i> <span class="lblbtn">{{ trans('media::media.create_folder') }}</span>
                            </button>
                        @endif
                        <button class="btn btn-primary js-change-action" data-type="refresh">
                            <i class="fa fa-refresh"></i> <span class="lblbtn">{{ trans('media::media.refresh') }}</span>
                        </button>


                        <div class="btn-group" role="group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle js-rv-media-change-filter-group" type="button" data-toggle="dropdown">
                                    <i class="fa fa-filter"></i> <span class="lblbtn">{{ trans('media::media.filter') }}</span> <span class="js-rv-media-filter-current"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="filter" data-value="everything">
                                            <i class="fa fa-recycle"></i> {{ trans('media::media.everything') }}
                                        </a>
                                    </li>
                                    @if (array_key_exists('image', config('media.mime_types', [])))
                                        <li>
                                            <a href="#" class="js-rv-media-change-filter" data-type="filter" data-value="image">
                                                <i class="fa fa-file-image-o"></i> {{ trans('media::media.image') }}
                                            </a>
                                        </li>
                                    @endif
                                    @if (array_key_exists('video', config('media.mime_types', [])))
                                        <li>
                                            <a href="#" class="js-rv-media-change-filter" data-type="filter" data-value="video">
                                                <i class="fa fa-file-video-o"></i> {{ trans('media::media.video') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="filter" data-value="document">
                                            <i class="fa fa-file-o"></i> {{ trans('media::media.document') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="btn-group" role="group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle js-rv-media-change-filter-group" type="button" data-toggle="dropdown">
                                    <i class="fa fa-eye"></i> <span class="lblbtn">{{ trans('media::media.view_in') }}</span> <span class="js-rv-media-filter-current"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="my_media">
                                            <i class="fa fa-user-secret"></i> {{ trans('media::media.my_media') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="public">
                                            <i class="fa fa-globe"></i> {{ trans('media::media.public') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="shared">
                                            <i class="fa fa-share-square"></i> {{ trans('media::media.shared') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in"
                                           data-value="shared_with_me">
                                            <i class="fa fa-share-alt-square"></i> {{ trans('media::media.shared_with_me') }}
                                        </a>
                                    </li>

                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="trash">
                                            <i class="fa fa-trash"></i> {{ trans('media::media.trash') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="recent">
                                            <i class="fa fa-clock-o"></i> {{ trans('media::media.recent') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="js-rv-media-change-filter" data-type="view_in" data-value="favorites">
                                            <i class="fa fa-star"></i> {{ trans('media::media.favorites') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        @if (hydrogen_authorize('media-folders-destroy', true) || hydrogen_authorize('media-files-destroy', true))
                            <button class="btn btn-danger js-files-action hidden" data-action="empty_trash">
                                <i class="fa fa-trash-o"></i> <span class="lblbtn">{{ trans('media::media.empty_trash') }}</span>
                            </button>
                        @endif

                    </div>
                    <div class="rv-media-search">
                        <form class="input-search-wrapper" action="" method="GET">
                            <input type="text" class="form-control" placeholder="{{ trans('media::media.search_file_and_folder') }}">
                            <button class="btn btn-link" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
                <div class="rv-media-bottom-header">
                    <div class="rv-media-breadcrumb">
                        <ul class="breadcrumb"></ul>
                    </div>
                    <div class="rv-media-tools">
                        <div class="btn-group" role="group">
                            <div class="dropdown">
                                <button class="btn btn-default dropdown-toggle"
                                        type="button"
                                        data-toggle="dropdown">
                                    {{ trans('media::media.sort') }} <i class="fa fa-sort-alpha-desc"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="name-asc">
                                            <i class="fa fa-sort-alpha-asc"></i> {{ trans('media::media.file_name_asc') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="name-desc">
                                            <i class="fa fa-sort-alpha-desc"></i> {{ trans('media::media.file_name_desc') }}
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="created_at-asc">
                                            <i class="fa fa-sort-numeric-asc"></i> {{ trans('media::media.created_date_asc') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="created_at-desc">
                                            <i class="fa fa-sort-numeric-desc"></i> {{ trans('media::media.created_date_desc') }}
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="updated_at-asc">
                                            <i class="fa fa-sort-numeric-asc"></i> {{ trans('media::media.uploaded_date_asc') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="updated_at-desc">
                                            <i class="fa fa-sort-numeric-desc"></i> {{ trans('media::media.uploaded_date_desc') }}
                                        </a>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="size-asc">
                                            <i class="fa fa-sort-numeric-asc"></i> {{ trans('media::media.size_asc') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#"
                                           class="js-rv-media-change-filter"
                                           data-type="sort_by"
                                           data-value="size-desc">
                                            <i class="fa fa-sort-numeric-desc"></i> {{ trans('media::media.size_desc') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="dropdown rv-dropdown-actions disabled">
                                <button class="btn btn-default dropdown-toggle"
                                        type="button" data-toggle="dropdown">
                                    {{ trans('media::media.actions') }} &nbsp;<i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right"></ul>
                            </div>
                        </div>
                        <div class="btn-group js-rv-media-change-view-type" role="group">
                            <button class="btn btn-default" type="button" data-type="tiles">
                                <i class="fa fa-th-large"></i>
                            </button>
                            <button class="btn btn-default" type="button" data-type="list">
                                <i class="fa fa-th-list"></i>
                            </button>
                        </div>
                        <label for="media_details_collapse" class="btn btn-link collapse-panel">
                            <i class="fa fa-sign-out"></i>
                        </label>
                    </div>
                </div>
            </header>

            <main class="rv-media-main">
                <div class="rv-media-items"></div>
                <div class="rv-media-details hidden">
                    <div class="rv-media-thumbnail">
                        <i class="fa fa-picture-o"></i>
                    </div>
                    <div class="rv-media-description">
                        <div class="rv-media-name">
                            <p>{{ trans('media::media.nothing_is_selected') }}</p>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="rv-media-footer hidden">
                <button type="button" class="btn btn-danger btn-lg js-insert-to-editor">{{ trans('media::media.insert') }}</button>
            </footer>
        </div>
        <div class="rv-upload-progress hide-the-pane">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ trans('media::media.upload_progress') }}</h3>
                    <a href="javascript:void(0);" class="close-pane">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
                <div class="panel-body">
                    <ul class="rv-upload-progress-table"></ul>
                </div>
            </div>
        </div>
    </div>

    <div class="rv-modals">
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_coming_soon">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss-modal="#modal_coming_soon" aria-label="{{ trans('media::media.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">
                            <i class="fa fa-windows"></i> {{ trans('media::media.comming_soon') }}
                        </h4>
                    </div>
                    <div class="modal-body">
                        <p>These features are on development</p>
                        <div class="modal-notice"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_add_from_youtube">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss-modal="#modal_add_from_youtube" aria-label="{{ trans('media::media.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">
                            <i class="fa fa-windows"></i> {{ trans('media::media.add_from_youtube') }}
                        </h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="input-group">
                                <label class="input-group-addon custom-checkbox">
                                    <input type="checkbox">
                                    <span class="pull-left"></span>
                                    <small>{{ trans('media::media.playlist') }}</small>
                                </label>
                                <input type="text" class="form-control rv-youtube-url" placeholder="https://">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary rv-btn-add-youtube-url" type="button">{{ trans('media::media.add_url') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="modal-notice"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_add_folder">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss-modal="#modal_add_folder" aria-label="{{ trans('media::media.close') }}">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">
                            <i class="fa fa-windows"></i> {{ trans('media::media.create_folder') }}
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form class="rv-form form-add-folder">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="{{ trans('media::media.folder_name') }}">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary rv-btn-add-folder" type="submit">{{ trans('media::media.create') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="modal-notice"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_rename_items">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="rv-form form-rename">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_rename_items" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-windows"></i> {{ trans('media::media.rename') }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="rename-items"></div>
                            <div class="modal-notice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss-modal="#modal_rename_items">{{ trans('media::media.close') }}</button>
                            <button type="submit" class="btn btn-primary">{{ trans('media::media.save_changes') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_set_focus_point">
            <div class="modal-dialog modal-danger modal-lg" role="document">
                <div class="modal-content">
                    <form class="rv-form form-set-focus-point">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_set_focus_point" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                {{ trans('media::media.set_focus_point') }}
                            </h4>
                        </div>
                        <div class="modal-body" style="padding: 10px 0 0 10px;">
                            <div style="position: relative;">
                                <div class="focuspoint-frames" style="min-height: 400px;"></div>

                                <div class="focuspoint-info">
                                    <div class="helper-tool">
                                        <p>{{ trans('media::media.set_focus_description') }}</p>
                                        <div class="helper-tool-target">
                                            <img class="helper-tool-img">
                                            <img class="reticle" src="{{ url('/backend/media/packages/focuspoint/images/focuspoint-target.png') }}">
                                            <img class="target-overlay">
                                        </div>
                                        <p>
                                            <label for="data-attr">{{ trans('media::media.focus_data_attribute') }}:</label>
                                            <input class='helper-tool-data-attr' id="data-attr" name="data-attr" type='text' placeholder='data-focus-x="0" data-focus-y="0" '>
                                        </p>
                                        <p>
                                            <label for="css3-val">{{ trans('media::media.focus_css_background') }}:</label>
                                            <input class='helper-tool-css3-val' id="css3-val" name="css3-val" type='text' placeholder='background-position:'>
                                        </p>
                                        <p>
                                            <input type="hidden" class="helper-tool-reticle-css">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('media::media.save_changes') }}</button>
                            <button type="button" class="btn btn-danger" data-dismiss-modal="#modal_set_focus_point">{{ trans('media::media.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_trash_items">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <form class="rv-form form-delete-items">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_trash_items" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-windows"></i> {{ trans('media::media.move_to_trash') }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p>{{ trans('media::media.confirm_trash') }}</p>
                            <div class="modal-notice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">{{ trans('media::media.confirm') }}</button>
                            <button type="button" class="btn btn-primary" data-dismiss-modal="#modal_trash_items">{{ trans('media::media.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_delete_items">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <form class="rv-form form-delete-items">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_delete_items" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-windows"></i> {{ trans('media::media.confirm_delete') }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p>{{ trans('media::media.confirm_delete_description') }}</p>
                            <div class="modal-notice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">{{ trans('media::media.confirm') }}</button>
                            <button type="button" class="btn btn-primary" data-dismiss-modal="#modal_delete_items">{{ trans('media::media.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_empty_trash">
            <div class="modal-dialog modal-danger" role="document">
                <div class="modal-content">
                    <form class="rv-form form-empty-trash">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_empty_trash" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-windows"></i> {{ trans('media::media.empty_trash_title') }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <p>{{ trans('media::media.empty_trash_description') }}</p>
                            <div class="modal-notice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">{{ trans('media::media.confirm') }}</button>
                            <button type="button" class="btn btn-primary" data-dismiss-modal="#modal_empty_trash">{{ trans('media::media.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="modal_share_items">
            <div class="modal-dialog modal-primary" role="document">
                <div class="modal-content">
                    <form class="rv-form form-share-items">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss-modal="#modal_share_items" aria-label="{{ trans('media::media.close') }}">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title">
                                <i class="fa fa-windows"></i> {{ trans('media::media.share_title') }}
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="share-to">
                                <div class="form-group">
                                    <label for="share_option">{{ trans('media::media.share_to') }}</label>
                                    <select id="share_option" class="form-control">
                                        <option value="no_share">{{ trans('media::media.do_not_share') }}</option>
                                        <option value="everyone">{{ trans('media::media.share_everyone') }}</option>
                                        <option value="user">{{ trans('media::media.share_to_specific_users') }}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="share_to_users">{{ trans('media::media.please_select_user') }}</label>
                                    <select id="share_to_users"
                                            class="form-control"
                                            multiple="multiple">
                                    </select>
                                </div>
                            </div>
                            <div class="modal-notice"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">{{ trans('media::media.confirm') }}</button>
                            <button type="button" class="btn btn-danger" data-dismiss-modal="#modal_share_items">{{ trans('media::media.close') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <button class="hidden js-rv-clipboard-temp"></button>
</div>
<script type="text/x-custom-template" id="rv_media_loading">
    <div class="loading-wrapper">
        <div class="showbox">
            <div class="loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2"
                            stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
    </div>
</script>

<script type="text/x-custom-template" id="rv_action_item">
    <li>
        <a href="javascript:;" class="js-files-action" data-action="__action__">
            <i class="__icon__"></i> __name__
        </a>
    </li>
</script>

<script type="text/x-custom-template" id="rv_media_items_list">
    <div class="rv-media-list">
        <ul>
            <li class="no-items">
                <i class="fa fa-cloud-upload"></i>
                <h3>Drop files and folders here</h3>
                <p>Or use the upload button above.</p>
            </li>
            <li class="rv-media-list-title up-one-level js-up-one-level" title="{{ trans('media::media.up_level') }}">
                <div class="custom-checkbox"></div>
                <div class="rv-media-file-name">
                    <i class="fa fa-level-up"></i>
                    <span>...</span>
                </div>
                <div class="rv-media-file-size"></div>
                <div class="rv-media-created-at"></div>
            </li>
        </ul>
    </div>
</script>

<script type="text/x-custom-template" id="rv_media_items_tiles" class="hidden">
    <div class="rv-media-grid">
        <ul>
            <li class="no-items">
                <i class="__noItemIcon__"></i>
                <h3>__noItemTitle__</h3>
                <p>__noItemMessage__</p>
            </li>
            <li class="rv-media-list-title up-one-level js-up-one-level">
                <div class="rv-media-item" data-context="__type__" title="{{ trans('media::media.up_level') }}">
                    <div class="rv-media-thumbnail">
                        <i class="fa fa-level-up"></i>
                    </div>
                    <div class="rv-media-description">
                        <div class="title">...</div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</script>

<script type="text/x-custom-template" id="rv_media_items_list_element">
    <li class="rv-media-list-title js-media-list-title js-context-menu" data-context="__type__" title="__name__" data-id="__id__">
        <div class="custom-checkbox">
            <label>
                <input type="checkbox">
                <span></span>
            </label>
        </div>
        <div class="rv-media-file-name">
            __thumb__
            <span>__name__</span>
        </div>
        <div class="rv-media-file-size">__size__</div>
        <div class="rv-media-created-at">__date__</div>
    </li>
</script>

<script type="text/x-custom-template" id="rv_media_items_tiles_element">
    <li class="rv-media-list-title js-media-list-title js-context-menu" data-context="__type__" data-id="__id__">
        <input type="checkbox" class="hidden">
        <div class="rv-media-item" title="__name__">
            <div class="rv-media-thumbnail">
                __thumb__
            </div>
            <div class="rv-media-description">
                <div class="title title{{Request::get('file_id')}}">__name__</div>
            </div>
        </div>
    </li>
</script>

<script type="text/x-custom-template" id="rv_media_upload_progress_item">
    <li>
        <div class="rv-table-col">
            <span class="file-name">__fileName__</span>
            <div class="file-error"></div>
        </div>
        <div class="rv-table-col">
            <span class="file-size">__fileSize__</span>
        </div>
        <div class="rv-table-col">
            <span class="label label-__status__">__message__</span>
        </div>
    </li>
</script>

<script type="text/x-custom-template" id="rv_media_breadcrumb_item">
    <li>
        <a href="#" data-folder="__folderId__" class="js-change-folder">__icon__ __name__</a>
    </li>
</script>

<script type="text/x-custom-template" id="rv_media_rename_item">
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon"><i class="__icon__"></i></span>
            <input class="form-control" placeholder="__placeholder__" value="__value__">
        </div>
    </div>
</script>
