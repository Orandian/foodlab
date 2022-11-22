$(document).ready(function () {
    $(".messageClick").click(function () {
        $id = $(this).attr("id");
        window.location.replace("/messageDetail/" + $id);
    });
    $(".tracks").click(function () {
        $id = $(this).attr("id");
        window.location.replace("/trackDetail/" + $id);
    });
});
