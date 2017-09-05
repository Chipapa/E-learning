<form type="post">
    <div class="container" id="mainDiv">
        <?php //print_r($question_item)?>
        <div id="TestDiv">
            <input id="testInput"></input>
        </div>
        <input  type="submit"></input>
    </div>
</form>
<script type="text/javascript">
    //$('#TestDiv').hide();
//    $(document).ready(function () {
//        
//    });
    $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>/index.php/questions/answerquestion',
            data: {'user':'user'},
            success: function (result) {
                alert(result);
            },
            error: function () {
                alert("DI GUMANA");
            }
        });
</script>