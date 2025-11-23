<?php session_start(); ?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Login</title>
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width:450px;">
  <div class="card shadow-sm">
    <div class="card-body">
      <h3 class="mb-3">Lecturer Login</h3>

      <form id="loginForm">
        <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
        <button class="btn btn-primary w-100">Login</button>
      </form>

      <div id="loginMsg" class="mt-3 text-danger"></div>
    </div>
  </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", async (e)=>{
  e.preventDefault();
  const fd = new FormData(e.target);
  
  const r = await fetch("api/login.php", { method: "POST", body: fd });
  const out = await r.json();

  if(out.success) window.location = "dashboard.php";
  else document.getElementById("loginMsg").innerText = out.error;
});
</script>

</body>
</html>
