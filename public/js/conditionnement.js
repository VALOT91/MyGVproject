
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

 
  
  //dialog box 
  // $(document).ready(function() { 
     
  //    $( "#dialog" ).dialog({  autoOpen: false,
  //         height: 400,
  //         width: 550,
  //         modal: true, });

  //     $( "#opener" ).click(function() 
  //      {  
        
  //       $( "#dialog" ).dialog( "open" );
        
  //      });
  //   });

  //  $(document).ready(function() {
 
     
    //  var dialog2 = $("#dialog-form2").dialog({
    //     autoOpen: false,
    //     height: 400,
    //     width: 550,
    //     modal: true,
    // });

    
   
      // $('#dialog1').click(function () { 
      //   alert("lll") ;
      //      dialog.dialog( "open" );
      // });

          
        // $('#dialog2').click(function () {   
            
        //     dialog2.dialog( "open" );
        // });
     
       //  -----------------------------------------------
  
        //   let dialog = $("#dialog-form").dialog({
        //   autoOpen: false,
        //   height: 400,
        //   width: 550,
        //   modal: true,
          
        //  });

          // $('#dialog1').click(function () { 
          //   alert("lll2") ;
         //   dialog.dialog( "open" ); 
          

      //     });

      // });
       
  
          

      // $('#dialog2').click(function () {   
       
      //       dialog2.dialog( "open" );

            
      //   });

   
    // var dialog = $("#dialog-form").dialog({
    //     autoOpen: false,
    //     height: 400,
    //     width: 550,
    //     modal: true,
    //   });
  // Gestion de la selection images
  
//   function selectImage(th){

//      id = "#linkIm" + th.id.split("Im")[1];
//      path = document.querySelector(id).innerHTML;
//      document.querySelector("#produitConditionnementIm").setAttribute("src","\\uploads\\images\\" + path);
//      document.querySelector("#produit_conditionnement_image_path").value = "\\uploads\\images\\" + path;
//      $('#dialog-form').dialog("close");

//   }

//   function selectImageCond(th){

//     id = "#linkIm" + th.id.split("Im")[1];
//     path = document.querySelector(id).innerHTML;
//     document.querySelector("#ConditionnementIm").setAttribute("src","\\uploads\\images\\" + path);
//     document.querySelector("#conditionnement_image_path").value = "\\uploads\\images\\" + path;
//     $('#dialog-form2').dialog("close");

// }
 
 