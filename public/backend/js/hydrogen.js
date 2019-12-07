$(document).ready(function() {
    $("._confirm_on_delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });

    $('._ckeditor').ckeditor();

    if (jQuery().rvMedia) {

    }



    if (jQuery().rvMedia) {

        $('.btn_gallery').rvMedia({
            multiple: false,
            onSelectFiles: function (files, $el) {
                var firstItem = _.first(files);
                $('#thumbnail').val(firstItem.url);
                $('#thumbnail_preview').attr("src",firstItem.url);

                $('.btn_clear_gallery').removeClass('hidden');
            }
        });

        $('.btn_gallery_mul').rvMedia({
            multiple: true,
            onSelectFiles: function (files, $el) {

                for(var i = 0; i < files.length; i++) {
                    var id = Date.now();
                    var tpl = '<li id="pm-'+id+'">\n' +
                        '<a class="btn btn-link" onclick="remove_item('+id+')">x</a>\n' +
                        '<img src="'+files[i].url+'">\n' +
                        '<input type="hidden" name="product_images[]" value="'+files[i].url+'">\n' +
                        '</li>';

                    $("#product_images_ul").append(tpl);
                }
            }
        });

        $(".btn_gallery_media").rvMedia({
            multiple: false,
            onSelectFiles: function(e, t) {
                $.each(e, function(e, n) {
                    var o = n.url;
                    "youtube" === n.type ? (o = o.replace("watch?v=", "embed/"), CKEDITOR.instances[t.data("result")].insertHtml('<iframe width="420" height="315" src="' + o + '" frameborder="0" allowfullscreen></iframe>')) : "image" === n.type ? CKEDITOR.instances[t.data("result")].insertHtml('<img src="' + o + '" alt="' + n.name + '" />') : CKEDITOR.instances[t.data("result")].insertHtml('<a href="' + o + '">' + n.name + "</a>")
                });
            }
        });
    }

    $('.btn_clear_gallery').click(function() {
        $('#thumbnail').val('');
        $('#thumbnail_preview').attr("src", '/backend/images/misc/placeholder.png');
        $(this).addClass('hidden');
    });

    // $("#slug").blur(function() {
    //     var slug = $("#slug").val();
    //
    //     $.ajaxSetup({
    //         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    //     });
    //
    //     console.log(slug);
    //
    //     $.ajax({
    //         type: "POST",
    //         url: "/dashboard/check_slug",
    //         data: {
    //             slug:slug
    //         },
    //
    //         success: function (data) {
    //             if(data == 0)
    //             {
    //                 $('.form-control-feedback').text('slug này đã tồn tại !!!')
    //             }
    //             else
    //             {
    //                 $('.form-control-feedback').text('slug hợp lệ !!!')
    //             }
    //         }
    //     });
    // });

    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
    });


    /*
     * Js xử lý setting, id button có dạng save-{tên tab}
     */


    /**********************************************************/


    /**********************************************************/


    $('#clear_cache').on('click', function () {

        $.ajax({
            type: "POST",
            url: "/dashboard/settings/clear",
            data: {
            },

            success: function (data) {
                alert('Clear cache thành công !!!');
            }
        });

    });

    /**********************************************************/
    /**********************************************************/



});


    /*
     * Js xử lý Cat, id input "cate-btmain-id", id btn "btmain-id", id span "status-id"
     */

function showChooseCate(id)
{
    var html;
    var last_main = $('#main_cat');

    if($('#cate-btmain-'+id).is(':checked'))
    {
        html = '<a href="javascript:void(0)" id="btmain-'+id+'" onclick="setMainCate('+id+')">set to main</a>';
    }
    else
    {
        html = '';

        if(last_main.val() == id)
        {
            last_main.val('');
        }
    }

    $('#status-'+id).html(html);
}


function setMainCate(id)
{
    var last_main = $('#main_cat');
    var html;
    var last_html;

    if(last_main.val() == '')
    {
        last_main.val(id);
        html = '(main)';
        $('#status-'+id).html(html);
    }
    else
    {
        last_html = '<a href="javascript:void(0)" id="btmain-'+last_main.val()+'" onclick="setMainCate('+last_main.val()+')">set to main</a>';
        html = '(main)';
        $('#status-'+last_main.val()).html(last_html);

        last_main.val(id);
        $('#status-'+id).html(html);
    }
}

function change_notification_status(id)
{
    $.ajax({
        type: "POST",
        url: "/dashboard/notification",
        data: {
            id: id
        },

        success: function (data) {
        }
    });
}

function make_seen(id, rowid)
{
    var html;

    $.ajax({
        type: "POST",
        url: "/dashboard/contacts/seen",
        data: {
            "id": id,
        },

        success: function (data)
        {
            if(rowid == -1)
            {
                if(data == 1)
                {
                    html = '<span class="m-badge  m-badge--info m-badge--wide">Complete</span>'
                }
                else
                {
                    html = '<span class="m-badge  m-badge--danger m-badge--wide">In Process</span>';
                }

                $('#contact-status').html(html);
            }
            else
            {
                if(data == 1)
                {
                    html = '<p style="color: green">Complete</p>'
                }
                else
                {
                    html = '<p style="color: red">In Process</p>';
                }

                $("tr[data-row='"+rowid+"'] td[data-field='Status'] > span").html(html);
            }
        }
    });
}