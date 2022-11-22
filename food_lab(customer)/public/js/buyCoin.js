$(document).ready(function () {

var modal = document.getElementById('modal5');
var modal2 = document.getElementById('modal6');
var coinInput = document.getElementById('ccalcul');
var mmkInput = document.getElementById('mmkcalcul');
var coinRate = document.getElementById('coinratedata');
var coinChargeinput= document.getElementById('coinChargeinput');
var fileimginput=document.getElementById('formFile');
var reset= document.getElementById('reset');
var error=document.getElementById('errorBox');
var submit = document.getElementById('submitbtn');
var coin_body = document.getElementsByClassName('coins');
var mmk = document.getElementsByClassName("mmk");
var aftercoinSum=0;
var aftermmkSum=0;

coinInput.addEventListener("keyup" , function (){
    aftercoinSum = coinInput.value * coinRate.innerHTML;
    mmkInput.value= aftercoinSum;
    coinChargeinput.value=coinInput.value; 
})
coinChargeinput.addEventListener("keyup" , function (){
    aftercoinSum = coinChargeinput.value * coinRate.innerHTML;
    mmkInput.value= aftercoinSum;
    coinInput.value=coinChargeinput.value; 
})

mmkInput.addEventListener("keyup" , function (){
    aftermmkSum = mmkInput.value/coinRate.innerHTML;
    coinInput.value = aftermmkSum;
    coinChargeinput.value=coinInput.value; 
})
reset.addEventListener("click" , function (){
    coinChargeinput.value="";
    coinInput.value="";
    mmkInput.value="";  
    fileimginput.value="";

})
coinChargeinput.addEventListener('input',validate);
fileimginput.addEventListener('input',validate);


$('#submitbtn').click(function(e){
    e.preventDefault();

    
    let coins = $('#coinChargeinput').val();
    let sum = $('#mmkcalcul').val();
    let result =`<span><i class="fas fa-check-circle text-success mx-2"></i></span>
    <span> Do you want to buy ${coins} coins for ${sum} MMK?</span>`;
   
    $('#coins').append(result);

    

});

$('.backBtn').click(function(){
    coinChargeinput.value="";
    coinInput.value="";
    mmkInput.value="";  
    fileimginput.value="";
    
    validate();
    $('#coins').empty();
});

$('#backSite').click(function(){

    location.reload();
})


$('#coinchargeform').on('submit',function(e){
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                "content"
            ),
        },
    })

    $.ajax({
        type : "POST",
        url : "buycoinForm",
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        beforeSend: function(){
            
        },
        success : function(data){
             $('#modal6').modal('show');
        },
        error : function(request){
            
            $('#coins').empty();
          
            let errors = request.responseJSON.errors;
            
            if(errors['coinput'].length > 0){
                let   err = ` <p class="text-danger" >${errors['coinput']}</p>`;
                $('#coindiv').append(err);   
            }
         
            if(errors['fileimage'].length > 0){
                let image = errors['fileimage'].toString();
                     let  err2 = `<p class="text-danger">${image}</p>`;
                $('#imagediv').append(err2);
            }
           
        }

    });
});

function validate(){

    if(coinChargeinput.value === "" ||  fileimginput.value === ""){
        submit.setAttribute("disabled","disabled");
    }else{
        submit.removeAttribute("disabled"); 
    }
}


});



