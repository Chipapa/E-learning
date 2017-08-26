<div class="container" id="mainDiv">

    <h1>Landing Page</h1>

    <div class="row">
        <div class="col">
            <?php foreach ($questions as $question_item): ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo $question_item['question']; ?></h4>
                        <h6 class="card-subtitle mb-2 text-muted">Asked <?php echo time_since(time() - strtotime($question_item['date_posted'])); ?> ago</h6>
                        <p class="card-text"><?php echo $question_item['question']; ?></p>
                        <p class="card-text text-muted">This question was answered by <?php echo $question_item['num_of_answers']; ?> student(s)</p>
                        <a href="<?php echo site_url('questions/viewquestion/'. $question_item['id']); ?>" class="card-link">Answer Question</a>
                    </div>
                </div>
                <br/>

            <?php endforeach; ?>
        </div>       
            <!--style="border:1px solid; -->
            <div class="col-md-auto rounded bg-faded" style="padding:20px" >
                <h4>Leaderboards</h4>
                <ul>
                    <li>
                        1
                    </li>
                    <li>
                        2
                    </li>
                    <li>
                        3
                    </li>
                </ul>
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

