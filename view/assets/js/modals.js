! function () {
    for (var t, o, r = "https://grandmodels.online/", e = document.querySelectorAll(".js-btnToModal"), n = document.querySelectorAll(".js-modalOverlay"), a = document.querySelector(".js-privacyPolicyP"), i = document.querySelector(".js-privacyPolicyInput"), l = {}, c = 0; c < n.length; c++) t = n[c].dataset.type, l[t] = {
        overlay: n[c],
        window: n[c].querySelector(".js-modalWindow"),
        btnClose: n[c].querySelector(".js-modalClose")
    }, l[t].btnClose.addEventListener("click", function () {
        u(this.parentNode.parentNode.dataset.type)
    }), l[t].overlay.addEventListener("click", function (e) {
        e.target === this && u(this.dataset.type)
    });
    a.addEventListener("click", function (e) {
        "A" !== e.target.tagName && (i.checked = !i.checked)
    });
    for (c = 0; c < e.length; c++) e[c].addEventListener("click", function (e) {
        e.preventDefault(), s(this.dataset.type)
    });

    function s(e) {
        if (l[e]) return l.current ? (t = l.current, l.current = !1, u(t), void setTimeout(function () {
            d(function () {
                setTimeout(function () {
                    l.current = e, l[e].overlay.classList.add("modal_open"), l[e].window.classList.add("modal__content_open")
                }, 100)
            })
        }, 500)) : void d(function () {
            setTimeout(function () {
                l.current = e, l[e].overlay.classList.add("modal_open"), l[e].window.classList.add("modal__content_open")
            }, 100)
        })
    }

    function u(e) {
        l[e] && "current" !== e && (l[e].window.classList.remove("modal__content_open"), l[e].overlay.classList.remove("modal_open"))
    }

    function d(e) {
        return 0 < Math.max(document.body.scrollTop, document.documentElement.scrollTop) ? (window.scrollBy(0, -100), o = setTimeout(function () {
            d(e)
        }, 10)) : (clearTimeout(o), e && e()), !1
    }
    document.addEventListener("keydown", function (e) {
        if ("Escape" === e.key)
            for (var t in l) u(t)
    });
    var m, f, p = null,
        v = location.href.split("studio=");
    v[1] && (p = parseInt(v[1]), S(100, 100, -1e5), s("sign-up")), -1 !== location.href.indexOf("login") && null === p && (S(100, 100, -1e5), s("login")), -1 !== location.href.indexOf("registration") && (S(100, 100, -1e5), s("sign-up")), -1 !== location.href.indexOf("social") && (S(100, 100, -1e5), s("sign-up")), m = new URL(location.href), (f = new URLSearchParams(m.search.slice(1))).has("change_password") ? ajax({
        action: "ACCEPT CHANGE password",
        hash: f.get("change_password")
    }, function (e) {
        (e = JSON.parse(e)).status && s("change-password")
    }) : f.has("remove_profile") && ajax({
        action: "ACCEPT REMOVE profile",
        hash: f.get("remove_profile")
    }, function (e) {
        (e = JSON.parse(e)).status && s("removed")
    });
    var h = document.querySelector(".js-remindPassForm");
    h.addEventListener("submit", function (e) {
        e.preventDefault(), ajax({
            action: "REMIND password",
            email: h[0].value
        }, function (e) {
            (e = JSON.parse(e)).status ? (alert("Мы отправили вам письмо с паролем на почту."), location.href = r + "?login") : (alert("Такого email не существует."), h[0].focus())
        })
    });
    // var g = document.querySelector(".js-registration");
    // g.addEventListener("submit", function (e) {
    //     e.preventDefault();
    //     var o = {
    //             action: "NEW model"
    //         },
    //         t = location.href.split("refer=")[1]; - 1 !== location.href.indexOf("social") ? o.refSocial = !0 : void 0 !== t ? o.refeler = t.split("#")[0] : p && (o.studioId = p);
    //     for (var n = g.querySelectorAll("input"), a = 0; a < n.length; a++) o[n[a].getAttribute("name")] = n[a].value;
    //     o.check_password !== o.password ? alert("Пароли не совпадают!") : ("function" == typeof gtag_report_conversion && gtag_report_conversion(), ajax(o, function (e) {
    //         if ("id" in (e = JSON.parse(e))) carrotquest.track("$registered", {
    //             $email: n.email,
    //             $name: n.name
    //         }), ym(60753511, "reachGoal", "registered"), p ? (localStorage.setItem("studioId", p), location.href = r + "account.php?studio&email=" + o.email + "&password=" + o.password) : location.href = r + "account.php?login&email=" + o.email + "&password=" + o.password;
    //         else if ("warning" in e) {
    //             alert(e.warning);
    //             for (var t = 0; t < n.length; t++)
    //                 if ("email" === n[t].getAttribute("name")) {
    //                     n[t].focus();
    //                     break
    //                 }
    //         } else "error" in e ? alert(e.error) : alert("Сервер недоступен, но мы над этим уже работаем.")
    //     }))
    // });
    var w = document.querySelector(".js-login");
    w.addEventListener("submit", function (e) {
        e.preventDefault();
        for (var o = {
                action: "LOGIN model"
            }, t = w.querySelectorAll("input"), n = 0; n < t.length; n++) o[t[n].getAttribute("name")] = t[n].value;
        ajax(o, function (e) {
            if ((e = JSON.parse(e)).locked) {
                var t = document.querySelector(".js-modalOverlay--blocked p");
                t && (t.innerText = e.reason), s("blocked")
            } else e.removing ? s("removed") : "id" in e ? location.href = r + "account.php?login&email=" + encodeURIComponent(o.email) + "&password=" + encodeURIComponent(o.password) : alert("Неправильные данные!")
        })
    });
    var y, L, T, b = document.querySelector(".js-buttonUp");

    function E() {
        b && (b.classList.remove("modal-button-up--active"), setTimeout(function () {
            b.classList.remove("modal-button-up--visible")
        }, 300))
    }

    function S(e, t, o) {
        var n, a = 0,
            r = parseFloat((o / (t / 30)).toFixed(2));
        0 < o ? setTimeout(function () {
            n = setInterval(function () {
                (a += r) < o ? window.scrollBy(0, r) : clearInterval(n)
            }, 30)
        }, e) : setTimeout(function () {
            n = setInterval(function () {
                o < (a += r) ? window.scrollBy(0, r) : clearInterval(n)
            }, 30)
        }, e)
    }
    b && (window.addEventListener("scroll", (y = function () {
        1050 < document.body.scrollTop || 1050 < document.documentElement.scrollTop ? function () {
            if (!b) return;
            b.classList.add("modal-button-up--visible"), setTimeout(function () {
                b.classList.add("modal-button-up--active")
            }, 100)
        }() : (document.body.scrollTop < 1e3 || document.documentElement.scrollTop < 1e3) && E()
    }, L = 1e3, T = null, function () {
        null === T && (y.apply(this, arguments), T = setTimeout(function () {
            T = null
        }, L))
    })), b.addEventListener("click", function () {
        ! function (e, t, o) {
            void 0 === o && (o = 20);
            var n = t / e;
            n *= o, e /= o;
            var a = window.pageYOffset || document.documentElement.scrollTop,
                r = setInterval(function () {
                    a += n, window.scrollTo(0, a), --e < 1 && clearInterval(r)
                }, o)
        }(300, -1e4), setTimeout(function () {
            E()
        }, 150)
    }))
}();