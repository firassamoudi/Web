$("document").ready(function () {

    $(".recherche").keyup(function () {
        var plan=$('.recherche').val();
        var DATA = 'plan=' + plan;
        $.ajax({
            type:"GET",
            url: "http://localhost/Piweb4/web/app_dev.php/Recherche",
            data: DATA,
            success: function (data) {
                console.log(data);
                $("recherche").val(data.plan);
                console.log("trouvé");
            }
        });


    })

});