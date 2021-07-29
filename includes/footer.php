<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous"></script>-->
<!--<script>-->
<!--    console.log(moment("2021-03-24 21:26:04", "YYYY-MM-DD H:mm:ss").fromNow());-->
<!--</script>-->
<script>
    $(document).ready(function(){
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items:6,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:1000,
            autoplayHoverPause:true,
            dots:true
        });

    });
</script>

<script>

    function checkValues(v,c){
        if(v !== ''){
            if(c === 1){
              return   `<a href="${v}" target='_blank'>view</a>`
            }
            return v
        }else{
            return 'N/A'
        }

    }


    function handleDisplay(item){
        console.log('hit',item.id)
        $.get( "./forestSearchModel.php", { id: item.id } )
            .done(function( data ) {
                var res = JSON.parse(data);
                console.log(res)
                $("#dropForest").hide();
                $('#searchedCards').empty();
                $('#searchedCards').append(`
                      <div class="card mb-3" style="z-index: 10;" >
                        <div class="row g-0">
                            <div class="col-md-4" style="background-image: url(' ${res['3']}   '); background-repeat: no-repeat;background-size: cover; " >
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title"> ${res['1']}</h5>
                                    <p class="m-0"> <span class="fw-bold">Area:</span> ${checkValues(res['6'],0)} <span>km²</span> </p>
                                    <p class="m-0"> <span class="fw-bold">Latitude:</span> <span>${checkValues(res['4'],0)} </span> </p>
                                    <p class="m-0"><span class="fw-bold">Longitude:</span> <span>${checkValues(res['5'],0)}</span> </p>
                                    <p class="m-0"><span class="fw-bold">URL:</span> <span> ${checkValues(res['2'],1)}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                )


            });
    }
</script>


<script>

    $("#dropForest").hide();

    $( "#countrySearch" ).focus(function() {
        $("#dropForest").show();
    });

    $("#countrySearch").blur(function() {
        setTimeout(()=>{
            $("#dropForest").fadeOut('slow');
        },100)
    });





    function checkforest(value){
        $.get( "./forestSearchModel.php", { name: value } )
            .done(function( data ) {
                if(data.length  > 2){
                    var res = JSON.parse(data);
                    console.log(data)
                    $("#dropForest").empty()
                    if(value !== ''){
                        $("#dropForest").append(`<div style="  background-color: white; padding: 10px" id="dropForestContainer" >  </div>` )
                        res.map((item, index)=>{
                            $("#dropForestContainer").append(`<p onclick="handleDisplay(this)" id="${item.id}" style="cursor: pointer; font-size:14px; color:lightslategray; padding-bottom: 10px;  border-bottom-color: #dddddd; border-bottom-width: 1px; border-bottom-style: solid"> ${item.name} - ${item.country_name}</p>` )
                        })
                    }
                }else{
                    $("#dropForest").empty()
                    $("#dropForest").append(`<div style="  background-color: white; padding: 10px" id="dropForestContainer" >  </div>` )
                    $("#dropForestContainer").append(`<p style="cursor: pointer; font-size:14px; color:lightslategray; padding-bottom: 10px;  border-bottom-color: #dddddd; border-bottom-width: 1px; border-bottom-style: solid"> No data found</p>` )
                    console.log('no data')
                }


            });
    }


    $( "#countrySearch" ).keyup(function() {
        let word = $('#countrySearch').val()
        if(word.length !== 0){
            $("#dropForest").show();
            checkforest(word);
        }else{
            $("#searchedCards").empty()
            $("#dropForest").hide();
        }


    });



</script>
</body>
</html>
