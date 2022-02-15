
/*Header JQuery*/
/*$(function () {
    $(window).on('scroll', function () {
        if ( $(window).scrollTop() > 10 ) {
            $('.navbar').addClass('active');
        } else {
            $('.navbar').removeClass('active');
        }
    });
});*/

/*call the 1st lightSlider JQuery*/
$(document).ready(function() {
    $("#content-slider").lightSlider({
        loop:true,
        keyPress:true
    });
    $('#image-gallery').lightSlider({
        gallery:true,
        item:1,
        thumbItem:9,
        slideMargin: 0,
        speed:500,
        auto:true,
        loop:true,
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }  
    });
});

/*call the 2nd lightSlider JQuery*/
$(document).ready(function() {
    $("#content-slider2").lightSlider({
        loop:true,
        keyPress:true
    });
    $('#image-gallery').lightSlider({
        gallery:true,
        item:1,
        thumbItem:9,
        slideMargin: 0,
        speed:500,
        auto:true,
        loop:true,
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }  
    });
});

/* display block du formulaire de connexion*/
let inputMail = document.getElementById("inputMail");
inputMail.addEventListener("click",function(){
    let popbox = document.getElementById("popbox");
    popbox.style.display="block";
});
let inputPwd = document.getElementById("inputPwd");
inputPwd.addEventListener("click",function(){
    let popbox = document.getElementById("popbox");
    popbox.style.display="block";
});
/* display none du formulaire de connexion*/
document.addEventListener("click",function(event){
    let popbox = document.getElementById("popbox");
    if (!event.target.matches('.saisieConnexion')) {
        popbox.style.display="none";
    }
});

/*Rendre le password visible/invisible dans le header */
let hidePwd=1;
function accesPassword() {
    if (hidePwd==1) {
        document.getElementById("inputPwd").type="text";
        document.getElementById("hidePwd").className="far fa-eye-slash";
        hidePwd++;
    }else{
        document.getElementById("inputPwd").type="password";
        document.getElementById("hidePwd").className="far fa-eye";
        hidePwd=1;
    }   
}

/*Rendre le password visible/invisible pour la page connexion */
function accesPassword2() {
    if (hidePwd==1) {
        document.getElementById("inputPwd2").type="text";
        document.getElementById("hidePwd2").className="far fa-eye-slash";
        hidePwd++;
    }else{
        document.getElementById("inputPwd2").type="password";
        document.getElementById("hidePwd2").className="far fa-eye";
        hidePwd=1;
    }   
}

/*onchange du select pour appeler les villes du formulaire d'inscription selon le code du département*/
function selectDpt(idDpt) {
    alert(idDpt);
}
