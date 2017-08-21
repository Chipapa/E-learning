<div class="container" id="mainDiv">
    <p><?php echo $category_item['category']; ?> Page</p>

    <?php foreach ($category_item as $question_item): ?>
        <div class="card" style="height: 50px;">
            <div class="card-body">
                <div class="row">
                    <div class="col-8">
                        <a href="<?php //echo site_url('stockmarket/viewcategory/' . $category_item['slug']); ?>">
                            
                        </a>
                        <?php //echo $question_item['category']; ?>
                    </div>
                    <div class="col-4">
                        Answered: <?php //echo $category_item['answered']; ?> |
                        Unanswered: <?php //echo $category_item['unanswered']; ?>
                    </div>
                </div>
            </div>
        </div>
        <br/>
    <?php endforeach; ?>
</div>  
