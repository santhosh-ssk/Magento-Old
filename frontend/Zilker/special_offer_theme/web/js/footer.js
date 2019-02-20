document.addEventListener('DOMContentLoaded',function(){
    let titles = document.getElementsByClassName('title');  
    let footer = document.getElementById('footer');
    for(let i=0;i<titles.length;i++){
        titles[i].setAttribute('data-toggle',0);
        titles[i].setAttribute('type','title');
    }

    let plus_icons = footer.getElementsByClassName('fa-plus');
    for(let i=0;i<plus_icons.length;i++){
        plus_icons[i].setAttribute('type','plus');
    }

    let minus_icons = footer.getElementsByClassName('fa-minus');
    for(let i=0;i<minus_icons.length;i++){
        minus_icons[i].setAttribute('type','minus');
    }

    footer.addEventListener('click',function(event){
        let element = event.target;
        let type    = element.getAttribute('type');
        if(type === 'plus' || type === 'minus' ){
            let close     = element.parentNode.parentNode;
            let container = element.parentNode.parentNode.parentNode.parentNode;
            let list = container.getElementsByTagName('ul')[0];
            list.classList.toggle('show');
            close.classList.toggle('show');
        }
        console.log(event.target);
        if(type=='title'){
            let close = element.getElementsByClassName('close')[0];
            let container = element.parentNode;
            let list = container.getElementsByTagName('ul')[0];
            close.classList.toggle('show');
            list.classList.toggle('show');
        }
        
    })

});


