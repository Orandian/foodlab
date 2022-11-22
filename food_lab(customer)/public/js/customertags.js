$(document).ready(function() {
    var types = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
        
    prefetch: {
        url : "/tags"
    }

    });

   
    types.initialize();
    console.log(types);
    $('#tags').tagsinput({
        typeaheadjs: {
          name: 'types',
    
          source: types.ttAdapter()
        }
    });
    
    

});
