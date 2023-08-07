function toggleDetails(button) {
    const jobCard = button.closest('.job-card');
    const hiddenDetails = jobCard.querySelector('.hidden-details');
    jobCard.classList.toggle('show-details');
    hiddenDetails.style.display = jobCard.classList.contains('show-details') ? 'block' : 'none';
}

function searchJobs() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const jobCards = document.getElementsByClassName('job-card');
    
    for (const card of jobCards) {
        const jobTitle = card.getElementsByTagName('h3')[0].innerText.toLowerCase();
        const companyName = card.getElementsByTagName('p')[0].innerText.toLowerCase();
        
        if (jobTitle.includes(input) || companyName.includes(input)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    }
}

