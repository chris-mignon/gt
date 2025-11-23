<?php require_once "includes/header.php"; require_login(); ?>

<h2>Your Projects to Grade</h2>
<div id="projectsRow" class="row mt-3 g-3"></div>

<script>
async function loadProjects() {
  const r = await fetch("api/lecturer_projects.php");
  const data = await r.json();

  const row = document.getElementById("projectsRow");
  row.innerHTML = "";

  data.forEach(p => {
    row.innerHTML += `
      <div class="col-md-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>${p.title}</h5>
            <small class="text-muted">${p.course_code}</small>
            <div class="mt-3 text-end">
              <a href="grade.php?id=${p.id}" class="btn btn-primary btn-sm">Grade</a>
            </div>
          </div>
        </div>
      </div>`;
  });
}
loadProjects();
</script>

<?php require_once "includes/footer.php"; ?>
