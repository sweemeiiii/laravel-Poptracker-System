<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>POP TRACKER - Welcome</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,600;1,400&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: #FFFFFF;
      color: #000000;
      overflow-x: hidden;
      height: 100%;
    }

    .container {
      background-color: #FFFFFF;
      border-radius: 15px;
      margin: 10px auto;
      padding: 10px;
      max-width: 1200px;
      text-align: center;
      overflow: hidden;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px 20px;
    }

    .logo {
      height: 30px;
    }

    .buttons {
      display: flex;
      gap: 10px;
    }

    .buttons a {
      text-decoration: none;
      color: #FFFFFF;
      background-color: #C00000;
      padding: 6px 12px;
      border-radius: 8px;
      font-weight: 600;
      font-size: 13px;
      transition: background-color 0.3s ease;
    }

    .buttons a:hover {
      background-color: #000000;
    }

    h1 {
      font-weight: 700;
      font-size: 28px;
      margin-bottom: 5px;
    }

    .tagline {
      font-size: 16px;
      margin-bottom: 10px;
      color: #333;
    }

    .illustration {
      width: 50%; /* Smaller illustration */
      height: auto;
      margin-bottom: 15px; /* Reduced bottom margin */
    }

    .features {
      display: flex;
      justify-content: space-between;
      flex-wrap: nowrap;
      gap: 5px; /* Reduced gap between boxes */
    }

    .feature-card {
      background-color: #FFFFFF;
      border-radius: 16px;
      width: 370px; /* Longer box */
      padding: 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border: 2px solid #D3D3D3;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .feature-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 16px rgba(169, 169, 169, 0.5);
    }

    .feature-card img {
      width: 70px;
      height: 70px;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .feature-card img.static {
      display: block;
    }

    .feature-card img.animated {
      display: none;
    }

    .feature-card:hover img.static {
      display: none;
    }

    .feature-card:hover img.animated {
      display: block;
    }

    .feature-title {
      font-weight: 600;
      font-size: 16px;
      margin-bottom: 10px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
      width: 100%;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="header">
    <a href="/">
      <img src="images/poptracker_logo.png" alt="POP TRACKER Logo" class="logo">
    </a>
    <div class="buttons">
      <a href="/login">Login</a>
      <a href="/register">Register</a>
    </div>
  </div>

  <div class="container">
    <h1>Hi! Welcome to POP TRACKER</h1>
    <div class="tagline">A place for you to track your POP MART Collection.</div>
    <img src="images/welcomepage_illustration1.png" alt="Illustration" class="illustration">

    <div class="features">
      <div class="feature-card">
        <img src="images/track.png" alt="Track Collection Progress" class="static">
        <img src="images/track.gif" alt="Track Collection Progress Animation" class="animated">
        <div class="feature-title">Track Collection Progress</div>
        <p>View figurine collection status and visualize progress.</p>
      </div>

      <div class="feature-card">
        <img src="images/wishlist.png" alt="Wishlist & Duplicate Management" class="static">
        <img src="images/wishlist.gif" alt="Wishlist & Duplicate Management Animation" class="animated">
        <div class="feature-title">Wishlist & Duplicate Management</div>
        <p>Track desired figurines and manage duplicates.</p>
      </div>

      <div class="feature-card">
        <img src="images/browse.png" alt="Categorization & Organization" class="static">
        <img src="images/browse.gif" alt="Categorization & Organization Animation" class="animated">
        <div class="feature-title">Categorization & Organization</div>
        <p>Categorize and organize figurines for easy browsing.</p>
      </div>
    </div>
  </div>

</body>
</html>
