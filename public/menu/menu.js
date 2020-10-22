function menu() {
    if (window.document.getElementsByClassName("menu")[0].style.display == "flex") {
        $(".menu").hide(32)
        var menu = window.document.getElementsByClassName("menu")[0].style.display = "none"
    } else if (window.document.getElementsByClassName("menu")[0].style.display == "none") {
        $(".menu").show(32)
        var menu = window.document.getElementsByClassName("menu")[0].style.display = "flex"
    } else {
        $(".menu").show(32)
        window.document.getElementsByClassName("menu")[0].style.display = "flex"
    }

}