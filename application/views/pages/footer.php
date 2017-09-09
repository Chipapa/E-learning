
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; CQV 2017</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    
    $(document).ready(function () {
        $('#divCoding').hide();
        $('#divIdentification').hide();

//        $(".submit").click(function (event) {
//            event.preventDefault();
//            var title = $("#inputTitle").val();
//            jQuery.ajax({
//                type: "POST",
//                url: "<?php //echo base_url();      ?>" + "index.php/questions/create",
//                dataType: 'json',
//                data: {inputTitle: title},
//                success: function (res) {
//                    if (res)
//                    {
//                        // Show Entered Value
//                        jQuery("div#testJson").show();
//                        jQuery("div#titleValue").html(res.title);
//                    }
//                }
//            });
//        });
    });

    function selectDiv(value) {
        if (value === "Multiple Choice") {
            $('#divMultipleChoice').show();
            $('#divCoding').hide();
            $('#divIdentification').hide();
        } else if (value === "Coding") {
            $('#divMultipleChoice').hide();
            $('#divCoding').show();
            $('#divIdentification').hide();
        } else if (value === "Identification") {
            $('#divMultipleChoice').hide();
            $('#divCoding').hide();
            $('#divIdentification').show();
        }
    }

    $("#submitQuestion").click(function () {
        if ($("#questionType").val() === "Multiple Choice") {
            var values = [];
            $("input[id='inputChoice']").each(function () {
                values.push($.trim($(this).val()));
            });

            var dups = false;
            var emptyChoices = false;
            for (var i = 0; i < values.length - 1; i++) {
                if (values[i + 1] === values[i]) {
                    //results.push(values[i]);
                    dups = true;
                }
                if (values[i] === "") {
                    emptyChoices = true;
                }
            }
            //alert(results.join("\n"));
//            if (emptyChoices === true) {
//                alert("Choices cannot have blank answers.");
//            } else
            if (dups === true && emptyChoices === false) {
                alert("Choices cannot have duplicates.");

                //var javascriptVariable = "John";
                //window.location.href = "<?php //echo base_url();  ?>" + "index.php/questions/create?dups=" + dups;
            }
        }

//        $.ajax({
//            type: "POST",
//            url: base_url + "questions/create",
//            data: "title=" + $("#inputTitle").val(),
//            success: function (result) {
//                alert(result);
//            }
//        });
//        alert($("#input").val());

//        $.ajax({
//            type: "POST",
//            url: "<?php //echo base_url();      ?>" + "index.php/questions/create",
//            data: {title: $("#input").val()},
//            success: function (result) {
//                alert(result);
//            }
//        });
    });
</script>

</body>
</html>