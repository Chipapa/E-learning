<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $usertype = ($this->session->userdata['logged_in']['usertype']);
    } else {
        header("location: loginpage");
    }
?>
<div class="container" id="mainDiv">

    <div class="row">
        <div class="col-sm-8">
            <h3>Landing Page</h3>
        </div>
        <div class="col-sm-4 text-right">
            <p><a class="btn btn-large btn-info" href="<?php echo site_url('questions/viewAskQuestion'); ?>">Ask a Question</a></p>
        </div>
    </div>

    <?php
    echo "<div>";
    //set session['flash'] here
    if (isset($this->session->userdata['flash'])) {
        $flash = $_SESSION['flash'];
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
        echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
        echo "<span aria-hidden='true'>&times;</span>";
        echo "</button>";
        echo $flash;
        echo "</div>";
    }
    //then session['flash'] is removed immediately
    unset($_SESSION['flash']);
    echo "</div>"
    ?>

    <div class="row">
        <div class="col">


            <?php
//            if ($questions != NULL) {
//                foreach ($questions as $question_item):
//                    
            ?>     
            <!-- OLD STYLE OF CALLING COLUMNS: echo $question_item['question']; -->
            <!-- REPLACED WITH: echo $question_item->question; -->
            <!--                    <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php //echo $question_item->title;   ?></h4>
                                        <h6 class="card-subtitle mb-2 text-muted">Asked <?php //echo time_since(time() - strtotime($question_item->date_posted));   ?> ago by <?php //echo $question_item->who_posted; ?></h6>
                                        <p class="card-text"><?php //echo $question_item->question;   ?></p>
                                        <p class="card-text text-muted">This question was answered by <?php //echo $question_item->num_of_answers;   ?> student(s)</p>
                                        <p class="card-text text-muted">Category: <?php //echo $question_item->category;   ?></p>
                                        <a href="<?php //echo site_url('questions/viewquestion/' . $question_item->id);   ?>" class="card-link">Answer Question</a>
                                    </div>
                                </div>
                                <br/>-->
            <?php
//                endforeach;
//            } else {
//                echo "<div class='text-center' id='mainDiv'>";
//                echo "<h3>There are no posted questions yet.</h3>";
//                echo "</div>";
//            }
//            
            ?>   

            <?php
            if ($questions != NULL) {
                foreach ($questions as $question_item):
                    //Questions posted by the logged in user will display a different time_asked and link_question format
                    if($question_item->who_posted == $username) {
                        $time_asked = "You posted this question ".time_since(time() - strtotime($question_item->date_posted))." ago";
                        $link_question = "View Question";
                    }
                    else {
                        $time_asked = "Asked ".time_since(time() - strtotime($question_item->date_posted))." ago by ".$question_item->who_posted;
                        $link_question = "Answer Question";
                    }
                    ?>     
                    <!-- OLD STYLE OF CALLING COLUMNS: echo $question_item['question']; -->
                    <!-- REPLACED WITH: echo $question_item->question; -->
                    <div class="list-group">
                        <a href="<?php echo site_url('questions/viewquestion/' . $question_item->id); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1"><?php echo $question_item->title; ?></h5>
                                <small>Asked <?php echo time_since(time() - strtotime($question_item->date_posted)); ?> ago by <?php echo $question_item->who_posted; ?></small>
                            </div>
                            <p class="mb-1"><?php echo $question_item->question; ?></p>
                            
                            <small>This question was answered by <?php echo $question_item->num_of_answers; ?> student(s)</small>                          
                            <div>
                                <span class="badge badge-default "><?php echo $question_item->category; ?> </span>
                                <span class="badge badge-default"><?php echo $question_item->type; ?> </span>
                            </div>
                        </a>
                    </div>                  
                    <br/>
                    <?php
                endforeach;
            } else {
                echo "<div class='text-center' id='mainDiv'>";
                echo "<h3>There are no posted questions yet.</h3>";
                echo "</div>";
            }
            ?>  

            <!--        pagination-->
            <div>
<?php echo $links; ?>
            </div>

        </div>       
        <!--        style="border:1px solid; -->
        <div class="col-md-auto rounded bg-faded card" style="padding:20px">
            <h4 class="text-center">Leaderboards</h4>
            <ol>
                <li>
                    Jesther Casillano
                </li>
                <li>
                    John Matthew Quebec
                </li>
                <li>
                    John Joseph Vasquez
                </li>
            </ol>

        </div>
    </div>
</div>



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

