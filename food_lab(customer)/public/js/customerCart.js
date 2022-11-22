let minus = document.querySelectorAll('.minus'),
    plus = document.querySelector('.plus');

let cashel = document.querySelectorAll('.cash'),
    coinel = document.querySelectorAll('.coin'),
    totalCoin = document.querySelector('.totalCoin'),
    totalCash = document.querySelector('.totalCash'),
    delCoin = document.querySelector('.delCoin'),
    delCash = document.querySelector('.delCash'),
    grandCoin = document.querySelector('.grandCoin'),
    grandCash = document.querySelector('.grandCash');

let order = document.querySelector('.order'),
    products = document.querySelectorAll('.products'),
    nums = document.querySelectorAll('.num');


// Coin switch
function leftClick() {
    var btnSwitch = document.getElementById('btnSwitch');
    var coinBox = document.querySelectorAll('.coinBox');
    var cashBox = document.querySelectorAll('.cashBox');
    var coinDiv = document.querySelectorAll('.coinDiv');
    var cashDiv = document.querySelectorAll('.cashDiv');

    btnSwitch.style.left = '0px';
    console.log(cashBox.length);
    for (let index = 0; index < cashBox.length; index++) {
        cashBox[index].style.display = 'none';
    }
    for (let index = 0; index < cashDiv.length; index++) {
        cashDiv[index].style.display = 'none';
    }
    for (let index = 0; index < coinBox.length; index++) {
        coinBox[index].style.display = 'block';
    }
    for (let index = 0; index < coinDiv.length; index++) {
        coinDiv[index].style.display = 'block';
    }
}
// Cash switch
function rightClick() {
    var btnSwitch = document.getElementById('btnSwitch');
    var coinBox = document.querySelectorAll('.coinBox');
    var cashBox = document.querySelectorAll('.cashBox');
    var coinDiv = document.querySelectorAll('.coinDiv');
    var cashDiv = document.querySelectorAll('.cashDiv');

    btnSwitch.style.left = '50%';
    for (let index = 0; index < cashBox.length; index++) {
        cashBox[index].style.display = 'block';
    }
    for (let index = 0; index < cashDiv.length; index++) {
        cashDiv[index].style.display = 'block';
    }
    for (let index = 0; index < coinBox.length; index++) {
        coinBox[index].style.display = 'none';
    }
    for (let index = 0; index < coinDiv.length; index++) {
        coinDiv[index].style.display = 'none';
    }
}


$(document).on('click', '.delete', (e) => {
    console.log(e.target.id);
    $('.delete-confirms').attr('id',`${e.target.id}`);
});

document.querySelector('.delete-confirms').addEventListener('click',function (e){
    console.error(e.target.id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'POST',
        url: '/deleteProduct',
        data: { 'id': e.target.id },

        success: function(res) {
            window.location.href = '/cart';
            console.log(res);
        },
        error: function(err) {
            console.error(err);
        }
    })
});


let calAmount = () => {
    let productTotalCoin = 0,
        productTotalCash = 0;
    for (let i = 0; i < cashel.length; i++) {
        productTotalCoin += Number(coinel[i].textContent);
        productTotalCash += Number(cashel[i].textContent);
    }
    totalCoin.textContent = productTotalCoin;
    totalCash.textContent = productTotalCash;
    grandCoin.textContent = productTotalCoin + Number(delCoin.textContent);
    grandCash.textContent = productTotalCash + Number(delCash.textContent);
};

calAmount();


$(document).on('click', '.minus', function(e) {
    console.log(cashel.length);
    let quantity = e.originalEvent.path[3].childNodes[7].childNodes[1].childNodes[3],
        coin = e.originalEvent.path[3].childNodes[9].childNodes[1].childNodes[1],
        cash = e.originalEvent.path[3].childNodes[9].childNodes[3].childNodes[0];
    let eachCoin = 0,
        eachCash = 0,
        productCoin = 0,
        productCash = 0;
    if (quantity.textContent > 1) {
        eachCoin = coin.textContent / quantity.textContent;
        eachCash = cash.textContent / quantity.textContent;

        quantity.textContent = --quantity.textContent;

        productCoin = Number(coin.textContent) - eachCoin;
        productCash = Number(cash.textContent) - eachCash;

        coin.textContent = productCoin;
        cash.textContent = productCash;

        calAmount();
    } else {
        alert("Please buy this product again!");
    }
});

$(document).on('click', '.plus', function(e) {
    let quantity = e.originalEvent.path[3].childNodes[7].childNodes[1].childNodes[3],
        coin = e.originalEvent.path[3].childNodes[9].childNodes[1].childNodes[1],
        cash = e.originalEvent.path[3].childNodes[9].childNodes[3].childNodes[0];
    let eachCoin = 0,
        eachCash = 0,
        productCoin = 0,
        productCash = 0;

    if (quantity.textContent < 9) {
        eachCoin = coin.textContent / quantity.textContent;
        eachCash = cash.textContent / quantity.textContent;

        quantity.textContent = ++quantity.textContent;

        productCoin = Number(coin.textContent) + eachCoin;
        productCash = Number(cash.textContent) + eachCash;

        coin.textContent = productCoin;
        cash.textContent = productCash;

        calAmount();
    } else {
        alert("You can buy this product in 9 times.");
    }
});


order.addEventListener('click', function() {
    let cart = [],
        product = {};

    for (let i = 0; i < products.length; i++) {
        product = {
            "q": nums[i].textContent
        };
        cart.push(product);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: "/cart",
        data: { 'cart': cart },
        success: function(res) {
            window.location.href = '/deliveryInfo';
        },
        error: function(err) {
            console.error(err);
        }
    });
});
