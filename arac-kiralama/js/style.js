function openLogin(event) {
  if (event) {
    event.preventDefault();
  }
  closeRegister();
  document.getElementById("loginModal").style.display = "flex";
}

function closeLogin() {
  document.getElementById("loginModal").style.display = "none";
}

function openRegister(event) {
  if (event) {
    event.preventDefault();
  }
  closeLogin();
  document.getElementById("registerModal").style.display = "flex";
}

function closeRegister() {
  document.getElementById("registerModal").style.display = "none";
}

function openChat(event) {
  if (event) {
    event.preventDefault();
  }
  document.getElementById("chatModal").style.display = "flex";
  document.getElementById('chatInput').focus();
}

function closeChat() {
  document.getElementById("chatModal").style.display = "none";
}

function sendChatMessage(event) {
  event.preventDefault();
  const input = document.getElementById('chatInput');
  const message = input.value.trim();
  if (!message) return;

  const messages = document.getElementById('chatMessages');
  const userMessage = document.createElement('div');
  userMessage.className = 'chat-message user';
  userMessage.textContent = message;
  messages.appendChild(userMessage);
  messages.scrollTop = messages.scrollHeight;
  input.value = '';

  setTimeout(() => {
    const botMessage = document.createElement('div');
    botMessage.className = 'chat-message bot';
    botMessage.textContent = 'DriveNow: Mesajınızı aldım, size en kısa sürede cevap verilecektir.';
    messages.appendChild(botMessage);
    messages.scrollTop = messages.scrollHeight;
  }, 500);
}

window.addEventListener('click', function (event) {
  const loginModal = document.getElementById('loginModal');
  const registerModal = document.getElementById('registerModal');
  const chatModal = document.getElementById('chatModal');
  if (event.target === loginModal) {
    closeLogin();
  }
  if (event.target === registerModal) {
    closeRegister();
  }
  if (event.target === chatModal) {
    closeChat();
  }
});