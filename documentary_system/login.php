<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Documentary Requirements System</title>
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
      overflow: hidden;
      position: relative;
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
    }

    /* Spinner */
    .spinner {
      border: 8px solid #f3f3f3;
      border-top: 8px solid #ffde00;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      animation: spin 1s linear infinite;
      margin-bottom: 20px;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .loading-text {
      font-size: 1.2rem;
      font-weight: bold;
    }

    /* --- Blue Top Banner --- */
    .top-banner {
      background-color: #001f74ff;
      color: white;
      text-align: center;
      padding: 25px 15px;
      font-weight: bold;
      font-size: 1.9rem;
      line-height: 1.4;
      letter-spacing: 0.5px;
    }

    /* --- Decorative Background Shapes --- */
    .left-strip {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      width: 25%;
      background: #e7bd00ff;
      clip-path: polygon(0 0, 40% 0, 90% 100%, 0% 100%);
      z-index: 0;
    }

    .right-strip {
      position: absolute;
      top: 0;
      right: 0;
      height: 100%;
      width: 30%;
      background: #e7bd00ff;
      clip-path: polygon(70% 0, 100% 0, 100% 100%, 30% 100%);
      z-index: 0;
    }

    /* --- Login Form Container --- */
    .content {
      position: relative;
      z-index: 1;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 30px 20px;
    }

    .login-box {
      background-color: rgba(255, 255, 255, 0.95);
      border: 2px solid #0072c6;
      border-radius: 15px;
      padding: 40px 50px;
      width: 100%;
      max-width: 400px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      text-align: center;
    }

    .login-box img {
      width: 120px;
      margin-bottom: 20px;
    }

    .login-box h2 {
      color: #004aad;
      font-size: 1.5rem;
      margin-bottom: 25px;
    }

    .login-box input {
      width: 100%;
      padding: 12px 15px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #aaa;
      font-size: 1rem;
      outline: none;
      transition: 0.3s;
    }

    .login-box input:focus {
      border-color: #004aad;
      box-shadow: 0 0 5px rgba(0, 74, 173, 0.4);
    }

    .login-box button {
      width: 100%;
      background-color: #004aad;
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
      transition: 0.3s;
      margin-top: 10px;
    }

    .login-box button:hover {
      background-color: #00357d;
      transform: scale(1.03);
    }

    .login-box .extra-links {
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .login-box .extra-links a {
      color: #004aad;
      text-decoration: none;
    }

    .login-box .extra-links a:hover {
      text-decoration: underline;
    }

    /* --- Red Footer --- */
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
  </style>
</head>
<body>
  <!-- Loading Screen -->
  <div id="loading-screen">
    <div class="spinner"></div>
    <div class="loading-text">Processing login...</div>
  </div>

  <!-- Background Shapes -->
  <div class="left-strip"></div>
  <div class="right-strip"></div>

  <!-- Header -->
  <div class="top-banner">
    COMMISSION ON AUDIT <br>
  </div>

  <!-- Login Form -->
  <div class="content">
    <div class="login-box">
      <img src="coa.png" alt="COA Logo">
      <h2>System Login</h2>
      <form id="loginForm" action="authenticate.php" method="POST">
        <input type="text" name="username" placeholder="Username" required />
        <input type="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
      </form>
      <div class="extra-links">
        <p>Forgot password? <a href="#">Click here</a></p>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer">
    Commonwealth Avenue, Quezon City, Philippines<br>
  </div>

 <script>
  // Show loading screen when form is submitted
  const loginForm = document.getElementById('loginForm');
  const loadingScreen = document.getElementById('loading-screen');

  loginForm.addEventListener('submit', function(e) {
    e.preventDefault(); // prevent immediate form submission
    loadingScreen.style.display = 'flex';

    // Wait 5 seconds before actually submitting the form
    setTimeout(() => {
      loginForm.submit(); // submit the form after 5 seconds
    }, 1000 ); // 5000ms = 5 seconds
  });
</script>

</body>
</html>
