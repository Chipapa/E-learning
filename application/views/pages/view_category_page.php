<div class="container" id="mainDiv">

    <div class="row">
        <div class="col-sm-8">
            Page
        </div>
        <div class="col-sm-4">
            <p><a class="btn btn-large btn-info" href="<?php echo site_url('stockmarket/viewquestion/'); ?>">Ask a Question</a></p>
        </div>

<!--        <p><?php //echo $category_item['question'];          ?> Page</p>
<p><button type="button" class="btn btn-primary">Ask a Question</button></p>-->
    </div>

    <?php foreach ($category_item as $question_item): ?>           
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"><?php echo $question_item['question']; ?></h4>
                <h6 class="card-subtitle mb-2 text-muted">Asked <?php echo time_since(time() - strtotime($question_item['date_posted'])); ?> ago</h6>
                <p class="card-text"><?php echo $question_item['question']; ?></p>
                <p class="card-text text-muted">This question was answered by <?php echo $question_item['num_of_answers']; ?> student(s)</p>
                <a href="<?php echo site_url('stockmarket/viewquestion/'); ?>" class="card-link">Answer Question</a>
            </div>
        </div>
        <br/>
    <?php endforeach; ?>

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
