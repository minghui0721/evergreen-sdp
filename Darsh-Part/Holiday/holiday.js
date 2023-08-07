document.addEventListener("DOMContentLoaded", function() {
    const monthSelect = document.getElementById("month-select");
    const holidayItems = document.querySelectorAll(".filtered-holidays li");
  
    monthSelect.addEventListener("change", function() {
      const selectedMonth = parseInt(monthSelect.value);
  
      holidayItems.forEach(item => {
        const holidayMonth = parseInt(item.getAttribute("data-month"));
        if (selectedMonth === 0 || selectedMonth === holidayMonth) {
          item.style.display = "flex";
        } else {
          item.style.display = "none";
        }
      });
    });
  });
  