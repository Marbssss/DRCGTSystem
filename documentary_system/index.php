<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Revised Documentary Requirements System</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: Arial, sans-serif;
      height: 100vh;
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: white;
      position: relative;
      overflow: hidden;
    }

    /* ===== TOP HEADER ===== */
    .top-banner {
      background-color: #001f74ff;
      color: white;
      text-align: center;
      padding: 25px 15px;
      font-weight: bold;
      font-size: 1.9rem;
      line-height: 1.4;
      letter-spacing: 0.5px;
      position: relative;
    }

    /* ===== BURGER MENU (RIGHT SIDE) ===== */
    .burger {
      position: absolute;
      right: 20px;
      top: 25px;
      width: 30px;
      height: 22px;
      cursor: pointer;
      z-index: 1000;
    }

    .burger div {
      background-color: white;
      height: 4px;
      margin: 5px 0;
      border-radius: 3px;
      transition: 0.4s;
    }

    /* Burger Animation */
    .burger.active div:nth-child(1) {
      transform: rotate(-45deg) translate(-6px, 6px);
    }
    .burger.active div:nth-child(2) {
      opacity: 0;
    }
    .burger.active div:nth-child(3) {
      transform: rotate(45deg) translate(-5px, -5px);
    }

    /* ===== SIDEBAR (RIGHT SIDE) ===== */
    .sidebar {
      position: fixed;
      top: 0;
      right: -280px;
      height: 100%;
      width: 280px;
      background-color: #3d4047ff;
      color: white;
      padding-top: 80px;
      transition: 0.4s;
      z-index: 999;
      box-shadow: -3px 0 8px rgba(0, 0, 0, 0.2);
      overflow-y: auto;
    }

    .sidebar.active {
      right: 0;
    }

    /* ===== SEARCH BAR ===== */
    .search-box {
      padding: 10px 15px;
      text-align: center;
    }

    .search-box input {
      width: 80%;
      padding: 8px;
      border: none;
      border-radius: 5px;
      outline: none;
    }

    .search-box button {
      background: #f7dc60;
      border: none;
      color: #004aad;
      padding: 7px 10px;
      border-radius: 5px;
      margin-left: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    .search-box button:hover {
      background: #fff07c;
    }

    .sidebar ul {
      list-style: none;
      padding: 0;
      margin-top: 10px;
    }

    .sidebar ul li {
      padding: 15px 25px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
      cursor: pointer;
      transition: 0.3s;
    }

    .sidebar ul li:hover {
      background-color: #0060d1;
    }

    .sidebar a {
      color: white;
      text-decoration: none;
      display: block;
    }

    /* ===== DYNAMIC SEARCH RESULTS ===== */
    .search-results {
      padding: 10px 20px;
    }

    .search-results a {
      display: block;
      color: #f7dc60;
      text-decoration: none;
      margin-bottom: 8px;
      font-weight: bold;
    }

    .search-results a:hover {
      color: #fff07c;
      text-decoration: underline;
    }

    /* ===== LAYOUT ELEMENTS ===== */
    .left-strip {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 20%;
      background: #e7bd00ff;
      clip-path: polygon(0 0, 40% 0, 90% 100%, 0% 100%);
      z-index: 0;
    }

    .right-strip {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%;
      width: 27%;
      background: #e7bd00ff;
      clip-path: polygon(70% 0, 100% 0, 100% 100%, 30% 100%);
      z-index: 0;
    }

    .content {
      position: relative;
      z-index: 1;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 30px 20px;
    }

    .content img {
  width: 200px;
  margin-bottom: 40px;
  transform-style: preserve-3d;
  animation: spin3D 6s linear infinite;
}

 @keyframes spin3D {
  0% { transform: rotateY(0deg); }
  100% { transform: rotateY(360deg); }
} 

    .content p {
      font-size: 1.2rem;
      color: #000;
      margin-bottom: 5px;
    }

    .content strong {
      font-weight: bold;
    }

    .footer {
      background-color: #860101ff;
      color: white;
      text-align: center;
      padding: 15px;
      font-weight: bold;
      font-size: 1.1rem;
      line-height: 1.5;
      z-index: 2;
    }

    .btn {
      margin-top: 25px;
      background-color: #004aad;
      color: white;
      border: none;
      padding: 12px 30px;
      border-radius: 10px;
      font-size: 16px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background-color: #00357d;
      transform: scale(1.05);
    }
    /* --- Loading Screen Overlay --- */
#loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.6);
  color: white;
  display: none; /* hidden by default */
  flex-direction: column;
  justify-content: center;
  align-items: center;
  z-index: 9999;
  animation: fadeIn 0.5s ease;
}

