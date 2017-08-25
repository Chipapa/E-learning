
<footer class="footer">
    <div class="container">
        <span class="text-muted">&copy; CQV 2017</span>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<!--put in separate js file-->
<script>
    $(document).ready(function () {
        $("#codingDiv").hide();
        $("#identificationDiv").hide();
    });

    function selectDiv(value) {
        if (value === "Multiple Choice") {
            $("#multipleChoiceDiv").show();
            $("#codingDiv").hide();
            $("#identificationDiv").hide();
        }
        else if (value === "Coding") {
            $("#codingDiv").show();
            $("#multipleChoiceDiv").hide();
            $("#identificationDiv").hide();
        }
        else if (value === "Identification") {
            $("#identificationDiv").show();
            $("#codingDiv").hide();
            $("#multipleChoiceDiv").hide();
        }
    };
</script>

</body>
</html>