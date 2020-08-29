function sizeOfThings(){
    var windowWidth = window.innerWidth;
    var windowHeight = window.innerHeight;
    var screenWidth = screen.width;
    var screenHeight = screen.height;
    console.log(windowWidth + 'x' + windowHeight)
    console.log(screenWidth + 'x' + screenHeight)
};
sizeOfThings();
window.addEventListener('resize', function(event){
    console.log(event)
    sizeOfThings();
});

function menu(){
    if(window.document.getElementsByClassName("menu")[0].style.display == "flex"){
        $(".menu").hide(32)
        var menu = window.document.getElementsByClassName("menu")[0].style.display = "none"
    }else if(window.document.getElementsByClassName("menu")[0].style.display == "none"){
        $(".menu").show(32)
        var menu = window.document.getElementsByClassName("menu")[0].style.display = "flex"
    }else{
            $(".menu").show(32)
            window.document.getElementsByClassName("menu")[0].style.display = "flex"  
    } 

}


let nav  = document.querySelector("#navbarDropdownMenuLink")
let drop  = document.querySelector("#drop")
//p
let nav2  = document.querySelector("#navbarDropdownMenuLink2")
let drop2  = document.querySelector("#drop2")

nav.addEventListener("mousemove", ()=>{
    document.querySelector("#drop").style.display = "block"
});

drop.addEventListener("mouseout", ()=>{
    document.querySelector("#drop").style.display = "none"
});
drop.addEventListener("mousemove", ()=>{
    document.querySelector("#drop").style.display = "block"
});

nav.addEventListener("mouseout", ()=>{
    document.querySelector("#drop").style.display = "none"
});

//part 2

nav2.addEventListener("mousemove", ()=>{
    document.querySelector("#drop2").style.display = "block"
});

drop2.addEventListener("mouseout", ()=>{
    document.querySelector("#drop2").style.display = "none"
});
drop2.addEventListener("mousemove", ()=>{
    document.querySelector("#drop2").style.display = "block"
});

nav2.addEventListener("mouseout", ()=>{
    document.querySelector("#drop2").style.display = "none"
});

