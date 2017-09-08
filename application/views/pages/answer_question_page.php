<form type="post">
    <div class="container" id="mainDiv">
        <?php //print_r($question_item[0]['type']) ?>
        <div class="form-group">
            <h5 class="mb-1"><?php echo $question_item[0]['title']; ?></h5>
            <small> <?php echo "Posted " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago."; ?></br>  </small>
            <span class="badge badge-default "><?php echo $question_item[0]['category']; ?> </span>
            <span class="badge badge-default"><?php echo $question_item[0]['type'] ?> </span>

        </div>

        <!-- Multiple Choice -->
        <div class="form-group" id="divMultipleChoiceAnswer">
            <p class="mb-1"><?php echo $question_item[0]['question']; ?></p>
            Multiple Choice
            <div class="col-sm-10">
                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios1" value="option1" checked>
                            </span>
                            <label type="text" class="form-control" name="choice1" id="answerChoice1"> TestData
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios2"  value="option2">
                            </span>
                            <label type="text" class="form-control" name="choice2" id="answerChoice2"> TestData
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios3"  value="option3">
                            </span>
                            <label type="text" class="form-control" name="choice3" id="answerChoice3"> 
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios4"  value="option4">
                            </span>
                            <label type="text" class="form-control" name="choice4" id="answerChoice4"> TestData
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Coding -->
        <div class="form-group" id="divCodingAnswer">
            <textarea class="form-control codemirror-textarea-question" id="codeQuestion" readonly><?php echo $question_item[0]['question']; ?></textarea></br>
            Coding
            <textarea class="form-control codemirror-textarea-answer" id="codeAnswer"></textarea>
        </div>

        <!-- Identification -->
        <div class="form-group" id="divIdentificationAnswer">
            <p class="mb-1"><?php echo $question_item[0]['question']; ?></p>
            Identification
            <input type="text" id="textAnswer" class="form-control"> </text>
        </div>
        <input  type="submit" id="submitwew"></input>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        var choicesAnswer = new Array();
        var answer;
        $("#divMultipleChoiceAnswer").hide();
        $("#divCodingAnswer").hide();
        $("#divIdentificationAnswer").hide();
        var questionType = "<?php echo $question_item[0]['type']; ?>"
        if (questionType === "Coding") {
            $('#divCodingAnswer').show();
        } else if (questionType === "Multiple Choice") {
            $('#divMultipleChoiceAnswer').show();
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "index.php/questions/fetch_choices",
                dataType: 'json',
                data: {questionID: <?php echo $question_item[0]['id'] ?>},
                success: function (data) {
                    var correctOption = data[0]['answer'];
                    answer = data[0][correctOption];
                    choicesAnswer = [data[0]['option1'], data[0]['option2'], data[0]['option3'], data[0]['option1']];
                    choicesAnswer = shuffle(choicesAnswer);
                    console.log(choicesAnswer);
                    //foreach display choices in Radio buttons
                }
            });
            //fetchChoices();
        } else if (questionType === "Identification") {
            $('#divIdentificationAnswer').show();
        }


    }
    );
    function shuffle(a) {
        var j, x, i;
        for (i = a.length; i; i--) {
            j = Math.floor(Math.random() * i);
            x = a[i - 1];
            a[i - 1] = a[j];
            a[j] = x;
        }
        return a;
    }
    function fetchChoices() {
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>" + "index.php/questions/fetch_choices",
            dataType: 'text',
            data: {questionID: <?php echo $question_item[0]['id'] ?>},
            success: function (data) {
                alert(data);
            }
        });
    }

// Ajax post
    $("#submitwew").click(function (event) {
        event.preventDefault();
//        $.ajax({
//            type: "POST",
//            url: "<?php echo base_url(); ?>" + "index.php/questions/answerquestion",
//            dataType: 'text',
//            data: {name: $("#testInput").val()},
//            success: function (res) {
//                alert(res);
//            }
//        });
    });

</script>

<?php

function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365, 'year'),
        array(60 * 60 * 24 * 30, 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24, 'day'),
        array(60 * 60, 'hour'),
        array(60, 'minute'),
        array(1, 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 ' . $name : "$count {$name}s";
    return $print;
}
?>   