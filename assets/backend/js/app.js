!(function (a) {
    "use strict";
    var e,
        t,
        n,
        o = localStorage.getItem("minia-language"),
        r = "en";
    function i(t) {
        document.getElementById("header-lang-img") &&
            ("en" == t
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/us.jpg")
                : "sp" == t
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/spain.jpg")
                : "gr" == t
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/germany.jpg")
                : "it" == t
                ? (document.getElementById("header-lang-img").src = "assets/images/flags/italy.jpg")
                : "ru" == t && (document.getElementById("header-lang-img").src = "assets/images/flags/russia.jpg"),
            localStorage.setItem("minia-language", t),
            null == (o = localStorage.getItem("minia-language")) && i(r),
            a.getJSON("assets/lang/" + o + ".json", function (t) {
                a("html").attr("lang", o),
                    a.each(t, function (t, e) {
                        "head" === t && a(document).attr("title", e.title), a("[data-key='" + t + "']").text(e);
                    });
            }));
    }
    function d() {
        var t = document.querySelectorAll(".counter-value");
        t.forEach(function (o) {
            !(function t() {
                var e = +o.getAttribute("data-target"),
                    a = +o.innerText,
                    n = e / 250;
                n < 1 && (n = 1), a < e ? ((o.innerText = (a + n).toFixed(0)), setTimeout(t, 1)) : (o.innerText = e);
            })();
        });
    }
    function l() {
        for (var t = document.getElementById("topnav-menu-content").getElementsByTagName("a"), e = 0, a = t.length; e < a; e++)
            t[e] &&
                t[e].parentElement &&
                "nav-item dropdown active" === t[e].parentElement.getAttribute("class") &&
                (t[e].parentElement.classList.remove("active"), t[e].nextElementSibling && t[e].nextElementSibling.classList.remove("show"));
    }
    function s(t) {
        document.getElementById(t).checked = !0;
    }
    function c() {
        document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || a("body").removeClass("fullscreen-enable");
    }
    a("#side-menu").metisMenu(),
        d(),
        (e = document.body.getAttribute("data-sidebar-size")),
        a(window).on("load", function () {
            a(".switch").on("switch-change", function () {
                toggleWeather();
            }),
                1024 <= window.innerWidth && window.innerWidth <= 1366 && (document.body.setAttribute("data-sidebar-size", "lg"), s("sidebar-size-small"));
        }),
        a("#vertical-menu-btn").on("click", function (t) {
            t.preventDefault(),
                a("body").toggleClass("sidebar-enable"),
                992 <= a(window).width() &&
                    (null == e
                        ? null == document.body.getAttribute("data-sidebar-size") || "lg" == document.body.getAttribute("data-sidebar-size")
                            ? document.body.setAttribute("data-sidebar-size", "sm")
                            : document.body.setAttribute("data-sidebar-size", "lg")
                        : "md" == e
                        ? "md" == document.body.getAttribute("data-sidebar-size")
                            ? document.body.setAttribute("data-sidebar-size", "sm")
                            : document.body.setAttribute("data-sidebar-size", "md")
                        : "sm" == document.body.getAttribute("data-sidebar-size")
                        ? document.body.setAttribute("data-sidebar-size", "lg")
                        : document.body.setAttribute("data-sidebar-size", "sm"));
        }),
        a("#sidebar-menu a").each(function () {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t &&
                (a(this).addClass("active"),
                a(this).parent().addClass("mm-active"),
                a(this).parent().parent().addClass("mm-show"),
                a(this).parent().parent().prev().addClass("mm-active"),
                a(this).parent().parent().parent().addClass("mm-active"),
                a(this).parent().parent().parent().parent().addClass("mm-show"),
                a(this).parent().parent().parent().parent().parent().addClass("mm-active"));
        }),
        a(document).ready(function () {
            var t;
            0 < a("#sidebar-menu").length &&
                0 < a("#sidebar-menu .mm-active .active").length &&
                300 < (t = a("#sidebar-menu .mm-active .active").offset().top) &&
                ((t -= 300), a(".vertical-menu .simplebar-content-wrapper").animate({ scrollTop: t }, "slow"));
        }),
        a(".navbar-nav a").each(function () {
            var t = window.location.href.split(/[?#]/)[0];
            this.href == t &&
                (a(this).addClass("active"),
                a(this).parent().addClass("active"),
                a(this).parent().parent().addClass("active"),
                a(this).parent().parent().parent().addClass("active"),
                a(this).parent().parent().parent().parent().addClass("active"),
                a(this).parent().parent().parent().parent().parent().addClass("active"),
                a(this).parent().parent().parent().parent().parent().parent().addClass("active"));
        }),
        a('[data-toggle="fullscreen"]').on("click", function (t) {
            t.preventDefault(),
                a("body").toggleClass("fullscreen-enable"),
                document.fullscreenElement || document.mozFullScreenElement || document.webkitFullscreenElement
                    ? document.cancelFullScreen
                        ? document.cancelFullScreen()
                        : document.mozCancelFullScreen
                        ? document.mozCancelFullScreen()
                        : document.webkitCancelFullScreen && document.webkitCancelFullScreen()
                    : document.documentElement.requestFullscreen
                    ? document.documentElement.requestFullscreen()
                    : document.documentElement.mozRequestFullScreen
                    ? document.documentElement.mozRequestFullScreen()
                    : document.documentElement.webkitRequestFullscreen && document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }),
        document.addEventListener("fullscreenchange", c),
        document.addEventListener("webkitfullscreenchange", c),
        document.addEventListener("mozfullscreenchange", c),
        (function () {
            if (document.getElementById("topnav-menu-content")) {
                for (var t = document.getElementById("topnav-menu-content").getElementsByTagName("a"), e = 0, a = t.length; e < a; e++)
                    t[e].onclick = function (t) {
                        t && t.target && "#" === t.target.getAttribute("href") && (t.target.parentElement.classList.toggle("active"), t.target.nextElementSibling && t.target.nextElementSibling.classList.toggle("show"));
                    };
                window.addEventListener("resize", l);
            }
        })(),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map(function (t) {
            return new bootstrap.Tooltip(t);
        }),
        [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).map(function (t) {
            return new bootstrap.Popover(t);
        }),
        [].slice.call(document.querySelectorAll(".toast")).map(function (t) {
            return new bootstrap.Toast(t);
        }),
        window.sessionStorage && ((t = sessionStorage.getItem("is_visited")) ? a("#" + t).prop("checked", !0) : sessionStorage.setItem("is_visited", "layout-ltr")),
        o && "null" != o && o !== r && i(o),
        a(".language").on("click", function (t) {
            i(a(this).attr("data-lang"));
        }),
        a(window).on("load", function () {
            a("#status").fadeOut(), a("#preloader").delay(350).fadeOut("slow");
        }),
        (n = document.getElementsByTagName("body")[0]),
        a(".right-bar-toggle").on("click", function (t) {
            a("body").toggleClass("right-bar-enabled");
        }),
        a("#mode-setting-btn").on("click", function (t) {
            n.hasAttribute("data-layout-mode") && "dark" == n.getAttribute("data-layout-mode")
                ? (document.body.setAttribute("data-layout-mode", "light"),
                  document.body.setAttribute("data-topbar", "light"),
                  document.body.setAttribute("data-sidebar", "light"),
                  (n.hasAttribute("data-layout") && "horizontal" == n.getAttribute("data-layout")) || document.body.setAttribute("data-sidebar", "light"),
                  s("topbar-color-light"),
                  s("sidebar-color-light"),
                  s("topbar-color-light"))
                : (document.body.setAttribute("data-layout-mode", "dark"),
                  document.body.setAttribute("data-topbar", "dark"),
                  document.body.setAttribute("data-sidebar", "dark"),
                  (n.hasAttribute("data-layout") && "horizontal" == n.getAttribute("data-layout")) || document.body.setAttribute("data-sidebar", "dark"),
                  s("layout-mode-dark"),
                  s("sidebar-color-dark"),
                  s("topbar-color-dark"));
        }),
        a(document).on("click", "body", function (t) {
            0 < a(t.target).closest(".right-bar-toggle, .right-bar").length || a("body").removeClass("right-bar-enabled");
        }),
        n.hasAttribute("data-layout") && "horizontal" == n.getAttribute("data-layout") ? (s("layout-horizontal"), a(".sidebar-setting").hide()) : s("layout-vertical"),
        n.hasAttribute("data-layout-mode") && "dark" == n.getAttribute("data-layout-mode") ? s("layout-mode-dark") : s("layout-mode-light"),
        n.hasAttribute("data-layout-size") && "boxed" == n.getAttribute("data-layout-size") ? s("layout-width-boxed") : s("layout-width-fuild"),
        n.hasAttribute("data-layout-scrollable") && "true" == n.getAttribute("data-layout-scrollable") ? s("layout-position-scrollable") : s("layout-position-fixed"),
        n.hasAttribute("data-topbar") && "dark" == n.getAttribute("data-topbar") ? s("topbar-color-dark") : s("topbar-color-light"),
        n.hasAttribute("data-sidebar-size") && "sm" == n.getAttribute("data-sidebar-size")
            ? s("sidebar-size-small")
            : n.hasAttribute("data-sidebar-size") && "md" == n.getAttribute("data-sidebar-size")
            ? s("sidebar-size-compact")
            : s("sidebar-size-default"),
        n.hasAttribute("data-sidebar") && "brand" == n.getAttribute("data-sidebar")
            ? s("sidebar-color-brand")
            : n.hasAttribute("data-sidebar") && "dark" == n.getAttribute("data-sidebar")
            ? s("sidebar-color-dark")
            : s("sidebar-color-light"),
        document.getElementsByTagName("html")[0].hasAttribute("dir") && "rtl" == document.getElementsByTagName("html")[0].getAttribute("dir") ? s("layout-direction-rtl") : s("layout-direction-ltr"),
        a("input[name='layout']").on("change", function () {
            window.location.href = "vertical" == a(this).val() ? "index.html" : "layouts-horizontal.html";
        }),
        a("input[name='layout-mode']").on("change", function () {
            "light" == a(this).val()
                ? (document.body.setAttribute("data-layout-mode", "light"),
                  document.body.setAttribute("data-topbar", "light"),
                  document.body.setAttribute("data-sidebar", "light"),
                  (n.hasAttribute("data-layout") && "horizontal" == n.getAttribute("data-layout")) || document.body.setAttribute("data-sidebar", "light"),
                  s("topbar-color-light"),
                  s("sidebar-color-light"))
                : (document.body.setAttribute("data-layout-mode", "dark"),
                  document.body.setAttribute("data-topbar", "dark"),
                  document.body.setAttribute("data-sidebar", "dark"),
                  (n.hasAttribute("data-layout") && "horizontal" == n.getAttribute("data-layout")) || document.body.setAttribute("data-sidebar", "dark"),
                  s("topbar-color-dark"),
                  s("sidebar-color-dark"));
        }),
        a("input[name='layout-direction']").on("change", function () {
            "ltr" == a(this).val()
                ? (document.getElementsByTagName("html")[0].removeAttribute("dir"),
                  document.getElementById("bootstrap-style").setAttribute("href", "assets/css/bootstrap.min.css"),
                  document.getElementById("app-style").setAttribute("href", "assets/css/app.min.css"))
                : (document.getElementById("bootstrap-style").setAttribute("href", "assets/css/bootstrap-rtl.min.css"),
                  document.getElementById("app-style").setAttribute("href", "assets/css/app-rtl.min.css"),
                  document.getElementsByTagName("html")[0].setAttribute("dir", "rtl"));
        }),
        Waves.init(),
        a("#checkAll").on("change", function () {
            a(".table-check .form-check-input").prop("checked", a(this).prop("checked"));
        }),
        a(".table-check .form-check-input").change(function () {
            a(".table-check .form-check-input:checked").length == a(".table-check .form-check-input").length ? a("#checkAll").prop("checked", !0) : a("#checkAll").prop("checked", !1);
        });
})(jQuery),
    feather.replace();

function x_dropzone() {
    var dropzones = document.querySelectorAll(".x-dropzone:not(.x-dropzone-init)").forEach(function (dropzone) {
        dropzone.classList.add("x-dropzone-init");

        var previews = dropzone.querySelector('[xrole="previews"]');

        if (dropzone.querySelector('[xrole="input"]').hasAttribute("multiple")) {
            previews.classList.add("x-dropzone-multiple");
        } else {
            previews.classList.add("x-dropzone-single");
        }

        dropzone.querySelector('[xrole="input"]').addEventListener("change", function () {
            clear(dropzone);
            preview(dropzone, this.files);
        });

        dropzone.querySelector('[xrole="clear"]').addEventListener("click", function () {
            clear(dropzone, true);
        });

        previews.addEventListener("dragover", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "1px solid cornflowerblue";
            evt.preventDefault();
        });

        previews.addEventListener("dragenter", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "1px solid cornflowerblue";
            evt.preventDefault();
        });

        previews.addEventListener("dragleave", function (evt) {
            dropzone.querySelector('[xrole="previews"]').style.border = "none";
            evt.preventDefault();
        });

        previews.addEventListener("drop", function (evt) {
            clear(dropzone);
            preview(dropzone, evt.dataTransfer.files);
            dropzone.querySelector('[xrole="input"]').files = evt.dataTransfer.files;
            dropzone.querySelector('[xrole="previews"]').style.border = "none";
            evt.preventDefault();
        });
    });

    function clear(dropzone1, input = false) {
        if (input === true) {
            dropzone1.querySelector('[xrole="input"]').value = "";
        }

        dropzone1.querySelector('[xrole="previews"]').innerHTML = '<div xrole="placeholder">Select or Drop Files Here</div>';
    }

    function preview(dropzone1, files) {
        var dropzone1_previews = dropzone1.querySelector('[xrole="previews"]');

        var html = "";
        for (var file of files) {
            var name = file.name.replace(/[\""]/g, '\\"');

            if (file.type.startsWith("image/")) {
                html += '<div><img src="' + URL.createObjectURL(file) + '" title="' + name + '"></div>';
            } else if (file.type.startsWith("video/")) {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGAyJZDHaAAAADGElEQVR42u2cu2sUQRzHP3u55DSeRk2lMRejaCMhCIKgpvABxlepla1YiaKFj06DqAn4HwiClWAjKYJiwBcWCoJiZUQRIYZoUMjFoJicxcxCOPfB3u5MZof5wpA7du6397mdnfk9ZuMRrBXAYWA/sB5Yhj7NAl+AR8B9YCpL40XgnDRaM6BNAwPAkizgVgIPDAGrby+BjjRwzcCooXB++wx0Nwp41XA4v30EupLCdQC/cgLYEOTFHMElHq4e8AzYFXL8G3AJeAPMK1oW9gHXG/jcJ2C3hI3UeMQvdVDDundU9XD9G2GgZDhgLGQBaIo4+W/MVzfwNOyeLGCHKsDjIEhbAEMhbQL0IUeBTlsB/Xty2I+AbAQE6AUGbQYEOAFstBmwGThuAmBNoe1+EwB/qJxwvJhf0NMAWAa+yr9Za96EK1gFriiyXSDGkdUlD7gM/Mk6djRhiC5UJ3AAWAe0JEiWnYybxRb7CqbRhigGm9dBa31RB+gAHaADdIAO0AE6QEtUTPHZLun5t6Ww8QEYQdQnlSkqmvBCQqiBDGO3cUQZTEk00QjgebIvaM4AW2JGWkUHYFmmGFRUbe+GAOwE3ss+z4GlKgH3oq4s/b3uXC3ANf6vXx5KAph0klmlcC5oX/C6B7iDSMHXqzXLZaKmOUfjAaeBVyFwmS8TcUmprPUE6NO50OtOPPVlbdC5ag7QATpAB+gAUwDqri7N6AbUvdD3ILZ3WjtE/T2gF2RArX2IziqE823PATeA7cC7gH6JN+YmiQcr8gQq4sEXAd+tBAxJ6BrwMyCyzzxlcU8R4LGIi7BNhlGbdeRk2oHXGcMNqko6NZI2nAJ2IPaCHQFWp8jmjQG3EFsglcltQnCumgNcXMC5iOOlHDBEOR9zBWAyosOeHABujTg2UURUeNaEdLgt/cK3hsL1IrLfYRoDNcUUU9pZD1grSVstm1+qwKYCoj5308IJdAiY8N8UEY912zI0HxJQlmhDlJPzDjeM+D8AgWoCziBqdXkDmwRO1TsvYUml5YinP/sRzwKVDb3PpmWaY0S2an2Hf3i3d51ioT59AAAAAElFTkSuQmCC" title="' +
                    name +
                    '"></div>';
            } else if (file.type.startsWith("audio/")) {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGAiHZHhZ7AAADbklEQVR42u2bTUgVURSAvxnnqZk/tSgos9S0Fi2kRYuiwKJIpaJFLYpahEREBZHQH20qoigI2rWKoF0UFGaWJIVBRLWpTYvKiMDEDEkl+1NbzDwYppk772dm3p3LHLg8Zu6ZM++buX/nnDsa7lIJbAI2ArXATKKTCeAz8Ai4C3wL0rgBdFhGpyUoY8BZoDQIuFnAQ0nAnOUFUJ0PXArolRQuXT4BdbkCnpMcLl36gUXZwlUDP2ICmBPkiRjBZd1cNeApsNqj/itwEngNTIU0LawHLuRw3UdgrQUrlAHBk2qLYN7bHnZz/SswUCI5oC+kDhQJbv4L+aUO6PPqkzpqyELgiRukKoCekCoBpiF7gRpVAdN9sjPtAakICNAEXFQZEGAvsFhlwBSwSwbA6RBtt8gAOBLmgKP5PEEtAsBy4Iv1G7RMyfAGx4EzIdnW8VnIRiUacBr4HbTvKEMTtUsN0AosAIqzCJbt8xvFCv0G85F6EYPK86Cya9EEMAFMABPABDABTAATwAQwK2kDDgBVAp3ZwEGgnYBy8pl4E0G4S0dt9p556FQA7216r6xzeXsTYQMedtjzyjFuc7n3DdkB91tAmfiYzR733yorYLsHnMiJvu2iOwCUyQa4G5jMIUpQiZmOdup35APoF5PRXep3AJsxd0U5xQC2IE6qih5aK3Dfca4faBD8z3rgQ1CjaJOg6WVa/KTP5Zo1UcVklhB+pO2qy7kNKq1k7ll92C6rVAIcBd46ztWFBVio2OiA43hOWIBagQCd21dSqnkTcx3HwyoBGsAynyYba8CV/J8rfB4V4GgEgHs8Jv9I/EEDuAX8CWklU2sNMHb9EWCGLIttA7iZI6AGPHDRvyKbN5EC7uQAeMhFdwL/3fYF8QeLga4sABtdmuY0cEpmj74U6MkQcKeL3ksPl0yqmEwZ8Nhmb9BDrwH4adP7DiyNQ9AJa067ZoE2C/RaMLdCdgErsrCfF2AcJNmEkADGHXBSUF8SA4YJQd2kDgwJFNbFAHC5oG7QwEx6zPNQuA4cB95ICtcEnBfUvwM4Rvy+Psu0HNGA+RZpmWLjyzjQqFvhgMsKDqCX7EtDA/OzblWaZo/bQr0K6FYArhMzU+UqRZhZ2eEYgg1ZTrPuDBO4SQXmxoEWzLB5uaT9bAzzU9duq4w7Ff4BHrC7OCMpnS8AAAAASUVORK5CYII=" title="' +
                    name +
                    '"></div>';
            } else {
                html +=
                    '<div><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADgAAABLCAYAAAAlMERxAAABhWlDQ1BJQ0MgcHJvZmlsZQAAKJF9kT1Iw1AUhU9TtSIVETuIOGSoThZEizhKFYtgobQVWnUweekfNGlIUlwcBdeCgz+LVQcXZ10dXAVB8AfE0clJ0UVKvC8ptIjxwuN9nHfP4b37AKFRYarZNQmommWk4jExm1sVA6/wYxA98CEqMVNPpBcz8Kyve+qjuovwLO++P6tfyZsM8InEc0w3LOIN4plNS+e8TxxiJUkhPieeMOiCxI9cl11+41x0WOCZISOTmicOEYvFDpY7mJUMlThKHFZUjfKFrMsK5y3OaqXGWvfkLwzmtZU012mNIo4lJJCECBk1lFGBhQjtGikmUnQe8/CPOP4kuWRylcHIsYAqVEiOH/wPfs/WLExPuUnBGND9YtsfY0BgF2jWbfv72LabJ4D/GbjS2v5qA5j9JL3e1sJHwMA2cHHd1uQ94HIHGH7SJUNyJD8toVAA3s/om3LA0C3Qt+bOrXWO0wcgQ7NavgEODoHxImWve7y7t3Nu//a05vcDVGlymwEOkPEAAAAGYktHRAD/AP8A/6C9p5MAAAAJcEhZcwAADdcAAA3XAUIom3gAAAAHdElNRQfmAxEGBAWzR1UsAAACBklEQVR42u3cO2sUQRwA8N9dzggaH534Ai2s/Q4qBB+dRNDCwsZSRPHRCj4KSeUXsFCxN0QxfgntjKCVEh+kiYKacBa7B3Lc7Z3ebrI3/P8wXDHDLL+duZldmP829I7tOIVpHMBW1ccy3uIZFvC7iou0cAXf0N7AsojTZeN24sUGw7rLLCbKwG3Cq5rhOuVpPrNGits1xXXKo1FGci9+1Bw4EvLmGOD+e7q2cKKgfgk38KbC7eEY7g3Z9gxWcR5rw17gY8Edm16H/W+m6um6WtDRZE2BbTweBtkc0OiX+sZZPBn0n2wa75jJR7KVKnAgMgVgITIVYF9kSsCeyNSAHeSDlIFwERfqAmxX1O8dTNUBuFxRv7twrjHgDjbWATiFT/lv2TFnwPPeesW1il6vPtQF2MCt/Nm3TODPOkzRv2M/jmPfP77JXC8C1AlY+kqc6j4YwAAGMIABDGAAAxjAAAYwgAEMYAADGMAABjCAAQxgAAMYwAAGMIABDGAAAxjAAHYDizJIJsfAsLmgbq2JzwUNjowB8GhB3VIL77C7T4OHstyl1zXFHcbdgvpFsoNs7UTL1Qb25NItia0v33GoKcs+m01wAb0vO0mMLM9gIaGp+VKPLJgdmE8ANyf7DkDPmMBlfB1D2Bdc0pUu2O9E7zaclGWAHlTNifgyYgXv8TwfuZXuBn8ALNRFvWhp3xkAAAAASUVORK5CYII=" title="' +
                    name +
                    '"></div>';
            }
        }

        dropzone1_previews.innerHTML = html;
    }
}
