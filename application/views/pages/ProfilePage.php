
<?php

 

$ask_points = ($this->session->userdata['logged_in']['ask_points']);
$answer_points = ($this->session->userdata['logged_in']['answer_points']);
//if($answer_points ==0)
//{
//    $answer_points= 1;
//}else{$answer_points = ($this->session->userdata['logged_in']['answer_points']);}

$total_points = $ask_points + $answer_points;

$fname = ($this->session->userdata['logged_in']['fname']);
$lname = ($this->session->userdata['logged_in']['lname']);
$full_name = $fname . " " . $lname;
?>

<div class="container-fluid" id="mainDiv">
    <div class="row">

        <main class="col-sm-9 ml-sm-auto col-md-10 pt-3" role="main">
            <h1><?php echo $full_name; ?></h1>

            <section class="row text-center placeholders">
                <div class="col-6 col-sm-3 placeholder">
<!--                    <img src="data:image/gif;base64,R0lGODlhAQABAIABAAJ12AAAACwAAAAAAQABAAACAkQBADs=" width="200" height="200" class="img-fluid rounded-circle" alt="Generic placeholder thumbnail">-->
                    <h1><?php
                        echo $ask_points;
                        ?></h1>
                    <div class="text-muted">Asking Points</div>
                </div>
                <div class="col-6 col-sm-3 placeholder">
                    <h1><?php echo $answer_points ?></h1>
                    <span class="text-muted"> Answering Points</span>
                </div>
                <div class="col-6 col-sm-3 placeholder">
                    <h1><?php echo $total_points?></h1>
                    <span class="text-muted">Total Points</span>
                </div>
            </section>

            <h2>Question Posted</h2>
            <div class="table-responsive">
              <table class="table">
  <thead class="thead-inverse">
    <tr>
       <th># of answers</th>
      <th>Title of Question </th>
      <th>Date Posted</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($myQuestions as $data):
     
            echo "<tr><td>".$data['num_of_answers']."</td>";
            echo " <td>".$data['title']."</td>";
            echo "<td>".$data['date_posted']."</td>";
            echo "</tr>";
        
        endforeach;
       ?>  
      
  </tbody>
</table>


            </div>
            <?php echo date('Y-m-d H:i:s'); ?>
            <b><a href="<?php echo site_url('pages/logout'); ?>">Logout</a></b>

            <pre>
                <?php echo print_r($this->session->all_userdata()); ?>
            </pre>
        </main>
    </div>
</div>
</div>

