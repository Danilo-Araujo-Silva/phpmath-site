require (
    ["lib/core/Frontend/Javascript/Core/Constant.js"],
    function (parameter)
    {
        require (
            [VENDOR+"components/jquery/jquery.min.js"], 
            function (parameter)
            {
                ready();
            }
        );
    }
);

function ready()
{
    $("#loading").hide();
    $("#commandDivResult").hide();
    
    $("#commandDivSubmit").dblclick(
        function ()
        {
            $.ajax(
                {
                    type: "POST",
                    url: CONTROLLER+"Core/BootstrapController.php",
                     beforeSend: 
                        function ( parameter ) 
                        {
                            $("#commandDivResult").hide();
                            $("#loading").show();
                        }
                    ,
                    data: {
                        "controller": MATHEMATICA_CONTROLLER,
                        "data": { 
                            command: $("#commandTextArea").val()
                        }
                    }
                }
            ).done(
                function (response)
                {
                    $("#commandParagraphResult").text(response);
                    $("#loading").hide();
                    $("#commandDivResult").show();
                }
            );
        }
    );
}