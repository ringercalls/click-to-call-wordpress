// $(document).ready(function() {
//     // Get dialer config and user account.
//     // var data = JSON.parse($('#box_data').html());
//     // console.log(data);
//     // create_virtual_phone_box(data);
//     var btnClose = document.getElementById("btn-vpx-close");
//     btnClose.addEventListener('click', close(),false);
// });

var widthDevice = window.innerWidth;
var heightDevice = window.innerHeight;
if (widthDevice < 420) {
    setTimeout(function(){ 
        document.getElementById("ringer-popup").classList.toggle("rcc-mobile");
        document.getElementById("iframe-vpx").style.height = heightDevice + "px";
        $(".fullscreen .ringer-vpx-active").css({"top": "0"});
    }, 3000);
}

if (window.addEventListener) {
    window.addEventListener("message", messageListener, false);
}
else {
    window.attachEvent("onmessage", messageListener);
}

function messageListener (evt) {
    console.log('evt.data');
    console.log(evt.data);

    if (evt.data != null && evt.data == "zoom-out") {
        document.getElementById("ringer-popup").classList.toggle("fullscreen");
    }else if(evt.data != null && evt.data == "onchat-mobile"){
        var close = document.getElementById("btn-vpx-close");
        if (close.style.display === "none") {
            close.style.display = "block";
        } else {
            close.style.display = "none";
        }
    }else if(evt.data != null && evt.data == "what-width-device"){
        var widthDevice = window.innerWidth;
        var iframe = document.getElementById("iframe-vpx").contentWindow;
        iframe.postMessage(widthDevice, "*");
    }
    else if(evt.data != null && evt.data == "vpx-close"){
        close_channels();
    }
}


function show_channels() {
    console.log("show");
    var element = document.getElementById("ringer-vpx");
    element.className = "ringer-vpx-active";
    document.getElementById("btn-vpx-show").style.display = "none";
    document.getElementById("btn-vpx-close").style.display = "block";
    var iframe = document.getElementById("iframe-vpx");
    iframe.style.display = "block";

    element.classList.add("magictime");
    element.classList.add("spaceInDown");


}

function close_channels() {
    console.log("close");
    document.getElementById("ringer-vpx").className = "ringer-vpx";
    document.getElementById("btn-vpx-show").style.display = "block";
    document.getElementById("btn-vpx-close").style.display = "none";
    var iframe = document.getElementById("iframe-vpx");
    iframe.style.display = "none";
    iframe.src += ''; // reset frame

    document.getElementById("ringer-popup").classList.remove("fullscreen");
    
    iframe.contentWindow.postMessage('bye_call', "https://ringer.biz");
}