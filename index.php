<?php 
include('config/db_connect.php');

$name = $email = $comment = '';
$errors = array('name' => '', 'email' => '', 'comment' => '');

if(isset($_POST['post'])) {

  if (empty($_POST['name'])) {
    $errors['name'] = 'Name is required to comment';
  }
  else {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
  }

  if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required';
  } else {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['email'] = 'Email must be a valid email address';
    }
  }
  
  if (empty($_POST['comment'])) {
    $errors['comment'] = 'Comment is required'; 
  } else {
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
  }

  if (array_filter($errors)){

  }
  else {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    // create sql 
    $sql = "INSERT INTO `comments`(`name`, `email`, `comment`, `created_at`) VALUES ('$name', '$email', '$comment', CURRENT_TIMESTAMP)";
    echo "<script>alert('Comment succesfully!')</script>";
    // save to database and check 
    if (mysqli_query($conn, $sql)){
      // success
    }
    else {
      echo 'query error: '. mysqli_error($conn);
    }

    //echo 'form is valid';
  }
}

?>

<?php 
require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include('config/db_connect.php');

$full_name = $email = $tel = $message = '';
$errors = array('full_name' => '', 'email' => '', 'tel' => '', 'message' => '');

if(isset($_POST['submit'])){
  // Validate fullname
  if (empty($_POST['full_name'])) {
    $errors['full_name'] = 'Fullname is required';
} else {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
}

// Validate email
  if (empty($_POST['email'])) {
      $errors['email'] = 'Email is required';
  } else {
      $email = mysqli_real_escape_string($conn, $_POST['email']);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
          $errors['email'] = 'Email must be a valid email address';
      }
  }

  // Validate telephone
  if (empty($_POST['tel'])) {
      $errors['tel'] = 'Phone Number is required';
  } else {
      $tel = mysqli_real_escape_string($conn, $_POST['tel']);
      if (!is_numeric($tel)) {
          $errors['tel'] = 'Phone Number must contain only numbers';
      }
  }

  // Validate message
  if (empty($_POST['message'])) {
      $errors['message'] = 'Message is required';
  } else {
      $message = mysqli_real_escape_string($conn, $_POST['message']);
  }

    if (array_filter($errors)){
        // Handle errors if needed
    }
    else {
        $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $tel = mysqli_real_escape_string($conn, $_POST['tel']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        echo "<script>alert('Thank you for your feedback! Please check your email.'')</script>";
        // Create SQL 
        $sql = "INSERT INTO `contact` (`full_name`, `email`, `tel`, `message`) VALUES ('$full_name', '$email', '$tel', '$message')";
        echo "<script> alert('Thank you for your feedback! Please check your email.'); </script>";
        // Save to database and check 
        if (mysqli_query($conn, $sql)){
            // Success
            // Now, create an instance of PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                // Rest of your email settings...
                $mail->SMTPAuth   = true;
                $mail->Username   = 'normaypangan@gmail.com';
                $mail->Password   = 'yqlx tpas vjoc wapb';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;
                
                // Recipients
                $mail->setFrom('normaypangan@gmail.com', 'Normay');
                $mail->addAddress($email, $full_name);
    
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Feedback Concern';
    
                $head = "Thank you for feedback, $full_name!<br><br>";
    
                $mail->Body = "Dear $full_name, <br><br>

                Thank you for choosing Journey Masters! We appreciate your trust in our services. Your feedback is invaluable to us as we continually strive to enhance your travel experience. <br><br>
                
                We're delighted to hear that you had a positive experience with us. Your satisfaction is our top priority, and we are committed to delivering exceptional service. <br><br>
                
                If you have any specific comments, suggestions, or areas where we can improve, please feel free to share. Your insights help us tailor our services to meet your expectations and those of our valued customers. <br><br>
                
                Once again, thank you for choosing Journey Masters. We look forward to serving you on your future adventures! <br><br>
                
                Safe travels,
                The Journey Masters Team
                ONE";
    
                // Send email
                $mail->send();

                // Action after sending email
                
            } catch (Exception $e) {
                // Handle exceptions or errors here
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        else {
            echo 'query error: '. mysqli_error($conn);
        }
    }
} // end POST check
?>
<!DOCTYPE html>
<html lang="en">
<?php include('templates/header.php'); ?>

  <!-- home section -->
  <section class="container section-home scrollspy"id="home" style="padding-bottom: 6rem">
    <div class="home-row row">
            <div class="col s12 l4 push-l7 ">
              <img src="img/j-logo.png" class="logo responsive-img"  style="border-radius: 50%; border: 8px ridge #4663ac; width: 300px;">
            </div>
            <div class="col s12 l6 pull-l5 right-align">
            <h1 class="home-title white-text left-align" style="font-weight: bold ;">Your Journey, <span style="color: #f27f0c;">Our Expertise.</span></h1>
            <br>
            <h5 class="left-align" style="color: #ffff;">"Explore. <span style="color:#8c9eff;">Experience. </span><span style="color: #f27f0c;">Enjoy.</span>"</h5>
            <br><br>
        </div>
    </div>
  </section>

<!-- services section -->
<section class="section section-icons center" id="service" style="background-color:#8c9eff; padding: 5rem 5rem">
    <div class="container" >
    <div class="center-align" id="service">
        <h2 style="color: #110d27; font-weight: bold;">Why Choose Us?</h2>
        <p style="color: #110d27; font-weight: bold;" >
        "For seamless travel experiences, we tailor each journey to your desires, ensuring hassle-free adventures. With expert guidance, exclusive perks, and a commitment to your satisfaction, we turn your trips into unforgettable memories. Your dream getaway starts here!"
        </p>
    </div>
      <div class="row">
        <div class="col s12 m4">
          <div class="card-panel" style="background-color:#110d27;">
            <i class="material-icons large" style="color:#8c9eff;">explore</i>
            <h4>Journeys</h4>
            <p>Your Adventure, Our Expertise.</p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="card-panel" style="background-color:#110d27;">
            <i class="material-icons large" style="color:#8c9eff;">hiking</i>
            <h4>Explore Beyond</h4>
            <p>Your Life, Our Destinations.</p>
          </div>
        </div>
        <div class="col s12 m4">
          <div class="card-panel" style="background-color:#110d27;">
            <i class="material-icons large" style="color:#8c9eff;">airplanemode_active</i>
            <h4>Fly Cheap</h4>
            <p>Explore. Experience. Enjoy.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- about section -->
 <section class="container section-about scrollspy" id="about">
    <div class="about-row row">
        <div class="col s12 l4">
            <img src="img/j-logo.png" alt="" class="about-img responsive-img" style="border-radius: 50%; border: 8px ridge #4663ac; width: 300px;">
        </div>
        <div class="col s12 l6 offset-l2">
          <div class="about-des">
              <h6 class="orange-text" style="font-weight: bolder;">About Us</h6>
              <p class="white-text">Established in 2023, Journey Masters is a premier destination for those seeking unparalleled travel experiences. From our early days as passionate adventurers, we've evolved into a seasoned team of travel experts dedicated to curating memorable journeys. <br> <br>Our commitment lies in crafting personalized itineraries, ensuring each traveler embarks on a seamless and extraordinary exploration of the world. With a history rooted in wanderlust, Journey Masters invites you to join us in creating timeless travel memories.</p>
          </div>
      </div>
    </div>
  </section>

  <!-- popular destination -->
  <section class="container scrollspy" id="popularPlaces" style="padding-top: 20px">
    <div class="center-align">
        <h2  class="famous"style="color: #f27f0c; font-weight: 500;">Famous Destinations</h2>
        <p>
          "Unlock the world's wonders. Your journey, our guide. Immerse yourself in the extraordinary. Let the adventure begin!"
        </p>
    </div>
        <div class="row">
          <div class="col s12 m6 l3">
            <div class="card medium hoverable" style="background-color:#334173;">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/destinations-1.jpg" alt="" class="activator" />
              </div>
              <div class="card-content">
                <span class="card-title activator text-darken-4 white-text" >
                  New York <i class="material-icons right" style="color:#ffff;"> expand_more </i></span>
                <p>"The City That Never Sleeps," a metropolis on the northeastern coast of the United States.</p>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title text-darken-4 white-text"
                  >New York <i class="material-icons right" style="color:#110d27;"> close </i></span>
                <p>
                From the dazzling lights of Times Square to the tranquility of Central Park, New York City offers an unparalleled tapestry of experiences.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card medium hoverable" style="background-color:#334173;">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/destinations-2.jpg" alt="" class="activator" />
              </div>
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  Los Angeles <i class="material-icons right"> expand_more </i></span>
                <p>The entertainment capital of the world, with its sun-soaked beaches, and iconic landmarks.</p>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;">Book Now</a>
                </div>
              </div>
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Los Angeles <i class="material-icons right"> close </i></span>
                <p>
                From the Hollywood Sign overlooking the city to the palm-lined streets of Beverly Hills, a city where dreams are crafted and realized.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card medium hoverable" style="background-color:#334173;">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/destinations-3.jpg" alt="" class="activator" />
              </div>
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  Las Vegas <i class="material-icons right"> expand_more </i></span>
                <p>The dazzling entertainment capital in the heart of the Nevada desert.</p>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Las Vegas<i class="material-icons right"> close </i></span
                >
                <p>
                A iconic Strip adorned with neon lights and world-famous resorts, a playground for those seeking excitement and entertainment.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
            </div>
          </div>
          <div class="col s12 m6 l3">
            <div class="card medium hoverable" style="background-color:#334173;">
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/destinations-4.jpg" alt="" class="activator" />
              </div>
              <div class="card-content">
                <span class="card-title activator whute-text text-darken-4">
                  San Francisco <i class="material-icons right"> expand_more </i></span>
                <p>A city of hills and bay breezes, is a haven for creativity, and innovation.</p>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <div class="card-reveal black-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >San Francisco <i class="material-icons right"> close </i></span
                >
                <p class="white-text">
                From the iconic Golden Gate Bridge to the historic cable cars navigating steep streets, San Francisco's charm within its landmarks.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>
  </section>

  <!-- contact section -->
 <section class="section section-follow white-text center" style="padding-top: 20px; background-color:#ff7518;">
    <div class="container">
      <div class="row">
        <div class="col s12">
          <h4>Follow Journey Masters</h4>
          <p>Follow us on social media for special offers</p>
          <a href="https://facebook.com" target="_blank" class="white-text">
            <i class="fab fa-facebook fa-4x"></i>
          </a>
          <a href="https://twitter.com" target="_blank" class="white-text">
            <i class="fab fa-twitter fa-4x"></i>
          </a>
          <a href="https://linkedin.com" target="_blank" class="white-text">
            <i class="fab fa-linkedin fa-4x"></i>
          </a>
          <a href="https://googleplus.com" target="_blank" class="white-text">
            <i class="fab fa-google-plus fa-4x"></i>
          </a>
        </div>
        <p style="padding-top: 200px; ">(+63) 915-222-333</p>
        <p>Journey Masters &copy; 2023</p>
      </div>
    </div>
  </section>

<!-- gallery section  -->
<section id="gallery"class="container section featured-images" style="padding-bottom: 5rem">
  <div class="center-align">
    <h2 style="color:#ff7518; font-weight: 500;">Gallery</h2>
    <p>
      "Explore the 'USA Gallery' for a snapshot of America's diverse landscapes, iconic landmarks, and pivotal history.<br>From vibrant cities to cultural milestones, this exhibit captures the essence of the United States in a concise visual narrative."
    </p>
  </div>
  <div class="row">
    <div class="col s12 m6 l8">
      <img
        src="images/1.jpg"
        alt=""
        class="materialboxed"
        data-caption="The Golden Bridge, San Francisco"
        height="400"
      />
    </div>
    <div class="col s12 m6 l4">
      <img
        src="images/5.jpg"
        alt=""
        class="materialboxed"
        data-caption="The City, Miami"
        height="400"
      />
    </div>
    <div class="col s12 m12 l6">
      <img
        src="images/tgrand canyon.webp"
        alt=""
        class="materialboxed"
        data-caption="Grand Canyon, Arizona"
        height="400"
      />
    </div>
    <div class="col m6 l3">
      <img
        src="images/4.jpg"
        alt=""
        class="materialboxed"
        data-caption="The National Mall, Washington, D.C. "
        height="400"
      />
    </div>
    <div class="col m6 l3">
      <img
        src="images/header-4.jpg"
        alt=""
        class="materialboxed"
        data-caption="The Golden Bridge, San Francisco"
        height="400"
      />
    </div>
    <div class="col s12 m12 l3">
      <img
        src="images/header-3.jpg"
        alt=""
        class="materialboxed"
        data-caption="Statue of Liberty, New York"
        height="400"
      />
    </div>
    <div class="col s12 m6 l3">
      <img
        src="images/7.jpg"
        alt=""
        class="materialboxed"
        data-caption="Alcatraz, San Francisco"
        height="400"
      />
    </div>
    <div class="col s12 m6 l6">
      <img
        src="images/8.jpg"
        alt=""
        class="materialboxed"
        data-caption="The Strip, Las Vegas"
        height="400"
      />
    </div>
    <!-- <div class="col s12 m6 l8">
      <img
        src="images/9.jpg"
        alt=""
        class="materialboxed"
        data-caption="Empire State Building, New York"
        height="400"
      />
    </div> -->
    <div class="col s12 m12 l6">
      <img
        src="img/bp1.jpg"
        alt=""
        class="materialboxed"
        data-caption="Blackpink"
        height="400"
      />
    </div>
    <div class="col s12 m12 l6">
      <img
        src="img/bp2.jpg"
        alt=""
        class="materialboxed"
        data-caption="Blackpink"
        height="400"
      />
    </div>
    <div class="col s12 m6 l4">
      <img
        src="images/10.jpg"
        alt=""
        class="materialboxed"
        data-caption="The French Quater, New Orleans"
        height="400"
      />
    </div>
    <div class="col s12 m6 l8" style="width: 100%; max-width: 707px; height: 350px;">
      <div class="video-container" style="position: relative; height: 100%;">
          <iframe width="100%" height="100%" src="https://www.youtube.com/embed/POe9SOEKotk?si=sNpK3hub1AnnuBF8" frameborder="0" allowfullscreen></iframe>
      </div>
    </div>
</section>

<!-- other places section -->
<section class="container section-popularplaces scrollspy" style="padding-top: 20px">
    <div class="center-align">
        <h2 style="color: #f27f0c;  font-weight: 500;">Other Places</h2>
        <p>
        "Exploring the world opens up a myriad of possibilities, and there are countless captivating places to visit, each with its own distinct allure."
          </p>
    </div>
    <div class="row">
          <!-- First Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/alca.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator text-darken-4 white-text" >
                  Alcatraz <i class="material-icons right" style="color:#ffff;"> expand_more </i></span
                >
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small left-align" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title text-darken-4 white-text"
                  >Alcatraz <i class="material-icons right" style="color:#110d27;"> close </i></span
                >
                <p>
                Alcatraz, often referred to as "The Rock," is a small island located in San Francisco Bay, California, USA. It gained notoriety as the site of Alcatraz Federal Penitentiary, a maximum-security prison that operated from 1934 to 1963. 
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /First Column -->
          <!-- Second Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/wash.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  Washington<i class="material-icons right"> expand_more </i></span>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Washington, D.C.<i class="material-icons right"> close </i></span
                >
                <p>
                The capital of the United States, stands as a nexus of political power, historical significance, and cultural diversity. Home to iconic landmarks like the Capitol, the White House, and the National Mall, the city weaves together a tapestry of history, politics, and civic identity. 
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Second Column -->
          <!-- Third Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/bos.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  Boston <i class="material-icons right"> expand_more </i></span>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Boston<i class="material-icons right"> close </i></span
                >
                <p>
                Boston, steeped in American history and intellectual prowess, is a city that seamlessly blends colonial charm with modern vitality. Home to prestigious universities like Harvard and MIT, Boston has a rich academic and cultural legacy. 
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Third Column -->
          <!-- Fourth Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/ari.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator whute-text text-darken-4">
                  Arizona <i class="material-icons right"> expand_more </i></span>
               
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal black-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Arizona <i class="material-icons right"> close </i></span
                >
                <p class="white-text">
                The Grand Canyon, a natural wonder located in northern Arizona, is a breathtaking geological marvel. Carved by the Colorado River over millions of years, the canyon showcases mesmerizing layers of rock that reveal Earth's geological history.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Fourth Column -->
        </div>
        <div class="row">
          <!-- First Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/mi.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator text-darken-4 white-text" >
                  Miami <i class="material-icons right" style="color:#ffff;"> expand_more </i></span
                >
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small left-align" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title text-darken-4 white-text"
                  >Miami <i class="material-icons right" style="color:#110d27;"> close </i></span
                >
                <p>
                Miami is a popular destination for tourists and a hub of international trade and finance. The city boasts a lively nightlife, world-class dining, and a rich cultural scene influenced by its large Latin American and Caribbean communities. It is recognized for its tropical climate. 
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons" style="color:#ffff;"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /First Column -->
          <!-- Second Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/new.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  New Orleans <i class="material-icons right"> expand_more </i></span>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >New Orleans<i class="material-icons right"> close </i></span
                >
                <p>
                New Orleans, known as "The Big Easy," is a culturally vibrant city in Louisiana, USA. Renowned for its jazz music, Creole and Cajun cuisine, and historic French Quarter, the city boasts a unique blend of French, Spanish, and African influences.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Second Column -->
          <!-- Third Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/chi.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator white-text text-darken-4">
                  Chicago <i class="material-icons right"> expand_more </i></span>
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal white-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Chicago<i class="material-icons right"> close </i></span
                >
                <p>
                situated on the shores of Lake Michigan in Illinois, is a dynamic metropolis known for its iconic architecture, diverse cultural scene, and deep-rooted history. The city is renowned for its impressive skyline dominated by architectural gems like the Willis Tower and John Hancock Center.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Third Column -->
          <!-- Fourth Column -->
          <div class="col s12 m6 l3">
            <!-- Card -->
            <div class="card hoverable" style="background-color:#334173;">
              <!-- Card Image -->
              <div class="card-image waves-effect waves-block waves-light">
                <img src="images/ha.jpg" alt="" class="activator" />
              </div>
              <!-- /Card Image -->
              <!-- Card Content -->
              <div class="card-content">
                <span class="card-title activator whute-text text-darken-4">
                  Hawaii <i class="material-icons right"> expand_more </i></span>
               
                <div class="card-action">
                  <a
                    href="booking-form.php?from=booking"
                    class="waves-effect waves-light btn-small" style="background-color:#1a237e;"
                    >Book Now</a
                  >
                </div>
              </div>
              <!-- /Card Content -->
              <!-- Card Reveal -->
              <div class="card-reveal black-text" style="background-color:#334173;">
                <span class="card-title white-text text-darken-4"
                  >Hawaii <i class="material-icons right"> close </i></span
                >
                <p class="white-text">
                a tropical paradise in the central Pacific Ocean, is a unique and enchanting destination. Comprising a chain of islands, the most populous of which are Oahu, Maui, Kauai, and Hawaii (also known as the Big Island), each offers its own distinct charm.
                </p>
                <ul class="additional-info">
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> rowing </i>
                    12 Activities
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> location_on </i>
                    9 Tourist Spots
                  </li>
                  <li class="valign-wrapper white-text">
                    <i class="material-icons white-text"> nightlight_round </i>
                    4 days, 3 nights
                  </li>
                  <div class="price-block" style="color:#f27f0c;">
                    <p>$799</p>
                    <a
                      href="booking-form.php?from=booking"
                      class="right waves-effect waves-light btn-small" style="background-color:#1a237e;"
                      >Book Now</a
                    >
                  </div>
                </ul>
              </div>
              <!-- /Card Reveal -->
            </div>
            <!-- /Card -->
          </div>
          <!-- /Fourth Column -->
        </div>
  </section>

  <!-- contact section -->
  <section class="container contact scrollspy" id="contact" style="padding-top: 20px">
    <div class="center-align">
          <h2>Get in Touch <span style="color:#f27f0c; font-weight: bold;">With Us</span></h2>
          <p>
          We're here to assist you every step of the way. Whether you have questions, need assistance with your booking, or simply want to chat about your upcoming journey, we'd love to hear from you. Here's how you can get in touch:
          </p>
        </div>
        <!-- /Section Header -->
        <!-- Row Container -->
        <div class="row">
          <!-- First Column -->
          <div class="col s12 m6">
            <h5 style="color:#f27f0c; font-weight: bold;">Send a Message</h5>
            <p class="white-text text-darken-1">
            Use the contact form below to send us a message. Our team is ready to respond to your inquiries promptly. Please provide your full name, email address, phone number, and your message. We'll get back to you as soon as possible.
            </p>
            <form method="post"class="form row" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
              <div class="input-field col s12">
                <input class="white-text" name="full_name" type="text" id="name" class="validate" />
                <div class="red-text"><?php echo $errors['full_name']; ?></div>
                <label for="name">Full Name</label>
              </div>
              <div class="input-field col s12 m6">
                <input class="white-text" name="email" type="email" id="email" class="validate" />
                <div class="red-text"><?php echo $errors['email']; ?></div>
                <label for="email">Email</label>
              </div>
              <div class="input-field col s12 m6">
                <input class="white-text" name="tel"type="tel" id="tel" class="validate" />
                <div class="red-text"><?php echo $errors['tel']; ?></div>
                <label for="tel">Phone Number</label>
              </div>
              <div class="input-field col s12">
                <textarea name="message" id="textarea" class="materialize-textarea white-text"></textarea>
                <div class="red-text"><?php echo $errors['message']; ?></div>
                <label for="textarea">Message</label>
              </div>
              <button
                name="submit" class="waves-effect waves-light btn-large"
                type="submit" style="background-color:#1a237e; border-radius:30px; color:white;"
              >Send Message</button>
            </form>
          </div>
          <!-- /First Column -->
          <!-- Second Column -->
          <div class="col s12 m6">
            <h5 style="color:#f27f0c; font-weight: bold;">Frequently Asked Questions</h5>
            <p class="white-text text-darken-1">
            Before reaching out, you might find answers to your questions in our Frequently Asked Questions (FAQs) section. Explore common queries related to booking, payment methods, and more.
            </p>
            <ul class="collapsible expandable z-depth-0">
              <li class="active">
                <div class="collapsible-header white-text" style="background-color:#1a237e;">
                  <i class="material-icons" style="color:#f27f0c;"> looks_one </i>
                  How do I make a booking with Journey Masters?
                </div>
                <div class="collapsible-body">
                  Visit our website, choose your destination, and fill out the online booking form. Our team will confirm availability and guide you through the payment process.
                </div>
              </li>
              <li>
                <div class="collapsible-header white-text" style="background-color:#1a237e;">
                  <i class="material-icons" style="color:#f27f0c;"> looks_two </i>
                  What payment methods are accepted for bookings?
                </div>
                <div class="collapsible-body">
                We accept major credit cards, bank transfers, and secure online payment methods. Details will be provided during the booking process.
                </div>
              </li>
              <li>
                <div class="collapsible-header white-text" style="background-color:#1a237e;">
                  <i class="material-icons" style="color:#f27f0c;"> looks_3 </i>
                  Is my booking refundable, and what is the cancellation policy?
                </div>
                <div class="collapsible-body">
                Refund policies vary. Details on refundability and cancellation fees are outlined during the booking confirmation and in our terms and conditions. Contact customer support for specific information.
                </div>
              </li>
            </ul>
          </div>
          <!-- /Second Column -->
        </div>
        <!-- /Row Container -->
  </section>

  <!-- client/comment section -->
    <section class="container" style="padding-top: 20px">
    <h4>Client's Review   <i class="material-icons yellow-text">star_border</i></h4>
    <p class="orange-text" style="font-weight: 500;">Feel free to leave a comment : )</p>
      <div class="row">
        <form id="commentForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="input-field col s12 m6">
          <input class="white-text" name="name"  type="text" id="name" class="validate" />
          <label for="name">Name</label>
        </div>
        <div class="input-field col s12 m6">
        <input class="white-text" name="email" type="email" id="email" class="validate" />
          <label for="email">Email</label>
        </div>
        <div class="input-field col s12 m6">
            <textarea name="comment" id="textarea" class="materialize-textarea white-text"></textarea>
            <label for="textarea">Comment</label>
        </div>
        <div class="input-field col s12 m6">
          <!-- <input type="submit" name="post" value="Post A Comment" class="waves-effect waves-light btn-large indigo" > -->
           <input type="submit" name="post" value="Post A Comment" class="btn-large brand" style="background-color:#1a237e;">
        </div>
        </form>
      </div>
    </section>

    <section class="container">
    <h4>Client's Review   <i class="material-icons yellow-text">star_border</i></h4>
    <?php
    $sql = "SELECT * FROM comments ORDER BY created_at DESC";
    $result = mysqli_query($conn, $sql);

    $comments = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    // Split the comments array into chunks of 2
    $commentChunks = array_chunk($comments, 2);

    // Iterate over each chunk
    foreach ($commentChunks as $chunk) {
        echo "<div class='row'>";
        // Iterate over comments in the current chunk
        foreach ($chunk as $comment) {
            echo "<div class='col s12 m6'>";
            echo "<div class='card blue-grey darken-3'>";
            echo "<div class='card-content white-text'>";
            echo "<span class='card-title'>" . $comment['name'] . "</span>";
            echo "<p>" . $comment['comment'] . "</p>";
            echo "</div>";
            echo "<div class='card-action'>";
            echo "<small class='grey-text'>" . $comment['created_at'] . "</small>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
    ?>
  </section>
    <!-- back to top button -->
  <div class="fixed-action-btn">
    <a href="index.php#home" class="btn-floating blue darken-3 btn-large tooltipped pulse top"  data-position="left" data-tooltip="Back to Top">
      <i class="material-icons">arrow_drop_up</i>
    </a>
  </div>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
  // Lightbox
  let lightbox = document.querySelectorAll(".materialboxed");
  let lightboxInit = M.Materialbox.init(lightbox);
  });
    </script>
    
<?php include('templates/footer.php'); ?>
</html>
