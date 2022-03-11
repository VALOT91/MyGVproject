var button = document.getElementById('slide');
 
function sdf() {
   var container = document.getElementById('containerSC');
   sideScroll(container,'right',25,200,10);
};

var back = document.getElementById('slideBack');
function sdb() {

   var container = document.getElementById('containerSC');
   sideScroll(container,'left',25,200,10);
   
};

function sideScroll(element,direction,speed,distance,step){
   scrollAmount = 0; 
   var slideTimer = setInterval(function(){
       if(direction == 'left'){
           element.scrollLeft -= step;
       } else {
           element.scrollLeft += step;
       }
       scrollAmount += step;
       if(scrollAmount >= distance){
           window.clearInterval(slideTimer);
       }
   }, speed);
  
}