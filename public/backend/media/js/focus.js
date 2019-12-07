! function(t) {
    "use strict";
    ! function(t) {
        t(document).ready(function() {
            function a(a) {
                if(a) {
                    t("<img/>").attr("src", a).load(function() {
                        r.w = this.width, r.h = this.height, n.attr("src", a), d.attr("src", a), c.attr({
                            "data-focus-x": r.x,
                            "data-focus-y": r.y,
                            "data-image-w": r.w,
                            "data-image-h": r.h
                        }), c.data("focusX", r.x), c.data("focusY", r.y), c.data("imageW", r.w), c.data("imageH", r.h), t(".focuspoint").focusPoint()
                    })
                }
            }

            function o() {
                e.val('data-focus-x="' + r.x.toFixed(2) + '" data-focus-y="' + r.y.toFixed(2) + '" data-image-w="' + r.w + '" data-image-h="' + r.h + '"')
            }

            function i() {
                c.attr({
                    "data-focus-x": r.x,
                    "data-focus-y": r.y
                }), c.data("focusX", r.x), c.data("focusY", r.y), c.adjustFocus()
            }
            var s, e, f, c, d, n, r = {
                x: 0,
                y: 0,
                w: 0,
                h: 0
            };
            ! function() {
                s = t("#modal_set_focus_point").find("form.rv-form").data("image"), e = t(".helper-tool-data-attr"), f = t(".helper-tool-css3-val"), n = t("img.helper-tool-img, img.target-overlay");
                for (var o = 1; o < 10; o++) t(".focuspoint-frames").append('<div class="focuspoint focuspoint-frame' + o + '"><img/></div>');
                c = t(".focuspoint"), d = t(".focuspoint img"), a(s)
            }(), n.click(function(a) {
                var s = t(this).width(),
                    e = t(this).height(),
                    c = a.pageX - t(this).offset().left,
                    d = a.pageY - t(this).offset().top,
                    n = 2 * (c / s - .5),
                    u = (d / e - .5) * -2;
                r.x = n, r.y = u, o(), i();
                var l = c / s * 100,
                    h = d / e * 100,
                    m = l.toFixed(0) + "% " + h.toFixed(0) + "%",
                    p = "background-position: " + m + ";";
                f.val(p), t(".reticle").css({
                    top: h + "%",
                    left: l + "%"
                }), t(".helper-tool-reticle-css").val("top: " + h + "%; left: " + l + "%")
            }), t("#modal_set_focus_point").on("shown.bs.modal", function(o) {
                a(t("#modal_set_focus_point").find("form.rv-form").data("image"))
            })
        })
    }(jQuery)
}(this.LaravelElixirBundle = this.LaravelElixirBundle || {});