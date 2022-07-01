  const addCart = (idprd)=>{

       alert(idprd);
      
        $.ajax({
            type: "POST",
            //method: "POST",
            url: "{{ path('cart_add') }}",
            data: { id: idprd }
        })
        .fail(function( data ) {
            alert( "Data fail: " + data );
        })
        .done(function( data ) {
            alert( "Data Saved: " + data );
        });
       
     


 }


 