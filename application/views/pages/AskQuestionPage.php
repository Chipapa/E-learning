<div class="container" id="mainDiv">
    <form>
        <div class="form-group">
            <label for="inputEmail3">Title</label>
            <input type="text" class="form-control" id="inputEmail3" placeholder="Title of the question">
        </div>
        <div class="form-group">
            <label for="inputPassword">Question</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="questionType">Type of Question</label>
            <select class="form-control" id="exampleFormControlSelect1" onmousedown="this.value = '';" onchange="selectDiv(this.value);">
                <option value="Multiple Choice">Multiple Choice</option>
                <option value="Coding">Coding</option>
                <option value="Identification">OOP Identification</option>
            </select>
        </div>

        <div id="multipleChoiceDiv">
            <fieldset class="form-group">
                <!--            <div class="row">-->
                <legend class="col-form-legend">Select the correct answer to the question.</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            Option one is this and that&mdash;be sure to include why it's great
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            Option two can be something else and selecting it will deselect option one
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" disabled>
                            Option three is disabled
                        </label>
                    </div>
                </div>
                <!--            </div>-->
            </fieldset>
        </div>

        <div id="codingDiv" class="form-group">
            <label for="inputPassword">Type the code below.</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>

        <div id="identificationDiv" class="form-group">
            <label for="questionType">Select the correct answer.</label>
            <select class="form-control" id="exampleFormControlSelect1">
                <option>Adapter</option>
                <option>Composite</option>
                <option>Decorator</option>
            </select>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary" id="submitQuestion">Submit Question</button>
            </div>
        </div>
    </form>
</div>




