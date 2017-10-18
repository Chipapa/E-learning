<div class="container" id="mainDiv" ng-controller="askCtrl" >
    <form method="post" ng-submit="submit()" name="askForm" novalidate>

        <!--CATEGORIES-->
        <?php $categories = $_SESSION['categories']; ?>     
        <div class="form-group">
            <label for="exampleFormControlSelect1">Question Category</label>
            <select name="category" class="form-control" ng-model="ngcategory" required>
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
            <span style="color:red" ng-show="(askForm.category.$touched || submitted) && askForm.category.$error.required">
                Category is required.
            </span>
        </div>

        <!--TITLE-->
        <div class="form-group">          
            <label for="inputEmail3">Title</label>
            <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Title of the question" ng-model="ngtitle" required> 
            <span style="color:red" ng-show="(askForm.title.$touched || submitted) && askForm.title.$error.required">
                Title is required.
            </span>
        </div>

        <!--QUESTION-->
        <div class="form-group">
            <label for="inputPassword3">Question</label>
            <textarea class="form-control" name="question" id="inputQuestion" rows="3" ng-model="ngquestion" required></textarea>
            <span style="color:red" ng-show="(askForm.question.$touched || submitted) && askForm.question.$error.required">
                Question is required.
            </span>
        </div>

        <!--TYPE OF QUESTION-->
        <div class="form-group">
            <label for="exampleFormControlSelect1">Type of Question</label>
            <select name="type" class="form-control" id="questionType" ng-model="ngquestion_type" onmousedown="this.value = '';" onchange="selectDiv(this.value);" required>
                <option value="Multiple Choice" selected>Multiple Choice</option>
                <option value="Coding">Coding</option>
                <option value="Identification">Identification</option>
            </select>
            <span style="color:red" ng-show="(askForm.type.$touched || submitted) && askForm.type.$error.required">
                Type of question is required.
            </span>
        </div>

        <!--        <div ng-switch="ngquestion_type">-->
        <!--MULTIPLE CHOICE-->
        <div class="form-group" id="divMultipleChoice">            
            <fieldset class="form-group">
                <!--            <div class="row">-->
                <legend class="col-form-legend">Enter four potential answers then select the correct answer to the given question.</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios1" value="option1" ng-model="ngradio1" checked>
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice1" id="inputChoice">
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios2" value="option2" ng-model="ngradio2">
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice2" id="inputChoice">
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios3" ng-model="ngradio3" value="option3">
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice3" id="inputChoice">
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <div class="col-lg-6">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="radio" aria-label="Radio button for following text input" name="gridRadios" id="gridRadios4" ng-model="ngradio4" value="option4">
                                </span>
                                <input type="text" class="form-control" aria-label="Text input with radio button" name="inputChoice4" id="inputChoice">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>

        <!--CODING-->
        <div class="form-group" id="divCoding">
            <label>Type the code below.</label>
            <textarea class="form-control codemirror-textarea-question" name="codingAnswer" ng-model="ngcoding_answer"></textarea>
        </div>

        <!--IDENTIFICATION-->
        <div class="form-group" id="divIdentification">
            <label>Enter the answer to the question.</label>
            <input type="text" class="form-control" name="identificationAnswer" placeholder="Answer to the question" ng-model="ngidentification_answer" required="">
            <span style="color:red" ng-show="(askForm.identificationAnswer.$touched || submitted) && askForm.identificationAnswer.$error.required">
                Identification is required.
            </span>
        </div>
        <!--        </div>-->

        <!--SUBMIT-->
        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" id="submitQuestion">
                    Submit Question
                </button>
            </div>
        </div>

        <p><pre>{{message}}</pre></p>

        <script>
                    var app = angular.module('elearning', []);
                    app.controller('askCtrl', function ($scope, $http) {
                        $scope.submit = function () {
                            $scope.submitted = true;
                            $http({
                                method: 'POST',
                                url: '<?php echo base_url(); ?>Questions/testangular',
                                headers: {'Content-Type': 'application/json'},
                                data: JSON.stringify({
                                    category: $scope.ngcategory,
                                    title: $scope.ngtitle,
                                    question: $scope.ngquestion,
                                    type: $scope.ngquestion_type
//                            choice1_answer: $scope.ngradio1,
//                            choice2_answer: $scope.ngradio2,
//                            choice3_answer: $scope.ngradio3,
//                            choice4_answer: $scope.ngradio4,
//                            coding_answer: $scope.ngcoding_answer,
//                            identification_answer: $scope.ngidentification_answer
                                })
                            }).then(function (response) {
                                window.location.href = "<?php echo site_url("questions/index");  ?>"

                                //debugging purposes, remove me
                                console.log(response);
                                $scope.message = response.data;
                            });
                        };
                    });
        </script>
    </form>
    <?php //echo '</form>'; ?>
</div>
