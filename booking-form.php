<?php
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include('config/db_connect.php');

function eticket($email, $fullname, $bookingDetails)
{
    require "vendor/autoload.php";
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'normaypangan@gmail.com';
        $mail->Password   = 'yqlx tpas vjoc wapb';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('normaypangan@gmail.com', 'Normay');
        $mail->addAddress($email, $fullname);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Booking Confirmation and E-Ticket from Journey Masters';

        
        $head = "Thank you for booking with Journey Masters, $fullname!<br><br>";

        $eTicketContent = content($bookingDetails);

        $mail->Body = $head . $eTicketContent;

        // Send email
        $mail->send();

        // action after

    } catch (Exception $e) {
        // Handle exceptions or errors here
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
function content($booking)
{
    $content = "<div style='background: #e0e2e8; width: 90%; padding: 20px; border-radius: 10px;'>";
    $content .= "<h2 style='color: #333; text-align: center; margin-bottom: 20px;'>E-Ticket</h2>";
    $content .= "<div class='container-fluid'>";
    $content .= "<div class='col-sm-6 text-right'>";
    $content .= "<div class='ticket light' style='background-color: white; color: #161616; display: inline-block; max-width: 320px; text-align: left; text-transform: uppercase; width: 100%;'>";
    $content .= "<div class='ticket-head' style='background-position: center; background-size: cover; border-radius: 4px 4px 0 0; color: white; height: 140px; position: relative;'>";
    $content .= "<div class='layer' style='background-color: #173A52; border-radius: 4px 4px 0 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%; z-index: 1;'></div>";
    $content .= "<div class='from-to ams' style='text-align: center; font-size: 24px; font-weight: 600; width: 100%; z-index: 3;'>";
    $content .= "</div></div>";
    $content .= "<div class='ticket-body' style='border-bottom: 2px dashed black; padding: 15px 45px; position: relative;'>";
    $content .= "<p style='color: #A2A2A2; font-size: 12px;'>PASSENGER</p>";
    $content .= "<h4 style='color: #161616; font-weight: bold;'>{$booking['name']}</h4>";
    $content .= "<div class='flight-info row' style='margin-top: 15px;'>";
    $content .= "<div class='col-xs-6'>";
    $content .= "<p style='font-size: 12px; color: #A2A2A2;'>AIRLINE</p>";
    $content .= "<h4 style='color: #161616;'>{$booking['airlines']}</h4></div>";
    $content .= "<div class='col-xs-6'>";
    $content .= "<p style='font-size: 12px; color: #A2A2A2;'>DESTINATION</p>";
    $content .= "<h4 style='color: #161616;'>{$booking['destination']}</h4></div>";
    $content .= "<p style='font-size: 12px; color: #A2A2A2;'>CLASS</p>";
    $content .= "<h4 style='color: #161616;'>{$booking['class']}</h4></div>";

    $content .= "<div class='row' style='margin-top: 15px;'>";
    $content .= "<div class='col-xs-6'>";
    $content .= "<p style='color: #A2A2A2; font-size: 12px;'>DEPARTURE DATE</p>";
    $content .= "<h4 style='color: #161616; margin-top: 5px;'>{$booking['departure_date']}</h4>";
    $content .= "</div>";
    $content .= "<div class='col-xs-6'>";
    $content .= "<p style='color: #A2A2A2; font-size: 12px;'>RETURN DATE</p>";
    $content .= "<h4 style='color: #161616; margin-top: 5px;'>{$booking['return_date']}</h4>";
    $content .= "</div>";
    $content .= "</div>";

    $content .= "</div>";
    $content .= "<div class='footer' style='color: #A2A2A2; font-family: \"IM Fell French Canon\"; font-size: 14px; font-style: italic; line-height: 1.25; padding: 15px 25px; text-transform: none; background-color: white;'>";
    $content .= "Your Trusted Travel Partner. E-Ticket for {$booking['name']}. For assistance, contact JourneyMasters Customer Service</div>";
    $content .= "</div></div></div></div></div>";

    return $content;
}


$fullname = $email = $telNo = $airlines = $destination = $departureDate = $returnDate = $class = $card ='';
$errors = array('name' => '', 'email' => '', 'telNo' => '', 'departure_city' => '', 'destination_city' => '', 'departure_date' => '', 'return_date' => '', 'class' => '' , 'card' => '');

if (isset($_POST['submit'])) {

    // check fullname
    if (empty($_POST['name'])){
        $errors['name'] = 'Fullname is required';
    }
    else {
        $fullname = $_POST['name'];
    }
    // check email
    if (empty($_POST['email'])){
        $errors['email'] = 'Email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors['email'] = 'Email must be a valid email address';
        }
    }

    // check telNo
    if (empty($_POST['telNo'])){
        $errors['telNo'] = 'Phone Number is required';
    } else {
        $telNo = $_POST['telNo'];
        if (!is_numeric($telNo)) {
            $errors['telNo'] = 'Phone Number must contain only numbers';
        }
    }

    // check airlines
    if (empty($_POST['airlines'])){
        $errors['airlines'] = 'Airline is required';
    } else {
        $airlines = $_POST['airlines'];
    }

    // check destination
    if (empty($_POST['destination'])){
        $errors['destination'] = 'Destination is required';
    } else {
        $destination = $_POST['destination'];
    }

    // check departure date
    if (empty($_POST['departure_date'])){
        $errors['departure_date'] = 'Departure Date is required';
    } else {
        $departureDate = $_POST['departure_date'];
    }

    // check return date
    if (empty($_POST['return_date'])){
        $errors['return_date'] = 'Return Date is required';
    } else {
        $returnDate = $_POST['return_date'];
    }

    // check class
    if (empty($_POST['class'])){
        $errors['class'] = 'Class is required';
    } else {
        $class = $_POST['class'];
    }

    // check card 
    if (empty($_POST['card'])){
        $errors['card'] = 'Card Number is required';
    } else {
        $card = $_POST['card'];
        if (!is_numeric($card)) {
            $errors['card'] = 'Card Number must contain only numbers';
        }
    }

    if(array_filter($errors)) {
        // Handle errors if any
    } else {
        $fullname = mysqli_real_escape_string($conn, $_POST["name"]); 
        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $telNo = mysqli_real_escape_string($conn, $_POST["telNo"]);
        $airlines = mysqli_real_escape_string($conn, $_POST["airlines"]);
        $destination = mysqli_real_escape_string($conn, $_POST["destination"]);
        $departureDate = mysqli_real_escape_string($conn, $_POST["departure_date"]);
        $returnDate = mysqli_real_escape_string($conn, $_POST["return_date"]);
        $class = mysqli_real_escape_string($conn, $_POST["class"]);

        // create sql
        $sql = "INSERT INTO `bookings`(`full_name`, `email`, `phone_number`, `airlines`, `destination`, `departure_date`, `return_date`, `class`, `card_number`) VALUES ('$fullname','$email','$telNo','$airlines','$destination','$departureDate','$returnDate','$class', '$card')";
        echo "<script>alert('You successfully created your booking. Kindly check your email.')</script>";
        eticket($email, $fullname, $_POST);

        // save to database and check 
        if (mysqli_query($conn, $sql)){
            // success
            $fullname = $email = $telNo = $airlines = $destination = $departureDate = $returnDate = $class = $card = '';
        } else {
            echo 'query error: '. mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html> 
<html lang="en">

<?php include('templates/header.php'); ?>

<style>
    body {
        margin: 0;
        padding: 0;
    }
    #background-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: -1;
        opacity: 50%;
    }
    .container-booking {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border:1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
    }
    .container .row {
        margin: 5px;
        padding-top: 15px;
    }
    .section-booking {
        padding: 30px 30px;
    }
    .poster img {
        width: 100%;
        height: auto;
        max-width: 100%;
        border-radius: 15px;
    }
    .poster {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        margin-top: 70px;
    }
    .btn {
    transition: all .20s ease;
    }
    .btn:hover {
    transform: scale(1.1);
    }
    @media only screen and (max-width:1000px) {
        .poster {
            width: 100%;
        }
    }
    @media only screen and (max-width: 992px) {
        .poster img {
            max-width: 80%; 
        }
        .poster {
            text-align: center;
            margin-top: 0;
        }
    }
    @media only screen and (max-width: 600px) {
        .poster img {
            max-width: 60%; 
        }
        .poster {
            text-align: center;
        }
    }
    #booking .input-field .datepicker-container {
    color: black !important;
    }
    #booking .input-field .datepicker-content .datepicker-date-year,
    #booking .input-field .datepicker-content .datepicker-date-text,
    #booking .input-field .datepicker-content .datepicker-table th,
    #booking .input-field .datepicker-content .datepicker-table td.is-selected,
    #booking .input-field .datepicker-content .datepicker-table td.is-today {
        color: black !important;
    }

    #booking .input-field .datepicker-content .datepicker-table td.is-selected,
    #booking .input-field .datepicker-content .datepicker-table td.is-today {
        background-color: rgba(0, 0, 0, 0.1) !important;
    }

    #booking .input-field .datepicker-content .datepicker-table td.is-today {
        border-color: black !important;
    }
    #booking .input-field input[type="text"]:focus + label,
        #booking .input-field input[type="email"]:focus + label,
        #booking .input-field input[type="text"]:focus + label,
        #booking .input-field select:focus + label {
        color: #3f51b5 !important;
    }
    #booking .input-field input[type="text"]:focus,
    #booking .input-field input[type="email"]:focus,
    #booking .input-field input[type="text"]:focus,
    #booking .input-field select:focus {
      border-bottom: 1px solid #3f51b5 !important;
      box-shadow: 0 1px 0 0 #000 !important;
    }

    #booking .input-field select:focus:not([multiple]) + label {
      color: #3f51b5 !important;
    }

    #booking .input-field select:focus:not([multiple]) {
      border-bottom: 1px solid #3f51b5 !important;
      box-shadow: 0 1px 0 0 #000 !important;
    }

    #booking .input-field .datepicker:focus + label {
      color: #3f51b5 !important;
    }

    #booking .input-field .datepicker:focus {
      border-bottom: 1px solid #3f51b5 !important;
      box-shadow: 0 1px 0 0 #000 !important;
    }
    .browser-default {
        background-color: white;
        color: black;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        width: 100%;
    }

