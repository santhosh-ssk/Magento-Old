define(['uiComponent','ko'], function(Component, ko) {
    'use strict';
    let self; 
    let lastId = 0;
    return Component.extend({
         initialize: function() { 
             self = this;
            },
            
            contacts:ko.observableArray(),
            
            /** Adds a contact */
            addContact: function(){
                this.contacts.push({
                    itemId: lastId+1
                });
                lastId++;
                // console.log(this.contacts());
            },

            /** function to delete contacts */
            deleteContact: function(contact){
                self.contacts.remove(contact)
            }
       });
});

