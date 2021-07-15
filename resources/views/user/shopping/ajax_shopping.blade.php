
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
                var added=document.querySelector('div#addToCart'+subcategory_id),
                counter=document.querySelector('span#cartStyle');
                added.style='rgb(52 191 27); font-size:15px; background-color:rgb(238 242 243) !important;font-weight: bolder';

                if(data.status==true){
                    counter.textContent++;
                    added.textContent=data.msg;
                }
                   added.textContent=data.msg;
              }
         });
   });
{{-- </script> --}}
