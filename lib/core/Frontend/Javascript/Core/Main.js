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
    $("#commandDivResult").hide();
    
    $("#commandDivSubmit").dblclick(
        function ()
        {
            $.ajax(
                {
                    type: "POST",
                    url: CONTROLLER+"Mathematica/Mathematica.php",
                    data: {
                        command: $("#commandTextArea").val()
                    }
                }
            ).done(
                function (response)
                {
                    $("#commandParagraphResult").text(response);
                    $("#commandDivResult").show();
                }
            );
        }
    );
}