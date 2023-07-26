const buttons = document.querySelectorAll('.button');
let isDragging = false;
let currentButton = null;

buttons.forEach(button => {
  button.addEventListener('dragstart', handleDragStart);
  button.addEventListener('dragend', handleDragEnd);
});

document.addEventListener('dragover', handleDragOver);
document.addEventListener('drop', handleDrop);

function handleDragStart(event) {
  isDragging = true;
  currentButton = event.target;
  event.dataTransfer.effectAllowed = 'move';
  event.dataTransfer.setData('text/plain', '');
  event.target.classList.add('moving');
}

function handleDragEnd(event) {
  isDragging = false;
  currentButton = null;
  event.target.classList.remove('moving');
}

function handleDragOver(event) {
  event.preventDefault();
}

function handleDrop(event) {
  if (!isDragging) return;
  event.preventDefault();

  const dropTarget = event.target.closest('.button');
  if (dropTarget && dropTarget !== currentButton) {
    // Swap the positions of the two buttons
    const currentButtonIndex = Array.from(buttons).indexOf(currentButton);
    const dropTargetIndex = Array.from(buttons).indexOf(dropTarget);
    if (currentButtonIndex >= 0 && dropTargetIndex >= 0) {
      if (currentButtonIndex < dropTargetIndex) {
        dropTarget.after(currentButton);
      } else {
        dropTarget.before(currentButton);
      }
    }
  }
}
