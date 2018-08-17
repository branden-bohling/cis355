<?php

printForm(); 

#-----------------------------------------------------------------------------
// display the entry form for course search
function printForm(){
	
	echo '<h2>Course Lookup</h2>';
	
	// print user entry form
	echo "<form action='courses.php'>";
	echo "Course Prefix (Department)<br/>";
	echo "<input type='text' placeholder='CS' name='prefix'><br/>";
	echo "Course Number<br/>";
	echo "<input type='text' placeholder='116' name='courseNumber'><br/>";
	echo "Instructor<br/>";
	echo "<input type='text' placeholder='gpcorser' name='instructor'><br/>";
        echo "Course occurs on:<br/>";
	echo "<select name='dayOfWeek'>
            <option value=''>Any Day</option>
            <option value='M'>Monday</option>
            <option value='T'>Tuesday</option>
            <option value='W'>Wednesday</option>
            <option value='R'>Thursday</option>
            <option value='F'>Friday</option>
        </select>"
        . "<br/><br/>";
        
	//echo "Building/Room<br/>";
	//echo "<input type='text' name='building'>";
	//echo "<input type='text' name='room'><br/>";
	echo "<input type='submit' value='Submit'>";
	echo "</form>";
}
