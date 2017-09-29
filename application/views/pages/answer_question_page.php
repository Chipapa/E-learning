<?php
if (isset($this->session->userdata['logged_in'])) {
    $session_id = ($this->session->userdata['logged_in']['id']);
    $username = ($this->session->userdata['logged_in']['username']);
    $usertype = ($this->session->userdata['logged_in']['usertype']);
    $fname = ($this->session->userdata['logged_in']['fname']);
    $lname = ($this->session->userdata['logged_in']['lname']);
} else {
    header("location: login_page");
}
?>

<div class="container" id="mainDiv">
    <div class="form-group">
        <?php
        $isOwnQuestion = false;
        if ($question_item[0]['who_posted'] === $session_id) {
            $isOwnQuestion = true;
        }

        if ($question_item[0]['status'] === 'removed') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> This question was rejected for the following reason(s): ";
            echo "<hr>";
            echo $question_item[0]['comment'];
            echo "</div>";
        }

        if ($isAnswered) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "You already have answered this question";
            echo "</div>";
        }

        if ($isOwnQuestion) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>";
            echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "You are now viewing your own question.";
            echo "</div>";
        }
        ?>

        <?php
        $full_name = $full_name_db['fname'] . " " . $full_name_db['lname'];

        //Questions posted by the logged in user will display a different time_asked format
        if ($isOwnQuestion) {
            $who_posted_message = "You posted this question " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago.";
        } else {
            $who_posted_message = "Asked " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago by " . $full_name;
        }
        ?>

        <?php echo form_open('questions/setAnswer'); ?>  
        <h5 class="mb-1">
            <?php echo $question_item[0]['title']; ?> 

            <?php
            if ($question_item[0]['status'] === 'verified') {
                echo "<img src='" . base_url() . "/assets/png/circle-check-2x.png" . "'data-toggle='tooltip' data-placement='bottom' title='Verified'>";
            } else if ($question_item[0]['status'] === 'removed') {
                echo "<img src='" . base_url() . "/assets/png/circle-x-2x.png" . "'data-toggle='tooltip' data-placement='bottom' title='Rejected'>";
            }
            ?>
        </h5>

        <small> <?php echo $who_posted_message; ?></br>  </small>

        <span class="badge badge-default "><?php echo $question_item[0]['category']; ?> </span>
        <span class="badge badge-default"><?php echo $question_item[0]['type'] ?> </span>

    </div>

    <label for="questionTitle"><h5>Question</h5></label>
    <div class="card">      
        <div class="card-body bg-faded">
            <?php echo $question_item[0]['question']; ?>
        </div>
    </div>
    <br>
    <!-- Multiple Choice -->
    <div class="form-group" id="divMultipleChoiceAnswer">
        <label for="answerInstruction">
            <?php
            if ($isAnswered) {
                echo "Review your answer.";
            } else {
                echo "Select the correct answer to the question.";
            }
            ?>
        </label>
        <div class="col-sm-10">
            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" 
                                   aria-label="Radio button for following text input" 
                                   name="gridRadiosAnswer" 
                                   id="gridRadios1" 
                                   value="<?php echo $question_item[0]['option1']; ?>" 
                                   <?php
                                   if ($isOwnQuestion || $isAnswered) {
                                       echo "disabled=''";
                                       if (isset($dataanswer['answer']) && $question_item[0]['option1'] === $dataanswer['answer']) {
                                           echo " checked";
                                       }
                                   }
                                   ?> 
                                   >
                        </span>
                        <label type="text" class="form-control" name="choice1" id="answerChoice1"> <?php echo $question_item[0]['option1']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" 
                                   aria-label="Radio button for following text input" 
                                   name="gridRadiosAnswer" 
                                   id="gridRadios2"  
                                   value="<?php echo $question_item[0]['option2']; ?>"
                                   <?php
                                   if ($isOwnQuestion || $isAnswered) {
                                       echo "disabled=''";
                                       if (isset($dataanswer['answer']) && $question_item[0]['option2'] === $dataanswer['answer']) {
                                           echo " checked";
                                       }
                                   }
                                   ?> 
                                   >
                        </span>
                        <label type="text" class="form-control" name="choice2" id="answerChoice2"> <?php echo $question_item[0]['option2']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" 
                                   aria-label="Radio button for following text input" 
                                   name="gridRadiosAnswer" 
                                   id="gridRadios3"  
                                   value="<?php echo $question_item[0]['option3']; ?>"
                                   <?php
                                   if ($isOwnQuestion || $isAnswered) {
                                       echo "disabled=''";
                                       if (isset($dataanswer['answer']) && $question_item[0]['option3'] === $dataanswer['answer']) {
                                           echo " checked";
                                       }
                                   }
                                   ?> 
                                   >
                        </span>
                        <label type="text" class="form-control" name="choice3" id="answerChoice3"> <?php echo $question_item[0]['option3']; ?>
                    </div>
                </div>
            </div>

            <div class="form-check">
                <div class="col-lg-6">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <input type="radio" 
                                   aria-label="Radio button for following text input" 
                                   name="gridRadiosAnswer" 
                                   id="gridRadios4"  
                                   value="<?php echo $question_item[0]['option4']; ?>"
                                   <?php
                                   if ($isOwnQuestion || $isAnswered) {
                                       echo "disabled=''";
                                       if (isset($dataanswer['answer']) && $question_item[0]['option4'] === $dataanswer['answer']) {
                                           echo " checked";
                                       }
                                   }
                                   ?> 
                                   >
                        </span>
                        <label type="text" class="form-control" name="choice4" id="answerChoice4"> <?php echo $question_item[0]['option4']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coding -->
    <div class="form-group" id="divCodingAnswer">
        <textarea class="form-control codemirror-textarea-answer bg-faded" id="codeQuestion" readonly><?php echo $question_item[0]['code']; ?></textarea></br>
        <div <?php
        if ($isOwnQuestion || $isAnswered || $view_correct_code != "false") {
            echo "style='display:none'";
        }
        ?>>
            Type the code here.
            <textarea class="form-control codemirror-textarea-question" id="codeAnswer" name="codeAnswer" ></textarea>
        </div>
    </div>

    <!-- Identification -->
    <div class="form-group" id="divIdentificationAnswer">

        <div <?php
        if ($isOwnQuestion || $isAnswered) {
            echo "style='display:none'";
        }
        ?>>
            <input type="text" id="textAnswer" name="textAnswer" class="form-control" >
        </div>
    </div>

    <button type="button" 
            id="submit" 
            class="btn btn-primary" 
            data-toggle="modal" 
            data-target="#exampleModal" 
            <?php
            if ($isOwnQuestion || $isAnswered || ($view_correct_code != "false" && $question_item[0]['type'] === 'Coding')) {
                echo "disabled='' style='display:none'";
            }
            ?> >Submit Answer
    </button>

    <!--    Section for showing all answers to the the one posted the question-->
    <div>
        <?php
        if ($isAnswered) {
            if ($view_correct_code['userID'] != $session_id) {
                echo "<h5>Review your answer</h5>";
            }
            if ($question_item[0]['type'] === 'Coding') {
                ?>
                <br>               
                <div class="card" <?php
                if ($view_correct_code['userID'] == $session_id) {
                    echo "style='display:none'";
                }
                ?>>
                    <div class="card-body">

                        <textarea class="form-control codemirror-textarea-answerbyotheruser bg-faded" readonly><?php echo $dataanswer['answer']; ?></textarea>              
                        <p class="card-text">
                            <small class="text-muted">
                                Answered <?php echo time_since(time() - strtotime($dataanswer['answeredWhen'])); ?> ago
                            </small>
                        </p>
                    </div>
                </div>
                <br>

                <?php
                if (($view_correct_code == "false")) {
                    echo "<h5> User has not selected an answer yet.</h5>";
                } else {
                    $fullname_of_who_answered = $view_correct_code['fname'] . " " . $view_correct_code['lname'];

                    if ($view_correct_code['userID'] == $session_id) {
                        echo "<h5>Your answer is correct</h5>";
                    } else {
                        echo "<h5> Correct Answer</h5>";
                    }
                    ?>
                    <div class="card" style='background-color:#98DD6B'>
                        <div class="card-body">
                            <textarea class="form-control codemirror-textarea-answerbyotheruser bg-faded" readonly><?php echo $view_correct_code['answer']; ?></textarea>              
                            <p class="card-text">
                                <small class="text-muted">
                                    Answered <?php echo time_since(time() - strtotime($view_correct_code['answeredWhen'])); ?> ago by <?php echo $fullname_of_who_answered; ?> 
                                </small>
                            </p>
                        </div>
                    </div>
                    <?php
                }
            } else if ($question_item[0]['type'] === 'Identification') {
                ?>
                <br>               
                <div class="card">
                    <div class="card-body">

                        <div class="card-body bg-faded"><?php echo $dataanswer['answer']; ?></div>
                        <p class="card-text">
                            <small class="text-muted">
                                Answered <?php echo time_since(time() - strtotime($dataanswer['answeredWhen'])); ?> ago
                            </small>
                        </p>

                    </div>
                </div>  
                <?php
            }
        } else if (isset($answer_item) && $isOwnQuestion) {

            echo "<h6>" . $answer_count . " Answer(s) to your Question.</h6>";
            if ($question_item[0]['type'] === 'Coding') {
                foreach ($answer_item as $otherUserAnswers):
                    $fullname_of_who_answered = $otherUserAnswers['fname'] . " " . $otherUserAnswers['lname'];
                    ?>
                    <br>              
                    <div class="card"<?php
                    if (($view_correct_code != "false") && ($view_correct_code['userID'] == $otherUserAnswers['userID']))
                        echo "style='background-color:#98DD6B'";
                    ?>>
                        <div class="card-body">
                            <textarea class="form-control codemirror-textarea-answerbyotheruser bg-faded" readonly><?php echo $otherUserAnswers['answer']; ?></textarea>              
                            <p class="card-text">
                                <small class="text-muted">
                                    Answered <?php echo time_since(time() - strtotime($otherUserAnswers['answeredWhen'])); ?> ago by <?php echo $fullname_of_who_answered; ?> 
                                </small>
                            </p>
                            <?php
                            if (($view_correct_code == "false")) {
                                ?>
                                <a href="<?php echo site_url('questions/markCorrectCode/' . $otherUserAnswers['id']); ?>" class="btn btn-success">Mark as Correct</a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                endforeach;
            }
        }

        echo "<pre>";
        print_r($view_correct_code);
        print_r($answer_item);
//print_r($who_answered);
        echo "</pre>";
        ?>
    </div>
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <?php include "rating_modal.php"; ?>
            </div>
        </div>
    </div>

    <!--    FOR DEBUGGING-->
    <pre>
        <?php
//        $test = $_SESSION['currentQuestion'];
//        print_r($test); //print_r($full_name_db);
        ?>
    </pre>

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
//            url: "<?php //echo base_url();                                                                         ?>"+"index.php/questions/setanswer",
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
echo "<script> console.log(" . (json_encode($answer_item)) . ") </script>";

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
