<?php
//$ask_points = ($this->session->userdata['logged_in']['ask_points']);
//$answer_points = ($this->session->userdata['logged_in']['answer_points']);
//$total_points = $ask_points + $answer_points;
//$fname = ($this->session->userdata['logged_in']['fname']);
//$lname = ($this->session->userdata['logged_in']['lname']);
//$full_name = $fname . " " . $lname;
//$slug_full_name = $fname . "." . $lname;
$fname = $userInfo[0]->fname;
$lname = $userInfo[0]->lname;
$ask_points = $userInfo[0]->ask_points;
$answer_points = $userInfo[0]->answer_points;
$total_points = $ask_points + $answer_points;
$full_name = $fname . " " . $lname;
?>

<div class="container" id="mainDiv">
    <main class="ml-sm-auto pt-3" role="main">
        <h1><?php //echo $full_name; 
        echo $full_name; ?></h1> 
        <br>
        <br>
        <section class="row text-center placeholders">
            <div class="col-6 col-sm-4 placeholder">
                <h1><?php echo $ask_points; ?></h1>
                <!--                <h4>Points from Asking</h4>-->
                <span class="text-muted">Points from Asking</span>
            </div>
            <div class="col-6 col-sm-4  placeholder">
                <h1><?php echo $answer_points; ?></h1>
                <span class="text-muted">Points from Answering</span>
            </div>
            <div class="col-6 col-sm-4  placeholder">
                <h1><?php echo $total_points; ?></h1>
                <span class="text-muted">Total Points</span>
            </div>
        </section>
        <br>
        <br>
        <h2>Most Recent Questions <span class="text-muted"> <small><?php echo "(" . $num_of_question . ")"; ?> </small></span></h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Number of answers</th>
                        <th>Title of the Question</th>
                        <th>Date Posted</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        foreach ($userQuestions as $data):

                            echo "<tr>";
                            echo "<td>" . $data['num_of_answers'] . "</td>";
                            echo "<td>" . $data['title'] . "</td>";
                            echo "<td>" . $data['date_posted'] . "</td>";
                            echo "</tr>";

                        endforeach;
                        ?>  
                    </tr>
                </tbody>
            </table>
            <?php
            if ($num_of_question > 10) {
                echo "<a href=".site_url('profile/viewquestions/'.$id)."> View all questions.</a>";
            } else {
                echo "<a href='#'> (test) less than ten</a>";
            }
            ?>
            <br>
            <br>
            <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>
        </div>
    </main>
</div>

