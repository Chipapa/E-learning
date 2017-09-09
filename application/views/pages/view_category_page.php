<?php
    if (isset($this->session->userdata['logged_in'])) {
        $username = ($this->session->userdata['logged_in']['username']);
        $usertype = ($this->session->userdata['logged_in']['usertype']);
        $fname = ($this->session->userdata['logged_in']['fname']);
        $lname = ($this->session->userdata['logged_in']['lname']);        
        $full_name = $fname." ".$lname;
    } else {
        header("location: loginpage");
    }
?>
<div class="container" id="mainDiv">

    <div class="row">
        <div class="col-sm-8">
            <h2>
                <?php
                if (isset($category_title)) {
                    echo $category_title['category'];
                } else {
                    echo "Title not found";
                }
                ?> 
                Questions
            </h2>
        </div>
        <div class="col-sm-4 text-right">
            <p><a class="btn btn-large btn-info" href="<?php echo site_url('stockmarket/viewquestion/'); ?>">Ask a Question</a></p>
        </div>
    </div>

    <?php
    if (isset($category_item)) {
        foreach ($category_item as $question_item):
             $full_name_db = $question_item->fname." ".$question_item->lname;
            //Questions posted by the logged in user will display a different time_asked and link_question format
            if ($question_item->who_posted === $full_name) {
                $time_asked = "You posted this question " . time_since(time() - strtotime($question_item->date_posted)) . " ago";
            } else {
                $time_asked = "Asked " . time_since(time() - strtotime($question_item->date_posted)) . " ago by " . $full_name_db;
            }
            ?>
            <!-- OLD STYLE OF CALLING COLUMNS: echo $question_item['question']; -->
            <!-- REPLACED WITH: echo $question_item->question; -->
            <div class="list-group">
                <a href="<?php echo site_url('questions/viewquestion/' . $question_item->id); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"><?php echo $question_item->title; ?></h5>
                        <small><?php echo $time_asked; ?></small>
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
        echo "<h3>There are no posted " . $category_title['category'] . " type questions yet.</h3>";
        echo "</div>";
    }
    ?>   

    <div>
        <?php echo $links; ?>
    </div>

    <!--    FIX ME, TIME SINCE SHOULD BE IN CONTROLLER-->
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
</div>  
