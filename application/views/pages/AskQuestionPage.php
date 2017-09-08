<div class="container" id="mainDiv">

    <!--<form>-->

    <div class="form-group">
        <?php
        if (validation_errors()) {
            echo "<div class='alert alert-danger' role='alert'>";

            echo validation_errors();
            echo "</div>";
        }
        ?>

        <?php
        echo form_open('questions/create');
        //echo form_open();
        ?>     

        <!--        TEST DIV FOR JSON, REMOVE ME-->
        <div id="testJson" style="display: none">
            <div id="titleValue">

            </div>
        </div>


        <?php $categories = $_SESSION['categories']; ?>     
        <div class="form-group">
            <label for="exampleFormControlSelect1">Question Category</label>
            <select name="category" class="form-control" onmousedown="this.value = '';" onchange="selectDiv(this.value);">
                <?php foreach ($categories as $category_item): ?>
                    <option><?php echo $category_item['category']; ?></option>

                    <?php
                endforeach;
                unset($_SESSION['categories']);
                ?>

            </select>
        </div>

        <label for="inputEmail3">Title</label>
        <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title of the question">
    </div>
    <div class="form-group">
        <label for="inputPassword3">Question</label>
        <textarea class="form-control" name="question" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1">Type of Question</label>
        <select name="type" class="form-control" onmousedown="this.value = '';" onchange="selectDiv(this.value);" id="questionType">
            <option value="Multiple Choice">Multiple Choice</option>
            <option value="Coding">Coding</option>
            <option value="Identification">Identification</option>
        </select>
    </div>

    <div class="form-group" id="divMultipleChoice">            
        <fieldset class="form-group">
            <!--            <div class="row">-->
            <legend class="col-form-legend">Enter four potential answers then select the correct answer to the given question.</legend>
            <div class="col-sm-10">
                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios1" value="option1" checked>
                            </span>
                            <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice1" id="inputChoice">
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios2"  value="option2">
                            </span>
                            <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice2" id="inputChoice">
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios3"  value="option3">
                            </span>
                            <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice3" id="inputChoice">
                        </div>
                    </div>
                </div>

                <div class="form-check">
                    <div class="col-lg-6">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios4"  value="option4">
                            </span>
                            <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice4" id="inputChoice">
                        </div>
                    </div>
                </div>
            </div>

            <!--            </div>-->
        </fieldset>
    </div>

    <div class="form-group" id="divCoding">
        <label>Type the code below.</label>
        <textarea class="form-control codemirror-textarea-question" name="codingAnswer"></textarea>
    </div>

    <div class="form-group" id="divIdentification">
        <label>Enter the answer to the question.</label>
        <input type="text" class="form-control" name="identificationAnswer" placeholder="Answer to the question">   
    </div>


    <div class="form-group row">
        <div class="col-sm-10">
            <button type="submit" class="btn btn-primary" id="submitQuestion">Submit Question</button>
        </div>
    </div>
</form>
</div>
