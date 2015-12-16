/**
 * Created by Eddy on 16/12/2015.
 */

//met le footer en bas de la page
function footerDown(){


    //var bh = document.getElementsByName('body').offsetHeight; //document height here
    var hh = document.getElementById('header').offsetHeight; //header height
    var bh = document.getElementById('body').offsetHeight;
    var ch = document.getElementById('contenu').offsetHeight; //contenu height
    var fh = document.getElementById('footer').offsetHeight; //footer height
    var wh = (bh -ch- hh - fh); //this is the height for the wrapper

    document.getElementById('wrapper').style.height = wh+'px';

    //wrapper.css('min-height', wh); //set the height for the wrapper div
}
