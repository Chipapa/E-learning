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
    <div class="form-group">
        <?php
//        if (validation_errors()) {
//            echo "<div class='alert alert-danger' role='alert'>";
//            echo validation_errors();
//            echo "</div>";
//        }
        ?>

        <?php
        $full_name = $full_name_db['fname'] . " " . $full_name_db['lname'];

        $isOwnQuestion = false;
        if ($question_item[0]['who_posted'] === $session_id) {
            $isOwnQuestion = true;
        }

        //Questions posted by the logged in user will display a different time_asked format
        if ($isOwnQuestion) {
            $who_posted_message = "You posted this question " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago.";
        } else {
            $who_posted_message = "Asked " . time_since(time() - strtotime($question_item[0]['date_posted'])) . " ago by " . $full_name;
        }
        echo "<script> console.log(" . json_encode($_SESSION['currentQuestion']) . ") </script>";
        ?>

        <?php echo form_open('questions/setStatus'); ?>  

        <?php
        if ($question_item[0]['status'] === 'unverified') {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'> This question is not yet verified </div>";
        } else if ($question_item[0]['status'] === 'removed') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> This question was rejected for the following reason(s): ";
            echo "<hr>";
            echo $question_item[0]['comment'];
            echo " </div>";
        } 
//        else if ($question_item[0]['status'] === 'verified') {
//            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'> This question is verified </div>";
//        }
        ?>

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

    <label for="questionTitle">The Question</label>
    <div class="card">      
        <div class="card-body bg-faded">
            <?php echo $question_item[0]['question']; ?>
        </div>
    </div>
    <br>
    <label for="answerTitle">The Answer</label>
    <br>
    <!-- Multiple Choice -->
    <div class="form-group" id="divMultipleChoiceAnswer">
        <label for="answerInstruction">Choices to the given question.</label>
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
                                   if ($isOwnQuestion) {
                                       echo "disabled=''";
                                   }
                                   ?> 
                                   checked>
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
                                   if ($isOwnQuestion) {
                                       echo "disabled=''";
                                   }
                                   ?> >
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
                                   if ($isOwnQuestion) {
                                       echo "disabled=''";
                                   }
                                   ?> >
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
                                   if ($isOwnQuestion) {
                                       echo "disabled=''";
                                   }
                                   ?> >
                        </span>
                        <label type="text" class="form-control" name="choice4" id="answerChoice4"> <?php echo $question_item[0]['option4']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coding -->
    <div class="form-group" id="divCodingAnswer">
        <textarea class="form-control codemirror-textarea-answer bg-faded" id="codeQuestion" readonly><?php echo $question_item[0]['code']; ?></textarea><br>

    </div>

    <button type="button"  
            class="btn btn-primary"
            data-toggle="modal" 
            data-target="#acceptModal"
            <?php
            if ($isOwnQuestion) {
                echo "disabled=''";
            }
            ?> >
        Mark as Verified
    </button>

    <button type="button" 
            id="submit" 
            class="btn btn-danger" 
            data-toggle="modal" 
            data-target="#rejectedModal" 
            <?php
            if ($isOwnQuestion) {
                echo "disabled=''";
            }
            ?> >Reject Question
    </button>

    <!-- Modal -->
    <div class="modal fade" id="rejectedModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason for Rejecting the Question</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <textarea class="form-control" placeholder="Enter the reason for rejecting the question" name="rejectComment"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Reject</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mark Question as verified?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary">Accept</button>
                </div>
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
</script>

<?php
echo "<script> console.log(" . json_encode($question_item) . "); </script>";

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
