<?php
include('config/db_connect.php');

$sql = "SELECT * FROM bookings";
$result = mysqli_query($conn, $sql);

if ($result) {
    $flights = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo 'Query error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<style>
    table {
    max-height: 100%;
    overflow: auto;
    margin-bottom: 20px;
    }
    h5 {
        margin-top: 5rem;
    }
</style>
<div class="container">
    <h4 class="center" style="color: #f27f0c;">J<span class="white-text" style="font-weight: bold;">MASTERS</span> <span style="font-weight: bold;"> FLIGHTS</span></h4>
    <?php
    $airlines = ['Philippine Airline', 'Air Asia', 'Cebu Pacific'];

    foreach ($airlines as $airline) :
    ?>
        <h5 style="font-weight: bold;"><i class="material-icons blue-text">flight_takeoff</i>&nbsp; <?php echo $airline; ?></h5>
        <!-- First Class Table -->
        <h6 class="center">FIRST <span class="orange-text" style="font-weight: bold;">CLASS</span></h6>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Airline</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $fcCount = 0;
                foreach ($flights as $flight) :
                    if ($flight['airlines'] == $airline && $flight['class'] == 'First Class') :
                        $fcCount++;
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($fcCount); ?></td>
                            <td><?php echo htmlspecialchars($flight['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($flight['airlines']); ?></td>
                            <td><?php echo htmlspecialchars($flight['destination']); ?></td>
                            <td><?php echo htmlspecialchars($flight['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['class']); ?></td>
                        </tr>
                <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>

        <!-- Economy Class Table -->
        <h6 class="center">ECONOMY <span class="orange-text" style="font-weight: bold;">CLASS</span></h6>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Airline</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ecoCount = 0;
                foreach ($flights as $flight) :
                    if ($flight['airlines'] == $airline && $flight['class'] == 'Economy') :
                        $ecoCount++;
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ecoCount); ?></td>
                            <td><?php echo htmlspecialchars($flight['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($flight['airlines']); ?></td>
                            <td><?php echo htmlspecialchars($flight['destination']); ?></td>
                            <td><?php echo htmlspecialchars($flight['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['class']); ?></td>
                        </tr>
                <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>

        <!-- Business Class Table -->
        <h6 class="center">BUSINESS <span class="orange-text" style="font-weight: bold;">CLASS</span></h6>
        <table class="highlight responsive-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full name</th>
                    <th>Airline</th>
                    <th>Destination</th>
                    <th>Departure Date</th>
                    <th>Return Date</th>
                    <th>Class</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $busCount = 0;
                foreach ($flights as $flight) :
                    if ($flight['airlines'] == $airline && $flight['class'] == 'Business') :
                        $busCount++;
                ?>
                        <tr>
                            <td><?php echo htmlspecialchars($busCount); ?></td>
                            <td><?php echo htmlspecialchars($flight['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($flight['airlines']); ?></td>
                            <td><?php echo htmlspecialchars($flight['destination']); ?></td>
                            <td><?php echo htmlspecialchars($flight['departure_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['return_date']); ?></td>
                            <td><?php echo htmlspecialchars($flight['class']); ?></td>
                        </tr>
                <?php
                    endif;
                endforeach;
                ?>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>
<?php include('templates/footer.php'); ?>
</html>
