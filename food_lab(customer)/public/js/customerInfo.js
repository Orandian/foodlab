/*
 * Create : Zar Ni(20/1/2022)
 * Update :
 * Explain of function : To show customer name search
 * Prarameter : no
 * return :
 */
$(document).ready(function () {
    $("#searchname").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formdata = { nickname: $("#search").val() };

        $.ajax({
            type: "GET",
            url: "searchname",
            data: formdata,
            dataType: "json",
            success: function (data) {
                $(".searchlist").empty();
                let count = 1;

                for (const list of data) {
                    $(".searchlist").append(
                        `
                        <tr class="tablecolor1 tablerows" id="newlist">
                                <th scope="row">${count++}</th>
                                <td>${list.nickname}</td>
                                <td>${list.customerID}</td>
                                <td>${list.phone}</td>
                                <td>${list.address3}</td>
                                ` +
                            (role == "SA"
                                ? `<td><a href="customerinfoDetail?id=${list.id}">
                                <button class="btn tablerows btn-outline-dark"><i
                                        class="bi bi-arrow-right"></i></button>
                            </a></td>`
                                : ``) +
                            `
                                
                                    
                                
                            </tr>
                            `
                    );
                }
            },
        });
    });

    /*
     * Create : Zar Ni(20/1/2022)
     * Update :
     * Explain of function : To show customer id search
     * Prarameter : no
     * return :
     */
    $("#searchid").click(function (e) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr(
                    "content"
                ),
            },
        });
        e.preventDefault();
        var formdata = { id: $("#search").val() };
        $.ajax({
            type: "GET",
            url: "searchid",
            data: formdata,
            dataType: "json",
            success: function (data) {
                $(".searchlist").empty();
                let count = 1;

                for (const list of data) {
                    $(".searchlist").append(
                        `
                        <tr class="tablecolor1 tablerows" id="newlist">
                                <th scope="row">${count++}</th>
                                <td>${list.nickname}</td>
                                <td>${list.customerID}</td>
                                <td>${list.phone}</td>
                                <td>${list.address3}</td>
                                <td>
                                <a href="customerinfoDetail?id=${list.id}">
                                <button class="btn tablerows btn-outline-dark"><i
                                        class="bi bi-arrow-right"></i></button>
                            </a>
                                </td>
                            </tr>
                        `
                    );
                }
            },
        });
    });
});
