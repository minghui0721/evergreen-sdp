// Function to add a new announcement to the announcement list
function addAnnouncement(title, content, author, dateTime) {
    const announcementList = document.getElementById("announcementList");
    const li = document.createElement("li");
    li.classList.add("announcement-item");
    const announcementInfo = document.createElement("div");
    announcementInfo.classList.add("announcement-info");
    announcementInfo.innerHTML = `<strong>${title}</strong><br>${content}<br><em>By ${author} on ${dateTime}</em>`;
    li.appendChild(announcementInfo);
    announcementList.insertBefore(li, announcementList.firstChild);
  }
  
  const announcements = [
    {
      title: "Important Deadline",
      content: "Don't forget to pay your tuition fees by August 15th, 2023.",
      author: "Registrar's Office",
      dateTime: "2023-07-25 09:00 AM",
    },
    {
      title: "Classroom Change",
      content: "The Biology 101 class will be moved to Room B203 starting next week.",
      author: "Prof. Johnson",
      dateTime: "2023-07-26 03:30 PM",
    },
    // more announcements here
  ];
  
  // Add sample announcements to the page
  announcements.forEach((announcement) => {
    addAnnouncement(announcement.title, announcement.content, announcement.author, announcement.dateTime);
  });
  