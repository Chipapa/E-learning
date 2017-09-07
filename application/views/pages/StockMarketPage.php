<div class="container" id="mainDiv">
    <p>Stock Market Page</p>

    <?php //foreach ($categories as $category_item): ?>
    <!--        <div class="card" style="height: 50px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <a href="<?php //echo site_url('stockmarket/viewcategory/' . $category_item['slug']);   ?>">
    <?php //echo $category_item['category']; ?>
                            </a>
                        </div>
                        <div class="col-4 text-right">
                            Answered: <?php //echo $category_item['answered'];   ?> |
                            Unanswered: <?php //echo $category_item['unanswered'];   ?>
                        </div>
                    </div>
                </div>
            </div>
            <br/>-->
    <?php //endforeach; ?>

    <?php foreach ($categories as $category_item): ?>
<!--        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-end align-right">
                <div class="mr-auto p-2">
                    <a href="<?php //echo site_url('stockmarket/viewcategory/' . $category_item['slug']); ?>">
                        <?php //echo $category_item['category']; ?>
                    </a>
                </div>
                <span class="badge badge-success">Answered: <?php //echo $category_item['answered']; ?> </span>
                &nbsp;
                <span class="badge badge-info">Unanswered: <?php //echo $category_item['unanswered']; ?> </span>
            </li>
            <br/>
        </ul>-->

        <div class="list-group">
            <a href="<?php echo site_url('stockmarket/viewcategory/' . $category_item['slug']); ?>" class="list-group-item list-group-item-action justify-content-end align-right">
                <div class="mr-auto p-2">
                    <h6 class="mb-1"><?php echo $category_item['category']; ?></h6>
                    <small> <?php //echo time_since(time() - strtotime($question_item->date_posted));  ?>  <?php //echo $time_asked ?></small>
                </div>                    
                <div>
                    <span class="badge badge-default ">Answered: <?php echo $category_item['answered']; ?>  </span>
                    <span class="badge badge-default">Unanswered: <?php echo $category_item['unanswered']; ?> </span>
                </div>
            </a>
            <br>
        </div> 
    <?php endforeach; ?>
</div>  

