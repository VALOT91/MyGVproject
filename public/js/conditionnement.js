
// permet d'alimenter la balise prix ttc apré avoir choisi le conditionnement
function choice(m)
{  
    let prDisplay  =  document.getElementById("sel_" + m.name);  
    let proDisplay  =  document.getElementById("selp_" + m.name);
    let btPan = document.getElementById("pan_" + m.name);
    let imDisplay = document.getElementById("img_" + m.name);
    
    prDisplay.innerHTML ="";
    proDisplay.innerHTML ="";
   
   try{
      btPan.setAttribute("href", "/panier/ajouter/" + m.id );
   }
   catch(e)
    { 
      alert(e);

    }
 
   
  let prChoice  =  document.getElementById("PP_" + m.id);
  let proChoice  =  document.getElementById("PR_" + m.id);
  let imChoice  =  document.getElementById("IM_" + m.id);
  
  prDisplay.innerHTML = prChoice.innerHTML;
  proDisplay.innerHTML = proChoice.innerHTML; 
  imDisplay.setAttribute("src", imChoice.innerHTML ); 
  
  
 }

 document.addEventListener("DOMContentLoaded", function(){
        
  var cond = document.querySelectorAll('.condit');

  cond.forEach(function(Item) {
    Item.click();
  });
    
  
});



let prodId =  document.getElementById("produit_conditionnement_produit"); 
let condId =  document.getElementById("produit_conditionnement_conditionnement");  
let reference = document.getElementById("produit_conditionnement_reference");

  prodId.addEventListener("change", function(e){
  
    let produit = this.options[this.selectedIndex].text.split(" - ");
    let conditionnement = condId.options[condId.selectedIndex].text.split(" - ");

    reference.value=produit[0] + conditionnement[0]
  },false);

  condId.addEventListener("change", function(e){
  
    let conditionnement = this.options[this.selectedIndex].text.split(" - ");
    let produit = prodId.options[prodId.selectedIndex].text.split(" - ");
   
    reference.value=produit[0] + conditionnement[0]
  },false);

//  ---------------------- scroll

 
 var button = document.getElementById('slide');
 
  function sdf() {
     var container =  document.getElementById('containerSC');
     sideScroll(container,'right',25,100,10);
 };

 var back = document.getElementById('slideBack');
 function sdb() {
 
     var container = document.getElementById('containerSC');
     sideScroll(container,'left',25,100,10);

     
 };

 function sdfl(th) {   ;
  var container =   document.getElementById('containerSC'+th.id.split("btr_")[1]);
   
  sideScroll(container,'right',25,200,5);
};

var back = document.getElementById('slideBack');
function sdbl(th) {  

  var container =  document.getElementById('containerSC'+th.id.split("btl_")[1]);
  sideScroll(container,'left',25,200,5);

  
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

 
  
  