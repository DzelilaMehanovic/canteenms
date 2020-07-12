var Orders = {
  get_orders : function(){
    RestClient.get("orders",  function(data){
      Utils.datatable("orders_table",[
        {'data':'id','title': 'ID', "defaultContent": ""},
        {'data':'name','title': 'Name', "defaultContent": ""},
        {'data':'amount', 'title': 'Amount', "defaultContent": ""},
        {'data':'price', 'title': 'Price', "defaultContent": ""},
        {'data':'status', 'title': 'Status', "defaultContent": ""},
        {'data':'date', 'title': 'Date', "defaultContent": ""},
        {'data':'delete_order', 'title': 'Delete', "defaultContent": ""}
      ], data);
    }, function(data){
      toastr.error(data.responseText);
    });
  },

   delete_order : function(id){
     RestClient.delete('orders/'+id, function(data){
       toastr.success(data);
       Orders.get_orders();
     }, function(data){console.log(data);
       toastr.error('Order was not deleted');
     })
   },

   finish_order : function(id){
     RestClient.PUT('orders/',{id:id}, function(data){
       toastr.success(data);
       Orders.get_orders();
     }, function(data){console.log(data);
       toastr.error('Order was not updated');
     })
   }
}
