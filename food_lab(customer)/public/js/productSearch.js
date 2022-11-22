/*
 * Create : Aung Min Khant(18/3/2022)
 * Update :
 * Explain of function : To search engine product
 * Prarameter : no
 * return :
 */

$(document).ready(function () {

    $('#form1').unbind().keyup(function(e){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })
        console.log($('#form1').val());
        var searchName = {name : $('#form1').val()};

        $.ajax({
            type : "POST",
            url : "searchFood",
            data: searchName,
            dataType: "json",
            beforeSend: function(){
                    $('.icons').hide();
                    $('.loader').show();
                    $('.searchEngine').empty();
            },  
            success: function(data){

                $('.loader').hide();
                $('.icons').show('slow');
                $('.searchEngine').empty();
                for( const list of data ){
                       
                      $('.searchEngine').append(`
                    <option value="${list.value}"><span class="hello">${list.name}</span> </option>` );
              
                    
                }
            },
            error: function(data){
                console.log(data);
            }
        
        });


    });


    document.getElementById('form1').addEventListener('input',function(e){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })

        if(e.inputType == "insertReplacementText" || e.inputType == null) {
           
    
            var formdata = { name : e.target.value};


            $.ajax({
                type : "POST",
                url : "specificFood",
                data: formdata,
                dataType: "json",
                beforeSend: function(){
                    $('#byCategory').empty();
                    $("#byCategory").hide('slow');
                    $('.loading').show();
                    $('#form1').blur();
                    $('.searchEngine').empty();
                },
                success: function(data){
                    $('#form1').blur();
                    $('.loading').hide('slow');
                  $("#byCategory").empty();
                 
                  $('#byCategory').show('slow');
                    
                  if(data.length == 0){
                    $('#byCategory').append(`
                        <div class="d-flex justify-content-center align-items-center p-3"
                                <p >There is no food in this category. We will announce later.</p>
                        </div>
                    `);
                }
                  for (const list of data) {
                    let amount = numberWithCommas(list.amount);
                    if(customerId){
                        
                     $('#byCategory').append(
                         `<div class="food  m-3">
                         <div class="pic mt-2 d-flex justify-content-center align-items-center">
                          <img src="${list.path}" alt="">
                
                         </div>
                         <div class="detail ">
                         <a href="productDetail?id=${ list.link_id}" class="title fw-bold ms-3 my-3 fs-4">${ list.product_name }</a>
                         <div class="fw-bold  text-white ms-3 fs-5 ">
                                <i class="fas fa-coins me-2 coins"></i>
                                ${ list.coin }
                                <br>
                                <i class="fa-solid fa-money-bill money text-success"></i>
                                ${amount} Ks
                            </div>
                            <div class="slide">
                            </div>
                            <div class="price fw-bolder fs-4  p-2">
                            <button type="button" id="${list.link_id}" class="shopcart"
                            data-bs-toggle="modal" data-bs-target="#modal">SHOP</button>
                            </div>
                            </div>
                        </div>
                         `)
                    }else{
                     $('#byCategory').append(
                         `<div class="food  m-3">
                         <div class="pic mt-2 d-flex justify-content-center align-items-center">
                          <img src="${list.path}" alt="">
                
                         </div>
                         <div class="detail ">
                         <a href="productDetail?id=${ list.link_id}" class="title fw-bold ms-3 my-3 fs-4">${ list.product_name }</a>
                         <div class="fw-bold  text-white ms-3 fs-5 ">
                                <i class="fas fa-coins me-2 coins"></i>
                                ${ list.coin }
                                <br>
                                <i class="fa-solid fa-money-bill money text-success"></i>
                                ${amount} Ks
                            </div>
                            <div class="slide">
                            </div>
                            <div class="price fw-bolder fs-4  p-2">
                            <a href="/signin" class="order_food">SHOP</a>
                            </div>
                            </div>
                        </div>`)
                    }
                  }

                  $('.shopcart').click(function(e) {

                    $.ajaxSetup({
                        headers: {
                            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                    });
                    e.preventDefault();
                    let count = 1;
                    let formdata = { "pid": Number(e.target.id), "q": Number(count) };
            
                    $.ajax({
                        type: "POST",
                        url: "sessionCount",
                        data: { data: formdata },
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
            
            
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
            
                });
                },
                error: function(data){
                    console.log(data);
                }
            
            });
        }
    });
    function sendData(){

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        })

        let formdata = {name : $('#form1').val(),
                category : $("#selectpicker1").val(),
                  taste : $("#selectpicker2").val(),   
                };
        console.log(formdata);
        $.ajax({
            type : "POST",
            url : "searchFoodName",
            data : formdata,
            dataType : 'json',
            beforeSend :function(){
                $('#byCategory').empty();
                $("#byCategory").hide('slow');
                $('.loading').show();
                $('.searchEngine').empty();
            },
            success :function(data){
                $('.loading').hide('slow');
                $("#byCategory").empty();
                 
                $('#byCategory').show('slow');
                  
                if(data.length == 0){
                    $('#byCategory').append(`
                        <div class="d-flex justify-content-center align-items-center p-3"
                                <p >There is no food in this category. We will announce later.</p>
                        </div>
                    `);
                }
                for (const list of data) {
                  let amount = numberWithCommas(list.amount);
                  if(customerId){
                   $('#byCategory').append(
                       `<div class="food  m-3">
                       <div class="pic mt-2 d-flex justify-content-center align-items-center">
                        <img src="${list.path}" alt="">
              
                       </div>
                       <div class="detail ">
                       <a href="productDetail?id=${ list.link_id}" class="title fw-bold ms-3 my-3 fs-4">${ list.product_name }</a>
                       <div class="fw-bold  text-white ms-3 fs-5 ">
                              <i class="fas fa-coins me-2 coins"></i>
                              ${ list.coin }
                              <br>
                              <i class="fa-solid fa-money-bill money text-success"></i>
                              ${amount} Ks
                          </div>
                          <div class="slide">
                          </div>
                          <div class="price fw-bolder fs-4  p-2">
                          <button type="button" id="${list.link_id}" class="shopcart"
                          data-bs-toggle="modal" data-bs-target="#modal">SHOP</button>
                          </div>
                          </div>
                      </div>`)
                  }else{
                   $('#byCategory').append(
                       `<div class="food  m-3">
                       <div class="pic mt-2 d-flex justify-content-center align-items-center">
                        <img src="${list.path}" alt="">
              
                       </div>
                       <div class="detail ">
                       <a href="productDetail?id=${ list.link_id}" class="title fw-bold ms-3 my-3 fs-4">${ list.product_name }</a>
                       <div class="fw-bold  text-white ms-3 fs-5 ">
                              <i class="fas fa-coins me-2 coins"></i>
                              ${ list.coin }
                              <br>
                              <i class="fa-solid fa-money-bill money text-success"></i>
                              ${amount} Ks
                          </div>
                          <div class="slide">
                          </div>
                          <div class="price fw-bolder fs-4  p-2">
                          <a href="/signin" class="order_food">SHOP</a>
                          </div>
                          </div>
                      </div>`)
                  }
                }

                $('.shopcart').click(function(e) {

                  $.ajaxSetup({
                      headers: {
                          "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                              "content"
                          ),
                      },
                  });
                  e.preventDefault();
                  let count = 1;
                  let formdata = { "pid": Number(e.target.id), "q": Number(count) };
          
                  $.ajax({
                      type: "POST",
                      url: "sessionCount",
                      data: { data: formdata },
                      dataType: "json",
                      success: function(data) {
                      
                      },
                      error: function(data) {
                      
                      }
                  });
          
              });
            },
            error : function(data){
                console.log(data);
            }
        });
    }


    $('#form1').keypress(function(e){
        if(e.keyCode == 13) {
            sendData();
        }
    
        
    });
    $('.search').click(function(){
            sendData();
    });
   
    
  
});



function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

