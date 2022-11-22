/*
 * Create : zayar(03/02/2022)
 * Update :
 * Explain of function : To show customer name search
 * Prarameter : no
 * return :
 */
$(document).ready(function () {
    /*
     * Create : zayar(17/2/2022)
     * Update :
     * Explain of function : To toggle inform alert
     * Prarameter : no
     * return : toggle
     * */
    $(".dropdown-toggle").dropdown();
    document
        .getElementById("closeInform")
        .addEventListener("click", function () {
            $("#informAlert").removeClass("visible");
        });

    /*
     * Create : zayar(17/1/2022)
     * Update :
     * Explain of function : To toggle profile alert
     * Prarameter : no
     * return : toggle
     * */

    if (sessionHas) {
        console.log(sessionHas);

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        console.log(customerid);
        var formdata = { customerId: customerid };

        $.ajax({
            type: "GET",
            url: "searchcustomerdetails",
            data: formdata,
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data["alertcount"] == 0) {
                    $("#alertCount").css("display", "none");
                } else $("#alertCount").text(data["alertcount"]);
                if (data["messageLimitedCount"].length > 0) {
                    $("#informTitleCountShowForMessage").append(
                        `<div class="alertIndicatorForInform "></div>`
                    );
                }
                if (data["trackLimitedCount"].length > 0) {
                    $("#informTitleCountShowForTrack").append(
                        `<div class="alertIndicatorForInform "></div>`
                    );
                }
                let newscount = data["limitednews"].length;
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, "0");
                var mm = String(today.getMonth() + 1).padStart(2, "0");
                var yyyy = today.getFullYear();

                today = yyyy + "-" + mm + "-" + dd;
                console.log(today);
                if (newscount == 0) {
                    $(".forMessages").prepend(
                        `
                        <div class="news mb-3 nocursor d-flex flex-row justify-content-center align-items-center">
                            <p class="fs-5 fw-bolder ms-3 mt-2 me-auto">No new has left </p>
                        </div>
                        `
                    );
                } else {
                    let countNews = 0;
                    let more = ``;
                    for (const news of data["limitednews"]) {
                        countNews++;
                        if (countNews == 3)
                            more = `<a href="/customerNews" class=" showAllNewsText">Show All News</a>`;

                        var oneD = 1000 * 60 * 60 * 24;

                        var sMS = new Date(news.newscreated);
                        var eMS = new Date(today);
                        var date = Math.round(
                            (eMS.getTime() - sMS.getTime()) / oneD
                        );

                        if (date < 3) {
                            $(".forNews").append(
                                `
                            <div class="news nocursor d-flex flex-row justify-content-center align-items-center mb-3">
                                    <img src="${news.source}" class="my-3 ms-2 imageNews rounded" width="20px" alt="">
                                    <div class=" d-flex flex-column  me-auto ms-3 text-truncate w-75">
                                    <p class="me-auto ms-3 text-truncate fs-5"  style="max-width: 80%; min-width:12vw;">${news.title}
                                        </p>
                                        <p class="me-auto ms-3 text-truncate fontSizeForInform lead text-muted"   style="max-width: 80%; min-width:12vw;">
                                        (${news.detail})</p>
                                        </div>
                                        <div class="newsLine"></div>
                                </div>
                                ${more}
                            `
                            );
                        } else {
                            $(".forNews").append(
                                `
                            <div class="news nocursor d-flex flex-row justify-content-center align-items-center mb-3">
                            
                                    <img src="${news.source}" class="my-3 ms-2 imageNews rounded"  alt="">
                                    <div class=" d-flex flex-column  me-auto ms-3 text-truncate w-75">
                                    <p class="me-auto ms-3 text-truncate fs-5 "  style="max-width: 80%; min-width:12vw;">${news.title}
                                        </p>
                                        <p class="me-auto ms-3 text-truncate fontSizeForInform lead text-muted"   style="max-width: 80%; min-width:12vw;">
                                        (${news.detail})</p>
                                        </div>
                                        
                                </div>
                                ${more}
                            `
                            );
                        }
                    }
                }
                let messagecount = data["limitedmessages"].length;
                if (messagecount == 0) {
                    $(".forMessages").prepend(
                        `
                        <div class="news mb-3 d-flex flex-row justify-content-center align-items-center">
                            <p class="fs-5 fw-bolder mt-2 ms-3 me-auto">No message has left </p>
                        </div>
                        `
                    );
                } else {
                    let countMessage = 0;
                    let more = ``;

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, "0");
                    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
                    var yyyy = today.getFullYear();
                    var time =
                        today.getHours() +
                        ":" +
                        today.getMinutes() +
                        ":" +
                        today.getSeconds();
                    todayDate = yyyy + "-" + mm + "-" + dd + " " + time;
                    var todayDateParsed = Date.parse(todayDate); //returns milliseconds difference between today and January 1, 1970

                    for (const messages of data["limitedmessages"]) {
                        var msgCreatedParsed = Date.parse(
                            messages.messagecreated
                        ); //returns milliseconds since January 1, 1970
                        $totalMilliSecondsDiff =
                            todayDateParsed - msgCreatedParsed; //returns milliseconds difference
                        $totalSecondsDiff = $totalMilliSecondsDiff / 1000; //total second difference
                        $totalDaysDiff = Math.floor(
                            $totalSecondsDiff / 60 / 60 / 24
                        ); //total day difference
                        $totalTimesDiff = Math.floor(
                            $totalSecondsDiff / 60 / 60
                        ); //total hour difference
                        $totalMinutesDiff = Math.floor($totalSecondsDiff / 60); //total minute difference
                        $timeDifferenceMessage = "";

                        if ($totalDaysDiff == 0) {
                            if ($totalTimesDiff == 0) {
                                $timeDifferenceMessage =
                                    $totalMinutesDiff == 0
                                        ? "1 minute ago"
                                        : $totalMinutesDiff == 1
                                        ? "1 minute ago"
                                        : $totalMinutesDiff + " minutes ago";
                            } else if ($totalTimesDiff == 1) {
                                $timeDifferenceMessage =
                                    $totalTimesDiff + " hour ago";
                            } else {
                                $timeDifferenceMessage =
                                    $totalTimesDiff + " hours ago";
                            }
                        } else if ($totalDaysDiff == 1) {
                            $timeDifferenceMessage = "Yesterday";
                        } else {
                            $timeDifferenceMessage =
                                $totalDaysDiff + " " + " days ago";
                        }

                        countMessage++;
                        if (countMessage == 3)
                            more = `<a href="/messages" class=" showAllNewsText">Show All Messages</a>`;

                        // $allcolor = ["yellow", "green", "yellow", "red"];
                        // $statusMessage = messages.decision_status;
                        $messagecolor = "";
                        if (messages.title == "APPROVED")
                            $messagecolor = "bg-success"; //success
                        if (messages.title == "REQUEST")
                            $messagecolor = "bg-primary"; //primary
                        if (messages.title == "WAITING")
                            $messagecolor = "bg-warning"; //bgwaring
                        if (messages.title == "REJECT")
                            $messagecolor = "bg-secondary"; // secondary
                        if (messages.seen == 0) {
                            $(".forMessages").append(
                                `

                                
        <div class="messages d-flex flex-row justify-content-center align-items-center mb-3" id="${messages.chargeid}">
        
                <p class="fontSizeForMessage me-auto w-50 ms-3 mt-3">${messages.detail}</p>
                <div class="d-flex flex-column me-4">
                
                    <p class=" ms-auto mt-1 titleStatus  w-100 rounded ${$messagecolor} text-center">
                    ${messages.title}
                    </p>
                    <p class=" fontSizeForMessage mb-3 w-100 "><i class="coinCalInform fas fa-coins"></i> ${messages.request_coin}  (${$timeDifferenceMessage})</p>
                </div>
                <div class="newsLine"></div>
                
            </div>
            ${more}
        `
                            ); //<img src="img/new.png" alt="" class="newsLogo gleft" width="49px">
                        } else {
                            $(".forMessages").append(
                                `
                                <div class="messages d-flex flex-row justify-content-center align-items-center mb-3" id="${messages.chargeid}">
        
                                <p class="fontSizeForMessage me-auto w-50 ms-3 mt-3">${messages.detail}</p>
                                <div class="d-flex flex-column me-4">
                                
                                    <p class=" ms-auto mt-1 titleStatus w-100 rounded ${$messagecolor} text-center">
                                    ${messages.title}
                                    </p>
                                    <p class=" fontSizeForMessage mb-3 w-100 "><i class="coinCalInform fas fa-coins"></i> ${messages.request_coin}  (${$timeDifferenceMessage})</p>
                                    
                                </div>
                                
                            </div>
            ${more}
        `
                            );
                        }
                    }
                    $(".messages").click(function () {
                        $id = $(this).attr("id");

                        window.location.replace("/messageDetail/" + $id);
                    });
                }

                let trackcount = data["limitedtracks"].length;
                if (trackcount == 0) {
                    $(".forTracks").prepend(
                        `
                        <div class="news mb-3 d-flex flex-row justify-content-center align-items-center">
                                <p class="fs-5 ms-3 fw-bolder mt-2 me-auto">No track has left </p>
                            </div>
                        `
                    );
                } else {
                    let countTrack = 0;
                    let more = ``;
                    let message = "";

                    var today = new Date();
                    var dd = String(today.getDate()).padStart(2, "0");
                    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
                    var yyyy = today.getFullYear();
                    var time =
                        today.getHours() +
                        ":" +
                        today.getMinutes() +
                        ":" +
                        today.getSeconds();
                    todayDate = yyyy + "-" + mm + "-" + dd + " " + time;
                    var todayDateParsed = Date.parse(todayDate); //returns milliseconds difference between today and January 1, 1970
                    for (const tracks of data["limitedtracks"]) {
                        var msgCreatedParsed = Date.parse(tracks.trackscreated); //returns milliseconds since January 1, 1970
                        $totalMilliSecondsDiff =
                            todayDateParsed - msgCreatedParsed; //returns milliseconds difference
                        $totalSecondsDiff = $totalMilliSecondsDiff / 1000; //total second difference
                        $totalDaysDiff = Math.floor(
                            $totalSecondsDiff / 60 / 60 / 24
                        ); //total day difference
                        $totalTimesDiff = Math.floor(
                            $totalSecondsDiff / 60 / 60
                        ); //total hour difference
                        $totalMinutesDiff = Math.floor($totalSecondsDiff / 60); //total minute difference
                        $timeDifferenceMessage = "";

                        if ($totalDaysDiff == 0) {
                            if ($totalTimesDiff == 0) {
                                $timeDifferenceMessage =
                                    $totalMinutesDiff == 0
                                        ? "1 minute ago"
                                        : $totalMinutesDiff == 1
                                        ? "1 minute ago"
                                        : $totalMinutesDiff + " minutes ago";
                            } else if ($totalTimesDiff == 1) {
                                $timeDifferenceMessage =
                                    $totalTimesDiff + " hour ago";
                            } else {
                                $timeDifferenceMessage =
                                    $totalTimesDiff + " hours ago";
                            }
                        } else if ($totalDaysDiff == 1) {
                            $timeDifferenceMessage = "Yesterday";
                        } else {
                            $timeDifferenceMessage =
                                $totalDaysDiff + " " + " days ago";
                        }
                        if (tracks.grandtotal_coin == 0) {
                            message = `
                                <p class="mb-1 ms-2 fontSizeForMessage">${tracks.grandtotal_cash} MMK</p>`;
                        }
                        if (tracks.grandtotal_cash == 0) {
                            message = `
                                <p class="mb-1 ms-2 fontSizeForMessage"><i class="coinCalInform fas fa-coins"></i> ${tracks.grandtotal_coin} </p>`;
                        }
                        countTrack++;
                        if (countTrack == 3)
                            more = `<a href="/tracks" class="showAllNewsText">Show All Tracks</a>`;

                        $allcolor = [
                            "yellow",
                            "red",
                            "green",
                            "red",
                            "green",
                            "green",
                        ];
                        $statusMessage = tracks.order_status;
                        $messagecolor = $allcolor[$statusMessage - 1];
                        $names = tracks.title;
                        $name = $names.split(",");
                        $namesCount = $name.length - 1;
                        $howmuchtext = "";
                        $namesCount == 0
                            ? ($howmuchtext = "")
                            : ($namesCount = 1
                                  ? ($howmuchtext = `<span class="fw-bolder ">and ${$namesCount} other</span>`)
                                  : // "and " + $namesCount + " other"
                                    ($howmuchtext = `<span class="fw-bolder "> and ${$namesCount} others</span>`));
                        // "and " + $namesCount + " others")
                        for (const product of data["trackProduct"]) {
                            if ($name[0] == product.id) {
                                if (tracks.seen == 0) {
                                    $(".forTracks").append(
                                        `
                                        <div class="tracks  d-flex flex-row justify-content-center align-items-center h-auto d-inline-block mb-3" id="${tracks.tid}">
                                        
                                        <div class="d-flex flex-column w-100 ms-3  ">
                                        <div class="d-flex flex-row gap-1 ms-2 fontSizeForMessage">
                                        <p class="text-truncate   informText " >${product.product_name}</p> ${$howmuchtext}
                                            </div>
                                            
                                            
                                            ${message}
                                        </div>
                                        <div class="d-flex flex-column  w-100 ">
                                            <p class=" w-75 fw-bolder titleStatus rounded ${$messagecolor} text-center">
                                            ${tracks.status} </p>
                                            <p class="fontSizeForMessage fw-bold ">${$timeDifferenceMessage} </p>
                                        </div>
                                        <div class="newsLine"></div>
                                    </div>
                                    ${more}
                                        `
                                    );
                                } else {
                                    $(".forTracks").append(
                                        `
                                        <div class="tracks  d-flex flex-row justify-content-center align-items-center h-auto d-inline-block mb-3" id="${tracks.tid}">
                                        
                                        <div class="d-flex flex-column w-100 ms-3 ">
                                        <div class="d-flex flex-row gap-1 ms-2  fontSizeForMessage">
                                        <p class="text-truncate  informText " >${product.product_name}</p> ${$howmuchtext}
                                            </div>
                                            
                                        ${message}
                                        </div>
                                        <div class="d-flex flex-column  w-100 ">
                                            <p class="  w-75 titleStatus text-center rounded ${$messagecolor} text-center">
                                            ${tracks.status} </p>
                                            <p class="fontSizeForMessage fw-bold  ">${$timeDifferenceMessage}  </p>
                                        </div>
                                        
                                    </div>
                                    ${more}
                                        `
                                    );
                                }
                            }
                        }
                    }
                    $(".tracks").click(function () {
                        $id = $(this).attr("id");
                        window.location.replace("/trackDetail/" + $id);
                    });
                }
            },
        });

        // document
        //     .getElementById("profileButton")
        //     .addEventListener("click", function () {
        //         $("#profileAlert").toggleClass("visible");
        //     });
        // document
        //     .getElementById("profileButton2")
        //     .addEventListener("click", function () {
        //         $("#profileAlert").toggleClass("visible");
        //     });
        // document.getElementById("back").addEventListener("click", function () {
        //     document.getElementById("profileAlert").style.display = "none";
        // });
        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : To toggle inform alert
         * Prarameter : no
         * return : toggle
         * */
        document
            .getElementById("informButton")
            .addEventListener("click", function () {
                $("#informAlert").toggleClass("visible");
                $("#informButton").toggleClass("informAlertDesign");
            });

        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : for initial ifrom alert
         * Prarameter : no
         * return : toggle
         * */

        document.getElementById("forNews").removeAttribute("id");
        document.getElementById("clickNews").style.borderBottom =
            "1px solid black";

        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : To toggle inform alert headers
         * Prarameter : no
         * return : toggle
         * */

        document
            .getElementById("clickNews")
            .addEventListener("click", function () {
                document.getElementsByClassName("forMessages")[0].id =
                    "forMessages";
                document.getElementsByClassName("forTracks")[0].id =
                    "forTracks";
                document.getElementById("forNews").removeAttribute("id");
                // document.getElementsByClassName("informAlert")[0].style.height = "60vh";
                document.getElementById("clickMessages").style.borderBottom =
                    "";
                document.getElementById("clickNews").style.borderBottom =
                    "1px solid #333333";
                document.getElementById("clickTracks").style.borderBottom = "";
            });

        document
            .getElementById("clickMessages")
            .addEventListener("click", function () {
                document.getElementsByClassName("forNews")[0].id = "forNews";
                document.getElementsByClassName("forTracks")[0].id =
                    "forTracks";
                document.getElementById("forMessages").removeAttribute("id");

                document.getElementById("clickMessages").style.borderBottom =
                    "1px solid #333333";
                document.getElementById("clickNews").style.borderBottom = "";
                document.getElementById("clickTracks").style.borderBottom = "";
                // document.getElementsByClassName("informAlert")[0].style.height =
                //     "60vh";
            });

        document
            .getElementById("clickTracks")
            .addEventListener("click", function () {
                document.getElementsByClassName("forNews")[0].id = "forNews";
                document.getElementsByClassName("forMessages")[0].id =
                    "forMessages";
                document.getElementById("forTracks").removeAttribute("id");

                // document.getElementsByClassName("informAlert")[0].style.height =
                //     "70vh";
                document.getElementById("clickMessages").style.borderBottom =
                    "";
                document.getElementById("clickNews").style.borderBottom = "";
                document.getElementById("clickTracks").style.borderBottom =
                    "1px solid #333333";
            });
    } else {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });

        $.ajax({
            type: "GET",
            url: "getnews",
            dataType: "json",
            success: function (data) {
                console.log(data);
                if (data["alertCount"] == 0) {
                    $("#alertCount").css("display", "none");
                } else $("#alertCount").text(data["alertCount"]);
                let newscount = data["limitednews"].length;
                var today = new Date();
                var dd = String(today.getDate()).padStart(2, "0");
                var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
                var yyyy = today.getFullYear();

                today = yyyy + "-" + mm + "-" + dd;
                console.log(today);
                if (newscount == 0) {
                    $(".forMessages").prepend(
                        `
                        <div class="news nocursor d-flex flex-row justify-content-center align-items-center">
                            <p class="fs-6 fw-bolder mt-2 me-auto">No new has left </p>
                        </div>
                        `
                    );
                } else {
                    let countNews = 0;
                    let more = ``;
                    for (const news of data["limitednews"]) {
                        var oneD = 1000 * 60 * 60 * 24;

                        var sMS = new Date(news.newscreated);
                        var eMS = new Date(today);
                        var date = Math.round(
                            (eMS.getTime() - sMS.getTime()) / oneD
                        );
                        countNews++;
                        if (countNews == 3)
                            more = `<a href="/customerNews" class="  showAllNewsText">Show All News</a>`;
                        if (date < 3) {
                            $(".forNews").append(
                                `
                            <div class="news nocursor d-flex flex-row justify-content-center align-items-center mb-3">
                            <img src="${news.source}" class="my-3 ms-2 imageNews rounded"  alt="">
                            <div class=" d-flex flex-column  me-auto ms-3 text-truncate w-75">
                            <p class="me-auto ms-3 text-truncate fs-5"  style="max-width: 80%; min-width:12vw;">${news.title}
                                </p>
                                <p class="me-auto ms-3 text-truncate fontSizeForInform lead text-muted"   style="max-width: 80%; min-width:12vw;">
                                (${news.detail})</p>
                                </div>
                                        <img src="img/new.png" alt="" class="newsLogo gleft" width="49px">
                                </div>
                                ${more}
                            `
                            );
                        } else {
                            $(".forNews").append(
                                `
                                <div class="news nocursor d-flex flex-row justify-content-center align-items-center mb-3">
                            
                                    <img src="${news.source}" class="my-3 ms-2 imageNews rounded"  alt="">
                                    <div class=" d-flex flex-column  me-auto ms-3 text-truncate w-75">
                                    <p class="me-auto ms-3 text-truncate fs-5 "  style="max-width: 80%; min-width:12vw;">${news.title}
                                        </p>
                                        <p class="me-auto ms-3 text-truncate fontSizeForInform lead text-muted"   style="max-width: 80%; min-width:12vw;">
                                        (${news.detail})</p>
                                        </div>
                                        <img src="" alt="" class="newsLogo" >
                                </div>
                            
                                ${more}
                            `
                            );
                        }
                    }
                }
            },
        });

        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : To toggle inform alert
         * Prarameter : no
         * return : toggle
         * */

        document
            .getElementById("informButton")
            .addEventListener("click", function () {
                $("#informAlert").toggleClass("visible");
                $("#informButton").toggleClass("informAlertDesign");
            });

        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : for initial ifrom alert
         * Prarameter : no
         * return : toggle
         * */

        document.getElementById("forNews").removeAttribute("id");
        document.getElementById("clickNews").style.borderBottom =
            "1px solid black";

        /*
         * Create : zayar(23/1/2022)
         * Update :
         * Explain of function : To toggle inform alert headers
         * Prarameter : no
         * return : toggle
         * */

        document
            .getElementById("clickNews")
            .addEventListener("click", function () {
                document.getElementsByClassName("forMessages")[0].id =
                    "forMessages";
                document.getElementsByClassName("forTracks")[0].id =
                    "forTracks";
                document.getElementById("forNews").removeAttribute("id");
                // document.getElementsByClassName("informAlert")[0].style.height = "60vh";
                document.getElementById("clickMessages").style.borderBottom =
                    "";
                document.getElementById("clickNews").style.borderBottom =
                    "1px solid #333333";
                document.getElementById("clickTracks").style.borderBottom = "";
            });
    }
});
