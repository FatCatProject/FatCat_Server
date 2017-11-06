<style>

    .ui-autocomplete {
             background: #FFFFFF;
             padding: 5px 10px;
             font-size: 13px;
             color: gray;
         }
    .ui-state-active, .ui-widget-content .ui-state-active, .ui-widget-header .ui-state-active, a.ui-button:active, .ui-button:active, .ui-state-active.ui-button:hover
    {
        border: none;
        color: #00ACED;

    }





</style>
<script type="text/javascript">
    $(document).ready(function () {

        $('#breed').on("input", function () {
        if ($(this).val().length != 0) {

            console.log($(this).val().length)
            console.log($(this).val())
            $.ajax({
                type: "GET",
                url: './autocompleteBreed',
                data: {
                    searchTerm: $(this).val()
                },
                success: function (data, status) {
                    var responseJSON = data;
                    console.log(responseJSON);
                    $('#breed').autocomplete({source: responseJSON});
                },
                error: function (xmlHttpRequest, statusText, errorThrown) {
                    console.log(
                        'Your form submission failed.\n\n'
                        + 'XML Http Request: ' + JSON.stringify(xmlHttpRequest)
                        + ',\nStatus Text: ' + statusText
                        + ',\nError Thrown: ' + errorThrown);
                }
            });
        }
    });
    });

    $(document).ready(function () {
        $('#breed').on("change", function () {

            var breed = $('#breed').val();
            console.log(breed);
            $.ajax({
                type: "GET",
                url: './getCatBreedInfo',
                data: {
                    breed_name: breed
                },
                success: function (data, textStatus, jqXHR) {
//                    console.log(data);
                    var breedReceived = data;
                    $("#wikiLink").text(breedReceived.link);
                    $("#wikiLink").attr("href", breedReceived.link);
                    $("#wikiInfo").text(breedReceived.description);
                    console.log("CatBreedSent");
                },
                fail: function (jqXHR, textStatus, errorThrown) {
                    console.log("ERROR:" + jqXHR);
                    console.log("ERROR:" + textStatus);
                }
            })
        });
    });


    //    function trackChange(value)
    //    {


    //        var x = document.getElementById("breed").selectedIndex;
    //        var y = document.getElementById("breed").options;
    //
    ////        alert("Index: " + y[x].index + " is " + y[x].text + "name" +y[x].getAttribute("name"));
    //        var breed = y[x].text;
    //        var wikiUrl = y[x].getAttribute("name");
    //        if(breed=="Other" || breed=="Stray") {breed="Cat"}
    //
    //        document.getElementById("wikiLink").href= wikiUrl;
    //        document.getElementById("wikiLink").innerHTML = "Learn more on wikipedia!";
    //        document.getElementById("wikiLink").target = "_blank";

    //        $.ajax({
    //            type: "GET",
    //            url: "http://en.wikipedia.org/w/api.php?action=parse&format=json&prop=text&section=0&page="+breed+"&callback=?",
    //            contentType: "application/json; charset=utf-8",
    //            async: false,
    //            dataType: "json",
    //            success: function (data, textStatus, jqXHR) {
    //
    //                var markup = data.parse.text["*"];
    //                var blurb = $('<div></div>').html(markup);
    //
    //                // remove links as they will not work
    //                blurb.find('a').each(function() { $(this).replaceWith($(this).html()); });
    //
    //                // remove any references
    //                blurb.find('sup').remove();
    //
    //                // remove cite error
    //                blurb.find('.mw-ext-cite-error').remove();
    //                $('#wikiInfo').html($(blurb).find('p'));
    //
    //            },
    //            error: function (errorMessage) {
    //            }
    //        });
    //    }


</script>