</style>

<video id="background-video" autoplay muted loop>
    <source src="img/us.mp4" type="video/mp4">
</video>
<section class="section-booking" id="booking">
    <div class="container container-booking" style="border-radius:20px;">
        <div class="row">
            <h4 class="center" style="font-weight: 500">BOOKING FORM</h4>
            <div class="col s12 l6"">
                <form  method="POST">
                    <div class="row">
                        <div class="col s12">
                            <div class="input-field">
                                <input class="white-text" type="text" name="name" id="name" value="<?php echo htmlspecialchars($fullname) ?>">
                                <div class="red-text"><?php echo $errors['name']; ?></div>
                                <label for="name" class="validate white-text">Fullname</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="input-field">
                                <input class="white-text"  type="email" name="email" id="email" value="<?php echo htmlspecialchars($email) ?>">
                                <div class="red-text"><?php echo $errors['email']; ?></div>
                                <label for="email" class="validate white-text">Email Address</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="input-field">
                                <input class="white-text"  type="text" name="telNo" id="telNo" value="<?php echo htmlspecialchars($telNo) ?>">
                                <div class="red-text"><?php echo $errors['telNo']; ?></div>
                                <label for="telNo" class="validate white-text">Phone Number</label>
                            </div>
                        </div>
                        <div class="input-field col s12 m6">
                            <select class="browser-default" name="airlines">
                                <option value="" <?php echo empty($airlines) ? 'selected' : ''; ?> disabled>Select an airline</option>
                                <option value="Cebu Pacific" <?php echo ($airlines == 'Cebu Pacific') ? 'selected' : ''; ?>>Cebu Pacific</option>
                                <option value="Air Asia" <?php echo ($airlines == 'Air Asia') ? 'selected' : ''; ?>>Air Asia</option>
                                <option value="Philippine Airline" <?php echo ($airlines == 'Philippine Airline') ? 'selected' : ''; ?>>Philippine Airline</option>
                            </select>
                            <!-- <p><label><input type="checkbox" style="background-color:#f27f0c;" /><span>Red</span></label></p> -->
                            <div class="red-text"><?php echo isset($errors['airlines']) ? $errors['airlines'] : ''; ?></div>
                        </div>
                        <div class="input-field col s12 m6 white-text " id="destination">
                            <select class="browser-default"  name="destination">
                                <option value="" <?php echo empty($destination) ? 'selected' : ''; ?> disabled>Destination</option>
                                <option value="New York" <?php echo ($destination == 'New York') ? 'selected' : ''; ?>>New York</option>
                                <option value="Los Angeles" <?php echo ($destination == 'Los Angeles') ? 'selected' : ''; ?>>Los Angeles</option>
                                <option value="Las Vegas" <?php echo ($destination == 'Las Vegas') ? 'selected' : ''; ?>>Las Vegas</option>
                                <option value="San Francisco" <?php echo ($destination == 'San Francisco') ? 'selected' : ''; ?>>San Francisco</option>
                                <option value="Alcatraz" <?php echo ($destination == 'Alcatraz') ? 'selected' : ''; ?>>Alcatraz</option>
                                <option value="Washington" <?php echo ($destination == 'Washington') ? 'selected' : ''; ?>>Washington</option>
                                <option value="Boston" <?php echo ($destination == 'Boston') ? 'selected' : ''; ?>>Boston</option>
                                <option value="Arizona" <?php echo ($destination == 'Arizona') ? 'selected' : ''; ?>>Arizona</option>
                                <option value="Miami" <?php echo ($destination == 'Miami') ? 'selected' : ''; ?>>Miami</option>
                                <option value="New Orleans" <?php echo ($destination == 'New Orleans') ? 'selected' : ''; ?>>New Orleans</option>
                                <option value="Chicago" <?php echo ($destination == 'Chicago') ? 'selected' : ''; ?>>Chicago</option>
                                <option value="Hawaii" <?php echo ($destination == 'Hawaii') ? 'selected' : ''; ?>>Hawaii</option>
                            </select>
                            <div class="red-text"><?php echo isset($errors['destination']) ? $errors['destination'] : ''; ?></div>
                        </div>
                        <div class="col s12 m6">
                            <div class="input-field">
                                <input class="white-text"  type="text" name="departure_date" id="departure_date" class="datepicker" value="<?php echo htmlspecialchars($departureDate) ?>">
                                <div class="red-text"><?php echo $errors['departure_date']; ?></div>
                                <label for="departure_date" class="validate white-text">Departure Date</label>
                            </div>
                        </div>
                        <div class="col s12 m6">
                            <div class="input-field">
                                <input class="white-text"  type="text" name="return_date" id="return_date" class="datepicker" value="<?php echo htmlspecialchars($returnDate) ?>">
                                <div class="red-text"><?php echo $errors['return_date']; ?></div>
                                <label for="return_date" class="validate white-text">Return Date</label>
                            </div>
                        </div>
                        <div class="input-field col s12 m6" id ="class">
                            <select class="browser-default" name="class" value="<?php echo htmlspecialchars($class) ?>">
                                <option value="" disabled selected>Choose your class</option>
                                <option value="Economy">Economy</option>
                                <option value="Business">Business</option>
                                <option value="First Class">First Class</option>
                            </select>
                                <div class="red-text"><?php echo $errors['class']; ?></div>
                            </div>
                            <div class="col s12 m6">
                                <div class="input-field">
                                    <input class="white-text"  type="text" name="card" id="card" value="<?php echo htmlspecialchars($card) ?>">
                                    <div class="red-text"><?php echo $errors['card']; ?></div>
                                    <label for="card" class="validate white-text">Card Number</label>
                                </div>
                            </div>
                            <div class="input-field col s12">
                                <input type="submit" name="submit" value="submit" class="btn brand" style="background-color:#1a237e; border-radius:20px;">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col s12 l6 poster">
                    <img src="img/j-logo.png" style="border-radius: 50%; border: 8px ridge #4663ac; width: 300px;">
                </div>
            </div>
        </div>
    </section>
<?php include('templates/footer.php'); ?>
</html>