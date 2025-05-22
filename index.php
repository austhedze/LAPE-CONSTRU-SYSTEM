<?php 
// Wait 5 seconds and redirect to register.php
header("refresh:6;url=pages/register.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>LAKESHORE AGRO‑PROCESSORS ENTERPRISE</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    @keyframes dot-pulse {
      0%, 100% {
        transform: scale(0.75);
        opacity: 0.5;
      }
      50% {
        transform: scale(1.2);
        opacity: 1;
      }
    }
    .animate-dot {
      animation: dot-pulse 1s infinite ease-in-out both;
    }
    .delay-0 { animation-delay:   0s; }
    .delay-1 { animation-delay: 0.25s; }
    .delay-2 { animation-delay: 0.50s; }
    .delay-3 { animation-delay: 0.75s; }
  </style>
</head>
<body class="bg-white flex items-center justify-center h-screen">

  <div class="text-center">
    <!-- Logo -->
    <img src="/LAPE-PRO\PROJECT-ROOT\assets\images\logo.PNG"
         alt="LAPE Logo"
         class="mx-auto h-24 w-24 object-contain" />

    <!-- Title -->
    <p class="mt-4 text-green-600 font-semibold uppercase tracking-widest">
      LAKESHORE AGRO‑PROCESSORS ENTERPRISE
    </p>

    <!-- Square loading dots -->
    <div class="flex justify-center mt-6 space-x-2">
      <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-0"></span>
      <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-1"></span>
       <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-2"></span>
      <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-3"></span>
      <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-2"></span>
      <span class="w-3 h-3 bg-[#1F2041] animate-dot delay-3"></span>
    </div>
  </div>

</body>
</html>
