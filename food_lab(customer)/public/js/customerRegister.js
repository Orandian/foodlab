let username = document.getElementById("username"),
    phone = document.getElementById("phone"),
    email = document.getElementById("email"),
    addressTownship = document.getElementById("addressTownship"),
    addressCity = document.getElementById("addressCity"),
    password = document.getElementById("password"),
    cpassword = document.getElementById("cPassword"),
    createAccs = document.getElementById("createAccs");

let peye = document.querySelector(".pwd-eye"),
    peyeSlash = document.querySelector(".pwd-eye-slash");

let cpeye = document.querySelector(".cpwd-eye"),
    cpeyeSlash = document.querySelector(".cpwd-eye-slash");

$(document).ready(function() {
    $('#phone').bind('cut copy paste', function(event) {
        event.preventDefault();
    });
});

phone.addEventListener('keydown', (e) => {
    console.log(e.key);
    let reg = new RegExp(/^([0-9+-]{1,})$/);
    if (reg.test(e.key) == true || e.key == 'Backspace') {
        console.log('true');
    } else {
        e.preventDefault();
        console.log('false');
    }
});


// for password eye icon addEventListener
peyeSlash.addEventListener("click", function() {
    peyeSlash.style.display = "none";
    peye.style.display = "block";
    password.setAttribute("type", "text");
});

peye.addEventListener("click", function() {
    peye.style.display = "none";
    peyeSlash.style.display = "block";
    password.setAttribute("type", "password");
});

// for confirm password eye icon addEventListener
cpeyeSlash.addEventListener("click", function() {
    cpeyeSlash.style.display = "none";
    cpeye.style.display = "block";
    cpassword.setAttribute("type", "text");
});

cpeye.addEventListener("click", function() {
    cpeye.style.display = "none";
    cpeyeSlash.style.display = "block";
    cpassword.setAttribute("type", "password");
});

// for google signin
function onSignIn(googleUser) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });
    var profile = googleUser.getBasicProfile();
    let userData = {
        id: `${profile.getId()}`,
        name: `${profile.getName()}`,
        email: `${profile.getEmail()}`,
        all: `${profile}`,
    };

    $.ajax({
        type: "POST",
        url: "/google",
        data: userData,
        success: function(res) {
            username.value = res.name;
            email.value = res.email;
        },
        error: function(err) {
            console.log(err);
        },
    });
}

// for facebook login
function statusChangeCallback(response) {
    // Called with the results from FB.getLoginStatus().
    console.log("statusChangeCallback");
    console.log(response); // The current login status of the person.
    if (response.status === "connected") {
        // Logged into your webpage and Facebook.
        testAPI();
    } else {
        // Not logged into your webpage or we are unable to tell.
        document.getElementById("status").innerHTML =
            "Please log " + "into this webpage.";
    }
}

function checkLoginState() {
    // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {
        // See the onlogin handler
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId: "4571537182964313",
        cookie: true, // Enable cookies to allow the server to access the session.
        xfbml: true, // Parse social plugins on this webpage.
        version: "v7.0", // Use this Graph API version for this call.
    });

    FB.getLoginStatus(function(response) {
        // Called after the JS SDK has been initialized.
        statusChangeCallback(response); // Returns the login status.
    });
};

function testAPI() {
    // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
    console.log("Welcome!  Fetching your information.... ");
    FB.api("/me", function(response) {
        console.warn(
            "Thanks for logging in, " +
            response.name +
            "! and Email is " +
            response.email
        );
    });
}

createAccs.addEventListener("click", function() {
    (function($) {
        "use strict";
        operate();
    })(window.jQuery);
});

document.getElementById('addressState').addEventListener('change', () => {
    let state = document.getElementById('addressState').value;

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        type: 'POST',
        url: 'getTownship',
        data: { data: state },
        success: (response) => {
            let townships = document.getElementsByClassName('townships');
            if(townships.length != 0) {
                $(`.townships`).remove();
            }
            for (let i = 0; i < response.length; i++) {
                $('#addressTownship').append(`<option class="township-options townships" value="${response[i]['id']}">${response[i]['township_name']}</option>`);
            }

        },
        error: (error) => {
            console.log(error);
        }

    })
})
