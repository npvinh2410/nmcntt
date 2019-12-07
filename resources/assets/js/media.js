
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// import axios from 'axios';
//
// new Vue({
//     el: '#app',
//
//     data:
//     {
//         base_url: base_url + '/dashboard/media/',
//
//         upload_url: '',
//
//         max_file_upload: '',
//
//         max_file_size: '',
//
//         dropzoneOption: {
//             url: '',
//             paramName: 'file',
//             maxFiles: '',
//             maxFilesize: '',
//             addRemoveLinks: true,
//         },
//
//         folder_id: 0,
//         view_in: 'my_media',
//         page: 1,
//         image_per_page: '',
//
//         selected_item: {
//             id: '',
//             name: '',
//             type: '',
//             url: '',
//             file_type: '',
//             parent_id: 0,
//             is_public: false,
//         },
//
//         order_by: 'desc',
//
//         breadcrumbs: {
//             id: '',
//             name: '',
//             icon: '',
//         },
//
//         list_image: [],
//
//     },
//
//
//     methods:
//     {
//
//         mediaConfig: function ()
//         {
//              axios.get(this.base_url + 'config').then( res => {
//
//                  this.upload_url = res.data.url_upload;
//                  this.max_file_upload = res.data.config_max_file_upload;
//                  this.max_file_size = res.data.config_max_file_size;
//                  this.image_per_page = res.data.config_image_per_page;
//
//                  new Dropzone(document.querySelector(".rv-media-items"), {
//                      paramName: "files",
//                      url: this.upload_url,
//                      method: "POST",
//                      uploadMultiple: true,
//                      maxFiles: this.max_file_upload,
//                      maxFilesize: this.max_file_size,
//                      clickable: ".js-dropzone-upload",
//                      addRemoveLinks: true,
//                      sending: function (file, res, data) {
//                          data.append("_token", $('meta[name="csrf-token"]').attr("content"));
//                          data.append("folder_id", this.folder_id);
//                      },
//                      success: function(file, res) {
//                          console.log(res);
//                      }
//                  });
//
//                  this.getList();
//
//              }).catch(function (error) {
//                 console.log(error);
//              });
//
//
//         },
//
//         showAjaxLoading: function ()
//         {
//             $(".rv-media-main").addClass("on-loading").append($("#rv_media_loading").html());
//         },
//
//         hideAjaxLoading: function () {
//             $(".rv-media-main").removeClass("on-loading").find(".loading-wrapper").remove();
//         },
//
//
//
//         getList: function ()
//         {
//             this.showAjaxLoading();
//
//             var params;
//
//             if(this.selected_item.id != '')
//             {
//                 params = {
//                     order_by: this.order_by,
//                     view_in: this.view_in,
//                     file_selected: this.selected_item,
//                 };
//             }
//             else
//             {
//                 params = {
//                     order_by: this.order_by,
//                     view_in: this.view_in
//                 };
//             }
//
//             axios.get(this.base_url + 'lists', params).then(res => {
//
//                 var html = '<div class="rv-media-grid" >' +
//                                 '<ul>' +
//                                     '<li class="no-items">' +
//                                         '<i class="fa fa-cloud-upload"></i>' +
//                                         '<h3>Drop files and folders here</h3>' +
//                                         '<p>Or use the upload button above.</p>' +
//                                     '</li>' +
//                                     '<li class="rv-media-list-title up-one-level js-up-one-level">' +
//                                         '<div class="rv-media-item" data-context="__type__">' +
//                                             '<div class="rv-media-thumbnail">' +
//                                                 '<i class="fa fa-level-up"></i>' +
//                                             '</div>' +
//                                             '<div class="rv-media-description">' +
//                                                 '<div class="title">...</div>' +
//                                             '</div>' +
//                                         '</div>' +
//                                     '</li>' +
//                                 '</ul>' +
//                             '</div>';
//
//                 if(res.data.folders.length > 0 || res.data.images.length > 0)
//                 {
//
//                 }
//                 else
//                 {
//                     $('.rv-media-items').html(html);
//                     $('.rv-media-items li.no-items').on('click', function () {
//                         $(".rv-media-header .rv-media-top-header .rv-media-actions .js-dropzone-upload").trigger("click");
//                     });
//
//                     if(this.folder_id == 0)
//                     {
//                         $('.rv-media-list-title.up-one-level.js-up-one-level').addClass('hidden');
//                     }
//                 }
//                 this.hideAjaxLoading();
//             }).catch(function (error) {
//                 console.log(error);
//             });
//         },
//
//         changeViewIn: function (view_in)
//         {
//             this.view_in = view_in;
//         },
//
//         getViewName: function ()
//         {
//             var name;
//
//             switch (this.view_in)
//             {
//                 case 'my_media':
//                     name = 'My media';
//                     break;
//                 case 'public':
//                     name = 'Public';
//                     break;
//                 case 'shared':
//                     name = 'Shared';
//                     break;
//                 case 'shared_with_me':
//                     name = 'Shared with me';
//                     break;
//                 case 'trash':
//                     name = 'Trash';
//                     break;
//                 case 'recent':
//                     name = 'Recent';
//                     break;
//                 case 'favorites':
//                     name = 'Favorites';
//                     break;
//
//             }
//
//             return name;
//         }
//     },
//
//     mounted()
//     {
//         $('.m_selectpicker').selectpicker();
//         this.mediaConfig();
//
//     },
//
//
//
//
// });
