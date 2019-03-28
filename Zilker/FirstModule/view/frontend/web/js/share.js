define(['uiComponent','ko'], function(Component, ko) {
     'use strict';
     let self; 
     return Component.extend({
        categories: ko.observableArray([
            { name: 'Fruit', items: [ 'Apple', 'Orange', 'Banana' ] },
            { name: 'Vegetables', items: [ 'Celery', 'Corn', 'Spinach' ] }
        ]),
        
          initialize: function() { 
              self = this;
              console.log('Hello from KnockoutJS!');
              this.myMessage.subscribe(function(value) {
                  console.log("value is ", value);
                  
              });

              this.categories()[0]['items'].push('New Object');
              this.categories.valueHasMutated();
              this.categories.subscribe(function(value){
                // value[0]['items'].push('Mango');    
                console.log(value);
              });
            //   
           // this.categories()[0]['items'].push('New Object 1');



             },
             myMessage: ko.observable('hi'),
             shouldShowMessage:ko.observable(false),
             details:ko.observable('<b>This is from Html Bidings </b>'),
             getClass: ko.observable('success'),
             showColor:   ko.observable('blue'),
             isSuccess: ko.observable(true),
             url: ko.observable("year-end.html"),
             details: ko.observable("Report including final year-end statistics"),
             items: ko.observableArray(['male','female']),
             Objitems: ko.observableArray([
                 {name: 'Male', value: 'male'},
                 {name: 'Female', value: 'female'}
                ]),

            columns: ko.observableArray(['First Name','lastName','Full Name']),
            tabledata: ko.observableArray([
                {firstName: 'santhosh', lastName: 'Kumar'},
                {firstName: 'Arvind', lastName: 'G'},
                {firstName: 'suresh', lastName: 'Kumar'}
            ]),
            addCategoryItem: function(){
                console.log('added');
                self.categories()[0]['items'].push('New Object on Button Click');
                self.categories.valueHasMutated()
                self.categories.push({name: 'Snacks', items: [ 'Samosa']})
            }
            
            
        });
 });

