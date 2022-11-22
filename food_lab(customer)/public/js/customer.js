let prices = document.querySelectorAll(".prices");

/*
 * Create : Min Khant(13/1/2022)
 * Update :
 * Explain of function : To separate thousand prices
 * Prarameter : string
 * return : thousand separator value
 * */
function addCommas(nStr) {
    nStr += "";
    var x = nStr.split(".");
    var x1 = x[0];
    var x2 = x.length > 1 ? "." + x[1] : "";
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, "$1" + "," + "$2");
    }
    return x1 + x2;
}

for (let i = 0; i < prices.length; i++) {
    prices[i].textContent = addCommas(prices[i].textContent);
}
