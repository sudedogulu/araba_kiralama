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

function openRentModal(carName, dailyPrice) {
  const rentModal = document.getElementById('rentModal');
  if (!rentModal) return;

  document.getElementById('selectedCarName').innerText = carName + " Kirala";
  document.getElementById('carNameInput').value = carName;
  document.getElementById('dailyPriceInput').value = dailyPrice;
  
  document.getElementById('rentForm').reset();
  document.getElementById('totalPriceDisplay').innerText = '0 ₺';
  document.getElementById('totalPriceInput').value = 0;
  
  const today = new Date().toISOString().split('T')[0];
  const startDate = document.getElementById('startDate');
  const endDate = document.getElementById('endDate');
  
  if(startDate) startDate.setAttribute('min', today);
  if(endDate) endDate.setAttribute('min', today);

  rentModal.style.display = 'flex';
}

function closeRentModal() {
  const rentModal = document.getElementById('rentModal');
  if (rentModal) rentModal.style.display = 'none';
}

document.addEventListener("DOMContentLoaded", function() {
  const startDate = document.getElementById('startDate');
  const endDate = document.getElementById('endDate');
  const dailyPriceInput = document.getElementById('dailyPriceInput');
  const totalPriceDisplay = document.getElementById('totalPriceDisplay');
  const totalPriceInput = document.getElementById('totalPriceInput');

  function calculatePrice() {
      if (startDate.value && endDate.value) {
          const start = new Date(startDate.value);
          const end = new Date(endDate.value);
          
          const timeDiff = end.getTime() - start.getTime();
          const daysDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
          
          if (daysDiff > 0) {
              const dailyPrice = parseFloat(dailyPriceInput.value);
              const total = daysDiff * dailyPrice;
              totalPriceDisplay.innerText = total.toLocaleString('tr-TR') + ' ₺';
              totalPriceInput.value = total;
          } else {
              totalPriceDisplay.innerText = 'Hatalı Tarih!';
              totalPriceInput.value = 0;
          }
      }
  }

  if(startDate) {
      startDate.addEventListener('change', () => {
          endDate.setAttribute('min', startDate.value);
          calculatePrice();
      });
  }
  if(endDate) {
      endDate.addEventListener('change', calculatePrice);
  }
});

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