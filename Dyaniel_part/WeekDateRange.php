<?php
function CurrentWeekDateRange() {
    //Prepare Date
    $CurrentDate = date('Y-m-d');
    $givenDateTime = new DateTime($CurrentDate);
    $dayOfWeek = (int)$givenDateTime->format('w');

    // Calculate the date range
    $startingDateTime = clone $givenDateTime;
    $startingDateTime->sub(new DateInterval('P' . $dayOfWeek . 'D'));

    $secondDate = clone $startingDateTime;
    $secondDate->add(new DateInterval('P1D'));

    $thirdDate = clone $startingDateTime;
    $thirdDate->add(new DateInterval('P2D'));

    $forthDate = clone $startingDateTime;
    $forthDate->add(new DateInterval('P3D'));

    $fivthDate = clone $startingDateTime;
    $fivthDate->add(new DateInterval('P4D'));

    $sixthDate = clone $startingDateTime;
    $sixthDate->add(new DateInterval('P5D'));

    $endingDateTime = clone $startingDateTime;
    $endingDateTime->add(new DateInterval('P6D'));

    // Return
    return array($startingDateTime->format('Y-m-d'), 
    $secondDate->format('Y-m-d'), 
    $thirdDate->format('Y-m-d'), 
    $forthDate->format('Y-m-d'), 
    $fivthDate->format('Y-m-d'), 
    $sixthDate->format('Y-m-d'), 
    $endingDateTime->format('Y-m-d'));
}


function Week2DateRange() {
    //Prepare Date
    $CurrentDate = date('Y-m-d');
    $givenDateTime = new DateTime($CurrentDate);
    $dayOfWeek = (int)$givenDateTime->format('w');
    $StartWeek = clone $givenDateTime;
    $StartWeek->sub(new DateInterval('P' . $dayOfWeek . 'D'));
    $EndWeek = clone $StartWeek;
    $EndWeek->add(new DateInterval('P6D'));
    

    // Calculate the date range
    $startingDateTime = clone $EndWeek;
    $startingDateTime->add(new DateInterval('P1D'));

    $secondDate = clone $startingDateTime;
    $secondDate->add(new DateInterval('P1D'));

    $thirdDate = clone $startingDateTime;
    $thirdDate->add(new DateInterval('P2D'));

    $forthDate = clone $startingDateTime;
    $forthDate->add(new DateInterval('P3D'));

    $fivthDate = clone $startingDateTime;
    $fivthDate->add(new DateInterval('P4D'));

    $sixthDate = clone $startingDateTime;
    $sixthDate->add(new DateInterval('P5D'));

    $endingDateTime = clone $startingDateTime;
    $endingDateTime->add(new DateInterval('P6D'));

    // Return
    return array($startingDateTime->format('Y-m-d'), 
    $secondDate->format('Y-m-d'), 
    $thirdDate->format('Y-m-d'), 
    $forthDate->format('Y-m-d'), 
    $fivthDate->format('Y-m-d'), 
    $sixthDate->format('Y-m-d'), 
    $endingDateTime->format('Y-m-d'));
}


function Week3DateRange() {
    //Prepare Date
    $CurrentDate = date('Y-m-d');
    $givenDateTime = new DateTime($CurrentDate);
    $dayOfWeek = (int)$givenDateTime->format('w');
    $StartWeek = clone $givenDateTime;
    $StartWeek->sub(new DateInterval('P' . $dayOfWeek . 'D'));
    $EndWeek = clone $StartWeek;
    $EndWeek->add(new DateInterval('P6D'));
    

    // Calculate the date range
    $startingDateTime = clone $EndWeek;
    $startingDateTime->add(new DateInterval('P8D'));

    $secondDate = clone $startingDateTime;
    $secondDate->add(new DateInterval('P1D'));

    $thirdDate = clone $startingDateTime;
    $thirdDate->add(new DateInterval('P2D'));

    $forthDate = clone $startingDateTime;
    $forthDate->add(new DateInterval('P3D'));

    $fivthDate = clone $startingDateTime;
    $fivthDate->add(new DateInterval('P4D'));

    $sixthDate = clone $startingDateTime;
    $sixthDate->add(new DateInterval('P5D'));

    $endingDateTime = clone $startingDateTime;
    $endingDateTime->add(new DateInterval('P6D'));

    // Return
    return array($startingDateTime->format('Y-m-d'), 
    $secondDate->format('Y-m-d'), 
    $thirdDate->format('Y-m-d'), 
    $forthDate->format('Y-m-d'), 
    $fivthDate->format('Y-m-d'), 
    $sixthDate->format('Y-m-d'), 
    $endingDateTime->format('Y-m-d'));
}


function Week4DateRange() {
    //Prepare Date
    $CurrentDate = date('Y-m-d');
    $givenDateTime = new DateTime($CurrentDate);
    $dayOfWeek = (int)$givenDateTime->format('w');
    $StartWeek = clone $givenDateTime;
    $StartWeek->sub(new DateInterval('P' . $dayOfWeek . 'D'));
    $EndWeek = clone $StartWeek;
    $EndWeek->add(new DateInterval('P6D'));
    

    // Calculate the date range
    $startingDateTime = clone $EndWeek;
    $startingDateTime->add(new DateInterval('P15D'));

    $secondDate = clone $startingDateTime;
    $secondDate->add(new DateInterval('P1D'));

    $thirdDate = clone $startingDateTime;
    $thirdDate->add(new DateInterval('P2D'));

    $forthDate = clone $startingDateTime;
    $forthDate->add(new DateInterval('P3D'));

    $fivthDate = clone $startingDateTime;
    $fivthDate->add(new DateInterval('P4D'));

    $sixthDate = clone $startingDateTime;
    $sixthDate->add(new DateInterval('P5D'));

    $endingDateTime = clone $startingDateTime;
    $endingDateTime->add(new DateInterval('P6D'));

    // Return
    return array($startingDateTime->format('Y-m-d'), 
    $secondDate->format('Y-m-d'), 
    $thirdDate->format('Y-m-d'), 
    $forthDate->format('Y-m-d'), 
    $fivthDate->format('Y-m-d'), 
    $sixthDate->format('Y-m-d'), 
    $endingDateTime->format('Y-m-d'));
}

    // list($FirstDay,$SecondtDay,$ThirdDay,$ForthDay,$FifthDay,$SixthDay, $LastDate) = Week4DateRange();
    // echo "Start Date: $FirstDay\n";
    // echo "End Date: $SecondtDay\n";
    // echo "End Date: $ThirdDay\n";
    // echo "End Date: $ForthDay\n";
    // echo "End Date: $FifthDay\n";
    // echo "End Date: $SixthDay\n";
    // echo "End Date: $LastDate\n";

?>