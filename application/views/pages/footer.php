
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; CQV 2017</span>
    </div>
</footer>



<script type="text/javascript">
    //$('#needs-validation').validator();
    
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).ready(function () {
        var codeQuestion = $(".codemirror-textarea-question")[0];
        var codeAnswer = $(".codemirror-textarea-answer")[0];
        
        var editorQuestion = CodeMirror.fromTextArea(codeQuestion, {
            lineNumbers: true,
            mode: "vb"

        });
        var editorAnswer = CodeMirror.fromTextArea(codeAnswer, {
            lineNumbers: true,
            mode: "vb",
            readOnly: true
        });
    });

    $(document).ready(function () {
        $('#divCoding').hide();
        $('#divIdentification').hide();
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

//    $("#submitQuestion").click(function () {
//        if ($("#questionType").val() === "Multiple Choice") {
//            var values = [];
//            $("input[id='inputChoice']").each(function () {
//                values.push($.trim($(this).val()));
//            });
//
//            var dups = false;
//            var emptyChoices = false;
//            for (var i = 0; i < values.length - 1; i++) {
//                if (values[i + 1] === values[i]) {
//                    //results.push(values[i]);
//                    dups = true;
//                }
//                if (values[i] === "") {
//                    emptyChoices = true;
//                }
//            }
//            //alert(results.join("\n"));
////            if (emptyChoices === true) {
////                alert("Choices cannot have blank answers.");
////            } else
//            if (dups === true && emptyChoices === false) {
//                alert("Choices cannot have duplicates.");
//
//                //var javascriptVariable = "John";
//                //window.location.href = "<?php //echo base_url();       ?>" + "index.php/questions/create?dups=" + dups;
//            }
//        }
//    });

</script>



</body>
</html>