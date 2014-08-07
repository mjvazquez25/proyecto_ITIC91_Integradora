/*
 * Arreglos express
 * julio 2014
 **/

$(document).ready(function(){    

    /*init slider de imagenes....*/
    $("#myController").jFlow({
        controller: ".jFlowControl", // must be class, use . sign
        slideWrapper : "#jFlowSlider", // must be id, use # sign
        slides: "#mySlides",  // the div where all your sliding divs are nested in
        selectedWrapper: "jFlowSelected",  // just pure text, no sign			
        effect: "flow", //this is the slide effect (rewind or flow)
        width: "880px",  // this is the width for the content-slide
        height: "300px",  // this is the height for the content-slider
        duration: 400,  // time in milliseconds to transition one slide			
        pause: 5000, //time between transitions
        prev: ".jFlowPrev", // must be class, use . sign
        next: ".jFlowNext", // must be class, use . sign
        auto: true	
    });
});

