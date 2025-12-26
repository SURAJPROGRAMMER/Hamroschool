// Add interactivity to book cards
document.querySelectorAll('.book-card').forEach((card) => {
    // Add hover effect
    card.addEventListener('mouseenter', () => {
        card.style.transform = 'scale(1.1)';
        card.style.boxShadow = '0 10px 20px rgba(0, 0, 0, 0.2)';
    });

    card.addEventListener('mouseleave', () => {
        card.style.transform = 'scale(1)';
        card.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.1)';
    });

    // Add click event to alert card title
    card.addEventListener('click', () => {
        const cardTitle = card.querySelector('h3').innerText;
        alert(`You clicked on the ${cardTitle} card.`);
    });
});
