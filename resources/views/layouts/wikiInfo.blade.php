

<script type="text/javascript">

    function trackChange(value)
    {
        var breed = document.getElementById("breed").value;
        var wikiUrl = "https://en.wikipedia.org/wiki/"+breed;
        // window.open(wikiUrl)
        document.getElementById("wikiLink").href= wikiUrl;
        document.getElementById("wikiLink").innerHTML = "Learn more on wikipedia!";
        document.getElementById("wikiLink").target = "_blank";

        $.ajax({
            type: "GET",
            url: "http://en.wikipedia.org/w/api.php?action=parse&format=json&prop=text&section=0&page="+breed+"&callback=?",
            contentType: "application/json; charset=utf-8",
            async: false,
            dataType: "json",
            success: function (data, textStatus, jqXHR) {

                var markup = data.parse.text["*"];
                var blurb = $('<div></div>').html(markup);
                var breed = document.getElementById("breed").value;
                // remove links as they will not work
                blurb.find('a').each(function() { $(this).replaceWith($(this).html()); });

                // remove any references
                blurb.find('sup').remove();

                // remove cite error
                blurb.find('.mw-ext-cite-error').remove();
                $('#wikiInfo').html($(blurb).find('p'));

            },
            error: function (errorMessage) {
            }
        });
    }

    $(document).ready(function(){

    });
</script>