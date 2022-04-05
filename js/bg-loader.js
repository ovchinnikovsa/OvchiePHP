! function () {
    function r(e) {
        e.hasAttribute("data-src") && (e.className = e.dataset.src, e.removeAttribute("data-src"))
    }
    document.querySelectorAll(".backgrounds").forEach(function (e, n) {
        n < 1 || (e.dataset.src = e.className, e.className = "backgrounds")
    }), document.addEventListener("DOMContentLoaded", function () {
        var e;
        if ("IntersectionObserver" in window) {
            e = document.querySelectorAll(".backgrounds");
            var t = new IntersectionObserver(function (e, n) {
                e.forEach(function (e) {
                    if (e.isIntersecting) {
                        var n = e.target;
                        r(n), t.unobserve(n)
                    }
                })
            });
            e.forEach(function (e) {
                t.observe(e)
            })
        } else {
            var n;

            function o() {
                n && clearTimeout(n), n = setTimeout(function () {
                    var n = window.pageYOffset;
                    e.forEach(function (e) {
                        e.offsetTop < window.innerHeight + n && r(e)
                    }), 0 == e.length && (document.removeEventListener("scroll", o), window.removeEventListener("resize", o), window.removeEventListener("orientationChange", o))
                }, 20)
            }
            e = document.querySelectorAll(".backgrounds"), document.addEventListener("scroll", o), window.addEventListener("resize", o), window.addEventListener("orientationChange", o)
        }
    })
}();