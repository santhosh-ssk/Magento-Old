
let baseAddr = '/magento-2/project-enterprise-edition';

function addToFavorites(prodId){
    // console.log(prodId);
    require(['jquery'],function($){
        let url = baseAddr + '/testpage/customer_favoriteitems/add'; 
        $.post(url,{prodId:prodId},function(response){
            console.log(response);
        });
    });
}