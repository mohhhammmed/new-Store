
  $(document).on('click','.shoppingCart',function(e){
    e.preventDefault();
    var subcategory_id=$(this).attr('get_id');

       $.ajax({
              type:'POST',
              url:"{{route('shopping_cart')}}",
              data:{
                 'subcategory_id':subcategory_id,
                 '_token':"{{csrf_token()}}",
              },

              success:function(data){
                if(data.status==true){
                    var added=document.querySelector('div#addToCart'+subcategory_id),
                        counter=document.querySelector('span#cartStyle');
                    counter.textContent++;
                    added.textContent='Category is added';
                    added.style='color:#9e030b; font-size:15px; background-color:rgb(238 242 243) !important;font-weight: bolder';

                }
              }
         });
   });
