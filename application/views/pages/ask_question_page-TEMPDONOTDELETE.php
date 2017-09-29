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
        //$attributes = array('novalidate' => '', 'id' => 'needs-validation');
        echo form_open('questions/create', 'id="needs-validation" name="askForm" novalidate="" ');
        //echo form_open('id="needs-validation" name="askForm" ng-submit="submit()" ng-controller="MyCtrl" novalidate=""');
        ?>     

        <?php
        //TEXT JSON, REMOVE ME
        echo '<div id="testJson" style="display: none" class="alert alert-danger" role="alert">';
        echo '<div id="titleValue">';
        echo '</div>';
        echo '</div>';
        ?>

        <?php $categories = $_SESSION['categories']; ?>     
        <div class="form-group">
            <label for="exampleFormControlSelect1">Question Category</label>
            <select name="category" class="form-control" onmousedown="this.value = '';" onchange="selectDiv(this.value);">
                <?php foreach ($categories as $category_item): ?>
                    <option<?php
                    if (isset($category)) {
                        if ($category_item['category'] === $category) {
                            echo " selected='selected'>" . $category;
                        } else {
                            echo ">" . $category_item['category'];
                        }
                    } else {
                        echo ">" . $category_item['category'];
                    }
                    ?></option>

                    <?php
                endforeach;
                ?>

            </select>
        </div>

        <label for="inputEmail3">Title</label>
        <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title of the question" ng-model="title" required>
<!--        <span style="color:red" ng-show="askForm.title.$invalid && askForm.title.$touched">-->
<!--        <span style="color:red" ng-show="askForm.title.$touched">
            <span ng-show="askForm.title.$error.required">Title is required.</span>
        </span>-->
        <span style="color:red" ng-show="(askForm.title.$touched || askForm.$submitted) && askForm.title.$error.required">
            Title is required.
        </span>

    </div>

    <div class="form-group">
        <label for="inputPassword3">Question</label>
        <textarea class="form-control" name="question" id="inputQuestion" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Type of Question</label>
        <select name="type" class="form-control" onmousedown="this.value = '';" onchange="selectDiv(this.value);" id="questionType">
            <option value="Multiple Choice" selected>Multiple Choice</option>
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
            <button type="submit" class="btn btn-primary" id="submitQuestion" ng-disabled="askForm.title.$touched && askForm.title.$invalid">
                <!--            <button type="submit" class="btn btn-primary" id="submitQuestion">-->
                Submit Question
            </button>
        </div>
    </div>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
//        (function ()  {
//            "use strict";
//            window.addEventListener("load", function () {
//                var form = document.getElementById("needs-validation");
//                form.addEventListener("submit", function (event) {
//                    if (form.checkValidity() === false) {
//                        event.preventDefault();
//                        event.stopPropagation();
//                    }
//                    form.classList.add("was-validated");
//                }, false);
//            }, false);
//        }());

//        $("#submitQuestion").click(function (event) {
//            if ($("#questionType").val() === "Multiple Choice") {
//                var values = [];
//                $("input[id='inputChoice']").each(function () {
//                    values.push($.trim($(this).val()));
//                });
//
//                var dups = false;
//                var emptyChoices = false;
//                for (var i = 0; i < values.length - 1; i++) {
//                    if (values[i + 1] === values[i]) {
//                        //results.push(values[i]);
//                        dups = true;
//                    }
//                    if (values[i] === "") {
//                        emptyChoices = true;
//                    }
//                }
//                //alert(results.join("\n"));
////            if (emptyChoices === true) {
////                alert("Choices cannot have blank answers.");
////            } else
//                if (dups === true && emptyChoices === true) {                   
//                    event.preventDefault();
//                    jQuery("div#testJson").show();
//                    //alert("Choices cannot have duplicates.");
//                    //var javascriptVariable = "John";
//                    //window.location.href = "<?php //echo base_url();                            ?>" + "index.php/questions/create?dups=" + dups;
//                }
//            }
//        });

//        $("#submitQuestion").click(function (event) {
//            //alert("test alert");        
//           // event.preventDefault();            
//            var title = $("#inputTitle").val();
//            var question = $("#inputQuestion").val();
//            jQuery.ajax({
//                type: "POST",
//                url: "<?php //echo base_url();                   ?>" + "index.php/questions/create",
//                dataType: 'json',
//                data: {
//                    inputTitle: title, 
//                    inputQuestion: question
//                },
//                success: function (res) {
//                    if (res)
//                    {
//                        // Show Entered Value 
//                        jQuery("div#testJson").show();
//                        jQuery("div#titleValue").html(res);
//                    }
//                }
//            });

//            jQuery.ajax({
//                type: "POST",
//                url: "<?php //echo base_url();                  ?>" + "index.php/questions/create",
//                dataType: 'json',
//                data: {
//                    inputTitle: title, 
//                    inputQuestion: question
//                },
//                success: function (data) {
//                    alert(data.question);
//                }
//            });
//        });
    </script>

    <?php echo '</form>'; ?>
</div>
