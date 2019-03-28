function removeProduct(prodId){
    console.log(prodId);
    let url = window.location.origin + '/magento-2/project-enterprise-edition/testpage/customer_favoriteitems/delete/prodId/'+prodId;
    require(['jquery'],function($){
        $.ajax({
            url: url,
            data: JSON.stringify({
            }),
            method: 'DELETE',
            contentType: 'application/json',
            dataType: 'json',

        }).done(function(response){
            if(response['isSuccess']){
                prodId = "#product-"+prodId;
                $(prodId).remove();
            }
        }).fail(function(xhr,status,error){
            console.log('Status: '+status+' Error: '+error);
        })
    });
}