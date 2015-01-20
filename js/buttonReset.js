$(":reset").click(function(){
    try{
        event.preventDefault();
        $(this).closest('form').get(0).reset();     
        $(this).closest('form').find('.selectpicker').select2('data', null);
        $(this).closest('form').find(":input").each(function() {
           var type = this.type;
           var tag = this.tagName.toLowerCase();
           if (type === "text" || type === "password" || tag === "textarea") this.value = "";
           else if (type === "checkbox" || type === "radio") this.checked = false;
           else if (tag === "select") this.selectedIndex = "";
         });
    }catch(err){
            
    }
});