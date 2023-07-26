// Function to handle form submission and create the announcement
function createAnnouncement(event) {
    event.preventDefault();
    const title = document.getElementById("title").value;
    const content = document.getElementById("content").value;
    const author = document.getElementById("author").value;
    const dateTime = document.getElementById("dateTime").value;
  
    
  
    // Create a new announcement object
    const newAnnouncement = {
      title: title,
      content: content,
      author: author,
      dateTime: dateTime,
    };
  

  
  // Add an event listener to the form submit event
  const announcementForm = document.getElementById("announcementForm");
  announcementForm.addEventListener("submit", createAnnouncement);
  