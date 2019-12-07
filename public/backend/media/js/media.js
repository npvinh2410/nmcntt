! function(e) {
    "use strict";
    var t = $.parseJSON(localStorage.getItem("MediaConfig")) || {},
        i = {
            app_key: "483a0xyzytz1242c0d520426e8ba366c530c3d9dxxx",
            request_params: {
                view_type: "tiles",
                filter: "everything",
                view_in: "my_media",
                search: "",
                sort_by: "created_at-desc",
                folder_id: 0
            },
            hide_details_pane: !1,
            icons: {
                folder: "fa fa-folder-o"
            },
            actions_list: {
                basic: [{
                    icon: "fa fa-eye",
                    name: "Preview",
                    action: "preview",
                    order: 0,
                    "class": "rv-action-preview"
                }],
                file: [{
                    icon: "fa fa-link",
                    name: "Copy link",
                    action: "copy_link",
                    order: 0,
                    "class": "rv-action-copy-link"
                }, {
                    icon: "fa fa-pencil",
                    name: "Rename",
                    action: "rename",
                    order: 1,
                    "class": "rv-action-rename"
                }, {
                    icon: "fa fa-copy",
                    name: "Make a copy",
                    action: "make_copy",
                    order: 2,
                    "class": "rv-action-make-copy"
                }, {
                    icon: "fa fa-dot-circle-o",
                    name: "Set focus point",
                    action: "set_focus_point",
                    order: 3,
                    "class": "rv-action-set-focus-point"
                }],
                user: [{
                    icon: "fa fa-share-alt",
                    name: "Share",
                    action: "share",
                    order: 0,
                    "class": "rv-action-share"
                }, {
                    icon: "fa fa-ban",
                    name: "Remove share",
                    action: "remove_share",
                    order: 1,
                    "class": "rv-action-remove-share"
                }, {
                    icon: "fa fa-star",
                    name: "Favorite",
                    action: "favorite",
                    order: 2,
                    "class": "rv-action-favorite"
                }, {
                    icon: "fa fa-star-o",
                    name: "Remove favorite",
                    action: "remove_favorite",
                    order: 3,
                    "class": "rv-action-favorite"
                }],
                other: [{
                    icon: "fa fa-download",
                    name: "Download",
                    action: "download",
                    order: 0,
                    "class": "rv-action-download"
                }, {
                    icon: "fa fa-trash",
                    name: "Move to trash",
                    action: "trash",
                    order: 1,
                    "class": "rv-action-trash"
                }, {
                    icon: "fa fa-eraser",
                    name: "Delete permanently",
                    action: "delete",
                    order: 2,
                    "class": "rv-action-delete"
                }, {
                    icon: "fa fa-undo",
                    name: "Restore",
                    action: "restore",
                    order: 3,
                    "class": "rv-action-restore"
                }]
            },
            denied_download: ["youtube"]
        };
    t.app_key && t.app_key === i.app_key || (t = i);
    var a = $.parseJSON(localStorage.getItem("RecentItems")) || [],
        o = function() {};
    o.getUrlParam = function(e, t) {
        void 0 === t && (t = null), t || (t = window.location.search);
        var i = new RegExp("(?:[?&]|&)" + e + "=([^&]+)", "i"),
            a = t.match(i);
        return a && a.length > 1 ? a[1] : null
    }, o.asset = function(e) {
        if ("//" === e.substring(0, 2) || "http://" === e.substring(0, 7) || "https://" === e.substring(0, 8)) return e;
        var t = "/" !== RV_MEDIA_URL.base_url.substr(-1, 1) ? RV_MEDIA_URL.base_url + "/" : RV_MEDIA_URL.base_url;
        return "/" === e.substring(0, 1) ? t + e.substring(1) : t + e
    }, o.showAjaxLoading = function(e) {
        void 0 === e && (e = $(".rv-media-main")), e.addClass("on-loading").append($("#rv_media_loading").html())
    }, o.hideAjaxLoading = function(e) {
        void 0 === e && (e = $(".rv-media-main")), e.removeClass("on-loading").find(".loading-wrapper").remove()
    }, o.isOnAjaxLoading = function(e) {
        return void 0 === e && (e = $(".rv-media-items")), e.hasClass("on-loading")
    }, o.jsonEncode = function(e) {
        return "undefined" == typeof e && (e = null), JSON.stringify(e)
    }, o.jsonDecode = function(e, t) {
        if (!e) return t;
        if ("string" == typeof e) {
            var i;
            try {
                i = $.parseJSON(e)
            } catch (a) {
                i = t
            }
            return i
        }
        return e
    }, o.getRequestParams = function() {
        return window.rvMedia.options && "modal" === window.rvMedia.options.open_in ? $.extend(!0, t.request_params, window.rvMedia.options || {}) : t.request_params
    }, o.getConfigs = function() {
        return t
    }, o.storeConfig = function() {
        localStorage.setItem("MediaConfig", o.jsonEncode(t))
    }, o.storeRecentItems = function() {
        localStorage.setItem("RecentItems", o.jsonEncode(a))
    }, o.addToRecent = function(e) {
        e instanceof Array ? _.each(e, function(e) {
            a.push(e)
        }) : a.push(e)
    }, o.getItems = function() {
        var e = [];
        return $(".js-media-list-title").each(function() {
            var t = $(this),
                i = t.data() || {};
            i.index_key = t.index(), e.push(i)
        }), e
    }, o.getSelectedItems = function() {
        var e = [];
        return $(".js-media-list-title input[type=checkbox]:checked").each(function() {
            var t = $(this).closest(".js-media-list-title"),
                i = t.data() || {};
            i.index_key = t.index(), e.push(i)
        }), e
    }, o.getSelectedFiles = function() {
        var e = [];
        return $(".js-media-list-title[data-context=file] input[type=checkbox]:checked").each(function() {
            var t = $(this).closest(".js-media-list-title"),
                i = t.data() || {};
            i.index_key = t.index(), e.push(i)
        }), e
    }, o.getSelectedFolder = function() {
        var e = [];
        return $(".js-media-list-title[data-context=folder] input[type=checkbox]:checked").each(function() {
            var t = $(this).closest(".js-media-list-title"),
                i = t.data() || {};
            i.index_key = t.index(), e.push(i)
        }), e
    }, o.isUseInModal = function() {
        return "select-files" === o.getUrlParam("media-action") || window.rvMedia && window.rvMedia.options && "modal" === window.rvMedia.options.open_in
    }, o.resetPagination = function() {
        RV_MEDIA_CONFIG.pagination = {
            paged: 1,
            posts_per_page: 40,
            in_process_get_media: !1,
            has_more: !0
        }
    };
    var n = function() {};
    n.showMessage = function(e, t, i) {
        toastr.options = {
            closeButton: !0,
            progressBar: !0,
            positionClass: "toast-bottom-right",
            onclick: null,
            showDuration: 1e3,
            hideDuration: 1e3,
            timeOut: 1e4,
            extendedTimeOut: 1e3,
            showEasing: "swing",
            hideEasing: "linear",
            showMethod: "fadeIn",
            hideMethod: "fadeOut"
        }, toastr[e](t, i)
    }, n.handleError = function(e) {
        "undefined" != typeof e.responseJSON ? "undefined" != typeof e.responseJSON.message ? n.showMessage("error", e.responseJSON.message, RV_MEDIA_CONFIG.translations.message.error_header) : $.each(e.responseJSON, function(e, t) {
            $.each(t, function(e, t) {
                n.showMessage("error", t, RV_MEDIA_CONFIG.translations.message.error_header)
            })
        }) : n.showMessage("error", e.statusText, RV_MEDIA_CONFIG.translations.message.error_header)
    };
    var r = function() {};
    r.handleDropdown = function() {
        var e = _.size(o.getSelectedItems());
        r.renderActions(), e > 0 ? $(".rv-dropdown-actions").removeClass("disabled") : $(".rv-dropdown-actions").addClass("disabled")
    }, r.handlePreview = function() {
        var e = [];
        _.each(o.getSelectedFiles(), function(t, i) {
            _.contains(["image", "youtube", "pdf", "text", "video"], t.type) && (e.push({
                src: t.url
            }), a.push(t.id))
        }), _.size(e) > 0 ? ($.fancybox.open(e), o.storeRecentItems()) : this.handleGlobalAction("download")
    }, r.handleCopyLink = function() {
        var e = "";
        _.each(o.getSelectedFiles(), function(t, i) {
            _.isEmpty(e) || (e += "\n"), e += t.full_url
        });
        var t = $(".js-rv-clipboard-temp");
        t.data("clipboard-text", e), new Clipboard(".js-rv-clipboard-temp", {
            text: function(t) {
                return e
            }
        }), n.showMessage("success", RV_MEDIA_CONFIG.translations.clipboard.success, RV_MEDIA_CONFIG.translations.message.success_header), t.trigger("click")
    }, r.handleGlobalAction = function(e, t) {
        var i = [];
        switch (_.each(o.getSelectedItems(), function(e, t) {
            i.push({
                is_folder: e.is_folder,
                id: e.id,
                full_url: e.full_url,
                focus: e.focus
            })
        }), e) {
            case "rename":
                $("#modal_rename_items").modal("show").find("form.rv-form").data("action", e);
                break;
            case "copy_link":
                r.handleCopyLink();
                break;
            case "preview":
                r.handlePreview();
                break;
            case "set_focus_point":
                var a = $("#modal_set_focus_point");
                0 === i[0].focus.length ? (a.find(".helper-tool-data-attr").val(""), a.find(".helper-tool-css3-val").val(""), a.find(".helper-tool-reticle-css").val(""), $(".reticle").removeAttr("style")) : (a.find(".helper-tool-data-attr").val(i[0].focus.data_attribute), a.find(".helper-tool-css3-val").val(i[0].focus.css_bg_position), a.find(".helper-tool-reticle-css").val(i[0].focus.retice_css), $(".reticle").prop("style", i[0].focus.retice_css)), a.modal("show").find("form.rv-form").data("action", e).data("image", i[0].full_url);
                break;
            case "trash":
                $("#modal_trash_items").modal("show").find("form.rv-form").data("action", e);
                break;
            case "delete":
                $("#modal_delete_items").modal("show").find("form.rv-form").data("action", e);
                break;
            case "share":
                $("#modal_share_items").modal("show").find("form.rv-form").data("action", e);
                break;
            case "empty_trash":
                $("#modal_empty_trash").modal("show").find("form.rv-form").data("action", e);
                break;
            case "download":
                var s = RV_MEDIA_URL.download,
                    d = 0;
                _.each(o.getSelectedItems(), function(e, t) {
                    _.contains(o.getConfigs().denied_download, e.mime_type) || (s += (0 === d ? "?" : "&") + "selected[" + d + "][is_folder]=" + e.is_folder + "&selected[" + d + "][id]=" + e.id, d++)
                }), s !== RV_MEDIA_URL.download ? window.open(s, "_blank") : n.showMessage("error", RV_MEDIA_CONFIG.translations.download.error, RV_MEDIA_CONFIG.translations.message.error_header);
                break;
            default:
                r.processAction({
                    selected: i,
                    action: e
                }, t)
        }
    }, r.processAction = function(e, t) {
        void 0 === t && (t = null), $.ajax({
            url: RV_MEDIA_URL.global_actions,
            type: "POST",
            data: e,
            dataType: "json",
            beforeSend: function() {
                o.showAjaxLoading()
            },
            success: function(e) {
                o.resetPagination(), e.error ? n.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : n.showMessage("success", e.message, RV_MEDIA_CONFIG.translations.message.success_header), t && t(e)
            },
            complete: function(e) {
                o.hideAjaxLoading()
            },
            error: function(e) {
                n.handleError(e)
            }
        })
    }, r.renderRenameItems = function() {
        var e = $("#rv_media_rename_item").html(),
            t = $("#modal_rename_items .rename-items").empty();
        _.each(o.getSelectedItems(), function(i, a) {
            var o = e.replace(/__icon__/gi, i.icon || "fa fa-file-o").replace(/__placeholder__/gi, "Input file name").replace(/__value__/gi, i.name),
                n = $(o);
            n.data("id", i.id), n.data("is_folder", i.is_folder), n.data("name", i.name), t.append(n)
        })
    }, r.renderActions = function() {
        var e = o.getSelectedFolder().length > 0,
            t = $("#rv_action_item").html(),
            i = 0,
            a = $(".rv-dropdown-actions .dropdown-menu");
        a.empty();
        var n = $.extend({}, !0, o.getConfigs().actions_list);
        e && (n.basic = _.reject(n.basic, function(e) {
            return "preview" === e.action
        }), n.file = _.reject(n.file, function(e) {
            return "copy_link" === e.action
        }), n.file = _.reject(n.file, function(e) {
            return "set_focus_point" === e.action
        }), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-create") || (n.file = _.reject(n.file, function(e) {
            return "make_copy" === e.action
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-edit") || (n.file = _.reject(n.file, function(e) {
            return _.contains(["rename"], e.action)
        }), n.user = _.reject(n.user, function(e) {
            return _.contains(["rename", "share", "remove_share", "un_share"], e.action)
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-trash") || (n.other = _.reject(n.other, function(e) {
            return _.contains(["trash", "restore"], e.action)
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-destroy") || (n.other = _.reject(n.other, function(e) {
            return _.contains(["delete"], e.action)
        })));
        var r = o.getSelectedFiles();
        r.length > 0 && "image" !== r[0].type && (n.file = _.reject(n.file, function(e) {
            return "set_focus_point" === e.action
        }));
        var s = !1;
        _.each(r, function(e) {
            _.contains(["image", "youtube", "pdf", "text", "video"], e.type) && (s = !0)
        }), s || (n.basic = _.reject(n.basic, function(e) {
            return "preview" === e.action
        })), "simple" === RV_MEDIA_CONFIG.mode && (n.user = _.reject(n.user, function(e) {
            return _.contains(["share", "remove_share", "un_share"], e.action)
        })), r.length > 0 && (_.contains(RV_MEDIA_CONFIG.permissions, "media-files-create") || (n.file = _.reject(n.file, function(e) {
            return "make_copy" === e.action
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-files-edit") || (n.file = _.reject(n.file, function(e) {
            return _.contains(["rename", "set_focus_point"], e.action)
        }), n.user = _.reject(n.user, function(e) {
            return _.contains(["share", "remove_share", "un_share"], e.action)
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-files-trash") || (n.other = _.reject(n.other, function(e) {
            return _.contains(["trash", "restore"], e.action)
        })), _.contains(RV_MEDIA_CONFIG.permissions, "media-files.destroy") || (n.other = _.reject(n.other, function(e) {
            return _.contains(["delete"], e.action)
        }))), _.each(n, function(e, n) {
            _.each(e, function(e, r) {
                var s = !1;
                switch (o.getRequestParams().view_in) {
                    case "my_media":
                        _.contains(["remove_favorite", "delete", "restore", "remove_share"], e.action) && (s = !0);
                        break;
                    case "shared":
                        _.contains(["remove_favorite", "delete", "restore", "make_copy", "remove_share"], e.action) && (s = !0);
                        break;
                    case "shared_with_me":
                        _.contains(["remove_favorite", "delete", "restore", "make_copy", "share"], e.action) && (s = !0);
                        break;
                    case "public":
                        _.contains(["remove_favorite", "delete", "restore", "make_copy", "share", "remove_share"], e.action) && (s = !0);
                        break;
                    case "recent":
                        _.contains(["remove_favorite", "delete", "restore", "make_copy", "remove_share"], e.action) && (s = !0);
                        break;
                    case "favorites":
                        _.contains(["favorite", "delete", "restore", "make_copy", "remove_share"], e.action) && (s = !0);
                        break;
                    case "trash":
                        _.contains(["preview", "delete", "restore", "rename", "download"], e.action) || (s = !0)
                }
                if (!s) {
                    var d = t.replace(/__action__/gi, e.action || "").replace(/__icon__/gi, e.icon || "").replace(/__name__/gi, RV_MEDIA_CONFIG.translations.actions_list[n][e.action] || e.name);
                    !r && i && (d = '<li role="separator" class="divider"></li>' + d), a.append(d)
                }
            }), e.length > 0 && i++
        })
    };
    var s = function() {};
    s.initContext = function() {
        jQuery().contextMenu && ($.contextMenu({
            selector: '.js-context-menu[data-context="file"]',
            build: function(e, t) {
                return {
                    items: s._fileContextMenu()
                }
            }
        }), $.contextMenu({
            selector: '.js-context-menu[data-context="folder"]',
            build: function(e, t) {
                return {
                    items: s._folderContextMenu()
                }
            }
        }))
    }, s._fileContextMenu = function() {
        var e = {
            preview: {
                name: "Preview",
                icon: function(e, t, i, a) {
                    return t.html('<i class="fa fa-eye" aria-hidden="true"></i> ' + a.name), "context-menu-icon-updated"
                },
                callback: function(e, t) {
                    r.handlePreview()
                }
            },
            set_focus_point: {
                name: "Set focus point",
                icon: function(e, t, i, a) {
                    return t.html('<i class="fa fa-dot-circle-o" aria-hidden="true"></i> ' + a.name), "context-menu-icon-updated"
                },
                callback: function(e, t) {
                    $('.js-files-action[data-action="set_focus_point"]').trigger("click")
                }
            }
        };
        _.each(o.getConfigs().actions_list, function(t, i) {
            _.each(t, function(t) {
                e[t.action] = {
                    name: t.name,
                    icon: function(e, a, o, n) {
                        return a.html('<i class="' + t.icon + '" aria-hidden="true"></i> ' + (RV_MEDIA_CONFIG.translations.actions_list[i][t.action] || n.name)), "context-menu-icon-updated"
                    },
                    callback: function(e, i) {
                        $('.js-files-action[data-action="' + t.action + '"]').trigger("click")
                    }
                }
            })
        });
        var t = [];
        switch (o.getRequestParams().view_in) {
            case "my_media":
                t = ["remove_favorite", "delete", "restore", "remove_share"];
                break;
            case "public":
                t = ["remove_favorite", "delete", "restore", "remove_share"];
                break;
            case "shared":
                t = ["make_copy", "remove_favorite", "delete", "restore", "remove_share"];
                break;
            case "shared_with_me":
                t = ["share", "remove_favorite", "delete", "restore", "make_copy"];
                break;
            case "recent":
                t = ["remove_favorite", "delete", "restore", "remove_share", "make_copy"];
                break;
            case "favorites":
                t = ["favorite", "delete", "restore", "remove_share", "make_copy"];
                break;
            case "trash":
                e = {
                    preview: e.preview,
                    rename: e.rename,
                    download: e.download,
                    "delete": e["delete"],
                    restore: e.restore
                }
        }
        _.each(t, function(t) {
            e[t] = void 0
        }), o.getSelectedItems().length > 1 && (e.set_focus_point = void 0);
        var i = o.getSelectedFolder().length > 0;
        i && (e.preview = void 0, e.set_focus_point = void 0, e.copy_link = void 0, _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-create") || (e.make_copy = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-edit") || (e.rename = void 0, e.share = void 0, e.remove_share = void 0, e.un_share = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-trash") || (e.trash = void 0, e.restore = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-folders-destroy") || (e["delete"] = void 0));
        var a = o.getSelectedFiles();
        a.length > 0 && "image" !== a[0].type && (e.set_focus_point = void 0), a.length > 0 && (_.contains(RV_MEDIA_CONFIG.permissions, "media-files-create") || (e.make_copy = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-files-edit") || (e.rename = void 0, e.set_focus_point = void 0, e.share = void 0, e.remove_share = void 0, e.un_share = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-files-trash") || (e.trash = void 0, e.restore = void 0), _.contains(RV_MEDIA_CONFIG.permissions, "media-files-destroy") || (e["delete"] = void 0));
        var n = !1;
        return _.each(a, function(e) {
            _.contains(["image", "youtube", "pdf", "text", "video"], e.type) && (n = !0)
        }), n || (e.preview = void 0), "simple" === RV_MEDIA_CONFIG.mode && (e.share = void 0, e.un_share = void 0, e.remove_share = void 0), e
    }, s._folderContextMenu = function() {
        var e = s._fileContextMenu();
        return e.preview = void 0, e.set_focus_point = void 0, e.copy_link = void 0, e
    }, s.destroyContext = function() {
        jQuery().contextMenu && $.contextMenu("destroy")
    };
    var d = function() {
        this.group = {}, this.group.list = $("#rv_media_items_list").html(), this.group.tiles = $("#rv_media_items_tiles").html(), this.item = {}, this.item.list = $("#rv_media_items_list_element").html(), this.item.tiles = $("#rv_media_items_tiles_element").html(), this.$groupContainer = $(".rv-media-items")
    };
    d.prototype.renderData = function(e, t, i) {
        void 0 === t && (t = !1), void 0 === i && (i = !1);
        var a = this,
            n = o.getConfigs(),
            s = a.group[o.getRequestParams().view_type],
            d = o.getRequestParams().view_in;
        _.contains(["my_media", "public", "trash", "favorites", "shared", "shared_with_me", "recent"], d) || (d = "my_media"), s = s.replace(/__noItemIcon__/gi, RV_MEDIA_CONFIG.translations.no_item[d].icon || "").replace(/__noItemTitle__/gi, RV_MEDIA_CONFIG.translations.no_item[d].title || "").replace(/__noItemMessage__/gi, RV_MEDIA_CONFIG.translations.no_item[d].message || "");
        var c = $(s),
            l = c.find("ul");
        i && this.$groupContainer.find(".rv-media-grid ul").length > 0 && (l = this.$groupContainer.find(".rv-media-grid ul")), _.size(e.folders) > 0 || _.size(e.files) > 0 ? $(".rv-media-items").addClass("has-items") : $(".rv-media-items").removeClass("has-items"), _.forEach(e.folders, function(e, t) {
            var i = a.item[o.getRequestParams().view_type];
            i = i.replace(/__type__/gi, "folder").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, "").replace(/__date__/gi, e.created_at || "").replace(/__thumb__/gi, '<i class="fa fa-folder-o"></i>');
            var r = $(i);
            _.forEach(e, function(e, t) {
                r.data(t, e)
            }), r.data("is_folder", !0), r.data("icon", n.icons.folder), l.append(r)
        }), _.forEach(e.files, function(e) {
            var t = a.item[o.getRequestParams().view_type];
            if (t = t.replace(/__type__/gi, "file").replace(/__id__/gi, e.id).replace(/__name__/gi, e.name || "").replace(/__size__/gi, e.size || "").replace(/__date__/gi, e.created_at || ""), "list" === o.getRequestParams().view_type) t = t.replace(/__thumb__/gi, '<i class="' + e.icon + '"></i>');
            else switch (e.mime_type) {
                case "youtube":
                    t = t.replace(/__thumb__/gi, '<img src="' + e.options.thumb + '" alt="' + e.name + '">');
                    break;
                default:
                    t = t.replace(/__thumb__/gi, e.thumb ? '<img src="' + e.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>')
            }
            var i = $(t);
            i.data("is_folder", !1), _.forEach(e, function(e, t) {
                i.data(t, e)
            }), l.append(i)
        }), t !== !1 && a.$groupContainer.empty(), i && this.$groupContainer.find(".rv-media-grid ul").length > 0 || a.$groupContainer.append(c), a.$groupContainer.find(".loading-wrapper").remove(), r.handleDropdown(), $(".js-media-list-title[data-id=" + e.selected_file_id + "]").trigger("click")
    };
    var c = function() {
        this.$detailsWrapper = $(".rv-media-main .rv-media-details"), this.descriptionItemTemplate = '<div class="rv-media-name"><p>__title__</p>__url__</div>', this.onlyFields = ["name", "full_url", "size", "mime_type", "created_at", "updated_at", "nothing_selected"], this.externalTypes = ["youtube", "vimeo", "metacafe", "dailymotion", "vine", "instagram"]
    };
    c.prototype.renderData = function(e) {
        var t = this,
            i = "image" === e.type ? '<img src="' + e.full_url + '" alt="' + e.name + '">' : "youtube" === e.mime_type ? '<img src="' + e.options.thumb + '" alt="' + e.name + '">' : '<i class="' + e.icon + '"></i>',
            a = "",
            n = !1;
        if (_.forEach(e, function(i, r) {
                _.contains(t.onlyFields, r) && (!_.contains(t.externalTypes, e.type) || _.contains(t.externalTypes, e.type) && !_.contains(["size", "mime_type"], r)) && (a += t.descriptionItemTemplate.replace(/__title__/gi, RV_MEDIA_CONFIG.translations[r]).replace(/__url__/gi, i ? "full_url" === r ? '<div class="input-group"><input id="file_details_url" type="text" value="' + i + '" class="form-control"><span class="input-group-btn"><button class="btn btn-default js-btn-copy-to-clipboard" type="button" data-clipboard-target="#file_details_url" title="Copied" data-trigger="click"><img class="clippy" src="' + o.asset("/backend/media/images/clippy.svg") + '" width="13" alt="Copy to clipboard"></button></span></div>' : '<span title="' + i + '">' + i + "</span>" : ""), "full_url" === r && (n = !0))
            }), t.$detailsWrapper.find(".rv-media-thumbnail").html(i), t.$detailsWrapper.find(".rv-media-description").html(a), n) {
            new Clipboard(".js-btn-copy-to-clipboard");
            $(".js-btn-copy-to-clipboard").tooltip().on("mouseleave", function(e) {
                $(this).tooltip("hide")
            })
        }
    };
    var l = function() {
        this.MediaList = new d, this.MediaDetails = new c, this.breadcrumbTemplate = $("#rv_media_breadcrumb_item").html()
    };
    l.prototype.getMedia = function(e, t, i) {
        if (void 0 === e && (e = !1), void 0 === t && (t = !1), void 0 === i && (i = !1), "undefined" != typeof RV_MEDIA_CONFIG.pagination) {
            if (RV_MEDIA_CONFIG.pagination.in_process_get_media) return;
            RV_MEDIA_CONFIG.pagination.in_process_get_media = !0
        }
        var s = this;
        s.getFileDetails({
            icon: "fa fa-picture-o",
            nothing_selected: ""
        });
        var d = o.getRequestParams();
        "recent" === d.view_in && (d.recent_items = a), t === !0 ? d.is_popup = !0 : d.is_popup = void 0, d.onSelectFiles = void 0, "undefined" != typeof d.search && "" != d.search && "undefined" != typeof d.selected_file_id && (d.selected_file_id = void 0), d.load_more_file = i, "undefined" != typeof RV_MEDIA_CONFIG.pagination && (d.paged = RV_MEDIA_CONFIG.pagination.paged, d.posts_per_page = RV_MEDIA_CONFIG.pagination.posts_per_page), $.ajax({
            url: RV_MEDIA_URL.get_media,
            type: "GET",
            data: d,
            dataType: "json",
            beforeSend: function() {
                o.showAjaxLoading()
            },
            success: function(t) {
                s.MediaList.renderData(t.data, e, i), s.fetchQuota(), s.renderBreadcrumbs(t.data.breadcrumbs), l.refreshFilter(), r.renderActions(), "undefined" != typeof RV_MEDIA_CONFIG.pagination && ("undefined" != typeof RV_MEDIA_CONFIG.pagination.paged && (RV_MEDIA_CONFIG.pagination.paged += 1), "undefined" != typeof RV_MEDIA_CONFIG.pagination.in_process_get_media && (RV_MEDIA_CONFIG.pagination.in_process_get_media = !1), "undefined" != typeof RV_MEDIA_CONFIG.pagination.posts_per_page && t.data.files.length < RV_MEDIA_CONFIG.pagination.posts_per_page && "undefined" != typeof RV_MEDIA_CONFIG.pagination.has_more && (RV_MEDIA_CONFIG.pagination.has_more = !1))
            },
            complete: function(e) {
                o.hideAjaxLoading()
            },
            error: function(e) {
                n.handleError(e)

            }
        })
    }, l.prototype.getFileDetails = function(e) {
        this.MediaDetails.renderData(e)
    }, l.prototype.fetchQuota = function() {
        $.ajax({
            url: RV_MEDIA_URL.get_quota,
            type: "GET",
            dataType: "json",
            beforeSend: function() {},
            success: function(e) {
                var t = e.data;
                $(".rv-media-aside-bottom .used-analytics span").html(t.used + " / " + t.quota), $(".rv-media-aside-bottom .progress-bar").css({
                    width: t.percent + "%"
                })
            },
            error: function(e) {
                n.handleError(e)
            }
        })
    }, l.prototype.renderBreadcrumbs = function(e) {
        var t = this,
            i = $(".rv-media-breadcrumb .breadcrumb");
        i.find("li").remove(), _.each(e, function(e, a) {
            var o = t.breadcrumbTemplate;
            o = o.replace(/__name__/gi, e.name || "").replace(/__icon__/gi, e.icon ? '<i class="' + e.icon + '"></i>' : "").replace(/__folderId__/gi, e.id || 0), i.append($(o))
        }), $(".rv-media-container").attr("data-breadcrumb-count", _.size(e))
    }, l.refreshFilter = function() {
        var e = $(".rv-media-container"),
            t = o.getRequestParams().view_in;
        "my_media" !== t && ("shared" !== t && "shared_with_me" !== t && "public" !== t || 0 == o.getRequestParams().folder_id) ? ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').addClass("disabled"), e.attr("data-allow-upload", "false")) : ($('.rv-media-actions .btn:not([data-type="refresh"]):not(label)').removeClass("disabled"), e.attr("data-allow-upload", "true")), $(".rv-media-actions .btn.js-rv-media-change-filter-group").removeClass("disabled");
        var i = $('.rv-media-actions .btn[data-action="empty_trash"]');
        "trash" === t ? (i.removeClass("hidden").removeClass("disabled"), _.size(o.getItems()) || i.addClass("hidden").addClass("disabled")) : i.addClass("hidden"), s.destroyContext(), s.initContext(), e.attr("data-view-in", t)
    };
    var u = function() {
        this.MediaList = new d, this.MediaService = new l, $("body").on("shown.bs.modal", "#modal_add_folder", function() {
            $(this).find(".form-add-folder input[type=text]").focus()
        })
    };
    u.prototype.create = function(e) {
        var t = this;
        $.ajax({
            url: RV_MEDIA_URL.create_folder,
            type: "POST",
            data: {
                parent_id: o.getRequestParams().folder_id,
                name: e
            },
            dataType: "json",
            beforeSend: function() {
                o.showAjaxLoading()
            },
            success: function(e) {
                e.error ? n.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : (n.showMessage("success", e.message, RV_MEDIA_CONFIG.translations.message.success_header), o.resetPagination(), t.MediaService.getMedia(!0), u.closeModal())
            },
            complete: function(e) {
                o.hideAjaxLoading()
            },
            error: function(e) {
                n.handleError(e)
            }
        })
    }, u.prototype.changeFolder = function(e) {
        t.request_params.folder_id = e, o.storeConfig(), this.MediaService.getMedia(!0)
    }, u.closeModal = function() {
        $("#modal_add_folder").modal("hide")
    };
    var p = function() {
        this.$body = $("body"), this.dropZone = null, this.uploadUrl = RV_MEDIA_URL.upload_file, this.uploadProgressBox = $(".rv-upload-progress"), this.uploadProgressContainer = $(".rv-upload-progress .rv-upload-progress-table"), this.uploadProgressTemplate = $("#rv_media_upload_progress_item").html(), this.totalQueued = 1, this.MediaService = new l, this.totalError = 0
    };
    p.prototype.init = function() {
        _.contains(RV_MEDIA_CONFIG.permissions, "media-files-create") && $(".rv-media-items").length > 0 && this.setupDropZone(), this.handleEvents()
    }, p.prototype.setupDropZone = function() {
        var e = this;
        e.dropZone = new Dropzone(document.querySelector(".rv-media-items"), {
            url: e.uploadUrl,
            thumbnailWidth: !1,
            thumbnailHeight: !1,
            parallelUploads: 1,
            autoQueue: !0,
            clickable: ".js-dropzone-upload",
            previewTemplate: !1,
            previewsContainer: !1,
            uploadMultiple: !0,
            sending: function(e, t, i) {
                i.append("_token", $('meta[name="csrf-token"]').attr("content")), i.append("folder_id", o.getRequestParams().folder_id), i.append("view_in", o.getRequestParams().view_in)
            }
        }), e.dropZone.on("addedfile", function(t) {
            t.index = e.totalQueued, e.totalQueued++
        }), e.dropZone.on("sending", function(t) {
            e.initProgress(t.name, t.size)
        }), e.dropZone.on("success", function(e) {}), e.dropZone.on("complete", function(t) {
            e.changeProgressStatus(t)
        }), e.dropZone.on("queuecomplete", function() {
            o.resetPagination(), e.MediaService.getMedia(!0), 0 === e.totalError && setTimeout(function() {
                $(".rv-upload-progress .close-pane").trigger("click")
            }, 5e3)
        })
    }, p.prototype.handleEvents = function() {
        var e = this;
        e.$body.on("click", ".rv-upload-progress .close-pane", function(t) {
            t.preventDefault(), $(".rv-upload-progress").addClass("hide-the-pane"), e.totalError = 0, setTimeout(function() {
                $(".rv-upload-progress li").remove(), e.totalQueued = 1
            }, 300)
        })
    }, p.prototype.initProgress = function(e, t) {
        var i = this.uploadProgressTemplate.replace(/__fileName__/gi, e).replace(/__fileSize__/gi, p.formatFileSize(t)).replace(/__status__/gi, "warning").replace(/__message__/gi, "Uploading");
        this.uploadProgressContainer.append(i), this.uploadProgressBox.removeClass("hide-the-pane"), this.uploadProgressBox.find(".panel-body").animate({
            scrollTop: this.uploadProgressContainer.height()
        }, 150)
    }, p.prototype.changeProgressStatus = function(e) {
        var t = this,
            i = t.uploadProgressContainer.find("li:nth-child(" + e.index + ")"),
            a = i.find(".label");
        a.removeClass("label-success label-danger label-warning");
        var n = o.jsonDecode(e.xhr.responseText || "", {});
        if (t.totalError = t.totalError + (n.error === !0 || "error" === e.status ? 1 : 0), a.addClass(n.error === !0 || "error" === e.status ? "label-danger" : "label-success"), a.html(n.error === !0 || "error" === e.status ? "Error" : "Uploaded"), "error" === e.status)
            if (422 === e.xhr.status) {
                var r = "";
                $.each(n, function(e, t) {
                    r += '<span class="text-danger">' + t + "</span><br>"
                }), i.find(".file-error").html(r)
            } else 500 === e.xhr.status && i.find(".file-error").html('<span class="text-danger">' + e.xhr.statusText + "</span>");
        else n.error ? i.find(".file-error").html('<span class="text-danger">' + n.message + "</span>") : o.addToRecent(n.data.id)
    }, p.formatFileSize = function(e, t) {
        void 0 === t && (t = !1);
        var i = t ? 1e3 : 1024;
        if (Math.abs(e) < i) return e + " B";
        var a = ["KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
            o = -1;
        do e /= i, ++o; while (Math.abs(e) >= i && o < a.length - 1);
        return e.toFixed(1) + " " + a[o]
    };
    var m = {
            youtube: {
                api_key: "AIzaSyCV4fmfdgsValGNR3sc-0W3cbpEZ8uOd60"
            }
        },
        f = function() {
            this.MediaService = new l, this.$body = $("body"), this.$modal = $("#modal_add_from_youtube");
            var e = this;
            this.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg), this.$modal.on("hidden.bs.modal", function() {
                e.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.original_msg)
            }), this.$body.on("click", "#modal_add_from_youtube .rv-btn-add-youtube-url", function(t) {
                t.preventDefault(), e.checkYouTubeVideo($(this).closest("#modal_add_from_youtube").find(".rv-youtube-url"))
            })
        };
    f.validateYouTubeLink = function(e) {
        var t = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
        return !!e.match(t) && RegExp.$1
    }, f.getYouTubeId = function(e) {
        var t = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/,
            i = e.match(t);
        return i && 11 === i[2].length ? i[2] : null
    }, f.getYoutubePlaylistId = function(e) {
        var t = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?list=|\&list=)([^#\&\?]*).*/,
            i = e.match(t);
        return i ? i[2] : null
    }, f.prototype.setMessage = function(e) {
        this.$modal.find(".modal-notice").html(e)
    }, f.prototype.checkYouTubeVideo = function(e) {
        function t(e, t) {
            $.ajax({
                url: RV_MEDIA_URL.add_external_service,
                type: "POST",
                dataType: "json",
                data: {
                    type: "youtube",
                    name: e.items[0].snippet.title,
                    folder_id: o.getRequestParams().folder_id,
                    url: t,
                    options: {
                        thumb: "https://img.youtube.com/vi/" + e.items[0].id + "/maxresdefault.jpg"
                    }
                },
                success: function(e) {
                    e.error ? n.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : (n.showMessage("success", e.message, RV_MEDIA_CONFIG.translations.message.success_header), a.MediaService.getMedia(!0))
                },
                error: function(e) {
                    n.handleError(e)
                }
            }), a.$modal.modal("hide")
        }

        function i(e, t) {
            a.$modal.modal("hide")
        }
        var a = this;
        if (f.validateYouTubeLink(e.val()) && m.youtube.api_key) {
            var r = f.getYouTubeId(e.val()),
                s = "https://www.googleapis.com/youtube/v3/videos?id=" + r,
                d = a.$modal.find('.custom-checkbox input[type="checkbox"]').is(":checked");
            d && (r = f.getYoutubePlaylistId(e.val()), s = "https://www.googleapis.com/youtube/v3/playlistItems?playlistId=" + r), $.ajax({
                url: s + "&key=" + m.youtube.api_key + "&part=snippet",
                type: "GET",
                success: function(a) {
                    d ? i(a, e.val()) : t(a, e.val())
                },
                error: function(e) {
                    a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.error_msg)
                }
            })
        } else m.youtube.api_key ? a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.invalid_url_msg) : a.setMessage(RV_MEDIA_CONFIG.translations.add_from.youtube.no_api_key_msg)
    };
    var h = function() {
            new f
        },
        v = function() {};
    v.editorSelectFile = function(e) {
        var t = o.getUrlParam("CKEditor") || o.getUrlParam("CKEditorFuncNum");
        if (window.opener && t) {
            var i = _.first(e);
            window.opener.CKEDITOR.tools.callFunction(o.getUrlParam("CKEditorFuncNum"), i.url), window.opener && window.close()
        }
    };
    var g = function(e, i) {
        window.rvMedia = window.rvMedia || {};
        var a = $("body"),
            n = {
                multiple: !0,
                type: "*",
                onSelectFiles: function(e, t) {}
            };
        i = $.extend(!0, n, i);
        var r = function(e) {
            e.preventDefault();
            var a = $(this);
            $("#rv_media_modal").modal(), window.rvMedia.options = i, window.rvMedia.options.open_in = "modal", window.rvMedia.$el = a, t.request_params.filter = "everything", o.storeConfig();
            var n = window.rvMedia.$el.data("rv-media");
            "undefined" != typeof n && n.length > 0 && (n = n[0], window.rvMedia.options = $.extend(!0, window.rvMedia.options, n || {}), "undefined" != typeof n.selected_file_id ? window.rvMedia.options.is_popup = !0 : "undefined" != typeof window.rvMedia.options.is_popup && (window.rvMedia.options.is_popup = void 0)), 0 === $("#rv_media_body .rv-media-container").length ? $("#rv_media_body").load(RV_MEDIA_URL.popup, function(e) {
                e.error && alert(e.message), $("#rv_media_body").removeClass("media-modal-loading").closest(".modal-content").removeClass("bb-loading")
            }) : $(document).find(".rv-media-container .js-change-action[data-type=refresh]").trigger("click")
        };
        "string" == typeof e ? a.on("click", e, r) : e.on("click", r)
    };
    window.RvMediaStandAlone = g, $(".js-insert-to-editor").off("click").on("click", function(e) {
        e.preventDefault();
        var t = o.getSelectedFiles();
        _.size(t) > 0 && v.editorSelectFile(t)
    }), $.fn.rvMedia = function(e) {
        var i = $(this);
        t.request_params.filter = "everything", "trash" === t.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), o.storeConfig(), new g(i, e)
    };
    var y = function() {
        this.MediaService = new l, this.UploadService = new p, this.FolderService = new u, new h, this.$body = $("body")
    };
    y.prototype.init = function() {
        o.resetPagination(), this.setupLayout(), this.handleMediaList(), this.changeViewType(), this.changeFilter(), this.search(), this.handleActions(), this.UploadService.init(), this.handleModals(), this.scrollGetMore()
    }, y.prototype.setupLayout = function() {
        var e = $('.js-rv-media-change-filter[data-type="filter"][data-value="' + o.getRequestParams().filter + '"]');
        e.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + e.html() + ")");
        var i = $('.js-rv-media-change-filter[data-type="view_in"][data-value="' + o.getRequestParams().view_in + '"]');
        i.closest("li").addClass("active").closest(".dropdown").find(".js-rv-media-filter-current").html("(" + i.html() + ")"), o.isUseInModal() && $(".rv-media-footer").removeClass("hidden"), $('.js-rv-media-change-filter[data-type="sort_by"][data-value="' + o.getRequestParams().sort_by + '"]').closest("li").addClass("active");
        var a = $("#media_details_collapse");
        a.prop("checked", t.hide_details_pane || !1), setTimeout(function() {
            $(".rv-media-details").removeClass("hidden")
        }, 300),
            a.on("change", function(e) {
                e.preventDefault(), t.hide_details_pane = $(this).is(":checked"), o.storeConfig()
            }), $(document).on("click", "button[data-dismiss-modal]", function() {
            var e = $(this).data("dismiss-modal");
            $(e).modal("hide")
        })
    }, y.prototype.handleMediaList = function() {
        var e = this,
            t = !1,
            i = !1,
            a = !1;
        $(document).on("keyup keydown", function(e) {
            t = e.ctrlKey, i = e.metaKey, a = e.shiftKey
        }), e.$body.on("click", ".js-media-list-title", function(n) {
            n.preventDefault();
            var s = $(this);
            if (a) {
                var d = _.first(o.getSelectedItems());
                if (d) {
                    var c = d.index_key,
                        l = s.index();
                    $(".rv-media-items li").each(function(e) {
                        e > c && e <= l && $(this).find("input[type=checkbox]").prop("checked", !0)
                    })
                }
            } else t || i || s.closest(".rv-media-items").find("input[type=checkbox]").prop("checked", !1);
            var u = s.find("input[type=checkbox]");
            u.prop("checked", !0), r.handleDropdown(), e.MediaService.getFileDetails(s.data())
        }).on("dblclick", ".js-media-list-title", function(t) {
            t.preventDefault();
            var i = $(this).data();
            if (i.is_folder === !0) o.resetPagination(), e.FolderService.changeFolder(i.id);
            else if (o.isUseInModal()) {
                if ("trash" !== o.getConfigs().request_params.view_in) {
                    var a = o.getSelectedFiles();
                    _.size(a) > 0 && v.editorSelectFile(a)
                }
            } else r.handlePreview()
        }).on("dblclick", ".js-up-one-level", function(e) {
            e.preventDefault();
            var t = $(".rv-media-breadcrumb .breadcrumb li").length;
            $(".rv-media-breadcrumb .breadcrumb li:nth-child(" + (t - 1) + ") a").trigger("click")
        }).on("contextmenu", ".js-context-menu", function(e) {
            $(this).find("input[type=checkbox]").is(":checked") || $(this).trigger("click")
        }).on("click contextmenu", ".rv-media-items", function(t) {
            _.size(t.target.closest(".js-context-menu")) || ($('.rv-media-items input[type="checkbox"]').prop("checked", !1), $(".rv-dropdown-actions").addClass("disabled"), e.MediaService.getFileDetails({
                icon: "fa fa-picture-o",
                nothing_selected: ""
            }))
        })
    }, y.prototype.changeViewType = function() {
        var e = this;
        e.$body.on("click", ".js-rv-media-change-view-type .btn", function(i) {
            i.preventDefault();
            var a = $(this);
            a.hasClass("active") || (a.closest(".js-rv-media-change-view-type").find(".btn").removeClass("active"), a.addClass("active"), t.request_params.view_type = a.data("type"), "trash" === a.data("type") ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), o.storeConfig(), e.MediaService.getMedia(!0, !0))
        }), $('.js-rv-media-change-view-type .btn[data-type="' + o.getRequestParams().view_type + '"]').trigger("click"), this.bindIntegrateModalEvents()
    }, y.prototype.changeFilter = function() {
        var e = this;
        e.$body.on("click", ".js-rv-media-change-filter", function(i) {
            if (i.preventDefault(), !o.isOnAjaxLoading()) {
                var a = $(this),
                    n = a.closest("ul"),
                    r = a.data();
                t.request_params[r.type] = r.value, "view_in" === r.type && (t.request_params.folder_id = 0, "trash" === r.value ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1)), a.closest(".dropdown").find(".js-rv-media-filter-current").html("(" + a.html() + ")"), o.storeConfig(), l.refreshFilter(), o.resetPagination(), e.MediaService.getMedia(!0), n.find("> li").removeClass("active"), a.closest("li").addClass("active")
            }
        })
    }, y.prototype.search = function() {
        var e = this;
        $('.input-search-wrapper input[type="text"]').val(o.getRequestParams().search || ""), e.$body.on("submit", ".input-search-wrapper", function(i) {
            i.preventDefault(), t.request_params.search = $(this).find('input[type="text"]').val(), o.storeConfig(), e.resetPagination(), e.MediaService.getMedia(!0)
        })
    }, y.prototype.handleActions = function() {
        var e = this;
        e.$body.on("click", '.rv-media-actions .js-change-action[data-type="refresh"]', function(t) {
            t.preventDefault(), o.resetPagination();
            var i = "undefined" != typeof window.rvMedia.$el ? window.rvMedia.$el.data("rv-media") : void 0;
            "undefined" != typeof i && i.length > 0 && "undefined" != typeof i[0].selected_file_id ? e.MediaService.getMedia(!0, !0) : e.MediaService.getMedia(!0, !1)
        }).on("click", ".rv-media-items li.no-items", function(e) {
            e.preventDefault(), $(".rv-media-header .rv-media-top-header .rv-media-actions .js-dropzone-upload").trigger("click")
        }).on("submit", ".form-add-folder", function(t) {
            t.preventDefault();
            var i = $(this).find("input[type=text]"),
                a = i.val();
            e.FolderService.create(a), i.val("")
        }).on("click", ".js-change-folder", function(t) {
            t.preventDefault();
            var i = $(this).data("folder");
            o.resetPagination(), e.FolderService.changeFolder(i)
        }).on("click", ".js-files-action", function(t) {
            t.preventDefault(), r.handleGlobalAction($(this).data("action"), function(t) {
                o.resetPagination(), e.MediaService.getMedia(!0)
            })
        })
    }, y.prototype.handleModals = function() {
        var e = this;
        e.$body.on("show.bs.modal", "#modal_rename_items", function(e) {
            r.renderRenameItems()
        }), e.$body.on("submit", "#modal_rename_items .form-rename", function(t) {
            t.preventDefault();
            var i = [],
                a = $(this);
            $("#modal_rename_items .form-control").each(function() {
                var e = $(this),
                    t = e.closest(".form-group").data();
                t.name = e.val(), i.push(t)
            }), r.processAction({
                action: a.data("action"),
                selected: i
            }, function(t) {
                t.error ? $("#modal_rename_items .form-group").each(function() {
                    var e = $(this);
                    _.contains(t.data, e.data("id")) ? e.addClass("has-error") : e.removeClass("has-error")
                }) : (a.closest(".modal").modal("hide"), e.MediaService.getMedia(!0))
            })
        }), e.$body.on("submit", ".form-delete-items", function(t) {
            t.preventDefault();
            var i = [],
                a = $(this);
            _.each(o.getSelectedItems(), function(e) {
                i.push({
                    id: e.id,
                    is_folder: e.is_folder
                })
            }), r.processAction({
                action: a.data("action"),
                selected: i
            }, function(t) {
                a.closest(".modal").modal("hide"), t.error || e.MediaService.getMedia(!0)
            })
        }), e.$body.on("submit", "#modal_empty_trash .rv-form", function(t) {
            t.preventDefault();
            var i = $(this);
            r.processAction({
                action: i.data("action")
            }, function(t) {
                i.closest(".modal").modal("hide"), e.MediaService.getMedia(!0)
            })
        });
        var i = [],
            a = $("#share_option"),
            s = $("#share_to_users");
        a.on("change", function(e) {
            e.preventDefault(), "user" === $(this).val() ? s.closest(".form-group").removeClass("hidden") : s.closest(".form-group").addClass("hidden")
        }).trigger("change"), e.$body.on("show.bs.modal", "#modal_share_items", function(e) {
            a.val("no_share").trigger("change"), s.val("");
            var t = o.getSelectedItems();
            if (1 !== _.size(t)) {
                var r = !0;
                $.each(t, function(e, t) {
                    0 == t.is_public && (r = !1)
                }), r ? a.val("everyone").trigger("change") : $.ajax({
                    url: RV_MEDIA_URL.get_users,
                    type: "GET",
                    dataType: "json",
                    success: function(e) {
                        e.error ? n.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header) : (s.html(""), i = e.data, _.each(i, function(e) {
                            var t = '<option value="' + e.id + '">' + e.name + "</option>";
                            s.append(t)
                        }))
                    },
                    error: function(e) {
                        n.handleError(e)
                    }
                })
            } else {
                var d = _.first(t);
                d.is_public ? a.val("everyone").trigger("change") : $.ajax({
                    url: RV_MEDIA_URL.get_shared_users,
                    type: "GET",
                    data: {
                        share_id: d.id,
                        is_folder: d.is_folder
                    },
                    dataType: "json",
                    success: function(e) {
                        if (e.error) n.showMessage("error", e.message, RV_MEDIA_CONFIG.translations.message.error_header);
                        else {
                            s.html(""), i = e.data.users;
                            var t = 0;
                            _.each(i, function(e) {
                                var i = e.is_selected;
                                i && t++;
                                var a = '<option value="' + e.id + '" ' + (i ? "selected" : "") + ">" + e.name + "</option>";
                                s.append(a)
                            }), t > 0 && a.val("user").trigger("change")
                        }
                    },
                    error: function(e) {
                        n.handleError(e)
                    }
                })
            }
        }).on("submit", "#modal_share_items .rv-form", function(t) {
            t.preventDefault();
            var i = $(this),
                n = [];
            _.each(o.getSelectedItems(), function(e) {
                n.push({
                    id: e.id,
                    is_folder: e.is_folder
                })
            }), r.processAction({
                action: i.data("action"),
                selected: n,
                share_option: a.val(),
                users: s.val()
            }, function(t) {
                i.closest(".modal").modal("hide"), e.MediaService.getMedia(!0)
            })
        }).on("submit", "#modal_set_focus_point .rv-form", function(e) {
            e.preventDefault();
            var t = $(this),
                i = [],
                a = o.getSelectedItems();
            _.each(a, function(e) {
                i.push({
                    id: e.id,
                    is_folder: e.is_folder
                })
            }), r.processAction({
                action: t.data("action"),
                selected: i,
                data_attribute: $(".helper-tool-data-attr").val(),
                css_bg_position: $(".helper-tool-css3-val").val(),
                retice_css: $(".helper-tool-reticle-css").val()
            }, function(e) {
                t.closest(".modal").modal("hide"), _.each(a, function(t) {
                    t.id === e.data.id && $(".js-media-list-title[data-id=" + t.id + "]").data(e.data)
                })
            })
        }), "trash" === t.request_params.view_in ? $(document).find(".js-insert-to-editor").prop("disabled", !0) : $(document).find(".js-insert-to-editor").prop("disabled", !1), this.bindIntegrateModalEvents()
    }, y.prototype.checkFileTypeSelect = function(e) {
        if ("undefined" != typeof window.rvMedia.$el) {
            var t = _.first(e),
                i = window.rvMedia.$el.data("rv-media");
            if ("undefined" != typeof i && "undefined" != typeof i[0] && "undefined" != typeof i[0].file_type && "undefined" !== t && "undefined" !== t.type && !i[0].file_type.match(t.type)) return !1
        }
        return !0
    }, y.prototype.bindIntegrateModalEvents = function() {
        var e = $("#rv_media_modal"),
            t = this;
        e.off("click", ".js-insert-to-editor").on("click", ".js-insert-to-editor", function(i) {
            i.preventDefault();
            var a = o.getSelectedFiles();
            _.size(a) > 0 && (window.rvMedia.options.onSelectFiles(a, window.rvMedia.$el), t.checkFileTypeSelect(a) && e.find(".close").trigger("click"))
        }), e.off("dblclick", ".js-media-list-title").on("dblclick", ".js-media-list-title", function(i) {
            if (i.preventDefault(), "trash" !== o.getConfigs().request_params.view_in) {
                var a = o.getSelectedFiles();
                _.size(a) > 0 && (window.rvMedia.options.onSelectFiles(a, window.rvMedia.$el), t.checkFileTypeSelect(a) && e.find(".close").trigger("click"))
            } else r.handlePreview()
        })
    }, y.setupSecurity = function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        })
    }, y.prototype.scrollGetMore = function() {
        var e = this;
        $(".rv-media-main .rv-media-items").bind("DOMMouseScroll mousewheel", function(t) {
            if ((t.originalEvent.detail > 0 || t.originalEvent.wheelDelta < 0) && $(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight - 350) {
                if ("undefined" == typeof RV_MEDIA_CONFIG.pagination || !RV_MEDIA_CONFIG.pagination.has_more) return;
                e.MediaService.getMedia(!1, !1, !0)
            }
        })
    }, $(document).ready(function() {
        window.rvMedia = window.rvMedia || {}, y.setupSecurity(), (new y).init()
    })
}(this.LaravelElixirBundle = this.LaravelElixirBundle || {});