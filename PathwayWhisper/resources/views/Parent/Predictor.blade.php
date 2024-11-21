@extends('parent.layouts.main')
@section('content')
<style>
    #popup {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            z-index: 999;
            border-radius: 10px;
            text-align: center;
            width: 80%;
            max-width: 400px;
        }

        #popup h2 {
            color: #333;
            margin-bottom: 10px;
        }

        #popupResult {
            font-weight: bold;
            color: #4CAF50;
            font-size: 18px;
        }
</style>
<div class="container centered-div">
  <div class="form-container">
    <h1 class="text-center mb-4">AI Career Suggestion</h1>


      <!-- Loop through feature_names to generate select boxes -->
      <?php
        $feature_names = [
          "Database Administrator",
          "Technical Writer",
          "Helpdesk Engineer",
          "Data Scientist",
          "Customer Service Executive",
          "Business Analyst",
          "Software tester",
          "ML Specialist",
          "Information Security Specialist",
          "Hardware Engineer",
          "Project Manager",
          "API Specialist",
          "Software Developer",
          "Networking Engineer",
          "Cyber Security Specialist",
          "Application Support Engineer",
          "Graphics Designer"
        ];

        // Options for each select box
        $options = [
          "Not Interested",
          "Poor",
          "Beginner",
          "Average",
          "Intermediate",
          "Excellent",
          "Professional"
        ];

        $i=1;
        foreach ($feature_names as $feature) {
          echo "<div class='form-group mt-4'>";
          echo "<label style='color:black' for='select" . str_replace(' ', '', $feature) . "'>$feature:</label>";
          echo "<select class='form-control'  style='border:none' id='feature" .$i++. "' name='select" . str_replace(' ', '', $feature) . "'>";

          // Loop through options to generate option tags
          foreach ($options as $index => $option) {
            echo "<option value='$index'>$option</option>";
          }

          echo "</select>";
          echo "</div>";
        }
      ?>

      <button type="submit" class="mt-4 btn btn-primary" onclick="predict()">Submit</button>

  </div>
</div>
<div id="popup">
        <h2>Prediction</h2>
        <p id="popupResult" class="text-primary"></p>
        <button onclick="closePopup()" class="btn btn-primary">Close</button>
    </div>


<!-- Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function predict() {
       
         // Fetch values from form
    var features = [];
    <?php for ($i = 0; $i < 17; $i++) { ?>
        features.push(parseInt(document.getElementById("feature<?php echo $i+1; ?>").value));
    <?php } ?>

    // Prepare the query string
    var queryString = features.map((val, i) => `feature${i+1}=${val}`).join('&');
        console.log(queryString);
    // Make an API request to Flask server
    $.ajax({
      url: "http://127.0.0.1:5000/predict?" + queryString,
        type: "GET",
        success: function(response) {

            document.getElementById("popupResult").innerText = `Prediction: ${response.prediction[0]}`;
                    document.getElementById("popup").style.display = "block";

        },
        error: function(error) {
          console.log(error);
        }
    });
    }
    function closePopup() {
            // Close the popup
            document.getElementById("popup").style.display = "none";
        }
</script>
        

@endsection