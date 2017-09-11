<?php
if (isset($this->session->userdata['logged_in'])) {
    $session_id = ($this->session->userdata['logged_in']['id']);
    $username = ($this->session->userdata['logged_in']['username']);
    $usertype = ($this->session->userdata['logged_in']['usertype']);
    $fname = ($this->session->userdata['logged_in']['fname']);
    $lname = ($this->session->userdata['logged_in']['lname']);
} else {
    header("location: loginpage");
}
?>

<div class="container" id="mainDiv">

    <pre>
        <?php //print_r($question_item); //print_r($full_name_db);?>
    </pre>

    <div class="form-group">
        <?php
//        if (validation_errors()) {
//            echo "<div class='alert alert-danger' role='alert'>";
//
//            echo validation_errors();
//            echo "</div>";
//        }
        ?>

        <?php
        $full_name = $full_name_db['fname'] . " " . $full_name_db['lname'];
        //Questions posted by the logged in user will display a different time_asked format
        if ($question_item[0]['who_posted'] === $session_id) {
            $who_posted_message = "You posted this question " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago.";
        } else {
//                        $time_asked = "Asked " . time_since(time() - strtotime($question_item->date_posted)) . " ago by " . $question_item->who_posted;
            $who_posted_message = "Asked " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago by " . $full_name;
        }
        ?>

        <?php echo form_open('questions/setAnswer'); ?>  
        <h5 class="mb-1"><?php echo $question_item[0]['title']; ?></h5>
        <small> <?php echo $who_posted_message; ?></br>  </small>

        <span class="badge badge-default "><?php echo $question_item[0]['category']; ?> </span>
        <span class="badge badge-default"><?php echo $question_item[0]['type'] ?> </span>

    </div>

    <label for="questionTitle">The Question</label>
    <div class="card">      
        <div class="card-body bg-faded">
            <?php echo $question_item[0]['question']; ?>
        </div>
    </div>
    <br>
    <!-- Multiple Choice -->
    <div class="form-group" id="divMultipleChoiceAnswer">
        <label for="answerInstruction">Select the correct answer to the question.</label>
        <div class="col-sm-10">
            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" aria-label="Radio button for following text input" name="gridRadiosAnswer" id="gridRadios1" value="<?php echo $question_item[0]['option1']; ?>" checked>
                        </span>
                        <label type="text" class="form-control" name="choice1" id="answerChoice1"> <?php echo $question_item[0]['option1']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" aria-label="Radio button for following text input" name="gridRadiosAnswer" id="gridRadios2"  value="<?php echo $question_item[0]['option2']; ?>">
                        </span>
                        <label type="text" class="form-control" name="choice2" id="answerChoice2"> <?php echo $question_item[0]['option2']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" aria-label="Radio button for following text input" name="gridRadiosAnswer" id="gridRadios3"  value="<?php echo $question_item[0]['option3']; ?>">
                        </span>
                        <label type="text" class="form-control" name="choice3" id="answerChoice3"> <?php echo $question_item[0]['option3']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios4"  value="<?php echo $question_item[0]['option4']; ?>">
                        </span>
                        <label type="text" class="form-control" name="choice4" id="answerChoice4"> <?php echo $question_item[0]['option4']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coding -->
    <div class="form-group" id="divCodingAnswer">
        <textarea class="form-control codemirror-textarea-answer bg-faded" id="codeQuestion" readonly><?php echo $question_item[0]['question']; ?></textarea></br>
        Type the code here.
        <textarea class="form-control codemirror-textarea-question" id="codeAnswer"></textarea>
    </div>

    <!-- Identification -->
    <div class="form-group" id="divIdentificationAnswer">
        <p class="mb-1"><?php echo $question_item[0]['question']; ?></p>
        Identification
        <input type="text" id="textAnswer" class="form-control">
    </div>
    <br>
    <button type="button" id="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Submit Answer</button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rate This Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    PLS. RATE ME DADY
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Rate and Submit</button>
                </div>
            </div>
        </div>
    </div>
</div> <!--end main container div-->

<?php echo '</form>'; ?>

<script type="text/javascript">
    //var answerArray = <?php echo json_encode($question_item); ?>;
    $(document).ready(function () {
        //var choicesAnswer = new Array();
        //var answer;
        $("#divMultipleChoiceAnswer").hide();
        $("#divCodingAnswer").hide();
        $("#divIdentificationAnswer").hide();
        var questionType = "<?php echo $question_item[0]['type']; ?>"
        if (questionType === "Coding") {
            $('#divCodingAnswer').show();
        } else if (questionType === "Multiple Choice") {
            $('#divMultipleChoiceAnswer').show();
        } else if (questionType === "Identification") {
            $('#divIdentificationAnswer').show();
        }

        //console.log(answerArray);

    });

//    $("#submit").click(function () {
//        $.ajax({
//            type: "post",
//            url: "<?php //echo base_url();           ?>"+"index.php/questions/setanswer",
//            data: {arrayAnswer: answerArray},
//            success: function (data) {
//                alert(data);
//            },
//            error: function () {
//                alert("Ayaw");
//            }
//        });
//    });
</script>

<?php

//echo "<script> console.log(" . (json_encode($question_item)) . ") </script>";

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
