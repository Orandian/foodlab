/*
 * Create : Aung Min Khant(29/1/2022)
 * Update :
 * Explain of function : To count product and show in cart 
 * Prarameter : no
 * return :
 */
$(document).ready(function() {
    let temArray = [];
    $('.shopcart').click(function(e) {

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        let count = 1;
        if (temArray.includes(e.target.id) == false) {
            temArray.push(e.target.id);

        }


        console.log(temArray);
        console.log(count);
        e.preventDefault();

        let formdata = { "pid": Number(e.target.id), "q": Number(count), "value": [] };

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


        $('.shop').click(function() {
            console.log(temArray);
        });

    });


});




function checkSameId(id) {
    let tempArray = [];
    if (tempArray.includes(id) == false) {
        tempArray.push(id);
    }

    console.log(tempArray);
}