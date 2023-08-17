// Get the modal, button, and close button elements
var modal = document.getElementById("myModal");
var modalBtns = document.querySelectorAll(".showModalBtn");
var closeBtn = document.getElementsByClassName("close-btn")[0];

modalBtns.forEach(btn => {
    btn.addEventListener("click", function() {
        var courseProgramID = btn.getAttribute("data-courseprogram-id");
        initialScrollPosition = window.pageYOffset || document.documentElement.scrollTop; // Store the initial scroll position
        
        document.body.style.overflowY = "hidden";
        
        // Fetch the course details using AJAX
        fetch('fetch_course.php?courseProgram_ID=' + courseProgramID)
            .then(response => response.json())
            .then(data => {
                document.getElementById("courseProgram_ID").value = data.courseProgram_ID;
                document.getElementById("course_name").value = data.course_name;
                document.getElementById("program_name").value = data.program_name;
                document.getElementById("course_description").value = data.course_description;
                document.getElementById("program_description").value = data.program_description;

                // Set the image source
                var courseImage = document.getElementById("courseImage");
                courseImage.src = 'data:image/jpeg;base64,' + data.img; // Adjust the MIME type accordingly

                modal.style.display = "block";
            })
            .catch(error => {
                console.error('Error fetching course data:', error);
            });
    });
});



// When the user clicks on <span> (x) or outside the modal, close the modal
function closeModal() {
    document.body.style.overflowY = "auto"; // Restore scrolling
    modal.style.display = "none";
    document.body.style.overflowY = "scroll";
}

// When the user clicks on <span> (x), close the modal
closeBtn.onclick = function() {
    modal.style.display = "none";
    document.body.style.overflowY = "scroll";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        document.body.style.overflowY = "scroll";
    }
}