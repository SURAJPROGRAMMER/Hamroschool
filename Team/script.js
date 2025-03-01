function showBio(id) {
  // Hide all biographies
  document.querySelectorAll('.biography').forEach(bio => {
    bio.style.display = 'none';
  });

  // Show the selected biography
  const selectedBio = document.getElementById(`bio-${id}`);
  if (selectedBio.style.display === 'block') {
    selectedBio.style.display = 'none';
  } else {
    selectedBio.style.display = 'block';
  }
}
