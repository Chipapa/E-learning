<?php
if (isset($this->session->userdata['logged_in'])) {
    $session_id = ($this->session->userdata['logged_in']['id']);
    $username = ($this->session->userdata['logged_in']['username']);
    $usertype = ($this->session->userdata['logged_in']['usertype']);
    $fname = ($this->session->userdata['logged_in']['fname']);
    $lname = ($this->session->userdata['logged_in']['lname']);
    $full_name = $fname . " " . $lname;
} else {
    header("location: loginpage");
}
?>
<title><?php echo $title; ?></title>
<form type="post">
    <div class="container" id="mainDiv">
        <div class="row">
            <div class="col-sm-8">
                <h3>Most Recent Questions</h3>
            </div>
            <div class="col-sm-4 text-right">
                <p><a class="btn btn-large btn-outline-primary" href="<?php echo site_url('questions/viewAskQuestion'); ?>">Ask a Question</a></p>
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
            <div class="col-sm-8 blog-main">  
                <?php
                if ($questions != NULL) {
                    foreach ($questions as $question_item):
                        $full_name_db = $question_item->fname . " " . $question_item->lname;
                        //Questions posted by the logged in user will display a different time_asked and link_question format
                        if ($question_item->who_posted === $session_id) {
                            $time_asked = "You posted this question " . time_since(time() - strtotime($question_item->date_posted)) . " ago";
                        } else {
//                        $time_asked = "Asked " . time_since(time() - strtotime($question_item->date_posted)) . " ago by " . $question_item->who_posted;
                            $time_asked = "Asked " . time_since(time() - strtotime($question_item->date_posted)) . " ago by " . $full_name_db;
                        }
                        ?>     
                        <!-- OLD STYLE OF CALLING COLUMNS: echo $question_item['question']; -->
                        <!-- REPLACED WITH: echo $question_item->question; -->
                        <div class="list-group">
                            <a href="<?php echo site_url('questions/viewquestion/' . $question_item->id); ?>" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $question_item->title; ?>

                <!--                                        <img src="<?php
//                                        if ($question_item->status === 'unverified') {
//                                            echo base_url() . "/assets/png/timer-2x.png";
//                                        } else 
//                                        if ($question_item->status === 'verified') {
//                                            echo base_url() . "/assets/png/circle-check-2x.png";
//                                        } else if ($question_item->status === 'removed') {
//                                            echo base_url() . "/assets/png/circle-x-2x.png";
//                                        }
                                        ?>">-->

                                        <?php
                                        if ($question_item->status === 'verified') {
                                            echo "<img src='" . base_url() . "/assets/png/circle-check-2x.png" . "'data-toggle='tooltip' data-placement='bottom' title='Verified'>";
                                        } else if ($question_item->status === 'removed') {
                                            echo "<img src='" . base_url() . "/assets/png/circle-x-2x.png" . "'data-toggle='tooltip' data-placement='bottom' title='Rejected'>";
                                        }
                                        ?>

                                    </h5>
                                    <small><?php echo $time_asked; ?></small>
                                </div>
        <!--                                <p class="mb-1"><?php //echo $question_item->question;             ?></p>-->

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
                <!--test-->

                <div>
                    <?php echo $links; ?>
                </div>

            </div>       
            <!--        style="border:1px solid; -->
            <!--        <div class="col-md-auto rounded bg-faded card" style="padding:15px">
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
                    </div>-->

            <div class="col-sm-3 offset-sm-1 blog-sidebar">
                <hr>
                <div class="sidebar-module">
                    <h4 class="text-center">Top 10</h4>
                    <div class="list-group">

                        <?php
                        if (isset($leaderboard)) {
                            foreach ($leaderboard as $test_item) {
                                //echo "<a href='#' class='list-group-item list-group-item-action'>" . $test_item[0] . "-" . $test_item[1] . "</a>";
                            }
                        }
                        ?>                                              
                    </div>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($leaderboard)) {
                                foreach ($leaderboard as $test_item) {
                                    echo "<tr> ";
                                    echo "<td> <a href='" . site_url("profile/viewprofile/" . $test_item[2]) . "'>" . $test_item[0] . "</a></td>";
                                    echo "<td>" . $test_item[1] . "</td>";
                                    echo "</tr> ";
                                }
//                                echo "<pre>";
//                                print_r($leaderboard);
//                                echo "</pre>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div><!-- /.blog-sidebar -->

            <pre>
                <?php //print_r($questions); ?>
            </pre>
        </div>
    </div>

    <?php echo '</form>'; ?>
<!--<script type="text/javascript">
$(document).ready(function () {
    //alert();
    $.ajax({
        type: "POST",
        url: "<?php //echo base_url();           ?>" + "index.php/profile/getleaderboard",
        dataType: 'json',
        data: {sampleData: 'HELLO'},
        success: function (data) {
            console.log(data);
            //foreach display choices in Radio buttons
        },
        error: function (){
            alert("HINDI GUMANA");
        }
    });
});
</script>-->


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

