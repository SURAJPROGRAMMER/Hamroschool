function toggleMenu() {
    const navLinks = document.getElementById('nav-links');
    navLinks.classList.toggle('active');
}
// Function to show login popup
    function showLoginPopup(courseType) {
        // You can use courseType parameter to customize the popup if needed
        document.getElementById('loginPopup').style.display = 'block';
        
        // Optional: You can store the selected course type for later use
        localStorage.setItem('selectedCourse', courseType);
    }

    // Close the modal when clicking on X
    document.querySelector('.close').onclick = function() {
        document.getElementById('loginPopup').style.display = 'none';
    }

    // Close the modal when clicking outside of it
    window.onclick = function(event) {
        if (event.target == document.getElementById('loginPopup')) {
            document.getElementById('loginPopup').style.display = 'none';
        }
    }