function openLogin(event) {
  if (event) {
    event.preventDefault();
  }
  closeRegister();
  document.getElementById("loginModal").style.display = "flex";
}

function closeLogin() {
  const loginModal = document.getElementById("loginModal");
  if (loginModal) loginModal.style.display = "none";
}

function openRegister(event) {
  if (event) {
    event.preventDefault();
  }
  closeLogin();
  document.getElementById("registerModal").style.display = "flex";
}

function closeRegister() {
  const registerModal = document.getElementById("registerModal");
  if (registerModal) registerModal.style.display = "none";
}

// Galeri Modalı Fonksiyonları
function openGalleryModal(carName, images) {
  const galleryModal = document.getElementById('galleryModal');
  if (!galleryModal) return;
  
  galleryModal.style.display = 'flex';
  const mainImage = document.getElementById('mainGalleryImage');
  mainImage.src = images[0]; 
  mainImage.alt = carName;
  
  const thumbnailContainer = document.getElementById('thumbnailContainer');
  thumbnailContainer.innerHTML = ''; 
  
  images.forEach((imageSrc, index) => {
      const thumbnail = document.createElement('img');
      thumbnail.src = imageSrc;
      thumbnail.alt = `${carName} Gallery ${index + 1}`;
      thumbnail.classList.add('thumbnail');
      if (index === 0) thumbnail.classList.add('active'); 
      
      thumbnail.onclick = function() {
          changeMainImage(imageSrc, thumbnail);
      };
      
      thumbnailContainer.appendChild(thumbnail);
  });
}

function closeGalleryModal() {
  const galleryModal = document.getElementById('galleryModal');
  if (galleryModal) galleryModal.style.display = 'none';
}

function changeMainImage(imageSrc, thumbnail) {
  document.getElementById('mainGalleryImage').src = imageSrc;
  
  const activeThumbnail = document.querySelector('.thumbnail.active');
  if (activeThumbnail) activeThumbnail.classList.remove('active');
  
  thumbnail.classList.add('active');
}

// Kiralama Modalı Fonksiyonları
function openRentModal(carName, dailyPrice) {
  const rentModal = document.getElementById('rentModal');
  if (!rentModal) return;

  document.getElementById('rentCarTitle').innerText = carName + " Kirala";
  document.getElementById('hiddenCarName').value = carName;
  
  let price1 = dailyPrice;
  let price3 = dailyPrice * 3 * 0.95; 
  let price7 = dailyPrice * 7 * 0.90; 
  
  document.getElementById('price1').innerText = price1.toLocaleString('tr-TR');
  document.getElementById('price3').innerText = price3.toLocaleString('tr-TR');
  document.getElementById('price7').innerText = price7.toLocaleString('tr-TR');
  
  rentModal.style.display = 'flex';
}

function closeRentModal() {
  const rentModal = document.getElementById('rentModal');
  if (rentModal) rentModal.style.display = 'none';
}

// Dışarı tıklanınca TÜM modalları kapatma
window.addEventListener('click', function (event) {
  const loginModal = document.getElementById('loginModal');
  const registerModal = document.getElementById('registerModal');
  const galleryModal = document.getElementById('galleryModal');
  const rentModal = document.getElementById('rentModal');
  
  if (loginModal && event.target === loginModal) closeLogin();
  if (registerModal && event.target === registerModal) closeRegister();
  if (galleryModal && event.target === galleryModal) closeGalleryModal();
  if (rentModal && event.target === rentModal) closeRentModal();
});