$(function(){
        $('form[name=edit_page]').submit(function(){
            var meta_d = $('input[name=meta_d]').val();
            var descr = $('textarea[name=descr]').val();
            if(meta_d =='' || descr == ''){
                alert("Լրացրեք պարտադիր լրացման դաշտերը:");
                return false;
            }
        })
    
    $('form[name=add_news]').submit(function(){
            var title = $('input[name=title]').val();
            var descr = $('textarea[name=descr]').val();
            if(title =='' || descr == ''){
                alert("Լրացրեք պարտադիր լրացման դաշտերը:");
                return false;
            }
        })
    
     $('form[name=edit_news]').submit(function(){
            var title = $('input[name=title]').val();
            var descr = $('textarea[name=descr]').val();
            if(title =='' || descr == ''){
                alert("Լրացրեք պարտադիր լրացման դաշտերը:");
                return false;
            }
        })
        
    $("a.delete").click(function(){
        var ok = confirm("Դուք պատրաստվում եք հեռացնել այս նորությունը;");
        if(!ok){
            return false;
        }
    })
    
    });