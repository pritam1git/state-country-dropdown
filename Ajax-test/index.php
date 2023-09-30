<?php
include_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //echo "<pre>";print_r($_POST);die;
    $firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
    $lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $address1 = isset($_POST['address1'])?$_POST['address1']:'';
    $address2 = isset($_POST['address2']) ? $_POST['address2']:'';
    $country = isset($_POST['country']) ? $_POST['country']:'';
    $state  = isset($_POST['state']) ? $_POST['state']:'';
    $city = isset($_POST['city']) ? $_POST['city']:'';

            // You're adding a new record
            $sql = "INSERT INTO s_form (fname, lname, email, phone,address1,address2,country,state,city) 
                    VALUES ('$firstname', '$lastname', '$email', '$phone', '$address1','$address2','$country','$state','$city')";

        if ($conn->query($sql)) {
            
            echo "user registered";
        }else{
            echo "user not registered";
        }

    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>registration form</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="row">
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data" id="insert-form">
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">FirstName:</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter FirstName" name="firstname" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">LastName:</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter LastName" name="lastname" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Phone:</label>
                            <input type="number" class="form-control" id="phone" placeholder="Enter phone no." name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">First Address:</label>
                            <input type="text-area" class="form-control" id="address1" placeholder="Enter address" name="address1" required>
                        </div>
                        <div class="mb-3">
                            <label for="number" class="form-label">Second Address:</label>
                            <input type="text-area" class="form-control" id="address2" placeholder="Enter address" name="address2" required>
                        </div>
                        <div class="form-group">
                            <label for="country">Country</label>
                            <select class="form-control" id="country-dropdown"name="country">
                                <option value="">Select Country</option>
                                <?php
                            

                                $result = mysqli_query($conn, "SELECT * FROM tbl_countries");

                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row["name"]; ?></option>
                                <?php
                                }
                                ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="state">State</label>
                            <select class="form-control" id="state-dropdown" name="state">

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="city">City</label>
                            <select class="form-control" id="city-dropdown" name="city">

                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 mb-4">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {

            $('#country-dropdown').on('change',function(){
                var country_id = this.value;
                $.ajax({
                    url : "state.php",
                    type:"POST",
                    data :{
                        country_id :country_id
                    },
                    cache :false,
                    success:function(response){
                        $("#state-dropdown").html(response);
                    }
                });
            });


            $('#state-dropdown').on('change',function(){
                var state_id = this.value;
                $.ajax({
                    url : "city.php",
                    type : "POST",
                    data :{
                        state_id : state_id
                    },
                    cache :false,
                    
                    success : function(response){
                        $("#city-dropdown").html(response);
                        
                    }
                });
            });
        });
    </script>
</body>

</html>