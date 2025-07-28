document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-button');
    const galleryItems = document.querySelectorAll('.gallery');

    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const category = this.getAttribute('data-category');

        galleryItems.forEach(item => {
          if (category === 'all' || item.classList.contains(category)) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });

    const footer = document.getElementById('h-f1');
    const scrollThreshold = 100; // Adjust this value as needed

    // Function to toggle footer visibility based on scroll position
    function toggleFooterVisibility() {
        const lastItem = galleryItems[galleryItems.length - 1];
        const lastItemRect = lastItem.getBoundingClientRect();

        // Check if the bottom of the last item is within the viewport height
        if (lastItemRect.bottom <= window.innerHeight + scrollThreshold) {
            footer.style.display = 'block'; // Display the footer
        } else {
            footer.style.display = 'none'; // Hide the footer
        }
    }

    // Initial call to toggleFooterVisibility
    toggleFooterVisibility();

    // Add scroll event listener to toggle footer visibility
    window.addEventListener('scroll', toggleFooterVisibility);
});

// Function to dynamically adjust the height of the space div
document.addEventListener('DOMContentLoaded', function() {
  const spaceDiv = document.querySelector('.sp1');
  const galleryItems = document.querySelectorAll('.gallery');

  // Function to calculate the total height of the gallery images
  function getTotalGalleryHeight() {
      let totalHeight = 0;
      galleryItems.forEach(item => {
          totalHeight += item.offsetHeight; // Add the height of each gallery item
      });
      return totalHeight;
  }

  // Function to adjust the height of the space div
  function adjustSpaceHeight() {
      const totalHeight = getTotalGalleryHeight();
      spaceDiv.style.height = totalHeight+ 100 + 'px' ;
       // Add 100px to the total height
  }

  // Call the function initially
  adjustSpaceHeight()

  // Call the function whenever the window is resized
  window.addEventListener('resize', adjustSpaceHeight);
});