.spinner {
  border: 8px solid #f3f3f3;
  border-top: 8px solid #ffde00;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}

.loading-text {
  font-size: 1.2rem;
  font-weight: bold;
}

/* Animations */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}
/* ===== CENTER CONTAINER ===== */
.container {
  max-width: 500px;
  width: 90%;
  margin: 0 auto;
  background: rgba(255, 255, 255, 0.9);
  padding: 40px 30px;
  border-radius: 15px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  text-align: center;
  position: relative;
  z-index: 2;
}

  </style>
</head>
<body>
<!-- Loading Screen -->
<div id="loading-screen">
  <div class="spinner"></div>
  <div class="loading-text">Logging out...</div>
</div>

  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    
    <!-- Search Bar -->
    <div class="search-box">
      <input type="text" id="searchInput" placeholder="Search page..." onkeyup="searchPages()">
      <button>🔍</button>
    </div>

    <!-- Dynamic Results -->
    <div class="search-results" id="searchResults"></div>

    <!-- Menu -->
    <ul id="menuList">
      <li><a href="home.php">🏠 Home</a></li>
      <li><a href="page.php">🚪 All Pages</a></li>  
      <li><a href="circular.php">📜 Circulars</a></li>
      <li><a href="records.php">📋 Records</a></li>
      <li><a href="logout.php">🚪 Logout</a></li>
    </ul>
  </div>

<!-- Top Banner -->
<div class="top-banner">
  Revised Documentary<br>
  Requirements for Common<br>
  Government Transactions
  <div class="burger" id="burger">
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Realistic Christmas lights -->
  <div class="christmas-lights">
    <div class="light red"></div>
    <div class="light green"></div>
    <div class="light yellow"></div>
    <div class="light blue"></div>
    <div class="light orange"></div>
    <div class="light purple"></div>
    <div class="light pink"></div>
    <div class="light cyan"></div>
  </div>
</div>


  <!-- Content -->
  <div class="left-strip"></div>
  <div class="right-strip"></div>

  <div class="content">
  <div class="container">
    <img src="coa.png" alt="COA Logo">
    <p><strong>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</strong></p>
    <p><strong>As prescribed under COA</strong></p>
    <p><strong>Circular No. 2012-001</strong></p>
    <p>Dated June 14, 2012</p>

    <button class="btn" onclick="window.location.href='circular.php'">
      Go to System
    </button>
  </div>
</div>


  <div class="footer">
    COMMISSION ON AUDIT<br>
    Commonwealth Avenue, Quezon City, Philippines
  </div>

  <script>
    // Burger Menu Toggle
    const burger = document.getElementById('burger');
    const sidebar = document.getElementById('sidebar');

    burger.addEventListener('click', () => {
      burger.classList.toggle('active');
      sidebar.classList.toggle('active');
    });

    // Page Data (you can expand this)
    const pages = [
      { name: "page1.php", file: "page1.php" },
      { name: "page2.php", file: "page2.php" },
      { name: "page3.php", file: "page3.php" },
      { name: "page4.php", file: "page4.php" },
      { name: "page5.php", file: "page5.php" }
    ];

    // Search Function
    function searchPages() {
      const query = document.getElementById('searchInput').value.toLowerCase();
      const resultsDiv = document.getElementById('searchResults');
      resultsDiv.innerHTML = '';

      if (query.trim() === '') return;

      const matches = pages.filter(p => p.name.toLowerCase().includes(query));

      if (matches.length === 0) {
        resultsDiv.innerHTML = '<p>No results found.</p>';
      } else {
        matches.forEach(p => {
          const link = document.createElement('a');
          link.href = p.file;
          link.textContent = `➡ ${p.name}`;
          resultsDiv.appendChild(link);
        });
      }
    }
    // Logout Button Delay (5 seconds)
document.addEventListener('DOMContentLoaded', () => {
  const logoutLink = document.querySelector('a[href="logout.php"]');
  const loadingScreen = document.getElementById('loading-screen');

  if (logoutLink) {
    logoutLink.addEventListener('click', (e) => {
      e.preventDefault(); // stop immediate logout
      loadingScreen.style.display = 'flex'; // show loader
      setTimeout(() => {
        window.location.href = 'logout.php'; // proceed after 5s
      }, 1000 ); // 5 seconds
    });
  }
});

  </script>

</body>
</html>
