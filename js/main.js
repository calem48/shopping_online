

$(document).ready(function () {
'use strict';
/*
$('.carousel-item').height($(window).height());

$(window).resize(function () { 
    $('.carousel-item').height($(window).height());
});
*/

//var wind   = $(window).innerWidth();

var winH   = $(window).height(),
    upperH = $('.upper-bar').innerHeight(),
    navH   = $('.navbar').innerHeight();

$('.slider  .carousel-item').height(winH -( upperH + navH ));

$('#form_login').submit(function(envent){

    

    $.ajax({
        method:'POST',
        url:'include/login_config.php',
        data:$(this).serialize(),
             
        success: function(data){
            $('#msg').html(data);
            
          }

    });

    envent.preventDefault();

});
/*});

$(document).ready(function () {*/
     
    //$('.add_to_cart').click( function () {
        $(document).on('click', '.add_to_cart', function(){  

		console.log(this);
        var product_id      = $(this).attr('id');
        var product_name    = $('#name' + product_id ).val();
        var product_qte     = $('#qte'+product_id ).val();
        var product_price   = $('#price'+product_id ).val();
        var action          = "add";
        

        $.ajax({
            
            url:"include/cart_config.php",
            method:"POST",
            dataType:"json",
            data:{
                product_id      : product_id,
                product_name    : product_name,
                product_qte     : product_qte,
                product_price   : product_price,
                action          : action
            },
                 
            success: function(data){
               alert(data.e);
                
                $('#idn').html(data.cart_item);//afficher counter in page header
                console.log(data);
                //$('#msg').html(data.cart_item);
               // $('#tb').html(data.order_table);
                
              }
    
        });
    
    
    });


    $(document).on('click', '.delete', function(){  

        var product_id =$(this).attr("id");
        var action= "remove";
        
        if(confirm("Are you sure you want to remove this product?")){
        $.ajax({
            method: "POST",
            url : "include/cart_config.php",
            dataType:"json",
            data:{
                product_id:product_id,
                action:action
            },
            success: function (data) {
                //alert(data.order_table)
               
               // $('#trt').html(data);
                
               // alert($('#tb').html(data.order_table));
              //$('#tb').html(data.order_table);
                $('#trt').html(data.order_table);
                $('#idn').html(data.cart_item);
               
            }



        });
    }  
    else  
    {  
         return false;  
    } 
        
    });



    $(document).on('keyup','.qte',function() {

       var product_id = $(this).data("product_id");
       var qte= $(this).val();
       var  action="update_qte";
        //alert(product_id);

      if(qte != ''){
        $.ajax({
            url : "include/cart_config.php",
            method:'POST',
            dataType:"json",
            data:{
                product_id:product_id,
                qte:qte,
                action:action

            },
            success: function (data) {
               // alert("suuces");
                //$('#tb').html(data.order_table);
                //alert("suuces");
               $('#trt').html(data.order_table);
               
            }

        })};
        
        
    });



    $("#modelSubmit").submit(function(e) {
        e.preventDefault();

        var tele = $('#tele').val();
        var address = $('#address').val();
        var inputCity = $('#inputCity').val();
        var inpuState = $('#inpuState').val();
        var inputZip = $('#inputZip').val();
       
        $.ajax({

            url:"order.php",
            method:"post",
            data:{
                tele:tele,
                address:address,
                inputCity:inputCity,
                inpuState:inpuState,
                inputZip:inputZip
            },
            success: function(data) {
                
                $('.cart_msg').html(data);
            }

        });

         
     });



     $(".edit").on('click',function() {
        var id= $(this).data("id");

        $("#cat_edit").submit(function(e) {
           e.preventDefault();
            
            var enameCate=$("#enameCate").val();
            var etag=$("#etag").val();
           var action="edit";

           $.ajax({
            url:"include/edit.php",
            method:"post",
            data:{id:id,enameCate:enameCate,etag:etag,action:action},
            success:function(data) {
                $("#msg").html(data);
               // window.location.href="categorie.php";
                //window.location.href="categorie.php";
                $(".cl").click(function() {
                    window.location.href="categorie.php";
                })
            }

        });

        });

     });


     $("#itemadd").submit(function(e){

       var formData  = new FormData(this);
       //alert(formData.get("file")["type"]);
        $.ajax({
            method:"POST",
            url:"include/item_config.php",
            processData: false,
            contentType:false,//multipart/form-data
            //cache: false,
            data: formData ,
            //dataType: 'json',
            success:function(data){
                $("#msg").html(data);
            },
            
           

        });
        e.preventDefault();
     });


     $('.order-model').on('click',function () {
        var id =$(this).data("id");
        var action="order-dteails";
        $.ajax({
            method:"POST",
            url:"order-details.php",
            dataType:"json",
            data:{id:id,action:action},
            success:function(data) {
               $(".res_order").html(data.table);
            }
        });

     });


     $('.info-user').on('click',function () {
        var id =$(this).data("id");
        var action="info-user";
        
        $.ajax({
            method:"POST",
            url:"order-details.php",
            dataType:"json",
            data:{id:id,action:action},
            success:function(data) {
                
               $(".table-info").html(data.table);
            }
        });

     });
   





});



  